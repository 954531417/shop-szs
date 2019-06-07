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
							<a href="#" class="color333">首页</a>
						</li>
						<li>
							<a href="#" class="color333">新闻动态</a>
						</li>

					</ol>

				</div>
				<div class="bge8e8e8 am-padding-sm am-padding-top-lg">
					<div class="width1200">
						<div class="detailsInP ">
							<div class="detailsIn am-text-center">
								<div class="borderBottom">
									<h1 class="detailsInTitle color333">{{ $news->title }}</h1>
									<p class="font14 color999 detailsInTime">发布时间：<span>{{ substr($news->created_at,0,10) }}</span></p>
								</div>
								<div class="detailsInText am-text-left font14 color666 borderBottom">
									{!! $news->news !!}

								</div>
								<div class="am-text-center detailsInTextBtn color666 ">
								@if(!empty($top[0]))
									<button class=" am-fl font14">
										<a href="{{ asset('NewsInformationDetails?id='.$top[0]->id) }}">
											<i class="am-icon-angle-left am-padding-right-xs"></i>
											上一条
										</a>

							</button>
									@endif
									<a href="NewsInformation">
										<button class=" detailsInTextBtn2 font14">
											<i class="am-icon-bars am-padding-right-xs"></i>
											返回列表

										</button>
									</a>

									@if(!empty($botton[0]))
									<a href="{{asset('NewsInformationDetails?id='.$botton[0]->id)}}">
									<button class=" am-fr font14">

											下一条
											<i class="am-icon-angle-right am-padding-right-xs"></i>


							</button>
									</a>
									@endif
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
@endsection
<script type="text/javascript" src="com/js/NativeShare.js"></script>