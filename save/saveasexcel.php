<?php
echo '<meta http-equiv="Content-type" content="text/html;charset=utf-8" />'; 
header('Content-type:application/vnd.ms-excel');
// https://blog.csdn.net/u013749540/article/details/78195266 类型大全，可参考
header('Content-Disposition:filename=table.xls');
echo '<table>';
echo $_POST['savebutton'];//获取表格内容
echo '</table>';
?>