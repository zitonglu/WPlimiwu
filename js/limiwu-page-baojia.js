$(function(){
	$('.datepicker').datepicker({//日期JS控制
		language: 'zh-CN'
	});

	$("button[name='addOne']").click(function(){//模拟提交
		$("form[name='rightBox']").submit();
	});
	//选中柜体thead.cabhead TR产生的变化
	$('thead.cabhead').on("click","tr",function() {
		$thead = $(this).parent();
		$tbody = $thead.next();
		$dataName = $tbody.data('name');
		$thisTr = "tbody[data-name=\\'" + $dataName + "\\'] tr:last";
		//开启H5文字说明
		$('#selectProject').text('：'+$dataName);
		//开启增加行的按钮
		$('#addtr').removeAttr('disabled');
		$('#addtr').attr('onclick','addtr(\''+$thisTr+'\')');
		//关闭删除行的按钮
		$('#deltr').attr('disabled','disabled');
		//开启删除整个柜体按钮
		$('#delcab').removeAttr('disabled');
		$('#delcab').attr('onclick','delcab(\''+$dataName+'\')');
	});
	//选中柜体tbody.cab TR产生的效果
	$('tbody.cab').on("click","tr",function() {
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
		//关闭删除整个柜体按钮
		$('#delcab').attr('disabled','disabled');
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
//删除整个柜体
function delcab($dataName){
	$thisTobdy = "tbody[data-name=\'" + $dataName + "\']";
	$thisThead = $($thisTobdy).prev();
	if(confirm("删除后无法恢复此柜体数据，您确定要删除吗？")){
		$($thisTobdy).remove();
		$($thisThead).remove();
	}
}