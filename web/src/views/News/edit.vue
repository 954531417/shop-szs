



<template>
  <div class="components-container">
    <el-card>
      <el-form ref="form" :model="form" label-width="80px">
        <el-form-item label="文章名称">
          <el-input v-model="form.title" ></el-input>
        </el-form-item>
         <el-form-item label="标题名称">
          <el-input v-model="form.title2" ></el-input>
        </el-form-item>
        <el-form-item label="图片">
           <el-upload
            :action="add.uploadUrl"
            :show-file-list="false"
              :on-progress="progressImg"
            :on-success="handleAvatarSuccess"
            list-type="picture-card">
            <img v-if="form.logo" :src="showImg" style="width:148px;height:148px" class="avatar">
            <i v-if="!form.logo" :class="{'el-icon-plus': plus,'el-icon-loading':loading}"></i>
          </el-upload>
        </el-form-item>
        <el-form-item label="活动名称">
          <tinymce :height="300" v-model="form.news"></tinymce>
        </el-form-item>
      </el-form>
      <el-row>
        <el-col>
          <el-button :span="5" type="primary" @click="push">提交</el-button>
        </el-col>
        
      </el-row>
      
    </el-card>
    <!-- <div class="editor-content" v-html="content"></div> -->
  </div>
</template>

<script type='text/javascript'>
// import tinymce from 'tinymce/tinymce'
// import 'tinymce/themes/modern/theme'
// import Editor from '@tinymce/tinymce-vue'
import Tinymce from '@/components/Tinymce'
import axios from 'axios'
// import Tinymce from '@/components/Tinymce'
import { getToken } from '@/utils/auth'
import { getList, add, edit, del, GAPI } from '@/api/list'
import { Message } from 'element-ui'
export default {
  name: 'tinymce-demo',
  components: { Tinymce },
  data() {
    return {
      add:{
        uploadUrl: 'http://' + process.env.BASE_API + '/news/upload?token=' + getToken()
      },
       plus: true,
      loading: false,
      form: {
        id: '',
        title: '',
        title2: '',
        logo: '',
        news: ''
      },
      showImg: ''
      
    }
  },
  created() {
    var row = this.$route.query.data
    this.add.uploadUrl = 'http://' + process.env.BASE_API + '/news/upload?token=' + getToken()
    console.log('http://' + process.env.BASE_API + '/news/')


    this.Controller = 'news'
    this.form.id = row.id
    this.form.title = row.title
    this.form.title2 = row.title2
    // this.form.logo =  row.logo

    this.form.news = row.news
    GAPI({}, '/' + this.Controller + '/editCon?id='+row.id).then(res => {
      this.form.id = res.news[0].id
      this.form.title = res.news[0].title
      this.form.title2 = res.news[0].title2
      this.form.logo =  res.news[0].logo
      this.showImg = 'http://' + process.env.BASE_API +  res.news[0].logo
    this.form.news = res.news[0].news
    })
    
    console.log(this.form.logo)
  },
  methods: {
      progressImg(event, file, fileList){
      this.loading = true
      this.form.logo = ''
      this.dis = true
    },
     handleAvatarSuccess(res, file) {
      this.form.logo = '/app/uploadImage/' + res.path
      this.showImg = 'http://' + process.env.BASE_API + this.form.logo
       this.dis = false
    },
    push(){
       const loading = this.$loading({
          lock: true,
          text: '修改提交中',
          spinner: 'el-icon-loading',
          background: 'rgba(0, 0, 0, 0.7)'
        });
      axios.post( 'http://' + process.env.BASE_API + '/' + this.Controller + '/edit?token=' + getToken(),this.form).then(res => {
        if (res.data.error == 0) {
          Message({
            message: '修改成功',
            type: 'success',
            duration: 5 * 1000
          })

          this.$router.push({name:'News/list'})
        }
        loading.close()
         
      })
      // add(this.form, '/' + this.Controller + '/add?a=1').then(response => {
      //   this.dialogVisible = false
      //   this.fetchData()
      // },
      // error => {
      //   console.log(error)
        // Message({
        //   message: error.content,
        //   type: 'error',
        //   duration: 5 * 1000
        // })
      // })
    }

  }

}
</script>

<style scoped>
.editor-content{
  margin-top: 20px;

}
</style>

