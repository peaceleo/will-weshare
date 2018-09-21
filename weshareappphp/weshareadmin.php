<!DOCTYPE html>
 <?php 
  session_start();
    header("Content-type: text/html; charset=utf-8"); 
    require('dbconfig.php');
    require('dblink.php');
    if(!isset($_SESSION['loginuser'])){
          echo "<script>alert('login first');</script>";
          echo "<script>location.href='adminlogin.php';</script>";
    }
    ?>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>weshare.admin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/admin.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <script src="js/jquery-1.11.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">

    $(document).ready(function(){
      getallusers();
      $('#userinfo').hide();
      $('#taskinfo').hide();
      $('#failident').hide();
      $('#exchangecontent').hide();
      $('#taskcontent').hide();
      $('#rewardAddContent').hide();
      $('#school').change(function(){
        getallusers(); 

      });


    })
    </script>    
</head>
   <body>
    <section class='adminlist'>

        <div id='useradmin' class='adminnav' onclick="getallusers()">用户管理</div>
        <div id='taskmag' class='adminnav' onclick='getallTasks()'>任务管理</div> 
        <div id='exorderadmin'  class='adminnav' onclick="getexorderadmin()">订单管理</div>
        <!-- <div id='exprolist'  class='adminnav' onclick="getexprolist()">商品管理</div> -->
        <div id='topiclist'  class='adminnav' onclick="gettopiclist()">话题管理</div>
        <!-- <div id='exchangeupload'  class='adminnav' onclick='uploadpro()'>集市商品上传</div> -->
        <!-- <div id='taskpublish'  class='adminnav' onclick='publishTask()'>平台任务发布</div> -->
        <!-- <div id='rewardAdd' class='adminnav' onclick='rewardAdd()'>享豆充值</div> -->
        
         <div class='adminnav' style='float:right;'><a href='adminuseraction.php?action=adminlogout'>注销</a></div>
         <!-- <div class='adminnav' style='float:right;'><a href='bookstoreadmin.php'>乐享书屋管理</a></div> -->
        <div class='adminnav' style='float:right;'><?php echo $_SESSION['loginuser'];?></div>
        <div class='adminnav' style='float:right;'>
              <select id='school'>
                    <?php
                       $username=$_SESSION['loginuser'];
                       $isManager=$_SESSION['isManager'];
                      
                       if($isManager==1){
                        $sql0="select * from schoollist";
                        $result=mysqli_query($link,$sql0);
                        $arr=array();
                        while($rows=mysqli_fetch_array($result)){
                          $school=$rows['sname'];
                          array_push($arr,$school);
                        }
                        foreach ($arr as $school => $v) {
                             echo "<option value='{$v}'>$v</option>";

                           }
                           echo "<option value='所有学校'>所有学校</option>";
                       }
                       if($isManager==2){
                        $sql1="select * from user where email='{$username}'";
                        $result=mysqli_query($link,$sql1);
                        while($rows=mysqli_fetch_array($result)){
                             $isManager=$rows['isManager'];
                             $school=$rows['school'];
                        }
                        echo "<option value='{$school}'>$school</option>";
                       }
                    ?>
              </select>
        </div>
   </section> 
   <section class="content"  id='content'>
        <div class='search' id='searchwarpper' style='width:100%;'></div>
        <section id='orderNoteWarp' class='alertInput' style='display:none;'>
              <h4>添加订单备注</h4>
              <input type='text' id='orderNote'/>
              <button id='addOrderNote'>添加</button>
        </section>
        <section class='admincontent' id='admincontent'></section>
        <!-- 用户管理 -->
        <section class='userinfo' id='userinfo'>
              <div class='userinfotable' id='userinfotable'>
                  <div id='close' class='close' onclick='closeuserinfo()'>关闭</div>
                  <div class='title'><i class="icon-th-large"></i>用户信息</div>
                  <div class='singleuserhead'>
                      <img  id='singlehead' src="">
                  </div>
                  <div id='personinfo' class='personinfo'>
                    
                  </div>
                  <div id='ident' class='ident'>
                    <div class='title'><i class="icon-th-large"></i>用户认证</div>
                        <img  id='identpic' src=''>
                     <button class='identbtn' id='identbtn'></button>
                    
                     <div class='failident' id='failident'>
                        <select id='wcode'>
                            <option>请选择失败原因</option>
                            <option value='姓名不清'>姓名不清</option>
                            <option value='头像不清'>头像不清</option>
                            <option value='学号不清'>学号不清</option>
                            <option value='证件过期'>证件过期</option>
                            <option value='电话认证失败'>电话认证失败</option>
                            <option value='其他'>其他</option>
                     </select> 
                      <button class='identbtn' id='denybtn'>认证失败</button> 
                     </div>
                         
                  </div>
              </div>
        </section>
        <!-- 集市商品上传 -->
       <!--  <div id='exchangecontent' class='pubcontent' >
            <form action='exchangeupload.php' method='post' enctype="multipart/form-data">
               <div class='col-xs-12'>
                  <label>所属学校</label>
                  <input type='text' name='proschool' id='proschool' placeholder='' value=''/>
            </div>
            <div class='col-xs-12'>
                  <label>商品名称</label>
                  <input type='text' name='proname' placeholder='商品名称'/>
            </div>
            <div class='col-xs-12'>
                <label>商品标签</label>
                <select name='prolabel'>
                    <option>乐享吃喝</option>
                    <option>乐享生活</option>
                    <option>乐享神器</option>
                    <option>乐享音响</option>  
                    <option>乐享座驾</option>
                    <option>乐享书屋</option>
                    <option>乐享人偶</option>
                </select>
            </div>
            <div class='col-xs-12'>
                <label>商品库存</label>
                <input type='text' name='prostore' placeholder='商品库存'/>
            </div>
            <div class='col-xs-12'>
                <label>兑换价格</label>
                <input type='text' name='proprice' placeholder='兑换价格'／>
            </div>
            <div class='col-xs-12'>
             <label>产品简介</label>
            <textarea type='text' name='description' placeholder='产品简介'></textarea>
            </div>

            <div class='col-xs-12'>
                 <label>产品上传</label>
                 <input  type='file' name='propic'/>
            </div> 
            <div class='col-xs-12'>
                <label>发布者</label>
                <input type='text' name='publisher' placeholder='发布者' value='<?php echo $_SESSION['loginuser']?>'／>
            </div>
             <button type='submit' value='发布' class='identbtn'>发布</button>
            </form>
        </div> -->
        <!-- 平台任务发布 -->
         <div id='taskcontent' class='pubcontent' >
            <form action='taskpublish.php' method='post' enctype="multipart/form-data">
              <div class='col-xs-12'>
                  <label>所属学校</label>
                  <input type='text' name='taskschool' id='taskschool' placeholder='' value=''/>
            </div>
            <div class='col-xs-12'>
                  <label>任务标题</label>
                  <input type='text' name='tasktitle' placeholder='任务标题'/>
            </div>
            <div class='col-xs-12'>
                <label>任务悬赏</label>
                <input type='text' name='taskpay' placeholder='每人'/>
            </div>
            <div class='col-xs-12'>
                 <label>任务赞助</label>
                 <input type='text' name='tasksponsor' placeholder='不超过50字'／>
            </div>
            <div class='col-xs-12'>
                <label>任务简介</label>
                <textarea type='text' name='taskintro' placeholder='任务要求不超过100字'></textarea>
            </div>
            <div class='col-xs-12'>
             <label>任务要求</label>
            <textarea type='text' name='taskdemond' placeholder='任务要求不超过100字'></textarea>
            </div>
             <label>任务提示</label>
            <textarea type='text' name='tasktips' placeholder='任务提示不超过50字'></textarea>
           
            <div class='col-xs-12'>
                 <label>任务图片</label>
                 <input  type='file' name='taskpic'/>
            </div>

             <button type='submit' value='发布' class='identbtn' >发布</button>
            </form>
        </div> 
        <!--平台任务详情-->
        <section class='taskinfo' id='taskinfo'>
              <div class='taskinfotable' id='taskinfotable'>
                  <div id='close' class='close' onclick='closetaskinfo()'>关闭</div>
                  <div class='title'><i class="icon-th-large"></i>&nbsp;&nbsp;&nbsp;任务信息</div>
                  <div class='singletaskpic'>
                      <img  id='singletask' src="images/backcc.jpg">
                  </div>
        
                  <div id='singletaskinfo' class='singletaskinfo'>
                        
                  </div>

                  <div class='title'><i class="icon-th-large"></i>&nbsp;&nbsp;&nbsp;任务成果</div>
                  <div id='taskresult' class=''></div>
                  <div class='title'><i class="icon-th-large"></i>&nbsp;&nbsp;&nbsp;任务支持</div>
                  <table id='tasksurport' class=''></table>\
                  <form>
                       <button type='submit' value='' class='identbtn' onclick='sendSurportMsg()'>发送短信</button>
                  </form>
                  
              </div>
        </section>
        <!-- 享豆充值 -->
        <section id='rewardAddContent' class='rewardAddContent'>
            <form action='rewardadmin.php?action=rewardadd' method='post' enctype="multipart/form-data">
            <div class='col-xs-12'>
                  <label>充值用户</label>
                  <input type='text' name='usertelphone' placeholder='用户手机号'  id='userinfoSearch' value=''/>
            </div>
            <div class='col-xs-12 rewardAdduserinfo' id='rewardAdduserinfo' >
                  
            </div>
            <div class='col-xs-12'>
                  <label>充值数量</label>
                  <input type='text' name='price' placeholder='正整数'/>
            </div>
            <div class='col-xs-12'>
                <label>充值说明</label>
                <input type='text' name='detail' placeholder='充值原因描述'/>
            </div>
            <div class='col-xs-12'>
                <label>操作人员</label>
                <input  type='text' name='bywho' value='<?php echo $_SESSION['loginuser']?>'／>
            </div>
             <button type='submit' value='发布' class='identbtn' >确认充值</button>
            </form>
        </section>
       
   </section>
    <script type="text/javascript">
     $('#userinfoSearch').blur(function(){
        var usertel=$(this).val();
        $.ajax({
          type:'post',
          url:'./useraction.php',
          data:{
            action:'singleuser',
            usertelphone:usertel
          },
          success:function(data){
            // alert(data);
            var jsondata=eval('['+data+']');
            var user=jsondata[0];
            var usercontainer=$('#rewardAdduserinfo');
            usercontainer.empty();
            if(user==''){
               html="没有用户信息,请核对手机号码";

            }else{
               html="<table>"+
                      "<tr><td>用户学号</td><td>用户昵称</td><td>用户享豆数</td><td>手机号</td></tr>"+
                      "<tr><td>"+user[0].email+"</td><td>"+user[0].nickname+"</td><td>"+user[0].rewardPoints+"</td><td>"+user[0].telphone+"</td></tr>"+
                  "</table> ";
            }
           
            usercontainer.append(html);     
          }
        });

     })

    //获取所有用户list
