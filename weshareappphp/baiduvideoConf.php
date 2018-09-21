<?php
/*
* Copyright (c) 2014 Baidu.com, Inc. All Rights Reserved
*
* Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with
* the License. You may obtain a copy of the License at
*
* Http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on
* an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the
* specific language governing permissions and limitations under the License.
*/

// // 报告所有 PHP 错误
error_reporting(0);

define('__VOD_CLIENT_ROOT', dirname(__DIR__));

// 设置VodClient, BosClient的Access Key ID、Secret Access Key和ENDPOINT
// 你仅需修改其中的ak、sk，其他部分请勿修改。
// ba14751c4b5948ee845709aa9d0dde65
// f39552e58b8d4ebe943cfa5713af2e37
$my_credentials = array(
    'ak' => '2902ce2b163b40b09fca22dd2b42be38',
    'sk' => 'b81854dccf264cccadd38c0db71da421',
);
$g_vod_configs = array(
    'credentials' => $my_credentials,
    'endpoint' => 'http://vod.baidubce.com',
);

$g_bos_configs = array(
    'credentials' => $my_credentials,
    'endpoint' => 'http://bj.bcebos.com',
);

// 设置log的格式和级别
$__handler = new \Monolog\Handler\StreamHandler(STDERR, \Monolog\Logger::DEBUG);
$__handler->setFormatter(
    new \Monolog\Formatter\LineFormatter(null, null, false, true)
);
\BaiduBce\Log\LogFactory::setInstance(
    new \BaiduBce\Log\MonoLogFactory(array($__handler))
);
\BaiduBce\Log\LogFactory::setLogLevel(\Psr\Log\LogLevel::DEBUG);