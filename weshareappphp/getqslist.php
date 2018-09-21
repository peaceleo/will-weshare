<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 
     // error_reporting(0);
      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
        switch ($_POST['action']) {
            case 'someones':
            $username=$_POST['username'];
            $sql="select * from user where email='{$username}'";
            $result=mysqli_query($link,$sql);
            break;

            case 'certainQ':
            $username=$_POST['username'];
            $index=$_POST['index'];
            $indexpay=$index.'pay';
            $sql="select * from user where email='{$username}'";
            $result=mysqli_query($link,$sql);
            break;
            
          }
                         
        

       $data= array();
      while ($rows=mysqli_fetch_array($result)) {
           $q=$rows[$index];
           $qpay=$rows[$indexpay];
           $arr=array('q'=>$q,'qpay'=>$qpay);
           array_push($data,$arr);
      } 
           
           echo  json_encode($arr);
           mysqli_free_result($result);
           mysqli_close($link);  

      ?>