@extends('phone.Layout')
@section('content')
			<div id="content" class="am-margin-top-0">
				<p class="am-padding-xs font12 am-padding-bottom-0 am-padding-top-0  am-text-center">{{ $news->title }}</p>
				<div class="am-padding-xs font1">
					{!! $news->news !!}
				</div>
			</div>

			<footer class="am-g white am-text-center">
				<ul class="am-avg-sm-2 am-thumbnails footerUl  font88">
					<li class="active">
						<a href=""><div class="item"><i class="icon iconfont icon-map"></i></div>在线地图</a></li>
					<li>
						<a href="MessageBoard.blade.php"><div class="item"><i class="icon iconfont icon-message "></i></div>在线留言</a></li>
				</ul>
			</footer>
		</div>
			@endsection