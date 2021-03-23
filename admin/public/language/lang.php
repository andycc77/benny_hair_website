<?php
//WEB

//WEB and CMS

$proOnebyoneOpt = array(0=>"僅算一次" , 1=>"單件記費");

$ordShiptimeOpt = array("不指定" , "09-12" , "12-15" , "15-18" , "其它");
$ordTtypeOpt = array(2=>"二聯式" , 3=>"三聯式");
$ordPaystatusOpt = array(0=>"未付款" , 1=>"已付款" , 2=>"部份付款" , 3=>"已付款，已發送通知", 9=>"付款異常");
$ordStatusOpt = array(0=>"停用" , 1=>"正常" , 9=>"異常停用");
$ordCancelOpt = array(0=>"正常" , 1=>"取消");
$ordCanmrbOpt = array(0=>"禁止退貨" , 1=>"可退貨");

$orlShipstatusOpt = array(0=>"待付款" , 1=>"已到貨" , 2=>"已付款" , 3=>"已出貨" , 4=>"備貨中");

$ommShipstatusOpt = array(0=>"待處理" , 1=>"已收到" , 2=>"已取貨" , 3=>"取貨中");
$ommStatusOpt = array(0=>"未處理" , 1=>"已處理" , 2=>"處理中");

$ompShipstatusOpt = array(0=>"待處理" , 1=>"已收到" , 2=>"已取貨" , 3=>"取貨中");
$ompSendstatusOpt = array(0=>"待取貨" , 1=>"已到貨" , 2=>"出貨中" , 3=>"備貨中");
$ompStatusOpt = array(0=>"未處理" , 1=>"已處理" , 2=>"處理中");

$orgStatusOpt = array(0=>"待處理" , 1=>"已處理" , 2=>"處理中" , 8=>"自動發送異常" , 9=>"禁止兌換");
$ormStatusOpt = array(0=>"待處理" , 1=>"已處理" , 2=>"處理中" , 9=>"禁止兌換");
$orpStatusOpt = array(0=>"待處理" , 1=>"已處理" , 2=>"處理中" , 9=>"禁止兌換");

$bolTableOpt = array(
	"oj_admin"=>"管理員修正點數" , 
	"oj_card"=>"卡片儲點" , 
	"oj_event"=>"參與活動獎勵" , 
	"oj_orderinfo"=>"購物消費紅利" , 
	"oj_member"=>"百萬分紅" ,
	"oj_ordergiftgamecard"=>"紅利換My Card" ,
	"oj_ordergiftmoney"=>"紅利換現金" ,
	"oj_ordergiftproduct"=>"紅利換好禮" ,
	 "oj_lottery"=>"紅利抽獎" , 
	 ""
);
$ordTableOpt = array(
	"oj_product"=>"一般購物" , 
	"oj_alpstore"=>"紅利導購" , 
	""
);
$ordPkbefOpt = array(
	"oj_product"=>"pro" , 
	"oj_alpstore"=>"alp" , 
	""
);
$ordApiOpt = array(
	"ALP"=>"ALP導購" , 
	""
);

$ecrTableOpt = array("eventtmpfans"=>"活動樣板-fans");






//CMS
$limitOpt = array(10,20,30,40,50,"ALL");


