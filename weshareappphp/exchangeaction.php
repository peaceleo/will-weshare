<?php
	session_start();
	header("Content-type:text/html;charset=utf-8");
	require('dbconfig.php');
	require('dblink.php');
	require('fileupload.class.php');
	require('img.class.php');

	switch ($_POST['action']) {
		case 'propub':
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
			}else{
				echo '0';
			}
		break;
		
		case 'onsale':
			$pid=$_POST['pid'];
			$sql="update exchangePro set store=0 where pid='{$pid}'";
			mysqli_query($link,$sql);
			$res=mysqli_affected_rows($link);
			echo $res;	

		break;
		case 'nosale':
			$pid=$_POST['pid'];
			$sql="update exchangePro set store=1 where pid='{$pid}'";
			mysqli_query($link,$sql);
			$res=mysqli_affected_rows($link);
			echo $res;	

		break;
		case 'delete':
			$pid=$_POST['pid'];
			$sql="delete from exchangePro where pid='{$pid}'";
			mysqli_query($link,$sql);
			$res=mysqli_affected_rows($link);
			echo $res;	
		break;

		case 'updatepro':
		    $pid=$_POST['pid'];

		    //查询宝贝信息
		    $sql0="select * from exchangePro where pid='{$pid}'";
		    $res=mysqli_query($link,$sql0);
		    while ($r=mysqli_fetch_array($res)) {
		    	$oldpic=$r['pic'];
		    }
			$prolabel=$_POST['prolabel'];
			
			$proname=$_POST['proname'];
			if(isset($_POST['prodepartment'])){
		         $prodepartment=$_POST['prodepartment'];
						if($prodepartment==''){
							$prodepartment='all';
						}
				}else{
					$$prodepartment='all';
				}
				
				if(isset($_POST['proteacher'])){
					$proteacher=$_POST['proteacher'];
					if($proteacher==''){
						$proteacher='多位';
					}
				}else{
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
				
			}else{
				var_dump($propic ->getErrorMsg());
			}
			if($pic==''){
				       $pic=$oldpic;
			   }
			$picurl="./uploads/".$pic;
			$addtime=time();
			$image= new image($picurl,1,"500","500",$picurl);
		    $image ->outimage();

		    
		   
		    $sql="update exchangePro set name='{$proname}',type='{$prolabel}',subtypea='{$prodepartment}',subtypeb='{$proteacher}',
		    price={$proprice},description='{$description}',pic='{$pic}',store='{$prostore}',prolocation='{$prolocation}' where pid='{$pid}'";
			mysqli_query($link,$sql);

			$res=mysqli_affected_rows($link);
			if($res>0){
				echo '1';
			}else{
				echo '0';
			}
		break;
	}

	
	
?>