function getallusers(){
         school=$('#school').val();
        $('#admincontent').show();
        $('#exchangecontent').hide();
        $('#taskcontent').hide();
        $('#rewardAddContent').hide();
       $('#useradmin').removeClass('unchecked').addClass('checked');
       $('#useradmin').siblings().removeClass('checked').addClass('unchecked');
       $('#searchwarpper').show();
        $('#searchwarpper').empty();
       pagenav="<select id='search' class='usersearch'>"+
                      "<option value='1'>认证中</option>"+
                      "<option value='0'>未认证</option>"+
                    
                      "<option value='2'>已认证</option>"+
                      "<option value='all'>全部</option>"+
              "</select>"+
              "<div id='totalNum' class='totalNum'></div>";
       $('#searchwarpper').append(pagenav);
        fillUser(school,1);
         $('#search').change(function(){
            var type=$(this).val();
            fillUser(school,type);     
       })
       
     
function  fillUser(school,type){
  $('#admincontent').empty();
      $.ajax({
            type:'post',
            url:'./useraction.php',
            data:{
              school:school,
              action:'getallusers',
              type:type
            },
            success:function(data){
              // alert(data);
              var admincontainer=$('#admincontent');
              var jsondata=eval('['+data+']');
              var userlist=jsondata[0];
              totalNumHtml="总共"+userlist.length+"条数据"; 
              $('#totalNum').empty(); 
                $('#totalNum').append(totalNumHtml);

              for(var i=0;i<=userlist.length;i++){
                if(userlist[i].active==0){
                  activetext='未认证';
                }else if(userlist[i].active==1){
                  activetext='认证中';
                }else{
                  activetext='已通过认证';
                }
                html="<div class='singeuser'>"+
                      "<div class='userid'>用户id:"+userlist[i].id+"</div>"+
                      "<div class='userhead'><img src='./uploads/"+userlist[i].head+"'></div>"+
                      "<div class='userident'>"+activetext+"</div>"+
                      "<button class='checkmorebtn' data-uid='"+userlist[i].id+"' onclick='showuserinfo(event)'>查看详情</button>"+
                   "</div>";
                  admincontainer.append(html); 
                          }
               // onsearch();
            }

         })
    }
    //条件搜索
  
     }
     //触发搜索条件
    
    //打开user个人详细信息
    function showuserinfo(event){
      var target=event.target;
      var userid=$(target).attr('data-uid');
      $('#userinfo').show();
      //个人信息
      $.ajax({
        type:'post',
        url:'./useraction.php',
        data:{
          action:'singleuser',
          userid:userid
        },
        success:function(data){
          // alert(data);
          var jsondata=eval('['+data+']');
          var singleuserlist=jsondata[0];

          $('#personinfo').empty();
          $('#singlehead').attr('src','./uploads/'+singleuserlist[0].head);
          $('#identpic').attr('src','./uploads/'+singleuserlist[0].ident); 

          html="<div>昵称："+singleuserlist[0].nickname+"</div>"+
               "<div>享豆："+singleuserlist[0].rewardPoints+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>性别："+singleuserlist[0].sex+"</span></div>"+
               "<div>学号："+singleuserlist[0].email+"</div>"+ 
               "<div>电话："+singleuserlist[0].telphone+"</div>"+
               "<div>签名："+singleuserlist[0].note+"</div>"+
               "<div>注册时间："+localTime(singleuserlist[0].addtime)+"</div>"+
               "<div>等级："+singleuserlist[0].rank+"</div>";
          $('#personinfo').append(html);
          
          if(singleuserlist[0].active==0){
              $('#identbtn').text('未上传证件');
              $('#failident').hide();
            }else if(singleuserlist[0].active==1){
              $('#identbtn').text('通过认证');
               $('#failident').show();
              $('#identbtn').click(function(){
                var con=confirm('确定要通过验证吗？');
                if(con==true){
                  $.ajax({
                    type:'post',
                    url:'./useraction.php',
                    data:{
                      action:'passident',
                      userid:userid
                    },
                    success:function(data){
                      if(data==1){
                        alert('认证通过');
                       document.location.reload()
                      }
                      else{
                        alert('认证失败');
                      }
                    }
                  });
                }
                else{
                  alert('no');
                }
              });

             $('#denybtn').click(function(){
              var wcode=$('#wcode').val();
              $.ajax({
                type:'post',
                url:'./useraction.php',
                data:{
                  action:'failident',
                  wcode:wcode,
                  userid:userid
                },
                success:function(data){
                  if(data==1){
                    alert('短信已发送成功');
                  }else{
                    alert('短信发送失败');
                  }

                }
              })

             });  
            }else{
             $('#identbtn').text('已通过认证');
            }            
        }
      })
    } 

    //关闭
    function closeuserinfo(){
      $('#userinfo').hide();
    }
    function closetaskinfo(){
      $('#taskinfo').hide();
    } 
  //打开物品上传
  function uploadpro(){
    $('#exchangeupload').removeClass('unchecked').addClass('checked');
    $('#exchangeupload').siblings().removeClass('checked').addClass('unchecked');
     $('#searchwarpper').hide();
    $('#admincontent').hide();
    $('#taskcontent').hide();
    $('#rewardAddContent').hide();
    $('#exchangecontent').show();
      school=$('#school').val();
    $('#proschool').val(school);

  } 

  //打开平台任务发布
  function publishTask(){
    $('#taskpublish').removeClass('unchecked').addClass('checked');
    $('#taskpublish').siblings().removeClass('checked').addClass('unchecked');
    $('#searchwarpper').hide();
    $('#admincontent').hide();
    $('#exchangecontent').hide();
    $('#rewardAddContent').hide();
    $('#taskcontent').show();
    school=$('#school').val();
    $('#taskschool').val(school);
  } 

  //获取所有任务列表
  function getallTasks(){
      $('#searchwarpper').show();
      $('#admincontent').show();
      $('#exchangecontent').hide();
      $('#taskcontent').hide();
      $('#rewardAddContent').hide();
      $('#taskmag').removeClass('unchecked').addClass('checked');
      $('#taskmag').siblings().removeClass('checked').addClass('unchecked');
       school=$('#school').val();
     $('#admincontent').empty();
     $('#searchwarpper').empty();

      pagenav="<select id='search' class='usersearch'>"+
                    "<option value='0'>进行中</option>"+
                    "<option value='1'>已完成</option>"+
                    "<option value='all'>全部</option>"+
            "</select>"+
            "<div id='totaltaskNum' class='totalNum'></div>";

      $('#searchwarpper').append(pagenav);
      filltasklist(school,0);  
      $('#search').change(function(){
        var type=$(this).val();
        filltasklist(school,type);
      })   
  function filltasklist(school,type){
      $('#admincontent').empty();
           $.ajax({
                type:'post',
                url:'./gettask.php',
                data:{
                  school:school,
                  action:'adminalltasks',
                  type:type
                },
                success:function(data){
                  // alert(data);
                  var admincontainer=$('#admincontent');
                  var jsondata=eval('['+data+']');
                  var tasklist=jsondata[0];
                  totalNumHtml="总共"+tasklist.length+"条数据";  
                    $('#totaltaskNum').empty();
                    $('#totaltaskNum').append(totalNumHtml);

                  for(var i=0;i<=tasklist.length;i++){
                    if(tasklist[i].status==0){
                      statustext='进行中';
                    }else{
                      statustext='已完成';
                    }
                    html="<div class='singeuser'>"+
                          "<div class='userid'>任务id:"+tasklist[i].tid+"</div>"+
                          "<div class='userid'>#"+tasklist[i].title+"#</div>"+

                          "<div class='taskpic'><img src='./uploads/"+tasklist[i].taskpic+"'/></div>"+
                          "<div class='userident'>"+statustext+"</div>"+
                          "<button class='checkmorebtn' data-tid='"+tasklist[i].tid+"' onclick='showtaskinfo(event)'>查看详情</button>"+
                          "<div class='userid'>已有"+tasklist[i].resultnum+"条成果</div>"+
                       "</div>";
                      admincontainer.append(html); 
                  }
                }

             })
         }
          }

  function showtaskinfo(event){
    var target=event.target;
     taskid=$(target).attr('data-tid'); 
   $('#taskinfo').show();

   gettaskinfo();
   getuserresult();
   getusersurport();


   }
 //获取任务详情
  function gettaskinfo(){
    $.ajax({
       type:'post',
       url:'./gettask.php',
       data:{
          action:'singletask',
          tid:taskid
       },
       success:function(data){
        var jsondata=eval('['+data+']');
        var task=jsondata[0];
        $('#singletask').attr('src','./uploads/'+task[0].taskpic);
        $('#singletaskinfo').empty();

        html="<div><strong>任务标题：</strong>"+task[0].title+"</div>"+
              "<div><strong>任务简介：</strong>"+task[0].taskintro+"</div>"+
              "<div><strong>任务要求：</strong>"+task[0].taskdemond+"</div>"+
              "<div><strong>温馨提示：</strong>"+task[0].tasktips+"</div>"+
              "<div><strong>任务奖励</strong>："+task[0].taskpayper+"享豆/per</div>"+
              "<div><strong>发布时间：</strong>"+localTime(task[0].publishtime)+"</div>"+
              "<div><strong>赞助厂家：</strong>"+task[0].sponsor+"</div>"+
              "<div class='taskfinishbtn'><button  onclick='taskfinish(event)' data-tid='"+task[0].tid+"'>"+task[0].statusactiontext+"</button></div>";

        $('#singletaskinfo').append(html);   
          
       }
     });
   }  
 //获取用户成果 
