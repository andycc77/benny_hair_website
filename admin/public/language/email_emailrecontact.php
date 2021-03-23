<?php //中
	$myl_page_deftitle = "聯絡我們回信";
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
	$myl = 			array("{$bef}Sno"=>"",
						  "{$bef}Key"=>"",
						  "{$bef}Title"=>"Email 主旨",
						  "{$bef}Main"=>"Email 內容",
						  "{$bef}Note"=>"說明"
						  );
	//Column Descriptions
	$mylps = 		array("{$bef}Sno"=>"",
						  "{$bef}Key"=>"",
						  "{$bef}Title"=>"Email 主旨",
						  "{$bef}Main"=>"Email 內容",
						  "{$bef}Note"=>"<ul>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$kiqSno}</a> : 問題分類</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$conTime}</a> : 時間</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$conIp}</a> : IP</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$conName}</a> : 大名</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$conEmail}</a> : Email</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$conGsm}</a> : 電話</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$conTitle}</a> : 標題</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$conMain}</a> : 問題</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$reMain}</a> : 回覆內容</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$admNick}</a> : 管理員</li>
						  </ul>"
						  );
	//Search Descriptions
	$mylse = 		array("{$bef}Sno"=>"",
						  "{$bef}Key"=>"",
						  "{$bef}Title"=>"Email 主旨",
						  "{$bef}Main"=>"Email 內容",
						  "{$bef}Note"=>"說明"
						  );
?>