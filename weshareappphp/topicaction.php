<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 
       error_reporting(0);
      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
      require('snsfunction.php');
      require_once(dirname(__FILE__) . '/' . 'igetui.php');
        $pageSize=8;
        $maxPages=0;
        $maxRows=0;
                
       
      switch ($_POST['action']){
              
          case 'topicpub':
            $school=$_POST['school'];
            $publisher=$_POST['user'];
            $topictype=$_POST['topictype'];
            $topicname=$_POST['topicname'];
            $topicintro=$_POST['topicintro'];
            $topicnotice=$_POST['topicnotice'];

            $time=time();
            $sql0=" INSERT INTO topiclist(school,tid,topictype,topictitle,topicintro,topicnotice,publishtime,publisher,status) values('$school',null,'$topictype','$topicname','$topicintro','$topicnotice','$time','$publisher','1')";
            
            mysqli_query($link,$sql0);
            $id=mysqli_insert_id($link);
            if($id>0){
              echo '1';
                   $telphone='18501773419';
                   $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                   $text="【WeShare乐分享】有新的话题";
                   send_sms($apikey,$text,$telphone);
            }else{
              echo '0';
            }
          break; 

          case 'topiccomment':
            $comment=$_POST['topiccomment'];
            $bywho=$_POST['bywho'];
            $topicid=$_POST['topicid'];
            $time=time();
            
            $sql0="INSERT INTO topiccomment(tcid,comment,bywho,topicid,sendtime) values(null,'$comment','$bywho','$topicid','$time')";
            mysqli_query($link,$sql0);
            $id=mysqli_insert_id($link);
            if($id>0){
              echo '1';
            $sql1="update topiclist set commentnum=commentnum+1 where tid='{$topicid}'";
            $sql2="update user set rewardPoints=rewardPoints+5 where email='{$bywho}'";
            mysqli_query($link,$sql1);
            mysqli_query($link,$sql2);
             $sql="select * from user where email='{$bywho}' ";
                    $res=mysqli_query($link,$sql);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
            $sql3="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$bywho','$time','1','5','话题评论奖励','$account')"; 
            
           
            mysqli_query($link,$sql3);
            }else{
              echo '0';
            }
          break; 

          case  'getcomment':
            $page=$_POST['page'];
            $tid=$_POST['tid'];
            $rank=$_POST['rank'];
            $sql0="select * from topiccomment where topicid='{$tid}' ";

           
            $res=mysqli_query($link,$sql0);
            $maxRows=mysqli_num_rows($res);
            $maxPages=ceil($maxRows/$pageSize);

             if($page>$maxPages){
                  $page=$maxPages;
                 }if($page<1){
                  $page=1;
                 } 
             $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";

             if($rank==='bytime'){
               $sql1="select * from topiccomment where topicid='{$tid}'  order by sendtime desc {$limit}";
            }
            if($rank==='byhot'){
               $sql1="select * from topiccomment where topicid='{$tid}'  order by pridenum desc {$limit}";
            }
            // echo $sql1;
            $result=mysqli_query($link,$sql1);
            $data=array();
            while($rows=mysqli_fetch_array($result)){
              $tcid=$rows['tcid'];
              $comment=$rows['comment'];
              $bywhoemail=$rows['bywho'];
                  //查询用户信息
                  $sql1="select * from user where email='{$bywhoemail}'";
                  $res=mysqli_query($link,$sql1);
                  while($r=mysqli_fetch_array($res)){
                    $bywhonickname=$r['nickname'];
                    $bywhohead=$r['head'];
                  }
              $topicid=$rows['topicid'];
              $sendtime=$rows['sendtime'];
              $pridenum=$rows['pridenum'];
              $arr=array('tcid'=>$tcid,'comment'=>$comment,'bywhoemail'=>$bywhoemail,'bywhonickname'=>$bywhonickname,'bywhohead'=>$bywhohead,
                'sendtime'=>$sendtime,'pridenum'=>$pridenum,'maxrows'=>$maxRows,'maxPages'=>$maxPages);
              array_push($data, $arr);

             }
             echo json_encode($data);
             mysqli_free_result($result);
             mysqli_close($link);  
          break;


          case 'coltopic':
                  $username=$_POST['username'];
                  $topicid=$_POST['tid'];
                  //1.把用户对应的收藏话题列表取出来
                  $sql0="select coltopic from user where email='{$username}'";
                  $result=mysqli_query($link,$sql0);
                  while($r=mysqli_fetch_array($result)){
                      $coltopic=$r['coltopic'];
                  }
                  //2.将收藏列表转为数组，并将新收藏的tid存入
                  $a=explode('|', $coltopic);
                  array_push($a, $topicid);
                  //3.将新的数组转为字符串，存入数据库
                  $b=implode('|', $a);
                  $sql1="update user set coltopic='{$b}' where email='{$username}'";
                  mysqli_query($link,$sql1);
                  if(mysqli_affected_rows($link)){
                    echo '1';
                  }else{
                    echo '0';
                  }
          break;


          case 'getcoltopic':
                $username=$_POST['username'];
                $sql0="select * from user where email='{$username}'";
                $res1=mysqli_query($link,$sql0);
                while($r1=mysqli_fetch_array($res1)){
                      $coltopic=$r1['coltopic'];  
                }
                $a=explode('|', $coltopic);
                $data=array();
                foreach ($a as $topicid=> $value) { 
                     $sql1="select * from topiclist where tid='{$value}'";
                     $res2=mysqli_query($link,$sql1);
                     while($row=mysqli_fetch_array($res2)){
                            $tid=$row['tid'];
                            $topictype=$row['topictype'];
                            $topictitle=$row['topictitle'];
                            $topicintro=$row['topicintro'];
                            $topicnotice=$row['topicnotice'];
                            $publishtime=$row['publishtime'];
                            $publisher=$row['publisher'];
                                $sql0="select * from user where email='{$publisher}'";
                                $res=mysqli_query($link,$sql0);
                                while($r=mysqli_fetch_array($res)){
                                  $publishername=$r['nickname'];
                                }
                            $commentnum=$row['commentnum'];
                            $status=$row['status'];
                            $arr=array('tid'=>$tid,'topictype'=>$topictype,'topictitle'=>$topictitle,'topicintro'=>$topicintro,'topicnotice'=>$topicnotice,
                              'publishtime'=>$publishtime,'publisher'=>$publisher,'publishername'=>$publishername,'commentnum'=>$commentnum,'status'=>$status);
                           array_push($data,$arr);  
                     }      

                }
                 echo json_encode($data);


          break; 

          case 'iscoltopic':
               $username=$_POST['username'];
               $tid=$_POST['tid'];
               $sql0="select * from user where email='{$username}'";
                $res1=mysqli_query($link,$sql0);
                while($r1=mysqli_fetch_array($res1)){
                      $coltopic=$r1['coltopic'];  
                }
                $a=explode('|', $coltopic);
                foreach ($a as $key => $value) {
                      if($value===$tid){
                        echo '1';
                        break;
                      }
                }
          break; 

          case 'commentpride':
                $tcid=$_POST['tcid'];
                $towho=$_POST['towho'];
                $bywho=$_POST['bywho'];
                $time=time();
                //更新话题讨论点赞数
                $sql0="update topiccomment set pridenum=pridenum+1 where tcid='{$tcid}'";
                mysqli_query($link,$sql0);
                //点赞人减享豆，并计入享豆纪录
                $sql1="update  user set rewardPoints=rewardPoints-3 where email='{$bywho}'";
                mysqli_query($link,$sql1);
                 $sql5="select * from user where email='{$bywho}' ";
                    $res=mysqli_query($link,$sql5);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
                $sql2="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$bywho','$time','2','3','评论点赞支出','$account')";
                mysqli_query($link,$sql2);
                

                //被点赞人加享豆，并计入享豆纪录
                $sql3="update  user set rewardPoints=rewardPoints+2 where email='{$towho}'";
                mysqli_query($link,$sql3);
                 $sql6="select * from user where email='{$towho}' ";
                    $res=mysqli_query($link,$sql6);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
                $sql4="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$towho','$time','1','2','评论点赞奖励','$account')";
                mysqli_query($link,$sql4);
                //话题发起人加一个享豆
                // 根据tcid找到话题发起人
                 $sql10="SELECT * FROM topiclist where tid=(select topicid from topiccomment where tcid='{$tcid}')";
                 // echo $sql10;
                 $res10=mysqli_query($link,$sql10);
                 while($rows=mysqli_fetch_array($res10)){
                     $publisher=$rows['publisher'];
                 }
                 $sql11="update user set rewardPoints=rewardPoints+1 where email='{$publisher}'";
                mysqli_query($link,$sql11);
                 $sql12="select * from user where email='{$publisher}' ";
                    $res=mysqli_query($link,$sql12);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
                $sql13="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$publisher','$time','1','1','评论点赞奖励','$account')";
                mysqli_query($link,$sql13);
                
                 if(mysqli_affected_rows($link)){
                    echo '1';
                  }else{
                    echo '0';
                  }
          break;  


          case 'passtopic':
                  $tid=$_POST['tid'];
                  $username=$_POST['username'];
                  $sql="update topiclist set status='2' where tid='{$tid}'";
                  $time=time();
                mysqli_query($link,$sql);
                if(mysqli_affected_rows($link)){
                  echo '1';
                  $sql0="update user set rewardPoints=rewardPoints+50 where email='{$username}'";
                  mysqli_query($link,$sql0);
                   $sql="select * from user where email='{$username}' ";
                    $res=mysqli_query($link,$sql);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
                  $sql1="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$username','$time','1','50','话题发起奖励','$account')";
                  $sql2="select * from user where email='{$username}'";
                  
                  mysqli_query($link,$sql1);
                  $res=mysqli_query($link,$sql2);
                  while($row=mysqli_fetch_array($res)){
                       $telphone=$row['telphone'];
                       $clientid=$row['clientid'];
                        $token=$row['token'];
                  }
                   $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                   $text="【WeShare乐分享】您发起的话题已通过审核,可以正常讨论啦!50享豆的奖励已充入您的账户.祝您生活愉快";
                   $sms=send_sms($apikey,$text,$telphone);
                   //消息推送
                   $content='【WeShare乐分享】您发起的话题已通过审核,可以正常讨论啦!50享豆的奖励已充入您的账户.祝您生活愉快"';
                  $payload="{'title':'您有一条通知信息','content':'【WeShare乐分享】您发起的话题已通过审核,可以正常讨论啦!50享豆的奖励已充入您的账户.祝您生活愉快','payload':'message'}";
                     if($clientid!==''){
                          if($clientid===$token){
                           pushMessageToSingle(createTranMessage($payload,$content), $clientid);
                         }else{
                            apnMessageToSingle($token, $content, $payload);
                         }
                     }
                   //判断是否已经收藏
                    $sql0="select * from user where email='{$username}'";
                      $res1=mysqli_query($link,$sql0);
                      while($r1=mysqli_fetch_array($res1)){
                            $coltopic=$r1['coltopic'];  
                      }
                      $a=explode('|', $coltopic);
                      foreach ($a as $key => $value) {
                            if($value===$tid){
                              $iscoltopic=1;
                              break;
                            }
                      }
                    if(!isset($iscoltopic)){
                       $sql4="select coltopic from user where email='{$username}'";
                       $result=mysqli_query($link,$sql4);
                        while($r=mysqli_fetch_array($result)){
                            $coltopic=$r['coltopic'];
                        }
                        //2.将收藏列表转为数组，并将新收藏的tid存入
                        $a=explode('|', $coltopic);
                        array_push($a, $tid);
                        //3.将新的数组转为字符串，存入数据库
                        $b=implode('|', $a);
                        $sql3="update user set coltopic='{$b}' where email='{$username}'";
                        mysqli_query($link,$sql3);
                    }  

                }else{
                  echo '0';
                }
          break; 

          case 'refusetopic':
                $tid=$_POST['tid'];
                $sql0="select * from topiclist where tid='{$tid}'";

                $res=mysqli_query($link,$sql0);
                while($rows=mysqli_fetch_array($res)){
                   $publisher=$rows['publisher'];
                }
                
                $sql1="select * from user where email='{$publisher}'";
                 
                $res1=mysqli_query($link,$sql1);
                while ($row2=mysqli_fetch_array($res1)) {
                    $telphone=$row2['telphone'];
                    $clientid=$row2['clientid'];
                    $token=$row2['token'];
                }

                   $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                   $text="【WeShare乐分享】您发起的话题不符合要求,已被驳回!详情请联系管理员小乐.祝您生活愉快";
                   $sms=send_sms($apikey,$text,$telphone);
                   //消息推送
                   $content='【WeShare乐分享】您发起的话题不符合要求,已被驳回!详情请联系管理员小乐.祝您生活愉快"';
                   $payload="{'title':'您有一条通知信息','content':'【WeShare乐分享】您发起的话题不符合要求,已被驳回!详情请联系管理员小乐.祝您生活愉快','payload':'message'}";
                     if($clientid!==''){
                          if($clientid===$token){
                           pushMessageToSingle(createTranMessage($payload,$content), $clientid);
                         }else{
                            apnMessageToSingle($token, $content, $payload);
                         }
                     }
                
                $sql="update topiclist set status='0' where tid='{$tid}'";
                mysqli_query($link,$sql);
                if(mysqli_affected_rows($link)){
                  echo '1';
                }else{
                  echo '0';
                }
          break;      

      }
                         
      

      ?>