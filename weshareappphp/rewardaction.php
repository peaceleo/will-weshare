<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 

      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
      require('snsfunction.php');

      switch ($_POST['action']) {
        case 'rewardgiven':
            $usertel=$_POST['usertel'];
            $bywho=$_POST['bywho'];
            $reward=$_POST['reward'];
            $password=$_POST['password'];
            $sendtime=time();

            $sql="select * from user where email='{$bywho}'";
            $res=mysqli_query($link,$sql);
            $user=mysqli_fetch_assoc($res);
            if($user['password']==md5($password)){

                //享豆操作
              $sql1="update user set rewardPoints=rewardPoints+{$reward} where telphone='{$usertel}'";
              $sql2="update user set rewardPoints=rewardPoints-{$reward} where email='{$bywho}'";
              mysqli_query($link,$sql1);
              mysqli_query($link,$sql2);
                //享豆记录
              $sql9="select * from user where telphone='{$usertel}' ";
                    $res=mysqli_query($link,$sql9);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
              $sql3="insert into rewardrecord(rid,user,sendtime,type,price,detail,bywho,account) 
              values(null,'$usertel','$sendtime','1','$reward','友情转增','$bywho','$account')";
              mysqli_query($link,$sql3);

              $sql9="select * from user where email='{$bywho}' ";
                    $res=mysqli_query($link,$sql9);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
              $sql4="insert into rewardrecord(rid,user,sendtime,type,price,detail,bywho,account) 
              values(null,'$bywho','$sendtime','2','$reward','享豆转增','$bywho','$account')";
              mysqli_query($link,$sql4);
              if(mysqli_affected_rows($link)>0){
                echo '1';
              }else{
                echo '2';
              }
            }else{
              echo '0';
            }
        break;

          case 'shareAdd':
              $towho=$_POST['towho'];
              $sendtime=time();
              $price=$_POST['price'];
              $detail=$_POST['detail'];

              //用户享豆增加
                $sql2="update user set rewardPoints=rewardPoints+{$price} where email='{$towho}'";
                mysqli_query($link,$sql2);
              //享豆记录
                $sql9="select * from user where email='{$towho}' ";
                    $res=mysqli_query($link,$sql9);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
               $sql="insert into rewardrecord(rid,user,sendtime,type,price,detail,account) 
              values(null,'$towho','$sendtime','1','$price','$detail',$account)";
               mysqli_query($link,$sql);
               // echo $sql;
               //reminder
                 if(mysqli_affected_rows($link)>0){
                    echo '1';
                  }else{
                    echo '2';
                  }

          break;
      }

              
     
             mysqli_close($link);  


      ?>