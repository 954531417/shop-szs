<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    private $rules;
    private $message;
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = new Admin();
        if(Request::isMethod('post')){
            $this->rules = [
                'name' => 'required|'.($this->Method=='edit' ? '':'unique:admin|').'between:4,30',
                'password' => 'required|confirmed|between:6,18',
            ];

            $this->message = [
                'name.required' => '用户名不能为空',
                'name.unique'   => '用户名已存在',
                'name.between'  => '用户名长度4~30之间',
                'password.required' => '密码不能为空',
                'password.confirmed'=> '密码输入不一致',
                'password.between'  => '密码长度6~18之间',
            ];
            if($this->Method=='edit'){
                unset($this->message['name.unique']);
            }

        }
    }
    /**
     *   恢复
     */
    public function recover(){
        $id = Request::only('id');
        $this->model->recover($id['id']+0);
        return ['error'=>0];
    }
    /**
     *  删除
     *
     */
    public function remove(){
        $id = Request::only('id');
        $this->model->remove($id['id']+0);
        return ['error'=>0];
    }
    /**
     *  软删除
     *
     */
    public function softDel(){
        $id = Request::input('id')+0;
        if($this->model->del($id)){
            return ['error'=>0,'content'=>'删除成功'];
        }else{
            return ['error'=>704,'content'=>'删除失败'];
        }
    }
    /**
     *  列表
     */
    public function list(){
        $search = Request::only('page','limit','del');
        $list = $this->model->search($search);
        return ['error'=>0,'list'=>$list, 'count'=>$list->count,'controller'=>$this->Controller];
    }

    /**
     *  修改
     * @return array
     */
    public function edit(){

        $data =  Request::only('id','name','password','cpassword','roles_id');
        if(!isset($data['cpassword'])){
            return ['error'=>701,'content'=>'确认密码不能为空'];
        }
        $data['password_confirmation'] = $data['cpassword'];
        $validator = Validator::make($data, $this->rules, $this->message);
        if (!$validator->passes()){
            return array('state' => 701, 'content' => $this->checkError($validator));
        }
        if(!$this->model->edit($data)){
            return ['error'=>703,'content'=>'修改失败'];
        }
        if (isset($data['roles_id'])){
            DB::table('admin_role')->where('admin_id','=',$data['id'])->delete();
            foreach ($data['roles_id'] as $key=>$val){
                DB::table('admin_role')->insert(['admin_id'=>$data['id'],'role_id'=>$val]);
            }
        }
        return ['error'=>0, 'content'=>'修改成功'];
    }

    /**
     *  添加
     * @return array
     */
    public function add(){
        $data =  Request::only('name','password','cpassword','roles_id');
        if(!isset($data['cpassword'])){
            return ['error'=>701,'content'=>'确认密码不能为空'];
        }
        $data['password_confirmation'] = $data['cpassword'];
        $validator = Validator::make($data, $this->rules, $this->message);
        if (!$validator->passes()){
            return array('state' => 701, 'content' => $this->checkError($validator));
        }
        if($this->model->add($data)){
            return ['error'=>0,'content'=>'添加成功'];
        }else{
            return ['error'=>702,'content'=>'添加失败'];
        }
    }

}
