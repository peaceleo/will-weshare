<?php
header("Content-type: text/html; charset=utf-8"); 
// error_reporting(0);

require("dbconfig.php");
require('dblink.php');
// require('sql.php');
require('snsfunction.php');
require_once(dirname(__FILE__) . '/' . 'igetui.php');
switch($_POST['action']){

    //订单状态 0:未完成  1:已完成   2:已取消
        case 'neworder':

           $ordernum='EXO2015'.rand(100000,999999999);
           $pid=$_POST['pid'];
           $sql="select * from exchangePro where pid='{$pid}'";
           $a=mysqli_query($link,$sql);
           while($r=mysqli_fetch_array($a)){
                  $proname=$r['name'];
                  $proprice=$r['price'];
                  $propic=$r['pic'];
                  $prodescription=$r['description'];
                  $prolocation=$r['prolocation'];
                  $owner=$r['publisher'];
            }
            $reciver=$_POST['username'];
            $school=$_POST['school'];
            $recivertel=$_POST['towhotel'];
            $remark=$_POST['remark'];
            $addtime=time();

            $sql1="insert into exchangeorder(oid,onum,owner,reciver,recivertel,proname,proprice,prodescription,prolocation,propic,addtime,remark,school)
            values(null,'$ordernum','$owner','$reciver','$recivertel','$proname','$proprice','$prodescription','$prolocation','$propic','$addtime','$remark','$school')";
            // echo $sql1;
            $b=mysqli_query($link,$sql1);
            $id=mysqli_insert_id($link);
            if($id>0){
              $sql2="update user set rewardPoints=rewardPoints-$proprice where email='{$reciver}'";
              mysqli_query($link,$sql2);
              $sql9="select * from user where email='{$reciver}' ";
                    $res=mysqli_query($link,$sql9);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
              $sql5="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$reciver','$addtime','2','$proprice','集市兑换支出','$account')";
                  mysqli_query($link,$sql5);
              $sql3="update exchangePro set store=store-1 where pid='{$pid}'";
              mysqli_query($link,$sql3);

              $sql6="insert into reminder(rid,content,bywho,towho,type,needid,sendtime,status) values(null,'您有一条兑换订单需要处理','$reciver','$owner','3','$ordernum','$addtime','0')";
              mysqli_query($link,$sql6);
              echo '1';
               $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
              $sql8="select * from user where email='{$owner}'";
              $res=mysqli_query($link,$sql8);
              while($r=mysqli_fetch_array($res)){
                  $clientid=$r['clientid'];
                  $token=$r['token'];
                  $ownertel=$r['telphone'];
              }
              $text1="【WeShare乐分享】您有一条新的兑换订单要处理哦";
              send_sms($apikey,$text1,$ownertel);

                 // $content='您有新的兑换订单,赶紧去看看吧!分享就是最好的拥有';
                 // $payload="{'title':'您有新的兑换订单','content':'赶紧去看看吧!分享就是最好的拥有','payload':'message'}";
                 // // echo $clientid;
                 // if($clientid!==''){
                 //       if($clientid===$token ){
                 //         pushMessageToSingle(createTranMessage($payload,$content), $clientid);
                 //       }else{
                 //          apnMessageToSingle($token, $content, $payload);
                 //       }

                 // }      

             
              $mobile = "18501773419"; 
              $text="【WeShare乐分享】有新的兑换订单";
              send_sms($apikey,$text,$mobile);
             
            } 
            else{
              echo '0';
            }
        break;

     case 'addnote':
          $ordernum=$_POST['ordernum'];
          $ordernote=$_POST['ordernote'];
          $sql="update exchangeorder set ordernote='{$ordernote}' where onum='{$ordernum}'";
          // echo $sql;
          mysqli_query($link,$sql);
          $result=mysqli_affected_rows($link);
          if($result>0){
            echo '1';
          }else{
            echo '0';
          }

     break;
     case 'finishorder':
          $ordernum=$_POST['onum'];
           $addtime=time();
          $sql="update exchangeorder set status=1 where onum='{$ordernum}'";
          mysqli_query($link,$sql);
          $result=mysqli_affected_rows($link);
          if($result>0){
            echo '1';
            //宝贝主人加享豆
            $sql="select * from exchangeorder where onum='{$ordernum}'";
            $res=mysqli_query($link,$sql);
            while($r=mysqli_fetch_array($res)){
               $owner=$r['owner'];
               $proprice=$r['proprice'];
               $reciver=$r['reciver'];

            }
            //宝贝主人加享豆
            $sql1="update user set rewardPoints=rewardPoints+$proprice where email='{$owner}'";
            mysqli_query($link,$sql1);
            // 享豆记录
            $sql9="select * from user where email='{$owner}' ";
                    $res=mysqli_query($link,$sql9);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
            $sql2="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$owner','$addtime','1','$proprice','集市共享收入','$account')";
            mysqli_query($link,$sql2);
            // 提醒
            $sql3="insert into reminder(rid,content,bywho,towho,type,needid,sendtime,status) values(null,'您有一笔共享收入','$reciver','$owner','4','$ordernum','$addtime','0')";
            mysqli_query($link,$sql3);

            $sql8="select * from user where email='{$owner}'";
              $res=mysqli_query($link,$sql8);
              while($r=mysqli_fetch_array($res)){
                  $clientid=$r['clientid'];
                  $token=$r['token'];
              }

               $content='您有一次分享收入.赶紧去看看吧！分享就是最好的拥有';
                 $payload="{'title':'您有一次分享收入','content':'赶紧去看看吧!分享就是最好的拥有','payload':'message'}";
                 // echo $clientid;
                 if($clientid!==''){
                       if($clientid===$token ){
                         pushMessageToSingle(createTranMessage($payload,$content), $clientid);
                       }else{
                          apnMessageToSingle($token, $content, $payload);
                       }

                 }      
          }else{
            echo '0';
          }

     break;
     case 'cancleorder':
          $ordernum=$_POST['onum'];
           $addtime=time();
          $sql="update exchangeorder set status=2 where onum='{$ordernum}'";
          mysqli_query($link,$sql);
          $result=mysqli_affected_rows($link);
          if($result>0){
            echo '1';
            //退还买家享豆
            $sql="select * from exchangeorder where onum='{$ordernum}'";
            $res=mysqli_query($link,$sql);
            while($r=mysqli_fetch_array($res)){
               $owner=$r['owner'];
               $proprice=$r['proprice'];
               $reciver=$r['reciver'];

            }
            //加享豆
            $sql1="update user set rewardPoints=rewardPoints+$proprice where email='{$reciver}'";
            mysqli_query($link,$sql1);
            // 享豆记录
            $sql9="select * from user where email='{$reciver}' ";
                    $res=mysqli_query($link,$sql9);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
            $sql2="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$reciver','$addtime','1','$proprice','兑换订单退还','$account')";
            mysqli_query($link,$sql2);
            // 提醒
            $sql3="insert into reminder(rid,content,bywho,towho,type,needid,sendtime,status) values(null,'您有一笔享豆退回','$owner','$reciver','4','$ordernum','$addtime','0')";
            mysqli_query($link,$sql3);

            $sql8="select * from user where email='{$reciver}'";
              $res=mysqli_query($link,$sql8);
              while($r=mysqli_fetch_array($res)){
                  $clientid=$r['clientid'];
                  $token=$r['token'];
              }

               $content='您有一笔享豆退还,赶紧去看看吧!分享就是最好的拥有';
                 $payload="{'title':'您有一笔享豆退还','content':'赶紧去看看吧!分享就是最好的拥有','payload':'message'}";
                 // echo $clientid;
                 if($clientid!==''){
                       if($clientid===$token ){
                         pushMessageToSingle(createTranMessage($payload,$content), $clientid);
                       }else{
                          apnMessageToSingle($token, $content, $payload);
                       }

                 }      
          }else{
            echo '0';
          }

     break;

     case 'addbookrenote':
          $ordernum=$_POST['ordernum'];
          $ordernote=$_POST['ordernote'];
          $sql="update bookreorder set ordernote='{$ordernote}' where onum='{$ordernum}'";
          // echo $sql;
          mysqli_query($link,$sql);
          $result=mysqli_affected_rows($link);
          if($result>0){
            echo '1';
          }else{
            echo '0';
          }

     break;
     case 'finishbookreorder':
          $ordernum=$_POST['ordernum'];
          $sendtime=time();
          //获取订单信息
          $sql0="select * from bookreorder where onum='{$ordernum}'";
          $res=mysqli_query($link,$sql0);
          while ($r=mysqli_fetch_array($res)) {
               $reprice=$r['proprice'];
               $bywho=$r['bywho'];
               $bywhotel=$r['bywhotel'];
               $bookid=$r['bookid'];

          }
         // 订单状态修改
          $sql1="update bookreorder set status=1 where onum='{$ordernum}'";
          mysqli_query($link,$sql1);
          // 书籍库存修改
          $sql2="update  coursebook set store=store+1 where bid='{$bookid}'";
          mysqli_query($link,$sql2);
          //用户享豆修改
          $sql3="update user set rewardPoints=rewardPoints+{$reprice}  where email='{$bywho}'";
          mysqli_query($link,$sql3);
          //享豆记录
          $sql4="insert into rewardrecord(rid,user,sendtime,type,price,detail) values(null,'$bywho','$sendtime','1','$reprice','书籍共享奖励')";
          mysqli_query($link,$sql4);
          // echo $sql4;
          //发送通知短信
          $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
          $text1="【WeShare乐分享】您的图书共享奖励已发放,请注意查收.生活总有不期而遇的温暖,希望您一直生活在一个暖暖的世界.";
          send_sms($apikey,$text,$bywhotel);
          $result=mysqli_affected_rows($link);
          if($result>0){
            echo '1';
          }else{
            echo '0';
          }

     break;
}
    

            
            
mysqli_close($link);  
?>








