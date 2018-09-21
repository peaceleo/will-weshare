<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>weshare</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/weshare.css">
    <script src="js/jquery-1.11.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src='js/weshare.js'></script> 
    <style type="text/css">
    /*body{
      background: #66cccc;
      opacity: 0.6;
    }*/
    .wrap{
      margin:auto;
      width: 100%;
      text-align: center;
      margin-top: 150px;
    }
    .warp div{
      margin-top: 50px;
    }
    .btn{
      width: 220px;
      margin-top: 10px;
    }
    .registertitle{
      margin-bottom: 40px;
      font-size: 30px;
      font-weight: bolder;
      /*color: white;*/
    }
    </style>
  </head>
  <body> 
    <?php 
     session_start();
    header("Content-type: text/html; charset=utf-8"); 
    require('dbconfig.php');
    require('dblink.php');
    ?>

    <div class='wrap'>
    <div>
          <section class='registertitle'>WeShare后台登陆</section>
          <section class='registerform'>
            <form  class="form-horizontal" action="adminuseraction.php?action=adminlogin"  method="post" >
                   <div class='col-xs-12 seperate'>
                        <label for='username' class='col-xs-5 '></label>
                        <div class='col-xs-12'>
                            <input id='username' class='form-control noborder' type='text' name='username' value='' placeholder='注册学号' />
                        </div>
                  </div>
                   <div class='col-xs-12 seperate'>
                        <label for='password ' class='col-xs-5 '></label>
                        <div class='col-xs-12'>
                            <input id='password ' class='form-control noborder' type='password' name='password' value='' placeholder='通关密语'/>
                        </div>
                  </div>
                   <button type='submit' class='btn btn-primary'>确认提交</button>
            </form>
            
          </section>

    </div>
    </div>
     
  </body>
</html>