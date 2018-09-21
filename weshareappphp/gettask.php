<?php
date_default_timezone_set("Asia/Shanghai");
header("Content-type:text/html;charset=utf-8");

require('dbconfig.php');
require('dblink.php');

$pagesize=5;
$maxpages=0;
$maxrows=0;

switch ($_POST['action']) {
	case 'alltask':
		$page=$_POST['page'];
		$school=$_POST['school'];
		$sql0="select * from tasklist where school='{$school}' and type='task'";
		$res=mysqli_query($link,$sql0);
		$maxrows=mysqli_num_rows($res);

		//计算最大页数
		$maxpages=ceil($maxrows/$pagesize);
		if($page>$maxpages){
			$page=$maxpages;
		}else if($page<1){
			$page=1;
		}
		//拼装分页sql语句
		$limit="limit ".(($page-1)*$pagesize).",{$pagesize}";
		$sql="select * from tasklist where school='{$school}' and type='task' order by tid desc {$limit}";

		$result=mysqli_query($link,$sql);
	break;
	case 'actingtask':
		$page=$_POST['page'];
		$school=$_POST['school'];
		$sql0="select * from tasklist where status='0' and school='{$school}' and type='task'";
		$res=mysqli_query($link,$sql0);
		$maxrows=mysqli_num_rows($res);

		//计算最大页数
		$maxpages=ceil($maxrows/$pagesize);
		if($page>$maxpages){
			$page=$maxpages;
		}else if($page<1){
			$page=1;
		}
		//拼装分页sql语句
		$limit="limit ".(($page-1)*$pagesize).",{$pagesize}";
		$sql="select * from tasklist where status='0' and school='{$school}' and type='task'  order by tid desc {$limit}";

		$result=mysqli_query($link,$sql);
	break;

	case 'finishedtask':
		$page=$_POST['page'];
		$school=$_POST['school'];
		$sql0="select * from tasklist where status='1' and school='{$school}' and type='task' ";
		$res=mysqli_query($link,$sql0);
		$maxrows=mysqli_num_rows($res);

		//计算最大页数
		$maxpages=ceil($maxrows/$pagesize);
		if($page>$maxpages){
			$page=$maxpages;
		}else if($page<1){
			$page=1;
		}
		//拼装分页sql语句
		$limit="limit ".(($page-1)*$pagesize).",{$pagesize}";
		$sql="select * from tasklist where  status='1' and school='{$school}' and type='task'  order by tid desc {$limit}";

		$result=mysqli_query($link,$sql);
	break;
	
	case 'singletask':
		$tid=$_POST['tid'];
		$sql="select * from tasklist where tid='{$tid}'";
		$result=mysqli_query($link,$sql);
	break;

	case 'allacti':
		$page=$_POST['page'];
		$school=$_POST['school'];
		$sql0="select * from tasklist where school='{$school}' and type='acti'";
		$res=mysqli_query($link,$sql0);
		$maxrows=mysqli_num_rows($res);

		//计算最大页数
		$maxpages=ceil($maxrows/$pagesize);
		if($page>$maxpages){
			$page=$maxpages;
		}else if($page<1){
			$page=1;
		}
		//拼装分页sql语句
		$limit="limit ".(($page-1)*$pagesize).",{$pagesize}";
		$sql="select * from tasklist where school='{$school}' and type='acti' order by tid desc {$limit}";

		$result=mysqli_query($link,$sql);
	break;
	case 'actingacti':
		$page=$_POST['page'];
		$school=$_POST['school'];
		$sql0="select * from tasklist where status='0' and school='{$school}' and type='acti'";
		$res=mysqli_query($link,$sql0);
		$maxrows=mysqli_num_rows($res);

		//计算最大页数
		$maxpages=ceil($maxrows/$pagesize);
		if($page>$maxpages){
			$page=$maxpages;
		}else if($page<1){
			$page=1;
		}
		//拼装分页sql语句
		$limit="limit ".(($page-1)*$pagesize).",{$pagesize}";
		$sql="select * from tasklist where status='0' and school='{$school}' and type='acti'  order by tid desc {$limit}";

		$result=mysqli_query($link,$sql);
	break;

	case 'finishedacti':
		$page=$_POST['page'];
		$school=$_POST['school'];
		$sql0="select * from tasklist where status='1' and school='{$school}' and type='acti' ";
		$res=mysqli_query($link,$sql0);
		$maxrows=mysqli_num_rows($res);

		//计算最大页数
		$maxpages=ceil($maxrows/$pagesize);
		if($page>$maxpages){
			$page=$maxpages;
		}else if($page<1){
			$page=1;
		}
		//拼装分页sql语句
		$limit="limit ".(($page-1)*$pagesize).",{$pagesize}";
		$sql="select * from tasklist where  status='1' and school='{$school}' and type='acti'  order by tid desc {$limit}";

		$result=mysqli_query($link,$sql);
	break;
	
	case 'singleacti':
		$tid=$_POST['tid'];
		$sql="select * from tasklist where tid='{$tid}'";
		$result=mysqli_query($link,$sql);
	break;

	case 'adminalltasks':
		$school=$_POST['school'];
		$type=$_POST['type'];
		if($school=='所有学校'){
			if($type=='all'){
				$sql="select * from tasklist order by tid desc ";
			}else{
				$sql="select * from tasklist  where status='{$type}'order by tid desc ";
			}
			
		}else{
			if($type=='all'){
				$sql="select * from tasklist where school='{$school}' order by tid desc ";
			}else{
				$sql="select * from tasklist where school='{$school}'  and status='{$type}' order by tid desc ";
			}
			
		}
		$result=mysqli_query($link,$sql);
	break;
}
$data=array();
while ($rows=mysqli_fetch_array($result)) {
	$tid=$rows['tid'];
		//获取result总数
		$sql0="select * from taskresult where taskid='{$tid}'";
		$res0=mysqli_query($link,$sql0);
		$resultnum=mysqli_num_rows($res0);
		//获取comment总数
		$sql1="select * from taskcomment where taskid='{$tid}'";
		$res1=mysqli_query($link,$sql1);
		$commentnum=mysqli_num_rows($res1);
		//获取支持总数
		$sql2="select * from tasksurport where taskid='{$tid}'";
		$res2=mysqli_query($link,$sql2);
		$surportnum=mysqli_num_rows($res2);

	$title=$rows['title'];
	$taskintro=$rows['taskintro'];
	$taskdemond=$rows['taskdemond'];
	$tasktips=$rows['tasktips'];
	$publishtime=$rows['publishtime'];
	$publisher=$rows['publisher'];
	$sponsor=$rows['sponsor'];
	$status=$rows['status'];
	if($status==0){
		$statustext='进行中';
		$statusactiontext='标注完成';
	}else{
		$statustext="已完成";
		$statusactiontext="已完成";
	}

	$taskpayper=$rows['taskpayper'];
	$taskpic=$rows['taskpic'];
	$school=$rows['school'];
	$viewnum=$rows['viewnum'];
	$time=$rows['tasktime'];
	$location=$rows['tasklocation'];

  $arr=array('tid'=>$tid,'title'=>$title,'taskintro'=>$taskintro,'taskdemond'=>$taskdemond,'tasktips'=>$tasktips,
  	'publishtime'=>$publishtime,'publisher'=>$publisher,'sponsor'=>$sponsor,'status'=>$status,'statustext'=>$statustext,'statusactiontext'=>$statusactiontext,'taskpayper'=>$taskpayper,
  	'taskpic'=>$taskpic,'maxpages'=>$maxpages,'maxrows'=>$maxrows,'pagesize'=>$pagesize,'school'=>$school,
  	'resultnum'=>$resultnum,'commentnum'=>$commentnum,'surportnum'=>$surportnum,'viewnum'=>$viewnum,'time'=>$time,'location'=>$location);
  array_push($data,$arr);

}
echo json_encode($data);
?>