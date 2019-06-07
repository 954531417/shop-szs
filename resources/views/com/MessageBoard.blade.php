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
							<a href="ContactUs.blade.php" class="color333">在线留言</a>
						</li>
					</ol>					
				</div>
			<div class="bge8e8e8 am-padding-sm am-padding-top-lg">
				<div class="width1200 bgWhite am-padding-sm">
						<div class="am-text-center">
							<h1 class="titleGs font24 am-margin-bottom-xs colore83530">留言板</h1>
							<p class="font16 color999 am-margin-bottom-lg">————&nbsp;&nbsp;&nbsp;Message Board&nbsp;&nbsp;&nbsp;————</p>
					<form id="form" class="am-form classShop am-padding-sm">
					<div class="inputBg1">
						<label for="name" class="font16 color333  am-text-left xingxing xingxing1">姓名</label>
						<input type="text" id="name" name="name" placeholder="请输入姓名"/>
					</div>
					<div class="inputBg1 ">
						<label for="phone"  class="font16 color333  am-text-left xingxing xingxing1">联系电话</label>
						<input type="text" name="phone" id="phone" placeholder="请输入联系电话"/>
					</div>
					<div class="inputBg1">
						<label for="email1" class="font16 color333  am-text-left xingxing xingxing1">E-mail</label>
						<input type="email" id="email1" name="emali" placeholder="请输入邮箱" />
					</div>
					<div class="inputBg1">
						<select name="satisfy" >
							<option value="">请选择产品的满意程度</option>
							<option value="1">非常满意</option>
							<option value="2">一般</option>
							<option value="3">不满意</option>
						</select>
					</div>
					<div class="inputBg1 ">

						<textarea class="ly font14" rows="10" name="message" id="doc-ta-1" placeholder="留言："></textarea>
					</div>
					<div><button type="button" onclick="sub()" class="am-btn  clickBtn">提交留言</button></div>
				</form>

				</div>
			</div>
			</div>
				@endsection
				<script src="{{ asset('com/js/jquery-2.1.0.js') }}"></script>
<script type="text/javascript" src="com/js/NativeShare.js"></script>
				<script type="text/javascript">
					function sub() {
                        var data = $('#form').serialize();
                        $.post('push',data,function (res) {
							if(res.error==0){
							    alert('提交成功')
							}else {
								alert(res.content)
							}
                        })
                    }

				</script>
