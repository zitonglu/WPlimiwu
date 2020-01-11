function cabDesign($name,$x,$y,$z,$s,$n,$v,$tbody){
	console.log('厘米屋18+9模块导入成功');
	//增加table表单
	addHeadTable($name,$x,$y,$z,$s,$n,$v);

	$d = 18;
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
	$return += '</tr>';
	//顶底板
	$dy = $y-($d*2);//顶底板减双侧厚度
	$area = decimal($dy*$z*2/1000000,2);
	$return += '<tr><td name="orderNumber">2</td>';
	$return += '<td>顶底板</td>';//项目名称
	$return += '<td name="cabX">'+$dy+'</td>';//长度
	$return += '<td name="cabY">'+$z+'</td>';//宽度
	$return += '<td name="cabD">'+$d+'</td>';//厚度
	$return += '<td name="cabA">'+$area+'</td>';//用量
	$return += '<td name="cabU">'+$v+'</td>';//单价
	$return += '<td name="cabN">2</td>';//数量
	$return += '<td name="cabP">'+decimal($area*$v,2)+'</td>';//金额
	$return += '<td>'+$s+'18</td></tr>';//备注
	$return += '</tr>';

	$($tbody).append($return) ;
}