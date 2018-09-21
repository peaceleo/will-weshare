<?php
header("Content-type: text/html; charset=utf-8"); 
// error_reporting(0);

require("dbconfig.php");
require('dblink.php');
// require('sql.php');
// require('snsfunction.php');
switch($_POST['action']){

      case 'setnickname':
         $newnickname=$_POST['newnickname'];
         $username=$_POST['username'];
         $sql="update user set nickname='{$newnickname}' where email='{$username}'";
         
         $a=mysqli_query($link,$sql); 
         $ar=mysqli_affected_rows($link);
         if($ar>0){
          echo '1';
         }else{
          echo '0';
         }
      break;
      
      case 'setnote':
      $newnote=$_POST['newnote'];
      $username=$_POST['username'];
      $sql="update user set note='{$newnote}' where email='{$username}'";
      $b=mysqli_query($link,$sql);
      $br=mysqli_affected_rows($link);
      if($br>0){
        echo '1';
      }else{
        echo '0';
      }
           
        break;

      case 'setsex':
        $newsex=$_POST['newsex'];
        $username=$_POST['username'];
        $sql="update user set sex='{$newsex}' where email='{$username}'";
        $b=mysqli_query($link,$sql);
        $br=mysqli_affected_rows($link);
        if($br>0){
          echo '1';
        }else{
          echo '0';
        }
           
        break;

        case 'setphone':
        $newphone=$_POST['newphone'];
        $username=$_POST['username'];
        $sql="update user set telphone='{$newphone}' where email='{$username}'";
        $b=mysqli_query($link,$sql);
        $br=mysqli_affected_rows($link);
        if($br>0){
          echo '1';
        }else{
          echo '0';
        }
           
        break;
}
    

            
            
mysqli_close($link);  
?>








