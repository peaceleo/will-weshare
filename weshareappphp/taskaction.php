<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 
     error_reporting(0);
      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
      require('snsfunction.php');
      require('baiduVideoto.php');
     
       
        switch ($_POST['action']) {
           case 'pubtask':
              $school=$_POST['school'];
              $type=$_POST['type'];
              $name=$_POST['name'];
              $intro=$_POST['intro'];
              $demand=$_POST['demand'];
              $tips=$_POST['tips'];
              $time=$_POST['time'];
              $location=$_POST['location'];
              $publisher=$_POST['publisher'];
              $sponser=$_POST['sponser'];
              $addtime=time();
              $pay=$_POST['pay'];
              $propic=new FileUpload;
              $propic -> set("path", "./uploads/");
              $propic -> set("maxsize", 10000000);
                $propic -> set("allowtype", array("gif", "png", "jpg","jpeg"));
              if($propic ->upload('propic')){
                $pic=$propic ->getFileName();
                $picurl="./uploads/".$pic;
              }else{
                var_dump($propic ->getErrorMsg());
              }
              $addtime=time();
              $image= new image($picurl,1,"500","500",$picurl);
                $image ->outimage();
                
              $sql="insert into tasklist(school,tid,type,title,taskintro,taskdemond,tasktips,tasktime,tasklocation,publishtime,publisher,sponsor,status,taskpayper,taskpic) values
              ('$school',null,'$type','$name','$intro','$demand','$tips','$time','$location','$addtime','$publisher','$sponser','0','$pay','$pic')";
              mysqli_query($link,$sql);
              $res=mysqli_affected_rows($link);
              if($res>0){
                echo '1';
                 $contentb='【'.$name.'】'.$intro;
                
                 $contentc=mb_substr($contentb,0,50,'utf-8').'...';
                 $payload="{'title':'来做任务啦','content':'{$contentc}.'分享就是最好的拥有','payload':'message'}";
                 $content="同学来做任务啦!".$contentc.'分享就是最好的拥有';
                 pushMessageToapp(createTranMessage($payload,$content));
                
              }else{
                echo '0';
              }
             break;
           case 'taskcomment':
		           $comment=$_POST['taskcomment'];
		           $bywho=$_POST['bywho'];
		           $tid=$_POST['tid'];
		           $sendtime=time();

		           $sql="insert into taskcomment(tcid,comment,bywho,towho,taskid,sendtime)
		           values(null,'$comment','$bywho',null,'$tid','$sendtime')";
		           $result=mysqli_query($link,$sql);
		           $r=mysqli_affected_rows($link);
		           if($r>0){
		           	echo '1';
                  $sql3="update user set rewardPoints=rewardPoints+2 where email='{$bywho}'";
                  mysqli_query($link,$sql3);
                  $sql="select * from user where email='{$bywho}' ";
                    $res=mysqli_query($link,$sql);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
                  $sql4="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$bywho','$sendtime','1','2','任务评论奖励','$account')";
            mysqli_query($link,$sql4);

		           }else{
		           	echo '0';
		           }

           break;


           case 'tasksurport':
           			$surport=$_POST['tasksurport'];
           			$bywho=$_POST['bywho'];
           			$tid=$_POST['tid'];
           			$sendtime=time();

           			$sql="insert into tasksurport(tsid,surport,bywho,towho,taskid,sendtime)
           			values(null,'$surport','$bywho',null,'$tid','$sendtime')";
           			mysqli_query($link,$sql);
           			$r=mysqli_affected_rows($link);
           			if($r>0){
           				echo '1';
                  $sql0="update user set rewardPoints=rewardPoints-{$surport} where email='{$bywho}'";
                  mysqli_query($link,$sql0);
                  $sql="select * from user where email='{$bywho}' ";
                    $res=mysqli_query($link,$sql);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
                   $sql5="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$bywho','$sendtime','2','$surport','任务爱心支持','$account'";
               mysqli_query($link,$sql5);
           			}else{
           				echo '0';
           			}

           break;
          
           case 'getresult':
           		$tid=$_POST['tid'];
           		$sql="select * from taskresult where taskid='{$tid}'";
           		$result=mysqli_query($link,$sql);
           		$data=array();
           		while($rows=mysqli_fetch_array($result)){
           			$aid=$rows['aid'];
           			
           			$resultintro=$rows['resultintro'];
                $resultType=$rows['type'];
                if($resultType=='img'){
                  $taskresult=$rows['taskresult'];
                }else{
                  $taskresult='default_img.jpg';
                }
           			$bywho=$rows['bywho'];
           			 	$sql0="select * from user where email='{$bywho}'";
           			 	$res=mysqli_query($link,$sql0);
           			 	while($r=mysqli_fetch_array($res)){
           			 		$bywhonickname=$r['nickname'];
           			 		$bywhohead=$r['head'];
                    $bywhosex=$r['sex'];
           			  	}			
           			$sendtime=$rows['sendtime'];
                $status=$rows['status'];
                if($status==0){
                  $statustext='未通过';
                  $statusactiontext='通过';
                }else if($status==1){
                  $statustext='已通过';
                  $statusactiontext='已通过';
                }
                $taskpay=$rows['taskpay'];
           		$arr=array('aid'=>$aid,'result'=>$taskresult,'resultintro'=>$resultintro,'bywho'=>$bywho,'bywhonickname'=>$bywhonickname,'bywhosex'=>$bywhosex,'bywhohead'=>$bywhohead,
                'sendtime'=>$sendtime,'status'=>$status,'statustext'=>$statustext,'statusactiontext'=>$statusactiontext,'taskpay'=>$taskpay);
           		array_push($data, $arr);	
           		}
           		echo json_encode($data);
           		mysqli_free_result($result);
           break;
           
           case 'getcomment':
              $tid=$_POST['tid'];
              $sql="select * from taskcomment where taskid='{$tid}'";
              $result=mysqli_query($link,$sql);
              $data=array();
              while($rows=mysqli_fetch_array($result)){
                $tcid=$rows['tcid'];
                $comment=$rows['comment'];
                $bywho=$rows['bywho'];
                  $sql0="select * from user where email='{$bywho}'";
                  $res=mysqli_query($link,$sql0);
                  while($r=mysqli_fetch_array($res)){
                    $bywhonickname=$r['nickname'];
                    $bywhohead=$r['head'];
                    $bywhosex=$r['sex'];
                  }     
                $sendtime=$rows['sendtime'];
              $arr=array('tcid'=>$tcid,'bywho'=>$bywho,'comment'=>$comment,'bywhonickname'=>$bywhonickname,'bywhosex'=>$bywhosex,'bywhohead'=>$bywhohead,'sendtime'=>$sendtime);
              array_push($data, $arr);  
              }
              echo json_encode($data);
              mysqli_free_result($result);
           break;

             case 'getsurport':
              $tid=$_POST['tid'];
              $sql="select * from tasksurport where taskid='{$tid}'";
              $result=mysqli_query($link,$sql);
              $data=array();
              while($rows=mysqli_fetch_array($result)){
                $tsid=$rows['tsid'];
                $surport=$rows['surport'];
                $bywho=$rows['bywho'];
                  $sql0="select * from user where email='{$bywho}'";
                  $res=mysqli_query($link,$sql0);
                  while($r=mysqli_fetch_array($res)){
                    $bywhonickname=$r['nickname'];
                    $bywhohead=$r['head'];
                    $bywhotelphone=$r['telphone'];
                    $bywhosex=$r['sex'];
                  }     
                $sendtime=$rows['sendtime'];
              $arr=array('tsid'=>$tsid,'surport'=>$surport,'bywho'=>$bywho,'bywhosex'=>$bywhosex,'bywhonickname'=>$bywhonickname,'bywhohead'=>$bywhohead,'bywhotelphone'=>$bywhotelphone,'sendtime'=>$sendtime);
              array_push($data, $arr);  
              }
              echo json_encode($data);
              mysqli_free_result($result);
           break;

           case 'viewnum':
            $tid=$_POST['tid'];
            $sql="update tasklist set viewnum=viewnum+1 where tid='{$tid}'";
            mysqli_query($link,$sql);
           break;


           case 'getvideoresult':
              $tid=$_POST['tid'];
              $sql="select * from taskresult where taskid='{$tid}'";

              $result=mysqli_query($link,$sql);
              $data=array();
              while($rows=mysqli_fetch_array($result)){
                $aid=$rows['aid'];
                $taskresult=$rows['taskresult'];
                $taskresultType=$rows['type'];
                if($taskresultType=='video'){
                    $videoResult=getMediaPlay($taskresult);
                    $videoUrl=$videoResult['result']['file'];
                    $videoPic=$videoResult['result']['cover'];
                }else{
                    $videoUrl='';
                    $videoPic='';
                }
                
                // if($videoPic==''){
                //   $videoPic="http://localhost/weshare1.0.8/uploads/20160107214020_101.png";
                // }
                $resultintro=$rows['resultintro'];
                $bywho=$rows['bywho'];
                  $sql0="select * from user where email='{$bywho}'";
                  $res=mysqli_query($link,$sql0);
                  while($r=mysqli_fetch_array($res)){
                    $bywhonickname=$r['nickname'];
                    $bywhohead=$r['head'];
                    $bywhosex=$r['sex'];
                  }     
                $sendtime=$rows['sendtime'];
                $status=$rows['status'];
                if($status==0){
                  $statustext='未通过';
                  $statusactiontext='通过';
                }else if($status==1){
                  $statustext='已通过';
                  $statusactiontext='已通过';
                }
                $taskpay=$rows['taskpay'];
                $pridenum=$rows['pridenum'];
              $arr=array('aid'=>$aid,'result'=>$taskresult,'resultintro'=>$resultintro,'bywho'=>$bywho,'bywhonickname'=>$bywhonickname,'bywhosex'=>$bywhosex,'bywhohead'=>$bywhohead,
                'sendtime'=>$sendtime,'status'=>$status,'statustext'=>$statustext,'statusactiontext'=>$statusactiontext,'taskpay'=>$taskpay,'type'=>$taskresultType,'videoPic'=>$videoPic,'videoUrl'=>$videoUrl,'pridenum'=>$pridenum);
              array_push($data, $arr);  
              }
              echo json_encode($data);
              mysqli_free_result($result);

           break;
           case 'resultpride':
                $aid=$_POST['aid'];
                $towho=$_POST['towho'];
                $bywho=$_POST['bywho'];
                $time=time();
                //更新话题讨论点赞数
                $sql0="update taskresult set pridenum=pridenum+1 where aid='{$aid}'";
                mysqli_query($link,$sql0);
                //点赞人减享豆，并计入享豆纪录
                $sql1="update  user set rewardPoints=rewardPoints-2 where email='{$bywho}'";
                mysqli_query($link,$sql1);
                 $sql5="select * from user where email='{$bywho}' ";
                    $res=mysqli_query($link,$sql5);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
                $sql2="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$bywho','$time','2','2','任务点赞支出','$account')";
                mysqli_query($link,$sql2);
                

                //被点赞人加享豆，并计入享豆纪录
                $sql3="update  user set rewardPoints=rewardPoints+2 where email='{$towho}'";
                mysqli_query($link,$sql3);
                 $sql6="select * from user where email='{$towho}' ";
                    $res=mysqli_query($link,$sql6);
                    while($r=mysqli_fetch_array($res)){
                      $account=$r['rewardPoints'];
                    }
                $sql4="INSERT INTO rewardrecord(rid,user,sendtime,type,price,detail,account) VALUES(null,'$towho','$time','1','2','任务点赞奖励','$account')";
                mysqli_query($link,$sql4);
                
                 if(mysqli_affected_rows($link)){
                    echo '1';
                  }else{
                    echo '0';
                  }
          break;  

          }
                         
      

      ?>