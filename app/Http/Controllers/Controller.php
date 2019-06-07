<?php
namespace App\Http\Controllers;

use App\Http\Models\Privilege;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $Platform;
    public $Controller;
    public $Method;
    public $userId;
    public $userName;
    public $time;
    private $pop = array('Login'=>array('login','logout'));
    public function __construct(){
        $this->init();
        $this->checkToken();
        array_push($this->pop['Login'],'info');
        if((!empty($this->pop[$this->Controller]))&&in_array($this->Method,$this->pop[$this->Controller])){
            return true;
        }
        $this->checkPrivilege(['platform'=>$this->Platform,'controller'=>$this->Controller,'method'=>$this->Method]);
    }

    public function init(){
        // 初始化平台、控制器、方法
        $url = Route::current()->getActionName();
        $data = explode("\\",$url);
        $this->Platform = array_slice($data,-2,1)[0];
        $con = array_slice($data,-1,1);
        $data = explode("Controller@",$con[0]);
        $this->Controller=$data[0];
        $this->Method=$data[1];
    }

    public function checkError($validator){
        $error = $validator->errors()->toArray();
        if (!empty($error)) {
            $err = array_slice($error, '0', '1');
            return array_values($err)[0][0];
        }
    }

    public function checkToken(){
        if((!empty($this->pop[$this->Controller]))&&in_array($this->Method,$this->pop[$this->Controller])){
            return true;
        }
        $token =  Request::header('X-Token');

        if(empty($token)){
            $token =  Request::only('token');
            if(!isset($token['token'])){
                echo json_encode(['error'=>602,'data'=>['msg'=>'token不能为空']]);
                die;
            }
            $token = $token['token'];
        }
        if(strpos($token,':')===false){
            echo json_encode(['error'=>601,'data'=>['msg'=>'token非法']]);
            die;
        }
        $token = explode(':',$token);
        $tolenKey = Redis::get($token[0]);
        if($tolenKey!=$token[1]){
            echo json_encode(['error'=>601,'data'=>['msg'=>'token非法']]);
            die;
        }
        $this->userId = json_decode(base64_decode($token[0]))->id;
        $this->userName = json_decode(base64_decode($token[0]))->name;
    }
    public function checkPrivilege($privilege){
        $data =  DB::table('admin_role as a')
            ->rightJoin('role_privilege as b','a.role_id','b.role_id')
            ->rightJoin('privilege as c','c.id','b.pri_id')
            ->where('admin_id','=',$this->userId)
            ->where(function ($q) use ($privilege){
                $q->where('c.module_name','=',$privilege['platform']);
                $q->where('c.controller_name','=',$privilege['controller']);
                $q->where('c.action_name','=',$privilege['method']);
                return $q;
            })
            ->select(['c.id','module_name','controller_name','action_name'])
            ->get();
        if(!isset($data[0])){
            echo  json_encode(['error'=>604,'content'=>'无权访问']);
            die;
        }
    }
}
