            

          <?php
          session_start();
            header("Content-type: text/html; charset=utf-8"); 
            // error_reporting(0);

          	require("dbconfig.php");
          	// require("mailfunction.php");

          	require('dblink.php');
            // require('fileupload.class.php');
             require('snsfunction.php');
            function  rank($username,$rewardpoints){
              require('dblink.php');
               if($rewardpoints>=500&&$rewardpoints<1500){
                $sqlrank="update user set rank='1' where email='{$username}'"; 
                mysqli_query($link,$sqlrank);
                      // if($userfinishedneed>=5 && $userfinishedneed<15){
                      //    $sqlrank="update user set rank='1' where email='{$username}'";
                         
                      // }
                      // else if($userfinishedneed>=15 && $userfinishedneed<35) {
                      //    $sqlrank="update user set rank='2' where email='{$username}'"; 
                         
                      // }
                      // else if($userfinishedneed>=35 && $userfinishedneed<65) {
                      //    $sqlrank="update user set rank='3' where email='{$username}'";
                          
                      // }
                      // else if($userfinishedneed>=65 && $userfinishedneed<105) {
                      //    $sqlrank="update user set rank='4' where email='{$username}'";
                          
                      // }
                      // else if($userfinishedneed>=105 && $userfinishedneed<155) {
                      //    $sqlrank="update user set rank='5' where email='{$username}'"; 
                        
                      // }
                      // else{
                      //    $sqlrank="update user set rank='1' where email='{$username}'"; 
                          
                      // }
               }else if($rewardpoints>=1500&&$rewardpoints<3500) {
                $sqlrank="update user set rank='2' where email='{$username}'";
                mysqli_query($link,$sqlrank); 
                      // if($userfinishedneed>=5 && $userfinishedneed<15){
                      //    $sqlrank="update user set rank='1' where email='{$username}'";
                         
                      // }
                      // else if($userfinishedneed>=15 && $userfinishedneed<35) {
                      //    $sqlrank="update user set rank='2' where email='{$username}'"; 
                          
                      // }
                      // else if($userfinishedneed>=35 && $userfinishedneed<65) {
                      //    $sqlrank="update user set rank='3' where email='{$username}'"; 
                          
                      // }
                      // else if($userfinishedneed>=65 && $userfinishedneed<105) {
                      //    $sqlrank="update user set rank='4' where email='{$username}'";
                         
                      // }
                      // else if($userfinishedneed>=105 && $userfinishedneed<155) {
                      //    $sqlrank="update user set rank='5' where email='{$username}'"; 
                          
                      // }
                      // else{
                      //    $sqlrank="update user set rank='2' where email='{$username}'";
                          
                      // }
               }else if($rewardpoints>=3500&&$rewardpoints<6500) {
                $sqlrank="update user set rank='3' where email='{$username}'"; 
                mysqli_query($link,$sqlrank);
                      // if($userfinishedneed>=5 && $userfinishedneed<15){
                      //    $sqlrank="update user set rank='1' where email='{$username}'"; 
                          
                      // }
                      // else if($userfinishedneed>=15 && $userfinishedneed<35) {
                      //    $sqlrank="update user set rank='2' where email='{$username}'"; 
                          
                      // }
                      // else if($userfinishedneed>=35 && $userfinishedneed<65) {
                      //    $sqlrank="update user set rank='3' where email='{$username}'";
                          
                      // }
                      // else if($userfinishedneed>=65 && $userfinishedneed<105) {
                      //    $sqlrank="update user set rank='4' where email='{$username}'"; 
                         
                      // }
                      // else if($userfinishedneed>=105 && $userfinishedneed<155) {
                      //    $sqlrank="update user set rank='5' where email='{$username}'"; 
                          
                      // }
                      // else{
                      //    $sqlrank="update user set rank='3' where email='{$username}'";
                          
                      // }
               }else if($rewardpoints>=6500&&$rewardpoints<10500) {
                $sqlrank="update user set rank='4' where email='{$username}'"; 
                mysqli_query($link,$sqlrank);
                // if($userfinishedneed>=5 && $userfinishedneed<15){
                //          $sqlrank="update user set rank='1' where email='{$username}'"; 
                          
                //       }
                //       else if($userfinishedneed>=15 && $userfinishedneed<35) {
                //          $sqlrank="update user set rank='2' where email='{$username}'"; 
                          
                //       }
                //       else if($userfinishedneed>=35 && $userfinishedneed<65) {
                //          $sqlrank="update user set rank='3' where email='{$username}'"; 
                          
                //       }
                //       else if($userfinishedneed>=65 && $userfinishedneed<105) {
                //          $sqlrank="update user set rank='4' where email='{$username}'";
                         
                //       }
                //       else if($userfinishedneed>=105 && $userfinishedneed<155) {
                //          $sqlrank="update user set rank='5' where email='{$username}'"; 
                          
                //       }
                //       else{
                //          $sqlrank="update user set rank='4' where email='{$username}'"; 
                         
                //       }
                 
               }else if($rewardpoints>=10500&&$rewardpoints<15500){
                $sqlrank="update user set rank='5' where email='{$username}'"; 
                mysqli_query($link,$sqlrank);
                      // if($userfinishedneed>=5 && $userfinishedneed<15){
                      //    $sqlrank="update user set rank='1' where email='{$username}'"; 
                          
                      // }
                      // else if($userfinishedneed>=15 && $userfinishedneed<35) {
                      //    $sqlrank="update user set rank='2' where email='{$username}'";
                          
                      // }
                      // else if($userfinishedneed>=35 && $userfinishedneed<65) {
                      //   $sqlrank="update user set rank='3' where email='{$username}'"; 
                        
                      // }
                      // else if($userfinishedneed>=65 && $userfinishedneed<105) {
                      //    $sqlrank="update user set rank='4' where email='{$username}'"; 
                          
                      // }
                      // else if($userfinishedneed>=105 && $userfinishedneed<155) {
                      //    $sqlrank="update user set rank='5' where email='{$username}'"; 
                         
                      // }
                      // else{
                      //   $sqlrank="update user set rank='5' where email='{$username}'"; 
                         
                      // }
               }else{
                $sqlrank="update user set rank='0' where email='{$username}'"; 
                mysqli_query($link,$sqlrank);
               }
              
            } 
            if($_POST['username']){
              $username=$_POST['username'];
              $sql="select * from user where email='{$username}' or telphone='{$username}'";
            }else if($_POST['usertel']){
               $usertel=$_POST['usertel'];
               $sql="select * from user where telphone='{$usertel}'";
            }
            
            // echo $sql;
            
            $result=mysqli_query($link,$sql);
            $data=array();
            while($row=mysqli_fetch_array($result)){
                $id=$row['id'];
                $nickname=$row['nickname'];
                $rewardpoints=$row['rewardPoints'];
                // $rewardpoints=10000;

                $email=$row['email'];
                //获取用户完成需求数目
                $sql="select * from needlist where finishbywho='{$email}'";
                $res=mysqli_query($link,$sql);
                $userfinishedneed=mysqli_num_rows($res);
                rank($username,$rewardpoints);

                $school=$row['school'];
                $sex=$row['sex'];
                $note=$row['note'];
                $head=$row['head'];
                $ident=$row['ident'];
                $act=array("0"=>"未认证","1"=>"认证中","2"=>"已认证");
                $active=$act[$row['active']];
                $addtime=$row['addtime'];
                $telphone=$row['telphone'];
                $lastlogintime=$row['lastlogintime'];
                $logintime=$row['logintime'];
                $sql="select * from needlist where needlocation='{$school}' and status<>'2' and publishtime between '{$lastlogintime}' and '{$logintime}'";
                $res=mysqli_query($link,$sql);
                $newneednum=mysqli_num_rows($res);
                $rank=array("0"=>"隐翼天使","1"=>"单翼天使","2"=>"双翼天使","3"=>"叁翼天使","4"=>"司翼天使","5"=>"舞翼天使",
                  "6"=>"流翼天使","7"=>"启翼天使","8"=>"霸翼天使","9"=>"玖翼天使","10"=>"诗翼天使");
                $rankname=$rank[$row['rank']];
                $ismanager=$row['isManager'];
               
               

            $arr=array('id'=>$id,'nickname'=>$nickname,'rewardpoints'=>$rewardpoints,'email'=>$email,'school'=>$school,
              'telphone'=>$telphone,'sex'=>$sex,'note'=>$note,'head'=>$head,'ident'=>$ident,'active'=>$active,
              'addtime'=>$addtime,'newneednum'=>$newneednum,'rankname'=>$rankname,'ismanager'=>$ismanager);
           
            array_push($data,$arr);
            }
            
              echo json_encode($data);

              mysqli_free_result($result);
              mysqli_close($link);  
          ?>







