<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 
     // error_reporting(0);
      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
      require('snsfunction.php');

    
        switch ($_POST['action']){
         
          case 'rewardrank':
              $school=$_POST['school'];
             $sql="select *  from user where school='{$school}' and email!='11307100199' order  by rewardPoints DESC limit 10";
             // echo $sql;
           $result=mysqli_query($link,$sql);
           $data=array();
           while($rows=mysqli_fetch_array($result)){
              $id=$rows['id'];
              $nickname=$rows['nickname'];
              $rewardPoints=$rows['rewardPoints'];
              $email=$rows['email'];
              $sex=$rows['sex'];
              $telphone=$rows['telphone'];
              $note=$rows['note'];
              $addtime=$rows['addtime'];
              $head=$rows['head'];
              $ident=$rows['ident'];
              $active=$rows['active'];
              $rank=$rows['rank'];
              $arr=array('id'=>$id,'email'=>$email,'nickname'=>$nickname,'num'=>$rewardPoints,'head'=>$head,'ident'=>$ident,'active'=>$active,'rank'=>$rank);
              array_push($data, $arr);
           }
           echo json_encode($data);
           mysqli_free_result($result);
           break;

          case 'pubneedrank':
              $school=$_POST['school'];
                $sql="select user,count(*) as c from needlist where needlocation='{$school}' and user!='11307100199' group by user order by count(*) desc limit 10";
               $result=mysqli_query($link,$sql);
               $data=array();
                while ($rowss=mysqli_fetch_array($result)) {
                 $user=$rowss['user'];
                 //查询用户具体信息
                       $sql0="select * from user where email='{$user}'";
                       $res=mysqli_query($link,$sql0);
                       while($rows=mysqli_fetch_array($res)){
                        $id=$rows['id'];
                        $nickname=$rows['nickname'];
                        $rewardPoints=$rows['rewardPoints'];
                        $email=$rows['email'];
                        $sex=$rows['sex'];
                        $telphone=$rows['telphone'];
                        $note=$rows['note'];
                        $addtime=$rows['addtime'];
                        $head=$rows['head'];
                        $ident=$rows['ident'];
                        $active=$rows['active'];
                        $rank=$rows['rank'];
                       }
                $num=$rowss['c'];
                $arr=array('user'=>$user,'email'=>$email,'nickname'=>$nickname,'head'=>$head,'num'=>$num);
                 array_push($data, $arr);
               }      
               echo json_encode($data);
              mysqli_free_result($result);  
             break;

          case 'finneedrank':

          $school=$_POST['school'];
          $sql="select finishbywho,count(*) as c from needlist where needlocation='{$school}' and finishbywho!='' and finishbywho!='11307100199' group by finishbywho order by count(*) desc limit 10";
          $result=mysqli_query($link,$sql);
               $data=array();
                while ($rowss=mysqli_fetch_array($result)) {
                 $user=$rowss['finishbywho'];
                 //查询用户具体信息
                       $sql0="select * from user where email='{$user}'";
                       $res=mysqli_query($link,$sql0);
                       while($rows=mysqli_fetch_array($res)){
                        $id=$rows['id'];
                        $nickname=$rows['nickname'];
                        $rewardPoints=$rows['rewardPoints'];
                        $email=$rows['email'];
                        $sex=$rows['sex'];
                        $telphone=$rows['telphone'];
                        $note=$rows['note'];
                        $addtime=$rows['addtime'];
                        $head=$rows['head'];
                        $ident=$rows['ident'];
                        $active=$rows['active'];
                        $rank=$rows['rank'];
                       }
                $num=$rowss['c'];
                $arr=array('user'=>$user,'email'=>$email,'nickname'=>$nickname,'head'=>$head,'num'=>$num);
                 array_push($data, $arr);
               }      
               echo json_encode($data);
              mysqli_free_result($result);
          break; 

             case 'interrank':
             $school=$_POST['school'];
             $sql="select bywho,count(*) as c from reminder where school='{$school}' and bywho!='' and bywho!='11307100199' group by bywho order by count(*) desc limit 10";
             $result=mysqli_query($link,$sql);
               $data=array();
                while ($rowss=mysqli_fetch_array($result)) {
                 $user=$rowss['bywho'];
                 //查询用户具体信息
                       $sql0="select * from user where email='{$user}'";
                       $res=mysqli_query($link,$sql0);
                       while($rows=mysqli_fetch_array($res)){
                        $id=$rows['id'];
                        $nickname=$rows['nickname'];
                        $rewardPoints=$rows['rewardPoints'];
                        $email=$rows['email'];
                        $sex=$rows['sex'];
                        $telphone=$rows['telphone'];
                        $note=$rows['note'];
                        $addtime=$rows['addtime'];
                        $head=$rows['head'];
                        $ident=$rows['ident'];
                        $active=$rows['active'];
                        $rank=$rows['rank'];
                       }
                $num=$rowss['c'];
                $arr=array('user'=>$user,'email'=>$email,'nickname'=>$nickname,'head'=>$head,'num'=>$num);
                 array_push($data, $arr);
               }      
               echo json_encode($data);
              mysqli_free_result($result);   
             break; 

          }
                         
      

      ?>