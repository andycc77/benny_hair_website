<?php
/*
  $tmp = "picPic";
  if(!empty($_FILES[$tmp]['name'])){
    $filefolder = "../../upload/piclog/";
    $pic_name = "{$newsno}_{$tmp}";
	$neww = 258;
	$newh = 420;
	$repicname = resizepic($tmp , $pic_name , $filefolder , $neww , $newh , false);
	myquery("update {$tablename} set {$tmp}='{$repicname}' where {$Sno} = '{$newsno}'");
  }
*/
function resizepic($tmp , $pic_name , $filefolder , $neww , $newh , $resizenow){
  $rand = rand(10 , 99);
  $picinfo = getimagesize($_FILES[$tmp]['tmp_name']);
  if($neww == 0){ $neww = ($picinfo[0]*$newh)/$picinfo[1]; }
  if($newh == 0){ $newh = ($picinfo[1]*$neww)/$picinfo[0]; }
  
  if($picinfo[2]=="1"){
    $pic_name .= "_{$rand}.gif";
	$uploadfile="{$filefolder}{$pic_name}";
	if(($picinfo[0]!=$neww or $picinfo[1]!=$newh) and $resizenow){
	  $src = imagecreatefromgif($_FILES[$tmp]['tmp_name']) or die ("cant find");
	  $dst = imagecreatetruecolor($neww , $newh) or die ("無法建立imagecreatetruecolor");
	  imagecopyresized($dst , $src , 0 , 0 , 0 , 0 , $neww , $newh , $picinfo[0] , $picinfo[1])or die ("cant make");
	  imagegif($dst , $uploadfile);
	}else{
	  move_uploaded_file($_FILES[$tmp]['tmp_name'], $uploadfile);
	}
  }elseif($picinfo[2]=="2"){
    $pic_name .= "_{$rand}.jpg";
	$uploadfile="{$filefolder}{$pic_name}";
	if(($picinfo[0]!=$neww or $picinfo[1]!=$newh) and $resizenow){
	  $src = imagecreatefromjpeg($_FILES[$tmp]['tmp_name']) or die ("cant find");
	  $dst = imagecreatetruecolor($neww , $newh) or die ("無法建立imagecreatetruecolor");
	  imagecopyresized($dst , $src , 0 , 0 , 0 , 0 , $neww , $newh , $picinfo[0] , $picinfo[1])or die ("cant make");
	  imagejpeg($dst , $uploadfile , 100);
	}else{
	  move_uploaded_file($_FILES[$tmp]['tmp_name'], $uploadfile);
	}
  }elseif($picinfo[2]=="3"){
    $pic_name .= "_{$rand}.png";
	$uploadfile="{$filefolder}{$pic_name}";
	if(($picinfo[0]!=$neww or $picinfo[1]!=$newh) and $resizenow){
	  $src = imagecreatefrompng($_FILES[$tmp]['tmp_name']) or die ("cant find");
	  $dst = imagecreatetruecolor($neww , $newh) or die ("無法建立imagecreatetruecolor");
	  imagecopyresized($dst , $src , 0 , 0 , 0 , 0 , $neww , $newh , $picinfo[0] , $picinfo[1])or die ("cant make");
	  imagepng($dst , $uploadfile);
	}else{
	  move_uploaded_file($_FILES[$tmp]['tmp_name'], $uploadfile);
	}
  }elseif($picinfo[2]=="4" or $picinfo[2]=="13"){
	$pic_name .= "_{$rand}.swf";
	$uploadfile="{$filefolder}{$pic_name}";
	move_uploaded_file($_FILES[$tmp]['tmp_name'], $uploadfile);
  }else{
    $pic_name = "die.jpg";
  }
  imagedestroy($src);
  imagedestroy($dst);
  return $pic_name;
}


/*
$rand = mktime();
		$tmp = "vcrPic";
		for($i=0; $i<count($_FILES[$tmp]['name']); $i++){
			if(!empty($_FILES[$tmp]['name'][$i])){
				$pic_name = "s{$newsno}_".($rand+$i);
				$neww = 200;
				$newh = 0;
				$repicname = PZresizepic($tmp , $i , $pic_name , $filefolder , $neww , $newh , true);
			}
			if(!empty($_FILES[$tmp]['name'][$i])){
				$pic_name = "{$newsno}_".($rand+$i);
				$neww = 0;
				$newh = 0;
				$repicname = PZresizepic($tmp , $i , $pic_name , $filefolder , $neww , $newh , false);
				myquery("insert into {$dbt}news_pic set newSno = '{$newsno}' , newpPic = '{$repicname}' , newpAz = '".($rand+$i)."' ");
			}
		}
		*/


