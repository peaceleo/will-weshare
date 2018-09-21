<?php

	date_default_timezone_set("Asia/Shanghai");
	header("Content-type: text/html; charset=utf-8");

	require('dbconfig.php');
	require('dblink.php');
	$pagesize=12;
	

	switch ($_POST['action']) {
		case 'allreminder':
			$username=$_POST['username'];
			$nowtime=time()-60*60*24*7;
			$sql="select * from reminder where towho='{$username}' and sendtime >{$nowtime}";
			$result=mysqli_query($link,$sql);
			break;
		
		case 'uncheckedreminder':
			$username=$_POST['username'];
			$nowtime=time()-60*60*24*7;
			$sql="select * from reminder where towho='{$username}' and sendtime >{$nowtime} and status='0'";
			$result=mysqli_query($link,$sql);
		break;
		case 'reminder':
			$username=$_POST['username'];
			$page=$_POST['page'];
			$nowtime=time()-60*60*24*7;
			$sql="select * from reminder where towho='{$username}' and sendtime >{$nowtime}";
			$res=mysqli_query($link,$sql);
			$maxRows=mysqli_num_rows($res);
			//计算最大页数
			$maxPages=$maxRows/$pagesize;
			if($page>$maxPages){
				$page=$maxPages;
			}if($page<1){
				$page=1;
			}
			//拼装分页sql语句
			$limit="limit ".(($page-1)*$pagesize).",{$pagesize}";
			$sql1="select * from reminder where towho='{$username}' and sendtime>{$nowtime} {$limit}";
			
			$result=mysqli_query($link,$sql1);
		break;
	}
	$data=array();
	while($rows=mysqli_fetch_array($result)){
		$rid=$rows['rid'];
		$content=$rows['content'];
		$bywho=$rows['bywho'];

			$sql="select * from user where email='{$bywho}'";
			$r=mysqli_query($link,$sql);
			while($row=mysqli_fetch_array($r)){
				$bywhohead=$row['head'];
				$bywhonickname=$row['nickname'];
				$bywhosex=$row['sex'];
			}
 		$pubbywho='';
		$needid=$rows['needid'];
			$sql1="select * from needlist where id='{$needid}'";
			$w=mysqli_query($link,$sql1);
			while($r=mysqli_fetch_array($w)) {
				$pubbywho=$r['user'];
			}
		// echo $pubbywho;	
		$sendtime=$rows['sendtime'];
		$status=$rows['status'];
		//0:私信 1:评论 2.致谢评价  3.订单通知
		$type=$rows['type'];
		$arr=array('rid'=>$rid,'content'=>$content,'bywhohead'=>$bywhohead,'bywhonickname'=>$bywhonickname,'bywhosex'=>$bywhosex,'needid'=>$needid,'pubbywho'=>$pubbywho,'sendtime'=>$sendtime,'status'=>$status,'type'=>$type);
		array_push($data, $arr);
	}
		echo json_encode($data);
		mysqli_free_result($result);
		mysqli_close($link);
?>
