@extends('phone.Layout')
@section('content')
			<div id="content" class="am-margin-top-0">
				<div class="lunbo">
					<div class="am-slider am-slider-default am-margin-bottom-0" data-am-flexslider>
						<ul class="am-slides">
							<li><img src="phone/img/banner.jpg" /></li>
							<li><img src="http://szxzsyx.oss-cn-hongkong.aliyuncs.com/ban.jpg" /></li>
							<li><img src="phone/img/banner2.jpg" /></li>
						</ul>
					</div>
				</div>
				<div class="search bgWhite borderBottom8">
					<div class="searchInput">
						<a href="search">
						<img src="phone/img/search.png" alt="" class="searchImg" />
						<p>搜索音响...</p>
					</a>
					</div>
				</div>

				<p class="am-padding-sm am-padding-top-xs am-padding-bottom-xs cpzs font12 colore83530">产品展示</p>
				<div>
						<ul class="am-avg-sm-2 am-thumbnails cpzsIn  font1 am-padding-xs am-margin-0">
							@foreach($goods as $key=>$val)
								<li>
									<a href="detailsPage?id={{ $val->id }}&page={{ $key }}">
										<div class="div">
											<div class="imgs">
												<img src="phone/img/01.jpg" alt="" />
											</div>
											<p class="font11 color333 am-padding-top-xs am-padding-bottom-xs overfloatText2">{{ $val->goods_name }}</p>
											<p class="colore83530 am-text-left am-padding-xs font1 overflowH">
												<span class="colore83530">￥{{ $val->shop_price }}</span>
												<a href="/detailsPage?id={{ $val->id }}&page={{ $key }}"><span class="blue am-fr">查看</span></a>
											</p>
										</div>
									</a>
							</li>
							@endforeach

						</ul>

				</div>
			</div>
@endsection