function getuserresult(){
        $.ajax({
            type:'post',
            url:'./taskaction.php',
            data:{
              action:'getresult',
              tid:taskid
            },
            success:function(data){
              var jsondata=eval('['+data+']');
              var result=jsondata[0];
              $('#taskresult').empty();

              for(var i=0;i<=result.length;i++){
                html=" <div class='singleresult'>"+
                           "<div class='taskuserhead'>"+
                                      "<img src='./uploads/"+result[i].bywhohead+"'/>"+
                            "</div>"+
                            "<div class='taskresultinfo'>"+
                                        "<div>"+result[i].bywhonickname+"<span>"+timeFormat(result[i].sendtime)+"</span></div>"+
                                        "<div><img src='./uploads/"+result[i].result+"'></div>"+
                                        "<p>"+result[i].resultintro+"</p>"+
                            "</div>"+
                            "<div class='taskresultaction'>"+
                                  "<a onclick='resultpass(event)' data-aid='"+result[i].aid+"' data-taskpay='"+result[i].taskpay+"' data-bywho='"+result[i].bywho+"'>"+result[i].statusactiontext+"</a>"+
                            "</div>"+

                    "</div>";
                 $('#taskresult').append(html);   
              }

            }
         })
       } 
//获取用户支持

function getusersurport(){
  $.ajax({
    type:'post',
    url:'./taskaction.php',
    data:{
      action:'getsurport',
      tid:taskid
    },
    success:function(data){
      var jsondata=eval('['+data+']');
      var surport=jsondata[0];
      $('#tasksurport').empty();
      for(var i=0;i<=surport.length;i++){
          html="<tr><td>"+surport[i].bywho+"</td><td>"+surport[i].surport+"</td><td>"+surport[i].bywhotelphone+"</td><td>"+timeFormat(surport[i].sendtime)+"</td></tr>";
          $('#tasksurport').append(html);      
      }
    }
  })
}
//成果通过
function resultpass(event){
        var target=event.target;
        var aid=$(target).attr('data-aid');
        var taskpay=$(target).attr('data-taskpay');
        var bywho=$(target).attr('data-bywho');
        var status=$(target).text();
        if(status=='已通过'){
          return;
        }
        $.ajax({
          type:'post',
          url:'./taskpass.php',
          data:{
            action:'passresult',
            aid:aid,
            taskpay:taskpay,
            bywho:bywho
          },
          success:function(data){
            alert(data);
            getuserresult();
          }

        })
 }

