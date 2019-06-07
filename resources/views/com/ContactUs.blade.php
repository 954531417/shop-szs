@extends('com.Layout')
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
@section('content')
			<div id="content">
				<div class="lunbo">
					<div class="am-slider am-slider-default " data-am-flexslider>
					<ul class="am-slides">
							<li><img src="com/img/banner.jpg" /></li>
							<li><img src="com/img/banner1.jpg" /></li>
							<li><img src="com/img/banner2.jpg" /></li>
						</ul>
					</div>
				</div>
				<div class="am-g width1200">
					<ol class="am-breadcrumb am-breadcrumb-slash">
						<li>
							<a href="index.html" class="color333">首页</a>
						</li>
						<li>
							<a href="ContactUs.blade.php" class="color333">联系我们</a>
						</li>
					</ol>
				</div>
				<div class="bge8e8e8 am-padding-sm am-padding-top-lg " data-am-scrollspy="{animation:'scale-up',repeat: false}">
					<div class="width1200 bgWhite am-padding-sm am-padding-left-xl">
						<div class="am-text-center">
							<h1 class="titleGs font24 am-margin-bottom-xs colore83530">联系我们</h1>
							<p class="font16 color999 am-margin-bottom-lg">————&nbsp;&nbsp;&nbsp;ContactUs&nbsp;&nbsp;&nbsp;————</p>
						</div>
						<ul class="am-avg-sm-2 am-thumbnails am-margin-bottom-lg">
							<li class="am-margin-r">
								<p class="colore83530 font24 lxwm am-margin-bottom-sm"><span class="borderBSm">联</span>系我们</p>
								<div class="am-fl am-margin-sm marginR20"><img src="com/img/map.png" alt="" /></div>
								<div class="am-fl">

									<div class="padding10">
										<p class="font18 color333 am-padding-bottom-sm">深圳市乡之思实业有限公司</p>
										<p class="am-padding-bottom-sm">  生产厂址：广州市白云区江广东省广州市白云区江高镇神山井岗村奔马路63号</p>
										<p class="am-padding-bottom-sm"> 联系电话：秦经理13715392432</p>
										<p class="am-padding-bottom-sm">许经理：18903010806</p>
										<p>周小姐：13048001556   18922896401 </p>
									</div>
								</div>
							</li>
							<li class="am-padding-right-lg ">
								<p class="colore83530 font24 lxwm am-margin-bottom-sm"><span class="borderBSm">关</span>注我们</p>
								<div style="width: 150px;" class="am-margin-top-sm">
									<img src="com/img/ewm.png" alt="" />
								</div>
								<p class="color333 font14 am-text-center" style="width: 124px;">关注微信</p>
							</li>
						</ul>
									 <!--百度地图容器-->
									
        <div style="width:100%;height:400px;border:#ccc solid 1px;margin-top: 30px;" id="dituContent"></div>
					</div>
				</div>
			</div>
			@endsection
<script type="text/javascript">
    window.onload = function(){
    	//创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(114.2169800000,22.7204000000);;//定义一个中心点坐标
        map.centerAndZoom(point,12);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
	var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
	map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
	map.addControl(ctrl_sca);
    }

    initMap();//创建和初始化地图
    }
</script>