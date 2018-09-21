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
           case 'getnickname':

              $email=$_POST['email'];

              $sql="select * from user where email='{$email}'";
              
              $result=mysqli_query($link,$sql);
              while ($rows=mysqli_fetch_array($result)) {
                 $nickname=$rows['nickname'];
              }
        
              echo $nickname;
           break;

           case 'getusertel':
              $email=$_POST['username'];
              $sql="select * from user where email='{$email}'";
              $result=mysqli_query($link,$sql);
              while ($rows=mysqli_fetch_array($result)) {
                 $usertel=$rows['telphone'];
                 
              }
              echo $usertel;
           break;

           case 'getallusers':
          

           $school=$_POST['school'];
           $type=$_POST['type'];
           if($school=='所有学校'){
              if($type=='all'){
                 $sql="select * from user order by id desc";
               }else{
                 $sql="select * from user  where  active='{$type}'order by id desc";
               }
           }else{
              if($type=='all'){
                  $sql="select * from user where school='{$school}' order by id desc";
              }else{
                $sql="select * from user where school='{$school}' and active='{$type}'order by id desc";
              }
           }
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
              $arr=array('id'=>$id,'nickname'=>$nickname,'rewardPoints'=>$rewardPoints,'email'=>$email,'sex'=>$sex,
                'telphone'=>$telphone,'note'=>'$note','addtime'=>$addtime,'head'=>$head,'ident'=>$ident,'active'=>$active,'rank'=>$rank);
              array_push($data, $arr);
           }
           echo json_encode($data);
           mysqli_free_result($result);
           break;


            case 'singleuser':
           // $school='复旦大学';
           $userid=$_POST['userid'];
           $usertel=$_POST['usertelphone'];
           if($userid){
             $sql="select * from user where id='{$userid}'";
           }else if($usertel){
             $sql="select * from user where telphone='{$usertel}'";
           }
          
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
              $arr=array('id'=>$id,'nickname'=>$nickname,'rewardPoints'=>$rewardPoints,'email'=>$email,'sex'=>$sex,
                'telphone'=>$telphone,'note'=>$note,'addtime'=>$addtime,'head'=>$head,'ident'=>$ident,'active'=>$active,'rank'=>$rank);
              array_push($data, $arr);
           }
           echo json_encode($data);
           mysqli_free_result($result);
           break;


           case 'passident':
           $userid=$_POST['userid'];
           $sql="update user set active='2' where id='{$userid}'";
           $a=mysqli_query($link,$sql);
           $sql="select * from user where id='{$userid}'";
               $result=mysqli_query($link,$sql);
                 while ($rows=mysqli_fetch_array($result)) {
                       $usertel=$rows['telphone'];
                 
                }
                $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                $text="【WeShare乐分享】小乐给您报喜了,您的身份认证已经通过.我们分享温暖,我们收获感动,在这儿,您永远不会是一个人.";
                send_sms($apikey,$text,$usertel);
           $rows=mysqli_affected_rows($link);
           // if($rows>0){
           //  echo '1';
                

           // }else{
           //  echo '0';
           // }
           break;


           case 'failident':
           $userid=$_POST['userid'];
           $wcode=$_POST['wcode'];
           $sql="select * from user where id='{$userid}'";
           $sql1="update user set active=0 where id='{$userid}'";
           mysqli_query($link,$sql1);
               $result=mysqli_query($link,$sql);
                 while ($rows=mysqli_fetch_array($result)) {
                       $usertel=$rows['telphone'];
                 
                }
                $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                $text="【WeShare乐分享】小乐很抱歉的告诉您,您的身份认证失败了,我们再去试试.失败原因:".$wcode;
                $sms=send_sms($apikey,$text,$usertel);
                if($sms){
                  echo '1';
                }
                else{
                  echo '0';
                }
           break;

          }
                         
      

      ?>