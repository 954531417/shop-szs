<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\SoftDeletes;


class Privilege extends Model {
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'privilege';
//    public $timestamps = false;
    protected $fillable = ['img','parent_id','pri_name', 'module_name', 'controller_name','action_name','updated_at','created_at','deleted_at'];
    private $__KEY = '';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
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
     *  修改管理员
     * @param $date
     * @return bool
     */
    public function edit($date){
        $id = $date['id'];
        $admin =  $this->find($id);
        $admin->fill($date);
        if($admin->save()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 添加管理员
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
     * 查找管理员
     * @param $search
     * @return mixed
     */
    public function search($search){
        $data = array();
        switch ($search['del']){
            case 0:
                $data = $this->offset(($search['page']*$search['limit'])-$search['limit'])->limit($search['limit'])->get();
                $data->count = $this->count();
                break;
            case 1:
                $data = $this->onlyTrashed()->offset(($search['page']*$search['limit'])-$search['limit'])->limit($search['limit'])->get();
                $data->count = $this->onlyTrashed()->count();
                break;
            case 2:
                $data = $this->withTrashed()->offset(($search['page']*$search['limit'])-$search['limit'])->limit($search['limit'])->get();
                $data->count = $this->withTrashed()->count();
                break;
        }
        return $data;
    }

    /**
     * 返回导航
     * @param null $allCat
     * @return array
     */
    public function getNavCatData($allCat = null)
    {
        $data = array();
        // 先取出所有的分类
        $allCat = empty($allCat) ? $this->select('id','pri_name','module_name','controller_name','action_name','img','parent_id')->get()->toArray() : $allCat;
//        dd($allCat);
        // 再从所有的分类中取出顶级的
        foreach ($allCat as $k => $v)
        {
//            var_dump($v['is_use']);

            if($v['parent_id'] == 0)
            {
//                var_dump($v);
                // 循环找这个顶级分类的二级分类
                foreach ($allCat as $k1 => $v1)
                {

                    if($v1['parent_id'] == $v['id'])
                    {
                        foreach ($allCat as $k2 => $v2)
                        {

                            if($v2['parent_id'] == $v1['id'])
                            {
                                foreach ($allCat as $k3 => $v3){


                                    if($v3['parent_id'] == $v2['id']){
                                        $v2['children'][] = $v3;
                                    }
                                }
                                $v1['children'][] = $v2;
                            }
                        }
                        $v['children'][] = $v1;
                    }
                }
                $data[] = $v;
            }
        }
        return $data;
    }




}
