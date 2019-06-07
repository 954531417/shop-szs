<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin;
use App\Http\Models\Privilege;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class PrivilegeController extends Controller
{
    private $rules = array();
    private $message = array();
    private $model;
    public function __construct()
    {
        $this->model = new Privilege();
        parent::__construct();
        if(Request::isMethod('post')){
            $this->rules = [
                'pri_name' => 'required',
                'module_name' => 'required',
                'controller_name' => 'required',
                'action_name' => 'required',
                'img' => 'required',
                'parent_id' => 'required',
            ];

            $this->message = [
                'pri_name.required' => '权限名称不能为空',
                'module_name.required' => '模块名不能为空',
                'controller_name.required' => '控制器名不能为空',
                'action_name.required' => '方法不能为空',
                'img.required' => '图片不能为空',
                'parent_id.required' => '父级权限不能为空',

            ];

        }
    }

    /**
     * 恢复
     * @return array
     */
    public function recover(){
        $id = Request::only('id');
        $this->model->recover($id['id']+0);
        return ['error'=>0];
    }

    /**
     * 删除
     * @return array
     */
    public function remove(){
        $id = Request::only('id');
        $this->model->remove($id['id']+0);
        return ['error'=>0];
    }

    /**
     * 软删除
     * @return array
     */
    public function softDel(){
        $id = Request::input('id')+0;
        if($this->model->del($id)){
            return ['error'=>0,'content'=>'删除成功'];
        }else{
            return ['error'=>704,'content'=>'删除失败'];
        }
    }
    public function getParent(){
        $nav =  $this->model->getNavCatData();

        return ['error'=>0,'parent'=>$nav];
    }
    /**
     * 列表
     * @return array
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
        $data =  Request::only(['id','pri_name','module_name','controller_name','action_name','img','parent_id']);
        $validator = Validator::make($data, $this->rules, $this->message);
        if (!$validator->passes()){
            return array('state' => 701, 'content' => $this->checkError($validator));
        }
        if(!$this->model->edit($data)){
            return ['error'=>703,'content'=>'修改失败'];
        }
        return ['error'=>0, 'content'=>'修改成功'];
    }
    /**
     *  添加
     * @return array
     */
    public function add(){
        $data =  Request::only(['pri_name','module_name','controller_name','action_name','img','parent_id']);
        $validator = Validator::make($data, $this->rules, $this->message);

        if (!$validator->passes()){
            return array('state' => 701, 'content' => $this->checkError($validator));
        }

        $model = new Privilege();
        if($model->add($data)){
            return ['error'=>0,'content'=>'添加成功'];
        }else{
            return ['error'=>702,'content'=>'添加失败'];
        }
    }

}