//平台任务完成
function  taskfinish(event){
  var target=event.target;
  var tid=$(target).attr('data-tid');
  var status=$(target).text();
  if(status=='已完成'){
    return;
  }
  $.ajax({
    type:'post',
    url:'./taskpass.php',
    data:{
      action:'taskfinish',
      tid:tid
    },
    success:function(data){
      alert(data);
      gettaskinfo();
    }
  })
}
//时间格式化 ＝？3天前
function timeFormat(time){
          var d=new Date();
          var nowTime=d.getTime();
          var time=time*1000;
          var timeDis=nowTime-time;
          if(timeDis<60000){
            timeDis=Math.floor(timeDis/1000)+'秒前';
            return timeDis;
          }else if(timeDis>60000  && timeDis<=3600000)
          {
            timeDis=Math.floor(timeDis/60000)+'分钟前';
             return timeDis;
          }  else if(timeDis>3600000 && timeDis<=86400000)
          {
            timeDis=Math.floor(timeDis/3600000)+'小时前';
            return timeDis;
          }else if(timeDis>86400000)
          {
            timeDis=Math.floor(timeDis/86400000)+'天前';
           return timeDis;
          }
      }
//本地时间格式化
function  localTime(time){
   localtime=new Date(time*1000);
  return localtime.toLocaleString();
}

