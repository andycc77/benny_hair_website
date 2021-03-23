<?php //中
$myl_page_deftitle = "基本設定";
$myl_page_search_title = "搜尋{$myl_page_deftitle}";
$myl_page_list_title = "{$myl_page_deftitle} 清單";
$myl_page_view_title = "瀏覽 {$myl_page_deftitle} 資料";
$myl_page_add_title = "新增 {$myl_page_deftitle}";
$myl_page_edit_title = "修改 {$myl_page_deftitle}";
$myl_page_list_action = "執行";
$myl_page_list_qdel = "您確定要刪除 {$myl_page_deftitle} : ";
$myl_page_list_qupdate = "您確定要修改 {$myl_page_deftitle} : ";
$myl_page_waction_del = "刪除 {$myl_page_deftitle} : ";
$myl_page_waction_update = "修改 {$myl_page_deftitle} : ";
$myl_page_waction_add = "新增 {$myl_page_deftitle} : ";
$myl_page_waction_edit = "修改 {$myl_page_deftitle} : ";

$myl_page_title8 = "{$myl_page_deftitle} - 購物設定";
$myl_page_title1 = "{$myl_page_deftitle} - Facebook";
$myl_page_title2 = "{$myl_page_deftitle} - Google廣告 設定";
$myl_page_title3 = "{$myl_page_deftitle} - 前台 設定";
$myl_page_title4 = "{$myl_page_deftitle} - Email 設定";

$myl_page_title6 = "{$myl_page_deftitle} - Meta 設定";

$myl_page_title20 = "{$myl_page_deftitle} - Viamedia 簡訊商";
$myl_page_title22 = "{$myl_page_deftitle} - Nexmo 簡訊商";


$sysemail_issmtpOpt = array(0=>"不使用",1=>"使用");
$eveemail_issmtpOpt = array(0=>"不使用",1=>"使用");

$meta_languageOpt = array( 'zh-TW' => '中文(繁體)' , 'zh-CN' => '中文(简体)' , 'tr' => 'Türk' , 'da' => 'Danske' , 'ja' => '日本' , 'gl' => 'artigo Galicia' , 'id' => 'Bahasa Indonesia' , 'hi' => 'हिन्दी' , 'af' => 'Boole-teks (Afrikaans in Suider-Afrika)' , 'be' => 'Беларуская' , 'lt' => 'Lietuvos' , 'is' => 'Íslenska' , 'hu' => 'Magyar' , 'es' => 'Español' , 'ca' => 'Català Espanya' , 'hr' => 'Hrvatski' , 'iw' => 'עברית' , 'el' => 'Ελληνικά' , 'fi' => 'Suomalainen' , 'ar' => 'العربية' , 'sq' => 'Shqiptar' , 'lv' => 'Latvijā' , 'fr' => 'Française' , 'fa' => 'فارسی' , 'pl' => 'Polska' , 'en' => 'English' , 'ru' => 'Россию' , 'bg' => 'Български' , 'cy' => 'Fydd Sven' , 'no' => 'Norske' , 'th' => 'ไทย' , 'ht' => 'Kreyòl ayisyen' , 'uk' => 'Українське' , 'nl' => 'Nederlandse' , 'mt' => 'Malti' , 'ms' => 'Melayu' , 'mk' => 'Македонски' , 'cs' => 'České' , 'tl' => 'Tagalog' , 'sw' => 'Swahili' , 'sl' => 'Slavin Sloveniji članek' , 'sk' => 'Slovenskému' , 'pt' => 'Português' , 'vi' => 'Việt' , 'sr' => 'Српска' , 'yi' => 'ייִדיש' , 'et' => 'Eesti' , 'ga' => 'Na hÉireann' , 'sv' => 'Svenska' , 'it' => 'Italiano' , 'de' => 'Deutsch' , 'ko' => '한국어' , 'ro' => 'Română' );




