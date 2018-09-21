<?php

            require("dbconfig.php");
            // require("mailfunction.php");

            require('dblink.php');
            // require('fileupload.class.php');
            require('img.class.php');
            require('snsfunction.php');

                        $s=dirname(__FILE__);
                        $time=time();
                        $username=$_POST['username'];
                        $files=$_POST['files'];


                         $tmp=base64_decode($files);
                         $fp=$s.'/uploads/'.$time.'.jpg';
                         file_put_contents($fp, $tmp); 
                         $pic=$time.'.jpg';
                         $image= new image($fp,1,"350","350",$fp);
                         $image ->outimage();
                       
                        $sql="update user set ident='{$pic}' where email='{$username}'";

                        $sql2="update user set active='2' where email='{$username}'";
                        
                            $telphone='18501773419';
                            $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                            $text="【WeShare乐分享】有用户上传认证信息了,去看看吧";
                            $sms=send_sms($apikey,$text,$telphone);

                        $sql3="select * from user where email='{$username}'";
                           $result=mysqli_query($link,$sql3);
                             while ($rows=mysqli_fetch_array($result)) {
                                   $usertel=$rows['telphone'];
                             
                            }
                            $apikey ="5f6a348ff0b20d5225472f403b2d91c0"; 
                            $text="【WeShare乐分享】小乐给您报喜了,您的身份认证已经通过.我们分享温暖,我们收获感动,在这儿,您永远不会是一个人.";
                            send_sms($apikey,$text,$usertel);    
                        mysqli_query($link,$sql);
                        mysqli_query($link,$sql2);
                        echo '1';



?>