//集市商品管理
function  getexprolist(){
      $('#searchwarpper').show();
      $('#admincontent').show();
      $('#exchangecontent').hide();
      $('#taskcontent').hide();
      $('#rewardAddContent').hide();
      $('#exprolist').removeClass('unchecked').addClass('checked');
      $('#exprolist').siblings().removeClass('checked').addClass('unchecked');
       school=$('#school').val();
     $('#admincontent').empty();
     $('#searchwarpper').empty(); 
     pagenav="<select id='search' class='usersearch'>"+
                    "<option value='1'>兑换中</option>"+
                    "<option value='0'>已下架</option>"+
                    "<option value='all'>全部</option>"+
            "</select>"+
            "<div id='totalProNum' class='totalNum'></div>";
     $('#searchwarpper').append(pagenav);
     $('#search').change(function(){
       var type=$(this).val();
       fillexprolist(school,type);
     })

     fillexprolist(school,1);
     function fillexprolist(school,type){
      $('#admincontent').empty();
       html="<table id='contenttable'>"+
                "<tr><th>商品编号</th><th>商品名称</th><th>商品图片</th><th>商品价格</th><th>商品描述</th><th>操作(暂无)</th><th></th></tr>"+
            "</table> "
       $('#admincontent').append(html);

      $.ajax({
         type:'post',
         url:'./getexchangelist.php',
         data:{
          school:school,
          action:'adminpro',
          type:type
        },
        success:function(data){
          alert(data);
           var jsondata=eval('['+data+']');
           var prolist=jsondata[0];
           totalNumHtml="总共"+prolist.length+"条数据";  
             $('#totalProNum').empty();
            $('#totalProNum').append(totalNumHtml);

          for(var i=0; i<=prolist.length; i++){
            if(prolist[i].store==0){
              actiontext='上架';
            }else{
              actiontext='下架';
            }
             html="<tr><td>"+prolist[i].pid+"</td><td>"+prolist[i].name+"</td><td><img src='./uploads/"+prolist[i].pic+"'></td><td>"+prolist[i].price+"</td><td>"+prolist[i].description+"</td><td>"+actiontext+"</td></tr>";
             $('#contenttable').append(html);
          }

        }
      })
     } 
}

