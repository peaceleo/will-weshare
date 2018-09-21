<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 

      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');

              $username=$_POST['username'];
              $sql1="select * from user where email='{$username}'";
              $result=mysqli_query($link,$sql1);
              while($row=mysqli_fetch_array($result)){
                 $usertel=$row['telphone'];
              }
              $nowtime=time()-60*60*24*30;
              $sql="select * from rewardrecord where (user='{$username}' or user='{$usertel}') and sendtime>{$nowtime}   order by rid desc";
              // echo $sql;
              $result=mysqli_query($link,$sql);
         

      $data= array();
      while ($row=mysqli_fetch_array($result)) {
           $rid=$row['rid'];
           $sendtime=$row['sendtime'];
           $type=$row['type'];
           $price=$row['price'];
           $detail=$row['detail'];
           $account=$row['account'];
           $arr=array('rid'=>$rid,'sendtime'=>$sendtime,'type'=>$type,'price'=>$price,'detail'=>$detail,'account'=>$account);
            
           array_push($data,$arr);   
      } 
 
           echo  json_encode($data);
            mysqli_free_result($result);
           mysqli_close($link);  


      ?>