<?php

            require("dbconfig.php");
            // require("mailfunction.php");

            require('dblink.php');
            require('fileupload.class.php');
            require('img.class.php');
            require('snsfunction.php');

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $username=$_POST['username'];
  
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
                        $image= new image($picurl,1,"400","400",$picurl);
                        $image ->outimage();
                        // //执行图片裁减
                       
                      
                        //删除老头像
                        // @unlink($oldpicurl);
                        //将图片名插入到数据库
                        $sql="update user set ident='{$pic}' where email='{$username}'";

                        $sql2="update user set active='2' where email='{$username}'";
                        
                            $telphone='18501773419';
                            $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                            $text="【WeShare乐分享】有用户上传认证信息了,去看看吧";
                            $sms=send_sms($apikey,$text,$telphone);
                        mysqli_query($link,$sql);
                        mysqli_query($link,$sql2);
                        echo '1';



?>