//menu
$cms_menu = array( 	"首頁"		=> array(		"nav"				=> array("nav_dashboard"	, $managePath."dashboard.php"					, "_126") 
											), 
					"網站內容"		=> array(	"nav"				=> array("nav_content"		, "javascript:;"								, "_257") , 
												"最新消息"			=> array("news" 			, $managePath."news/list.php"					, "_289") ,
												"Q&amp;A"			=> array("qaa" 				, $managePath."qaa/list.php"					, "_256") ,
												"最新消息分類"		=> array("kindnews" 		, $managePath."kindnews/list.php"				, "_501") ,
												"Q&amp;A分類"		=> array("kindqaa" 			, $managePath."kindqaa/list.php"				, "_501") , 
												"關於我們"			=> array("aboutus" 			, $managePath."htmlpage/v_aboutus.php"			, "_102") , 
												"會員條款"			=> array("terms" 			, $managePath."htmlpage/v_terms.php"			, "_102") , 
												"隱私權政策"			=> array("privacy" 			, $managePath."htmlpage/v_privacy.php"			, "_102") 
											), 
					"廣告管理"		=> array(	"nav"				=> array("nav_product"		, "javascript:;"								, "_219") , 
												"首頁上方"			=> array("bannert" 			, $managePath."bannert/list.php"				, "_219") ,
												"首頁右上"			=> array("bannerrt" 		, $managePath."bannerrt/list.php"				, "_219") ,
												"首頁中間"			=> array("bannerm" 			, $managePath."bannerm/list.php"				, "_219") ,
												"首頁右下"			=> array("bannerrd" 		, $managePath."bannerrd/list.php"				, "_219") ,
												/*"內頁左方"			=> array("bannerl" 			, $managePath."bannerl/list.php"				, "_30")*/
												"系統訊息"			=> array("sysmsg" 			, $managePath."sysmsg/list.php"				, "_63") ,
											), 
					"活動與產品"		=> array(	"nav"				=> array("nav_product"		, "javascript:;"								, "_157") , 
												"活動資料"			=> array("event" 			, $managePath."event/list.php"					, "_87") ,
												"ALP購物"			=> array("alpstore" 		, $managePath."alpstore/list.php"				, "_151") ,
												"產品資料"			=> array("product" 			, $managePath."product/list.php"				, "_157") ,
												"紅利抽獎"			=> array("lottery" 			, $managePath."lottery/list.php"				, "_157") ,
												"活動分類"			=> array("kindevent" 		, $managePath."kindevent/list.php"				, "_501") ,
												"產品分類"			=> array("kindproduct" 		, $managePath."kindproduct/list.php"			, "_501") , 
												
												//"活動樣板點數設定"		=> array("eventcredits" 	, $managePath."eventcredits/list.php"			, "_160") ,
												"小額上刊活動"		=> array("eventtmpfans" 	, $managePath."eventtmpfans/list.php"			, "_278") ,
												//"樣板-名單"		=> array("eventtmpresume" 		, $managePath."eventtmpresume/list.php"			, "_77"),
												"愛閱讀-文章"		=> array("e_20120413_postlike_bloger" 		, $managePath."postlike/list.php"	, "_77"),
												"愛閱讀-粉絲團"		=> array("e_20120413_postlike_pagesum" 		, $managePath."postlike_p/list.php"			, "_77") ,
												"愛閱讀-備用文章"		=> array("e_20120413_postlike_blogerbackup" 		, $managePath."postlikebackup/list.php"	, "_78")
												
												
												
											), 
					"紅利兌換"		=> array(	"nav"				=> array("nav_product"		, "javascript:;"								, "_157") , 
												"現金兌換"			=> array("giftmoney" 		, $managePath."giftmoney/list.php"				, "_157") ,
												"商品兌換"			=> array("giftproduct" 		, $managePath."giftproduct/list.php"			, "_157") ,
												"MyCard兌換"			=> array("giftgamecard" 	, $managePath."giftgamecard/list.php"				, "_157") ,
												"MyCard管理"			=> array("gamecard" 		, $managePath."gamecard/list.php"				, "_158") ,
												"現金兌換單"			=> array("ordergiftmoney" 	, $managePath."ordergiftmoney/list.php"			, "_156") ,
												"商品兌換單"			=> array("ordergiftproduct" , $managePath."ordergiftproduct/list.php"		, "_156") ,
												"MyCard兌換單"		=> array("ordergiftgamecard", $managePath."ordergiftgamecard/list.php"		, "_156") 
											), 
					"紅利捐款"		=> array(	"nav"				=> array("nav_product"		, "javascript:;"								, "_277") , 
												"捐款單位"			=> array("kinddonation" 	, $managePath."kinddonation/list.php"			, "_162") ,
												"捐款產品"			=> array("donation" 		, $managePath."donation/list.php"				, "_157") ,
												"捐款訂單"			=> array("orderdonation" 	, $managePath."orderdonation/list.php"			, "_156") , 
												"捐款單回信"		=> array("emailreorderdonation"	, $managePath."emailtmp/view.php?m=emailreorderdonation"	, "_57") 
											), 
					"會員服務"		=> array(	"nav"				=> array("nav_user"			, "javascript:;"								, "_85") , 
												"會員資料"			=> array("member" 			, $managePath."member/list.php"					, "_84") , 
												"會員紅利"			=> array("memberbonus" 		, $managePath."memberbonus/list.php"			, "_38") , 
												"訂單管理"			=> array("orderinfo" 		, $managePath."orderinfo/list.php"				, "_156") , 
												"聯絡我們"			=> array("contact" 			, $managePath."contact/list.php"				, "_64") 
											), 
					"廠商管理"		=> array(	"nav"				=> array("nav_user"			, "javascript:;"								, "_85") , 
												"廠商管理"			=> array("adminp" 			, $managePath."adminp/list.php"					, "_79") , 
												/*"廠商管理人"			=> array("adminpman" 		, $managePath."adminpman/list.php"				, "_79") , 
												"新增管理人樣版"		=> array("emailaddclientadmin"	, $managePath."emailtmp/view.php?m=emailaddclientadmin"	, "_57") , */
												"廠商點數"			=> array("creditslog" 		, $managePath."creditslog/list.php"				, "_38") , 
												//"點數產品"			=> array("credits" 			, $managePath."credits/list.php"				, "_159") , 
												"點數訂單"			=> array("ordercredits" 	, $managePath."ordercredits/list.php"				, "_156") 
											), 
					"卡片管理"		=> array(	"nav"				=> array("nav_email"		, "javascript:;"								, "_158") , 
												"卡片系列"			=> array("kindcard"			, $managePath."kindcard/list.php"				, "_501") , 
												"卡號管理"			=> array("card"				, $managePath."card/list.php"					, "_158") , 
												"攻擊記錄"			=> array("cardtry"			, $managePath."cardtry/list.php"				, "_37") 
											), 
					"品牌管理"		=> array(	"nav"				=> array("nav_email"		, "javascript:;"								, "_158") , 
												"品牌分類"			=> array("kindbrand"			, $managePath."kindbrand/list.php"				, "_501"),
												"品牌"				=> array("brand"			, $managePath."brand/list.php"				, "_501")
											), 
					"會員 Email"		=> array(	"nav"				=> array("nav_email"		, "javascript:;"								, "_55") , 
												/*"註冊通知"			=> array("emailreg"			, $managePath."emailtmp/view.php?m=emailreg"		, "_57") , 
												"重寄驗證信"			=> array("emailcheck"		, $managePath."emailtmp/view.php?m=emailcheck"		, "_57") , 
												"重置密碼信"			=> array("emailforget"		, $managePath."emailtmp/view.php?m=emailforget"		, "_57") , */
												"歡迎新會員"		=> array("welcome"	, $managePath."emailtmp/view.php?m=welcome"	, "_57") , 
												"新會員提醒"		=> array("newmembertip"	, $managePath."emailtmp/view.php?m=newmembertip"	, "_57") , 
												"新項目提醒"		=> array("newitemtop"	, $managePath."emailtmp/view.php?m=newitemtop"	, "_57") , 
												
												"聯絡我們回信"		=> array("emailrecontact"	, $managePath."emailtmp/view.php?m=emailrecontact"	, "_57") , 
												"訂單通知信"			=> array("emailorder"		, $managePath."emailtmp/view.php?m=emailorder"		, "_57") , 
												"訂單付款確認"		=> array("emailpayorder"	, $managePath."emailtmp/view.php?m=emailpayorder"	, "_57") , 
												"現金兌換回信"		=> array("emailordergiftmoney"	, $managePath."emailtmp/view.php?m=emailordergiftmoney"	, "_57") , 
												"商品兌換回信"		=> array("emailordergiftproduct"	, $managePath."emailtmp/view.php?m=emailordergiftproduct"	, "_57") , 
												"MyCard兌換回信"		=> array("emailordergiftgamecard"	, $managePath."emailtmp/view.php?m=emailordergiftgamecard"	, "_57") , 
												"MyCard自動兌換"		=> array("emailautoordergiftgamecard"	, $managePath."emailtmp/view.php?m=emailautoordergiftgamecard"	, "_57") 
											), 
					"管理員 Email"	=> array(	"nav"				=> array("nav_email"		, "javascript:;"								, "_55") , 
												"聯絡我們通知"		=> array("emailsyscontact"	, $managePath."emailtmp/view.php?m=emailsyscontact"	, "_58") , 
												"廠商訂單通知"		=> array("emailporder"		, $managePath."emailtmp/view.php?m=emailporder"		, "_58") , 
												"管理員訂單通知"		=> array("emailsysorder"	, $managePath."emailtmp/view.php?m=emailsysorder"	, "_58") , 
												"廠商訂單付款通知"		=> array("emailppayorder"	, $managePath."emailtmp/view.php?m=emailppayorder"	, "_58") , 
												"管理員訂單付款通知"	=> array("emailsyspayorder"	, $managePath."emailtmp/view.php?m=emailsyspayorder"	, "_58") , 
												"管理員兌換通知"		=> array("emailsysgift"		, $managePath."emailtmp/view.php?m=emailsysgift"		, "_58") , 
												"CMS 密碼信"			=> array("emailsysforget"	, $managePath."emailtmp/view.php?m=emailsysforget"	, "_58")
											),
					"管理員功能"		=> array(	"nav"				=> array("nav_admin"		, "javascript:;"								, "_79") , 
												"基本設定"			=> array("webset"			, $managePath."webset/view.php"					, "_177") , 
												"付款方式"			=> array("payment"			, $managePath."payment/list.php"				, "_160") , 
												"紅利記錄"			=> array("bonuslog"			, $managePath."bonuslog/list.php"				, "_38") , 										
												"所在國家分類"		=> array("kindcountry"		, $managePath."kindcountry/list.php"					            , "_501") , 
												//"所在國家管理"		=> array("country"			, $managePath."country/list.php"				                , "_79") ,
												"管理員管理"			=> array("admin"			, $managePath."admin/list.php"					, "_79") , 
												"管理員歷程"			=> array("adminlog"			, $managePath."adminlog/list.php"				, "_102") , 
												"CronJobsLog"		=> array("cronjobslog"		, $managePath."cronjobslog/list.php"				, "_102") ,
												"結帳-winwin"		=> array("bill"		        , $managePath."bill/bill.php"			        	, "_102"),
												"結帳-alp"		=> array("billalp"		        , $managePath."billalp/bill.php"			        	, "_102")
											)
				);
				
