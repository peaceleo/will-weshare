

          <?php
          session_start();
            header("Content-type: text/html; charset=utf-8"); 
            error_reporting(0);

          	require("dbconfig.php");
          	// require("mailfunction.php");
          	require('dblink.php');
            // require('fileupload.class.php');
             require('snsfunction.php');
             require_once(dirname(__FILE__) . '/' . 'igetui.php');

            $needid=$_POST['needid'];
            $bywho=$_POST['bywhostu'];
            $towho=$_POST['thanktowho'];
            $judge=$_POST['judge'];
            $needpay=$_POST['needpay'];
            $sendtime=time();
            //根据昵称获取email
           

            $sql="select * from user where nickname='{$towho}'";
            $b=mysqli_query($link,$sql);
            while ($r=mysqli_fetch_array($b)) {
                  $towhoemail=$r['email'];
                  $towhotelphone=$r['telphone'];
                  $clientid=$r['clientid'];
                  $token=$r['token'];
            }
            

            $sql="insert into thankorder(tid,judge,needpay,bywho,towho,needid,sendtime) values(null,'$judge','$needpay','$bywho','$towhoemail','$needid','$sendtime')";
             mysqli_query($link,$sql);
            $sql2="insert into reminder(rid,content,bywho,towho,type,needid,sendtime,status) values(null,'$judge','$bywho','$towhoemail','2','$needid','$sendtime','0')"; 
              mysqli_query($link,$sql2);
             $id=mysqli_insert_id($link);

             if($id>0){
                echo '1';
                
               $sql1= "update needlist set status='2' where id='{$needid}'";
               mysqli_query($link,$sql1);
               $sql2="update user set rewardPoints=rewardPoints+{$needpay} where email='{$towhoemail}'";
               mysqli_query($link,$sql2);
               $sql3="update user set rewardPoints=rewardPoints-{$needpay} where email='{$bywho}'";
               mysqli_query($link,$sql3);
               $sql4="update needlist set finishbywho='{$towhoemail}' where id='{$needid}'";
               mysqli_query($link,$sql4);
               $sql9="select * from user where email='{$towhoemail}' ";
                    $res=mysqli_query($link,$sql9);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
               $sql5="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$towhoemail','$sendtime','1','$needpay','需求完成奖励','$account')";
               mysqli_query($link,$sql5);
               $sql12="select * from user where email='{$bywho}' ";
                    $res=mysqli_query($link,$sql12);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
               $sql6="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$bywho','$sendtime','2','$needpay','需求完成支出','$account')";
               mysqli_query($link,$sql6);
                // $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                // $text="【WeShare乐分享】您有一条感谢信息,请及时登录平台查看.赠人玫瑰,手有余香.";
                // $sms=send_sms($apikey,$text,$towhotelphone);
                //消息推送
                  $contenta=mb_substr($judge,0,30,'utf-8').'...';
                 $content='您有一条感谢:'.$contenta.'.不负春光,不负好意,';
                 $payload="{'title':'您有一条感谢信息:','content':'{$content}.不负春光,不负好意.','payload':'message'}";
                 if($clientid!==''){
                      if($clientid===$token){
                       pushMessageToSingle(createTranMessage($payload,$content), $clientid);
                     }else{
                        apnMessageToSingle($token, $content, $payload);
                     }
                 }
                 

             } else{
                echo  '2';
             }
             mysqli_close($link);  
          ?>








