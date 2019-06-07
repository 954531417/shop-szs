<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class News extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'news';
//    public $timestamps = false;
    protected $fillable = ['logo','news','title','title2','updated_at','created_at','deleted_at'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
    public function getRole(){
        return $this->select(['id','brand_name'])->get();
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
            DB::table('role_privilege')->where('role_id','=',$id)->delete();
            if(isset($data['privilege_id'])){
                foreach ($data['privilege_id'] as $key=>$val){
                    DB::table('role_privilege')->insert(['role_id'=>$id,'pri_id'=>$val]);
                }
            }
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
        $select = ['logo','title','title2','updated_at','created_at','deleted_at','id'];
        switch ($search['del']){
            /**
             * 未删除
             */
            case 0:
                $data = $this
                    ->offset(($search['page']*$search['limit'])-$search['limit'])->limit($search['limit'])
                    ->select($select)
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
                    ->limit($search['limit'])
                    ->select($select)
                    ->get();
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
                    ->select($select)
                    ->get();
                $data->count = $this->withTrashed()->count();
                break;
        }
        return $data;
    }
}
