<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="http://szxzsyx.oss-cn-hongkong.aliyuncs.com/logo.jpg">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="phone/assets/i/app-icon72x72@2x.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="apple-touch-icon-precomposed" href="phone/assets/i/app-icon72x72@2x.png">
    <meta name="keywords" content="音响,乡之思,乡之思音响,中国音响,yinxiang,xiangzhisi">
    <meta name="description" content="乡之思音响品牌介绍
乡之思音响，来自于一份亲切的思乡情怀而起的品牌。创立于2008年，总部位于美丽繁华的经济特区---深圳！乡之思音响拥有自己的专业研发队伍，将普通的广场舞音响提升到行业的最高档次！从品质，功率，音质，外观等已经做到一流水准！
我们有自己专业的销售团队。我们在阿里巴巴，淘宝网，京东等都有自己的销售平台！我们经常直接面对消费者，能收集顾客反馈来的意见，我们根据用户群体的要求进行综合研发，经过使用顾客反馈的信息，做出顾客最实用的户外音响！
我们将本着诚信经营，专业效率，品质第一，顾客至上的经营理念，不断进行产品升级和创新，我们信守我们的承诺，以顾客满意为我们最终的目标来努力！">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="phone/assets/i/app-icon72x72@2x.png">
    <meta name="msapplication-TileColor" content="#0e90d2">
    <link rel="stylesheet" href="phone/assets/css/amazeui.min.css">
    <link rel="stylesheet" href="phone/assets/css/app.css">

    <!--[if (gte IE 9)|!(IE)]><!--[if (gte IE 9)|!(IE)]><!-->
    <script src="phone/js/jquery-2.1.0.js"></script>
    <!--<![endif]-->
    <!--[if lte IE 8 ]>
    <script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="phone/assets/js/amazeui.ie8polyfill.min.js"></script>
    <![endif]-->
    <script src="phone/assets/js/amazeui.min.js"></script>
    <title>乡之思</title>
    <link rel="stylesheet" type="text/css" href="phone/font/iconfont.css" />
    <link rel="stylesheet" href="phone/css/common.css" />
    <script src="phone/js/common.js"></script>
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
    <header class="am-g header">
        <!-- <img src="phone/img/logo.png" class="logo am-fl" /> -->
        <button class="back am-icon-angle-left" type="button" onclick="javascript :history.back(-1);"></button>
        <p class="am-text-center font12">乡之思音响官方网站</p>
        <button type="button" class="am-icon-navicon am-fr NavToggle " data-am-offcanvas="{target: '#doc-oc-demo2', effect: 'push'}"></button>
    </header>
    <!-- 侧边栏内容 -->
    <div id="doc-oc-demo2" class="am-offcanvas">
        <div class="am-offcanvas-bar">
            <div class="am-offcanvas-content am-text-center">
                <p class="am-padding-sm white"><img src="phone/img/logo.png" style="width: 70%;" /></p>
                <ul class="am-avg-sm-2 am-thumbnails doc-oc-demo2Ul font1">

                    <li class="active">
                        <a href="/"><div class="item"><i class="icon iconfont icon-shouye"></i></div>首页</li></a>
                    <li>
                        <a href="{{ asset('/contactUs') }}"><div class="item"><i class="icon iconfont icon-wode"></i></div>品牌介绍</li></a>
                    <li>
                        <a href="{{ asset('/productDisplay') }}"><div class="item"><i class="icon iconfont icon-liebiaozhanshi"></i></div>产品展示</li></a>
                    <li>
                        <a href="{{ asset('/NewsInformation') }}"><div class="item"><i class="icon iconfont icon-news_icon"></i></div>新闻动态</li></a>
                    <li>
                        <a href="{{ asset('/MessageBoard') }}"><div class="item"><i class="icon iconfont icon-message"></i></div>留言板</li></a>
                    <li>
                        <a href="{{ asset('/AboutUs') }}"><div class="item"><i class="icon iconfont icon-lianxi1"></i></div>联系我们</li></a>
                </ul>
            </div>
        </div>
    </div>

    @yield('content')

    <footer class="am-g white am-text-center">
        <ul class="am-avg-sm-2 am-thumbnails footerUl  font88">
            <li class="active">
                <a href="AboutUs"><div class="item"><i class="icon iconfont icon-map"></i></div>在线地图</a></li>
            <li>
                <a href="MessageBoard"><div class="item"><i class="icon iconfont icon-message "></i></div>在线留言</a></li>
        </ul>
    </footer>
</div>
</body>

</html>
