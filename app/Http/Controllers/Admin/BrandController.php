<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Brand;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class BrandController extends Controller
{
    private $rules = array();
    private $message = array();
    private $model;
    private $input;
    public function __construct()
    {
        $this->model = new Brand();
        parent::__construct();
        if(Request::isMethod('post')){
            $this->input = ['brand_name','site_url','logo'];
            $this->rules = [
                'brand_name' => 'required',
            ];
            $this->message = [
                'brand_name.required' => '品牌名称不能为空',
            ];
        }
    }

    public function upload(){
        $file = Request::file('file');
        $ext = $file->getClientOriginalExtension();
        $fileName = 'Brand/'.date('Y-m-d-H-i-s') . '-' . uniqid() . '.' .$ext;
        $check =  Storage::disk('upload')->put($fileName,file_get_contents($file->getRealPath()));
        if($check){
            return ['error'=>0,'path'=>$fileName];
        }
        return ['error'=>110,'content'=>'上传失败'];
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
        array_push($this->input,'id');
        $data =  Request::only($this->input);
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
        $data =  Request::only($this->input);
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

    /**
     * 返回id ,role_name
     * @return mixed
     */
    public function getRole(){
        return ['error'=>0,'role'=>$this->model->getRole()];
    }
}