function PZresizepic($tmp , $i , $pic_name , $filefolder , $neww , $newh , $resizenow){
  $picinfo = getimagesize($_FILES[$tmp]['tmp_name'][$i]);
  if($neww == 0){ $neww = ($picinfo[0]*$newh)/$picinfo[1]; }
  if($newh == 0){ $newh = ($picinfo[1]*$neww)/$picinfo[0]; }
  if($picinfo[2]=="1"){
    $pic_name .= ".gif";
	$uploadfile="{$filefolder}{$pic_name}";
	if(($picinfo[0]!=$neww or $picinfo[1]!=$newh) and $resizenow){
	  $src = imagecreatefromgif($_FILES[$tmp]['tmp_name'][$i]);
	  $dst = imagecreatetruecolor($neww , $newh);
	  imagecopyresized($dst , $src , 0 , 0 , 0 , 0 , $neww , $newh , $picinfo[0] , $picinfo[1]);
	  imagegif($dst , $uploadfile);
	}else{
	  move_uploaded_file($_FILES[$tmp]['tmp_name'][$i], $uploadfile);
	}
  }elseif($picinfo[2]=="2"){
    $pic_name .= ".jpg";
	$uploadfile="{$filefolder}{$pic_name}";
	if(($picinfo[0]!=$neww or $picinfo[1]!=$newh) and $resizenow){
	  $src = imagecreatefromjpeg($_FILES[$tmp]['tmp_name'][$i]);
	  $dst = imagecreatetruecolor($neww , $newh);
	  imagecopyresized($dst , $src , 0 , 0 , 0 , 0 , $neww , $newh , $picinfo[0] , $picinfo[1]);
	  imagejpeg($dst , $uploadfile , 100);
	}else{
	  move_uploaded_file($_FILES[$tmp]['tmp_name'][$i], $uploadfile);
	}
  }elseif($picinfo[2]=="3"){
    $pic_name .= ".png";
	$uploadfile="{$filefolder}{$pic_name}";
	if(($picinfo[0]!=$neww or $picinfo[1]!=$newh) and $resizenow){
	  $src = imagecreatefrompng($_FILES[$tmp]['tmp_name'][$i]);
	  $dst = imagecreatetruecolor($neww , $newh);
	  imagecopyresized($dst , $src , 0 , 0 , 0 , 0 , $neww , $newh , $picinfo[0] , $picinfo[1]);
	  imagepng($dst , $uploadfile);
	}else{
	  move_uploaded_file($_FILES[$tmp]['tmp_name'][$i], $uploadfile);
	}
  }else{
    $pic_name = "die.gif";
  }
  imagedestroy($src);
  imagedestroy($dst);
  return $pic_name;
}	
/*
		$tmp = "picPic";
		if(!empty($_FILES[$tmp]['name'])){
			$rand = mktime();
			$pic_name = "{$tmp}_{$rand}_{$newsno}";
			$neww = 174;
			$newh = 115;
			$repicname = resizepic($tmp , $pic_name , $filefolder , $neww , $newh , true);
			myquery("update {$tablename} set {$tmp}='{$repicname}' where {$Sno} = '{$newsno}'");
		}
*/
function resizepic($tmp , $pic_name , $filefolder , $neww , $newh , $resizenow){
  $picinfo = getimagesize($_FILES[$tmp]['tmp_name']);
  if($neww == 0){ $neww = ($picinfo[0]*$newh)/$picinfo[1]; }
  if($newh == 0){ $newh = ($picinfo[1]*$neww)/$picinfo[0]; }
  
  if($picinfo[2]=="1"){
    $pic_name .= ".gif";
	$uploadfile="{$filefolder}{$pic_name}";
	if(($picinfo[0]!=$neww or $picinfo[1]!=$newh) and $resizenow){
	  $src = imagecreatefromgif($_FILES[$tmp]['tmp_name']) or die ("cant find");
	  $dst = imagecreatetruecolor($neww , $newh) or die ("無法建立imagecreatetruecolor");
	  imagecopyresized($dst , $src , 0 , 0 , 0 , 0 , $neww , $newh , $picinfo[0] , $picinfo[1])or die ("cant make");
	  imagegif($dst , $uploadfile);
	}else{
	  move_uploaded_file($_FILES[$tmp]['tmp_name'], $uploadfile);
	}
  }elseif($picinfo[2]=="2"){
    $pic_name .= ".jpg";
	$uploadfile="{$filefolder}{$pic_name}";
	if(($picinfo[0]!=$neww or $picinfo[1]!=$newh) and $resizenow){
	  $src = imagecreatefromjpeg($_FILES[$tmp]['tmp_name']) or die ("cant find");
	  $dst = imagecreatetruecolor($neww , $newh) or die ("無法建立imagecreatetruecolor");
	  imagecopyresized($dst , $src , 0 , 0 , 0 , 0 , $neww , $newh , $picinfo[0] , $picinfo[1])or die ("cant make");
	  imagejpeg($dst , $uploadfile , 100);
	}else{
	  move_uploaded_file($_FILES[$tmp]['tmp_name'], $uploadfile);
	}
  }elseif($picinfo[2]=="3"){
    $pic_name .= ".png";
	$uploadfile="{$filefolder}{$pic_name}";
	if(($picinfo[0]!=$neww or $picinfo[1]!=$newh) and $resizenow){
	  $src = imagecreatefrompng($_FILES[$tmp]['tmp_name']) or die ("cant find");
	  $dst = imagecreatetruecolor($neww , $newh) or die ("無法建立imagecreatetruecolor");
	  imagecopyresized($dst , $src , 0 , 0 , 0 , 0 , $neww , $newh , $picinfo[0] , $picinfo[1])or die ("cant make");
	  imagepng($dst , $uploadfile);
	}else{
	  move_uploaded_file($_FILES[$tmp]['tmp_name'], $uploadfile);
	}
  }elseif($picinfo[2]=="4" or $picinfo[2]=="13"){
	$pic_name .= ".swf";
	$uploadfile="{$filefolder}{$pic_name}";
	move_uploaded_file($_FILES[$tmp]['tmp_name'], $uploadfile);
  }else{
    $pic_name = "die.jpg";
  }
  imagedestroy($src);
  imagedestroy($dst);
  return $pic_name;
}
?>