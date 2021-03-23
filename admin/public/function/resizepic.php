<?php
//resizepic(表單名稱 , 檔案名稱 , 上傳位置 , 可上傳種類(1,2,3,4) , 新寬度 , 新高度 , 是否自動縮圖 , 資料表 , array(主鍵名 , 主鍵))
function resizepic($tmp , $pic_name , $filefolder , $filetype , $neww , $newh , $resize , $tablename , $sno){
	$picinfo = getimagesize($_FILES[$tmp]['tmp_name']);
	$oldw = $picinfo[0];
	$oldh = $picinfo[1];
	if(($oldw == $neww and $newh == 0) or ($oldh == $newh and $neww == 0)){ $resize = false; }
	if($neww == 0 and $resize){ $neww = ($picinfo[0]*$newh)/$picinfo[1]; }
	if($newh == 0 and $resize){ $newh = ($picinfo[1]*$neww)/$picinfo[0]; }
	if($picinfo[2]=="1" and in_array(1 , $filetype)){
		$pic_name .= ".gif";
		$uploadfile = $filefolder.$pic_name;
		if($resize){
			$src = imagecreatefromgif($_FILES[$tmp]['tmp_name']);
			$dst = imagecreatetruecolor($neww , $newh);
			imagecopyresized($dst , $src , 0 , 0 , 0 , 0 , $neww , $newh , $picinfo[0] , $picinfo[1]);
			imagegif($dst , $uploadfile);
		}else{
			move_uploaded_file($_FILES[$tmp]['tmp_name'], $uploadfile);
		}
	}elseif($picinfo[2]=="2" and in_array(2 , $filetype)){
		$pic_name .= ".jpg";
		$uploadfile = $filefolder.$pic_name;
		if($resize){
			$src = imagecreatefromjpeg($_FILES[$tmp]['tmp_name']);
			$dst = imagecreatetruecolor($neww , $newh);
			imagecopyresized($dst , $src , 0 , 0 , 0 , 0 , $neww , $newh , $picinfo[0] , $picinfo[1]);
			imagejpeg($dst , $uploadfile , 100);
		}else{
			move_uploaded_file($_FILES[$tmp]['tmp_name'], $uploadfile);
		}
	}elseif($picinfo[2]=="3" and in_array(3 , $filetype)){
		$pic_name .= ".png";
		$uploadfile = $filefolder.$pic_name;
		if($resize){
			$src = imagecreatefrompng($_FILES[$tmp]['tmp_name']);
			$dst = imagecreatetruecolor($neww , $newh);
			imagecopyresized($dst , $src , 0 , 0 , 0 , 0 , $neww , $newh , $picinfo[0] , $picinfo[1]);
			imagepng($dst , $uploadfile);
		}else{
			move_uploaded_file($_FILES[$tmp]['tmp_name'], $uploadfile);
		}
	}elseif($picinfo[2]=="4" or $picinfo[2]=="13" and in_array(4 , $filetype)){
		$pic_name .= ".swf";
		$uploadfile = $filefolder.$pic_name;
		move_uploaded_file($_FILES[$tmp]['tmp_name'], $uploadfile);
	}else{
		$pic_name = "";
	}
	unlink($_FILES[$tmp]['tmp_name']);
	unset($_FILES[$tmp]);
	imagedestroy($src);
	imagedestroy($dst);
	myquery(" update ".$tablename." set ".$tmp." = '".$pic_name."' where ".$sno[0]." = ".$sno[1]);
}
?>
