<?php

date_default_timezone_set("Asia/Shanghai");
header("Content-type:text/html;charset=utf-8");

require('dbconfig.php');
require('dblink.php');

$rid=$_POST['rid'];
$sql="update reminder set status='1' where rid='{$rid}'";
$result=mysqli_query($link,$sql);
?>