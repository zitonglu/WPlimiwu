$(function(){
	$('.datepicker').datepicker({//日期JS控制
		language: 'zh-CN'
	});

	$("a[name='saveProject']").click(function() {//更新专案属性
		$about = '专案名：' + $('#project_name').val();
		$about += ' 订单号：' + $('#customer_number').val();
		$about += ' 下单时间：' + $('#customer_orderTime').val();
		$about += ' 安装时间：' + $('#customer_installTime').val();
		$about += '<br>客户信息：' + $('#customer_name').val();
		$about += ' - ' + $('#customer_tel').val();
		$about += ' - ' + $('#customer_address').val();
		$("p[name='about']").html($about);
	});

	$("button#newObject").click(function(){//模拟提交
		$("form[name='rightBox']").submit();
	});

	$('input#sheetPrice').on("input propertychange",function(){//单价提交实施监控
		var result = $(this).val();
        $('input#sheetPrice').attr("value",result);
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
		$('#addtr').attr('onclick','addtr(\''+$thisTr+'\',\'after\')');
		//开启删除行的按钮
		$('#deltr').removeAttr('disabled');
		$('#deltr').attr('onclick','deltr(\''+$thisTr+'\')');
		//关闭删除整个柜体按钮
		$('#delcab').attr('disabled','disabled');
		//重新排序
		$orderNumber = $tbody.find("td[name='orderNumber']");
		for (var i = 0; i < $orderNumber.length; i++) {
			$($orderNumber[i]).text(i+1);
		}
		//数量汇总
		$total = $tbody.find("td[name='cabN']");
		$totals = 0;
		for (var i = $total.length - 1; i >= 0; i--) {
			$n = $($total[i]).text();
			if($n){
				if(!isNaN($n)){
					$n = Number($n);
					$totals += $n;
				}
			}
		}
		$tbody.find("td[name='totals']").text($totals);
		//金额汇总
		$prices = $tbody.find("td[name='cabP']");
		$totalprice = 0;
		for (var i = $prices.length - 1; i >= 0; i--) {
			$n = $($prices[i]).text();
			if($n){
				if (!isNaN($n)) {
					$n = Number($n);
					$totalprice += $n;
				}
			}
		}
		$tbody.find("td[name='totalprice']").text($totalprice);
		//金额计算，计算出行面积和金额
		$cabX = Number($(this).children("td[name='cabX']").text());
		$cabY = Number($(this).children("td[name='cabY']").text());
		$cabN = Number($(this).children("td[name='cabN']").text());
		$cabA = decimal($cabX * $cabY * $cabN / 1000000,2);
		$(this).children("td[name='cabA']").text($cabA);
		$cabU = Number($(this).children("td[name='cabU']").text());
		$cabP = decimal($cabA * $cabU,2);
		$(this).children("td[name='cabP']").text($cabP);
		//console.log($cabP);
	});
});

//增加一行
function addtr($thisTr,$where='before'){
	$arr = $thisTr.split(" ");
	$tr = $arr[0] + " tr:last";
	$length = $($tr).length;
	// $orderNumber = $length + 1;

	//判断是否存在单价
	$yuan = $('input#sheetPrice').val();
	if(!$yuan){$yuan = 0};

	$newRow = '<tr><td name="orderNumber"></td>';//序号
	$newRow += '<td>封板</td>';//项目名称
	$newRow += '<td name="cabX"></td>';//长度
	$newRow += '<td name="cabY"></td>';//宽度
	$newRow += '<td name="cabD">18</td>';//厚度
	$newRow += '<td name="cabA">0</td>';//用量
	$newRow += '<td name="cabU">'+$yuan+'</td>';//单价
	$newRow += '<td name="cabN">1</td>';//数量
	$newRow += '<td name="cabP">0</td>';//金额
	$newRow += '<td></td></tr>';//备注
	if ($length == 0) {
		$($arr[0]).prepend($newRow);
	}else{
		if ($where == 'before') {
			$($thisTr).before($newRow);
		}else{
			$($thisTr).after($newRow);
		}
	}
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
//四舍五入精确到分
function decimal(num,v){
	var vv = Math.pow(10,v);
	return Math.round(num*vv)/vv;
}