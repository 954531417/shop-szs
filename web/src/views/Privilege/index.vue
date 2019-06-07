<template>
  <div class="app-container">
    <div class="filter-container" style="margin-bottom: 20px">
      <el-input  style="width: 200px;"  placeholder="用户名" v-model="listQuery.name"></el-input>
      <el-select v-model="listQuery.del" placeholder="请选择">
        <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value">
        </el-option>
      </el-select>
      <el-button class="filter-item" type="primary"  icon="el-icon-search" @click="fetchData">搜索</el-button>
      <el-button class="filter-item" style="margin-left: 10px;"  @click="handleCreate"  type="primary" icon="el-icon-edit">添加</el-button>
      <el-button class="filter-item" type="primary"  icon="el-icon-download" >下载</el-button>
      <el-dialog :title="dialogTitle" label-width="80px" :visible.sync="dialogVisible">
        <el-form :model="form" label-width='85px'>
          <el-form-item v-show="false" label="id" >
            <el-input v-model="form.id"> </el-input>
          </el-form-item>
          <el-form-item label="上级权限">
            <el-select v-model="form.parent_id" filterable placeholder="请选择">
              <el-option key='0' label='最高权限' value='0'>
              </el-option>
              <el-option
                v-for="item in add.parent"
                :key="item.id"
                :label="item.pri_name"
                :value="item.id">
              </el-option>
          </el-select>
          </el-form-item>
          <el-form-item label="图标">
            <el-input v-model="form.img"></el-input>
          </el-form-item>
          <el-form-item label="权限名称">
            <el-input v-model="form.pri_name"></el-input>
          </el-form-item>
          <el-form-item label="模块名称">
            <el-input v-model="form.module_name"></el-input>
          </el-form-item>
          <el-form-item label="控制器名称">
            <el-input v-model="form.controller_name"></el-input>
          </el-form-item>
          <el-form-item label="方法名称">
            <el-input v-model="form.action_name"></el-input>
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
      <el-table-column label="权限名称">
        <template slot-scope="scope">
          {{scope.row.pri_name}}
        </template>
      </el-table-column>
      <el-table-column label="模块" width="110" align="center">
        <template slot-scope="scope">
          <span>{{scope.row.module_name}}</span>
        </template>
      </el-table-column>
      <el-table-column label="控制器" width="110" align="center">
        <template slot-scope="scope">
          <span>{{scope.row.controller_name}}</span>
        </template>
      </el-table-column>
      <el-table-column label="方法" width="110" align="center">
        <template slot-scope="scope">
          <span>{{scope.row.action_name}}</span>
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
export default {
  data() {
    return {
      listQuery: {
        name: '',
        del: '',
        page: 1,
        limit: 20
      },
      form: {
        id: '',
        pri_name: '',
        module_name: '',
        controller_name: '',
        action_name: '',
        img: '',
        parent_id: ''
      },
      add: {
        parent: []
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
    // 获取数据
    fetchData() {
      this.listLoading = true
      this.listQuery.page = this.page.currentPage
      this.listQuery.limit = this.page.pageSize
      getList(this.listQuery, '/privilege/list').then(response => {
        this.list = response.list
        this.Controller = response.controller.toLowerCase()
        console.log(this.Controller)
        this.page.total = response.count
        this.listLoading = false
      })
    },
    // 重置
    break() {
      this.id = ''
      this.form.pri_name = ''
      this.form.module_name = ''
      this.form.controller_name = ''
      this.form.action_name = ''
      this.form.img = ''
      this.form.parent_id = ''
      this.add.parent = []
      GAPI('{}', '/' + this.Controller + '/getparent').then(response => {
        this.add.parent.push()
        response.parent.forEach(value => {
          this.add.parent.push({ 'id': value.id, 'pri_name': value.pri_name })
          if (value.children) {
            value.children.forEach(value1 => {
              this.add.parent.push({ 'id': value1.id, 'pri_name': '--' + value1.pri_name })
              if (value1.children) {
                value1.children.forEach(value2 => {
                  this.add.parent.push({ 'id': value2.id, 'pri_name': '----' + value2.pri_name })
                })
              }
            })
          }
        })
      })
    },
    // 创建
    handleCreate() {
      this.break()
      this.dialogVisible = true
      this.dialogTitle = this.textMap.create
    },
    // 修改
    handleUpdate(row) {
      this.break()
      console.log(row.parent_id)
      this.form.id = row.id
      this.form.pri_name = row.pri_name
      this.form.module_name = row.module_name
      this.form.controller_name = row.controller_name
      this.form.action_name = row.action_name
      this.form.img = row.img
      this.form.parent_id = row.parent_id
      this.dialogVisible = true
      this.dialogTitle = this.textMap.update
    },
    // 创建
    create() {
      this.listLoading = true
      // console.log(this.form)
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
      // console.log(this.form)
      if (this.form.id === this.form.parent_id) {
        Message({
          message: '自身不能为父级',
          type: 'error',
          duration: 5 * 1000
        })
      } else {
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
      }
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
