<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 
     // error_reporting(0);
      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
          $pageSize=15;
          $maxPages=0;
          $maxRows=0;
          $username=$_POST['username'];
          $page=$_POST['page'];
          
          $sql0="select * from thankorder where towho='{$username}'";

                $res= mysqli_query($link,$sql0);
                $maxRows=mysqli_num_rows($res); 
                mysqli_free_result($res);
                //计算最大页数
                $maxPages = ceil($maxRows/$pageSize);

                //校验当前页数
                  if ($page>$maxPages){
                    $page= $maxPages;
                  }if( $page<1){
                    $page=1;
                  }
                //拼装分业sql语句
                $limit = "limit ".(($page-1)*$pageSize).",{$pageSize}";
                //执行查询语句
                $sql1="select * from thankorder where towho='{$username}' order by sendtime desc {$limit}";
                // echo $sql1;
                $result = mysqli_query($link,$sql1);
          
          $data=array();
          while($rows=mysqli_fetch_array($result)){
              $tid=$rows['tid'];
              $judge=$rows['judge'];
              $needpay=$rows['needpay'];
              $bywho=$rows['bywho'];
              $needid=$rows['needid'];
              $sendtime=$rows['sendtime'];
              //获取评价人的资料
              $sql="select * from user where email='{$bywho}'";
              $a=mysqli_query($link,$sql);
              while($rows=mysqli_fetch_array($a)){
                $nickname=$rows['nickname'];
                $head=$rows['head'];
                $sex=$rows['sex'];
              }
              mysqli_free_result($a);
            
              $arr=array('tid'=>$tid,'judge'=>$judge,'needpay'=>$needpay,'bywho'=>$bywho,'sex'=>$sex,'needid'=>$needid,'sendtime'=>$sendtime,'bywhohead'=>$head,'maxPages'=>$maxPages);
              array_push($data,$arr);
          }
        
           echo  json_encode($data);
           mysqli_free_result($result);
           mysqli_close($link);  

      ?>