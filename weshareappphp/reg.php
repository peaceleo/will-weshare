

          <?php
            error_reporting(0);
              header("Content-type: text/html; charset=utf-8"); 

          	require("dbconfig.php");
          	// require("mailfunction.php");

          	require('dblink.php');
            // require('fileupload.class.php');
             require('snsfunction.php');



            switch ($_POST['action']) {
              case 'sendsms':
               $smsnuma=rand(1000,9999);
                $telphone=$_POST['telphone'];
                
                $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                $text="【WeShare乐分享】您的验证码是:".$smsnuma;
                $sms=send_sms($apikey,$text,$telphone);
                if($sms){
                  echo $smsnuma;
                }
                
                break;
              
              case 'reg':
                $school=$_POST['school'];
                $stunum=$_POST['stunum'];
                $password=md5($_POST['password']);
                $telphone=$_POST['telphone'];
                $nickname=$_POST['stunum'];
                $email=$stunum;
                $clientid=$_POST['clientid'];
                $token=$_POST['token'];
                $appid=$_POST['appid'];
                $version=$_POST['version'];
                $addtime=time();
                
                  //判断是否已经注册过
                $sql="select * from user where telphone='{$telphone}'";
                $result=mysqli_query($link,$sql);
                $resrows=mysqli_num_rows($result);
                 $sql2="select * from user where email='{$email}'";
                $result2=mysqli_query($link,$sql2);
                $resrows2=mysqli_num_rows($result2);
                if($resrows>0){
                  echo '0';
                }else if($resrows2>0){
                  echo '3';
                }else{
                  $sql="insert into user(id,nickname,email,password,school,telphone,addtime,clientid,token,appid,version)
                  values(null,'$nickname','$email','$password','$school','$telphone','$addtime','$clientid','$token','$appid','$version')";
                  
                  mysqli_query($link,$sql);
                  $id=mysqli_insert_id($link);
                  if($id>0){
                    echo '1';
                    $telphone='18501773419';
                    $telphone2='15221915813';
                    $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                    $text="【WeShare乐分享】weshare又有新的注册用户啦!";
                    send_sms($apikey,$text,$telphone);
                    send_sms($apikey,$text,$telphone2);
                     $sql3="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$email','$addtime','1','100','注册认证奖励','100')";
                      mysqli_query($link,$sql3);

                  }else{
                    echo "2";
                  }
                } 
                break; 

              case 'resetpass':
                 $telphone=$_POST['telphone'];
                 $password=md5($_POST['password']);
                 $sql="update user set password='{$password}' where telphone='{$telphone}'";
                 mysqli_query($link,$sql);
                 $id=mysqli_affected_rows($link);
                 if($id>0){
                  echo '1';
                  }else{
                    echo '0';
                  }
                break;
            }

            
            
               mysqli_close($link);  
          ?>








