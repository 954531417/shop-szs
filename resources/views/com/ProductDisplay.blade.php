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
				<div class="am-g width1200">
					<ol class="am-breadcrumb am-breadcrumb-slash">
						<li>
							<a href="index.html" class="color333">首页</a>
						</li>
						<li>
							<a href="ProductDisplay.blade.php" class="color333">产品展示</a>
						</li>

					</ol>

				</div>
				<div class="am-g width1200">
					<div class="recordLeftParent am-u-sm-3 ">
						<ul class="recordLeft am-padding-right-lg font16">
							@foreach($cat as $key=>$val)
							<li class="@if($val->id == $cat_id) action @endif">
								<a href="/productDisplay?id={{ $val->id }}">{{ $val->cat_name }}{{ $val->id }} </a>
							</li>
							@endforeach

						</ul>
					</div>
					<div class="recordRightParent am-u-sm-9 am-text-center borderNone am-padding-0">
						<div class="">
							<ul class="am-avg-sm-3 am-thumbnails jptjUl1  am-text-center my-animation-delay-500" data-am-scrollspy="{animation:'scale-up',delay: 500,repeat: false}">
								@foreach($goods as $key=>$val)
								<li>
									<a href="/detailsPage?id={{ $val->id }}">
										<div class="imgItem">
											<img src="{{$val->logo}}" alt="" />
										</div>
										<p class="font16 color333 am-padding-bottom-xs p1">{{ $val->goods_name }}</p>
										<p class="font14 color999 am-padding-bottom-xs">赶往新潮流</p>
										<p class="colore83530 font16">￥{{$val->shop_price}}起</p>
									</a>
								</li>
									@endforeach
							</ul>
						</div>
						<div class="pages">
							<ul class="am-pagination am-pagination-centered ">
								<li class="am-disabled">
									<a href="#">&laquo;</a>
								</li>
								<li class="am-active">
									<a href="#">1</a>
								</li>
								<li>
									<a href="#">2</a>
								</li>
								<li>
									<a href="#">3</a>
								</li>
								<li>
									<a href="#">4</a>
								</li>
								<li>
									<a href="#">5</a>
								</li>
								<li>
									<a href="#">&raquo;</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
@endsection