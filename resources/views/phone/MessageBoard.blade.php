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
				<p class="am-padding-sm am-padding-bottom-xs am-padding-btop-xs cpzs font12 colore83530">新闻动态</p>
				<div>
				<form id="form" class="am-form am-padding-sm txkdgs am-padding-bottom-0 font1 docPhone am-text-center">
								<p class="font1 am-text-left am-padding-bottom-xs">姓名</p>
								<div class="am-form-group">
									<input name="name" type="tel" placeholder="请输入姓名" class=" color999 font1 textbcBtn" >
								</div>
								<p class="font1 am-text-left am-padding-bottom-xs">邮箱</p>
								<div class="am-form-group">
									<input type="tel"  name="emali" placeholder="请输入邮箱" class=" color999 font1 textbcBtn">
								</div>
								<p class="font1 am-text-left am-padding-bottom-xs">电话</p>
								<div class="am-form-group">
									<input type="tel" name="phone" placeholder="请输入手机号码" class=" color999 font1 textbcBtn">
								</div>
								<p class="font1 am-text-left am-padding-bottom-xs">内容</p>
								<div class="am-form-group">
									<textarea  name="message" rows="5" cols=""  class="font1" placeholder="请输入内容"></textarea>
								</div>
								<button type="button" onclick="sub()" class="MessageBtn">提交</button>
							</form>
				</div>
			</div>

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

@endsection