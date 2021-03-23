<?php
//此檔案 使用 include 放在需要做 FB 互動的頁面當中 放在 </body> 之前 且確定在此檔案前已先載入 jquery

?>
<script>
//暫存 facebook 回傳資料
var myfb = new Object();
myfb.login = false; //登入的狀態
/* myfb.meinfo = fb response object; 個資範例
id : 609209429
name : Kuo Tun Huang
first_name : Kuo
middle_name : Tun
last_name : Huang
link : https://www.facebook.com/ojelly
username : ojelly
birthday : 01/15/1982
hometown : [object Object]
location : [object Object]
bio : 立志天天打嘴砲畫虎蘭
sports : [object Object]
gender : male
email : jelly@ojelly.com
timezone : 8
locale : zh_TW
verified : true
updated_time : 2011-12-14T07:48:04+0000

pic : https://graph.facebook.com/' + myfb.meinfo.id + '/picture
*/
myfb.pageid = "<?=$fb_fans_id;?>"; //設定準備要查的 fans page id

$(function(){
	window.fbAsyncInit = function() {
		//FB init 載入
		FB.init({
			appId: '<?=$fb_api_id;?>'
			 //, cookie: false 
			// , logging: true 
			 //, status: true 
			 , xfbml: true 
			// , channelUrl: null 
			 //, authResponse: true 
			 , oauth: true 
			// , frictionlessRequests: false 
		});
		FB.getLoginStatus(function(response) {
			if (response.authResponse) {
				//若 FB 為已登入的狀態 做自動登入處理
				jelly_save_fb('auto' , response);
			} else {
				// no user session available, someone you dont know
			}
		});
		//其它可處理的事件狀態
		//auth.login , auth.authResponseChange , auth.statusChange
		//FB.Event.subscribe('auth.statusChange', function名);
		
		//pagefans的處理
		FB.Event.subscribe('edge.create',
			function(response) {
				//當事件發生後再查一次 page fans
				jelly_checkfanspage(myfb.pageid);
			}
		);
	};
	(function() {
		var e = document.createElement('script'); e.async = true;
		e.src = document.location.protocol + '//connect.facebook.net/zh_TW/all.js';
		$("body").append("<div id='fb-root'></div>");
		document.getElementById('fb-root').appendChild(e);
	}());
	
	/* 標準的是下面 , 但好像不用也沒差
	like plus , https://developers.facebook.com/docs/reference/plugins/like/
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1&appId=179509092107210";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	<div class="fb-like" data-href="http://www.urbonus.com/event-detail.php?id=18&amp;page=1" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
	
	Comments plus , https://developers.facebook.com/docs/reference/plugins/comments/
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1&appId=179509092107210";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	<div class="fb-comments" data-href="http://www.urbonus.com/event-detail.php?id=18&amp;page=1" data-num-posts="5" data-width="500"></div>
	*/
});
//頁面需要 fb 登入時統一觸發這個 function 不要直接使用 FB.login() 避免又被 facebook 惡搞
function jelly_fb_login(){
	//設定需要權限 於此查看 https://developers.facebook.com/docs/reference/api/permissions/
	var needpower = "user_about_me,user_likes,user_activities,user_birthday,user_events,user_location,user_online_presence,user_photos,user_status,user_videos,email,read_friendlists,publish_stream,publish_checkins,read_stream";
	FB.login(function(response) {
		if (response.authResponse) {
			jelly_save_fb('click' , response);
		} else {
			jelly_cancel_fb(response);
		}
	}, {scope:needpower});
}
//頁面需要 fb 登出時統一觸發這個 function 不要直接使用 FB.logout() 避免又被 facebook 惡搞
function jelly_fb_logout(){
	FB.logout(function(response) {
		jelly_logout_fb_aft();
	});
}


