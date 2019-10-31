$(document).ready(function() {
	$('.article IMG').each(function() {
		$(this).wrap('<div class="imgSaveBox text-right"></div>');//包裹元素
		var _url = $(this).attr('src');
		var _button1 = '<span class="glyphicon glyphicon-heart-empty saveButtom"><span>';
		_button1 = '<a class="btn btn-default save">'+ _button1 +'</a>';
		_button1 = '<div class="imgbuttombox">'+ _button1 +'</div>';
		$(this).after(_button1);
		$(this).parent().find('.save').click(function() {
			if ($(this).find('.saveButtom').is('.glyphicon-heart-empty')) {
				//点击收藏时的动作
				$(this).find('.saveButtom').removeClass('glyphicon-heart-empty');
				$(this).find('.saveButtom').addClass('glyphicon-heart');
			}else{
				$(this).find('.saveButtom').addClass('glyphicon-heart-empty');
				$(this).find('.saveButtom').removeClass('glyphicon-heart');
			}
		});
	});
	$('.article .imgSaveBox').each(function() {
		$(this).hover(function() {
			$(this).find('.imgbuttombox').fadeIn();
		}, function() {
			$(this).find('.imgbuttombox').fadeOut();
		});
	});
})
// window.onbeforeunload = function(event){
// 	return confirm("确定离开此页面吗？");
// } 离开界面时弹出自定义对话框