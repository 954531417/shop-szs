<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\SoftDeletes;
define('__KEY','');

class Admin extends Model {
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'admin';
//    public $timestamps = false;
    protected $fillable = ['name', 'password', 'use','avatar','updated_at','created_at','deleted_at','IP'];
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
        if($del){
            DB::table('admin_role')->where('admin_id','=',$id)->delete();
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
     *  修改管理员
     * @param $date
     * @return bool
     */
    public function edit($date){
        $id = $date['id'];
        $admin =  $this->find($id);
        if(isset($date['password'])){
            $date['password'] = md5($date['password'].$this->__KEY);
        }
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
        $data['password'] = md5($data['password'].$this->__KEY);
        $data['use'] = 1;
        $this->fill($data);
        if($this->save()){
            if(isset($data['roles_id'])){
                foreach ($data['roles_id'] as $key => $val){
                    DB::table('admin_role')->insert(['admin_id'=>$this->id,'role_id'=>$val]);
                }
            }
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
        foreach ($data as $key=>$val){
            $role = DB::table('admin_role as a')
                ->select('id','role_name')
                ->leftJoin('roles as b','a.role_id','=','b.id')
                ->where('a.admin_id','=',$val->id)
                ->get();
            $data[$key]->roles = $role;
        }
        return $data;
    }

    /**
     * 管理员验证
     * @param $data
     * @return mixed
     */
    public function check($data){
        $where['name'] = $data['name'];
        $where['password'] = md5($data['password'].$this->__KEY);
        return $this->where($where)->first();
    }

    /**
     * 设置token
     * @param $data
     * @return string
     */
    public function setToken($data){
        $key = "555668";
        $ip = $data['ip'];
        unset($data['ip']);
        $head = json_encode($data);
        $head = base64_encode($head);
        $body = $head.$ip.$key;
        $body = base64_encode($body);
        $body = md5($body);
        Redis::set($head,$body);
        return $head.':'.$body;
    }
}
