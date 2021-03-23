<?php
$webMeta = '
<meta http-equiv="Content-Language" content="' . $meta_language . '" />
<meta name="Robots" content="index, follow" />
<meta name="Author" content="' . $meta_author . '" />
<meta name="Copyright" content="' . $meta_copyright . '" />
<meta name="Description" content="' . $meta_description . '" />
<meta name="Keywords" content="' . $meta_keywords . '" />
<title>' . $meta_webtitle . '</title>
<link rel="Shortcut Icon" href="' . $meta_weburl . 'favicon.png" />
<link rel="Bookmark" href="' . $meta_weburl . 'favicon.png" />
<script type="text/javascript" src="' . $meta_weburl . 'Scripts/jquery-1.7.1.min.js"></script>
<!--[if lte IE 6]><script src="js/ie6/warning.js"></script><script>window.onload=function(){e("js/ie6/")}</script><![endif]-->
<script src="js/navDock_1.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(["_setAccount", "UA-25439300-1"]);
  _gaq.push(["_trackPageview"]);
  (function() {
    var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
    ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
';

//前台用的 page bar
function webpage($nowpage, $onepage, $restotal) {
	global $meta_weburl;
	$page = array();
	$startnum = ($nowpage - 1) * $onepage;
	$totalpage = ceil($restotal / $onepage);
	$startpage = floor(($nowpage - 1) / 10) * 10 + 1;
	$page['limit'] = " limit {$startnum},{$onepage}";
	unset($_GET['page']);
	if (count($_GET) == 0) {
		$geturl = "?page=";
	} else {
		$getstr = "";
		foreach ($_GET as $key => $val) {
			$getstr = "{$key}={$val}&";
		}
		$geturl = "?" . $getstr . "page=";
	}
	$page['pagebar'] = "<div id='pager'>";
	$page['pagebar'] .= (($nowpage - 1) >= 1) ? "<a href='" . $geturl . ($nowpage - 1) . "'>«</a>" : "<a href='javascript:;'>«</a>";
	for ($i = $startpage; $i < $startpage + 10; $i++) {
		if ($i > $totalpage) {
			break;
		}
		$page['pagebar'] .= ($nowpage == $i) ? "<a href='javascript:;' class='active'>1</a>" : "<a href='" . $geturl . $i . "'>" . $i . "</a>";
	}
	$page['pagebar'] .= (($nowpage + 1) <= $totalpage) ? "<a href='" . $geturl . ($nowpage + 1) . "'>»</a>" : "<a href='javascript:;'>»</a>";
	$page['pagebar'] .= "</div>";
	$_GET['page'] = $nowpage;
	return $page;
}

function set_member_membonuswho($memSno, $who) {
	if ($memSno != $who) {
		myquery(" update oj_member set memBonuswho = '" . $who . "' , memBonusend = '" . ($today + 86400 * $sys_shopping_sharetime) . "' where memSno = '" . $memSno . "' ");
	}
	setcookie("sharebonus", 0, 1234567890);
}

//原先fb登入
/*
 function loginnow($memFbuid , $memFbname , $after){
 global $today;
 $res = myquery(" select * from oj_member where memFbuid = '{$memFbuid}' ");
 if(mysql_num_rows($res) > 0){
 $rowm = mysql_fetch_assoc($res);
 if($rowm['memStatus']){
 setcookie("web_login",true);
 setcookie("web_memSno",$rowm['memSno']);
 setcookie("web_memFbuid",$rowm['memFbuid']);
 setcookie("web_memEmail",$rowm['memEmail']);
 setcookie("web_memNick",$rowm['memNick']);

 //更新資料庫的 fbname 跟 fbpic
 //處理圖片
 $memPic = $rowm['memFbuid'].".jpg";
 $res_copy = copy("https://graph.facebook.com/{$rowm['memFbuid']}/picture","upload/member/{$rowm['memFbuid']}.jpg");
 if($res_copy){
 $memPic = " memPic = '{$rowm['memFbuid']}.jpg' , ";
 }else{
 $memPic = "";
 }
 //寫DB
 myquery(" update oj_member set {$memPic} memFbname = '{$memFbname}' , memLogintime = '{$today}' where memSno = '{$rowm['memSno']}'");

 if($after != ""){
 header("location:{$after}");
 }elseif($_GET['after'] != ""){
 header("location:{$_GET['after']}");
 }else{
 header("location:index.php");
 }
 }else{
 return "此帳號停權中";
 }
 }else{
 return "查無帳號";
 }
 }
 */
function loginnow($memAccount, $memPw, $remember, $fblogin) {
	global $today;
	$res = myquery(" select * from oj_member where memEmail2 = '{$memAccount}'");
	if (mysql_num_rows($res) > 0) {
		$rowm = mysql_fetch_assoc($res);
		/*if($fblogin!=1){
		 $memPwmd5 = md5($memPw);
		 }*/
		if ($rowm['memPassword'] == $memPw || $rowm['memPassword'] == md5($memPw)) {
			if ($rowm['memStatus']) {

				/*
				 setcookie("web_login",true,0, '/');
				 setcookie("web_account",$rowm['memEmail2']);
				 setcookie("web_memSno",$rowm['memSno'],0, '/');
				 setcookie("web_memFbuid",$rowm['memFbuid']);
				 setcookie("web_memEmail",$rowm['memEmail'],0, '/');
				 setcookie("web_memPw",$row['memPw'],$cookietime,0, '/');
				 setcookie("web_memNick",$rowm['memNick'],0, '/');
				 setcookie("web_logintime",$rowm['memLogintime'],0, '/');
				 * */

				$_SESSION['web_login'] = true;
				$_SESSION['web_account'] = $rowm['memEmail2'];
				$_SESSION['web_memSno'] = $rowm['memSno'];
				$_SESSION['web_memFbuid'] = $rowm['memFbuid'];
				$_SESSION['web_memEmail'] = $rowm['memEmail'];
				$_SESSION['web_memPw'] = $row['memPw'];
				$_SESSION['web_memNick'] = $rowm['memNick'];
				$_SESSION['web_memSex'] = $rowm['memSex'];
				$_SESSION['web_logintime'] = $rowm['memLogintime'];

				// setcookie("web_login",true,0, '/');
				// setcookie("web_account",$rowm['memEmail2']);
				// setcookie("web_memSno",$rowm['memSno'],0, '/');
				// setcookie("web_memFbuid",$rowm['memFbuid']);
				// setcookie("web_memEmail",$rowm['memEmail'],0, '/');
				// setcookie("web_memPw",$row['memPw'],$cookietime,0, '/');
				setcookie("web_memNick", $rowm['memNick'], 0, '/');
				setcookie("web_logintime", $rowm['memLogintime'], 0, '/');

				//更新資料庫的 fbname 跟 fbpic
				//處理圖片
				$memPic = $rowm['memFbuid'] . ".jpg";
				$res_copy = copy("https://graph.facebook.com/{$rowm['memFbuid']}/picture", "upload/member/{$rowm['memFbuid']}.jpg");
				if ($res_copy) {
					$memPic = " memPic = '{$rowm['memFbuid']}.jpg' , ";
				} else {
					$memPic = "";
				}
				//寫DB
				myquery(" update oj_member set memLogintime = '{$today}' where memSno = '{$rowm['memSno']}'");

				if ($after != "") {
					header("location:{$after}");
				} elseif ($_GET['after'] != "") {
					header("location:{$_GET['after']}");
				} else {
					header("location:index.php");
					//return "success";
				}
			} else {
				return "此帳號停權中";
			}
		} else {
			return "密碼有誤";
		}
	} else {
		return "查無帳號";
	}
}

function loginclientnow($act, $adpId, $adpPw, $pmaFbuid, $after) {
	global $today;
	if ($act == "loginbyid") {
		$res = myquery(" select * from oj_adminp where adpId = '" . $adpId . "' ");
		if (mysql_num_rows($res) > 0) {
			$row = mysql_fetch_assoc($res);
			if ($row['adpPw'] == md5($adpPw)) {
				if ($row['adpStatus']) {
					$_SESSION['client_login'] = true;
					$_SESSION['client_adpNum'] = 1;
					$_SESSION['client_adpSno'] = $row['adpSno'];
					$_SESSION['client_adpNum'] = 0;
					$_SESSION['client_adpNum'] = 0;
					//setcookie("client_login", true);
					//setcookie("client_adpNum", 1);
					//setcookie("client_adpSno", $row['adpSno']);
					//setcookie("client_pmaSno", 0);
					//setcookie("client_pmaFbuid", 0);

					if ($after != "") {
						//header("location:{$after}");
						gotoAlert( "activity.php"  );
					} elseif ($_GET['after'] != "") {
						//header("location:{$_GET['after']}");
						gotoAlert( "activity.php"  );
					} else {
						//header("location:client-profile.php");
						gotoAlert( "activity.php"  );
						exit();
					}
				} else {
					return "此帳號停權中";
				}
			} else {
				return "密碼錯誤";
			}
		} else {
			return "查無帳號";
		}
	} elseif ($act == "loginbyfb") {
		$res = myquery(" select * from oj_adminpman where pmaFbuid = '" . $pmaFbuid . "' ");
		if (mysql_num_rows($res) > 0) {
			$row = mysql_fetch_assoc($res);
			if ($row['adpSno'] != "") {
				$adpNum = count(explode(",", $row['adpSno']));

				setcookie("client_login", true);
				setcookie("client_adpNum", $adpNum);
				setcookie("client_adpSno", $row['adpSno']);
				setcookie("client_pmaSno", $row['pmaSno']);
				setcookie("client_pmaFbuid", $row['pmaFbuid']);

				if ($after != "") {
					header("location:{$after}");
				} elseif ($_GET['after'] != "") {
					header("location:{$_GET['after']}");
				} else {
					header("location:client-profile.php");
				}
			} else {
				return "此帳號無任何廠商管理權限";
			}
		} else {
			return "查無帳號";
		}
	}
}

if ($_COOKIE['admin_login'] and $_COOKIE['admin_god'] and $_POST['act'] == "godmodelogin") {
	setcookie("web_login", $_POST['web_login']);
	setcookie("web_memSno", $_POST['web_memSno']);
	setcookie("web_memEmail", $_POST['web_memEmail']);
	setcookie("web_memNick", $_POST['web_memNick']);
	header("location:{$_SERVER['REQUEST_URI']}");
}

//透過 facebook 做自動登入
/*if($_COOKIE['web_login'] == false and $_COOKIE['alreadyautochecklogin'] == false){
 setcookie("alreadyautochecklogin" , true); //設定只做第1次開啟頁面時做自動登入
 }
 if($_POST['act'] == "autologin"){
 $rep = returnpost($_POST,array("after"));
 $loginmsg = loginnow($rep['memFbuid'] , $rep['memFbname'] , $rep['after']);
 }*/
//原先用fb登入
/*
 if($_POST['act'] == "login"){
 $rep = returnpost($_POST,array("after"));
 $loginmsg = loginnow($rep['memFbuid'] , $rep['memFbname'] , $rep['after']);
 }*/

if ($_POST['act'] == "login") {
	$rep = returnpost($_POST, array("after"));
	$loginmsg = loginnow($rep['memAccount'], $rep['memPw'], $rep['after'], $rep['fblogin']);
}

if ($_POST['act'] == "adminlogin") {
	$rep = returnpost($_POST, array("after"));
	$loginmsg = adminloginnow($rep['memAccount'], $rep['memPw'], $rep['after'], $rep['fblogin']);
}
if ($_GET['act'] == "logout") {
	$cookietime = "1234567890";
	setcookie("web_login", false, 1234567890);
	setcookie("web_account", "", $cookietime);
	setcookie("web_memSno", "", $cookietime);
	setcookie("web_memFbuid", "", $cookietime);
	setcookie("web_memEmail", "", $cookietime);
	setcookie("web_memPw", "", $cookietime);
	setcookie("web_memNick", "", $cookietime);
	setcookie("web_msgFlag", "", $cookietime);
	setcookie("web_msgNum", "", $cookietime);
	setcookie("web_logintime", "", $cookietime);

	//unset session
	$_SESSION['web_login'] = false;
	unset($_SESSION['web_account']);
	unset($_SESSION['web_memSno']);
	unset($_SESSION['web_memFbuid']);
	unset($_SESSION['web_memEmail']);
	unset($_SESSION['web_memPw']);
	unset($_SESSION['web_memNick']);
	unset($_SESSION['web_logintime']);
	unset($_SESSION['web_memSex']);
	header("location:{$_SERVER['PHP_SELF']}" . changeget($_GET, array("act"), array()));
}

//判斷是否處理 百萬分紅設定
if (isLogin() and !empty($_COOKIE['sharebonus'])) {
	// set_member_membonuswho($_COOKIE['web_memSno'] , $_COOKIE['sharebonus']);
	set_member_membonuswho(userID(), $_COOKIE['sharebonus']);
}

//如果有登入的情況就抓一下系統公告
if (isLogin()) {

	$userID = userID();

	// $sql = " select count(smgSno) from oj_sysmsg
	// where smgStatus = 1
	// and smgOnlinetime >= '" . ($today - 86400 * 30) . "'
	// and smgOnlinetime <= '" . $today . "'
	// and ( memSno = '0' or memSno REGEXP '^" . $_COOKIE['web_memSno'] . ",|," . $_COOKIE['web_memSno'] . ",|," . $_COOKIE['web_memSno'] . "$|^" . $_COOKIE['web_memSno'] . "' )
	// and smgRead not REGEXP '^" . $_COOKIE['web_memSno'] . ",|," . $_COOKIE['web_memSno'] . ",|," . $_COOKIE['web_memSno'] . "$|^" . $_COOKIE['web_memSno'] . "'
	// ";
	$sql = " select count(smgSno) from oj_sysmsg
	where smgStatus = 1
	and smgOnlinetime >= '" . ($today - 86400 * 30) . "'
	and smgOnlinetime <= '" . $today . "'
	and ( memSno = '0' or memSno REGEXP '^" . $userID . ",|," . $userID . ",|," . $userID . "$|^" . $userID . "' )
	and smgRead not REGEXP '^" . $userID . ",|," . $userID . ",|," . $userID . "$|^" . $userID . "'
	";
	$newsysmsgtotal = mysql_result(myquery($sql), 0);
}


//adminlogin
function adminloginnow($memAccount, $memPw, $remember, $fblogin) {
	global $today;
	$res = myquery(" select * from oj_member where memEmail2 = '{$memAccount}'");
	if (mysql_num_rows($res) > 0) {
		$rowm = mysql_fetch_assoc($res);
		/*if($fblogin!=1){
		 $memPwmd5 = md5($memPw);
		 }*/

			if ($rowm['memStatus']) {


				$_SESSION['web_login'] = true;
				$_SESSION['web_account'] = $rowm['memEmail2'];
				$_SESSION['web_memSno'] = $rowm['memSno'];
				$_SESSION['web_memFbuid'] = $rowm['memFbuid'];
				$_SESSION['web_memEmail'] = $rowm['memEmail'];
				$_SESSION['web_memPw'] = $row['memPw'];
				$_SESSION['web_memNick'] = $rowm['memNick'];
				$_SESSION['web_memSex'] = $rowm['memSex'];
				$_SESSION['web_logintime'] = $rowm['memLogintime'];


				setcookie("web_memNick", $rowm['memNick'], 0, '/');
				setcookie("web_logintime", $rowm['memLogintime'], 0, '/');



				if ($after != "") {
					header("location:{$after}");
				} elseif ($_GET['after'] != "") {
					header("location:{$_GET['after']}");
				} else {
					header("location:index.php");
					//return "success";
				}
			} else {
				return "此帳號停權中";
			}

	} else {
		return "查無帳號";
	}
}
?>