$(function(){
	$('.datepicker').datepicker({//日期JS控制
		language: 'zh-CN'
	});
	$("button[name='addOne']").click(function(){//模拟提交
		$("form[name='rightBox']").submit();
	});
	$('#tablelist tr').click(function() {//获取归属柜体
		$dataName = $(this).parent().data('name');
		$tableNumber = $(this).index();
		$thisTr = "tbody[data-name=\\'" + $dataName + "\\'] tr:eq(" + $tableNumber + ")";
		//开启增加行的按钮
		$('#addtr').removeAttr('disabled');
		$('#addtr').attr('onclick','addtr(\''+$thisTr+'\')');
		console.log($thisTr);
	});
})

//增加一行
function addtr($thisTr){
	var $newRow = '<tr><td>0</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
	$($thisTr).after($newRow);
}