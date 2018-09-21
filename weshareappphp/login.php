

          <?php
            // error_reporting(0);
            session_start();
            header("Content-type: text/html; charset=utf-8"); 

          	require("dbconfig.php");
          	// require("mailfunction.php");
          	require('dblink.php');
            // require('fileupload.class.php');
             require('snsfunction.php');
             // require_once(dirname(__FILE__) . '/' . 'igetui.php');
                
                // echo 'nihao';
            $username=$_POST['username'];
            $password=$_POST['password'];
            $clientid=$_POST['clientid'];
            $token=$_POST['token'];
            $appid=$_POST['appid'];
            $version=$_POST['version'];

            $logintime=time();
            
            $sql0="select * from user where email='{$username}' or telphone='{$username}'";
            // echo $sql0;
            $result=mysqli_query($link,$sql0);
            $user=mysqli_fetch_assoc($result);

            if($user){
              if($user['password']==md5($password)){
                echo '1';//login success
                $lastlogintime=$user['logintime'];
               
                $sql0="update user set lastlogintime='{$lastlogintime}' where email='{$username}'";
                $sql1="update user set logintime='{$logintime}' where email='{$username}'";
                $sql2="update user set clientid='{$clientid}',token='{$token}',appid='{$appid}',version='{$version}' where email='{$username}'";
                mysqli_query($link,$sql0);
                mysqli_query($link,$sql1);
                mysqli_query($link,$sql2);

                // $title='welcome';
                // $content='来看看吧';
                // $payload=null;
                // pushMessageToSingle(createNotiMessage($title, $content, $payload), $clientid);

              }
              else{
                echo '2';
              }
            }else{
              echo  '0';// user does not exist
            }
              mysqli_close($link);  
          ?>








