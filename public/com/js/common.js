$(function(){
		//导航栏的点击切换改变样式
	$(".nav-ul li").on("mouseenter", function() {
		$(this).find('.am-dropdown-content').show().end().siblings().find('.am-dropdown-content').hide()
	})
		//返回顶部
	$(".backTop").on("click", function() {
		$("html,body").animate({
			scrollTop: 0
		}, 500);
	})
})
