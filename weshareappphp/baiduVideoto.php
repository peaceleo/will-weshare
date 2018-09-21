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
include 'BaiduBce.phar';
require ('baiduvideoConf.php');



use BaiduBce\BceClientConfigOptions;
use BaiduBce\Services\Vod\VodClient;
use BaiduBce\Services\Bos\BosClient;



//上传至百度的服务器
	
function uploadToBaidu($videourl,$tid,$sendtime,$bywho,$taskpay,$resultintro){
	require ("dbconfig.php");
	require ('dblink.php');
	global $g_vod_configs;
	global $g_bos_configs;

	//新建vodClient和bosClient
	$vodClient = new VodClient($g_vod_configs, $g_bos_configs);
	// echo $tid;
	$bosClient = new BosClient($g_bos_configs);
	
	
	$videoname=$tid.'@'.$sendtime;
	$videodes=$tid.'@'.$bywho;

	$createMediaFromFileResult = $vodClient->createMediaFromFile($videourl, $videoname, $videodes);
	// echo $videoname;
	$data=json_encode($createMediaFromFileResult);
    $arr=json_decode($data,true);
    $mediaId=$arr['mediaId'];
    $sql="insert into taskresult(aid,status,taskresult,resultintro,bywho,towho,taskid,sendtime,taskpay,type)values(null,'0','$mediaId','$resultintro','$bywho',null,'$tid','$sendtime','$taskpay','video')";
    // echo $sql; 
     mysqli_query($link,$sql); 
     @unlink($videourl);       
}


//获取媒体的信息

function  getMediaInfo($mediaId){
	$response = $vodClient->getMedia($mediaId);
    echo json_encode($response);
}

// 获取媒体资源的播放地址和缩略图

function getMediaPlay($mediaId){
	global $g_vod_configs;
	global $g_bos_configs;
	// echo $videourl;
     
	//新建vodClient和bosClient
	$vodClient = new VodClient($g_vod_configs, $g_bos_configs);
	// echo $tid;
	$bosClient = new BosClient($g_bos_configs);

	$status = $vodClient->getMedia($mediaId);
  	$statusData=json_encode($status);
    $statusaArr=json_decode($statusData,true);
    // var_dump($statusaData);
    // echo $statusaArr['status'];
    // echo $statusaArr['status']=='PULISHEd';
    if($statusaArr['status']=='PUBLISHED'){
    	$response = $vodClient->getPlayableUrl($mediaId);
	    $data=json_encode($response);
	    $arr=json_decode($data,true);
	    return $arr;
    }else{
    	return '';
    }
	
}
// getMediaPlay('mda-ggzxwyqz14ydsksj123');

?>