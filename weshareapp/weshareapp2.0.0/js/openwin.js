 
 
 
 
 mui.plusReady(function(){
	  	var  indextab=document.getElementById("indextab");
	  	var  needpublishtab=document.getElementById("needpublishtab");
	  	var  messagetab=document.getElementById("messagetab");
	  	var  personcentertab=document.getElementById("personcentertab");
	  	var  logout=document.getElementById("logout");
	  	var  indexlogo=document.getElementById("logo");
	  	var  exchangemall=document.getElementById("exchangeMall");
	  	indexlogo.addEventListener('tap',openindex);
	  	indextab.addEventListener('tap',openindex);
	  	needpublishtab.addEventListener('tap',openneedpublish);
	  	messagetab.addEventListener('tap',openmessage);
	  	personcentertab.addEventListener('tap',openpersoncenter);
	  	logout.addEventListener('tap',openlogout);
	  	exchangemall.addEventListener('tap',openexchangemall);
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
	plus.storage.removeItem('username');
	plus.storage.removeItem('password');
	plus.storage.removeItem('rewardpoints');
	plus.storage.removeItem('active');
	plus.storage.removeItem('userpic');
	plus.storage.removeItem('nickname');
	plus.storage.removeItem('usernote');
	plus.storage.removeItem('school');
	plus.storage.removeItem('lastlogintime');
	plus.storage.removeItem('logintime');
	plus.storage.removeItem('newneednum');
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
