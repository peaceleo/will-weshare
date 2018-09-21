<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 
     error_reporting(0);
      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
      require('snsfunction.php');
     
       
        switch ($_POST['action']){

            case 'answer':
             $username=$_POST['username'];
             $q1=$_POST['q1'];
             $q1pay=$_POST['q1pay'];
             $q2=$_POST['q2'];
             $q2pay=$_POST['q2pay'];
             $q3=$_POST['q3'];
             $q3pay=$_POST['q3pay'];
             $q4=$_POST['q4'];
             $q4pay=$_POST['q4pay'];
             $q5=$_POST['q5'];
             $q5pay=$_POST['q5pay'];
             $q6=$_POST['q6'];
             $q6pay=$_POST['q6pay'];
             $q7=$_POST['q7'];
             $q7pay=$_POST['q7pay'];
             $q8=$_POST['q8'];
             $q8pay=$_POST['q8pay'];
             $q9=$_POST['q9'];
             $q9pay=$_POST['q9pay'];
             $sql="update user set q1='{$q1}',q1pay='{$q1pay}',q2='{$q2}',q2pay='{$q2pay}',q3='{$q3}', q3pay='{$q3pay}',q4='{$q4}',q4pay='{$q4pay}',q5='{$q5}',q5pay='{$q5pay}',q6='{$q6}',q6pay='{$q6pay}',q1='{$q1}',q1pay='{$q1pay}',q8='{$q8}',q8pay='{$q8pay}',q9='{$q9}',q9pay='{$q9pay}' where email='{$username}'";
             
           
             $a=mysqli_query($link,$sql);
           $rows=mysqli_affected_rows($link);
           if($rows>0){
            echo '1';
           }
           else{
            echo '0';
           }
            break; 

            case 'payforqa':
                $bywho=$_POST['bywho'];
                $towho=$_POST['towho'];
                $pay=$_POST['pay'];
                $time=time();
                //更新话题讨论点赞数
                //减享豆，并计入享豆纪录
                $sql1="update  user set rewardPoints=rewardPoints-{$pay} where email='{$bywho}'";
                mysqli_query($link,$sql1);
                 $sql5="select * from user where email='{$bywho}' ";
                    $res=mysqli_query($link,$sql5);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
                $sql2="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$bywho','$time','2','$pay','九问支出','$account')";
                mysqli_query($link,$sql2);
                

                //加享豆，并计入享豆纪录
                $sql3="update  user set rewardPoints=rewardPoints+{$pay} where email='{$towho}'";
                mysqli_query($link,$sql3);
                 $sql6="select * from user where email='{$towho}' ";
                    $res=mysqli_query($link,$sql6);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
                $sql4="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$towho','$time','1','$pay','九问收入','$account')";
                 mysqli_query($link,$sql4);
               
                
                 if(mysqli_affected_rows($link)){
                    echo '1';
                  }else{
                    echo '0';
                  }

            break;

          }
                         
      

      ?>