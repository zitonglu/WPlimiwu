$(document).ready(function() {
	var _arr = new Array();
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
				_arr.push(_url);
			}else{
				$(this).find('.saveButtom').addClass('glyphicon-heart-empty');
				$(this).find('.saveButtom').removeClass('glyphicon-heart');
				_arr.splice($.inArray(_url,_arr),1);
			}
		});
	});
	$('#CopyrightTitle').click(function() {//测试用的，点版权声明
		var _str = _arr.join(',');
		alert(_str);
	});
})
// window.onbeforeunload = function(event){
// 	return confirm("确定离开此页面吗？");
// } 离开界面时弹出自定义对话框