//全站 FB 已登入時的統一動作
function jelly_login_fb_aft(){
	//for(key in myfb.meinfo){ $("#testfb").append("<li>"+key+" : "+myfb.meinfo[key]+"</li>"); }
	//後續處理
	try{ login_fb_custom(); }catch(err){ jelly_login_fb_def(); }
}
//全站 FB 已登入狀態時的自動統一動作
function jelly_autologin_fb_aft(){
	//for(key in myfb.meinfo){ $("#testfb").append("<li>"+key+" : "+myfb.meinfo[key]+"</li>"); }
	//後續處理
	try{ autologin_fb_custom(); }catch(err){ jelly_autologin_fb_def(); }
}
//全站 FB 已登入後的銜接動作 (當單頁自訂(login_fb_custom)不存在時觸發)
function jelly_login_fb_def(){
	//alert("沒有定義之後動作");
}
//全站 FB 已登入狀態的銜接動作 (當單頁自訂(autologin_fb_custom)不存在時觸發)
function jelly_autologin_fb_def(){
	//alert("沒有定義之後動作");
}
//全站 FB 已登出時的統一動作
function jelly_logout_fb_aft(){
	//$("#jelly").html("");
	myfb.login = false;
	//後續處理
	try{ logout_fb_custom(); }catch(err){ jelly_logout_fb_def(); }
}
//全站 FB 已登出後的銜接動作 (當單頁自訂(logout_fb_custom)不存在時觸發)
function jelly_logout_fb_def(){
	//alert("沒有定義之後動作");
}


//儲存 fb 登入後的個人資料
function jelly_save_fb(myevent , response){
	if (response.authResponse) {
		FB.api('/me', function(response) {
			//將個人資料存到 object 中
			myfb["meinfo"] = response;
			myfb.login = true;
			if(myevent == "auto"){
				jelly_autologin_fb_aft();
			}else if(myevent == "click"){
				jelly_login_fb_aft();
			}
		});
	}
}

//user 看到 fb 登入要求後取消
function jelly_cancel_fb(response){
	//不知道要衝殺小
}

/*
//FB 已登入後的銜接動作 此function應放在需處理的頁面 <head> 中
function login_fb_custom(){
	alert("接到客制動作");
}
//FB 已登入狀態的自動銜接動作 此function應放在需處理的頁面 <head> 中
function autologin_fb_custom(){
	alert("接到客制動作");
}
//FB 已登出後的銜接動作 此function應放在需處理的頁面 <head> 中
function logout_fb_custom(){
	alert("接到客制動作");
}
*/

// fans page ======================================================================
//使用 fb plus 放入 <div class="fb-like-box" data-href=" fans page url " data-show-faces="false" data-stream="false" data-header="false"></div>
function jelly_checkfanspage(pageid){
	myfb.pageid = pageid;
	var query = FB.Data.query('select uid,page_id,type,profile_section,created_time from page_fan where uid = {0} and page_id = {1}',myfb.meinfo.id , pageid);
	query.wait(function(rows) {
		if(rows.length > 0){
			try{ fbfan_true_custom(rows); }catch(err){ jelly_fbfan_true_def(rows); }
		}else{
			try{ fbfan_false_custom(pageid); }catch(err){ jelly_fbfan_false_def(pageid); }
		}
	});
}
//fql?q=select uid,page_id,type,profile_section,created_time from page_fan where uid = '609209429' and page_id = '193870733994477'
//uid = '609209429' and page_id = '193870733994477'


//全站 FB 驗證 fans 成功 後的銜接動作 (當單頁自訂(fbfan_true_custom)不存在時觸發)
function jelly_fbfan_true_def(rows){
	//
}
//全站 FB 驗證 fans 失敗 後的銜接動作 (當單頁自訂(fbfan_false_custom)不存在時觸發)
function jelly_fbfan_false_def(pageid){
	//
}

/*
//FB 驗證 fans 成功 此function應放在需處理的頁面 <head> 中
function fbfan_true_custom(rows){
	alert("接到客制動作");
}
//FB 驗證 fans 失敗 此function應放在需處理的頁面 <head> 中
function fbfan_false_custom(pageid){
	alert("接到客制動作");
}
*/
function invite_checkfanspage(pageid){
	myfb.pageid = pageid;
	var query = FB.Data.query('select uid,page_id,type,profile_section,created_time from page_fan where uid = {0} and page_id = {1}',myfb.meinfo.id , pageid);
	query.wait(function(rows) {
		if(rows.length > 0){
			try{ invitefbfan_true_custom(rows); }catch(err){ invite_fbfan_true_def(rows); }
		}else{
			try{ invitefbfan_false_custom(pageid); }catch(err){ invite_fbfan_false_def(pageid); }
		}
	});
}

//全站 FB 驗證 fans 成功 後的銜接動作 (當單頁自訂(fbfan_true_custom)不存在時觸發)
function invite_fbfan_true_def(rows){
	//
}
//全站 FB 驗證 fans 失敗 後的銜接動作 (當單頁自訂(fbfan_false_custom)不存在時觸發)
function invite_fbfan_false_def(pageid){
	//
}
</script>



