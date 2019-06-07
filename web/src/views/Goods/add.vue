<template>
  <div class="app-container">
    <el-card class="box-card" :span='12'>
      <el-tabs v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="基本信息" name="back">
          <el-form ref="form" :model="form" label-width="120px">
            <el-form :model="form" label-width='125px'style="margin-right: 250px">
            <el-form-item v-show="false" label="id" >
              <el-input v-model="form.id"> </el-input>
            </el-form-item>
            </el-form-item>
            <el-form-item label="商品名称">
              <el-input v-model="form.goods_name"></el-input>
            </el-form-item>
            <el-form-item label="商品分类">
            <el-select v-model="form.cat_id" filterable placeholder="请选择">
              <el-option
                v-for="item in cat"
                :key="item.id"
                :label="item.cat_name"
                :value="item.id">
              </el-option>
            </el-select>
            </el-form-item>
            <el-form-item label="商品价格">
              <el-input v-model="form.shop_price"></el-input>
            </el-form-item>
            <el-form-item label="商品图片">
              <el-upload
              :action="add.uploadUrl"
              :show-file-list = "false"
              :disabled = "dis"
              :on-success="handleAvatarSuccess"
              :on-progress="progressImg"
              list-type="picture-card">
              <img v-show="form.logo" :src="showImg" style="width:148px;height:148px" class="avatar">
              <i v-if="!form.logo"  :class="{'el-icon-plus': plus,'el-icon-loading':loading}"></i>
            </el-upload>
            </el-form-item>
            <el-form-item label="是否上架">
              <el-radio v-model="form.is_on_sale" label="1">是</el-radio>
              <el-radio v-model="form.is_on_sale" label="0">否</el-radio>            
            </el-form-item>
            <el-form-item label="seo优化-关键字">
              <el-input v-model="form.seo_keyword"></el-input>
            </el-form-item>
            <el-form-item label="seo优化-描述">
              <el-input v-model="form.seo_description"></el-input>
            </el-form-item>
            <el-form-item label="排序">
              <el-input v-model="form.sort_num"></el-input>
            </el-form-item>
            <el-form-item label="商品描述">
              <el-input v-model="form.goods_desc"></el-input>
            </el-form-item>
            <el-form-item label="是否热卖">
              <el-radio v-model="form.is_hot" label="1">是</el-radio>
              <el-radio v-model="form.is_hot" label="0">否</el-radio>            
            </el-form-item>
            <el-form-item label="是否新品">
              <el-radio v-model="form.is_new" label="1">是</el-radio>
              <el-radio v-model="form.is_new" label="0">否</el-radio>            
            </el-form-item>
            <el-form-item label="是否精品">
              <el-radio v-model="form.is_best" label="1">是</el-radio>
              <el-radio v-model="form.is_best" label="0">否</el-radio>            
            </el-form-item>
          </el-form>
        </el-form>
        </el-tab-pane>
        <el-tab-pane label="属性设置" name="second">
          <el-form :model="form" label-width='120px'>
            <el-form-item v-for="val in attr" :label="val.attr_name">
              <div v-show="val.attr_type==0">
                <!-- <el-input v-show="false" v-model='form.attr[val.id].id'><el-input> -->
                <el-input v-model="form.attr[val.id]"></el-input>
              </div>
              <div v-if="val.attr_type==1">

                <el-select v-model="form.attr[val.id]" filterable placeholder="请选择">
                  <el-option
                    v-for="item in val.attr_option_values"
                    :label="item.option"
                    :value="item.option">
                  </el-option>
                </el-select>
              </div>
            </el-form-item>
          </el-form>
        </el-tab-pane>
      </el-tabs>
      <el-row>
        <el-col :offset='12' >
          <el-button type="primary" @click="push">添加商品</el-button>
        </el-col>
      </el-row>
    </el-card>
  </div>
</template>

<script>
import { getList, add, edit, del, GAPI } from '@/api/list'
import { Message } from 'element-ui'
import { getToken } from '@/utils/auth'
export default {
  data() {
    return {
      logo: {
        plus: true
      },
      plus: true,
      loading: false,
      activeName: 'back',
      cat: '',
      Controller: '',
      showImg: '',
      add: {
        uploadUrl: ''
      },
      dis: false,
      form: {
        goods_name: '',
        cat_id: '',
        shop_price: '',
        is_on_sale: '1',
        is_hot: '',
        logo: '',
        seo_keyword: '',
        seo_description: '',
        sort_num: '',
        goods_desc: '',
        is_hot: '0',
        is_new: '0',
        is_best: '0',
        attr: [

        ]
      },
      attr: [],
      cat: []
    }
  },
  created(){
    this.Controller = 'goods'
    this.add.uploadUrl = 'http://' + process.env.BASE_API + '/goods/upload?token=' + getToken()
    GAPI({}, '/' + this.Controller + '/init').then(res => {
      // Vue.set(this,'attr',res.data.attr)
      // Vue.set(this,'cat',res.data.cat)
      this.cat = res.data.cat
      this.attr = res.data.attr
      console.log(this.attr)
    })

  },
  methods: {
    onSubmit() {
      this.$message('submit!')
    },
     // 修改
    handleUpdate(row) {
      this.break()
      console.log(row)
      this.form.logo = row.logo
      this.showImg = 'http://' + process.env.BASE_API + this.form.logo
      this.form.id = row.id
      this.form.brand_name = row.brand_name
      this.form.site_url = row.site_url
      this.form.logo = row.logo
      this.dialogVisible = true
      this.dialogTitle = this.textMap.update
    },
    break(){
      this.form.goods_name = '',
      this.form.cat_id = '',
      this.form.shop_price = '',
      this.form.is_on_sale = '',
      this.form.is_hot = '',
      this.form.logo = '',
      this.form.seo_keyword ='',
      this.form.seo_description = '',
      this.form.sort_num = '',
      this.form.goods_desc = '',
      this.form.is_new = '',
      this.form.is_best = '',
      this.form.attr = []
    },
    push(){
      add(this.form, '/' + this.Controller + '/add').then(response => {
        this.dialogVisible = false
        console.log(response)
        if(response.error==0){
          this.$message({
            message: '添加成功',
            type: 'warning'
          })
          this.break()

        }
      },
      error => {
        console.log(error)
        Message({
          message: error.content,
          type: 'error',
          duration: 5 * 1000
        })
      })
    },
    progressImg(event, file, fileList){
      this.loading = true
      this.form.logo = ''
      this.dis = true
    },
    handleAvatarSuccess(res, file) {

      this.form.logo = '/app/uploadImage/' + res.path
      this.showImg = 'http://' + process.env.BASE_API + this.form.logo
      console.log(this.form.logo)
      this.dis = false
    },
    handleClick(tab, event) {
        console.log(tab, event);
    },
    onCancel() {
      this.$message({
        message: 'cancel!',
        type: 'warning'
      })
    }
  }
}
</script>

<style scoped>
.line{
  text-align: center;
}
</style>
