//获取单个需求
function getSingelNeed (needid) {
	server=plus.storage.getItem('server');
	 mui.ajax(server+'/getneedlist.php',{
			      			data:{
			      				action:'singleneed',
			      				needid:needid
			      			},
			      			type:'post',
			      			success:function(data){
			      				var singleneed=document.getElementById('singleneed');
			      				var jsondata=eval("["+data+"]");
			      				var needlist=jsondata[0];
			                    var publishtime=timeFormat(needlist[0].publishtime);
			      				 html="<div class='needcontainer'>"+
								  	   	    
								  	   	    "<div class='userhead'><img src='"+server+"uploads/"+needlist[0].head+"'/><div class='needid'>"+needlist[0].id+"</div></div>"+
								  	   	    "<div class='needlistlabel'>#"+needlist[0].label+"#</div>"+
								  	   	    "<div class='needstatus'>"+needlist[0].status+"</div>"+
								  	   	    "<div class='needcontent'>"+needlist[0].remark+"</div>"+
								  	   	    	"<div class='needpay'>"+needlist[0].needpay+"享豆</div>"+
								  	   	   
								  	   	    "<div class='needlocation'>"+needlist[0].needlocation+"</div>"+
								  	   	    "<div class='needlisttime'>"+publishtime+"</div>"+
						
								  	   		"<div class='needhelp' data-id='"+needlist[0].id+"' data-user='"+needlist[0].user+"'>帮忙("+needlist[0].msgNum+")</div>"+
								  	   		"<div class='needcomment' data-id='"+needlist[0].id+"' data-user='"+needlist[0].user+"'>评论("+needlist[0].cmtNum+")</div>"+
								  	   	    "<div class='needcall'><a href='tel:"+needlist[0].usertel+"'>电话</a></div>"+
								  	   "</div> ";
								  singleneed.innerHTML=html;	   
			      			}
					})
}
//获取个人中心单个需求
function getcheckSingelNeed (needid) {
		server=plus.storage.getItem('server');
	 mui.ajax(server+'getneedlist.php',{
			      			data:{
			      				action:'singleneed',
			      				needid:needid
			      			},
			      			type:'post',
			      			success:function(data){
			      				var singleneed=document.getElementById('singleneed');
			      				var jsondata=eval("["+data+"]");
			      				var needlist=jsondata[0];
			                    var publishtime=timeFormat(needlist[0].publishtime);
			      				 html="<div class='needcontainer'>"+
								  	   	    "<div class='userhead'><img src='"+server+"uploads/"+needlist[0].head+"'/><div class='needid'>"+needlist[0].id+"</div></div>"+
								  	   	     "<div class='needlistlabel'>#"+needlist[0].label+"#</div>"+
								  	   	    "<div class='perneedaction' data-id='"+needlist[0].id+"'data-user='"+needlist[0].user+"'>"+needlist[0].status+"</div>"+
							
								  	   	    "<div class='needcontent'>"+needlist[0].remark+"</div>"+
								  	   	    	"<div class='needpay'>"+needlist[0].needpay+"享豆</div>"+
								  	   	   
								  	   	    "<div class='needlocation'>"+needlist[0].needlocation+"</div>"+
								  	   	    "<div class='needlisttime'>"+publishtime+"</div>"+
								  	   		
								  	   		"<div class='perneedhelp' data-id='"+needlist[0].id+"' data-user='"+needlist[0].user+"'>帮忙("+needlist[0].msgNum+")</div>"+
								  	   		"<div class='perneedcomment' data-id='"+needlist[0].id+"' data-user='"+needlist[0].user+"'>评论("+needlist[0].cmtNum+")</div>"+
								  	   "</div> ";
								  singleneed.innerHTML=html;	   
			      			}
					})
}
//时间格式化
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
//转化为本地时间
 function getLocalTime(nS) {     
       return new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");      
    } 

