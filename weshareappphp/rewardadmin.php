<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 

      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
      require('snsfunction.php');

      switch ($_GET['action']) {
    
        
        case 'rewardadd':
              $user=$_POST['usertelphone'];
              $sendtime=time();
              $price=$_POST['price'];
             
              $detail=$_POST['detail'];
              $bywho=$_POST['bywho'];
              

              
              $sql="insert into rewardrecord(rid,user,sendtime,type,price,detail,bywho) 
              values(null,'$user','$sendtime','1','$price','$detail','$bywho')";
              
               $sql2="update user set rewardPoints=rewardPoints+{$price} where telphone='{$user}'";

             
              mysqli_query($link,$sql);
              mysqli_query($link,$sql2);
         
              $res=mysqli_affected_rows($link);
              if($res>0){
                $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                $text="【WeShare乐分享】您的享豆充值已到账,请注意查收.被人需要是一种幸福哦!";
                $sms=send_sms($apikey,$text,$user);
                echo "<script>alert('充值成功')</script>";
                echo "<script>window.history.back(-1);</script>";
              }else{
                echo "<script>alert('充值失败')</script>";
              }
          break;
      }

              
     
             mysqli_close($link);  


      ?>