@extends('phone.Layout2')
@section('content')
		<div id="wrap">
				<header class="headerSearch">
					<form id="search" action="search" method="get" >
						<button class="am-icon-angle-left backBtn">
						</button>
						<input name="goods_name" type="text" />
						<a href="" onclick="document.getElementById('search').submit();return false" >
						<span class="white am-fr font11" >搜索</span>
						</a>
					</form>

			</header>
		<div id="content">
			<ul class="am-avg-sm-2 am-thumbnails cpzsIn  font1 am-padding-xs am-margin-0">
				@foreach($goods as $key=>$val)
								<li>
									<a href="detailsPage?id={{ $val->id }}">
										<div class="div">
											<div class="imgs">
											<img src="{{$val->logo}}" alt="" />
										</div>
										<p class="font11 color333 am-padding-top-xs am-padding-bottom-xs">{{ $val->goods_name }}</p>
										<p class="colore83530 am-text-left am-padding-xs font1 overflowH">
											<span>￥{{ $val->shop_price }}</span>
											<span class="blue am-fr ">查看</span>
										</p>
										</div>
									</a>
							</li>
					@endforeach
						</ul>

		</div>
		
		</div>
@endsection