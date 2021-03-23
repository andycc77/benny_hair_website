<?php //中
	$myl_page_deftitle = "訂單通知信";
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
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordSno}</a> : 訂單編號</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordType}</a> : 訂單種類</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$alpSno}</a> : alp導購活動</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$memSno}</a> : 訂購會員</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordEmail}</a> : Email</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordEmail2}</a> : 備用email</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordName}</a> : 收件人</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordTel}</a> : 電話</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordGsm}</a> : 手機</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordZip}</a> : 郵區</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordCity}</a> : 城市</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordArea}</a> : 地區</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordAddr}</a> : 地址</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordShiptime}</a> : 希望到達時間</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordMain}</a> : 購買備註</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordItemprice}</a> : 商品費用</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordShipprice}</a> : 運費</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordTotalprice}</a> : 應付</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordUtype}</a> : 發票種類</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordGetbonus}</a> : 可獲得紅利</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$ordTime}</a> : 下單時間</li>
<li><a href='javascript:;' class='button white' onclick='addme(this);'>{\$orderlist}</a> : 訂購商品</li>
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