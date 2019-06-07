<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Home\Controller;
use App\Http\Models\Goods;
use App\Http\Models\Message;
use App\Http\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class IndexController extends Controller
{
    public $cat;
    public function __construct()
    {
        parent::__construct();
        $this->cat = DB::table('category')->get();
    }
    public function index(){
        $model = new Goods();
        $input = Request::only('cat_id');
        $goods = $model->getGoods($input);
        $Nmodel = new News();
        $news = $Nmodel->offset(0)
            ->limit(3)
            ->orderBy('created_at','DESC')
            ->select(['title','logo','created_at','title2','id'])
            ->get();

        return view($this->Mobile.".index",['goods'=>$goods,'nav'=>'index','cat' => $this->cat,'news'=>$news]);
    }
    public function DetailsPage(){
        $model = new Goods();
        $id = Request::only('id')['id'];
        $data =  $model
                ->find($id);
        $top = $model
            ->where('id','<',$id)
            ->limit(1)
            ->orderBy('id', 'asc')
            ->get();
        $botton = $model
            ->where('id','>',$id)
            ->limit(1)
            ->orderBy('id', 'asc')
            ->get();

        $attr =  DB::table('attribute as a')
            ->leftJoin('goods_attr as b','a.id','=','attr_id')
            ->where('goods_id','=',$id)
            ->groupBy('a.id')
            ->orderBy('un_number', 'desc')
            ->get();

        $data->attr = $attr;
        return view($this->Mobile.'.DetailsPage',
            [
                'goods'=>$data,
                'top'=>$top,
                'botton'=>$botton,
                'nav'=>'dp',
                'cat'=>$this->cat
            ]);
    }
    public function ContactUs(){
        return view($this->Mobile.'.ContactUs',['nav'=>'cu','cat'=>$this->cat]);
    }
    public function ProductDisplay(){
        $model = new Goods();
        if($this->Mobile == 'phone'){
            $goods = $model->get();
            $id = 0;
        }else{
            $id = Request::only('id');
            if(!empty($id)){
                $id = $id['id'];
            }
            $goods = $model->where('cat_id','=',$id)->get();
        }

        return view($this->Mobile.'.ProductDisplay',
            [
                'nav'=>'pd',
                'cat'=>$this->cat,
                'goods'=>$goods,
                'cat_id'=>$id
            ]);
    }
    public function push(){
        $mess = new Message();
        $data = Request::only(['name','emali','phone','satisfy','message']);
        $rules = [
            'name'=>'required',
            'emali'=>'required',
            'phone'=>'required',
        ];
        $message = [
            'name.required'=>'姓名不能为空',
            'emali.required'=>'邮箱不能为空',
            'phone.required'=>'电话不能为空'

        ];
        $validator = Validator::make($data, $rules, $message);
        if (!$validator->passes()){
            return array('state' => 701, 'content' => $this->checkError($validator));
        }
        if($mess->add($data)){
            return ['error'=>0];
        }
    }
    public function NewsInformation(){
        $page = Request::only('page');
        if(!empty($page)){
            $page = $page['page'];
        }else{
            $page = 1;
        }
        $limit = 5;
        $model = new News();
        $news = $model->orderBy('created_at','DESC')
            ->offset($page*$limit-$limit)->limit($limit)
            ->select(['title','logo','created_at','title2','id'])
            ->get();
        $count =  $model->count();
        $count = $count /$limit;
        return view($this->Mobile.".NewsInformation",['nav'=>'ni','cat'=>$this->cat,'news'=>$news,'count'=>$count,'page'=> $page]);
    }
    public function MessageBoard(){
        return view($this->Mobile.".MessageBoard",['nav'=>'mb','cat'=>$this->cat]);
    }
    public function AboutUs(){
        return view($this->Mobile.'.AboutUs',['nav'=>'au','cat'=>$this->cat]);
    }
    public function NewsInformationDetails(){
        $id = Request::only('id')['id'];
        $model = new News();
        $news = $model->find($id);
        $top = $model
            ->where('id','<',$id)
            ->limit(1)
            ->orderBy('id', 'asc')
            ->get();
        $botton = $model
            ->where('id','>',$id)
            ->limit(1)
            ->orderBy('id', 'asc')
            ->get();
        return view($this->Mobile.".NewsInformationDetails",[
            'nav'=>'nd','cat'=>$this->cat,'news'=>$news,'top'=>$top,'botton'=>$botton]);
    }
    public function checkError($validator){
        $error = $validator->errors()->toArray();
        if (!empty($error)) {
            $err = array_slice($error, '0', '1');
            return array_values($err)[0][0];
        }
    }
    public function search(){
        $search = Request::input('goods_name');
        $goods =  new Goods();
        if(!empty($search)){
            $data = $goods->getSearch($search);
        }else{
            $data = [];
        }



        return view($this->Mobile.".search",['goods'=>$data]);
    }
    public function getSearch(){


    }
}
