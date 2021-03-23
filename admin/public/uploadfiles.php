<?php
	include_once("./configs/dbconfig.php");
	include_once("./function/function.php");
	//include_once("../function/mimetypes.php");
	include_once("./configs/manage_defaul.php");

//upload
$myl_upload_page_no_title = "檔案上傳";
$myl_upload_page_no_filetype = "檔案格式 : ";
$myl_upload_page_no_ulbtn = "上傳檔案";
$myl_upload_page_no_nofile = "請先選擇檔案";
$myl_upload_page_no_ulerror = "檔案上傳失敗 , 可能是檔案格式不符合或是檔案大小超過主機上傳限制";
$myl_upload_page_no_ultperror = "檔案上傳失敗 , 檔案格式不符合";
$myl_upload_page_cut_title = "圖片裁切";
$myl_upload_page_cut_cutbtn = "裁切上傳";
$myl_upload_page_cut_nocutbtn = "直接上傳";
$myl_upload_page_cut_keyhelp = "方向鍵 : 1px , Ctrl + 方向鍵 : 10px , Shift : 移動/縮放";
$myl_upload_page_repic_msg = "圖片裁切";
$myl_upload_page_refile_msg = "回傳檔案資料";

	$folder = "./upload/tmp/";
	$allow_file = explode("_", $_GET['allow']);
	$disallow_file = explode("_", $_GET['disallow']);
	$usecut = $_GET['usecut'];
	$cmsW = (!isset($_GET['cmsw']))?96:$_GET['cmsw']; $cmsH = (!isset($_GET['cmsh']))?96:$_GET['cmsh']; //cms用大小 預設96*96
	$cutW = (!isset($_GET['cutw']))?0:$_GET['cutw']; $cutH = (!isset($_GET['cuth']))?0:$_GET['cuth']; //前台需求大小
	$lbW = (!isset($_GET['lbw']))?1000:$_GET['lbw']; $lbH = (!isset($_GET['lbh']))?550:$_GET['lbh']; //lightbox 用大小 預設 1000 或 550 取最大
	$imgW = (!isset($_GET['imgw']))?0:$_GET['imgw']; $imgH = (!isset($_GET['imgh']))?0:$_GET['imgh']; //原圖大小 預設 原寬 或 原高
	//依裁圖 強變比例 cc=前置:寬,高;前置:寬,高;前置:寬,高;
	//依原圖 強變比例 ct=前置:寬,高;前置:寬,高;前置:寬,高;
	//依裁圖 計算比例 oc=前置:寬,高;前置:寬,高;前置:寬,高;
	//依原圖 計算比例 ot=前置:寬,高;前置:寬,高;前置:寬,高;
	if($_POST['act'] == "upload"){
		if(!empty($_FILES['uploadfile']['name'])){
			$rep = returnpost($_POST);
			$file_name = mktime()."_".rand(1000,9999);
			$ext_name = ltrim(strtolower(strrchr($_FILES['uploadfile']['name'], ".")) , ".");
			$tmp_name = $_FILES['uploadfile']['tmp_name'];
			$newfilename = $file_name.".".$ext_name;
			$fileallowupload = false;
			if(empty($_GET['allow']) and empty($_GET['disallow'])){
				$fileallowupload = true;
			}elseif(isset($_GET['allow']) and in_array($ext_name , $allow_file)){
				$fileallowupload = true;
			}elseif(isset($_GET['disallow']) and !in_array($ext_name , $allow_file)){
				$fileallowupload = true;
			}
			if($fileallowupload){
				$imginfo = getimagesize($_FILES['uploadfile']['tmp_name']);
				if($imginfo[2] < 4 and !empty($imginfo[2])){
					if($usecut == 1){
						$imageWidth = $imginfo[0];
						$imageHeight = $imginfo[1];
						move_uploaded_file($tmp_name , $folder."tmp_".$newfilename);
						$step = "cutstart";
					}else{
						move_uploaded_file($tmp_name , $folder.$newfilename);
						$step = "returnImginfo";
					}
				}else{
					move_uploaded_file($tmp_name , $folder.$newfilename);
					$step = "returnFileinfo";
				}
			}else{
				$msg = array("error" , $myl_upload_page_no_ultperror);
			}
		}else{
			$msg = array("error" , $myl_upload_page_no_ulerror);
		}
	}elseif($_POST['act'] == "cutnow"){
		$rep = returnpost($_POST);
		$newfilename = $rep['newfilename'];
		$imgpath = $folder."tmp_".$newfilename;
		$imginfo = getimagesize($imgpath);
		$nowW = $imginfo[0];
		$nowH = $imginfo[1];
		$nowT = $imginfo[2];

		if(0){
			//imagemagic plus
		}else{
			//處理 cut 的圖片
			$rep['nowW'] = ($rep['nowW'] == 0)?$nowW:$rep['nowW'];
			$rep['nowH'] = ($rep['nowH'] == 0)?$nowH:$rep['nowH'];
			if($cutW == 0 and $cutH == 0){
				$newW = $rep['nowW'];
				$newH = $rep['nowH'];
			}elseif($cutW != 0 and $cutH == 0){
				$newW = $cutW;
				$newH = round($newW * $rep['nowH'] / $rep['nowW']);
			}elseif($cutW == 0 and $cutH != 0){
				$newH = $cutH;
				$newW = round($newH * $rep['nowW'] / $rep['nowH']);
			}else{
				$newW = $cutW;
				$newH = $cutH;
			}
			$srcX = $rep['nowX1']; $srcY = $rep['nowY1'];
			$creatpic = resezipic($nowT , $imgpath , $newW , $newH , $srcX , $srcY , $rep['nowW'] , $rep['nowH'] , $folder.$newfilename );
			//處理 cms 用的清單圖片
			if( $cmsW == $cutW and $cmsH == $cutH){ copy($folder.$newfilename , $folder."cms_".$newfilename); }else{
				$cutimgpath = $folder.$newfilename;
				$cutimginfo = getimagesize($cutimgpath);
				$cutnowW = $cutimginfo[0];
				$cutnowH = $cutimginfo[1];
				$cutnowT = $cutimginfo[2];
				//求出短邊後 置中裁切
				if($cutnowW > $cutnowH){ $srcW = $cutnowH; $srcH = $cutnowH; $srcX = round(($cutnowW - $srcW) / 2); $srcY = 0;
				}elseif($cutnowW < $cutnowH){ $srcW = $cutnowW; $srcH = $cutnowW; $srcX = 0; $srcY = round(($cutnowH - $srcH) / 2);
				}else{ $srcW = $cutnowW; $srcH = $cutnowH; $srcX = 0; $srcY = 0; }
				$creatpic = resezipic($cutnowT , $cutimgpath , $cmsW , $cmsH , $srcX , $srcY , $srcW , $srcH , $folder."cms_".$newfilename );
			}
			//處理 lb 用的圖片
			if( $lbW >= $nowW and $lbH >= $nowH){ copy($folder."tmp_".$newfilename , $folder."lb_".$newfilename); }else{
				if($lbW == 0){
					//如果寬為0 依高等比算出寬
					//$lbH = $lbH;
					$lbW = $nowW * $lbW / $nowH;
					$creatpic = resezipic($nowT , $imgpath , $lbW , $lbH , 0 , 0 , $nowW , $nowH , $folder."lb_".$newfilename );
				}elseif($lbH == 0){
					//如果高為0 依寬等比算出高
					$lbH = $nowH * $lbW / $nowW;;
					//$lbW = $lbW;
					$creatpic = resezipic($nowT , $imgpath , $lbW , $lbH , 0 , 0 , $nowW , $nowH , $folder."lb_".$newfilename );
				}else{
					//求出 依寬和高縮圖後 取未超過的狀況
					$tmpWH = getMinWidthHeight($nowW,$nowH,$lbW,$lbH);
					$dstW = $tmpWH[0];
					$dstH = $tmpWH[1];
					$creatpic = resezipic($nowT , $imgpath , $dstW , $dstH , 0 , 0 , $nowW , $nowH , $folder."lb_".$newfilename );
				}
			}
			//處理 img 用的圖片
			if( ($imgW == 0 and $imgH == 0) or ( $imgW >= $nowW and $imgH >= $nowH ) ){ copy($folder."tmp_".$newfilename , $folder."img_".$newfilename); }else{
				//求出 依寬和高縮圖後 取未超過的狀況
				$tmpWH = getMinWidthHeight($nowW,$nowH,$imgW,$imgH);
				$dstW = $tmpWH[0];
				$dstH = $tmpWH[1];
				$creatpic = resezipic($nowT , $imgpath , $dstW , $dstH , 0 , 0 , $nowW , $nowH , $folder."img_".$newfilename );
			}
			//依裁圖 強變比例 cc=前置:寬,高;前置:寬,高;前置:寬,高;
			if(isset($_GET['cc'])){
				$imgpath = $folder.$newfilename; $imginfo = getimagesize($imgpath); $srcW = $imginfo[0]; $srcH = $imginfo[1]; $srcT = $imginfo[2];
				$actpic = array();
				$actpic_all = explode(";", $_GET['cc']);
				foreach($actpic_all as $actpic_one){
					$actpic_one_explode = explode(":", $actpic_one); $actpic_size_explode = explode(",", $actpic_one_explode[1]);
					$actpic_name = $actpic_one_explode[0]; $actpic_size_w = $actpic_size_explode[0]; $actpic_size_h = $actpic_size_explode[1];
					$actpic[$actpic_name] = array("w" => $actpic_size_w , "h" => $actpic_size_h);
				}
				foreach($actpic as $keyname => $size){
					$creatpic = resezipic($nowT , $imgpath , $size['w'] , $size['h'] , 0 , 0 , $srcW , $srcH , $folder.$keyname."_".$newfilename );
				}
			}
			//依原圖 強變比例 ct=前置:寬,高;前置:寬,高;前置:寬,高;
			if(isset($_GET['ct'])){
				$imgpath = $folder."tmp_".$newfilename; $imginfo = getimagesize($imgpath); $srcW = $imginfo[0]; $srcH = $imginfo[1]; $srcT = $imginfo[2];
				$actpic = array();
				$actpic_all = explode(";", $_GET['ct']);
				foreach($actpic_all as $actpic_one){
					$actpic_one_explode = explode(":", $actpic_one); $actpic_size_explode = explode(",", $actpic_one_explode[1]);
					$actpic_name = $actpic_one_explode[0]; $actpic_size_w = $actpic_size_explode[0]; $actpic_size_h = $actpic_size_explode[1];
					$actpic[$actpic_name] = array("w" => $actpic_size_w , "h" => $actpic_size_h);
				}
				foreach($actpic as $keyname => $size){
					$creatpic = resezipic($nowT , $imgpath , $size['w'] , $size['h'] , 0 , 0 , $srcW , $srcH , $folder.$keyname."_".$newfilename );
				}
			}
			//依裁圖 計算比例 oc=前置:寬,高;前置:寬,高;前置:寬,高;
			if(isset($_GET['oc'])){
				$imgpath = $folder.$newfilename; $imginfo = getimagesize($imgpath); $srcW = $imginfo[0]; $srcH = $imginfo[1]; $srcT = $imginfo[2];
				$actpic = array();
				$actpic_all = explode(";", $_GET['oc']);
				foreach($actpic_all as $actpic_one){
					$actpic_one_explode = explode(":", $actpic_one); $actpic_size_explode = explode(",", $actpic_one_explode[1]);
					$actpic_name = $actpic_one_explode[0]; $actpic_size_w = $actpic_size_explode[0]; $actpic_size_h = $actpic_size_explode[1];
					$actpic[$actpic_name] = array("w" => $actpic_size_w , "h" => $actpic_size_h);
				}
				foreach($actpic as $keyname => $size){
					$minsize = getMinWidthHeight($srcW,$srcH,$size['w'],$size['h']);
					$creatpic = resezipic($nowT , $imgpath , $minsize[0] , $minsize[1] , 0 , 0 , $srcW , $srcH , $folder.$keyname."_".$newfilename );
				}
			}
			//依原圖 計算比例 ot=前置:寬,高;前置:寬,高;前置:寬,高;
			if(isset($_GET['ot'])){
				$imgpath = $folder."tmp_".$newfilename; $imginfo = getimagesize($imgpath); $srcW = $imginfo[0]; $srcH = $imginfo[1]; $srcT = $imginfo[2];
				$actpic = array();
				$actpic_all = explode(";", $_GET['ot']);
				foreach($actpic_all as $actpic_one){
					$actpic_one_explode = explode(":", $actpic_one); $actpic_size_explode = explode(",", $actpic_one_explode[1]);
					$actpic_name = $actpic_one_explode[0]; $actpic_size_w = $actpic_size_explode[0]; $actpic_size_h = $actpic_size_explode[1];
					$actpic[$actpic_name] = array("w" => $actpic_size_w , "h" => $actpic_size_h);
				}
				foreach($actpic as $keyname => $size){
					$minsize = getMinWidthHeight($srcW,$srcH,$size['w'],$size['h']);
					$creatpic = resezipic($nowT , $imgpath , $minsize[0] , $minsize[1] , 0 , 0 , $srcW , $srcH , $folder.$keyname."_".$newfilename );
				}
			}
		}
		$step = "returnImginfo";
	}
	function resezipic($imageType , $imgpath , $dstW , $dstH , $srcX , $srcY , $srcW , $srcH , $dstname ){
		if($imageType == 1){ $src = imagecreatefromgif($imgpath); }elseif($imageType == 2){ $src = imagecreatefromjpeg($imgpath); }elseif($imageType == 3){ $src = imagecreatefrompng($imgpath); }
		$dst = imagecreatetruecolor($dstW , $dstH);
		if($imageType == 3){
			imagealphablending($dst, true);
			$transparent = imagecolorallocatealpha( $dst, 0, 0, 0, 127 );
			imagefill( $dst, 0, 0, $transparent );
		}
		imagecopyresized($dst , $src , 0 , 0 , $srcX , $srcY , $dstW , $dstH , $srcW , $srcH);
		if($imageType == 3){
			imagealphablending($dst, false);
			imagesavealpha($dst,true);
		}
		if($imageType == 1){ imagegif($dst , $dstname); }elseif($imageType == 2){ imagejpeg($dst , $dstname , 100); }elseif($imageType == 3){ imagepng($dst , $dstname , 9); }
		imagedestroy($src);
		imagedestroy($dst);
		return true;
	}
	//算出最小允許值
	function getMinWidthHeight($noww,$nowh,$maxw,$maxh){
		$newWH = array();
		if($noww > $maxw){
			$neww = $maxw;
			$newh = $nowh * $maxw / $noww;
			if($newh > $maxh){
				$noww = $neww; $nowh = $newh;
				$newh = $maxh;
				$neww = $noww * $maxh / $nowh;
			}
			$newWH[0] = $neww; $newWH[1] = $newh;
		}elseif($nowh > $maxh){
			$newh = $maxh;
			$neww = $noww * $maxh / $nowh;
			if($noww > $maxw){
				$noww = $neww; $nowh = $newh;
				$neww = $maxw;
				$newh = $nowh * $maxw / $noww;
			}
			$newWH[0] = $neww; $newWH[1] = $newh;
		}else{
			$newWH[0] = $noww;
			$newWH[1] = $nowh;
		}
		$newWH[0] = round($newWH[0]);
		$newWH[1] = round($newWH[1]);
		return $newWH;
	}
