<?php
 session_start();
    header("Content-type: text/html; charset=utf-8"); 
    require('dbconfig.php');
    require('dblink.php');
  
 switch ($_GET['action']) {
    	case 'adminlogin':
    		$username=$_POST['username'];
    	    
    		$password=$_POST['password'];
    		$sql0="select * from user where email='{$username}'";
    		$res=mysqli_query($link,$sql0);
    		if(mysqli_num_rows($res)==0){
    			echo 'NOT EXIST';
    		}else{
    			while ($r1=mysqli_fetch_array($res)) {
    			$isManager=$r1['isManager'];
    			$tpassword=$r1['password'];
	    		}

	    		if($isManager==0){
	    			echo "<script>alert('您不是管理员')</script>";
                    echo "<script>location.href='adminlogin.php'</script>";
	    		}else{
	    			if(md5($password)==$tpassword){
	    				 $_SESSION["loginuser"]=$username;
                         $_SESSION["isManager"]=$isManager;
	    				 echo "<script>alert('欢迎回来')</script>";
	    				echo "<script>location.href='weshareadmin.php'</script>";

	    			}else{
	    				echo "<script>alert('密码错误')</script>";
                        echo "<script>location.href='adminlogin.php'</script>";
	    			}

	    		}
    		}
    		

    		break;
    	
    	case 'adminlogout':
    		 unset($_SESSION['loginuser']);
             header('Location:adminlogin.php');
    		break;
    }   
?>