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
				<p class="am-padding-sm am-padding-bottom-xs am-padding-top-xs cpzs font12 colore83530">新闻展示</p>
				<div>
					<ul class="am-padding-0 xwdt font1">
						@foreach($news as $key=>$val)
						<li><a href="NewsInformationDetails?id={{ $val->id }}">
							<p><span>●</span>{{ $val->title }}</p>
							<!--<div class="am-text-right font88 color999">发布于<time>2018-8-7</time></div>-->
						</a></li>
						@endforeach

					</ul>
				</div>
			</div>
@endsection