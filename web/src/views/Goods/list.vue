<template>
  <div class="app-container">
    <div class="filter-container" style="margin-bottom: 20px">
      <el-input  style="width: 200px;"  placeholder="品牌名称" v-model="listQuery.brand_name"></el-input>
      <el-select v-model="listQuery.del" placeholder="请选择">
        <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value">
        </el-option>
      </el-select>
      <el-button class="filter-item" type="primary"  icon="el-icon-search" @click="fetchData">搜索</el-button>
      
      <el-button class="filter-item" type="primary"  icon="el-icon-download" >下载</el-button>
      <el-dialog :title="dialogTitle" label-width="80px" :visible.sync="dialogVisible">
        <el-form :model="form" label-width='85px'>
          <el-form-item v-show="false" label="id" >
            <el-input v-model="form.id"> </el-input>
          </el-form-item>
          </el-form-item>
          <el-form-item label="品牌名称">
            <el-input v-model="form.brand_name"></el-input>
          </el-form-item>
          <el-form-item label="品牌官网">
            <el-input v-model="form.site_url"></el-input>
          </el-form-item>
          <el-form-item label="品牌logo">
            <el-upload
            :action="add.uploadUrl"
            :show-file-list="false"
            :on-success="handleAvatarSuccess"
            list-type="picture-card">
            <img v-if="form.logo" :src="showImg" style="width:148px;height:148px" class="avatar">
            <i v-if="!form.logo" class="el-icon-plus"></i>
          </el-upload>

          </el-form-item>
          
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogVisible = false">取 消</el-button>
          <el-button type="primary" v-if="dialogTitle=='添加'" @click="create">{{ dialogTitle }}</el-button>
          <el-button type="primary" v-else  @click="update">{{ dialogTitle}}</el-button>
        </div>
      </el-dialog>

    </div>
    <el-table :data="list" v-loading.body="listLoading" element-loading-text="Loading" border fit highlight-current-row>
      <el-table-column align="center" label='ID' width="95">
        <template slot-scope="scope">
          {{scope.$index}}
        </template>
      </el-table-column>
      <el-table-column label="商品名称" width="200">
        <template slot-scope="scope">
          {{scope.row.goods_name}}
        </template>
      </el-table-column>
      <el-table-column label="商品价格" width="200" align="center">
        <template slot-scope="scope">
          <span>{{scope.row.shop_price}}</span>
        </template>
      </el-table-column>
      <el-table-column label="商品分类" width="200" align="center">
        <template slot-scope="scope">
          <span>{{scope.row.site_url}}</span>
        </template>
      </el-table-column>
      <el-table-column label="商品图片" width="110" align="center">
        <template slot-scope="scope">
          <img :src="getImage(scope.row.logo)" style="width:45px" alt="">
        </template>
      </el-table-column>
      <el-table-column label="创建时间" width="110" align="center">
        <template slot-scope="scope">
          {{scope.row.created_at}}
        </template>
      </el-table-column>
      <el-table-column label="跟新时间" width="110" align="center">
        <template slot-scope="scope">
          {{scope.row.updated_at}}
        </template>
      </el-table-column>
      <el-table-column label="操作" width="180" align="center">
        <template slot-scope="scope">
            <el-button v-if="!scope.row.deleted_at" type="primary" size="mini" @click="handleUpdate(scope.row)" >修改</el-button>
            <el-button v-if="!scope.row.deleted_at" type="warning" size="mini" @click="softDel(scope.row)">禁用</el-button>
            <el-button v-if="scope.row.deleted_at" type="success" size="mini" @click="recover(scope.row)">恢复</el-button>
            <el-button v-if="scope.row.deleted_at" type="danger" size="mini" @click="remove(scope.row)">删除</el-button>
        </template>
      </el-table-column>
    </el-table>
    <div class="block" style="padding-left: 25px;padding-top: 15px">
      <!--<span class="demonstration">完整功能</span>-->
      <el-pagination
              @size-change="handleSizeChange"
              @current-change="handleCurrentChange"
              prev-text="上一页"
              next-text="下一页"
              popper-class="页"
              :current-page="page.currentPage"
              :page-sizes="pageSizes"
              :page-size="page.pageSize"
              layout="total, sizes, prev, pager, next, jumper"
              :total="page.total">
      </el-pagination>
    </div>
    <el-dialog
            :title="del.title"
            :visible.sync="dialogdel"
            width="30%">
      <span>{{ del.content }}</span>
      <span slot="footer" class="dialog-footer">
      <el-button @click="dialogdel = false">取 消</el-button>
      <el-button type="primary" @click="postDel">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
