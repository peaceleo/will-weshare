<?php
	session_start();
	header("Content-type:text/html;charset=utf-8");
	require('dbconfig.php');
	require('dblink.php');
	require('fileupload.class.php');
	require('img.class.php');

	switch ($_POST['action']) {
		case 'admindata':
		 //获取总注册用户数	
		 $sql0="select * from user";
		 $res0=mysqli_query($link,$sql0);
		 $totaluser=mysqli_num_rows($res0);	
		 //获取已通过验证用户
		 $sql1="select * from user where active='2'";
		 $res1=mysqli_query($link,$sql1);
		 $activeuser=mysqli_num_rows($res1);	
		 //获取需求总数
		 $sql2="select * from needlist";
		 $res2=mysqli_query($link,$sql2);
		 $totalneed=mysqli_num_rows($res2);	
		 //获取任务总数
		 $sql3="select * from tasklist where type='task'";
		 $res3=mysqli_query($link,$sql3);
		 $totaltask=mysqli_num_rows($res3);
		 //获取活动总数
		 $sql4="select * from tasklist where type='acti'";
		 $res4=mysqli_query($link,$sql4);
		 $totalacti=mysqli_num_rows($res4);
		 //获取话题总数
		 $sql5="select * from topiclist";
		 $res5=mysqli_query($link,$sql5);
		 $totaltopic=mysqli_num_rows($res5);
		 //获取产品总数
		 $sql6="select * from exchangePro";
		 $res6=mysqli_query($link,$sql6);
		 $totalpro=mysqli_num_rows($res6);
		 //获取累积互动数(需求私信，评论，致谢，任务成果，任务评论，任务支持，话题评论)
		 //需求私信
		 $sql7="select * from helpermsg";
		 $res7=mysqli_query($link,$sql7);
		 $totalmsg=mysqli_num_rows($res7);
		 //需求评论
		 $sql8="select * from comment";
		 $res8=mysqli_query($link,$sql8);
		 $totalcomment=mysqli_num_rows($res8);
		 //需求致谢
		 $sql9="select * from thankorder";
		 $res9=mysqli_query($link,$sql9);
		 $totalthank=mysqli_num_rows($res9);
		 //任务成果
		 $sql10="select * from taskresult";
		 $res10=mysqli_query($link,$sql10);
		 $totalresult=mysqli_num_rows($res10);
		 //任务评论
		 $sql11="select * from taskcomment";
		 $res11=mysqli_query($link,$sql11);
		 $totaltaskcomment=mysqli_num_rows($res11);
		 //任务支持
		 $sql12="select * from tasksurport";
		 $res12=mysqli_query($link,$sql12);
		 $totaltasksurport=mysqli_num_rows($res12);
		 //话题评论
		 $sql13="select * from topiccomment";
		 $res13=mysqli_query($link,$sql13);
		 $totaltopiccomment=mysqli_num_rows($res13);
		 $data=array('totaluser'=>$totaluser,'activeuser'=>$activeuser,'totalneed'=>$totalneed,
		 	'totaltask'=>$totaltask,'totalacti'=>$totalacti,'totaltopic'=>$totaltopic,'totalpro'=>$totalpro,
		 	'totalmsg'=>$totalmsg,'totalcomment'=>$totalcomment,'totalthank'=>$totalthank,'totalresult'=>$totalresult,
		 	'totaltaskcomment'=>$totaltaskcomment,'totaltasksurport'=>$totaltasksurport,'totaltopiccomment'=>$totaltopiccomment);
		 echo json_encode($data);
		break;
		case 'userinfolook':
		$usertel=$_POST['usertel'];
		$usernickname=$_POST['usernickname'];
		$userstunum=$_POST['userstunum'];
		$sql="select * from user where telphone='{$usertel}' or nickname='{$usernickname}' or email='{$userstunum}'";
		$result=mysqli_query($link,$sql);

		while($rows=mysqli_fetch_array($result)){
			$data=array('school'=>$rows['school'],'nickname'=>$rows['nickname'],'rewardpoints'=>$rows['rewardPoints'],
				'email'=>$rows['email'],'sex'=>$rows['sex'],'telphone'=>$rows['telphone'],'note'=>$rows['note'],
				'addtime'=>$rows['addtime'],'head'=>$rows['head'],'ident'=>$rows['ident'],'active'=>$rows['active'],
				'rank'=>$rows['rank'],'lastlogintime'=>$rows['lastlogintime'],'version'=>$rows['version']);
		}
		echo json_encode($data);
		break;
		case 'unpassuser':
			$sql="select * from user where active=1";
			$result=mysqli_query($link,$sql);
			$data=array();
			while($rows=mysqli_fetch_array($result)){
				 $uid=$rows['id'];
				 $ident=$rows['ident'];
				 $school=$rows['school'];
				 $email=$rows['email'];
				 $telphone=$rows['telphone'];
				 $arr=array('uid'=>$uid,'ident'=>$ident,'school'=>$school,'email'=>$email,'telphone'=>$email);
				 array_push($data,$arr);
			}
		echo json_encode($data);	
		break;

		case 'unpasstopic':
			$sql="select * from topiclist where status=1";
			$result=mysqli_query($link,$sql);
			$data=array();
			while($rows=mysqli_fetch_array($result)){
			 	$tid=$rows['tid'];
			 	$topictitle=$rows['topictitle'];
			 	$topicintro=$rows['topicintro'];
			 	$publisher=$rows['publisher'];
			 	$arr=array('tid'=>$tid,'topictitle'=>$topictitle,'topicintro'=>$topicintro,'publisher'=>$publisher);
			 	array_push($data, $arr);
			}
			echo json_encode($data);
		break;

	}

	
	
?>