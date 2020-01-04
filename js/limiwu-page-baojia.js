$(function(){
	$('.datepicker').datepicker({//日期JS控制
		language: 'zh-CN'
	});

	$("button[name='addOne']").click(function(){//模拟提交
		$("form[name='rightBox']").submit();
	});

	$('#tablelist tbody').on("click","tr",function() {//获取归属柜体
		$tbody = $(this).parent();
		$dataName = $tbody.data('name');
		$tableNumber = $(this).index();
		$thisTr = "tbody[data-name=\\'" + $dataName + "\\'] tr:eq(" + $tableNumber + ")";
		//开启H5文字说明
		$('#selectProject').text('：'+$dataName);
		//开启增加行的按钮
		$('#addtr').removeAttr('disabled');
		$('#addtr').attr('onclick','addtr(\''+$thisTr+'\')');
		//开启删除行的按钮
		$('#deltr').removeAttr('disabled');
		$('#deltr').attr('onclick','deltr(\''+$thisTr+'\')');
		//console.log($thisTr);
	});
});

//增加一行
function addtr($thisTr){
	var $newRow = '<tr><td data-name="xuhao">0</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
	$($thisTr).after($newRow);
}
//删除当前行
function deltr($thisTr){
	$($thisTr).remove();
}