?>
<?php if($step == "cutstart"){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?=$manageMeta;?>
<link rel="stylesheet" type="text/css" href="js/imgareaselect/imgareaselect-default.css" media="screen"/>
<script type="text/javascript" src="js/imgareaselect/jquery.imgareaselect.min.js"></script>
<?php include_once($managePath."showmsg.php"); ?>
<script language="javascript">
var EffectsSpeed = 300;
$(function(){
	setimgAreaSelect();
	$("input.inagearea").keyup(function() { var val = $(this).val(); var newval = val.replace(/[^\d]/g,''); $(this).val(newval); });
});
function setimgAreaSelect(){
	var cutW = $("input[name='cutW']").val()*1; var cutH = $("input[name='cutH']").val()*1; var imgW = $("input[name='imageWidth']").val()*1; var imgH = $("input[name='imageHeight']").val()*1;
	ias = $('img#uploadpic').imgAreaSelect({ aspectRatio:cutW+':'+cutH, fadeSpeed:EffectsSpeed, handles:true, imageHeight:imgH, imageWidth:imgW, instance:true, keys: { arrows: 1, ctrl: 10, shift: 'resize' } ,
		onSelectChange : function( img, selection ){ $("input[name='nowX1']").val(selection.x1); $("input[name='nowY1']").val(selection.y1); $("input[name='nowX2']").val(selection.x2); $("input[name='nowY2']").val(selection.y2); $("input[name='nowW']").val(selection.width); $("input[name='nowH']").val(selection.height); }
	});
}
function setimgAreaSelect_stop(){ ias.setOptions({ disable:true, enable:false, hide:true, remove:true }); $("input[name='nowX1']").val(0); $("input[name='nowY1']").val(0); $("input[name='nowX2']").val(0); $("input[name='nowY2']").val(0); $("input[name='nowW']").val(0); $("input[name='nowH']").val(0); ias.update(); }
function setimgAreaSelect_start(){ ias.setOptions({ disable:false, enable:true, hide:false, remove:false }); ias.setSelection(0,0,0,0); ias.update(); }
function resizebykey(){ showmsg('information','<?=$myl_upload_page_cut_keyhelp;?>'); }
function customselect(){ var x1 = $("input[name='nowX1']").val()*1; var y1 = $("input[name='nowY1']").val()*1; var x2 = $("input[name='nowX1']").val()*1 + $("input[name='nowW']").val()*1; var y2 = $("input[name='nowY1']").val()*1 + $("input[name='nowH']").val()*1; ias.setSelection(x1,y1,x2,y2); ias.setOptions({ show: true}); ias.update(); }
function defselect(){ var x2 = $("input[name='cutW']").val()*1; var y2 = $("input[name='cutH']").val()*1; ias.setSelection(0,0,x2,y2); ias.setOptions({ show: true}); ias.update(); $("input[name='nowX1']").val(0); $("input[name='nowY1']").val(0); $("input[name='nowW']").val(x2); $("input[name='nowH']").val(y2); }
function closeme(){ window.top.closeuploadiframe(); }
function zoom(mode , percent){
	setimgAreaSelect_stop();
	var rw = $("input[name='imageWidth']").val()*1;
	var rh = $("input[name='imageHeight']").val()*1;
	var zw = Math.floor(rw/10);
	var zh = Math.floor(rh/10);
	var ww = $(window).width()-80;
	var wh = Math.floor(ww*rh/rw);
	var hh = $(window).height()-120;
	var hw = Math.floor(hh*rw/rh);
	if(mode == 'zoomin'){
		$('#uploadpic').animate({ width: '+='+zw, height: '+='+zh }, EffectsSpeed, function() { });
	}else if(mode == 'zoomout'){
		$('#uploadpic').animate({ width: '-='+zw, height: '-='+zh }, EffectsSpeed, function() { });
	}else if(mode == 'windowW'){
		$('#uploadpic').animate({ width: ww, height: wh }, EffectsSpeed, function() { });
	}else if(mode == 'windowH'){
		$('#uploadpic').animate({ width: hw, height: hh }, EffectsSpeed, function() { });
	}else if(mode == 'source'){
		$('#uploadpic').animate({ width: rw, height: rh }, EffectsSpeed, function() { });
	}
	setTimeout("setimgAreaSelect_start()" , EffectsSpeed*2);
}
function checkwebform(mod){
	var tar = document.webform;
	if(mod == 1){
		tar.cancut.value = "1";
	}else{
		tar.cancut.value = "0";
	}
	tar.submit();
}
</script>
<style type="text/css">
</style>
</head>
<body>
<div class="box themed_box">
    <ul class="box-header-btn"><li class="button white"><a href="javascript:closeme();"><span class="packcolor _462"></span></a></li></ul>
    <h2 class="box-header"><p class="icons_pack"><span class="pack _215"></span></p><?=$myl_upload_page_cut_title?></h2>
    <div class="box-content box-table">
        <form name="webform" action="<?=$_SERVER['REQUEST_URI'];?>" method="post" >
        <input type="hidden" name="act" value="cutnow" />
        <input type="hidden" name="cancut" value="" />
        <input type="hidden" name="newfilename" value="<?=$newfilename;?>" />
        <input type="hidden" name="cutW" value="<?=($cutW == 0 or $cutH == 0)?0:$cutW;?>" />
        <input type="hidden" name="cutH" value="<?=($cutW == 0 or $cutH == 0)?0:$cutH;?>" />
        <input type="hidden" name="imageWidth" value="<?=$imageWidth;?>" />
        <input type="hidden" name="imageHeight" value="<?=$imageHeight;?>" />
        <input type="hidden" name="nowX2"  value="0" maxlength="4" class="form-field inagearea">
        <input type="hidden" name="nowY2"  value="0" maxlength="4" class="form-field inagearea">
    	<table class="tablebox">
            <tbody class="table-data">
                <tr><td class="tc"><img id="uploadpic" src="<?="./upload/tmp/tmp_".$newfilename;?>"  /></td></tr>
            </tbody>
        </table>
        <div id="showmsg"></div>
        <ul class="tablefooter">
        	<li><a href="javascript:zoom('source',0);" class="button themed"><span class="icon_text pack _209"></span>&nbsp;</a></li>
            <li><a href="javascript:zoom('zoomin',20);" class="button themed"><span class="icon_text pack _12"></span>&nbsp;</a></li>
            <li><a href="javascript:zoom('zoomout',20);" class="button themed"><span class="icon_text pack _11"></span>&nbsp;</a></li>
            <li><a href="javascript:zoom('windowW',0);" class="button themed"><span class="icon_text pack _259"></span>&nbsp;</a></li>
            <li><a href="javascript:zoom('windowH',0);" class="button themed"><span class="icon_text pack _260"></span>&nbsp;</a></li>
            <li><a href="javascript:;" class="button themed">X : <input type="text" name="nowX1"  value="0" maxlength="4" class="inagearea"></a></li>
            <li><a href="javascript:;" class="button themed">Y : <input type="text" name="nowY1"  value="0" maxlength="4" class="inagearea"></a></li>
            <li><a href="javascript:;" class="button themed">W : <input type="text" name="nowW"  value="0" maxlength="4" class="inagearea"></a></li>
            <li><a href="javascript:;" class="button themed">H : <input type="text" name="nowH"  value="0" maxlength="4" class="inagearea"></a></li>
            <li><a href="javascript:customselect();" class="button themed"><span class="icon_text pack _181"></span>&nbsp;</a></li>
            <li><a href="javascript:resizebykey();" class="button themed"><span class="icon_text pack _479"></span>&nbsp;</a></li>
            <li><a href="javascript:defselect();" class="button themed"><span class="icon_text pack _528"></span><?=$cutW;?> : <?=$cutH;?></a></li>
            <li><a href="javascript:checkwebform(1);" class="button green"><span class="icon_text pack _531"></span><?=$myl_upload_page_cut_cutbtn;?></a></li>
            <!--<li><a href="javascript:checkwebform(0);" class="button blood"><span class="icon_text pack _113"></span><?=$myl_upload_page_cut_nocutbtn;?></a></li>-->
        </ul>
        </form>
    </div>
</div>
</body>
</html>
<?php }elseif($step == "returnFileinfo"){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?=$manageMeta;?>
<link rel="stylesheet" type="text/css" href="js/imgareaselect/imgareaselect-default.css" media="screen"/>
<?php include_once($managePath."showmsg.php"); ?>
<script language="javascript">
function closeme(){  window.top.closeuploadiframe(); }
$(function(){
	showmsg('information' , '<?=$myl_upload_page_refile_msg;?>');
	window.top.addones( null , 're_<?=$_GET['inputname'];?>' , '<?=$newfilename;?>');
	closeme();
});
</script>
</head>
<body>
<div id="showmsg"></div>
</body>
</html>
<?php }elseif($step == "returnImginfo"){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?=$manageMeta;?>
<link rel="stylesheet" type="text/css" href="js/imgareaselect/imgareaselect-default.css" media="screen"/>
<?php include_once($managePath."showmsg.php"); ?>
<script language="javascript">
function closeme(){ window.top.closeuploadiframe(); }
$(function(){
	showmsg('information' , '<?=$myl_upload_page_repic_msg;?>');
	window.top.addones( null , 're_<?=$_GET['inputname'];?>' , '<?=$newfilename;?>');
	closeme();
});
</script>
</head>
<body>
<div id="showmsg"></div>
</body>
</html>
<?php }else{ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?=$manageMeta;?>
<link rel="stylesheet" type="text/css" href="js/imgareaselect/imgareaselect-default.css" media="screen"/>
<?php include_once($managePath."showmsg.php"); ?>
<script language="javascript">
function closeme(){ window.top.closeuploadiframe(); }
function checkwebform(){
	var tar = document.webform;
	if(tar.uploadfile.value == ""){
		showmsg('warning' , '<?=$myl_upload_page_no_nofile;?>');
	}else{
		tar.submit();
	}
}
$(function(){
});
</script>
<style type="text/css">
body table { margin:50px 0px;} #showmsg{ margin:auto;}
</style>
</head>
<body>
<div class="box themed_box">
    <ul class="box-header-btn"><li class="button white"><a href="javascript:closeme();"><span class="packcolor _462"></span></a></li></ul>
    <h2 class="box-header"><p class="icons_pack"><span class="pack _215"></span></p><?=$myl_upload_page_no_title;?></h2>
    <div class="box-content box-table">
        <form name="webform" action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="act" value="upload" />
    	<table class="tablebox">
            <tbody class="table-data">
                <tr><td class="tc"><input type="file" name="uploadfile" value="" /></td></tr>
                <tr><td class="tc"><?=$myl_upload_page_no_filetype;?><?=implode(" , ", $allow_file);?></td></tr>
            </tbody>
        </table>
        <div id="showmsg" class="width30"></div>
        <ul class="tablefooter">
            <li><a href="javascript:checkwebform();" class="button themed"><span class="icon_text pack _113"></span><?=$myl_upload_page_no_ulbtn;?></a></li>
        </ul>
        </form>
    </div>
</div>
</body>
</html>
<?php } ?>