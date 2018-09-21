<?php
/*
* Copyright (c) 2014 Baidu.com, Inc. All Rights Reserved
*
* Licensed under the Apache License, Version 2.0 (the "License"); you may not
* use this file except in compliance with the License. You may obtain a copy of
* the License at
*
* Http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
* WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
* License for the specific language governing permissions and limitations under
* the License.
*/
			header("Content-type: text/html; charset=utf-8"); 
			error_reporting(0);
			set_time_limit(0);
			require("dbconfig.php");
			require('dblink.php');
			require('fileupload.class.php');
			require('img.class.php');
			require('baiduVideoto.php');
		    
            
			$s=dirname(__FILE__);
		    $bywho=$_POST['username'];
		    $tid=$_POST['tid'];
		   	if(isset($_POST['resultintro'])){
		   		$resultintro=$_POST['resultintro'];
		   		if($resultintro==''){
		   			$resultintro='bady say nothing';
		   		}
		   	}else{
		   		$resultintro='bady say nothing';
		   	}
			$taskpay=$_POST['taskpay'];
			$sendtime=time();
			
			switch ($_POST['action']) {
				case 'pic':
                         $files=$_POST['files'];
                         $tmp=base64_decode($files);
                         $fp=$s.'/uploads/'.$sendtime.'.jpg';
                         $pic=$sendtime.'.jpg';
                         file_put_contents($fp, $tmp);
                         $image= new image($fp,1,"350","350",$fp);
		                 $image ->outimage();

                        $sql="insert into taskresult(aid,status,taskresult,resultintro,bywho,towho,taskid,sendtime,taskpay) values(null,'0','$pic','$resultintro','$bywho',null,'$tid','$sendtime','$taskpay')";       
		                 mysqli_query($link,$sql);

		                 if(mysqli_affected_rows($link)>0){
		                 	echo '1';
		                 }else{
		                 	echo '0';
		                 }
		               
				break;
				
				case 'video':
					
					$up= new FileUpload;
				    $up -> set("path", "./video/");
				    $up -> set("maxsize", 10000000000000);
				    $up -> set("allowtype", array("gif", "png", "jpg","jpeg",'mp4','3gpp','asf','wmv','avi','flv','f4v','mkv','mov','m4a','mp3','mp2','mpeg','mpg','ts','ogg','mts','wmv','wma','rm','rmvb','webm'));
				     
				    if($up ->upload("video")){
				       
				      $video=$up ->getFileName();
				      
				      
				      $videourl=$s."/video/".$video; 
				      
				    }else{
				      echo '<pre>';
				      var_dump($up ->getErrorMsg());
				      echo '</pre>';
				    }
				   	 
					 if(file_exists($videourl)){

				      	echo '1';

				      	if(function_exists("fastcgi_finish_request")){
							fastcgi_finish_request();
							uploadToBaidu($videourl,$tid,$sendtime,$bywho,$taskpay,$resultintro);  
						}else{
							uploadToBaidu($videourl,$tid,$sendtime,$bywho,$taskpay,$resultintro);
						}  

				      	
				      	
				      }else{
				      	echo '0';
				      }	
				break;
						
		      }
			
		    

