<?php
      date_default_timezone_set("Asia/Shanghai");
      session_start();
      header("Content-type: text/html; charset=utf-8"); 
      error_reporting(0);
      //导入配置文件
      require('dbconfig.php');

      require('dblink.php');
       
        switch ($_POST['action']) {

            case 'thanktowholist':
                 $needid=$_POST['needid'];
                 
                 $data=array();
                 $sql0="select nickname from helpermsg a,user b where a.needid='{$needid}' and b.email=a.bywho";

                 $a=mysqli_query($link,$sql0);
                 while ($r=mysqli_fetch_array($a)){
                     $msgtowho=$r['nickname'];
                     array_push($data,$msgtowho);
                 }
                 $sql1="select nickname from comment a,user b where a.needid='{$needid}' and b.email=a.bywho";
                 $b=mysqli_query($link,$sql1);
                 while($row=mysqli_fetch_array($b)){
                     $commenttowho=$row['nickname'];
                     array_push($data, $commenttowho);
                 }
                 $datares=array_unique($data);
                 $dataresult=array_values($datares);
                 echo  json_encode($dataresult);
            break;

           case 'exchangetypelist':
                $sql="select * from exchangePro";
                $res=mysqli_query($link,$sql);
                $data=array();
                while($r=mysqli_fetch_array($res)){
                   $type=$r['type'];
                   array_push($data, $type);
                }
                $datares=array_unique($data);
                $dataresult=array_values($datares);
                echo json_encode($dataresult);
           break;


           case 'schoollist':
            $sql=" select * from schoollist";
            $res=mysqli_query($link,$sql);
            $data=array();
            while($r=mysqli_fetch_array($res)){
              $name=$r['sname'];
              array_push($data, $name);
            }
            echo json_encode($data);
           break;
            
            case 'servicelist':
            $sql="select * from servicelist";
            $res=mysqli_query($link,$sql);
            $data=array();
            while($r=mysqli_fetch_array($res)){
              $name=$r['sname'];
              array_push($data, $name);
            }
            echo json_encode($data);
            break;

            case 'departmentlist':
            $sql="select * from department order by did DESC";
            $res=mysqli_query($link,$sql);
            $data=array();
            while ($r=mysqli_fetch_array($res)) {
              $department=$r['departmentName'];
              array_push($data,$department);
            }
            echo json_encode($data);
            break;


            case 'topictypelist':
              $sql="select * from topictypelist order by sid DESC";
              $res=mysqli_query($link,$sql);
              $data=array();
              while($r=mysqli_fetch_array($res)){
                $topictype=$r['topictype'];
                array_push($data,$topictype);
              }
              echo json_encode($data);
            break;

            case 'protypelist':
                $sql="select * from protypelist";
                $res=mysqli_query($link,$sql);
                $data=array();
                while($rows=mysqli_fetch_array($res)){
                  $protype=$rows['ptname'];
                  array_push($data,$protype);
                }
                echo json_encode($data);
            break;

            case  'exchangesubtypelist':
                $sql="select * from exchangePro";
                $res=mysqli_query($link,$sql);
                $data=array();
                while($r=mysqli_fetch_array($res)){
                   $subtype=$r['subtypea'];
                   array_push($data, $subtype);
                }
                $datares=array_unique($data);
                $dataresult=array_values($datares);
                echo json_encode($dataresult);
            break;

          }
                         
        

      
           
           
           mysqli_free_result($result);
           mysqli_close($link);  

      ?>