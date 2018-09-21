

          <?php
           session_start();
            header("Content-type: text/html; charset=utf-8"); 
            error_reporting(0);

          	require("dbconfig.php");
          	// require("mailfunction.php");
          	require('dblink.php');
            // require('fileupload.class.php');
             // require('snsfunction.php');
            require_once(dirname(__FILE__) . '/' . 'igetui.php');


            $needid=$_POST['needid'];
            $bywho=$_POST['bywho'];
            //根据昵称获取email
           

            $towho=$_POST['towho'];
             $sql="select * from user where email='{$towho}'";
            $b=mysqli_query($link,$sql);
            while ($r=mysqli_fetch_array($b)) {
                  $towhoemail=$r['email'];
                  $towhotelphone=$r['telphone'];
                  $clientid=$r['clientid'];
                  $token=$r['token'];
            }
            $message=$_POST['message'];
            $sendtime=time();
            $sql1="insert into helpermsg(id,message,bywho,towho,needid,sendtime) values(null,'$message','$bywho','$towhoemail','$needid','$sendtime')";
            $sql2="insert into reminder(rid,content,bywho,towho,type,needid,sendtime,status) values(null,'$message','$bywho','$towhoemail','0','$needid','$sendtime','0')";
             mysqli_query($link,$sql2);
             mysqli_query($link,$sql1);

                // $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                // $text="【WeShare乐分享】您有一条新的消息,请注意查收.被人需要是一种幸福哦!";
                // $sms=send_sms($apikey,$text,$towhotelphone);

               $contenta=mb_substr($message,0,30,'utf-8').'...';
                //消息推送
                 
                 $content='您有一条帮忙私信:'.$contenta.'不负春光,不负好意!';
                 $payload="{'title':'您有一条帮忙信息:','content':'{$contenta}.不负春光,不负好意!','payload':'message'}";
                 
                 if($clientid!==''){
                       if($clientid===$token ){
                         pushMessageToSingle(createTranMessage($payload,$content), $clientid);
                       }else{
                          apnMessageToSingle($token, $content, $payload);
                       }

                 }                
                 
             $id=mysqli_insert_id($link);
             if($id>0){
                echo '1';
               $sql0="select *  from needlist where id='{$needid}'";
               $res0=mysqli_query($link,$sql0);
               while($r0=mysqli_fetch_array($res0)){
                  $status=$r0['status'];
               }
               if($status==='2'){
                  $sql1= "update needlist set status='2' where id='{$needid}'";
               }else{
                  $sql1= "update needlist set status='1' where id='{$needid}'";

               }
                mysqli_query($link,$sql1);
               
             } else{
                echo  '2';
             }
             mysqli_close($link);  
          ?>








