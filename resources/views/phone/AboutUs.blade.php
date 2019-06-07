@extends('phone.Layout')
@section('content')
	<div id="content" class="am-margin-top-0">
		<div class="lunbo">
			<div class="am-slider am-slider-default am-margin-bottom-0" data-am-flexslider>
				<ul class="am-slides">
					<li><img src="phone/img/banner.jpg" /></li>
					<li><img src="phone/img/banner1.jpg" /></li>
					<li><img src="phone/img/banner2.jpg" /></li>
				</ul>
			</div>
		</div>
		<div class="am-text-center">
			<h1 class="font14 am-margin-top-sm am-margin-bottom-0 colore83530">_联系我们</h1>
			<p class="font1 color999 am-margin-bottom-sm">————&nbsp;&nbsp;&nbsp;About Us&nbsp;&nbsp;&nbsp;————</p>
		</div>
		<div class="am-padding-xs font11">
			<p class=" ">深圳市乡之思实业有限公司</p>
			<p class=" ">生产厂址：广州市白云区江广东省广州市白云区江高镇神山井岗村奔马路63号</p>
			<p>联系电话：秦经理13715392432</p>
			<p>许经理：18903010806 </p>
			<p>业务员电话：周小姐：13048001556   18922896401</p>

		</div>
		<!--百度地图容器-->
		<div id="dituContent" style="height: 400px;" class="am-margin-top-sm"></div>
		@endsection
		<script>
            window.onload = function(){
                //创建和初始化地图函数：
                function initMap() {
                    createMap(); //创建地图
                    setMapEvent(); //设置地图事件
                    addMapControl(); //向地图添加控件
                }

                //创建地图函数：
                function createMap() {
                    var map = new BMap.Map("dituContent"); //在百度地图容器中创建一个地图
                    var point = new BMap.Point(114.2169800000,22.7204000000); //定义一个中心点坐标
                    map.centerAndZoom(point, 12); //设定地图的中心点和坐标并将地图显示在地图容器中
                    window.map = map; //将map变量存储在全局
                }

                //地图事件设置函数：
                function setMapEvent() {
                    map.enableDragging(); //启用地图拖拽事件，默认启用(可不写)
                    map.enableScrollWheelZoom(); //启用地图滚轮放大缩小
                    map.enableDoubleClickZoom(); //启用鼠标双击放大，默认启用(可不写)
                    map.enableKeyboard(); //启用键盘上下左右键移动地图
                }

                //地图控件添加函数：
                function addMapControl() {
                    //向地图中添加缩放控件
                    var ctrl_nav = new BMap.NavigationControl({
                        anchor: BMAP_ANCHOR_TOP_LEFT,
                        type: BMAP_NAVIGATION_CONTROL_LARGE
                    });
                    map.addControl(ctrl_nav);
                    //向地图中添加缩略图控件
                    var ctrl_ove = new BMap.OverviewMapControl({
                        anchor: BMAP_ANCHOR_BOTTOM_RIGHT,
                        isOpen: 1
                    });
                    map.addControl(ctrl_ove);
                    //向地图中添加比例尺控件
                    var ctrl_sca = new BMap.ScaleControl({
                        anchor: BMAP_ANCHOR_BOTTOM_LEFT
                    });
                    map.addControl(ctrl_sca);
                }

                initMap(); //创建和初始化地图
            }

		</script>