function cabDesign($name,$x,$y,$z,$s,$n,$v,$tbody){
	console.log('厘米屋18+9模块导入成功');
	//增加table表单
	addHeadTable($name,$x,$y,$z,$s,$n,$v);

	$d = 18;
	$bjd = 9;
	//侧板
	$area = decimal($x*$z*2/1000000,2);
	$return = '<tr><td name="orderNumber">1</td>';
	$return += '<td>外侧板</td>';//项目名称
	$return += '<td name="cabX">'+$x+'</td>';//长度
	$return += '<td name="cabY">'+$z+'</td>';//宽度
	$return += '<td name="cabD">'+$d+'</td>';//厚度
	$return += '<td name="cabA">'+$area+'</td>';//用量
	$return += '<td name="cabU">'+$v+'</td>';//单价
	$return += '<td name="cabN">2</td>';//数量
	$return += '<td name="cabP">'+decimal($area*$v,2)+'</td>';//金额
	$return += '<td>'+$s+'18</td></tr>';//备注
	//中侧板
	$cabRiserN = $('#cabRiser').val();
	if($cabRiserN){
		$dx = $x - 80 - 60 - ($d * 2);
		$area = decimal($dx * $z * $cabRiserN / 1000000 , 2);
		$return += '<tr><td name="orderNumber">2</td>';
		$return += '<td>中侧板</td>';//项目名称
		$return += '<td name="cabX">'+$dx+'</td>';//长度
		$return += '<td name="cabY">'+$z+'</td>';//宽度
		$return += '<td name="cabD">'+$d+'</td>';//厚度
		$return += '<td name="cabA">'+$area+'</td>';//用量
		$return += '<td name="cabU">'+$v+'</td>';//单价
		$return += '<td name="cabN">'+$cabRiserN+'</td>';//数量
		$return += '<td name="cabP">'+decimal($area*$v,2)+'</td>';//金额
		$return += '<td>'+$s+'18</td></tr>';//备注
	}
	//顶底板
	$dy = $y-($d*2);//顶底板减双侧厚度
	$area = decimal($dy*$z*2/1000000,2);
	$return += '<tr><td name="orderNumber">3</td>';
	$return += '<td>顶底板</td>';//项目名称
	$return += '<td name="cabX">'+$dy+'</td>';//长度
	$return += '<td name="cabY">'+$z+'</td>';//宽度
	$return += '<td name="cabD">'+$d+'</td>';//厚度
	$return += '<td name="cabA">'+$area+'</td>';//用量
	$return += '<td name="cabU">'+$v+'</td>';//单价
	$return += '<td name="cabN">2</td>';//数量
	$return += '<td name="cabP">'+decimal($area*$v,2)+'</td>';//金额
	$return += '<td>'+$s+'18</td></tr>';//备注
	//层板
	$cabLaminateN = $('#cabLaminate').val();
	if($cabRiserN){
		// $dy = $y-($d*2);
		$dz = $z - 10 - $bjd;
		$area = decimal($dy * $dz * $cabLaminateN / 1000000 , 2);
		$return += '<tr><td name="orderNumber">4</td>';
		$return += '<td>层板</td>';//项目名称
		$return += '<td name="cabX">'+$dy+'</td>';//长度
		$return += '<td name="cabY">'+$dz+'</td>';//宽度
		$return += '<td name="cabD">'+$d+'</td>';//厚度
		$return += '<td name="cabA">'+$area+'</td>';//用量
		$return += '<td name="cabU">'+$v+'</td>';//单价
		$return += '<td name="cabN">'+$cabLaminateN+'</td>';//数量
		$return += '<td name="cabP">'+decimal($area*$v,2)+'</td>';//金额
		$return += '<td>'+$s+'18</td></tr>';//备注
	}
	//背板
	$bj_dx=$x - 80 - 60 - ($d * 2) + 9;
	$bj_dy=$dy+9;
	$area=decimal($bj_dx*$bj_dy/1000000,2);
	$bj_v=decimal($v*0.7,0);//背板单价
	$return += '<tr><td name="orderNumber">5</td>';
	$return += '<td>背板</td>';//项目名称
	$return += '<td name="cabX">'+$bj_dx+'</td>';//长度
	$return += '<td name="cabY">'+$bj_dy+'</td>';//宽度
	$return += '<td name="cabD">'+$bjd+'</td>';//厚度
	$return += '<td name="cabA">'+$area+'</td>';//用量
	$return += '<td name="cabU">'+$bj_v+'</td>';//单价
	$return += '<td name="cabN">1</td>';//数量
	$return += '<td name="cabP">'+decimal($area*$bj_v,2)+'</td>';//金额
	$return += '<td>'+$s+'9</td></tr>';//备注
	//顶线和顶线加固条
	$xt_v = decimal($v * 0.15,0);
	$area = decimal($dy / 1000 * 2,2);
	$return += '<tr><td name="orderNumber">6</td>';
	$return += '<td>顶线</td>';//项目名称
	$return += '<td>'+$dy+'</td>';//长度
	$return += '<td>60</td>';//宽度
	$return += '<td>'+$d+'</td>';//厚度
	$return += '<td>'+$area+'</td>';//用量
	$return += '<td>'+$xt_v+'</td>';//单价
	$return += '<td name="cabN">2</td>';//数量
	$return += '<td name="cabP">'+decimal($area*$xt_v,2)+'</td>';//金额
	$return += '<td></td></tr>';//备注
	//脚线和支撑
	//$xt_v = decimal($v * 0.15,0);
	if ($dy>=400) {$zc = 1}
	if ($dy>=1200) {$zc = 2}
	if ($dy>=1800) {$zc = 3}
	if ($dy>=2400) {$zc = 4}
	if ($dy>=2800) {$zc = 5}
	if ($dy>=3600) {$zc = 6}
	$zcc = ($z-($d*2)-21)*$zc/1000;
	console.log($zcc);
	$areaj = decimal($zcc + $area,2);
	$area = decimal($dy / 1000 * 2,2);
	$return += '<tr><td name="orderNumber">7</td>';
	$return += '<td>脚线和支撑</td>';//项目名称
	$return += '<td>'+$dy+'</td>';//长度
	$return += '<td>80</td>';//宽度
	$return += '<td>'+$d+'</td>';//厚度
	$return += '<td>'+$areaj+'</td>';//用量
	$return += '<td>'+$xt_v+'</td>';//单价
	$return += '<td>2</td>';//数量
	$return += '<td name="cabP">'+decimal($areaj*$xt_v,2)+'</td>';//金额
	$return += '<td></td></tr>';//备注

	$($tbody).append($return) ;
}