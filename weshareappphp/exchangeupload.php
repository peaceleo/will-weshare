<?php
	session_start();
	header("Content-type:text/html;charset=utf-8");
	require('dbconfig.php');
	require('dblink.php');
	require('fileupload.class.php');
	require('img.class.php');

	$prolabel=$_POST['prolabel'];
	$prodepartment=$_POST['prodepartment'];
	$proname=$_POST['proname'];
	$proteacher=$_POST['proteacher'];
		if($proteacher===''){
			$proteacher='多位';
		}
	$prostore=$_POST['prostore'];
     if($prostore==''){
     	$prostore=1;
     }
	$proprice=$_POST['proprice'];
	$prolocation=$_POST['prolocation'];
	$description=$_POST['description'];
	$publisher=$_POST['publisher'];
	$school=$_POST['proschool'];

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
	$addtime=time();
	$image= new image($picurl,1,"500","500",$picurl);
    $image ->outimage();
    
     $sql="insert into exchangePro(school,pid,name,subtypea,subtypeb,type,price,description,pic,store,addtime,publisher,prolocation) 
	values('$school',null,'$proname','$prodepartment','$proteacher','$prolabel','$proprice','$description','$pic','$prostore','$addtime','$publisher','$prolocation')";
	mysqli_query($link,$sql);
	$res=mysqli_affected_rows($link);
	if($res>0){
		echo '1';
		// echo "<script>alert('添加成功')</script>";
		// echo "<script>window.history.back(-1);</script>";

	}else{
		// echo "<script>alert('添加失败')</script>";
		echo '0';
	}
	
?>