$vip_menu = array( 	"首頁"		=> array(		"nav"				=> array("nav_dashboard"	, $managePath."dashboard.php"					, "_126") 
											), 
					"廠商活動"		=> array(	"nav"				=> array("nav_content"		, "javascript:;"								, "_257") , 
												"活動資料"			=> array("event" 			, $managePath."event/list.php"					, "_87") 
											), 
					"廠商購物"		=> array(	"nav"				=> array("nav_product"		, "javascript:;"								, "_219") , 
												"訂單管理"			=> array("orderlist" 		, $managePath."orderlist/list.php"				, "_156") 
											), 
					"廠商管理"		=> array(	"nav"				=> array("nav_admin"		, "javascript:;"								, "_79") , 
												"帳號管理"			=> array("adminp"			, $managePath."adminp/list.php"					, "_79") , 
												"窗口管理"		=> array("adminpman"		, $managePath."adminpman/list.php"				, "_79") 
											)
				);


//login
$myl_login_title = "登入管理系統";
$myl_login_admId = "帳號";
$myl_login_admPw = "密碼";
$myl_login_login = "登入";
$myl_login_forget = "忘記密碼";
$myl_login_msg_pw = array("error","密碼錯誤");
$myl_login_msg_id = array("error","帳號錯誤");
$myl_login_msg_exit = array("information","成功登出");
$myl_login_msg_godie = array("warning","請先登入");
$myl_login_waction_login = "登入系統";
$myl_login_waction_pw = "嘗試登入-密碼錯誤";
$myl_login_waction_id = "嘗試登入-無帳號";
$myl_login_waction_exit = "登出";
$myl_login_waction_godie = "直接輸入後台網址";

