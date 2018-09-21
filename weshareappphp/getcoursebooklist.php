<?php
      date_default_timezone_set("Asia/Shanghai");
      header("Content-type: text/html; charset=utf-8"); 

      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
      $pageSize=10;
      switch ($_POST['action']) {
      	case 'allbook':
      		$type=$_POST['department'];
          $page=$_POST['page'];
          $school=$_POST['school'];
		      if($type=='all'){
		      	$sql="select * from coursebook where  school='{$school}'";
                              $res=mysqli_query($link,$sql);
                              $maxrows=mysqli_num_rows($res);
                              $maxpages=ceil($maxrows/$pageSize);
                              if ($page>$maxpages) {
                                $page= $maxpages;
                              }if( $page<1){
                                $page=1;
                              }

                              $limit=" limit ".(($page-1)*$pageSize).",{$pageSize}";
                              $sql0="select * from coursebook where  school='{$school}' order by bookprice {$limit} ";
                              
		      }else{
		      	 $sql="select * from coursebook where departmentName='{$type}' and  school='{$school}'";
                              $res=mysqli_query($link,$sql);
                               $maxrows=mysqli_num_rows($res);
                              $maxpages=ceil($maxrows/$pageSize);
                              if ($page>$maxpages) { 
                                $page= $maxpages;
                              }if( $page<1){
                                $page=1;
                              }

                              $limit=" limit ".(($page-1)*$pageSize).",{$pageSize}";
                              $sql0="select * from coursebook where departmentName='{$type}'  and school='{$school}' order by bookprice {$limit} ";
		      }
		       

                    
		      $result=mysqli_query($link,$sql0);
      		break; 

          case 'singlebook':
           $bid=$_POST['bid'];
                   $maxrows=1;
                  $maxpages=1;
           $sql="select * from coursebook where bid='{$bid}'";
           $result=mysqli_query($link,$sql);
           break; 

         case 'bookadmin':
        $school=$_POST['school'];
        $type=$_POST['type'];
       
        if($type=='all'){
          $sql="select * from coursebook where school='{$school}'  ";
        }
        else if($type==0){
          $sql="select * from coursebook where store='0' and school='{$school}'";
        }
        else{
          $sql="select * from coursebook where store>'0' and school='{$school}' ";
        }
        $maxpages=10;
        $maxrows=10;

        $result=mysqli_query($link,$sql);
        break;
           
      }
          
      $data=array();
      while ($row=mysqli_fetch_array($result)){
      	 $bid=$row['bid'];
         $school=$row['school'];
         $department=$row['departmentName'];
         $coursename=$row['coursename'];
         $coursebook=$row['coursebook'];
         $pic=$row['bookpic'];
         $courseteacher=$row['courseteacher'];
         $bookprice=$row['bookprice'];
         $exprice=$row['exchangeprice'];
         $reprice=$row['recoverprice'];
         $store=$row['store'];
      	 $description=$row['description'];
      	 $arr=array('bid'=>$bid,'coursename'=>$coursename,'coursebook'=>$coursebook,'pic'=>$pic,'courseteacher'=>$courseteacher,
          'bookprice'=>$bookprice,'exprice'=>$exprice,'reprice'=>$reprice,'store'=>$store,'description'=>$description,'maxrows'=>$maxrows,'maxpages'=>$maxpages,'pageSize'=>$pageSize);
      	 array_push($data, $arr);
      }

       echo json_encode($data);
       mysqli_free_result($result);


?>