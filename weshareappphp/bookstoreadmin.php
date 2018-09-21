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
      // getallusers();
      // $('#userinfo').hide();
      // $('#taskinfo').hide();
      // $('#failident').hide();
      // $('#exchangecontent').hide();
      // $('#taskcontent').hide();
      // $('#rewardAddContent').hide();
      // $('#school').change(function(){
      //   getallusers(); 

      // });
    reOrderAction();
       $('#uploadbookcontent').hide();
       // $('#searchwarpper').hide();
       $('#orderNoteWarp').hide();

    })
    </script>    
</head>
   <body>
    <section class='adminlist'>
        <div id='bookreorderadmin' class='adminnav' onclick='reOrderAction()'>回收订单管理</div>
        <div id='bookadmin' class='adminnav' onclick='bookAdmin()'>书籍管理</div>
        <div id='exchangeupload'  class='adminnav' onclick='uploadBook()'>书籍上传</div>
        
         <div class='adminnav' style='float:right;'><a href='adminuseraction.php?action=adminlogout'>注销</a></div>
         <div class='adminnav' style='float:right;'><a href='weshareadmin.php'>回到主页</a></div>
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
   <!-- 回收订单管理 -->
   <section class='content' id='content'>
       <div class='search' id='searchwarpper' style='width:100%'></div>
       <section id='orderNoteWarp' class='alertInput'>
          <h4>添加订单备注</h4>
          <input type='text' id='orderNote'/>
          <button id='addordernote'>添加</button>
       </section>
       <section class='admincontent' id='admincontent'></section>
   </section>
     <!--上传书籍-->
     <section id='uploadbookcontent' class='pubcontent' >
            <form action='bookstoreupload.php' method='post' enctype="multipart/form-data">
               <div class='col-xs-12'>
                  <label>所属学校</label>
                  <input type='text' name='school' id='proschool' placeholder='' value=''/>
            </div>
            <div class='col-xs-12'>
                  <label>所属院系</label>
                   <select name='department'>
                   <?php 
                           $sql="select * from department";
                            $res=mysqli_query($link,$sql);
                            $data=array();
                            while ($r=mysqli_fetch_array($res)) {
                                 $department=$r['departmentName'];
                                 array_push($data,$department);
                            }

                             foreach ($data as $department=> $v) {
                             echo "<option value='{$v}'>$v</option>";

                           }
                    ?>
                </select>
            </div>
            <div class='col-xs-12'>
                <label>课程名称</label>
                <input type='text' name='coursename' placeholder='课程名称'/>
            </div>
              <div class='col-xs-12'>
                  <label>授课老师</label>
                  <input type='text' name='teachername' placeholder='授课老师'/>
            </div>
            <div class='col-xs-12'>
                <label>课本名称</label>
                <input type='text' name='bookname' placeholder='课本名称'/>
            </div>
             <div class='col-xs-12'>
                <label>课本库存</label>
                <input type='text' name='bookstore' placeholder='课本库存'/>
            </div>
            <div class='col-xs-12'>
                <label>新书价格</label>
                <input type='text' name='bookprice' placeholder='新书价格'／>
            </div>
             <div class='col-xs-12'>
                <label>兑换价格</label>
                <input type='text' name='exprice' placeholder='兑换价格'／>
            </div>
             <div class='col-xs-12'>
                <label>回收价格</label>
                <input type='text' name='reprice' placeholder='回收价格'／>
            </div>
            <div class='col-xs-12'>
             <label>书籍简介</label>
            <textarea type='text' name='description' placeholder='书籍简介'></textarea>
            </div>

            <div class='col-xs-12'>
                 <label>图片上传</label>
                 <input  type='file' name='bookpic'/>
            </div> 
            <div class='col-xs-12'>
                <label>发布者</label>
                <input type='text' name='publisher' placeholder='发布者' value='<?php echo $_SESSION['loginuser']?>'／>
            </div>
             <button type='submit' value='发布' class='identbtn'>发布</button>
            </form>
        </section>
    <script type="text/javascript">
    //打开书籍上传

    function uploadBook(){
      $('#exchangeupload').removeClass('unchecked').addClass('checked');
      $('#exchangeupload').siblings().removeClass('checked').addClass('unchecked');
      $('#uploadbookcontent').show();
      school=$('#school').val();
    $('#proschool').val(school);
    $('#content').hide(); 
    }
    //回收订单管理
    function reOrderAction(){
      $('#content').show(); 
      $('#bookreorderadmin').removeClass('unchecked').addClass('checked');
      $('#bookreorderadmin').siblings().removeClass('checked').addClass('unchecked');
      $('#uploadbookcontent').hide();
      $('#searchwarpper').show(); 
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

    
   

      function fillexorderlist(school,type){
                $('#admincontent').empty();
                 html="<table id='contenttable'>"+
                          "<tr><th>订单号</th><th>图书名称</th><th>图书图片</th><th>回收价格</th><th>创建人</th><th>创建时间</th><th>联系方式</th><th>用户备注</th><th>订单备注</th><th>操作(暂无)</th><th></th></tr>"+
                      "</table> "
                 $('#admincontent').append(html);

                 $.ajax({
                  type:'post',
                  url:'./getbookreorder.php',
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
                      "<td>"+orderlist[i].bywho+"</td><td>"+localTime(orderlist[i].addtime)+"</td><td>"+orderlist[i].bywhotel+"</td><td>"+orderlist[i].remark+"</td><td>"+orderlist[i].ordernote+"</td>"+
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

  $('#addordernote').click(function(){

    var orderNote=$('#orderNote').val();
    $.ajax({
      type:'post',
      url:'./orderaction.php',
      data:{
        action:'addbookrenote',
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
        action:'finishbookreorder',
        ordernum:orderNum
      },
      success:function(data){
        // alert(data);
        if(data==1){
          alert('修改成功');
          self.location.reload();
        }else{
          alert('修改失败');
        }
      }
    })
} 
 //书籍管理
function  bookAdmin(){
      $('#uploadbookcontent').hide();
      $('#content').show(); 
      $('#bookadmin').removeClass('unchecked').addClass('checked');
      $('#bookadmin').siblings().removeClass('checked').addClass('unchecked');
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
         url:'./getcoursebooklist.php',
         data:{
          school:school,
          action:'bookadmin',
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
            if(prolist[i].store==0){
              actiontext='上架';
            }else{
              actiontext='下架';
            }
             html="<tr><td>"+prolist[i].bid+"</td><td>"+prolist[i].coursename+"</td><td><img src='./uploads/"+prolist[i].pic+"'></td><td>"+prolist[i].exprice+"</td><td>"+prolist[i].description+"</td><td>"+actiontext+"</td></tr>";
             $('#contenttable').append(html);
          }

        }
      })
     } 
}


    //本地时间格式化
function  localTime(time){
   localtime=new Date(time*1000);
  return localtime.toLocaleString();
}
    </script>
  </body>
</html>
