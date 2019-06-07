<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Goods extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'goods';
//    public $timestamps = false;
    protected $fillable = ['goods_name','cat_id',
        'shop_price','sm_logo','logo','is_on_sale',
        'seo_keyword','seo_description','sort_num',
        'goods_desc','is_hot','is_new','is_best',
        'updated_at','created_at','deleted_at'];
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
            DB::table('goods_attr')->where('goods_id','=',$id)->delete();
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
        Storage::delete($admin->logo);
        $admin->delete();
        if($admin->trashed()){
            return true;
        }else{
            return false;
        }
    }
    public function getGoods($search){
            return $this
                ->where(function ($q) use($search){
                    if(!empty($search['cat_id'])){
                        $q->where('cat_id','=',$search['cat_id']);
                    }
                })
                ->get();
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
            DB::table('goods_attr')->where('goods_id','=',$id)->delete();

            if(!empty($data['attr'])){
                foreach ($data['attr'] as $key=>$val){
                    $val = json_decode($val);
                    if($val == 'undefined'){
                        continue;
                    }else{
                        if(!empty($val->val)){
                            DB::table('goods_attr')
                                ->insert(['goods_id'=>$id,'attr_id'=>$val->id,'attr_value'=>$val->val]);
                        }
                    }
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
            if(!empty($data['attr'])){
                foreach ($data['attr'] as $key=>$val){
                    if($val == 'undefined'){
                        continue;
                    }else{
                        DB::table('goods_attr')
                            ->insert(['goods_id'=>$this->id,'attr_id'=>$key,'attr_value'=>$val]);
                    }
                }
            }
            return true;
        }else{
            return false;
        }
    }
    public function getSearch($search){
        $data = $this
            ->where(function ($q) use($search) {
                if(!empty($search)){
                    $q->where('goods_name','like','%'.$search.'%');
                }
            })
            ->get();
        return $data;
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
