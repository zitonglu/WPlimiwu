$(document).ready(function() {
	if ($('#src').val()) {
		var _arr = $('#src').val().split(',');
	}else{
		var _arr = new Array();
	}
	$('.article IMG').each(function() {
		$(this).wrap('<div class="imgSaveBox text-right"></div>');//包裹元素
		var _url = $(this).attr('src');
		var _button1 = '<span class="glyphicon saveButtom"><span>';
		_button1 = '<a class="btn btn-default save">'+ _button1 +'</a>';
		_button1 = '<div class="imgbuttombox">'+ _button1 +'</div>';
		$(this).after(_button1);
		if($.inArray(_url,_arr) == -1){
			$(this).parent().find('.saveButtom').addClass('glyphicon-heart-empty');
		}else{
			$(this).parent().find('.saveButtom').addClass('glyphicon-heart');
		}
		$(this).parent().find('.save').click(function(){
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
	$('#saveButtom').mousedown(function(){
		_str = _arr.join(',');
		$('#src').attr("value",_str);
	});
	setTimeout(function(){$('#returnOK').fadeOut()},5000);
	var _dataReturn = $('#customerID').attr('data-return');
	if ( _dataReturn != '') {
		$('#customerID').val(_dataReturn);
	}

	// 侧栏滚动
	jQuery('.sidebar').theiaStickySidebar({
          additionalMarginTop: 30
    });
	// 放大图片控制
    $('#viewer').viewer();
    // 取消社交媒体设置
    $('.os-login-box .os-wechat').removeAttr('onclick');
    $('.os-login-box .os-wechat').wrap('<a tabindex="0" data-placement="bottom" role="button" data-toggle="popover" data-trigger="focus" title="登录建设中" data-content="该社交媒体在建设中,微信搜一搜：厘米屋家居空间设计"></a>');
    $('[data-toggle="popover"]').popover();
    	// 友情链接
	$('#menu-link li a').attr("target","_blank");
	$('#menu-link li a').attr("rel","nofollow");
})