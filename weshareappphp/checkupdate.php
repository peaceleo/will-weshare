<?php
$data=array();
$appid='so.weshare.weshare';
$version='1.1.2';
$note='新增应用更新，新增一键呼叫';
$urlandroid='http://a.app.qq.com/o/simple.jsp?pkgname=io.dcloud.H5406E220';
// $urlios="";
$android=array('appid'=>$appid,'version'=>$version,'note'=>$note,'urlandroid'=>$urlandroid);
array_push($data, $android);
echo json_encode($data);
?>