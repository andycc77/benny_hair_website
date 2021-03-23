<?php
	$cms_tool_search = '
	<ul class="tablefooter">
	<li><a href="javascript:actsearch(1);" class="button themed"><span class="icon_text pack _226"></span>'.$myl_list_searchStart.'</a></li>
	<li><a href="javascript:actsearch(2);" class="button white"><span class="icon_text pack _41"></span>'.$myl_list_searchClear.'</a></li>
	</ul>';
	$cms_list_btn_add = '<li class="button white"><a href="add.php"><span class="icon_text addnew"></span>'.$myl_list_add.'</a></li>';
	$cms_list_btn_update = '<li class="button white"><a href="javascript:updatelistselect(\''.$myl_page_list_qupdate.'\');"><span class="icon_text save"></span>'.$myl_list_update.'</a></li>';
	$cms_list_btn_del = '<li class="button white"><a href="javascript:dellistselect(\''.$myl_page_list_qdel.'\');"><span class="icon_text cancel"></span>'.$myl_list_del.'</a></li>';
	$cms_list_btn_import = '<li class="button white"><a href="import.php"><span class="pack icon_text _113"></span>'.$myl_list_import.'</a></li>';
	$cms_list_btn_importdownload = '<li class="button white"><a href="import.csv"><span class="pack icon_text _112"></span>'.$myl_list_importdownload.'</a></li>';
	$haspage = (isset($_GET['page']))?"?page={$_GET['page']}":"";
	$cms_nolist_btn_backlist = '<li class="button white"><a href="list.php'.$haspage .'"><span class="icon_text backlist"></span>'.$myl_nolist_page_backlist.'</a></li>';
	$tmppic = "../images/tmp.pmg";
?>