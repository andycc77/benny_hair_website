<?php //中
	$myl_page_deftitle = "卡片資料";
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
	
	$myl_page_title1 = "卡片使用記錄";
	
$myl = 			array(
"{$bef}Sno"=>"主鍵" ,
"kicSno"=>"卡片系列" ,
"kicKey"=>"前置字" ,
"{$bef}Num"=>"卡號" ,
"{$bef}Pw"=>"密碼" ,
"{$bef}Cash"=>"儲值點數" ,
"{$bef}Start"=>"卡片啟用時間" ,
"{$bef}End"=>"卡片結束時間" ,
"{$bef}Use"=>"卡片使用上限" ,
"{$bef}Now"=>"目前使用次數" ,
"{$bef}Try"=>"開卡錯誤次數" ,
"{$bef}Status"=>"狀態" ,
"{$bef}Create"=>"建立時間" ,
"{$bef}Nick"=>"建卡人員" ,
"{$bef}Luck"=>"自動鎖定" ,
"rangeStart"=>"卡號範圍" ,
"rangeEnd"=>"卡號範圍" ,
"rangePw"=>"密碼範圍" ,
"numLength"=>"卡號長度" ,
"pwLength"=>"密碼長度" ,
"createNum"=>"建立張數" , 
"memNick"=>"會員" , 
"calPw"=>"輸入密碼" , 
"calTime"=>"時間" , 
"calIp"=>"IP" , 
"calPs"=>"說明" 
);
$myl['StatusOpt'] =  array(1=>"啟用" , 0=>"管理員鎖定" , 2=>"系統鎖定");
$myl['LuckOpt'] =  array(1=>"自動鎖定" , 0=>"不鎖定");
$mylps = 		array(
"{$bef}Sno"=>"主鍵" ,
"kicSno"=>"卡片系列" ,
"kicKey"=>"前置字" ,
"{$bef}Num"=>"卡號" ,
"{$bef}Pw"=>"密碼" ,
"{$bef}Cash"=>"會員使用此卡片可穫得點數" ,
"{$bef}Start"=>"卡片啟用時間" ,
"{$bef}End"=>"卡片結束時間" ,
"{$bef}Use"=>"此卡可以被多少人使用儲值" ,
"{$bef}Now"=>"目前使用次數" ,
"{$bef}Try"=>"開卡錯誤次數" ,
"{$bef}Status"=>"狀態" ,
"{$bef}Create"=>"建立時間" ,
"{$bef}Nick"=>"建卡人員" ,
"{$bef}Luck"=>"當錯誤次數超過基本設定中的上限後鎖定" ,
"rangeStart"=>"請輸入卡號範圍 ex : 10000 , 50000" ,
"rangeEnd"=>"卡號範圍" ,
"rangePw"=>"請輸入密碼範圍文字, 設定密碼時將從輸入的字串中隨機選出需要的密碼位數, 可設定重覆的文字設定出現機率, 有分大小寫" ,
"numLength"=>"卡號最小長度, 若卡號範圍不足此長度將自動補零, 若超過此長度將保持原有卡號" ,
"pwLength"=>"從上方密碼範圍隨機挑出多少字母做為密碼" ,
"createNum"=>"請輸入需要卡片張數 , 將從卡號範圍中選出指定張數 , 建議單次產生張數不要超過500" 
);
$mylse = 		array(
"{$bef}Sno"=>"主鍵" ,
"kicSno"=>"卡片系列" ,
"kicKey"=>"前置字" ,
"{$bef}Num"=>"卡號" ,
"{$bef}Pw"=>"密碼" ,
"{$bef}Cash"=>"儲值點數" ,
"{$bef}Start"=>"卡片啟用時間" ,
"{$bef}End"=>"卡片結束時間" ,
"{$bef}Use"=>"卡片使用上限" ,
"{$bef}Now"=>"目前使用次數" ,
"{$bef}Try"=>"開卡錯誤次數" ,
"{$bef}Status"=>"狀態" ,
"{$bef}Create"=>"建立時間" ,
"{$bef}Nick"=>"建卡人員" ,
"{$bef}Luck"=>"自動鎖定" ,
"rangeStart"=>"卡號範圍" ,
"rangeEnd"=>"卡號範圍" ,
"rangePw"=>"密碼範圍" ,
"numLength"=>"卡號長度" ,
"pwLength"=>"密碼長度" ,
"createNum"=>"建立張數" 
);
?>