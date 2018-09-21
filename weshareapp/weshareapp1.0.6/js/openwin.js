 mui.plusReady(function(){
	  	var  indextab=document.getElementById("indextab");
	  	var  needpublishtab=document.getElementById("needpublishtab");
	  	var  messagetab=document.getElementById("messagetab");
	  	var  personcentertab=document.getElementById("personcentertab");
	  	var  logout=document.getElementById("logout");
	  	var  indexlogo=document.getElementById("logo");
	  	var  exchangemall=document.getElementById("exchangeMall");
	  	var 	 onekeyAsk=document.getElementById('onekeyAsk');
	  	var  bookstore=document.getElementById('bookstore');
	  	var  ridestore=document.getElementById('ridestore');
	  	var  closepub=document.getElementById('closepub');
	  	var  toneedlist=document.getElementById('needlist');
	  	var  totask=document.getElementById('task');
	  	var  totopic=document.getElementById('topic');
	  	indexlogo.addEventListener('tap',openindex);
	  	indextab.addEventListener('tap',openindex);
	  	needpublishtab.addEventListener('tap',openpub);
	  	messagetab.addEventListener('tap',openmessage);
	  	personcentertab.addEventListener('tap',openpersoncenter);
	  	logout.addEventListener('tap',openlogout);
	  	exchangemall.addEventListener('tap',openexchangemall);
//	  	onekeyAsk.addEventListener('tap',openOneKeyAsk);
	  	bookstore.addEventListener('tap',openBookStore);
	  	ridestore.addEventListener('tap',openRideStore);
	  	closepub.addEventListener('tap',closepub);
	  	toneedlist.addEventListener('tap',toneedlist);
	  	totask.addEventListener('tap',totask);
	  	totopic.addEventListener('tap',totopic);
	  })



function openindex(){
	mui.openWindow({
		url:'index.html',
		id:'index',
		createNew:true,
		show:{
			aniShow: 'slide-in-left',
			duration:300
		}
	})
}

function openneedpublish(){
	mui.openWindow({
		url:'needpublish.html',
		id:'needpublish',
		createNew:true,
		show:{
			aniShow: 'slide-in-left',
			duration:300
		}
	})
}

function openmessage(){
	mui.openWindow({
		url:'message.html',
		id:'message',
		createNew:true,
		show:{
			aniShow:'slide-in-right',
			duration:300
		}
	})
}

function openpersoncenter(){
	mui.openWindow({
		url:'personcenter.html',
		id:'personcenter',
		createNew:true,
		extras:{
			type:'need'	
		},
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}

function openlogout(){
	plus.storage.clear();
	mui.openWindow({
		url:'login.html',
		id:'login',
		createNew:true,
		show:{
			aniShow:'slide-in-left',
			duration:300
		}
	})
}

function openexchangemall(){
	mui.openWindow({
		url:'exchangemall.html',
		id:'exchangemall',
		show:{
			aniShow:'slide-in-right',
			duration:300
		}
	})
}


function openOneKeyAsk(){
	console.log('onekeyaskfor');
	mui.openWindow({
		url:'onekeyask.html',
		id:'onekeyask'
	})
}


function openBookStore(){
	mui.openWindow({
		url:'bookstore.html',
		id:'bookstore',
		show:{
			aniShow:'slide-in-right',
			duration:300
		}
	})
}

function openRideStore(){
	mui.openWindow({
		url:'ridestore.html',
		id:'ridestore',
		show:{
			aniShow:'slide-in-right',
			duration:300
		}
	})
}

//打开发布
  function openpub(){
		  	  html="<div class='pubwrapper' id='pubwarpper'><div class='pubchoose'><ul class='mui-table-view'>"+
						"<li class='mui-table-view-cell'><a href='needpublish.html' class='back1'>心愿发布</a></li>"+
						"<li class='mui-table-view-cell'><a href='topicpublish.html' class='back2'>话题发起</a></li>"+
						"<li class='mui-table-view-cell'><a href='uploadpro.html' class='back3'>宝贝发布</a></li>"+
						"</ul>"+
			    "<ul class='mui-table-view' style='margin-top: 10px;'>"+
					"<li  id='closepub' onclick='closepub();'class='mui-table-view-cell'><a><b>取消</b></a></li>"+
			    "</ul></div></div>";
		         var body=document.getElementById('body');
		    body.insertAdjacentHTML('afterBegin',html);   
		  }
  //关闭发布
  function closepub(){
  	  var warpper=document.getElementById('pubwarpper');
		document.body.removeChild(warpper);
  	  
  }

