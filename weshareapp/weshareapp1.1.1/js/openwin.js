 mui.plusReady(function(){
	  	var  indextab=document.getElementById("indextab");
	  	var  needpublishtab=document.getElementById("needpublishtab");
	  	var  messagetab=document.getElementById("messagetab");
	  	var	 exchangebtn=document.getElementById('exchangebtn');
	  	var  personcentertab=document.getElementById("personcentertab");
	  	var  indexlogo=document.getElementById("logo");
	  	var  closepub=document.getElementById('closepub');
	  	var  myneed=document.getElementById('myneed');
	  	var  myhelped=document.getElementById('myhelped');
	  	var  mefromothers=document.getElementById('mefromothers');
	  	var  mycoltopic=document.getElementById('mycoltopic');
	  	var  mypubpro=document.getElementById('mypubpro');
	  	var  exchangeorder=document.getElementById('exchangeorder');
	  	var  shareorder=document.getElementById('shareorder');
	  	var rewardrecord=document.getElementById('rewardrecord');
	  	var  rewardgiven=document.getElementById('rewardgiven');
	  	var  bestrank=document.getElementById('bestrank');
	  	var  personset=document.getElementById('personset');
	  	if(indexlogo){
	  		indexlogo.addEventListener('tap',openindex);
	  	}
	  	if(indextab){
	  		indextab.addEventListener('tap',openindex);
	  	}
	  	if(needpublishtab){
	  		needpublishtab.addEventListener('tap',openpub);
	  	}
	  	if(messagetab){
	  			messagetab.addEventListener('tap',openmessage);
	  	}
	  	if(personcentertab){
	  		personcentertab.addEventListener('tap',openpersoncenter);
	  	}
	  	if(exchangebtn){
	  		exchangebtn.addEventListener('tap',openexchange);
	  	}
	  	if(myneed){
	  		myneed.addEventListener('tap',toMyneed);
	  	}
	  	if(myhelped){
	  		myhelped.addEventListener('tap',toMyhelped);
	  	}
	  	if(mefromothers){
	  		mefromothers.addEventListener('tap',toMefromothers);
	  	}
	  	if(mycoltopic){
	  		mycoltopic.addEventListener('tap',toMycoltopic);
	  	}
	  	if(mypubpro){
	  		mypubpro.addEventListener('tap',toMypubpro);
	  	}
	  	if(exchangeorder){
	  		exchangeorder.addEventListener('tap',toExchangeorder);
	  	}
	  	if(shareorder){
	  		shareorder.addEventListener('tap',toShareorder);
	  	}
	  	if(rewardrecord){
	  		rewardrecord.addEventListener('tap',toRewardrecord);
	  	}
	    if(rewardgiven){
	  		rewardgiven.addEventListener('tap',toRewardgiven);
	  	}
	   if(bestrank){
	   		bestrank.addEventListener('tap',toBestrank);
	    	}
	    	if(personset){
	    		personset.addEventListener('tap',toPersonset);
	    	}
	  	
	  })



function openindex(){
	mui.openWindow({
		url:'../wepublic/index.html',
		id:'index',
		createNew:true,
		show:{
			aniShow: 'slide-in-left',
			duration:300
		}
	})
}


function openmessage(){
	mui.openWindow({
		url:'../wepublic/message.html',
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
		url:'../wepublic/personcenter.html',
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

function openexchange(){
	mui.openWindow({
		url:'../weexchange/exchange.html',
		id:'exchange',
		createNew:true,
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}

//打开发布
  function openpub(){
		  	  html="<div class='pubwrapper' id='pubwarpper'><div class='pubchoose'><ul class='mui-table-view'>"+
						"<li class='mui-table-view-cell'><a href='../weneed/needpublish.html' class='back1'>心愿发布</a></li>"+
						"<li class='mui-table-view-cell'><a href='../wetopic/topicpublish.html' class='back2'>话题发起</a></li>"+
						"<li class='mui-table-view-cell'><a href='../weexchange/uploadpro.html' class='back3'>宝贝发布</a></li>"+
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

//打开morefunction
//function openmore(){
//		  	  html="<div class='pubwrapper' id='pubwarpper'><div class='pubchoose'><ul class='mui-table-view'>"+
//						"<li class='mui-table-view-cell'><a href='weexchange/exchange.html' class='back1'>乐享集市</a></li>"+
//						"<li class='mui-table-view-cell'><a href='wepersoncenter/bestusers.html' class='back2'>天使排行</a></li>"+
//						
//						"</ul>"+
//			    "<ul class='mui-table-view' style='margin-top: 10px;'>"+
//					"<li  id='closepub' onclick='closemore();'class='mui-table-view-cell'><a><b>取消</b></a></li>"+
//			    "</ul></div></div>";
//		         var body=document.getElementById('body');
//		    body.insertAdjacentHTML('afterBegin',html);   
//		  }
////关闭morefunction
//function closemore(){
//	  var warpper=document.getElementById('pubwarpper');
//		document.body.removeChild(warpper);
//	  
//}
  
//tomyneed
function toMyneed(){
	 mui.openWindow({
		url:'../wepersoncenter/myneed.html',
		id:'myneed',
		createNew:true,
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}
function toMyhelped(){
	 mui.openWindow({
		url:'../wepersoncenter/myhelped.html',
		id:'myhelped',
		createNew:true,
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}

function toMefromothers(){
	 mui.openWindow({
		url:'../wepersoncenter/mefromothers.html',
		id:'meformothers',
		createNew:true,
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}

function toMycoltopic(){
	 mui.openWindow({
		url:'../wepersoncenter/mycoltopic.html',
		id:'mycoltopic',
		createNew:true,
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}

function toMypubpro(){
	 mui.openWindow({
		url:'../wepersoncenter/mypubpro.html',
		id:'mypubpro',
		createNew:true,
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}


function toExchangeorder(){
	 mui.openWindow({
		url:'../wepersoncenter/myexchangeorder.html',
		id:'exchangeorder',
		createNew:true,
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}

function toShareorder(){
	 mui.openWindow({
		url:'../wepersoncenter/myshareorder.html',
		id:'shareorder',
		createNew:true,
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}


function toRewardrecord(){
	 mui.openWindow({
		url:'../wepersoncenter/rewardrecord.html',
		id:'rewardrecord',
		createNew:true,
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}

function toRewardgiven(){
	 mui.openWindow({
		url:'../wepersoncenter/rewardgiven.html',
		id:'rewardgiven',
		createNew:true,
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}

function toBestrank(){
	 mui.openWindow({
		url:'../wepersoncenter/bestusers.html',
		id:'bestusers',
		createNew:true,
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}



function toPersonset(){
	 mui.openWindow({
		url:'../wepersoncenter/personset.html',
		id:'personset',
		createNew:true,
		show:{
			aniShow: 'slide-in-right',
			duration:300
		}
	})
}