$myl = 			array(

"sys_shopping_sharetime" => "百萬分紅時間" ,
"sys_shopping_mrbtime" => "鑒賞期" ,

"gad_key" => "Google Ad Client" ,
"gad_slot_1" => "Google Ad Slot 728 * 90" ,
"gad_slot_2" => "Google Ad Slot 300 * 250" ,
"gad_slot_3" => "Google Ad Slot 728 * 90" ,

"webset_hbanTnum" => "首頁上方banner數量" ,
"webset_hbanRTnum" => "首頁右上方banner數量" ,
"webset_hbanMnum" => "首頁中間banner數量" ,
"webset_hbanRBnum" => "首頁右下banner數量" ,
"webset_cardautoluck" => "卡片錯誤自動鎖定次數" ,

"fb_api_id" => "FB API ID" ,
"fb_api_pw" => "FB API PW" ,
"fb_fans_id" => "官方粉絲頁 ID" ,
"fb_admin" => "FB 管理員 uid" ,

"sys_viamedia_url" => "URL" ,
"sys_viamedia_id" => "Key" ,
"sys_viamedia_pw" => "Secret" ,

"sys_nexmo_from" => "發訊者" ,
"sys_nexmo_url" => "URL" ,
"sys_nexmo_id" => "Key" ,
"sys_nexmo_pw" => "Secret" ,

"sysemail_issmtp" => "SMTP SERVER" ,
"sysemail_ssl" => "ssl 加密" ,
"sysemail_host" => "主機位置" ,
"sysemail_port" => "主機 port" ,
"sysemail_id" => "Email 帳號" ,
"sysemail_pw" => "Email 密碼" ,
"sysemail_email" => "顯示 Email" ,
"sysemail_name" => "顯示 寄件人" ,
"sysemail_msg" => "主動通知管理員" ,
"sysemail_gsm" => "主動通知管理員" ,

"meta_weburl" => "網站主路徑" ,
"meta_language" => "網站語言" ,
"meta_description" => "網站敘述" ,
"meta_keywords" => "網站關鍵字" ,
"meta_author" => "網站作者" ,
"meta_copyright" => "網站版權" ,
"meta_webtitle" => "網站標題" ,


""=>""
);

$mylps = 		array(

"sys_shopping_sharetime" => "天" ,
"sys_shopping_mrbtime" => "天" ,

"fb_api_id" => "" ,
"fb_api_pw" => "" ,
"fb_fans_id" => "" ,
"fb_admin" => "新增一個 管理員" ,

"sysemail_issmtp" => "Gmail : 使用 , 本機 : 不使用" ,
"sysemail_ssl" => "Gmail : ssl , 本機 : 不需填寫" ,
"sysemail_host" => "Gmail : smtp.gmail.com , 本機 : localhost" ,
"sysemail_port" => "Gmail : 465 , 本機 : 25" ,
"sysemail_id" => "Gmail : xxxx@gmail.com , 本機 : 不需填寫" ,
"sysemail_pw" => "Gmail : 密碼 , 本機 : 不需填寫" ,
"sysemail_email" => "顯示寄出的 Email" ,
"sysemail_name" => "顯示寄出的 名稱" ,
"sysemail_msg" => "新增一組 Email" ,

"sys_viamedia_url" => "http://api.vmcsms.com/frontend/smsRequestAdapter" ,
//"sys_viamedia_url" => "http://220.228.173.6:80/frontend/smsRequestAdapter" ,
"sys_viamedia_id" => "24491673" ,
"sys_viamedia_pw" => "24491673" ,

"sys_nexmo_from" => "限英文" ,
"sys_nexmo_url" => "https://rest.nexmo.com/sms/json , https://rest.nexmo.com/sms/xml" ,
"sys_nexmo_id" => "beb3593a" ,
"sys_nexmo_pw" => "f1e26c0e" ,

"meta_weburl" => "需含 http:// 的完整路徑 , 並使用 / 結尾 . ex : http://www.google.com/" ,
"meta_webtitle" => "" ,
"meta_language" => "" ,
"meta_description" => "" ,
"meta_keywords" => "使用 , 號隔開所有關鍵字" ,
"meta_author" => "" ,
"meta_copyright" => "" ,

""=>""
);
$mylse = 		array();
?>