<?php
	session_start();
	header("Content-type:text/html;charset=utf-8");
	require('dbconfig.php');
	require('dblink.php');
	require('fileupload.class.php');
	require('img.class.php');
	require('snsfunction.php');

	$prolabel=$_POST['prolabel'];
	$prodepartment=$_POST['prodepartment'];
	$proname=$_POST['proname'];
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

						$s=dirname(__FILE__);
                        $addtime=time();
                        $files=$_POST['files'];


                         $tmp=base64_decode($files);
                         $fp=$s.'/uploads/'.$addtime.'.jpg';
                         $pic=$addtime.'.jpg';
                         file_put_contents($fp, $tmp);
    
     $sql="insert into exchangePro(school,pid,name,subtypea,subtypeb,type,price,description,pic,store,addtime,publisher,prolocation) 
	values('$school',null,'$proname','$prodepartment','$proteacher','$prolabel','$proprice','$description','$pic','$prostore','$addtime','$publisher','$prolocation')";
	mysqli_query($link,$sql);
	$res=mysqli_affected_rows($link);
	if($res>0){
		echo '1';
		$sql2="update user set rewardPoints=rewardPoints+20 where email='{$publisher}'";
              mysqli_query($link,$sql2);
              $sql9="select * from user where email='{$publisher}' ";
                    $res=mysqli_query($link,$sql9);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                      $publisherTel=$r['telphone'];
                    }
              $sql5="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$publisher','$addtime','1','20','商品发布奖励','$account')";
                  mysqli_query($link,$sql5);

              $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
              $text="【WeShare乐分享】商品发布成功,20享豆的奖励已充值到您的账户,请注意查收.分享就是最好的拥有哦";
              send_sms($apikey,$text,$publisherTel);  

	}else{
		
		echo '0';
	}
	
?>