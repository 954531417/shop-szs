<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
//    use SoftDeletes;
//    protected $dates = ['deleted_at'];
    protected $table = 'message';
//    public $timestamps = false;
    protected $fillable = ['name','emali','phone','satisfy','message','updated_at','created_at'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
    public function getCategory(){
        return $this->select('id','cat_name')->get();
    }
    /**
     * 软删除恢复
     * @param $id
     * @return mixed
     */
    public function recover($id){
        return $this->onlyTrashed()->where('id','=',$id)->restore();
    }

    /**
     * 删除
     * @param $id
     * @return mixed
     */
    public function remove($id){
        $del = $this->onlyTrashed()->where('id','=',$id)->forceDelete();
        if ($del){
            DB::table('role_privilege')->where('role_id','=',$id)->delete();
        }
        return $del;
    }
    /**
     * 软删除
     * @param $id 用户id
     * @return bool
     */
    public function del($id){
        $admin =  $this->find($id);
        $admin->delete();
        if($admin->trashed()){
            return true;
        }else{
            return false;
        }
    }

    /**
     *  修改
     * @param $date
     * @return bool
     */
    public function edit($data){
        $id = $data['id'];
        $obj =  $this->find($id);
        $obj->fill($data);
        if($obj->save()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 添加
     * @param $data
     * @return bool
     */
    public function add($data){
        $this->fill($data);
        if($this->save()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 查找
     * @param $search
     * @return mixed
     */
    public function search($search){
        $data = array();
        switch ($search['del']){
            /**
             * 未删除
             */
            case 0:
                $data = $this
                    ->offset(($search['page']*$search['limit'])-$search['limit'])->limit($search['limit'])
                    ->where(function ($q) use ($search){

                    })
                    ->get();
                $data->count = $this->count();
                break;
            /**
             * 已删除
             */
            case 1:
                $data = $this
                    ->onlyTrashed()
                    ->offset(($search['page']*$search['limit'])-$search['limit'])
                    ->limit($search['limit'])->get();
                $data->count = $this->onlyTrashed()->count();
                break;
            /**
             * 全部
             */
            case 2:
                $data = $this
                    ->withTrashed()
                    ->offset(($search['page']*$search['limit'])-$search['limit'])
                    ->limit($search['limit'])
                    ->get();
                $data->count = $this->withTrashed()->count();
                break;
        }
        return $data;
    }
}
