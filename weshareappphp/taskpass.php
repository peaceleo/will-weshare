<?
	header("Content-type:text/html;charset=utf-8");

	require('dbconfig.php');
	require('dblink.php');
    require('snsfunction.php');

	switch ($_POST['action']) {
		case 'passresult':
			$aid=$_POST['aid'];
			$taskpay=$_POST['taskpay'];
			$bywho=$_POST['bywho'];
			$time=time();
			$sql0="update taskresult set status='1' where aid='{$aid}'";
			$sql1="update user set rewardPoints=rewardPoints+{$taskpay} where email='{$bywho}'";
			mysqli_query($link,$sql0);
			mysqli_query($link,$sql1);
			$sql="select * from user where email='{$bywho}' ";
                    $res=mysqli_query($link,$sql);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
			$sql4="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$bywho','$time','1','$taskpay','任务通过奖励','$account')";
            mysqli_query($link,$sql4);
            $res=mysqli_affected_rows($link);
            if($res>0){
            	echo "通过成功";
            	$sql2="select * from user where email='{$bywho}'";
            	$result=mysqli_query($link,$sql2);
            	while($rows=mysqli_fetch_array($result)){
            		$telphone=$rows['telphone'];
            	}
            	$apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                $text="【WeShare乐分享】恭喜您,您提交的任务成果已经通过.您获取的享豆已经充值到您的帐户上.谢谢您的参与.被人需要是一种幸福.";
                $sms=send_sms($apikey,$text,$telphone);
            }else{
            	echo "通过失败";
            }
			
			
		break;
		
		case 'taskfinish':
			$tid=$_POST['tid'];
			$sql="update tasklist set status='1' where tid='{$tid}'";
			mysqli_query($link,$sql);
			echo '已经标记完成';	
		break;
	}

	
	

?>