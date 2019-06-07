<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="http://szxzsyx.oss-cn-hongkong.aliyuncs.com/logo.jpg" charset="utf-8">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="{{ asset('com/assets/i/app-icon72x72@2x.png') }}" charset="utf-8">
    <meta name="keywords" content="音响,乡之思,乡之思音响,中国音响,yinxiang,xiangzhisi">
    
    <meta name="description" content="乡之思音响品牌介绍
乡之思音响，来自于一份亲切的思乡情怀而起的品牌。创立于2008年，总部位于美丽繁华的经济特区---深圳！乡之思音响拥有自己的专业研发队伍，将普通的广场舞音响提升到行业的最高档次！从品质，功率，音质，外观等已经做到一流水准！
我们有自己专业的销售团队。我们在阿里巴巴，淘宝网，京东等都有自己的销售平台！我们经常直接面对消费者，能收集顾客反馈来的意见，我们根据用户群体的要求进行综合研发，经过使用顾客反馈的信息，做出顾客最实用的户外音响！
我们将本着诚信经营，专业效率，品质第一，顾客至上的经营理念，不断进行产品升级和创新，我们信守我们的承诺，以顾客满意为我们最终的目标来努力！">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="y
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('com/assets/i/app-icon72x72@2x.png') }}" charset="utf-8">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="{{ asset('com/assets/i/app-icon72x72@2x.png') }}">
    <meta name="msapplication-TileColor" content="#0e90d2">
    <link rel="stylesheet" href="{{ asset('com/assets/css/amazeui.min.css') }}" charset="utf-8">
    <link rel="stylesheet" href="{{ asset('com/assets/css/app.css') }}" charset="utf-8">
    <!--[if (gte IE 9)|!(IE)]><!--[if (gte IE 9)|!(IE)]><!-->
    <script src="{{ asset('com/js/jquery-2.1.0.js') }}"></script>
    <!--<![endif]-->
    <!--[if lte IE 8 ]>
    <script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="{{ asset('com/assets/js/amazeui.ie8polyfill.min.js')}}"></script>
    <![endif]-->
    <script src="{{ asset('com/assets/js/amazeui.min.js') }}"></script>
    <title>乡之思官方网站</title>
    <link rel="stylesheet" href="{{ asset('com/css/common.css') }}" />
    <script src="{{ asset('/com/js/common.js') }}"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?2cf2cbb37b5aa974e8acb1d60c4193fe";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</head>
<body>
<div id="wrap">
    <header class="am-g">
        <div class="header">
            <div class="logo am-fl">
                <a href="#"><img src="com/img/logo.png" alt="" /></a>
            </div>
            <div class=" am-topbar-collapse am-u-md-12 am-u-lg-7 am-fr MaxshowNav">
                <!--	<div class="minBtnNav am-fr"><i class="am-icon-bars"></i></div>-->
                <ul class="am-nav am-nav-pills am-topbar-nav nav-ul font16">
                    <li class="
                    @if($nav=='index')
                            action-nav
                    @endif">
                        <a href="/">首页</a>
                    </li>
                    <li class="
                    @if($nav=='au')
                            action-nav
                    @endif">
                        <a href="AboutUs">关于我们</a>
                    </li>
                    <li class="am-dropdown @if($nav=='pd') action-nav @endif">
                        <a href="javascript:" class="am-dropdown-toggle">产品展示</a>
                        <ul class="am-dropdown-content am-padding-bottom-0 nav-ulIn">
                            @foreach($cat as $key=>$val)
                            <li>
                                <a href="/productDisplay?id={{$val->id}}" class="borderNone am-text-center">{{$val->cat_name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="@if($nav=='ni') action-nav @endif">
                        <a href="NewsInformation">新闻动态</a>
                    </li>
                    <li class="@if($nav=='mb') action-nav @endif">
                        <a href="MessageBoard">在线留言</a>
                    </li>
                    <li class="@if($nav=='cu') action-nav @endif">
                        <a href="contactUs">联系我们</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

@yield('content')

    <footer class="am-g">
        <div class="footer">
            <div class="footer-top">
                <p class="am-fl white">友情链接：</p>
                <ul class="am-fl am-margin-0 am-padding-0">
                    <li class="am-fl">
                        <a href="#" class="white font14">乡之思 </a>
                    </li>
                    <li class="am-fl marginLR10 white am-padding-left-xs am-padding-right-xs">|</li>
                    <li class="am-fl">
                        <a href="#" class="white font14">首页</a>
                    </li>
                </ul>
                <div class="am-fr backTop"><img src="com/img/top.png" alt="" /></div>
            </div>
            <div class="footer-bottom clear am-margin-top-lg">
                <div class="am-g">

                    <div class="am-u-sm-10 font14">
                        <p class="am-padding-sm font18 white am-padding-left-0">联系我们</p>
                        <p class="white paddingB6 ">深圳市乡之思实业有限公司 </p>
                         <p class="white paddingB6 "> 生产厂址：广州市白云区江广东省广州市白云区江高镇神山井岗村奔马路63号 </p>
                        <p class="white paddingB6">Email：gdcaca@sysucc.org.cn</p>
                        <p class="white paddingB15">ICP备案：粤ICP备14077221号</p>
                    </div>
                    <div class="am-u-sm-2 ">
                        <div>
                            <img src="com/img/ewm.png" alt="" />
                        </div>
                        <p class="white font14 am-text-center" style="width: 124px;">关注微信</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footerBottm color999 font14 am-text-center">
            <p>Copyright ©2017 广州市白云区神山金之声音响厂 版权所有</p>
        </div>
    </footer>
</div>
</body>
</html>
{{--<script src="{{ asset('com/js/jquery-2.1.0.js') }}"></script>--}}
<script>

    //	轮播下面的图片特效
    $(".jptjUl li").mouseenter(function() {
        var $this = $(this);
        $this.find(".height6").stop().animate({
            "width": "100%"
        }, 400)

    })
    $(".jptjUl li").mouseleave(function() {
        var $this = $(this);
        $this.find(".height6").stop().animate({
            "width": "0"
        }, 400)

    })

</script>