import { getList, add, edit, del, GAPI } from '@/api/list'
import { Message } from 'element-ui'
import { getToken } from '@/utils/auth'
export default {
  data() {
    return {
      showImg: '',
      listQuery: {
        name: '',
        del: '',
        page: 1,
        limit: 20
      },
      form: {
        id: '',
        brand_name: '',
        site_url: '',
        logo: ''
      },
      add: {
        uploadUrl: ''
      },
      parent: [],
      list: null,
      listLoading: true,
      Controller: '',
      textMap: {
        update: '修改',
        create: '添加'
      },
      dialogVisible: false,
      dialogdel: false,
      dialogTitle: '',
      delId: 0,
      options: [{
        value: 0,
        label: '未禁用'
      }, {
        value: 1,
        label: '禁用'
      }, {
        value: 2,
        label: '全部'
      }],
      del: {
        type: null,
        title: '',
        content: '',
        url: ''
      },
      pageSizes: [10, 20, 50, 100],
      page: {
        currentPage: 1,
        pageSize: 10,
        total: 1
      }
    }
  },
  created() {
    this.dialogVisible = false
    this.fetchData()
    this.page.pageSize = 10
  },
  methods: {
    getImage(path) {
      return 'http://' + process.env.BASE_API + path
    },
    handleAvatarSuccess(res, file) {
      this.form.logo = '/app/uploadImage/' + res.path
      this.showImg = 'http://' + process.env.BASE_API + this.form.logo
    },
    // 获取数据
    fetchData() {
      this.listLoading = true
      this.listQuery.page = this.page.currentPage
      this.listQuery.limit = this.page.pageSize
      getList(this.listQuery, '/goods/list').then(response => {
        this.list = response.list
        this.Controller = response.controller.toLowerCase()
        this.page.total = response.count
        this.listLoading = false
      })
    },
    // 重置
    break() {
      this.id = ''
      this.form.brand = ''
      this.showImg = ''
    },
    // 创建
    handleCreate() {
      this.break()
      this.dialogVisible = true
      this.dialogTitle = this.textMap.create
    },
    // 修改
    handleUpdate(row) {
      this.$router.push({name:'Goods/edit',query: { data: row}})
    },
    // 添加
    create() {
      this.listLoading = true
      this.break()
      add(this.form, '/' + this.Controller + '/add').then(response => {
        this.dialogVisible = false
        this.fetchData()
      },
      error => {
        console.log(error)
        Message({
          message: error.content,
          type: 'error',
          duration: 5 * 1000
        })
      })
      this.listLoading = false
    },
    // 修改
    update() {
      this.listLoading = true
      edit(this.form, '/' + this.Controller + '/edit').then(response => {
        this.dialogVisible = false
        this.fetchData()
      },
      error => {
        Message({
          message: error.content,
          type: 'error',
          duration: 5 * 1000
        })
      })
      this.listLoading = false
    },
    // 软删除
    softDel(row) {
      this.dialogdel = true
      this.delId = row.id
      this.del.title = '禁用'
      this.del.content = '确认禁用吗？'
      this.del.url = '/' + this.Controller + '/softDel'
    },
    // 提交删除
    postDel() {
      if (this.i === 0) {
        Message({
          message: '错误',
          type: 'error',
          duration: 5 * 1000
        })
      }
      del({ 'id': this.delId }, this.del.url).then(response => {
        this.dialogdel = false
        this.fetchData()
      })
      this.delId = 0
    },
    remove(row) {
      this.dialogdel = true
      this.delId = row.id
      this.del.title = '删除'
      this.del.content = '确认删除吗？'
      this.del.url = '/' + this.Controller + '/remove'
    },
    recover(row) {
      this.dialogdel = true
      this.delId = row.id
      this.del.title = '恢复'
      this.del.content = '确认恢复吗？'
      this.del.url = '/' + this.Controller + '/recover'
    },
    // 分页数改变
    handleSizeChange(val) {
      this.page.pageSize = val
      this.fetchData()
    },
    // 改变分页
    handleCurrentChange(val) {
      this.page.currentPage = val
      this.fetchData()
    },
    handleClose(done) {
    }
  }
}
</script>
