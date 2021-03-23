<?php //中
	$myl_page_deftitle = "新項目提醒";
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
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memEmail}</a> : 會員信箱</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memEmail}</a> : 會員帳號</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memName}</a> : 姓名</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memNick}</a> : 暱稱</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memSex}</a> : 性別</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memGsm}</a> : 電話</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memAddtime}</a> : 加入時間(Unix戳記)</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memBonus}</a> : 積點</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memCountry}</a> : 居住(國家)</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memCity}</a> : 居住(縣市)</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memArea}</a> : 居住(鄉鎮)</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memAddress}</a> : 居住(路街巷弄)</li>
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