//fotget
$myl_forget_title = "寄送密碼";
$myl_forget_admId = "帳號";
$myl_forget_admEmail = "Email";
$myl_forget_forget = "寄出";
$myl_forget_login = "登入";
$myl_forget_msg_ok = array("information","密碼已寄出");
$myl_forget_msg_no = array("error","密馬重置失敗請稍後再試");
$myl_forget_msg_email = array("error","Email錯誤");
$myl_forget_msg_id = array("error","重置密碼帳號錯誤");
$myl_forget_waction_sendy = "重置密碼後寄出Email";
$myl_forget_waction_sendn = "重置密碼失敗";
$myl_forget_waction_email = "重置密碼-Email錯誤";
$myl_forget_waction_id = "重置密碼-無帳號";

//topbar
$myl_topbar_preview = "瀏覽前台";
$myl_topbar_logout = "登出";

//pagebtn
$myl_page_btn_edit = "修改資料";
$myl_page_btn_del = "刪除資料";
$myl_page_btn_qdel = "您確定要刪除這筆資料?";
$myl_page_btn_add = "新增資料";
$myl_page_btn_addmore = "新增多筆資料";
$myl_page_btn_save = "儲存資料";
$myl_page_btn_savenew = "儲存為新資料";
$myl_page_btn_savenewmore = "儲存並新增多筆資料";
$myl_page_btn_clearlog = "清空歷程";