//话题管理
function  gettopiclist(){
      $('#searchwarpper').show();
      $('#admincontent').show();
      $('#exchangecontent').hide();
      $('#taskcontent').hide();
      $('#rewardAddContent').hide();
      $('#topiclist').removeClass('unchecked').addClass('checked');
      $('#exprolist').siblings().removeClass('checked').addClass('unchecked');
       school=$('#school').val();
     $('#admincontent').empty();
     $('#searchwarpper').empty(); 
     pagenav="<select id='search' class='usersearch'>"+
                    "<option value='1'>审核中</option>"+
                    "<option value='2'>已通过</option>"+
                    "<option value='0'>未通过</option>"+
                    "<option value='all'>全部</option>"+
            "</select>"+
            "<div id='totalProNum' class='totalNum'></div>";
     $('#searchwarpper').append(pagenav);
     $('#search').change(function(){
       var type=$(this).val();

        console.log(type);
         filltopiclist(school,type);
     })

     filltopiclist(school,1);
     function filltopiclist(school,type){
      $('#admincontent').empty();
       html="<table id='contenttable'>"+
                "<tr><th>话题编号</th><th>话题名称</th><th>话题介绍</th><th>乐享事项</th><th>发布时间</th><th>发起人</th><th>操作</th></tr>"+
            "</table> "
       $('#admincontent').append(html);

      $.ajax({
         type:'post',
         url:'./gettopiclist.php',
         data:{
          school:school,
          action:'admintopic',
          type:type
        },
        success:function(data){
          // alert(data);
           var jsondata=eval('['+data+']');
           var prolist=jsondata[0];
           totalNumHtml="总共"+prolist.length+"条数据";  
             $('#totalProNum').empty();
            $('#totalProNum').append(totalNumHtml);

          for(var i=0; i<=prolist.length; i++){
            if(prolist[i].status==0){
              actiontext1='';
              actiontext2='';
            }
            if(prolist[i].status==1){
              actiontext1='通过';
              actiontext2='驳回';
            }
            if(prolist[i].status==2){
              actiontext1='已通过';
              actiontext2='';
            }
             html="<tr><td>"+prolist[i].tid+"</td><td>"+prolist[i].topictitle+"</td><td>"+prolist[i].topicintro+"</td><td>"+prolist[i].topicnotice+"</td><td>"+prolist[i].publishtime+"</td><td>"+prolist[i].publisher+"</td><td><button class='orderaction' data-tid='"+prolist[i].tid+"' data-user='"+prolist[i].publisher+"' onclick='passTopic(event)'>"+actiontext1+"</button><button class='orderaction' data-tid='"+prolist[i].tid+"' onclick='refuseTopic(event)'>"+actiontext2+"</button></td></tr>";
             $('#contenttable').append(html);
          }

        }
      })
     } 
}
//通过话题
function  passTopic(event){
 var target=event.target;
 var tid=$(target).attr('data-tid');
 var user=$(target).attr('data-user');
    $.ajax({
      type:'post',
      url:'./topicaction.php',
      data:{
        action:'passtopic',
        tid:tid,
        username:user
      },
      success:function(data){
        console.log(data);
        if(data==1){
          alert('通过成功');
          self.location.reload();
        }else{
          alert('通过失败');
        }
      }
    })
}

