<?php

date_default_timezone_set("Asia/Shanghai");
header('Content-type:text/html; charset=utf-8');
require('dbconfig.php');
require('dblink.php');
require('snsfunction.php');
if($_POST['action']){
    switch ($_POST['action']){
	     case 'others':
			    $ordernum='EXO2015'.rand(100000,999999999);
				$pid=$_POST['pid'];
				$sql="select * from exchangePro where pid='{$pid}'";
				$a=mysqli_query($link,$sql);
				while($r=mysqli_fetch_array($a)){
					$proname=$r['name'];
					$proprice=$r['price'];
					$propic=$r['pic'];
				}
				$bywho=$_POST['username'];
				$school=$_POST['school'];
				$towhotel=$_POST['towhotel'];
				$remark=$_POST['remark'];
				$addtime=time();

				$sql1="insert into exchangeorder(oid,onum,bywho,towhotel,proname,proprice,propic,addtime,remark,school)
				values(null,'$ordernum','$bywho','$towhotel','$proname','$proprice','$propic','$addtime','$remark','$school')";
				$b=mysqli_query($link,$sql1);
				$id=mysqli_insert_id($link);
				if($id>0){
					$sql2="update user set rewardPoints=rewardPoints-$proprice where email='{$bywho}'";
					mysqli_query($link,$sql2);
					$sql5="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail) VALUES(null,'$bywho','$addtime','2','$proprice','集市兑换支出')";
			        mysqli_query($link,$sql5);
					$sql3="update exchangePro set store=store-1 where pid='{$pid}'";
					mysqli_query($link,$sql3);
					
					echo '1';
					$apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
					$mobile = "18501773419"; 
					$text="【WeShare乐分享】有新的兑换订单";
					$text1="【WeShare乐分享】温暖正在向您狂奔而去,小乐稍后会和您联系的,生活总有不期而遇的温暖,希望您一直生活在一个暖暖的世界.";
					send_sms($apikey,$text,$mobile);
					send_sms($apikey,$text1,$towhotel);
				} 
				else{
					echo '0';
				}
		break;
	
	case 'book':
			$ordernum='EXO2015'.rand(100000,999999999);
			$bid=$_POST['bid'];
			$sql="select * from coursebook where bid='{$bid}'";
			$a=mysqli_query($link,$sql);
			while($r=mysqli_fetch_array($a)){
				$proname=$r['coursebook'];
				$proprice=$r['exchangeprice'];
				$propic=$r['bookpic'];
				$store=$r['store'];
			}
			$bywho=$_POST['username'];
			$school=$_POST['school'];
			$towhotel=$_POST['towhotel'];
			$remark=$_POST['remark'];
			$addtime=time();

			$sql1="insert into exchangeorder(oid,onum,bywho,towhotel,proname,proprice,propic,addtime,remark,school)
			values(null,'$ordernum','$bywho','$towhotel','$proname','$proprice','$propic','$addtime','$remark','$school')";
			$b=mysqli_query($link,$sql1);
			$id=mysqli_insert_id($link);
			if($id>0){
				$sql2="update user set rewardPoints=rewardPoints-$proprice where email='{$bywho}'";
				mysqli_query($link,$sql2);
				$sql5="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail) VALUES(null,'$bywho','$addtime','2','$proprice','集市兑换支出')";
		        mysqli_query($link,$sql5);
		        if($store<1){
		        	$sql3="update coursebook set store='0' where bid='{$bid}'";
		        }else{
		        	$sql3="update coursebook set store=store-1 where bid='{$bid}'";
		        }
				
				mysqli_query($link,$sql3);
			
				echo '1';
				$apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
				$mobile = "18501773419"; 
				$text="【WeShare乐分享】有新的兑换订单";
				$text1="【WeShare乐分享】温暖正在向您狂奔而去,小乐稍后会和您联系的,生活总有不期而遇的温暖,希望您一直生活在一个暖暖的世界.";
				send_sms($apikey,$text,$mobile);
				send_sms($apikey,$text1,$towhotel);
			} 
			else{
				echo '0';
	}
		break;


	case 'bookreorder':
			$ordernum='EXO2015'.rand(100000,999999999);
			$bid=$_POST['bid'];
			$sql="select * from coursebook where bid='{$bid}'";
			$a=mysqli_query($link,$sql);
			while($r=mysqli_fetch_array($a)){
				$proname=$r['coursebook'];
				$proprice=$r['recoverprice'];
				$propic=$r['bookpic'];
			}
			$bywho=$_POST['username'];
			$school=$_POST['school'];
			$bywhotel=$_POST['bywhotel'];
			$remark=$_POST['remark'];
			$addtime=time();

			$sql1="insert into bookreorder(school,oid,onum,bywho,bywhotel,proname,bookid,proprice,propic,addtime,remark,status,ordernote)
			values('$school',null,'$ordernum','$bywho','$bywhotel','$proname','$bid','$proprice','$propic','$addtime','$remark','0','')";
			echo $sql1;
			$b=mysqli_query($link,$sql1);
			$id=mysqli_insert_id($link);
			echo $id;
			if($id>0){
				echo '1';
				$apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
				$mobile = "18501773419"; 
				$text="【WeShare乐分享】有新的回收订单";
				$text1="【WeShare乐分享】您的回收订单已经提交成功,小乐会及时和您联系的,玩命的开心,放肆的幸福.";
				send_sms($apikey,$text,$mobile);
				send_sms($apikey,$text1,$bywhotel);
			} 
			else{
				echo '0';
	}

	break;

   }
}else{
	$ordernum='EXO2015'.rand(100000,999999999);
				$pid=$_POST['pid'];
				$sql="select * from exchangePro where pid='{$pid}'";
				$a=mysqli_query($link,$sql);
				while($r=mysqli_fetch_array($a)){
					$proname=$r['name'];
					$proprice=$r['price'];
					$propic=$r['pic'];
				}
				$bywho=$_POST['username'];
				$school=$_POST['school'];
				$towhotel=$_POST['towhotel'];
				$remark=$_POST['remark'];
				$addtime=time();

				$sql1="insert into exchangeorder(oid,onum,bywho,towhotel,proname,proprice,propic,addtime,remark,school)
				values(null,'$ordernum','$bywho','$towhotel','$proname','$proprice','$propic','$addtime','$remark','$school')";
				$b=mysqli_query($link,$sql1);
				$id=mysqli_insert_id($link);
				if($id>0){
					$sql2="update user set rewardPoints=rewardPoints-$proprice where email='{$bywho}'";
					mysqli_query($link,$sql2);
					$sql5="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail) VALUES(null,'$bywho','$addtime','2','$proprice','集市兑换支出')";
			        mysqli_query($link,$sql5);
					$sql3="update exchangePro set store=store-1 where pid='{$pid}'";
					mysqli_query($link,$sql3);
					
					echo '1';
					$apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
					$mobile = "18501773419"; 
					$text="【WeShare乐分享】有新的兑换订单";
					$text1="【WeShare乐分享】温暖正在向您狂奔而去,小乐稍后会和您联系的,生活总有不期而遇的温暖,希望您一直生活在一个暖暖的世界.";
					send_sms($apikey,$text,$mobile);
					send_sms($apikey,$text1,$towhotel);
				} 
				else{
					echo '0';
				}
}

                


	
?>