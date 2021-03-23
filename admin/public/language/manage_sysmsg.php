<?php //中
$myl_page_deftitle = "系統訊息";
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

$myl = 			array(
"{$bef}Sno"=>"主鍵" ,
"{$bef}Time"=>"發表時間" ,
"{$bef}Title"=>"標題" ,
"{$bef}Main"=>"內容" ,
"{$bef}Onlinetime"=>"上線時間" ,
"{$bef}Status"=>"狀態" ,
"memSno"=>"目標會員" ,
"{$bef}Read"=>"已閱讀會員" ,
"admSno"=>"管理員"
);
$myl['StatusOpt'] = array(1=>"上架" , 0=>"下架");
$mylps = 		array(
"{$bef}Sno"=>"主鍵" ,
"{$bef}Time"=>"發表時間" ,
"{$bef}Title"=>"標題" ,
"{$bef}Main"=>"內容" ,
"{$bef}Onlinetime"=>"狀態為上架時 , 現在時間需超過此設定值會員才能看到" ,
"{$bef}Status"=>"狀態" ,
"memSno"=>"輸入會員主鍵 , 多個會員用' , '半形逗號分隔 , 全站公告請輸入 0 , 不可有空白" ,
"{$bef}Read"=>"已閱讀會員" ,
"admSno"=>"管理員"
);
$mylse = 		array(
"{$bef}Sno"=>"主鍵" ,
"{$bef}Time"=>"發表時間" ,
"{$bef}Title"=>"標題" ,
"{$bef}Main"=>"內容" ,
"{$bef}Onlinetime"=>"上線時間" ,
"{$bef}Status"=>"狀態" ,
"memSno"=>"目標會員用,分隔 全會員用 0 " ,
"{$bef}Read"=>"已閱讀會員" ,
"admSno"=>"管理員"
);
?>