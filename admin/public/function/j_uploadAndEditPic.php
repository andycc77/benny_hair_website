<?php
	include_once("../configs/dbconfig.php");
	include_once("../configs/manage_defaul.php");
	include_once("function.php");
	$winw = 950;
	$winh = 530;
	$maxw = ($_GET['maxw'] == "N")?$winw:$_GET['maxw'];
	$maxh = ($_GET['maxh'] == "N")?$winh:$_GET['maxh'];
	$ctrlw = ($_GET['ctrlw'] == "N")?"N":$_GET['ctrlw'];
	$ctrlh = ($_GET['ctrlh'] == "N")?"N":$_GET['ctrlh'];
	$uploadpath = "../upload/tmp/";
	$useimgareaselect = $_GET['crop'];
	$dontclose = true;
	
	if($_POST['act'] == "uploadpic"){
		$file_name = mktime();
		$file_name = $file_name."_".rand(1,9999);
		$file_subname = getFileSubName($_FILES['upic']['name']);
		$tmp_name = $_FILES['upic']['tmp_name'];
		$imageInfo = getimagesize($_FILES['upic']['tmp_name']);
		
		//保留上傳的圖片$_GET['origin']為1 或是 上傳檔案不是圖檔
		if($_GET['origin'] == 1 and ($imageInfo[2] == 1 or $imageInfo[2] == 2 or $imageInfo[2] == 3)){
			move_uploaded_file($tmp_name , $uploadpath."o_".$file_name.".".$file_subname);
			$tmp_name = $uploadpath."o_".$file_name.".".$file_subname;
		}elseif($imageInfo[2] != 1 and $imageInfo[2] != 2 and $imageInfo[2] != 3){
			move_uploaded_file($tmp_name , $uploadpath.$file_name.".".$file_subname);
			$file_name = $file_name.".".$file_subname;
			$dontclose = false;
		}
		//判斷是否為圖片和處理縮圖
		if($dontclose){
			$newWH = getNewWidthHeight($imageInfo[0],$imageInfo[1],$maxw,$maxh);
			if($newWH[0] != $imageInfo[0] or $newWH[1] != $imageInfo[1]){
				if($imageInfo[2] == 1){
					$file_name = $file_name.".gif";
					$resize = resezipic(1,$tmp_name,0,0,$newWH[0],$newWH[1],$imageInfo[0],$imageInfo[1],$uploadpath.$file_name);
				}elseif($imageInfo[2] == 2){
					$file_name = $file_name.".jpg";
					$resize = resezipic(2,$tmp_name,0,0,$newWH[0],$newWH[1],$imageInfo[0],$imageInfo[1],$uploadpath.$file_name);
				}elseif($imageInfo[2] == 3){
					$file_name = $file_name.".png";
					$resize = resezipic(3,$tmp_name,0,0,$newWH[0],$newWH[1],$imageInfo[0],$imageInfo[1],$uploadpath.$file_name);
				}
			}else{
				copy($tmp_name , $uploadpath.$file_name.".".$file_subname);
				$file_name = $file_name.".".$file_subname;
			}
		}
		unlink($_FILES['upic']['tmp_name']);
	}elseif($_POST['act'] == "myimgareaselect"){
		//保留第1次縮圖圖片
		if($_GET['origin_resize'] == 1){
			copy($uploadpath.$_POST['filename'] , $uploadpath."r_".$_POST['filename']);
		}
		//產生裁切圖
		if($_POST['dstw'] == 0 or $_POST['dsth'] == 0){
			$Infow = $_POST['imagew'];
			$Infoh = $_POST['imageh'];
			$dstx = 0;
			$dsty = 0;
		}else{
			$Infow = $_POST['dstw'];
			$Infoh = $_POST['dsth'];
			$dstx = $_POST['dstx'];
			$dsty = $_POST['dsty'];
		}
		$neww = $Infow;
		$newh = $Infoh;
		if($ctrlw != "N" and $ctrlh == "N"){
			$neww = $ctrlw;
			$newh = $Infoh * $ctrlw / $Infow;
		}elseif($ctrlw == "N" and $ctrlh != "N"){
			$newh = $ctrlh;
			$neww = $Infow * $ctrlh / $Infoh;
		}elseif($ctrlw != "N" and $ctrlh != "N"){
			$neww = $ctrlw;
			$newh = $ctrlh;
		}
		if(($ctrlw == $Infow and $ctrlh == "N") or ($ctrlw == "N" and $ctrlh == $Infoh)){
			//
		}elseif($ctrlw != "N" or $ctrlh != "N"){
			$resize = resezipic($_POST['imagetype'],$uploadpath.$_POST['filename'],$dstx,$dsty,$neww,$newh,$Infow,$Infoh,$uploadpath.$_POST['filename']);
		}
		//產生清單縮圖
		if($_GET['listw'] != "N" and $_GET['listh'] == "N"){
			$listw = $_GET['listw'];
			$listh = $newh * $_GET['listw'] / $neww;
		}elseif($_GET['listw'] == "N" and $_GET['listh'] != "N"){
			$listh = $_GET['listh'];
			$listw = $neww * $_GET['listh'] / $newh;
		}elseif($_GET['listw'] != "N" and $_GET['listh'] != "N"){
			$listw = $_GET['listw'];
			$listh = $_GET['listh'];
		}
		if($_GET['listw'] != "N" or $_GET['listh'] != "N"){
			$resize = resezipic($_POST['imagetype'],$uploadpath.$_POST['filename'],0,0,$listw,$listh,$neww,$newh,$uploadpath."l_".$_POST['filename']);
		}
		$file_name = $_POST['filename'];
		$dontclose = false;
	}
	
	//產生縮圖
	function resezipic($imageType,$tmp_name,$srcx,$srcy,$neww,$newh,$imageInfow,$imageInfoh,$uploadfile){
		if($imageType == 1){
			$src = imagecreatefromgif($tmp_name);
		}elseif($imageType == 2){
			$src = imagecreatefromjpeg($tmp_name);
		}elseif($imageType == 3){
			$src = imagecreatefrompng($tmp_name);
		}
		$dst = imagecreatetruecolor($neww , $newh);
		imagecopyresized($dst , $src , 0 , 0 , $srcx , $srcy , $neww , $newh , $imageInfow , $imageInfoh);
		if($imageType == 1){
			imagegif($dst , $uploadfile);
		}elseif($imageType == 2){
			imagejpeg($dst , $uploadfile , 100);
		}elseif($imageType == 3){
			imagepng($dst , $uploadfile , 9);
		}
		imagedestroy($src);
		imagedestroy($dst);
		return true;
	}
	//算出比例
	function getNewWidthHeight($noww,$nowh,$maxw,$maxh){
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>imgareaselect</title>
<link href="<?=$webUrl;?>css/manage.css" rel="stylesheet" type="text/css" />
<link href="<?=$webUrl;?>css/imgareaselect/imgareaselect-default.css" rel="stylesheet" type="text/css" />
<?php if($dontclose){ ?>
<script type="text/javascript" src="<?=$webUrl;?>Scripts/imgareaselect/jquery.min.js"></script>
<script type="text/javascript" src="<?=$webUrl;?>Scripts/imgareaselect/jquery.imgareaselect.min.js"></script>
<script language="javascript">
//$(document).ready(function () { $('#duck').imgAreaSelect({ x1: 80, y1: 90, x2: 100, y2: 100 }); });
//$(document).ready(function () { $('#duck').imgAreaSelect({ aspectRatio: '3:4', handles: true }); });
//$(document).ready(function () { $('#duck').imgAreaSelect({ maxWidth: 200, maxHeight: 150, handles: true }); });
//$(document).ready(function () { $('#duck').imgAreaSelect(); });
//$(document).ready(function () { $('#duck').imgAreaSelect({ aspectRatio: '400:350', handles: true }); });
$(function () {
	$('#myimgareaselect').imgAreaSelect({
		<?php if($ctrlw != "N" and $ctrlh != "N"){ ?>
		aspectRatio: '<?=$ctrlw;?>:<?=$ctrlh;?>',
		<?php } ?>
		handles: true,
		
		onSelectChange: function (img, selection) {
			$('input[name=showw]').val(selection.width);
			$('input[name=showh]').val(selection.height);
		},
		onSelectEnd: function (img, selection) {
			$('input[name=dstx]').val(selection.x1);
			$('input[name=dsty]').val(selection.y1);
			$('input[name=dstxx]').val(selection.x2);
			$('input[name=dstyy]').val(selection.y2);
			$('input[name=dstw]').val(selection.width);
			$('input[name=dsth]').val(selection.height);
		}
	});
});
</script>
<?php }elseif(!$dontclose){ ?>
<script>
window.top.divUploadPicOver('<?=$file_name;?>','<?=$_GET['inputname'];?>','<?=$_GET['has'];?>');
</script>
<?php } ?>
<script>
function checkupload(){
	var tar = document.uploadpic;
	if(tar.upic.value == ""){
		alert("<?=$myl_manage_uploadpic_error;?>");
	}else{
		tar.submit();
	}
}
</script>
<style>
body{ background-color:#FFF;}
.bodyer{ width:<?=$winw;?>px; background-color:#FFF;}
.bodyer th{ height:<?=$winh;?>px; text-align:center; vertical-align:middle; background-color:#FFF; overflow:hidden;}
.bodyer td{ text-align:center; vertical-align:middle; background-color:#FFF; overflow:hidden;}
</style>
</head>
<body>
<table class="bodyer">
	<?php if($dontclose and $_POST['act'] == "uploadpic"){ ?>
	<tr>
    	<th><img id="myimgareaselect" src="<?=$webUrl;?>/upload/tmp/<?=$file_name;?>" /></th>
    </tr>
    <tr>
    	<td><form name="useimgareaselect" class="former" action="<?=$_SERVER['REQUEST_URI'];?>" method="post">
        	<input type="hidden" name="act" value="myimgareaselect" />
            <input type="hidden" name="filename" value="<?=$file_name;?>" />
            <input type="hidden" name="imagew" value="<?=$newWH[0];?>" />
            <input type="hidden" name="imageh" value="<?=$newWH[1];?>" />
            <input type="hidden" name="imagetype" value="<?=$imageInfo[2];?>" />
            <input type="hidden" name="dstx" value="" />
            <input type="hidden" name="dsty" value="" />
            <input type="hidden" name="dstxx" value="" />
            <input type="hidden" name="dstyy" value="" />
            <input type="hidden" name="dstw" value="0" />
            <input type="hidden" name="dsth" value="0" />
            (<?=$ctrlw;?>:<?=$ctrlh;?>) , W : <input type="text" name="showw" value="0" style="width:50px; text-align:center;" readonly="readonly" /> H :<input type="text" name="showh" value="0" style="width:50px; text-align:center;" readonly="readonly" /><input type="submit" name="submit" value="<?=$myl_manage_uploadpic_useimgareaselect;?>" /> <input type="button" name="backpage" value="<?=$myl_manage_uploadpic_back;?>" onclick="javascript:window.top.divUploadPicOver('none');" />
        </form></td>
    </tr>
    <?php }else{ ?>
	<tr>
    	<th><form name="uploadpic" class="former" action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data" onsubmit="return false;">
        	<input type="hidden" name="act" value="uploadpic" />
        	<input type="file" name="upic" />
        	<input type="button" name="checkfile" value="<?=$myl_manage_uploadpic_submit;?>" onclick="checkupload();" />  <input type="button" name="backpage" value="<?=$myl_manage_uploadpic_back;?>" onclick="javascript:window.top.divUploadPicOver('none');" />
        </form></th>
    </tr>
    <tr>
    	<td>&nbsp;</td>
    </tr>
    <?php } ?>
</table>
</body>
</html>