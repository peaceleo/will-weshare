//获取单个需求
//function getSingelNeed (needid) {
//	server=plus.storage.getItem('server');
//	 mui.ajax(server+'need/getneedlist.php',{
//			      			data:{
//			      				action:'singleneed',
//			      				needid:needid
//			      			},
//			      			type:'post',
//			      			success:function(data){
//			      				
//			      				var singleneed=document.getElementById('singleneed');
//			      				var jsondata=eval("["+data+"]");
//			      				var needlist=jsondata[0];
//			                    var publishtime=timeFormat(needlist[0].publishtime);
//			      				 html="<div class='needcontainer'>"+
//								  	   	    
//								  	   	    "<div class='userhead'><img src='"+server+"uploads/"+needlist[0].head+"'/><div class='needid'>"+needlist[0].id+"</div></div>"+
//								  	   	    "<div class='needlistlabel'>#"+needlist[0].label+"#</div>"+
//								  	   	    "<div class='needstatus'>"+needlist[0].status+"</div>"+
//								  	   	    "<div class='needcontent'>"+needlist[0].remark+"</div>"+
//								  	   	    	"<div class='needpay'>"+needlist[0].needpay+"享豆</div>"+
//								  	   	   
//								  	   	    "<div class='needlocation'>"+needlist[0].needlocation+"</div>"+
//								  	   	    "<div class='needlisttime'>"+publishtime+"</div>"+
//						
//								  	   		"<div class='needhelp' data-id='"+needlist[0].id+"' data-user='"+needlist[0].user+"'>帮忙("+needlist[0].msgNum+")</div>"+
//								  	   		"<div class='needcomment' data-id='"+needlist[0].id+"' data-user='"+needlist[0].user+"'>评论("+needlist[0].cmtNum+")</div>"+
//								  	   	    "<div class='needcall'><a href='tel:"+needlist[0].usertel+"'>电话</a></div>"+
//								  	   "</div> ";
//								  singleneed.innerHTML=html;	   
//			      			}
//					})
//}
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
	 		mui.ajax(server+'reminder/getreminderlist.php',{
	 			data:{
	 				action:'uncheckedreminder',
	 				username:username
	 			},
	 			type:'post',
	 			success:function(data){
//	 				 console.log(data);
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
						
	 				  }
	 			
	 		})
	 	}
   //quit the app   		
      		function  quitapp(){
      		 plus.key.removeEventListener('backbutton',mui.back);
	         plus.key.addEventListener('backbutton',function(){
      			plus.ui.confirm("您要离博仕而去吗?",function(e){
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
		server=plus.storage.getItem('server');
      		 mui.ajax(server+'user/personaction.php',{
      			data:{
      				username:username
      			},
      			type:'post',
      			success:function(data){
//    				alert(data);
      				var datajson=eval("["+data+"]");
      				userinfo=datajson[0];
      			   	plus.storage.setItem('username',userinfo[0].username);
      				plus.storage.setItem('rewardpoints',userinfo[0].rewardpoints);
      				plus.storage.setItem('active',userinfo[0].active);
			 		plus.storage.setItem('userpic',userinfo[0].head);
			 		plus.storage.setItem('nickname',userinfo[0].nickname);
			 		plus.storage.setItem('usernote',userinfo[0].note);
			 		
			 		plus.storage.setItem('rank',userinfo[0].rankname);
			 		plus.storage.setItem('telphone',userinfo[0].telphone);
			 		plus.storage.setItem('sex',userinfo[0].sex);
			 		document.getElementById("userpic").setAttribute('src',server+'uploads/'+userinfo[0].head);
					if(plus.storage.getItem('sex')=='男'){
						document.getElementById('male').style.display='block';
						document.getElementById('female').style.display='none';
					}else{
						document.getElementById('male').style.display='none';
						document.getElementById('female').style.display='block';
					}
					document.getElementById("nicknameself").innerText=userinfo[0].nickname;
					document.getElementById("reward").innerText=userinfo[0].rewardpoints;
					document.getElementById("userrank").innerText=userinfo[0].rankname;
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

//运动
//分享赠享豆
function  rewardGiven(towho,price,detail){
	mui.ajax(server+'rewardaction.php',{
		data:{
			action:'shareAdd',
			towho:towho,
			price:price,
			detail:detail
		},
		type:'post',
		success:function(data){
			console.log(data);
		}
	})
}
//充置图片大小
  function resizeImg(image,max_width,max_height){
		 	var Ratio=1;
		 	var w=image.width;
		 	var h= image.height;

		 	var wRatio=max_width /w;
		 	var hRatio=max_height/h;
		 	//判断
		 	if(max_width==0 && max_height==0){
		 		Ratio=1;
		 	}else if(max_width==0){
		 		if(hRatio<1) Ratio=hRatio;
		 	}else if(max_height==0){
		 		if(wRatio<1) Ratio=wRatio;
		 	}else if(wRatio<1 && hRatio<1){
		 		Ratio= (wRatio<=hRatio)?wRatio:hRatio;
		 	}

		 	w =w * Ratio;
		 	h =h * Ratio;
		 	image.width=w;
		 	image.height=h;
		 } 