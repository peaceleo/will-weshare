<?php
date_default_timezone_set("Asia/Shanghai");
header("Content/type:text/html;charset=utf-8");
require('dbconfig.php');
require('dblink.php');

switch($_POST['action']){
	case 'someones':
		$bywho=$_POST['username'];
		$sql="select * from exchangeorder where bywho='{$bywho}'";
		$result=mysqli_query($link,$sql);
	break;

	case 'adminorder':
		$school=$_POST['school'];
		$type=$_POST['type'];
		if($type=='all'){
			$sql="select * from bookreorder where school='{$school}'";
		}else if($type==0){
			$sql="select * from bookreorder where school='{$school}' and status='0'";
		}else{
			$sql="select * from bookreorder where school='{$school}' and status>'0'";
		}
		$result=mysqli_query($link,$sql);
	break;
	
	}
	$data=array();
	while($rows=mysqli_fetch_array($result)){
		$oid=$rows['oid'];
		$onum=$rows['onum'];
		$bywho=$rows['bywho'];
		$bywhotel=$rows['bywhotel'];
		$proname=$rows['proname'];
		$propic=$rows['propic'];
		$proprice=$rows['proprice'];
		$addtime=$rows['addtime'];
		$remark=$rows['remark'];
		$ordernote=$rows['ordernote'];
		$status=$rows['status'];
		$arr=array('oid'=>$oid,'onum'=>$onum,'bywho'=>$bywho,'bywhotel'=>$bywhotel,'proname'=>$proname,'proprice'=>$proprice,'propic'=>$propic,'addtime'=>$addtime,'remark'=>$remark,'ordernote'=>$ordernote,'status'=>$status);
		array_push($data,$arr);

	}
	echo json_encode($data);
?>