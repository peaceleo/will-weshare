<?php

            require("dbconfig.php");
            // require("mailfunction.php");

            require('dblink.php');
            require('fileupload.class.php');
             require('img.class.php');

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username=$_POST['username'];
  
                        $imgX=$_POST['x'];
                        $imgY=$_POST['y'];
                        $imgW=$_POST['w'];
                        $imgH=$_POST['h'];
                        $realW=$_POST['realw'];
                        $realH=$_POST['realh'];
                        // echo $imgX;
                        // echo $imgY;
                        // echo $imgW;
                        // echo $imgH;
                        // echo $realW;
                        // echo $realH;
                        $up= new FileUpload;
                        $up -> set("path", "./uploads/");
                        $up -> set("maxsize", 10000000);
                        $up -> set("allowtype", array("gif", "png", "jpg","jpeg"));
                         
                        if($up ->upload("pic")){
                           
                          $pic=$up ->getFileName();
                          
                          
                          $picurl="./uploads/".$pic;
                          
                        }else{
                          echo '<pre>';
                          var_dump($up ->getErrorMsg());
                          echo '</pre>';
                        }
                        
                        
                        $image= new image($picurl,1,"$realW","$realH",$picurl);
                        $image ->outimage();
                        //执行图片裁减
                       
                        $image=new image($picurl,2,"$imgX,$imgY","$imgW,$imgH",$picurl);
                        $image ->outimage();
                         
                        //删除老头像
                        // @unlink($oldpicurl);
                        //将图片名插入到数据库
                        // $email=$_SESSION['loginuser']["email"];
                        $sql="update user set head='{$pic}' where email='{$username}'";
                        mysqli_query($link,$sql);
                        echo '1';



?>