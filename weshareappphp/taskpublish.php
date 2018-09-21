<?php
	session_start();
	header("Content-type:text/html;charset=utf-8");
	require('dbconfig.php');
	require('dblink.php');
	require('fileupload.class.php');
	require('img.class.php');
	require(dirname(__FILE__) . '/' . 'igetui.php');

	$tasktitle=$_POST['name'];
	$taskpay=$_POST['pay'];
	$tasksponsor=$_POST['sponser'];
	$taskintro=$_POST['intro'];
	$taskdemond=$_POST['demand'];
	$tasktips=$_POST['tips'];
	$school=$_POST['school'];
	$propic=new FileUpload;
	 $propic -> set("path", "./uploads/");
	 $propic -> set("maxsize", 10000000);
	 $propic -> set("allowtype", array("gif", "png", "jpg","jpeg"));
	if($propic ->upload('propic')){
		$pic=$propic ->getFileName();
		 $picurl="./uploads/".$pic;
	}else{
		var_dump($propic ->getErrorMsg());
	}
	$publishtime=time();
	$publisher=$_POST['publisher'];
	$status='0';
	$type=$_POST['type'];
	$time=$_POST['time'];
	$location=$_POST['location'];

	$image= new image($picurl,1,"500","500",$picurl);
    $image ->outimage();

	$sql="insert into tasklist(school,tid,type,title,taskintro,taskdemond,tasktips,tasktime,tasklocation,publishtime,publisher,sponsor,status,taskpayper,taskpic) 
	values('$school',null,'$type','$tasktitle','$taskintro','$taskdemond','$tasktips','$time','$location','$publishtime','$publisher','$tasksponsor','$status','$taskpay','$pic')";
// $sql="insert into tasklist(school,tid,type,title,taskintro,taskdemond,tasktips,tasktime,tasklocation,publishtime,publisher,sponsor,status,taskpayper,taskpic) 
// 	values('fudan',null,'fudan',fudan','1','1','tasktips','time','location','publishtime','publisher','tasksponsor','status','taskpay','pic')";
	// echo $sql;
	mysqli_query($link,$sql);
    
	// echo "<script>alert('发布成功')</script>";

    $payload="{'title':'乐分享又出新任务啦','content':'#{$tasktitle}#快来赚享豆,爱和正能量是WeShare任务永恒的主题.','payload':'message'}";
    $content="乐分享又出新任务啦!#".$tasktitle."#快来赚享豆,爱和正能量是WeShare任务永恒的主题.";
    pushMessageToapp(createTranMessage($payload,$content));
    // echo "<script>location.href='weshareadmin.php'</script>";
?>