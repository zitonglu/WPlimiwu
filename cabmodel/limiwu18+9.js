function cabDesign($name,$x,$y,$z,$s,$n,$v,$tbody){
	console.log('厘米屋18+9模块导入成功');
	
	$d = 18;
	$bjd = 9;
	//侧板
	$area = decimal($x*$z*$n*2/1000000,2);
	$return = '<tr><td name="orderNumber">1</td>';
	$return += '<td>外侧板</td>';//项目名称
	$return += '<td name="cabX">'+$x+'</td>';//长度
	$return += '<td name="cabY">'+$z+'</td>';//宽度
	$return += '<td name="cabD">'+$d+'</td>';//厚度
	$return += '<td name="cabA">'+$area+'</td>';//用量
	$return += '<td name="cabU">'+$v+'</td>';//单价
	$return += '<td name="cabN">'+$n*2+'</td>';//数量
	$return += '<td name="cabP">'+decimal($area*$v,2)+'</td>';//金额
	$return += '<td>'+$s+'18</td></tr>';//备注
	//中侧板
	$cabRiserN = $('#cabRiser').val();
	if($cabRiserN){
		$dx = $x - 80 - 60 - ($d * 2);
		$area = decimal($dx * $z * $cabRiserN * $n / 1000000 , 2);
		$return += '<tr><td name="orderNumber">2</td>';
		$return += '<td>中侧板</td>';//项目名称
		$return += '<td name="cabX">'+$dx+'</td>';//长度
		$return += '<td name="cabY">'+$z+'</td>';//宽度
		$return += '<td name="cabD">'+$d+'</td>';//厚度
		$return += '<td name="cabA">'+$area+'</td>';//用量
		$return += '<td name="cabU">'+$v+'</td>';//单价
		$return += '<td name="cabN">'+decimal($cabRiserN*$n,2)+'</td>';//数量
		$return += '<td name="cabP">'+decimal($area*$v,2)+'</td>';//金额
		$return += '<td>'+$s+'18</td></tr>';//备注
	}
	//顶底板
	$dy = $y-($d*2);//顶底板减双侧厚度
	$area = decimal($dy*$z*$n*2/1000000,2);
	$return += '<tr><td name="orderNumber">3</td>';
	$return += '<td>顶底板</td>';//项目名称
	$return += '<td name="cabX">'+$dy+'</td>';//长度
	$return += '<td name="cabY">'+$z+'</td>';//宽度
	$return += '<td name="cabD">'+$d+'</td>';//厚度
	$return += '<td name="cabA">'+$area+'</td>';//用量
	$return += '<td name="cabU">'+$v+'</td>';//单价
	$return += '<td name="cabN">'+$n*2+'</td>';//数量
	$return += '<td name="cabP">'+decimal($area*$v,2)+'</td>';//金额
	$return += '<td>'+$s+'18</td></tr>';//备注
	//层板
	$cabLaminateN = $('#cabLaminate').val();
	if($cabRiserN){
		// $dy = $y-($d*2);
		$dz = $z - 10 - $bjd;
		$area = decimal($dy * $dz * $cabLaminateN * $n / 1000000 , 2);
		$return += '<tr><td name="orderNumber">4</td>';
		$return += '<td>层板</td>';//项目名称
		$return += '<td name="cabX">'+$dy+'</td>';//长度
		$return += '<td name="cabY">'+$dz+'</td>';//宽度
		$return += '<td name="cabD">'+$d+'</td>';//厚度
		$return += '<td name="cabA">'+$area+'</td>';//用量
		$return += '<td name="cabU">'+$v+'</td>';//单价
		$return += '<td name="cabN">'+decimal($cabLaminateN*$n,2)+'</td>';//数量
		$return += '<td name="cabP">'+decimal($area*$v,2)+'</td>';//金额
		$return += '<td>'+$s+'18</td></tr>';//备注
	}
	//背板
	$bj_dx=$x - 80 - 60 - ($d * 2) + 9;
	$bj_dy=$dy+9;
	$area=decimal($bj_dx*$bj_dy*$n/1000000,2);
	$bj_v=decimal($v*0.7,0);//背板单价
	$return += '<tr><td name="orderNumber">5</td>';
	$return += '<td>背板</td>';//项目名称
	$return += '<td name="cabX">'+$bj_dx+'</td>';//长度
	$return += '<td name="cabY">'+$bj_dy+'</td>';//宽度
	$return += '<td name="cabD">'+$bjd+'</td>';//厚度
	$return += '<td name="cabA">'+$area+'</td>';//用量
	$return += '<td name="cabU">'+$bj_v+'</td>';//单价
	$return += '<td name="cabN">'+$n+'</td>';//数量
	$return += '<td name="cabP">'+decimal($area*$bj_v,2)+'</td>';//金额
	$return += '<td>'+$s+'9</td></tr>';//备注
	//顶线和顶线加固条
	$xt_v = decimal($v * 0.15,0);
	$area = decimal($dy*$n*2/1000 ,2);
	$return += '<tr><td name="orderNumber">6</td>';
	$return += '<td>顶线</td>';//项目名称
	$return += '<td>'+$dy+'</td>';//长度
	$return += '<td>60</td>';//宽度
	$return += '<td name="cabD">'+$d+'</td>';//厚度
	$return += '<td name="cabA">'+$area+'</td>';//用量
	$return += '<td name="cabU">'+$xt_v+'</td>';//单价
	$return += '<td name="cabN">'+$n*2+'</td>';//数量
	$return += '<td name="cabP">'+decimal($area*$xt_v,2)+'</td>';//金额
	$return += '<td>'+$s+'18</td></tr>';//备注
	//脚线和支撑
	//$xt_v = decimal($v * 0.15,0);
	$zc = 0;
	if ($dy>=400) {$zc = 1}
	if ($dy>=1200) {$zc = 2}
	if ($dy>=1800) {$zc = 3}
	if ($dy>=2400) {$zc = 4}
	if ($dy>=2800) {$zc = 5}
	if ($dy>=3600) {$zc = 6}
	$zcc = ($z-($d*2)-21)*$zc/1000;
	$areaj = decimal($zcc + $area,2);
	$area = decimal($dy*$n*2 / 1000,2);
	$return += '<tr><td name="orderNumber">7</td>';
	$return += '<td>脚线和支撑</td>';//项目名称
	$return += '<td>'+$dy+'</td>';//长度
	$return += '<td>80</td>';//宽度
	$return += '<td name="cabD">'+$d+'</td>';//厚度
	$return += '<td name="cabA">'+$areaj+'</td>';//用量
	$return += '<td name="cabU">'+$xt_v+'</td>';//单价
	$return += '<td name="cabN">'+$n*2+'</td>';//数量
	$return += '<td name="cabP">'+decimal($areaj*$xt_v,2)+'</td>';//金额
	$return += '<td>'+$s+'18</td></tr>';//备注
	//收口条
	$area = decimal($y*$n*2/1000,2);
	$return += '<tr><td name="orderNumber">8</td>';
	$return += '<td>收口条</td>';//项目名称
	$return += '<td>'+$y+'</td>';//长度
	$return += '<td>60</td>';//宽度
	$return += '<td name="cabD">'+$d+'</td>';//厚度
	$return += '<td name="cabA">'+$area+'</td>';//用量
	$return += '<td name="cabU">'+$xt_v+'</td>';//单价
	$return += '<td name="cabN">'+$n*2+'</td>';//数量
	$return += '<td name="cabP">'+decimal($area*$xt_v,2)+'</td>';//金额
	$return += '<td>'+$s+'18</td></tr>';//备注

	$($tbody).append($return);

	//数量汇总
	$total = $($tbody).find("td[name='cabN']");
	$totals = 0;
	for (var i = $total.length - 1; i >= 0; i--) {
		$number = $($total[i]).text();
		if($number){
			if(!isNaN($number)){
				$number = Number($number);
				$totals += $number;
			}
		}
	}
	//金额汇总
	$prices = $($tbody).find("td[name='cabP']");
	$totalprice = 0;
	for (var i = $prices.length - 1; i >= 0; i--) {
		$number = $($prices[i]).text();
		if($number){
			if (!isNaN($number)) {
				$number = Number($number);
				$totalprice += $number;
			}
		}
	}

	$($tbody).append('<tr><td colspan=5></td><td colspan=2>小计</td><td name="totals">'+$totals+'</td><td name="totalprice">'+decimal($totalprice,2)+'</td><td></td></tr>');
	//增加table表单
	addHeadTableForCab($name,$x,$y,$z,$s,$n,decimal($totalprice,2));
}