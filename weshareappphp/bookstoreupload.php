<?php
	session_start();
	header("Content-type:text/html;charset=utf-8");
	require('dbconfig.php');
	require('dblink.php');
	require('fileupload.class.php');
	require('img.class.php');

    $school=$_POST['school'];
    $department=$_POST['department'];
    $course=$_POST['coursename'];
    $teacher=$_POST['teachername'];
	$bookname=$_POST['bookname'];
	$bookstore=$_POST['bookstore'];
	$bookprice=$_POST['bookprice'];
	$exprice=$_POST['exprice'];
	$reprice=$_POST['reprice'];
	$description=$_POST['description'];
	

	$bookpic=new FileUpload;
	$bookpic -> set("path", "./uploads/");
	$bookpic -> set("maxsize", 10000000);
    $bookpic -> set("allowtype", array("gif", "png", "jpg","jpeg"));
	if($bookpic ->upload('bookpic')){
		$pic=$bookpic ->getFileName();
		$picurl="./uploads/".$pic;
	}else{
		var_dump($bookpic ->getErrorMsg());
	}
	$addtime=time();
	$publisher=$_POST['publisher'];
	
	$image= new image($picurl,1,"800","800",$picurl);
    $image ->outimage();
 
	$sql="insert into coursebook(bid,school,departmentName,coursename,bookpic,courseteacher,coursebook,bookprice,exchangeprice,recoverprice,store,description,publisher,addtime)
	values(null,'$school','$department','$course','$pic','$teacher','$bookname','$bookprice','$exprice','$reprice','$bookstore','$description','$publisher','$addtime')";

	mysqli_query($link,$sql);
	$res=mysqli_affected_rows($link);
	if($res>0){
		echo "<script>alert('添加成功')</script>";
		echo "<script>window.history.back(-1);</script>";

	}else{
		echo "<script>alert('添加失败')</script>";
	}
	
?>