<?php //中
	$myl_page_deftitle = "廠商訂單通知";
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
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordSno}</a> : 訂單號</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$proName}</a> : 品名</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$proSprice}</a> : 商品單價</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$proShip}</a> : 商品運費</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$orlPrice}</a> : 售價</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$orlShip}</a> : 運費</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$orlQt}</a> : 數量</li>
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