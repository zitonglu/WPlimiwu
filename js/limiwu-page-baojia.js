$(function(){
	//日期JS控制
	$('.datepicker').datepicker({
		language: 'zh-CN'
	});

	//隐藏竖板和层板
	$('#cabRiserBox').hide();
	$('#cabLaminateBox').hide();

	//新建柜体
	$('#newcab').on('click',function() {
		$cabName = $('input[name="cab_name"]').val();
		if ($cabName == '') { return alert('请填写柜体名称');};
		$cabHeight = $('input[name="cab_Height"]').val();
		$cabWidth = $('input[name="cab_Width"]').val();
		$cabDepth = $('input[name="cab_Depth"]').val();
		if ($cabHeight == '' || $cabWidth == '' || $cabDepth == '') { 
			return alert('请填写柜体尺寸数据');
		};
		$cabMaterial = $('input[name="material"]').val();
		$cabSheetPrice = $('input[name="sheetPrice"]').val();
		$cabNumber = $('input[name="LM_number"]').val();
		if ($cabMaterial == '' || $cabSheetPrice == '' || $cabNumber == '') { 
			return alert('请填写材料及价格数据');
		};

		newTableBox($cabName,$cabHeight,$cabWidth,$cabDepth,$cabMaterial,$cabNumber,$cabSheetPrice);
	});

	//实时监控input输入值
	$('input').on("input propertychange",function() {
		var $result = $(this).val();
		$(this).attr("value",$result);
		$name = $(this).attr('name');
		if ($name == 'customer_tel') {//监控电话是否正确
			$telNumber = /^1[345789]\d{9}$/;
			if ($telNumber.test($result)) {
        		$('button[name="newProject"]').removeAttr('disabled');
        	}
		}
	});

	//盒模型运算方法
	$("select[name='cabModel']").change(function(){
		$cabDesign = $(this).val();
		if ($cabDesign) {
			$('body').append($("<script>").attr({
			    type:"text/javascript",
			    src:$('input[name="themeUrl"]').val()+"/cabmodel/"+$cabDesign+".js"
			}));//调用对应的计算方式
			$('#cabRiserBox').show();
			$('#cabLaminateBox').show();
		}else{
			$('#cabRiserBox').hide();
			$('#cabLaminateBox').hide();
		}
	});

	//更新专案按钮操作
	$("a[name='saveProject']").click(function() {
		var $result = $('input#customer_tel').val();
		var $telNumber = /^1[345789]\d{9}$/;
        if ($telNumber.test($result)) {
			$about = '专案名：' + $('#project_name').val();
			$about += ' 订单号：' + $('#customer_number').val();
			$about += ' 下单时间：' + $('#customer_orderTime').val();
			$about += ' 安装时间：' + $('#customer_installTime').val();
			$about += '<br>客户信息：' + $('#customer_name').val();
			$about += ' - ' + $('#customer_tel').val();
			$about += ' - ' + $('#customer_address').val();
			$("p[name='about']").html($about);
			$('button[name=saveProject]').attr('disabled','disabled');
		}
	});

	//选中柜体thead.cabhead TR产生的变化
	$('table#tableList').on("click","thead.cabhead tr",function() {
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
	$('table#tableList').on("click","tbody.cab tr",function() {
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
		$tbody.find("td[name='totalprice']").text(decimal($totalprice,2));
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

	//选中柜体table#summaryList tbody tr产生的变化
	$('table#summaryList tbody').on('click', 'tr', function() {
		$tbody = $(this).parent();
		//重新排序
		$orderNumber = $tbody.find("td[name='orderNumber']");
		for (var i = 0; i < $orderNumber.length; i++) {
			$($orderNumber[i]).text(i+1);
		}
		//单套汇总
		$cabV = $(this).find("td[name='cabV']").text();
		$cabN = $(this).find("td[name='cabN']").text();
		$(this).find("td[name='cabP']").text($cabN * $cabV);
		$cabData = $(this).data('name');

		$cabValue = $('#tableList tbody[data-name="'+$cabData+'"]').find('td[name="totalprice"]').text();
		$(this).find("td[name='cabV']").text($cabValue);

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
		$tbody.find("td[name='totalprice']").text(decimal($totalprice,2));
		//开启删除行的按钮
		$('#deltr').removeAttr('disabled');
		$dataName = $(this).data('name');
		$thisTr = "table#summaryList tbody tr[data-name=\\'" + $dataName + "\\']";
		$('#deltr').attr('onclick','deltr(\''+$thisTr+'\')');
	});
});

//增加一行
function addtr($thisTr,$where='before'){
	$arr = $thisTr.split(" ");
	$tr = $arr[0] + " tr:last";
	$length = $($tr).length;

	//判断是否存在单价
	$yuan = $('input#sheetPrice').val();
	if(!$yuan){$yuan = 0};

	$newRow = '<tr><td name="orderNumber"></td>';//序号
	$newRow += '<td>封板</td>';//项目名称
	$newRow += '<td name="cabX"></td>';//长度
	$newRow += '<td name="cabY"></td>';//宽度
	$newRow += '<td name="cabD"></td>';//厚度
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
//数组相关操作
function getObjectKeys(object){
    var keys = [];
    for (var property in object)
      keys.push(property);
    return keys;
} 
function getObjectValues(object){
    var values = [];
    for (var property in object)
      values.push(object[property]);
    return values;
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
//按投影面积计算
function projected($name,$x,$y,$d,$s='',$n,$v) {
	if ($s == '') {$s = 'E0实木颗粒板'}
	$area = decimal($x * $y * $n / 1000000,2);
	$value = decimal($area * $v,2);
	$return = '<tr><td name="orderNumber">1</td>';
	$return += '<td>'+$name+'</td>';//项目名称
	$return += '<td name="cabX">'+$x+'</td>';//长度
	$return += '<td name="cabY">'+$y+'</td>';//宽度
	$return += '<td name="cabD">'+$d+'</td>';//厚度
	$return += '<td name="cabA">'+$area+'</td>';//用量
	$return += '<td name="cabU">'+$v+'</td>';//单价
	$return += '<td name="cabN">'+decimal($n,0)+'</td>';//数量
	$return += '<td name="cabP">'+$value+'</td>';//金额
	$return += '<td>'+$s+'</td></tr>';//备注
	$return += '</tr>';
	return $return;
}
//增加头部内容
function addHeadTable($name,$x,$y,$d,$s,$n,$v) {
	$value = decimal(decimal($x * $y * $n / 1000000,2) * $v,2);
	
	$summaryList = '<tr data-name="'+$name+'">';
	$summaryList += '<td name="orderNumber"></td>';
	$summaryList += '<td>'+$name+'</td>';
	$summaryList += '<td>'+$x+' * '+$y+' * '+$d+'</td>';
	$summaryList += '<td name="cabV">'+$value+'</td>';
	$summaryList += '<td name="cabN">'+decimal($n,0)+'</td>';
	$summaryList += '<td name="cabP">'+ decimal($n * $value,2) +'</td>';
	$summaryList += '<td>'+$s+'</td></tr>';

	$('#summaryList tbody tr:last').before($summaryList);
}
//增加表格及相关内容
function newTableBox($name,$x,$y,$d,$s,$n,$v=0) {
	$('table#tableList').append('<thead data-name="'+$name+'" class="cabhead"></thead>');

	var $thead = 'thead[data-name="'+$name+'"]:last';
	var $tbody = 'tbody[data-name="'+$name+'"]:last';
	var $cabNo = $('th[data-name="cabNo"]').length + 1;

	$($thead).append('<tr></tr>');
	$($thead +' tr').append('<th data-name="cabNo"># '+$cabNo+'</th>');
	$($thead +' tr').append('<th data-name="cabName">'+$name+'</th>');
	$($thead +' tr').append('<th data-name="cabSize" colspan=5>'+$x+' * '+$y+' * '+$d+'</th>');
	$($thead +' tr').append('<th data-name="cabNumber">'+decimal($n,0)+'套</th>');
	$($thead +' tr').append('<th data-name="cabData" colspan=2>'+$s+'</th>');

	$($thead).append('<tr class="tablebg"><th>序号</th><th>部件名称</th><th>长</th><th>宽</th><th>厚</th><th>用量<small>(m²)</small></th><th>单价</th><th>数量</th><th>金额</th><th>备注</th></tr>');
	$('table#tableList').append('<tbody data-name="'+$name+'" class="cab">');

	$cabModel = $('select[name="cabModel"]').val();
	if($cabModel){
		//增加新的格式对应的框架
		cabDesign($name,$x,$y,$d,$s,$n,$v,$tbody);
	}else{
		$($tbody).append(projected($name,$x,$y,$d,$s,$n,$v));//增加内容

		addHeadTable($name,$x,$y,$d,$s,$n,$v);//增加头部内容
		$totals = $('tbody[data-name="'+$name+'"] tr td[name="cabP"]').text();
		$($tbody).append('<tr><td colspan=5></td><td colspan=2>小计</td><td name="totals">'+decimal($n,0)+'</td><td name="totalprice">'+$totals+'</td><td></td></tr>');
	}
}