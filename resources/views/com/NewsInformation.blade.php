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
							<a href="NewsInformation.blade.php" class="color333">新闻动态</a>
						</li>

					</ol>

				</div>

				<div class="am-text-center">
					<h1 class="titleGs font24 am-margin-bottom-xs colore83530">新闻动态</h1>
					<p class="font16 color999 am-margin-bottom-lg">————&nbsp;&nbsp;&nbsp;News Information&nbsp;&nbsp;&nbsp;————</p>
				</div>
				<div class="width1200">
					<div class="consultationP">
						
						@foreach($news as $key=>$val)
							<div class="consultation" data-am-scrollspy="{animation:'slide-left',repeat: false}">
								<div class="white consultationTime am-fl am-text-center ">
									<p class="font36 p1">{{ substr($val->created_at,8,2) }}</p>
									<p class="font14">{{ substr($val->created_at,0,4) }} {{ substr($val->created_at,5,2) }}</p>
								</div>
								<div class="consultationItem am-fr">
									<a href="NewsInformationDetails?id={{ $val->id }}">
										<div class="img am-fl">
											<img src="{{ $val->logo }}" alt="" />
											{{--<img src="com/img/1.jpg" alt="" />--}}
										</div>
										<div class="am-fr consultationItemRight">
											<p class="borderBottom font20 color333 p1">{{ $val->title }}</p>
											<p class="font14 color666 p2">{{ $val->title2 }}
											</p>
										</div>
									</a>
								</div>
							</div>
						@endforeach

						<div class="pagemk">
							<ul class="am-pagination">
								<li class="am-disabled">
									<a href="{{ $page==1 ? '#': 'NewsInformation?page='.strval($page-1) }}">上一页</a>
								</li>
								<?php for($i=1;$i<=$count;$i++ ){  ?>
								<li class="{{ $page==$i ? 'am-active':'' }}">
									<a href="NewsInformation?page={{ $i }}">{{ $i }}</a>
								</li>
								<?php }?>
								<li>
									<a href="{{ $page==$count ? '#': 'NewsInformation?page='.strval($page+1 )}}">下一页</a>
								</li>

								</li>
								<li>
									<a href="#">末页</a>
								</li>
							</ul>
						</div>
					</div>

				</div>

			</div>
@endsection
<script type="text/javascript" src="com/js/NativeShare.js"></script>