<?php //中
$myl_page_deftitle = "捐款單回信";
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

//Columns
$myl = array(
"{$bef}Sno"=>"",
"{$bef}Key"=>"",
"{$bef}Title"=>"Email 主旨",
"{$bef}Main"=>"Email 內容",
"{$bef}Note"=>"說明"
);
//Column Descriptions
$mylps = array(
"{$bef}Sno"=>"",
"{$bef}Key"=>"",
"{$bef}Title"=>"Email 主旨",
"{$bef}Main"=>"Email 內容",
"{$bef}Note"=>"<ul>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordSno}</a> : 訂單號碼</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memSno}</a> : 會員</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$kdoSno}</a> : 捐款單位</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$donSno}</a> : 捐款產品</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordTitle}</a> : 捐款商品名稱</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordBonus}</a> : 使用點數</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordForm}</a> : 訂單資料</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordTime}</a> : 建立時間</li>

<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$reMain}</a> : 回覆內容</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$admNick}</a> : 管理員</li>
</ul>"
);
//Search Descriptions
$mylse = array(
"{$bef}Sno"=>"",
"{$bef}Key"=>"",
"{$bef}Title"=>"Email 主旨",
"{$bef}Main"=>"Email 內容",
"{$bef}Note"=>"說明"
);
?>