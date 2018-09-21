<?php
      date_default_timezone_set("Asia/Shanghai");
      header("Content-type: text/html; charset=utf-8"); 
        // error_reporting(0);
      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
               $pageSize=10;

             

      switch ($_POST['action']) {
      	case 'allpro':
      		        $type=$_POST['type'];
                  $page=$_POST['page'];
                  $school=$_POST['school'];
                  if(isset($_POST['subtype'])){
                    $subtype=$_POST['subtype'];
                  }else{
                    $subtype='';
                  }
                  
		      if($type==='所有宝贝'){
		      	  $sql="select * from exchangePro where store>'0' and school='{$school}'";
                              $res=mysqli_query($link,$sql);
                              $maxrows=mysqli_num_rows($res);
                              $maxpages=ceil($maxrows/$pageSize);
                              if ($page>$maxpages) {
                                $page= $maxpages;
                              }if( $page<1){
                                $page=1;
                              }

                              $limit=" limit ".(($page-1)*$pageSize).",{$pageSize}";
                              $sql0="select * from exchangePro where store>'0' and school='{$school}'  order by addtime desc {$limit} ";
                              
		      }else if($type==='search'){
                 $keywords=$subtype;
                 $keywordsLen=mb_strlen($keywords,'utf-8');
                 if($keywordsLen==1){
                    $sql="select * from exchangePro   where store>'0' and name like '%$keywords%' and school='{$school}'  order by addtime desc";
                        $res=mysqli_query($link,$sql);
                     $maxrows=mysqli_num_rows($res);
                     $maxpages=ceil($maxrows/$pageSize);

                     if($page>$maxpages){
                      $page=$maxpages;
                     }if($page<1){
                      $page=1;
                     }
                     //拼装分页sql
                     $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                     $sql0="select * from exchangePro  where store>'0' and name like '%$keywords%' and school='{$school}'  order by addtime desc {$limit}";
                }else if($keywordsLen==2){
                     $keywords0=mb_substr($keywords,0,1,'utf-8');
                     $keywords1=mb_substr($keywords,1,1,'utf-8');
                     $sql="select * from exchangePro   where store>'0' and  name like '%$keywords0%' or name like '%$keywords1%' and school='{$school}'  order by addtime desc";
                     $res=mysqli_query($link,$sql);
                         $maxrows=mysqli_num_rows($res);
                         $maxpages=ceil($maxrows/$pageSize);

                         if($page>$maxpages){
                          $page=$maxpages;
                         }if($page<1){
                          $page=1;
                         }
                         //拼装分页sql
                         $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
        $sql0="select * from exchangePro   where store>'0' and  name like '%$keywords0%' or name like '%$keywords1%' and school='{$school}'  order by addtime desc {$limit}";
                        
                       
                }else if($keywordsLen==3){
                    $keywords0=mb_substr($keywords,0,1,'utf-8');
                     $keywords1=mb_substr($keywords,1,1,'utf-8');
                     $keywords2=mb_substr($keywords,2,1,'utf-8');
                     $sql="select * from exchangePro   where store>'0' and  name like '%$keywords0%' or name like '%$keywords1%' or name like '%$keywords2%' and school='{$school}'  order by addtime desc";
                     $res=mysqli_query($link,$sql);
                 $maxrows=mysqli_num_rows($res);
                 $maxpages=ceil($maxrows/$pageSize);

                 if($page>$maxpages){
                  $page=$maxpages;
                 }if($page<1){
                  $page=1;
                 }
                 //拼装分页sql
                 $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                 $sql0="select * from exchangePro   where store>'0' and  name like '%$keywords0%' or name like '%$keywords1%' or name like '%$keywords2%' and school='{$school}'  order by addtime desc {$limit}";
                 // echo $sql0;
                }else if($keywordsLen==4){
                    $keywords0=mb_substr($keywords,0,1,'utf-8');
                     $keywords1=mb_substr($keywords,1,1,'utf-8');
                     $keywords2=mb_substr($keywords,2,1,'utf-8');
                     $keywords3=mb_substr($keywords,3,1,'utf-8');
                     $sql="select * from exchangePro   where store>'0' and  name like '%$keywords0%' or name like '%$keywords1%' or name like '%$keywords2%' or name like '%$keywords3%' and  school='{$school}'  order by addtime desc";
                     $res=mysqli_query($link,$sql);
                 $maxrows=mysqli_num_rows($res);
                 $maxpages=ceil($maxrows/$pageSize);

                 if($page>$maxpages){
                  $page=$maxpages;
                 }if($page<1){
                  $page=1;
                 }
                 //拼装分页sql
                 $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                 $sql0="select * from exchangePro   where store>'0' and  name like '%$keywords0%' or name like '%$keywords1%' or name like '%$keywords2%' or name like '%$keywords3%' and  school='{$school}'  order by addtime desc {$limit}";
                 // echo $sql0;
                }else if($keywordsLen>=5) {
                     $keywords0=mb_substr($keywords,0,1,'utf-8');
                     $keywords1=mb_substr($keywords,1,1,'utf-8');
                     $keywords2=mb_substr($keywords,2,1,'utf-8');
                     $keywords3=mb_substr($keywords,3,1,'utf-8');
                     $keywords4=mb_substr($keywords,4,1,'utf-8');
                     $sql="select * from exchangePro   where store>'0' and  name like '%$keywords0%' or name like '%$keywords1%' or name like '%$keywords2%' or name like '%$keywords3%' and name like '%$keywords4%' and school='{$school}'  order by addtime desc";
                     $res=mysqli_query($link,$sql);
                 $maxrows=mysqli_num_rows($res);
                 $maxpages=ceil($maxrows/$pageSize);

                 if($page>$maxpages){
                  $page=$maxpages;
                 }if($page<1){
                  $page=1;
                 }
                 //拼装分页sql
                 $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                 $sql0="select * from exchangePro   where store>'0' and  name like '%$keywords0%' or name like '%$keywords1%' or name like '%$keywords2%' or name like '%$keywords3%' or name like '%$keywords4%' and school='{$school}'  order by addtime desc {$limit}";
                }else{
                    $sql="select * from exchangePro   where store>'0' and  school='{$school}'  order by addtime desc";
                        $res=mysqli_query($link,$sql);
                     $maxrows=mysqli_num_rows($res);
                     $maxpages=ceil($maxrows/$pageSize);

                     if($page>$maxpages){
                      $page=$maxpages;
                     }if($page<1){
                      $page=1;
                     }
                     //拼装分页sql
                     $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                     $sql0="select * from exchangePro  where store>'0' and  school='{$school}'  order by addtime desc {$limit}";
                }












          }else{
              if($subtype!=''){
                 // echo  $subtype;
                      $sql="select * from exchangePro where type='{$type}'  and subtypea='{$subtype}' and store>'0' and school='{$school}'";
                              $res=mysqli_query($link,$sql);
                               $maxrows=mysqli_num_rows($res);
                              $maxpages=ceil($maxrows/$pageSize);
                              if ($page>$maxpages) { 
                                $page= $maxpages;
                              }if( $page<1){
                                $page=1;
                              }

                              $limit=" limit ".(($page-1)*$pageSize).",{$pageSize}";
                              $sql0="select * from exchangePro where type='{$type}' and subtypea='{$subtype}' and store>'0' and school='{$school}'  order by addtime  desc {$limit} ";
              }else{

                $sql="select * from exchangePro where type='{$type}' and store>'0' and school='{$school}'";
                              $res=mysqli_query($link,$sql);
                               $maxrows=mysqli_num_rows($res);
                              $maxpages=ceil($maxrows/$pageSize);
                              if ($page>$maxpages) { 
                                $page= $maxpages;
                              }if( $page<1){
                                $page=1;
                              }

                              $limit=" limit ".(($page-1)*$pageSize).",{$pageSize}";
                              $sql0="select * from exchangePro where type='{$type}' and store>'0' and school='{$school}'  order by addtime  desc {$limit} ";  
              }
		      	 }          
		       // echo $sql0;
                    
		      $result=mysqli_query($link,$sql0);
      		break;

        case 'allride':
                  $page=$_POST['page'];
                  $school=$_POST['school'];
          
             $sql="select * from exchangePro where type='乐享座驾' and store>'0' and school='{$school}' or school='所有学校'";
                              $res=mysqli_query($link,$sql);
                               $maxrows=mysqli_num_rows($res);
                              $maxpages=ceil($maxrows/$pageSize);
                              if ($page>$maxpages) { 
                                $page= $maxpages;
                              }if( $page<1){
                                $page=1;
                              }

                              $limit=" limit ".(($page-1)*$pageSize).",{$pageSize}";
                              $sql0="select * from exchangePro where type='乐享座驾' and store>'0' and school='{$school}' or school='所有学校' order by price {$limit} ";
        
           
         
          $result=mysqli_query($link,$sql0);
          // echo $sql0;
          break; 
   
      	
      	case 'singlepro':
      		 $pid=$_POST['pid'];
                   $maxrows=1;
                  $maxpages=1;
      		 $sql="select * from exchangePro where pid='{$pid}'";
      		 $result=mysqli_query($link,$sql);
      	break;

        case 'adminpro':
        $school=$_POST['school'];
        $type=$_POST['type'];
        echo $type;
        if($type=='all'){
          $sql="select * from exchangePro where school='{$school}' or school='所有学校' order by price";
        }
        else if($type==0){
          $sql="select * from exchangePro where store='0' and school='{$school}' or school='所有学校' order by price ";
        }
        else{
          $sql="select * from exchangePro where store>'0' and school='{$school}' or school='所有学校'order by price ";
        }
        $maxpages=10;
        $maxrows=10;

        $result=mysqli_query($link,$sql);
        break;


        case 'someonepro':
             $user=$_POST['user'];
             $page=$_POST['page'];
               $sql="select * from exchangePro where  publisher='{$user}'";
                              $res=mysqli_query($link,$sql);
                               $maxrows=mysqli_num_rows($res);
                              $maxpages=ceil($maxrows/$pageSize);
                              if ($page>$maxpages) { 
                                $page= $maxpages;
                              }if( $page<1){
                                $page=1;
                              }

                              $limit=" limit ".(($page-1)*$pageSize).",{$pageSize}";
                              $sql0="select * from exchangePro where  publisher='{$user}' order by addtime  desc {$limit} "; 
                        $result=mysqli_query($link,$sql0);       
        break;
      }
      
      $data=array();
      while ($row=mysqli_fetch_array($result)){
      	 $pid=$row['pid'];
      	 $name=$row['name'];
      	 $price=$row['price'];
         $type=$row['type'];
         $subtypea=$row['subtypea'];
         $subtypeb=$row['subtypeb'];
      	 $description=$row['description'];
         $prolocation=$row['prolocation'];
      	 $pic=$row['pic'];
      	 $store=$row['store'];
      	 $addtime=$row['addtime'];
         $publisher=$row['publisher'];
                 $sql="select * from user where email='{$publisher}'";
                   $res=mysqli_query($link,$sql);
                   while($r=mysqli_fetch_array($res)){
                       $userhead=$r['head'];
                       $usernickname=$r['nickname'];
                       $telphone=$r['telphone'];
                      
                   }

         $arr=array('pid'=>$pid,'name'=>$name,'price'=>$price,'type'=>$type,'subtypea'=>$subtypea,'subtypeb'=>$subtypeb,'description'=>$description,'prolocation'=>$prolocation,'pic'=>$pic,'store'=>$store,'addtime'=>$addtime,'maxrows'=>$maxrows,'maxpages'=>$maxpages,'pageSize'=>$pageSize,'useremail'=>$publisher,'userhead'=>$userhead,'usernickname'=>$usernickname,'telphone'=>$telphone);
          array_push($data, $arr);            
      	 
      	 
      }

      echo json_encode($data);


?>