//list
$myl_list_searchStart = "開始搜尋";
$myl_list_searchClear = "清除搜尋";
$myl_list_nodata = "無資料";
$myl_list_limit_bef = " - 每頁顯示 "; /* select */ $myl_list_limit_aft = " 筆";
$myl_list_add = "新增資料";
$myl_list_update = "更新勾選";
$myl_list_del = "刪除勾選";
$myl_list_import = "匯入檔案";
$myl_list_importdownload = "下載格式檔";
$myl_list_page_first = "第一頁";
$myl_list_page_prev = "上一頁";
$myl_list_page_next = "下一頁";
$myl_list_page_last = "最末頁";
$myl_list_page_info1 = "顯示"; /* 第1比 */ $myl_list_page_info2 = "到"; /* 第15比 */ $myl_list_page_info3 = "全部"; /* 100 */ $myl_list_page_info4 = "筆資料";

$myl_list_page_qclearlog = "確定清空歷程資料?";
$myl_list_page_waction_clearlog = "清空歷程資料";

//view add edit
$myl_nolist_page_backlist = "回清單頁面";
$myl_nolist_page_th_title = "欄位";
$myl_nolist_page_th_main = "內容";
$myl_add_page_qmore_s = "確定要將此表單內容新增為"; /*5*/ $myl_add_page_qmore_e = "筆資料?";
$myl_edit_page_qnew = "確定要將此表單內容存為新資料?\\n原內容將不會修改";
$myl_edit_page_qmore_s = "確定要將此表單內容儲存後\\n並另外新增"; /* 5 */ $myl_edit_page_qmore_e = "筆資料?";
$myl_editemail_btn_back = "回前頁";

//upload
$myl_upload_page_no_title = "檔案上傳";
$myl_upload_page_no_filetype = "檔案格式 : ";
$myl_upload_page_no_ulbtn = "上傳檔案";
$myl_upload_page_no_nofile = "請先選擇檔案";
$myl_upload_page_no_ulerror = "檔案上傳失敗 , 可能是檔案格式不符合或是檔案大小超過主機上傳限制";
$myl_upload_page_no_ultperror = "檔案上傳失敗 , 檔案格式不符合";
$myl_upload_page_cut_title = "圖片裁切";
$myl_upload_page_cut_cutbtn = "裁切上傳";
$myl_upload_page_cut_nocutbtn = "直接上傳";
$myl_upload_page_cut_keyhelp = "方向鍵 : 1px , Ctrl + 方向鍵 : 10px , Shift : 移動/縮放";
$myl_upload_page_repic_msg = "圖片裁切";
$myl_upload_page_refile_msg = "回傳檔案資料";

//nopower
$myl_nopower_page_title = "沒有權限";
$myl_nopower_page_main = "您沒有該功能的權限 , 若有需求請與管理員聯絡";

?>