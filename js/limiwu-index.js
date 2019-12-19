$(document).ready(function() {
	// from:www.cnblogs.com/aleafo/p/3695816.html
	var $container = $('#masonry');
	$('#masonry').infinitescroll({
	        navSelector : "#nav-below",
	        nextSelector: "#nav-below #older_posts a",
	        itemSelector: ".masonrybox",
	        extraScrollPx: 10,//滚动条距离底部多少像素的时候开始加载，默认150
	        bufferPx     : 40,//载入信息的显示时间，时间越大，载入信息显示时间越短
	        animate      : true, //当有新数据加载进来的时候，页面是否有动画效果，默认没有
	    },function(newElements) {
	　　　　　//先隐藏
	        var $newElems = $( newElements ).css({ opacity: 0 });
	        $newElems.imagesLoaded(function(){
	　　　　　　//图片显示后再进行masonry渲染
	          $newElems.animate({ opacity: 1 });
	          $container.masonry( 'appended', $newElems, true );
	        });
	    });
	$('#masonry').imagesLoaded(function(){
	    $('#masonry').masonry();
	});

	$('[data-toggle="popover"]').popover();

	$('#tagcloud .tag-cloud-link').addClass('btn btn-default');
})