<?php
header("Content-type: text/html; charset=utf-8"); 
// error_reporting(0);

require("dbconfig.php");
require('dblink.php');
// require('sql.php');
require('snsfunction.php');

require(dirname(__FILE__) . '/' . 'igetui.php');

                

switch($_POST['action']){

      case 'needpublish':
            $label=$_POST['needlabel'];
            $usertel=$_POST['usertel'];
          
            $remark=$_POST['addintro'];
            $publishtime=time();
            $user=$_POST['user'];
              $sql="select * from user where email='{$user}'";
              $a=mysqli_query($link,$sql);
              while($r=mysqli_fetch_array($a)){
                  $userlocation=$r['school'];
              }
            $needpay=$_POST['needpay'];
             $sql="INSERT INTO needlist(id,label,usertel,needtime,needlocation,remark,publishtime,user,status,needpay) 
            VALUES(null,'$label','$usertel',null,'$userlocation','$remark','$publishtime','$user','0','$needpay')";

              mysqli_query($link,$sql);
             $id=mysqli_insert_id($link);
              if($id>0){
                echo '1'; 
                // $telphone="18501773419";
                // $telphone2='15221915813';
                // $telphone3='18817362072';
                // $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                // $text="【WeShare乐分享】有新的需求！";
                // send_sms($apikey,$text,$telphone);
                // send_sms($apikey,$text,$telphone2);
                // send_sms($apikey,$text,$telphone3);
                 $contentb='【'.$label.'】'.$remark;
                
                 $contentc=mb_substr($contentb,0,40,'utf-8').'...';
                 
                 $payload="{'title':'同学来帮忙啦','content':'{$contentc}.被人需要是一种幸福!','payload':'message'}";
                 $content="同学来帮忙啦!".$contentc.'被人需要是一种幸福!';
                 pushMessageToapp(createTranMessage($payload,$content));
                
                

            $sql2="update user set rewardPoints=rewardPoints+10 where email='{$user}'";
            mysqli_query($link,$sql2);
            $sql="select * from user where email='{$user}' ";
                    $res=mysqli_query($link,$sql);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
            $sql3="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$user','$publishtime','1','10','需求发布奖励','$account')";
            mysqli_query($link,$sql3);
              }else{
                echo "2";
              }

      break;
      
      // case 'needhelp':
      //     $bywho=$_POST['bywho'];
      //     $usertel=$_POST['usertel'];
      //     $usertime=$_POST['usertime'];
      //     $sql="select * from  where usertel='{$usertel}'";
      //     mysqli_query($link,$sql);
      // break;

      case 'needdelete':
           $needid=$_POST['needid'];
           $sql="update needlist set status='2' where id='{$needid}'";
           $res=mysqli_query($link,$sql);
           if($res){
             echo '1';
           }else{
            echo '0';
           }
      break;
}
            
            
mysqli_close($link);  
?>








