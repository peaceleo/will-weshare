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
             
                
                
    
        switch ($_POST['action']) {

            case 'newest':
                 $page=$_POST['page'];
                 $school=$_POST['school'];
                 $sql0="select * from topiclist  where school='{$school}' and status!='0' order by publishtime desc";
                 $res=mysqli_query($link,$sql0);
                 $maxRows=mysqli_num_rows($res);
                 $maxPages=ceil($maxRows/$pageSize);

                 if($page>$maxPages){
                  $page=$maxPages;
                 }if($page<1){
                  $page=1;
                 }
                 //拼装分页sql
                 $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                
                 $sql1="select * from topiclist where school='{$school}' and status!='0' order by publishtime desc {$limit}";
                 $result=mysqli_query($link,$sql1);
            break;


            case 'hottest':
                 $page=$_POST['page'];
                 $school=$_POST['school'];
                 $sql0="select * from topiclist  where school='{$school}' and status!='0' order by commentnum desc";
                 $res=mysqli_query($link,$sql0);
                 $maxRows=mysqli_num_rows($res);
                 $maxPages=ceil($maxRows/$pageSize);

                 if($page>$maxPages){
                  $page=$maxPages;
                 }if($page<1){
                  $page=1;
                 }
                 //拼装分页sql
                 $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                 $sql1="select * from topiclist where school='{$school}' and status!='0' order by commentnum desc {$limit}";
                 $result=mysqli_query($link,$sql1);
            break;
            case 'lesson':
                 $page=$_POST['page'];
                 $school=$_POST['school'];
                 $sql0="select * from topiclist  where topictype='学习' and school='{$school}' and status!='0' order by commentnum desc";
                 $res=mysqli_query($link,$sql0);
                 $maxRows=mysqli_num_rows($res);
                 $maxPages=ceil($maxRows/$pageSize);

                 if($page>$maxPages){
                  $page=$maxPages;
                 }if($page<1){
                  $page=1;
                 }
                 //拼装分页sql
                 $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                 $sql1="select * from topiclist where topictype='学习' and school='{$school}' and status!='0' order by commentnum desc {$limit}";
                 $result=mysqli_query($link,$sql1);
            break;

             case 'life':
                 $page=$_POST['page'];
                 $school=$_POST['school'];
                 $sql0="select * from topiclist  where topictype='生活' and school='{$school}' and status!='0'  order by commentnum desc";
                 $res=mysqli_query($link,$sql0);
                 $maxRows=mysqli_num_rows($res);
                 $maxPages=ceil($maxRows/$pageSize);

                 if($page>$maxPages){
                  $page=$maxPages;
                 }if($page<1){
                  $page=1;
                 }
                 //拼装分页sql
                 $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                 $sql1="select * from topiclist where topictype='生活' and school='{$school}' and status!='0' order by commentnum desc {$limit}";
                 $result=mysqli_query($link,$sql1);
            break;
            case 'emotion':
                 $page=$_POST['page'];
                 $school=$_POST['school'];
                 $sql0="select * from topiclist  where topictype='情感' and school='{$school}' and status!='0' order by commentnum desc";
                 $res=mysqli_query($link,$sql0);
                 $maxRows=mysqli_num_rows($res);
                 $maxPages=ceil($maxRows/$pageSize);

                 if($page>$maxPages){
                  $page=$maxPages;
                 }if($page<1){
                  $page=1;
                 }
                 //拼装分页sql
                 $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                 $sql1="select * from topiclist where topictype='情感' and school='{$school}' and status!='0' order by commentnum desc {$limit}";
                 $result=mysqli_query($link,$sql1); 
            break;
            case 'havefun':
                 $page=$_POST['page'];
                 $school=$_POST['school'];
                 $sql0="select * from topiclist  where topictype='娱乐' and school='{$school}' and status!='0' order by commentnum desc";
                 $res=mysqli_query($link,$sql0);
                 $maxRows=mysqli_num_rows($res);
                 $maxPages=ceil($maxRows/$pageSize);

                 if($page>$maxPages){
                  $page=$maxPages;
                 }if($page<1){
                  $page=1;
                 }
                 //拼装分页sql
                 $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                 $sql1="select * from topiclist where topictype='娱乐' and school='{$school}' and status!='0' order by commentnum desc {$limit}";
                 $result=mysqli_query($link,$sql1);
            break;

             case 'search':
                 $page=$_POST['page'];
                 $school=$_POST['school'];
                 $keywords=$_POST['keywords'];
                 $keywordsLen=mb_strlen($keywords,'utf-8');
                 if($keywordsLen==1){
                    $sql0="select * from topiclist  where  topictitle like '%$keywords%' and school='{$school}' and status!='0' order by commentnum desc";
                        $res=mysqli_query($link,$sql0);
                     $maxRows=mysqli_num_rows($res);
                     $maxPages=ceil($maxRows/$pageSize);

                     if($page>$maxPages){
                      $page=$maxPages;
                     }if($page<1){
                      $page=1;
                     }
                     //拼装分页sql
                     $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                     $sql1="select * from topiclist where topictitle like '%$keywords%' and school='{$school}' and status!='0' order by commentnum desc {$limit}";
                }else if($keywordsLen==2){
                     $keywords0=mb_substr($keywords,0,1,'utf-8');
                     $keywords1=mb_substr($keywords,1,1,'utf-8');
                     $sql0="select * from topiclist  where  topictitle like '%$keywords0%' or topictitle like '%$keywords1%' and school='{$school}' and status!='0' order by commentnum desc";
                     $res=mysqli_query($link,$sql0);
                         $maxRows=mysqli_num_rows($res);
                         $maxPages=ceil($maxRows/$pageSize);

                         if($page>$maxPages){
                          $page=$maxPages;
                         }if($page<1){
                          $page=1;
                         }
                         //拼装分页sql
                         $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
        $sql1="select * from topiclist  where  topictitle like '%$keywords0%' or topictitle like '%$keywords1%' and school='{$school}' and status!='0' order by commentnum desc {$limit}";
                        
                       
                }else if($keywordsLen==3){
                    $keywords0=mb_substr($keywords,0,1,'utf-8');
                     $keywords1=mb_substr($keywords,1,1,'utf-8');
                     $keywords2=mb_substr($keywords,2,1,'utf-8');
                     $sql0="select * from topiclist  where  topictitle like '%$keywords0%' or topictitle like '%$keywords1%' or topictitle like '%$keywords2%' and school='{$school}' and status!='0' order by commentnum desc";
                     $res=mysqli_query($link,$sql0);
                 $maxRows=mysqli_num_rows($res);
                 $maxPages=ceil($maxRows/$pageSize);

                 if($page>$maxPages){
                  $page=$maxPages;
                 }if($page<1){
                  $page=1;
                 }
                 //拼装分页sql
                 $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                 $sql1="select * from topiclist  where  topictitle like '%$keywords0%' or topictitle like '%$keywords1%' or topictitle like '%$keywords2%' and school='{$school}' and status!='0' order by commentnum desc {$limit}";
                 // echo $sql1;
                }else if($keywordsLen==4){
                    $keywords0=mb_substr($keywords,0,1,'utf-8');
                     $keywords1=mb_substr($keywords,1,1,'utf-8');
                     $keywords2=mb_substr($keywords,2,1,'utf-8');
                     $keywords3=mb_substr($keywords,3,1,'utf-8');
                     $sql0="select * from topiclist  where  topictitle like '%$keywords0%' or topictitle like '%$keywords1%' or topictitle like '%$keywords2%' or topictitle like '%$keywords3%' and  school='{$school}' and status!='0' order by commentnum desc";
                     $res=mysqli_query($link,$sql0);
                 $maxRows=mysqli_num_rows($res);
                 $maxPages=ceil($maxRows/$pageSize);

                 if($page>$maxPages){
                  $page=$maxPages;
                 }if($page<1){
                  $page=1;
                 }
                 //拼装分页sql
                 $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                 $sql1="select * from topiclist  where  topictitle like '%$keywords0%' or topictitle like '%$keywords1%' or topictitle like '%$keywords2%' or topictitle like '%$keywords3%' and  school='{$school}' and status!='0' order by commentnum desc {$limit}";
                 // echo $sql1;
                }else if($keywordsLen>=5) {
                     $keywords0=mb_substr($keywords,0,1,'utf-8');
                     $keywords1=mb_substr($keywords,1,1,'utf-8');
                     $keywords2=mb_substr($keywords,2,1,'utf-8');
                     $keywords3=mb_substr($keywords,3,1,'utf-8');
                     $keywords4=mb_substr($keywords,4,1,'utf-8');
                     $sql0="select * from topiclist  where  topictitle like '%$keywords0%' or topictitle like '%$keywords1%' or topictitle like '%$keywords2%' or topictitle like '%$keywords3%' and topictitle like '%$keywords4%' and school='{$school}' and status!='0' order by commentnum desc";
                     $res=mysqli_query($link,$sql0);
                 $maxRows=mysqli_num_rows($res);
                 $maxPages=ceil($maxRows/$pageSize);

                 if($page>$maxPages){
                  $page=$maxPages;
                 }if($page<1){
                  $page=1;
                 }
                 //拼装分页sql
                 $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                 $sql1="select * from topiclist  where  topictitle like '%$keywords0%' or topictitle like '%$keywords1%' or topictitle like '%$keywords2%' or topictitle like '%$keywords3%' or topictitle like '%$keywords4%' and school='{$school}' and status!='0' order by commentnum desc {$limit}";
                }else{
                    $sql0="select * from topiclist  where  school='{$school}' and status!='0' order by commentnum desc";
                        $res=mysqli_query($link,$sql0);
                     $maxRows=mysqli_num_rows($res);
                     $maxPages=ceil($maxRows/$pageSize);

                     if($page>$maxPages){
                      $page=$maxPages;
                     }if($page<1){
                      $page=1;
                     }
                     //拼装分页sql
                     $limit="limit ".(($page-1)*$pageSize).",{$pageSize}";
                     $sql1="select * from topiclist where  school='{$school}' and status!='0' order by commentnum desc {$limit}";
                }
                 // echo $sql1;
                 $result=mysqli_query($link,$sql1);
            break;

            case 'singletopic':
                $tid=$_POST['tid'];
                $sql="select * from topiclist where tid='{$tid}'";

                $result=mysqli_query($link,$sql);
            break;

            case 'coltopic':
                $username=$_POST['username'];
                $sql0="select * from user where email='{$username}' and status!='0'";
                $res1=mysqli_query($link,$sql0);
                while($r1=mysqli_fetch_array($res1)){
                      $coltopic=$r1['coltopic'];  
                }
            break;

            case 'admintopic':
                 
                 $school=$_POST['school'];
                 $type=$_POST['type'];
                
                 if($type=='all'){
                    $sql0="select * from topiclist  where school='{$school}' order by commentnum desc";
                 }else if($type=='0'){
                     $sql0="select * from topiclist  where school='{$school}'  and status='0' order by commentnum desc";
                 }else if($type=='1'){
                     $sql0="select * from topiclist  where school='{$school}'  and status='1'  order by commentnum desc";
                 }else if($type=='2'){
                     $sql0="select * from topiclist  where school='{$school}'  and status='2' order by commentnum desc";
                 }

                 $result=mysqli_query($link,$sql0);
            break;

          }
                         
       $data= array();
      while ($row=mysqli_fetch_array($result)) {
            $tid=$row['tid'];
            $topictype=$row['topictype'];
            $topictitle=$row['topictitle'];
            $topicintro=$row['topicintro'];
            $topicnotice=$row['topicnotice'];
            $topicpic=$row['topicpic'];
            $publishtime=$row['publishtime'];
            $publisher=$row['publisher'];
                $sql0="select * from user where email='{$publisher}'";
                $res=mysqli_query($link,$sql0);
                while($r=mysqli_fetch_array($res)){
                  $publishername=$r['nickname'];
                }
            // $commentnum=$row['commentnum'];
            $sql1="select * from topiccomment where topicid='{$tid}'";
            $res=mysqli_query($link,$sql1);
            $commentnum=mysqli_num_rows($res);

            $status=$row['status'];

            $arr=array('tid'=>$tid,'topictype'=>$topictype,'topictitle'=>$topictitle,'topicintro'=>$topicintro,'topicnotice'=>$topicnotice,'topicpic'=>$topicpic,
              'publishtime'=>$publishtime,'publisher'=>$publisher,'publishername'=>$publishername,'commentnum'=>$commentnum,'status'=>$status,'maxPages'=>$maxPages);
           array_push($data,$arr);   
      } 
           
           echo  json_encode($data);
           mysqli_free_result($result);
           mysqli_close($link);  

      ?>