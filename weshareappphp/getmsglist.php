<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 

      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');

              $needid=$_POST['needid'];
              $bywho=$_POST['bywho'];
              $towho=$_POST['towho'];
              


              $sql="select * from helpermsg where needid='{$needid}' and (bywho='{$bywho}' or towho='{$bywho}')order by id desc";
              $result=mysqli_query($link,$sql);
          

      $data= array();
      while ($row=mysqli_fetch_array($result)) {
           $id =$row['id']; 
           $message=$row['message'];
           $bywhoemail=$row['bywho'];
            $sql="select * from user where email='{$bywhoemail}'";

                   $c=mysqli_query($link,$sql);
                     while($r=mysqli_fetch_array($c)){
                         $bywho=$r['nickname'];
                         $bywhohead=$r['head'];
                         $bywhosex=$r['sex'];
                     }
           $publishtime=$row['sendtime'];
           $towhoemail =$row['towho'];
           $sql="select * from user where email='{$towhoemail}'";

                   $c=mysqli_query($link,$sql);
                     while($r=mysqli_fetch_array($c)){
                         $towho=$r['nickname'];
                     }
           $needid=$row['needid'];
           $arr=array('id'=>$id,'message'=>$message,'bywhoemail'=>$bywhoemail,'bywho'=>$bywho,'bywhohead'=>$bywhohead,'bywhosex'=>$bywhosex,'towho'=>$towho,'publishtime'=>$publishtime,'needid'=>$needid);
           array_push($data,$arr);   
      } 
 
           echo  json_encode($data);
            mysqli_free_result($result);
           mysqli_close($link);  


      ?>