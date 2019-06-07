@extends('com.Layout')

@section('content')
	<style>
		.netdom2{
			display: -webkit-box;
			-webkit-box-orient: vertical;
			-webkit-line-clamp: 2;
			overflow: hidden;
		}
		.netdom1{
			display: -webkit-box;
			-webkit-box-orient: vertical;
			-webkit-line-clamp: 1;
			overflow: hidden;
		}
	</style>
		<div id="content">
			<div class="lunbo am-padding-bottom-lg">
				<div class="am-slider am-slider-default " data-am-flexslider>
					<ul class="am-slides">
						<li><img src="com/img/banner.jpg" /></li>
						<li><img src="http://szxzsyx.oss-cn-hongkong.aliyuncs.com/ban.jpg" /></li>
						<li><img src="com/img/banner2.jpg" /></li>
					</ul>
				</div>
			</div>
			<div>
				<div class="jptj">
					<p class="am-text-center font28 am-padding-top-xl titleIndex titleIndex1 am-margin-bottom-0">乡之<span>思推</span>荐
						<!--<span class="font14 am-margin-left-sm wdtj">我的推荐</span>-->
						<a class="moreBtn  font14 color666" href="NewsInformation">更多推荐<i class="am-icon-angle-double-right am-margin-left-xs"></i></a>
					</p>
					<ul class="am-padding-0 am-margin-0 font14 jptjNav">
                        @foreach($cat as $key=>$val)
						<li>
							<a href="/?cat_id={{ $val->id }}" class="borderNone am-text-center">{{ $val->cat_name }}</a>
						</li>
                        @endforeach

					</ul>
					<div class="">
						<ul class="am-avg-sm-4 am-thumbnails jptjUl1  am-text-center am-padding-bottom-lg" data-am-scrollspy="{animation:'scale-up',delay: 500,repeat: false}">
							@foreach($goods as $key=>$val)
							<li>
								<a href="detailsPage?id={{ $val->id }}&page={{ $key }}">
									<div class="imgItem">
										<img src="{{$val->logo }}" alt="" />
									</div>
									<p class="font16 color333 am-padding-bottom-xs p1">{{ $val->goods_name }}</p>
									<p class="font14 color999 am-padding-bottom-xs">赶往新潮流</p>
									<p class="colore83530 font16">{{ $val->shop_price }}</p>
								</a>
							</li>
								@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="contentNew">
				<p class="font28 color333 contentTitlep  am-text-center am-padding-top-xl am-padding-bottom-lg">新闻动态</p>
				<div class="contentNewIn">
					<div class="contentNewLeft am-fl" data-am-scrollspy="{animation:'scale-up',delay: 500,repeat: false}">
						<div><img src="com/img/1.jpg" /></div>
						<p class="font16 white am-text-center">永远不要因为新鲜感，扔掉一直陪伴你的人 </p>
					</div>
					<div class="contentNewRight am-fl" data-am-scrollspy="{animation:'fade',delay: 500,repeat: false}">
						{{--<div class="white div1 borderBottom action">--}}
							{{--<p class="font18 weight p1 text-overflow1">文章附图非凡创想,艺术闪耀</p>--}}
							{{--<p class="font14 p2 text-overflow2">时计不仅是精准计时的工具,还得承载时代美学的引领。凭借对“艺术和时间”的非凡理解,伯诺利开创的钟表设计风格—“完美...--}}
							{{--</p>--}}
							{{--<p class="p3 font14">--}}
								{{--<span am-fl>2018-06-15</span>--}}
								{{--<a class="am-fr white" href="#">查看详细<i class="am-icon-caret-right am-margin-left-xs"></i></a>--}}
							{{--</p>--}}
						{{--</div>--}}
						@foreach($news as $key=>$val)
						<div class=" div1 div2 borderBottom">
							<p class="font18 weight p1 color333 text-overflow1 netdom1">{{ $val->title }}</p>
							<p class="font14 p2 color999 text-overflow2 netdom2">{{ $val->title2 }}
							</p>
							<p class="p3 font14">
								<span class="am-fl color999">{{ substr($val->created_at,0,10) }}</span>
								<a class="am-fr color333" href="NewsInformationDetails?id={{ $val->id }}">查看详细<i class="am-icon-caret-right am-margin-left-xs colorab2212"></i></a>
							</p>
						</div>
							@endforeach

					</div>
					<div class="am-cf font14 color666 am-text-center">
                        <a href="NewsInformation">
						<button type="button" class="indexBtn">查看更多<i class="am-icon-caret-right am-margin-left-xs"></i></button>
                        </a>
                    </div>
				</div>
			</div>

		</div>
@endsection
