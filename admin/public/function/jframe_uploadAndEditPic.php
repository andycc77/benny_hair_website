<?php 
/* js使用方式
function divUploadPic(inputname , has , origin , origin_resize , ctrlw , ctrlh , crop , maxw , maxh , listw , listh){
	//inputname 目標 input name
	//has (1,2)可否連續上傳
	//origin (1,0) 是否保留原始上傳圖片 , 檔案會是 o_ 開頭
	//origin_resize (1,0) 是否保留第1次縮圖後的圖片 , 檔案會是 r_ 開頭
	//ctrlw (N,int) 拉選框的寬
	//ctrlh (N,int) 拉選框的高
	//ctrlw ctrlh 都填時鎖定裁切後寬高 , 只填ctrlw鎖定裁切後寬 , 只填ctrlh鎖定裁切後高 , 都填N就不動作
	//crop (1,0) 是否使用裁切功能
	//maxw (N,int) 第1次縮圖的寬
	//maxh (N,int) 第1次縮圖的高
	//listw (N,int) 清單縮圖的寬
	//listh (N,int) 清單縮圖的高
	//listw listh 都填時鎖定清單縮圖寬高 , 只填listw鎖定清單縮圖寬 , 只填listh鎖定清單縮圖高 , 都填N就不產生清單縮圖 , 檔案會是 l_ 開頭
	var tar = document.getElementById("j_uploadAndEditPic");
	var tar2 = document.getElementById("jframe_uploadAndEditPic");
	tar.style.display = "block";
	tar2.src = "<?=$webUrl;?>function/j_uploadAndEditPic.php?"
	+"inputname="+inputname
	+"&has="+has
	+"&origin="+origin
	+"&origin_resize="+origin_resize
	+"&ctrlw="+ctrlw
	+"&ctrlh="+ctrlh
	+"&crop="+crop
	+"&maxw="+maxw
	+"&maxh="+maxh
	+"&listw="+listw
	+"&listh="+listh;
	tar2.style.display = "block";
}
*/
?>
    <div class="j_uploadAndEditPic" id="j_uploadAndEditPic" style="display:none;"></div>
    <iframe name="jframe_uploadAndEditPic" class="jframe_uploadAndEditPic" id="jframe_uploadAndEditPic" src="" scrolling="no" frameborder="0" style="display:none;"></iframe>