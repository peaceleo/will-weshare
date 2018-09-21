<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 
     // error_reporting(0);
      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
       
        
    
        switch ($_POST['action']) {
          case 'neednum':
                $school=$_POST['school'];
                $sql0="select * from needlist where needlocation='{$school}' and status='0' ";
                $sql1="select * from needlist where needlocation='{$school}' and status='1' ";
                $sql2="select * from needlist where needlocation='{$school}' and status='2' ";
                $res0= mysqli_query($link,$sql0);
                $res1= mysqli_query($link,$sql1);
                $res2= mysqli_query($link,$sql2);
                $maxRows0=mysqli_num_rows($res0); 
                $maxRows1=mysqli_num_rows($res1); 
                $maxRows2=mysqli_num_rows($res2);
                $data=array('needingNum'=>$maxRows0,'helpingNum'=>$maxRows1,'finishedNum'=>$maxRows2);
                echo  json_encode($data);

            break;
          case 'tasknum':
                $school=$_POST['school'];
                $sql0="select * from tasklist where school='{$school}' and status='0' and type='task'";
                $sql1="select * from tasklist where school='{$school}' and status='1' and type='task'";
                $res0= mysqli_query($link,$sql0);
                $res1= mysqli_query($link,$sql1);
                $maxRows0=mysqli_num_rows($res0); 
                $maxRows1=mysqli_num_rows($res1); 
                $data=array('actingNum'=>$maxRows0,'finishedNum'=>$maxRows1);
                echo  json_encode($data);

            break;
            case 'actinum':
                $school=$_POST['school'];
                $sql0="select * from tasklist where school='{$school}' and status='0' and type='acti'";
                $sql1="select * from tasklist where school='{$school}' and status='1' and type='acti'";
                $res0= mysqli_query($link,$sql0);
                $res1= mysqli_query($link,$sql1);
                $maxRows0=mysqli_num_rows($res0); 
                $maxRows1=mysqli_num_rows($res1); 
                $data=array('actingNum'=>$maxRows0,'finishedNum'=>$maxRows1);
                echo  json_encode($data);

            break;

             
          }
      
      ?>