

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
            $comment=$_POST['needcomment'];
            $sendtime=time();
            $sql="insert into comment(cid,comment,bywho,towho,needid,sendtime) values(null,'$comment','$bywho','$towhoemail','$needid','$sendtime')";
            
            mysqli_query($link,$sql);
            
             $id=mysqli_insert_id($link);
             if($id>0){
                echo '1';
             $sql2="insert into reminder(rid,content,bywho,towho,type,needid,sendtime,status) values(null,'$comment','$bywho','$towhoemail','1','$needid','$sendtime','0')";
             $sql3="update user set rewardPoints=rewardPoints+2 where email='{$bywho}'";
            
            
            
                mysqli_query($link,$sql2);
                mysqli_query($link,$sql3);
                 $sql="select * from user where email='{$bywho}'";
                    $res=mysqli_query($link,$sql);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
                 $sql4="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$bywho','$sendtime','1','2','需求评论奖励','$account')";     
                mysqli_query($link,$sql4);  
                 $contenta=mb_substr($comment,0,30,'utf-8').'...';

                 $content='您有一条评论回复哦:'.$contenta.'.不负春光,不负好意!';
                 $payload="{'title':'您有一条评论回复哦:','content':'{$contenta}.不负春光,不负好意!','payload':'message'}";
                 if($clientid!==''){
                  // echo $clientid;
                      if($clientid===$token){
                         pushMessageToSingle(createTranMessage($payload,$content), $clientid);
                       }else{
                          apnMessageToSingle($token, $content, $payload);
                       }
                 }
                 
             } else{
                echo  '2';
             }
             mysqli_free_result($b);
             mysqli_close($link); 
             
          ?>