//驳回话题
function  refuseTopic(event){
 var target=event.target;
 var tid=$(target).attr('data-tid');

    $.ajax({
      type:'post',
      url:'./topicaction.php',
      data:{
        action:'refusetopic',
        tid:tid
      },
      success:function(data){
        console.log(data);
        if(data==1){
          alert('操作成功');
          self.location.reload();
        }else{
          alert('操作失败');
        }
      }
    })
}
//订单管理
function getexorderadmin(){
 
   $('#searchwarpper').show();
      $('#admincontent').show();
      $('#exchangecontent').hide();
      $('#taskcontent').hide();
      $('#rewardAddContent').hide();
      $('#exorderadmin').removeClass('unchecked').addClass('checked');
      $('#exorderadmin').siblings().removeClass('checked').addClass('unchecked');
       school=$('#school').val();
     $('#admincontent').empty();
     $('#searchwarpper').empty(); 
     pagenav="<select id='search' class='usersearch'>"+
                    
                    "<option value='0'>进行中</option>"+
                    "<option value='1'>已完成</option>"+
                    "<option value='all'>全部</option>"+
            "</select>"+
            "<div id='totalOrderNum' class='totalNum'></div>";
     $('#searchwarpper').append(pagenav);
     fillexorderlist(school,0);
     $('#search').change(function(){
       var type=$(this).val();
       fillexorderlist(school,type);
     })
 //获取订单信息    
function fillexorderlist(school,type){
      $('#admincontent').empty();
       html="<table id='contenttable'>"+
                "<tr><th>订单号</th><th>商品名称</th><th>商品图片</th><th>商品价格</th><th>创建人</th><th>创建时间</th><th>收件人</th><th>用户备注</th><th>订单备注</th><th>操作(暂无)</th><th></th></tr>"+
            "</table> "
       $('#admincontent').append(html);

       $.ajax({
        type:'post',
        url:'./getexchangeorder.php',
        data:{
          school:school,
          action:'adminorder',
          type:type
        },
        success:function(data){
          // alert(data);
          var jsondata=eval('['+data+']');
          var orderlist=jsondata[0];
          // addOrderNote();
         //获取总的数据条数 
          totalNumHtml="总共"+orderlist.length+"条数据";  
             $('#totalOrderNum').empty();
            $('#totalOrderNum').append(totalNumHtml);
          for(var i=0;i<=orderlist.length;i++){
            if(orderlist[i].status==1){
              actiontext='finished';
            }else{
              actiontext='添加备注';
            }
            html="<tr><td>"+orderlist[i].onum+"</td><td>"+orderlist[i].proname+"</td><td><img src='./uploads/"+orderlist[i].propic+"'/></td><td>"+orderlist[i].proprice+"</td>"+
            "<td>"+orderlist[i].reciver+"</td><td>"+localTime(orderlist[i].addtime)+"</td><td>"+orderlist[i].recivertel+"</td><td>"+orderlist[i].remark+"</td><td>"+orderlist[i].ordernote+"</td>"+
            "<td><button  class='orderaction' onclick='addOrderNote(event)'  data-onum='"+orderlist[i].onum+"'>"+actiontext+"</button><button class='orderaction' onclick='finishOrder(event)'  data-onum='"+orderlist[i].onum+"'>标记完成</button></td></tr>";
            $('#contenttable').append(html);
          };


        }
       });

  
     }
}
//为订单添加备注
function  addOrderNote(event){
 var target=event.target;
 var orderNum=$(target).attr('data-onum');

  $('#orderNoteWarp').fadeIn();

  $('#addOrderNote').click(function(){

    var orderNote=$('#orderNote').val();
    $.ajax({
      type:'post',
      url:'./orderaction.php',
      data:{
        action:'addnote',
        ordernum:orderNum,
        ordernote:orderNote
      },
      success:function(data){
        if(data==1){
          alert('添加成功');
          $('#orderNoteWarp').fadeOut();
          self.location.reload();
        }else{
          alert('添加失败');
        }
      }
    })
  });
}
//订单完成
function  finishOrder(event){
 var target=event.target;
 var orderNum=$(target).attr('data-onum');
  alert('确定完成？')
    $.ajax({
      type:'post',
      url:'./orderaction.php',
      data:{
        action:'finishorder',
        ordernum:orderNum
      },
      success:function(data){
        if(data==1){
          alert('修改成功');
          self.location.reload();
        }else{
          alert('修改失败');
        }
      }
    })
}
//打开享豆充值
function rewardAdd(){
    $('#rewardAdd').removeClass('unchecked').addClass('checked');
    $('#rewardAdd').siblings().removeClass('checked').addClass('unchecked');
    $('#searchwarpper').hide();
    $('#admincontent').hide();
    $('#exchangecontent').hide();
    $('#taskcontent').hide();
    $('#rewardAddContent').show();
    school=$('#school').val();
    $('#taskschool').val(school);
  } 
    </script>
  </body>
</html>
