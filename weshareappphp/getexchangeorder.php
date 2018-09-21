<?php
date_default_timezone_set("Asia/Shanghai");
header("Content/type:text/html;charset=utf-8");
require('dbconfig.php');
require('dblink.php');

switch($_POST['action']){
	case 'someoneexchange':
		$reciver=$_POST['username'];
		$sql="select * from exchangeorder where reciver='{$reciver}'  order by addtime desc";
		$result=mysqli_query($link,$sql);
	break;
	case 'someoneshare':
		$reciver=$_POST['username'];
		$sql="select * from exchangeorder where owner='{$reciver}'  order by addtime desc";
		$result=mysqli_query($link,$sql);
	break;

	case 'singleorder':
		$onum=$_POST['onum'];
		$sql="select * from exchangeorder where onum='{$onum}'";
		$result=mysqli_query($link,$sql);
	break;

	case 'adminorder':
		$school=$_POST['school'];
		$type=$_POST['type'];
		if($type=='all'){
			$sql="select * from exchangeorder where school='{$school}'";
		}else if($type==0){
			$sql="select * from exchangeorder where school='{$school}' and status='0'";
		}else{
			$sql="select * from exchangeorder where school='{$school}' and status>'0'";
		}
		$result=mysqli_query($link,$sql);
	break;
	
	}
	$data=array();
	while($rows=mysqli_fetch_array($result)){
		$oid=$rows['oid'];
		$onum=$rows['onum'];
		$owner=$rows['owner'];
			 $sql="select * from user where email='{$owner}'";
			 $res=mysqli_query($link,$sql);
		 	 while($r=mysqli_fetch_array($res)){
		 	 	$ownertel=$r['telphone'];
		 	 	$ownernickname=$r['nickname'];
		 	 }
		$reciver=$rows['reciver'];
			$sql0="select * from user where email='{$reciver}'";
			 $res0=mysqli_query($link,$sql0);
		 	 while($r=mysqli_fetch_array($res0)){
		 	 	// $ownertel=$r['telphone'];
		 	 	$recivernickname=$r['nickname'];
		 	 }
		$recivertel=$rows['recivertel'];
		$proname=$rows['proname'];
		$propic=$rows['propic'];
		$proprice=$rows['proprice'];
		$prodescription=$rows['prodescription'];
		$prolocation=$rows['prolocation'];
		$addtime=$rows['addtime'];
		$remark=$rows['remark'];
		$ordernote=$rows['ordernote'];
		$status=$rows['status'];
		$arr=array('oid'=>$oid,'onum'=>$onum,'owner'=>$owner,'ownernickname'=>$ownernickname,'ownertel'=>$ownertel,'reciver'=>$reciver,'recivernickname'=>$recivernickname,'recivertel'=>$recivertel,'proname'=>$proname,'proprice'=>$proprice,'prodescription'=>$prodescription,'prolocation'=>$prolocation,'propic'=>$propic,'addtime'=>$addtime,'remark'=>$remark,'ordernote'=>$ordernote,'status'=>$status);
		array_push($data,$arr);

	}
	echo json_encode($data);
?>