//发表新评论
     	 function sendComment(needid,bywhostu,towho,needcomment){
     	 	 helpsendbtn.addEventListener('tap',function(){
     	 	 var needcomment=document.getElementById("helpvalue").value;
     	 	 	server=plus.storage.getItem('server');
     	  	mui.ajax(server+'needcomment.php',{
				data:{
					needid:needid,
					bywho:bywhostu,
					towho:towho,
					needcomment:needcomment
				},
				type:'post',
				success:function(data){
					if(data=1){
						plus.ui.toast('发送成功');
						window.location.reload();
					}else{
					plus.ui.toast('好像失败了');
				}
			}
     	  })
     	  })    	 	   	
     	 }
   //回复评论
     	 function sendbackComment(needid,bywhostu,towho,needcomment){
     	 	 helpsendbtn.addEventListener('tap',function(){
     	 	 var needcomment=document.getElementById("helpvalue").value;
     	 	 	server=plus.storage.getItem('server');
     	  	mui.ajax(server+'needcomment.php',{
				data:{
					needid:needid,
					bywho:bywhostu,
					towho:towho,
					needcomment:needcomment
				},
				type:'post',
				success:function(data){
					if(data=1){
						plus.ui.toast('发送成功');
						window.location.reload();
					}else{
					plus.ui.toast('好像失败了');
				}
			}
     	  })
     	  })    	 	   	
     	 }
  //得到消息提醒数目，并显示在消息tab
  function getremindernum(username){
  		server=plus.storage.getItem('server');
	 		mui.ajax(server+'getreminderlist.php',{
	 			data:{
	 				action:'uncheckedreminder',
	 				username:username
	 			},
	 			type:'post',
	 			success:function(data){
	 				  var remindercontainer=document.getElementById("messagewarp");
	 				  var jsondata=eval("["+data+"]");
	 				  var reminderlist=jsondata[0];
	 				  var num=reminderlist.length;
	 				  var numshowcontainer=document.getElementById("remindnum");
	 				  if(num==0){
	 				  	  numshowcontainer.style.display='none';
	 				  }
	 				  else{
	 				  		numshowcontainer.style.display='block';
	 				  	    numshowcontainer.innerText=num;
	 				  }
							
////   				  var status=document.getElementById('badge').getAttribute('data-status');
//   					if(status==0){
//   						document.getElementById('badge').style.display='block';
//   					}
//   					else{
//   						document.getElementById('badge').style.display='none';
//   					}
	 				  }
	 			
	 		})
	 	}
   //quit the app   		
      		function  quitapp(){
      		 plus.key.removeEventListener('backbutton',mui.back);
	         plus.key.addEventListener('backbutton',function(){
      			plus.ui.confirm("您要离小乐而去吗?",function(e){
      				if(e.index==0){
      				plus.ui.toast('被人需要是一种幸福');
      				plus.runtime.quit();
                  }else {
                  	plus.ui.toast('再逛逛呗');
                  }
      			},"",["Yes","No"]);
      		})
      		}
//获取用户信息重要信息 	 
	function getpersoninfo(username){
		
      			mui.ajax(server+'personaction.php',{
      			data:{
      				username:username
      			},
      			type:'post',
      			success:function(data){
      				var userinfoContent=document.getElementById("userinfo");
      				var datajson=eval("["+data+"]");
      				userinfo=datajson[0];
      			   	newneednum="\'"+userinfo[0].newneednum+"\'";
      				plus.storage.setItem('rewardpoints',userinfo[0].rewardpoints);
      				plus.storage.setItem('active',userinfo[0].active);
			 		plus.storage.setItem('userpic',userinfo[0].head);
			 		plus.storage.setItem('nickname',userinfo[0].nickname);
			 		plus.storage.setItem('usernote',userinfo[0].note);
			 		plus.storage.setItem('school',userinfo[0].school);
			 		plus.storage.setItem('newneednum',newneednum);
			 		plus.storage.setItem('rank',userinfo[0].rankname);
			 		plus.storage.setItem('telphone',userinfo[0].telphone);
			 		plus.storage.setItem('sex',userinfo[0].sex);

      			}
      		})
      	}
//获取用户客户端clienid and token
function  getClientDeviceInfo(username){
	var info=plus.push.getClientInfo();
	var clientid=info.clientid;
	var token=info.token;
	var appid=info.appid;
	mui.ajax(server+'clientDeviceinfo.php',{
		data:{
			username:username,
			clientid:clientid,
			token:token,
			appid:appid
		},
		type:post,
		success:function(data){
			console.log(data);
		}
	})
}
