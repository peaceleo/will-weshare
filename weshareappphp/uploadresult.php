<?php

            require("dbconfig.php");
            // require("mailfunction.php");

            require('dblink.php');
            require('fileupload.class.php');
             require('img.class.php');


             $bywho=$_POST['username'];
             $tid=$_POST['tid'];
             $resultintro=$_POST['resultintro'];
             $taskpay=$_POST['taskpay'];

             $sendtime=time();



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
                         $image= new image($picurl,1,"750","750",$picurl);
                        $image ->outimage();
                $sql="insert into taskresult(aid,status,taskresult,resultintro,bywho,towho,taskid,sendtime,taskpay) 
                values(null,'0','$pic','$resultintro','$bywho',null,'$tid','$sendtime','$taskpay')";       
                        mysqli_query($link,$sql);
                



?>