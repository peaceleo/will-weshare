<?php

$link=mysqli_connect(HOST,USER,PASS,DBNAME) or die ('faile to connect');
	mysqli_query($link,"SET NAMES 'utf8'");
	mysqli_select_db($link,DBNAME);

?>