@extends('phone.Layout')
@section('content')
<style type="text/css">
	header .logo{
		margin-left: 40px;
	}
</style>
			<div class="header" style="margin-bottom: 4rem;">
				<!-- <button class="back am-icon-angle-left" type="button" onclick="javascript :history.back(-1);"></button>

				<button type="button" class="am-icon-navicon am-fr NavToggle " data-am-offcanvas="{target: '#doc-oc-demo2', effect: 'push'}"></button> -->
				<div class="am-slider am-slider-default am-margin-bottom-0" data-am-flexslider id="demo-slider-0">
					<ul class="am-slides">
						<li><img src="phone/img/01.jpg" /></li>

					</ul>
				</div>
				<p class="am-padding-sm font12 am-padding-bottom-0">{{ $goods->goods_name }}</p>
				<p class="am-padding-sm font14 borderBottom jqMk am-padding-top-0">￥{{ $goods->shop_price }}</p>
				@foreach($goods->attr as $key=>$val)
				<div class="am-g font1 borderBottom am-padding-xs">
					<div class="am-u-sm-4">{{ $val->attr_name }}</div>
					<div class="am-u-sm-8">￥{{ $val->attr_value }}</div>
				</div>
				@endforeach

			</div>
@endsection