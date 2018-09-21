<?php
header("Content-type: text/html; charset=utf-8"); 
$sql0= "CREATE TABLE IF NOT EXISTS `user` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(64) DEFAULT NULL,
  `rewardPoints` int(11) NOT NULL DEFAULT '200',
  `email` varchar(64) NOT NULL,
  `password` char(32) NOT NULL,
  `school` char(64) NOT NULL,
  `sex` char(10) NOT NULL DEFAULT '你猜',
  `telphone` char(32) NOT NULL,
  `note` varchar(100) DEFAULT '被人需要是一种莫大的幸福',
  `addtime` int(10) unsigned NOT NULL,
  `skill` varchar(1000) NOT NULL,
  `head` varchar(1000) DEFAULT 'default_head.jpg',
  `ident` varchar(1000) DEFAULT 'default_head.jpg',
  `active` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0";

$sql1= "CREATE TABLE IF NOT EXISTS `needlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(10) CHARACTER SET utf8 NOT NULL,
  `usertel` varchar(30) CHARACTER SET gb2312 COLLATE gb2312_bin DEFAULT NULL,
  `needtime` varchar(30) DEFAULT NULL,
  `needlocation` varchar(30) DEFAULT NULL,
  `remark` text CHARACTER SET utf8,
  `publishtime` int(30) DEFAULT NULL,
  `user` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `needpay` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  AUTO_INCREMENT=0";

$sql2= "CREATE TABLE IF NOT EXISTS `helpermsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf8,
  `bywho` varchar(64) DEFAULT NULL,
  `towho` varchar(64) DEFAULT NULL,
  `needid` int(11) DEFAULT NULL,
  `sendtime` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  AUTO_INCREMENT=0";

$sql3= "CREATE TABLE IF NOT EXISTS `comment` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text CHARACTER SET utf8,
  `bywho` varchar(64) DEFAULT NULL,
  `towho` varchar(64) DEFAULT NULL,
  `needid` int(11) DEFAULT NULL,
  `sendtime` int(30) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  AUTO_INCREMENT=0";

$sql4= "CREATE TABLE IF NOT EXISTS `exchangeorder` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `onum` varchar(32),
  `bywho` varchar(64) DEFAULT NULL,
  `towhotel` varchar(64) DEFAULT NULL,
  `proname` varchar(64) DEFAULT NULL,
  `proprice` varchar(64) DEFAULT NULL,
  `propic` varchar(64) DEFAULT NULL,
  `addtime` int(30) NOT NULL,
  `remark` varchar(30) NULL,

  PRIMARY KEY (`oid`)
) ENGINE=InnoDB  AUTO_INCREMENT=0";



$sql5="CREATE TABLE IF NOT EXISTS `exchangePro` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `type` varchar(64) DEFAULT NULL,
  `price` int(30) DEFAULT NULL,
  `description` text,
  `pic` varchar(64) NOT NULL,
  `store` int(32) NOT NULL,
  `addtime` int(30) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0";

// 享豆充值表设计
// rid 
// towho
// number
// addtime
// addintro
// bywho

$sql5="CREATE TABLE IF NOT EXISTS `rewardAdd` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `towho` varchar(64) NOT NULL,
  `price` varchar(64) DEFAULT NULL,
  `addintro` varchar(64) DEFAULT NULL,
  `addtime` int(30) DEFAULT NULL,
  `bywho` varchar(64) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0";

$sql6="CREATE TABLE IF NOT EXISTS `department` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `school` varchar(64) NOT NULL,
  `departmentName` varchar(64) DEFAULT NULL,
  `else` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0";


$sql6="CREATE TABLE IF NOT EXISTS `coursebook` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `school` varchar(64) NOT NULL,
  `departmentName` varchar(64) DEFAULT NULL,
  `coursename` varchar(64) DEFAULT NULL,
  `courseteacher` varchar(64) DEFAULT NULL,
  `courserbook` varchar(64) DEFAULT NULL,
  `bookprice` varchar(64) DEFAULT NULL,
  `exchangeprice` varchar(64) DEFAULT NULL,
  `recoverprice` varchar(64) DEFAULT NULL,
  `store` varchar(64) DEFAULT NULL,
  `else` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=0";

mysqli_query($link,$sql0);
mysqli_query($link,$sql1);
// mysqli_query($link,$sql2);
// mysqli_query($link,$sql3);
// mysqli_query($link,$sql4);
// mysqli_query($link,$sql5);
mysqli_close($link);

?>