@extends('com.Layout')
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
				<div class="am-g width1200 ">
					<ol class="am-breadcrumb am-breadcrumb-slash">
						<li>
							<a href="index.html" class="color333">首页</a>
						</li>
						<li>
							<a href="DetailsPage.blade.php" class="color333">商品详情</a>
						</li>

					</ol>
				</div>
				<div class=" am-padding-bottom-lg bge8e8e8  am-padding-lg">
					<div class="recordRightParent am-text-center width1200 bgWhite">
						<h1 class="titleGs font24">{{ $goods->goods_name }}</h1>
						<!--<p class="font12 color999 borderBottom11 am-padding-bottom-sm"><span>发布日期：</span><time>2018-05-01</time>阅读数：<span>1000</span></p>-->
						<div class="am-g am-margin-bottom-lg">
							<div class="font14 am-u-sm-8">
								<p class="am-padding-bottom-xs am-text-left detailsLine">价格：<span class="font18 color333">￥{{ $goods->shop_price }}</span></p>
								@foreach($goods->attr as $key=>$val)
								<p class="am-padding-bottom-xs am-text-left detailsLine">{{ $val->attr_name }}：<span class="font16">{{ $val->attr_value }}</span></p>
									@endforeach
							</div>
							<div class="am-u-sm-4">
								<img src="{{ $goods->logo }}" />
								<div class="fxBtn am-text-left">
									
									<button onclick="shareToSinaWB(event)"><img src="com/img/wb.png" alt="" /></button>
									<button onclick="shareToQzone(event)"><img src="com/img/kj.png" alt="" /></button>
									<button  onclick="shareToTieba(event)"><img src="com/img/bdtb.png" alt="" /></button>
									<button onclick="shareToQQwb(event)"><img src="com/img/txwb.png" alt="" /></button>
								</div>
							</div>
						</div>
						<div class="font14 am-text-left detailsLine">
							<div>
								@if(!empty($top[0]))
								<a href="detailsPage?id={{$top[0]->id}}" class="color333">上一篇：{{ $top[0]->goods_name }}</a>
								@endif
							</div>
							<div>
								@if(!empty($botton[0]))
								<a href="detailsPage?id={{$botton[0]->id}}" class="color333 action">下一篇：{{ $botton[0]->goods_name }}</a>
									@endif
							</div>
						</div>
					</div>
				</div>

			</div>

@endsection
<script type="text/javascript" src="con/js/NativeShare.js"></script>
