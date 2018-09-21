<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 
     // error_reporting(0);
      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
        $pageSize=10;
        $maxPages=0;
        $maxRows=0;
             
        
    
        switch ($_POST['action']) {

            case 'allneed':
                $page=$_POST['page'];
                $school=$_POST['school'];  
                $sql0="select * from needlist where needlocation='{$school}' and status<>'2' ";
                $res= mysqli_query($link,$sql0);
                $maxRows=mysqli_num_rows($res); 
                mysqli_free_result($res);
                //计算最大页数
                $maxPages = ceil($maxRows/$pageSize);

                //校验当前页数
                  if ($page>$maxPages) {
                    $page= $maxPages;
                  }if( $page<1){
                    $page=1;
                  }
                //拼装分业sql语句
                $limit = " limit  ".(($page-1)*$pageSize).",{$pageSize}";
                //执行查询语句
                $sql1="select * from needlist where  needlocation='{$school}' and status<>'2' order by id DESC {$limit}";
                $result = mysqli_query($link,$sql1);
            break;

            

             case 'needing':
                $page=$_POST['page'];
                $school=$_POST['school'];  
                $sql0="select * from needlist where needlocation='{$school}' and status='0'";
                $res=mysqli_query($link,$sql0);
               
                $maxRows=mysqli_num_rows($res); 
                mysqli_free_result($res);
                //计算最大页数
                $maxPages = ceil($maxRows/$pageSize);

                //校验当前页数
                  if ($page>$maxPages) {
                    $page= $maxPages;
                  }if( $page<1){
                    $page=1;
                  }
                //拼装分业sql语句
                $limit = " limit  ".(($page-1)*$pageSize).",{$pageSize}";
                //执行查询语句
                $sql1="select * from needlist where  needlocation='{$school}' and status='0' order by id DESC {$limit}";
                $result = mysqli_query($link,$sql1);
            break;

             case 'helping':
                $page=$_POST['page'];
                $school=$_POST['school'];  
                $sql0="select * from needlist where needlocation='{$school}' and status='1' ";
                $res= mysqli_query($link,$sql0);
                $maxRows=mysqli_num_rows($res); 
                mysqli_free_result($res);
                //计算最大页数
                $maxPages = ceil($maxRows/$pageSize);

                //校验当前页数
                  if ($page>$maxPages) {
                    $page= $maxPages;
                  }if( $page<1){
                    $page=1;
                  }
                //拼装分业sql语句
                $limit = " limit  ".(($page-1)*$pageSize).",{$pageSize}";
                //执行查询语句
                $sql1="select * from needlist where  needlocation='{$school}' and status='1' order by id DESC {$limit}";
                $result = mysqli_query($link,$sql1);
            break;

             case 'finished':
                $page=$_POST['page'];
                $school=$_POST['school'];  
                $sql0="select * from needlist where needlocation='{$school}' and status='2'";
                $res= mysqli_query($link,$sql0);
                $maxRows=mysqli_num_rows($res); 
                mysqli_free_result($res);
                //计算最大页数
                $maxPages = ceil($maxRows/$pageSize);

                //校验当前页数
                  if ($page>$maxPages) {
                    $page= $maxPages;
                  }if( $page<1){
                    $page=1;
                  }
                //拼装分业sql语句
                $limit = " limit  ".(($page-1)*$pageSize).",{$pageSize}";
                //执行查询语句
                $sql1="select * from needlist where  needlocation='{$school}' and status='2' order by id DESC {$limit}";
                $result = mysqli_query($link,$sql1);
            break;

            case 'singleneed':
                  $needid=$_POST['needid'];
                  $sql="select * from needlist where id='{$needid}'";
                  $result=mysqli_query($link,$sql);
            break;
            
            case 'somebodyneed':
                    $user=$_POST['username'];
                    $page=$_POST['page'];
                    $sql2="select * from needlist where user='{$user}'";
                    $res= mysqli_query($link,$sql2);
                    $maxRows=mysqli_num_rows($res);
                     
                  //计算最大页数
                    $maxPages = ceil($maxRows/$pageSize);
                    //校验当前页数
                      if ($page>$maxPages) {
                        $page=$maxPages;
                      }if( $page<1){
                        $page=1;
                      }

                    //拼装分业sql语句
                    $limit = " limit  ".(($page-1)*$pageSize).",{$pageSize}";

                    $sql3="select * from needlist where user='{$user}' order by id DESC {$limit} ";
                    $result = mysqli_query($link,$sql3); 
              break;


              case 'myhelpedneed':
                   $username=$_POST['username'];
                   $page=$_POST['page'];
                   $sql2="select * from needlist where finishbywho='{$username}'";
                    $res= mysqli_query($link,$sql2);
                    $maxRows=mysqli_num_rows($res);
                     
                  //计算最大页数
                    $maxPages = ceil($maxRows/$pageSize);
                    //校验当前页数
                      if ($page>$maxPages) {
                        $page=$maxPages;
                      }if( $page<1){
                        $page=1;
                      }

                    //拼装分业sql语句
                    $limit = " limit  ".(($page-1)*$pageSize).",{$pageSize}";

                    $sql3="select * from needlist where finishbywho='{$username}' order by id DESC {$limit} ";
                    $result = mysqli_query($link,$sql3); 
              break;



              case 'needadmin':
                    $sql4="select * from needlist order by id DESC";
                    $result=mysqli_query($link,$sql4);
              break;


              case 'helper':
                
                    $needid=$_GET['needid'];
                    $sql5="select * from needlist where id='{$needid}'";
                    $result=mysqli_query($link,$sql5);
              break;

              case "somebodyelse":
                      $nickname=$_GET['nickname'];


                      $sql="select * from user where nickname='{$nickname}'";

                       $c=mysqli_query($link,$sql);
                         while($r=mysqli_fetch_array($c)){
                             $email=$r['email'];
                         }
                       mysqli_free_result($c);

                      $sql7="select * from needlist where user='{$email}'";
                      $res=mysqli_query($link,$sql7);
                      $maxRows=mysqli_num_rows($res);
                      mysqli_free_result($res);

                  //计算最大页数
                     $maxPages = ceil($maxRows/$pageSize);

                    //校验当前页数
                      if ($page>$maxPages) {
                        $page= $maxPages;
                      }if( $page<1){
                        $page=1;
                      }

                    //拼装分业sql语句
                    $limit = " limit  ".(($page-1)*$pageSize).",{$pageSize}";

                    $sql8="select * from needlist where user='{$email}' order by id DESC {$limit} ";
                     echo $sql3;
                    $result = mysqli_query($link,$sql8);  
              break;
          }
                         
        

       $data= array();
      while ($row=mysqli_fetch_array($result)) {
           $id =$row['id'];
           $label=$row['label'];
           $usertel=$row['usertel'];
           $publishtime=$row['publishtime'];
           $remark =$row['remark'];
           $needtime =$row['needtime'];
           $needlocation=$row['needlocation'];
           $email= $row['user'];
           $needpay= $row['needpay'];
           $needpic=$row['needpic'];
           $sql="select * from user where email='{$email}'";
           $c=mysqli_query($link,$sql);
           while($r=mysqli_fetch_array($c)){
               $user=$r['nickname'];
               $head=$r['head'];
               $sex=$r['sex'];
           }
              
           mysqli_free_result($c);

           $sql="select distinct bywho from helpermsg where needid='{$id}'";
           $a=mysqli_query($link,$sql);
           $msgNum=mysqli_num_rows($a);
          
           mysqli_free_result($a);

           $sql="select * from comment where needid='{$id}'";
           $b=mysqli_query($link,$sql);
           $cmtNum=mysqli_num_rows($b);
          
           mysqli_free_result($b);
           $priNum=10; 
           $sta = array( "0" => "求助中", "1" =>"帮忙中","2"=>"已完成");

           $status=$sta[$row['status']];
            if($status==='已完成'){
            $actiontext='已完成';
           
           }
           else{
            $actiontext='需求操作';
           }
         
           $arr=array('id'=>$id,'label'=>$label,'usertel'=>$usertel,'publishtime'=>$publishtime,'remark'=>$remark,'needtime'=>$needtime,
            'needlocation'=>$needlocation,'user'=>$user,'useremail'=>$email,'head'=>$head,'sex'=>$sex,'status'=>$status,'maxPages'=>$maxPages,
            'maxRows'=>$maxRows,'pageSize'=>$pageSize,'actiontext'=>$actiontext,'msgNum'=>$msgNum,'cmtNum'=>$cmtNum,'needpay'=>$needpay,'priNum'=>$priNum,'needpic'=>$needpic);
          
           array_push($data,$arr);   
      } 
           
           echo  json_encode($data);
           mysqli_free_result($result);
           mysqli_close($link);  

      ?>