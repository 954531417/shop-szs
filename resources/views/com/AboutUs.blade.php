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
							<a href="AboutUs.blade.php" class="color333">关于我们</a>
						</li>

					</ol>
					
				</div>
			<div class="bge8e8e8 am-padding-sm am-padding-top-lg am-padding-bottom-lg"  data-am-scrollspy="{animation:'scale-up',delay: 500,repeat: false}">
				<div class="am-padding-sm bgWhite width1200">
					<div class="am-text-center">
						<h1 class="titleGs font24 am-margin-bottom-xs colore83530">关于我们</h1>
						<p class="font16 color999 am-margin-bottom-lg">————&nbsp;&nbsp;&nbsp;ContactUs&nbsp;&nbsp;&nbsp;————</p>
					</div>
					<div class="recordRightParent am-text-center am-margin-bottom-lg">
						
					
						<div class="font16">
							<p class="am-padding-sm am-padding-bottom-lg  am-padding-top-0 am-text-center detailsLine font18">品牌名：乡之思音响 </p>
							<div class="overflowH">							
								<p class="am-padding-sm am-padding-top-0 am-text-center detailsLine font12 color999 am-fl">品牌创建时间：2005　　产地：广东·广州</p>
								<p class="font12 color999 borderBottom11 am-padding-bottom-xs am-fr"><span>发布日期：</span><time>2018-05-01</time>阅读数：<span>1000</span></p>
							</div>
							<p class="am-padding-sm am-text-left detailsLine detailsLineIndex">乡之思音响品牌介绍
乡之思音响，来自于一份亲切的思乡情怀而起的品牌。创立于2008年，总部位于美丽繁华的经济特区---深圳！乡之思音响拥有自己的专业研发队伍，将普通的广场舞音响提升到行业的最高档次！从品质，功率，音质，外观等已经做到一流水准！
我们有自己专业的销售团队。我们在阿里巴巴，淘宝网，京东等都有自己的销售平台！我们经常直接面对消费者，能收集顾客反馈来的意见，我们根据用户群体的要求进行综合研发，经过使用顾客反馈的信息，做出顾客最实用的户外音响！
我们将本着诚信经营，专业效率，品质第一，顾客至上的经营理念，不断进行产品升级和创新，我们信守我们的承诺，以顾客满意为我们最终的目标来努力！</p>
						</div>
						<div class="borderBottom am-margin-lg"></div>
						<p class="am-text-right font14 color999">文章分类： 品牌介绍</p>
						<div>
							<div class="fxBtn am-text-left">
									
									<button onclick="shareToSinaWB(event)"><img src="com/img/wb.png" alt="" /></button>
									<button onclick="shareToQzone(event)"><img src="com/img/kj.png" alt="" /></button>
									<button  onclick="shareToTieba(event)"><img src="com/img/bdtb.png" alt="" /></button>
									<button onclick="shareToQQwb(event)"><img src="com/img/txwb.png" alt="" /></button>
								</div>
						</div>
					</div>
				</div>
			</div>
			</div>
					@endsection
<script type="text/javascript" src="com/js/NativeShare.js"></script>
