<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin;
use App\Http\Models\Privilege;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function Login(){
        $model = new Admin();
        $data = Request::only('name','password');

        $rules = [
            'name'=>'required',
            'password' => 'required',
        ];
        $message = [
            'name.required' =>  '用户名不能为空',
            'password.required' => '密码不能为空'
        ];
        $validator = Validator::make($data, $rules, $message);

        if (!$validator->passes()) {
            return array('error' => 701, 'content' => $this->checkError($validator));
        }
        $admin =  $model->check($data);
        if(!$admin){
            return array(['error'=>701,'content' => '用户名密码错误']);
        }

        $token = $model->setToken(['id'=>$admin->id,'name'=>$admin->name,'time'=>(int)(time()/7200),'ip'=>$this->get_client_ip()]);
        return json_encode(['error'=>0,"data"=>['token'=>$token]]);
    }
    public function info(){
        $pri = new Privilege();
        $nav = $pri->getNavCatData();
        echo json_encode(['error'=>0,'data'=>[
                'avatar'=>'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
                'name'=>$this->userName,
                'nav' => $nav,
                'roles'=>['admin']
                ]
            ]);
    }

    public function logout(){
        echo json_encode(['error'=>0,'data'=>[
            'avatar'=>'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
            'name'=>'admin',
            'roles'=>['admin']
        ]]);
    }
    function get_client_ip($type = 0,$client=true)
    {
        $type       =  $type ? 1 : 0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if($client){
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos    =   array_search('unknown',$arr);

                if(false !== $pos) unset($arr[$pos]);
                $ip     =   trim($arr[0]);
            }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip     =   $_SERVER['HTTP_CLIENT_IP'];
            }elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip     =   $_SERVER['REMOTE_ADDR'];
            }
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
        // 防止IP伪造
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }
}
