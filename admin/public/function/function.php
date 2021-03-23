<?php //中



$basename = basename($_SERVER['PHP_SELF']);
$today = getmk();

//記錄admin動作
function w_action($logDo, $logWho, $admSno) {
	$logWho = (isset($logWho)) ? $logWho : $_SESSION['admin_admId'];
	if (isset($admSno)) {
		//$admSno = $admSno;
	} elseif (isset($_SESSION['admin_admSno'])) {
		$admSno = $_SESSION['admin_admSno'];
	} else {
		$admSno = 0;
	}
	$logMk = getmk();
	$sql = "insert into oj_adminlog set
	logMk = '" . $logMk . "' ,
	logIp = '" . $_SERVER['REMOTE_ADDR'] . "' ,
	admSno = '" . $admSno . "' ,
	logWho = '" . $logWho . "' ,
	logDo = '" . $logDo . "' ,
	logTime = '" . date("Y-m-d H:i:s", $logMk) . "' ";
	myquery($sql);
}

//記錄email失敗 : 頁面路徑 , 錯誤訊息 , 其它文字內容
function w_emailerror($errPage, $errError, $errOther) {
	global $today;
	$sql = " insert into oj_emailerror set errTime = '" . $today . "' , errTimes = '" . date("Y-m-d H:i:s", $today) . "' , errPage = '" . $errPage . "' , errError = '" . $errError . "' , errOther = '" . $errOther . "' ";
	myquery($sql);
}

//存檔用的文字處理
function savetxtact($txt) {
	$txt = addcslashes($txt, "\\");
	$txt = addcslashes($txt, "\\");
	$txt = addcslashes($txt, "'");
	$txt = addcslashes($txt, "'");
	return $txt;
}

//查看頁面權限
function checkpower($md, $url) {
	global $jellydev;
	if (!$jellydev) {
		global $rootPath;
		global $managePath;
		global $cms_cmsUrl;
		$hasmd = (isset($md) and !is_null($md) and $md != "") ? true : false;
		$hasurl = (isset($url) and !is_null($url)) ? true : false;
		// if (isset($_COOKIE['admin_login']) and isset($_COOKIE['admin_admSno'])) {
		if (isAdminLogin()) {
			if ($hasmd) {
				// $admin = mysql_fetch_assoc(myquery("select admPower from oj_admin where admSno = '{$_COOKIE['admin_admSno']}'"));
				$admin = mysql_fetch_assoc(myquery("select admPower from oj_admin where admSno = '".adminID()."'"));
				$admPower = explode(",", $admin['admPower']);
				if (in_array($md, $admPower)) {
					return true;
				} else {
					if ($hasurl) {
						if ($url != "") {
							header("location:" . $url);
						} else {
							header("location:" . $managePath . "nopower.php");
						}
					} else {
						return false;
					}
				}
			} else {
				//因為不知道要檢查什麼,所以不做事
			}
		} else {
			header("location:" . $managePath . "index.php?act=godie");
		}
	} else {
		return true;
	}
}

//查看頁面權限
function checkvippower($md, $url) {
	global $jellydev;
	if (!$jellydev) {
		return true;
		/*
		 global $rootPath; global $managePath; global $cms_cmsUrl;
		 $hasmd = (isset($md) and !is_null($md) and $md != "")?true:false;
		 $hasurl = (isset($url) and !is_null($url))?true:false;
		 if(isset($_COOKIE['vip_login']) and isset($_COOKIE['vip_admSno'])){
		 if($hasmd){
		 $admin = mysql_fetch_assoc(myquery("select admPower from oj_adminp where adpSno = '{$_COOKIE['vip_adpSno']}'"));
		 $admPower = explode(",", $admin['admPower']);
		 if(in_array($md , $admPower)){
		 return true;
		 }else{
		 if($hasurl){
		 if($url != ""){
		 header("location:".$url);
		 }else{
		 header("location:".$managePath."nopower.php");
		 }
		 }else{
		 return false;
		 }
		 }
		 }else{
		 //因為不知道要檢查什麼,所以不做事
		 }
		 }else{
		 header("location:".$managePath."index.php?act=godie");
		 }*/
	} else {
		return true;
	}
}

//校時
function getmk($H = 0, $i = 0, $s = 0, $m = 0, $d = 0, $Y = 0) {
	//時差 台灣是 8
	/* */
	$othercounty = 8;
	$gmtime = strtotime(gmdate("Y-m-d H:i:s"));
	$gy = date("Y", $gmtime);
	$gm = date("m", $gmtime);
	$gd = date("d", $gmtime);
	$gh = date("H", $gmtime);
	$gi = date("i", $gmtime);
	$gs = date("s", $gmtime);
	$retime = mktime($gh + $H + $othercounty, $gi + $i, $gs + $s, $gm + $m, $gd + $d, $gy + $Y);

	/*
	 $retime = mktime();
	 */
	return $retime;
}

//裁切字串 中
function cut_str($subject, $strlen, $killhtml) {
	if (!extension_loaded('mbstring')) {
		dl("mbstring.so");
	}
	if ($killhtml) {
		$subject = strip_tags($subject);
	}
	if (function_exists('mb_substr')) {
		$newstr = mb_substr($subject, 0, $strlen, "UTF8");
		if (mb_strlen($subject, 'UTF-8') > $strlen) {
			$newstr .= '...';
		}
	}
	return $newstr;
}

//裁切字串 英
function cut_str_en($subject, $strlen, $killhtml) {
	if ($killhtml) {
		$subject = strip_tags($subject);
	}
	$num = strlen($subject);
	$newstr = ($num > $strlen) ? substr($subject, 0, $strlen) . " ..." : $subject;
	return $newstr;
}

//去html < > 和處理衝碼字
function returnpost($post, $nohtml, $noaddsla) {
	foreach ($post as $key => $val) {
		if (!is_array($val) and !in_array($key, $nohtml)) {
			$post[$key] = htmlspecialchars($val, ENT_QUOTES);
		} elseif (is_array($val)) {
			foreach ($val as $key2 => $val2) {
				if (!is_array($val2) and !in_array($key2, $nohtml)) {
					$post[$key][$key2] = htmlspecialchars($val2, ENT_QUOTES);
				} elseif (is_array($val2)) {
					foreach ($val2 as $key3 => $val3) {
						if (!in_array($key3, $nohtml)) {
							$post[$key][$key2][$key3] = htmlspecialchars($val3, ENT_QUOTES);
						} else {
							//$post[$key][$key2][$key3] = $val3;
						}
					}
				} else {
					//$post[$key][$key2] = $val2;
				}
			}
		} else {
			//$post[$key] = $val;
		}
	}
	if (!get_magic_quotes_gpc()) {
		foreach ($post as $key => $val) {
			if (!is_array($val) and !in_array($key, $noaddsla)) {
				$post[$key] = addslashes($val);
			} elseif (is_array($val)) {
				foreach ($val as $key2 => $val2) {
					if (!is_array($val) and !in_array($key, $noaddsla)) {
						$post[$key][$key2] = addslashes($val2);
					} elseif (is_array($val2)) {
						foreach ($val2 as $key3 => $val3) {
							if (!in_array($key3, $noaddsla)) {
								$post[$key][$key2][$key3] = addslashes($val3);
							} else {
								//$post[$key][$key2][$key3] = $val3;
							}
						}
					} else {
						//$post[$key][$key2] = $val2;
					}
				}
			} else {
				//$post[$key] = $val;
			}
		}
	}
	return $post;
}

//去掉指定的 get 變數
function delget($get, $del) {
	$reget = $get;
	foreach ($del as $val) {
		unset($reget[$val]);
	}
	foreach ($reget as $key => $val) {
		$reget_a[] = "{$key}={$val}";
	}
	if (count($reget_a) == 0) {
		$reget_s = "";
	} else {
		$reget_s = "?" . implode("&", $reget_a);
	}
	return $reget_s;
}

//處理 get 產生新的字串 : 目前的$_GET , 要殺的只代變數名 array("aaa","bbb") , 要加的變數名+值 array("aaa"=>"111"))
function changeget($get = array(), $del = array(), $add = array()) {
	$get_a = array();
	$arr = array_merge($get, $add);
	foreach ($arr as $key => $val) {
		if (!in_array($key, $del)) { $get_a[] = "{$key}={$val}";
		}
	}
	if (count($get_a) == 0) { $get_s = "";
	} else { $get_s = "?" . implode("&", $get_a);
	}
	return $get_s;
}

//處理 get 只留特定值 : 目前的$_GET , 要留的只代變數名 array("aaa","bbb")
function filterget($get = array(), $need = array()) {
	$get_a = array();
	foreach ($get as $key => $val) {
		if (in_array($key, $need)) { $get_a[] = "{$key}={$val}";
		}
	}
	if (count($get_a) == 0) { $get_s = "";
	} else { $get_s = "?" . implode("&", $get_a);
	}
	return $get_s;
}

//後台用的 page bar
function managepage($nowpage, $onepage, $restotal) {
	global $myl_list_page_first;
	global $myl_list_page_prev;
	global $myl_list_page_next;
	global $myl_list_page_last;
	global $myl_list_page_info1;
	global $myl_list_page_info2;
	global $myl_list_page_info3;
	global $myl_list_page_info4;
	$page = array();
	if (strtolower($onepage) != "all") {
		$strlimit = ($nowpage - 1) * $onepage;
		$firstinfo = ($nowpage - 1) * $onepage + 1;
		$totalpage = ceil($restotal / $onepage);
		$startpage = floor(($nowpage - 1) / 10) * 10 + 1;
		$lastinfo = $firstinfo + $onepage - 1;
		$lastinfo = ($restotal < $lastinfo) ? $restotal : $lastinfo;
		$page['limit'] = " limit {$strlimit},{$onepage}";
	} else {
		$firstinfo = 1;
		$totalpage = 1;
		$lastinfo = $restotal;
		$page['limit'] = "";
	}
	$getstr = "";
	foreach ($_GET as $key => $val) {
		if ($key == "page") {
			continue;
		}
		$getstr .= "{$key}={$val}&";
	}
	$geturl = "?" . $getstr . "page=";
	if ($restotal > 0) {
		$page['pagebar'] = '<ul class="pagination">';
		$page['pagebar'] .= '<li class="info">' . $myl_list_page_info1 . ' ' . $firstinfo . ' ' . $myl_list_page_info2 . ' ' . $lastinfo . ' ' . $myl_list_page_info3 . ' ' . $restotal . ' ' . $myl_list_page_info4 . '</li>';
		$page['pagebar'] .= ($nowpage != 1) ? '<li><a href="' . $_SERVER['PHP_SELF'] . $geturl . '1" class="button white">' . $myl_list_page_first . '</a></li>' : '';
		$page['pagebar'] .= ($nowpage > 1) ? '<li><a href="' . $_SERVER['PHP_SELF'] . $geturl . ($nowpage - 1) . '" class="button white">' . $myl_list_page_prev . '</a></li>' : '';
		for ($i = $startpage; $i < $startpage + 10; $i++) {
			if ($i > $totalpage) {
				break;
			}
			$page['pagebar'] .= ($nowpage != $i) ? '<li><a href="' . $_SERVER['PHP_SELF'] . $geturl . $i . '" class="button white">' . $i . '</a></li>' : '<li><a href="javascript:;" class="button white active">' . $i . '</a></li>';
		}
		$page['pagebar'] .= ($nowpage < $totalpage) ? '<li><a href="' . $_SERVER['PHP_SELF'] . $geturl . ($nowpage + 1) . '" class="button white">' . $myl_list_page_next . '</a></li>' : '';
		$page['pagebar'] .= ($nowpage != $totalpage) ? '<li><a href="' . $_SERVER['PHP_SELF'] . $geturl . $totalpage . '" class="button white">' . $myl_list_page_last . '</a></li>' : '';
		$page['pagebar'] .= '</ul>';
	} else {
		$page['pagebar'] = '';
	}
	return $page;
}

function is_orderme($who) {
	global $modelId;
	if ($_SESSION['search'][$modelId]['Sorder'] == $who) {
		if ($_SESSION['search'][$modelId]['Sascdesc'] == "asc") {
			return "orderasc";
		} else {
			return "orderdesc";
		}
	}
}

function is_orderweb($who) {
	global $modelId;
	if ($_SESSION['search'][$modelId]['Sorder'] == "") {
		return "ordersameweb";
	} else {
		return "orderreset";
	}
}

//刪除30分鐘外的檔案
function DelTmpPic() {
	$filepath = "../../upload/tmp/";
	$dir = scandir($filepath);
	unset($dir[0]);
	unset($dir[1]);
	$now = mktime();
	$now -= 60 * 60 * 12;
	foreach ($dir as $val) {
		preg_match('/\d{10}/', $val, $filetime);
		if ($filetime[0] < $now) {
			unlink($filepath . $val);
		}
	}
}

//取得檔案所在資料夾
function getFileFolder($url) {
	$filename_array = explode(".", $str);
	if (empty($nameORsub)) {
		$re = strtolower($filename_array[count($filename_array) - 1]);
		return $re;
	} else {
		unset($filename_array[count($filename_array) - 1]);
		$re = implode(".", $filename_array);
		return $re;
	}
}

//產生不重複值的陣列
function randarray($min, $max, $length) {
	$newarray = array();
	do {
		$newval = rand($min, $max);
		if (!in_array($newval, $newarray)) {
			$newarray[] = $newval;
		}
	} while(count($newarray) < $length);
	return $newarray;
}

//刪掉array為 空的值
function cleararraynull($val) {
	if ($val == "" or $val == NULL) {
		return false;
	} else {
		return true;
	}
}

//找出執行目錄所在位置
function whereiam() {
	$wheredir = dirname($_SERVER['PHP_SELF']);
	$where = array();
	if (preg_match("/manage/", $wheredir)) {
		$where['webset'] = "../../upload/webset/";
		$where['upload'] = "../../upload/";
	} else {
		$where['webset'] = "./upload/webset/";
		$where['upload'] = "./upload/";
	}
	return $where;
}

//儲存暫存檔 , sql語句 , 資料表名 不帶 oj_ , array(索引,索引) , 需要的欄位(可空) , 不要的欄位(可空) , 檔名關鍵字(可空) , 資料夾(可空)
function saveWebsetTxt($sql, $tablename, $index, $in_filed, $out_filed, $keyw, $folder) {
	global $websetfolder;
	$websettxt = "";
	$keyw = (empty($keyw)) ? "w" : $keyw;
	if (!empty($folder)) {

	} else {
		$folder = whereiam();
	}
	if (is_array($in_filed) and count($in_filed) > 0) { $check_in = true;
	} else { $check_in = false;
	}

	$res = myquery($sql);
	while ($row = mysql_fetch_assoc($res)) {
		$one_row = array();
		$index_row = array();
		foreach ($row as $key => $val) {
			$val = savetxtact($val);
			if (($check_in and in_array($key, $in_filed)) or (!$check_in and !in_array($key, $out_filed))) {
				$one_row[] = "'{$key}'=>'{$val}'";
			}
		}
		foreach ($index as $key) {
			$index_row[] = "['" . $row[$key] . "']";
		}
		$websettxt .= "\$tmp_" . $keyw . "_" . $tablename . implode("", $index_row) . " = array( " . implode(",", $one_row) . " ); \n";
	}
	$websettxt = "<?php //中 \n" . $websettxt . "?>";
	$fp = fopen($folder['webset'] . $tablename . "_" . $keyw . "_sql.php", "w");
	$websettxt = stripslashes($websettxt);
	fwrite($fp, $websettxt);
	fclose($fp);
}

//==============================================================================================================================================================================================

//新增會員資料
function add_member($pagename, $info) {
	global $today;
	$act_status = array();
	$rep = returnpost($info);
	$canadd = checkmemberinfo($rep['account'], $rep['memEmail'], $rep['memFbuid'], "");
	$act_status[0] = $canadd;
	//可否處理資料存在索引 0
	$act_status['account'] = "帳號已經被使用";
	//說明欄位處理失敗原因
	$act_status['memEmail'] = "facebook 帳號已經被使用";
	$act_status['memFbuid'] = "facebook 帳號已經被使用";

	//php 多重簡察預設值
	if ($rep['account'] == "user@urbonus.com") { $canadd = false;
		$act_status['account'] = "此帳號無效";
	}
	if ($rep['memEmail'] == "") { $canadd = false;
		$act_status['memEmail'] = "Email欄位為必填";
	}
	if ($rep['memPw'] == "") { $canadd = false;
		$act_status['memEmail'] = "password欄位為必填";
	}
	if ($rep['memPw'] == "") { $rep['memPw'] = md5($today);
	} else { $rep['memPw'] = md5($rep['memPw']);
	}
	if ($rep['memFbuid'] == "") { $canadd = false;
		$act_status['memFbuid'] = "facebook 欄位為必填";
	}
	if ($rep['memFbname'] == "") { $rep['memFbname'] = "";
	}
	if ($rep['memFbfans'] == "") { $rep['memFbfans'] = "0";
	}
	//處理圖片
	$memPic = $rep['memFbuid'] . ".jpg";
	$res_copy = copy("https://graph.facebook.com/{$rep['memFbuid']}/picture", "upload/member/{$memPic}");
	if ($res_copy) {
		$rep['memPic'] = $memPic;
	} else {
		$rep['memPic'] = "";
	}
	if ($rep['memUid'] == "") { $rep['memUid'] = "";
	}
	if ($rep['memName'] == "") { $rep['memName'] = $rep['memFbname'];
	}
	if ($rep['memNick'] == "") { $rep['memNick'] = $rep['memFbname'];
	}
	if ($rep['memSex'] == "male" or $rep['memSex'] == "1") { $rep['memSex'] = "1";
	} elseif ($rep['memSex'] == "female" or $rep['memSex'] == "2") { $rep['memSex'] = "2";
	} else { $rep['memSex'] = "0";
	}
	if ($rep['memCellNum'] == "") { $rep['memCellNum'] = "";
	}
	if ($rep['memHtelbef'] == "") { $rep['memHtelbef'] = "";
	}
	if ($rep['memHtel'] == "") { $rep['memHtel'] = "";
	}
	if ($rep['memBirth'] == "") { $rep['memBirth'] = "0";
		$rep['memBy'] = 0;
		$rep['memBm'] = 0;
		$rep['memBd'] = 0;
	} else { $rep['memBirth'] = strtotime($rep['memBirth']);
		$rep['memBy'] = date("Y", $rep['memBirth']);
		$rep['memBm'] = date("m", $rep['memBirth']);
		$rep['memBd'] = date("d", $rep['memBirth']);
	}
	if ($rep['memZip'] == "") { $rep['memZip'] = "";
	}
	if ($rep['memCity'] == "") { $rep['memCity'] = "";
	}
	if ($rep['memArea'] == "") { $rep['memArea'] = "";
	}
	if ($rep['memAddress'] == "") { $rep['memAddress'] = "";
	}
	if ($rep['memEpaper'] == "") { $rep['memEpaper'] = "1";
	}
	if ($rep['memBonus'] == "") { $rep['memBonus'] = "0";
	}
	if ($rep['memBonuswho'] == "") { $rep['memBonuswho'] = "0";
	}
	if ($rep['memBonusend'] == "") { $rep['memBonusend'] = "0";
	}
	if ($rep['memStatus'] == "") { $rep['memStatus'] = "1";
	}
	if (empty($rep['memLogintime'])) { $rep['memLogintime'] = "0";
	}
	if (empty($rep['memModtime'])) { $rep['memModtime'] = "0";
	}
	if (empty($rep['memAddtime'])) { $rep['memAddtime'] = $today;
	}
	if (empty($rep['memPs'])) { $rep['memPs'] = date("Y-m-d H:i:s", $today) . " : 由 " . $pagename . " 頁面新增會員";
	}
	if (empty($rep['memAutoupdate'])) { $rep['memAutoupdate'] = $today;
	}

	if ($canadd) {
		$sql = " insert into oj_member set
		memEmail = '" . $rep['memEmail'] . "' ,
		memEmail2 = '" . $rep['account'] . "' ,
		memPassword = '" . $rep['memPw'] . "' ,
		memFbuid = '" . $rep['memFbuid'] . "' ,
		memFbname = '" . $rep['memFbname'] . "' ,
		memFbfans = '" . $rep['memFbfans'] . "' ,
		memPic = '" . $rep['memPic'] . "' ,
		memUid = '" . $rep['memUid'] . "' ,
		memName = '" . $rep['memName'] . "' ,
		memNick = '" . $rep['memNick'] . "' ,
		memSex = '" . $rep['memSex'] . "' ,
		memGsm = '" . $rep['memCellNum'] . "' ,
		memHtelbef = '" . $rep['memHtelbef'] . "' ,
		memHtel = '" . $rep['memHtel'] . "' ,
		memBirth = '" . $rep['memBirth'] . "' ,
		memBy = '" . $rep['memBy'] . "' ,
		memBm = '" . $rep['memBm'] . "' ,
		memBd = '" . $rep['memBd'] . "' ,
		memCountry = '" . $rep['memCountry'] . "',
		memZip = '" . $rep['memZip'] . "' ,
		memCity = '" . $rep['memCity'] . "' ,
		memArea = '" . $rep['memArea'] . "' ,
		memAddress = '" . $rep['memAddress'] . "' ,
		memEpaper = '" . $rep['memEpaper'] . "' ,
		memBonus = '" . $rep['memBonus'] . "' ,
		memBonuswho = '" . $rep['memBonuswho'] . "' ,
		memBonusend = '" . $rep['memBonusend'] . "' ,
		memStatus = '" . $rep['memStatus'] . "' ,
		memLogintime = '" . $rep['memLogintime'] . "' ,
		memModtime = '" . $rep['memModtime'] . "' ,
		memAddtime = '" . $rep['memAddtime'] . "' ,
		memPs = '" . $rep['memPs'] . "' ,
		memAutoupdate = '" . $rep['memAutoupdate'] . "' ";
		myquery($sql);
		$memSno = mysql_insert_id();
		if($rep['searchmem']){
			insert_bonuslog($memSno,"oj_event",111,7 , $rep['memAddtime'] ,'好友推荐加入紅利通');
			insert_bonuslog($rep['searchmem'],"oj_event",111,3 , $rep['memAddtime'] ,'推荐好友加入紅利通');
		}
		update_member_statistics($memSno);
		//更新會員統計數據
		$act_status[0] = true;
		$act_status['memSno'] = $memSno;
		//寄送新會員通知信
		$act_status['memSno'] = $memSno;
		$memNick= $rep['memNick'];
		$memAddtime = date("Y-m-d",$rep['memAddtime']);
		$memBonus = $rep['memBonus'];
		$memEmail = $rep['account'];
		$url ="../upload/webset/welcome_sql.php";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://www.urbonus.com/function/sendmail_model.php");
		curl_setopt($ch, CURLOPT_POST, true); // 啟用POST
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( array( "memNick"=>$memNick, "memAddtime"=>$memAddtime,"memBonus"=>$memBonus,"memEmail"=>$memEmail,"url"=>$url) ));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$returnText = curl_exec($ch);
		curl_close($ch);
		return $act_status;
	} else {
		//return $act_status;
		gotoAlert( "welcome.php", "此帳號已被使用，請檢查您輸入的電子郵箱或是Facebook帳號是否正確" );
	}
}

//修改會員資料
function mod_member($pagename, $info) {
	global $today;
	$act_status = array();
	$rep = returnpost($info);
	if ($_SESSION['web_memSno'] != "" and $_SESSION['web_memFbuid'] != "" and $_SESSION['web_memEmail'] != "") {
		$canact = true;
	} else {
		$canact = false;
	}
	$act_status[0] = $canact;
	//可否處理資料存在索引 0
	$updatedata = array();
	//php 多重簡察預設值
	//if($rep['memEmail'] == ""){ $canadd = false; $act_status['memEmail'] = "Email欄位為必填"; }
	//if($rep['memPw'] == ""){ $rep['memPw'] = md5($today); }
	//if($rep['memFbuid'] == ""){ $canadd = false; $act_status['memFbuid'] = "facebook 欄位為必填"; }
	//if($rep['memFbname'] == ""){ $rep['memFbname'] = "紅利王會員"; }
	if ($rep['memFbfans'] == "") { $rep['memFbfans'] = "0";
	} else { $updatedata[] = " memFbfans = '" . $rep['memFbfans'] . "' ";
	}
	//if($rep['memPic'] == ""){ $rep['memPic'] = ""; }
	if ($rep['memUid'] == "") { $rep['memUid'] = "";
	} else { $updatedata[] = " memUid = '" . $rep['memUid'] . "' ";
	}
	if ($rep['memName'] == "") { $rep['memName'] = $rep['memFbname'];
	} else { $updatedata[] = " memName = '" . $rep['memName'] . "' ";
	}
	if ($rep['memNick'] == "") { $rep['memNick'] = $rep['memFbname'];
	} else { $updatedata[] = " memNick = '" . $rep['memNick'] . "' ";
	}
	if ($rep['memSex'] == "male" or $rep['memSex'] == "1") {
		$rep['memSex'] = "1";
		$updatedata[] = " memSex = '" . $rep['memSex'] . "' ";
	} elseif ($rep['memSex'] == "female" or $rep['memSex'] == "2") {
		$rep['memSex'] = "2";
		$updatedata[] = " memSex = '" . $rep['memSex'] . "' ";
	} else {
		$rep['memSex'] = "0";
		$updatedata[] = " memSex = '" . $rep['memSex'] . "' ";
	}
	if ($rep['memGsm'] == "") { $rep['memGsm'] = "";
	} else { $updatedata[] = " memGsm = '" . $rep['memGsm'] . "' ";
		$updatedata[] = " memCheckgsm = '1' ";
	}
	if ($rep['memHtelbef'] == "") { $rep['memHtelbef'] = "";
	} else { $updatedata[] = " memHtelbef = '" . $rep['memHtelbef'] . "' ";
	}
	if ($rep['memHtel'] == "") { $rep['memHtel'] = "";
	} else { $updatedata[] = " memHtel = '" . $rep['memHtel'] . "' ";
	}
	if ($rep['memBirth'] == "") {
		$rep['memBirth'] = "0";
		$rep['memBy'] = 0;
		$rep['memBm'] = 0;
		$rep['memBd'] = 0;
	} else {
		$rep['memBirth'] = strtotime($rep['memBirth']);
		$updatedata[] = " memBirth = '" . $rep['memBirth'] . "' ";
		$rep['memBy'] = date("Y", $rep['memBirth']);
		$updatedata[] = " memBy = '" . $rep['memBy'] . "' ";
		$rep['memBm'] = date("m", $rep['memBirth']);
		$updatedata[] = " memBm = '" . $rep['memBm'] . "' ";
		$rep['memBd'] = date("d", $rep['memBirth']);
		$updatedata[] = " memBd = '" . $rep['memBd'] . "' ";
	}
	if ($rep['memZip'] == "") { $rep['memZip'] = "";
	} else { $updatedata[] = " memZip = '" . $rep['memZip'] . "' ";
	}
	if ($rep['memCity'] == "") { $rep['memCity'] = "";
	} else { $updatedata[] = " memCity = '" . $rep['memCity'] . "' ";
	}
	if ($rep['memArea'] == "") { $rep['memArea'] = "";
	} else { $updatedata[] = " memArea = '" . $rep['memArea'] . "' ";
	}
	if ($rep['memAddress'] == "") { $rep['memAddress'] = "";
	} else { $updatedata[] = " memAddress = '" . $rep['memAddress'] . "' ";
	}
	if ($rep['memEpaper'] == "") { $rep['memEpaper'] = "1";
	} else { $updatedata[] = " memEpaper = '" . $rep['memEpaper'] . "' ";
	}
	//if($rep['memBonus'] == ""){ $rep['memBonus'] = "0"; }
	//if($rep['memBonuswho'] == ""){ $rep['memBonuswho'] = "0"; }
	//if($rep['memBonusend'] == ""){ $rep['memBonusend'] = "0"; }
	//if($rep['memStatus'] == ""){ $rep['memStatus'] = "1"; }
	//if(empty($rep['memLogintime'])){ $rep['memLogintime'] = "0"; }
	//if(empty($rep['memModtime'])){ $rep['memModtime'] = "0"; }
	$updatedata[] = " memModtime = '" . $today . "' ";
	//if(empty($rep['memAddtime'])){ $rep['memAddtime'] = $today; }
	//if(empty($rep['memPs'])){ $rep['memPs'] = date("Y-m-d H:i:s" , $today)." : 由 ".$pagename." 頁面新增會員"; }
	$memPs = date("Y-m-d H:i:s", $today) . " : 由 " . $pagename . " 頁面修改會員 \n\n";
	$updatedata[] = " memPs = concat('" . $memPs . "' , memPs) ";
	//if(empty($rep['memAutoupdate'])){ $rep['memAutoupdate'] = $today; }

	if ($canact) {
		$sql = " update oj_member set
		 " . implode(" , ", $updatedata) . "
		where memSno = '" . $_SESSION['web_memSno'] . "' and memFbuid = '" . $_SESSION['web_memFbuid'] . "' and memEmail = '" . $_SESSION['web_memEmail'] . "' ";
		myquery($sql);
		update_member_statistics($_SESSION['web_memSno']);
		//更新會員統計數據
		$act_status[0] = true;
		return $act_status;
	} else {
		return $act_status;
	}
}

//確認會員資料有無重覆 , 不重覆回傳 true , 有重覆回傳 false
function checkmemberinfo($account, $memEmail, $memFbuid, $memGsm) {
	$where = array();
	if ($account != "") { $where[] = " memEmail2 = '" . $account . "' ";
	}
	if ($memEmail != "") { $where[] = " memEmail = '" . $memEmail . "' ";
	}
	if ($memFbuid != "") { $where[] = " memFbuid = '" . $memFbuid . "' ";
	}
	if ($memGsm != "") { $where[] = " memGsm = '" . $memGsm . "' ";
	}
	if (count($where) > 0) {
		$where_s = implode(" or ", $where);
		$res = myquery(" select memSno from oj_member where " . $where_s . " ");
		if (mysql_num_rows($res) < 1) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

//新增紅利使用紀錄 , 傳入 : 會員主鍵 , 來源資料表名稱 , 來源資料表主鍵 , 給扣點數 , 點數預定入帳時間(永不入帳用999999999) , 紅利使用說明
function insert_bonuslog($memSno, $bolTable, $bolPk, $bolBonus, $bolPaytime, $bolPs) {
	if (!empty($memSno) and !empty($bolTable) and !empty($bolPk) and !empty($bolPaytime)) {
		$today = getmk();
		//判斷是否可以直接入帳點數
		if ($today >= $bolPaytime) {
			$bolEntertime = $today;
			$bolStatus = 1;
		} else {
			$bolEntertime = 0;
			$bolStatus = 0;
		}
		//寫入 bonus log
		$sql = " insert into oj_bonuslog set
		memSno = '" . $memSno . "' ,
		bolTable = '" . $bolTable . "' ,
		bolPk = '" . $bolPk . "' ,
		bolBonus = '" . $bolBonus . "' ,
		bolOrdertime = '" . $today . "' ,
		bolPaytime = '" . $bolPaytime . "' ,
		bolEntertime = '" . $bolEntertime . "' ,
		bolPs = '" . $bolPs . "' ,
		bolStatus = '" . $bolStatus . "'";
		myquery($sql);
		$bolSno = mysql_insert_id();
		//如果判斷可以給點 , 修改會員資料表
		if ($today >= $bolPaytime) {
			$sql = " update oj_member set
			memBonus = ( memBonus + " . $bolBonus . " )
			where memSno = '" . $memSno . "' ";
			myquery($sql);
		}
		update_member_statistics($memSno);
		//更新會員統計數據
		$return = array(1, $bolSno);
		//回傳 執行成功	, bolSno = $bolSno
		return $return;
	} else {
		$return = array(0, 0);
		//回傳 執行失敗	, bolSno = 0
		return $return;
	}
}

//更新會員統計數據
function update_member_statistics($memSno) {
	global $today;
	//紅利
	$row = mysql_fetch_row(myquery(" select sum(bolBonus) from oj_bonuslog where memSno = '" . $memSno . "' and bolStatus = '1' and bolBonus > '0' "));
	$mstBonustotal = ($row[0] == NULL) ? 0 : $row[0];
	$row = mysql_fetch_row(myquery(" select sum(bolBonus) from oj_bonuslog where memSno = '" . $memSno . "' and bolStatus = '1' and bolBonus < '0' "));
	$mstBonususe = ($row[0] == NULL) ? 0 : $row[0];
	$mstBonus = $mstBonustotal + $mstBonususe;
	//活動
	$row = mysql_fetch_row(myquery(" select count(evlSno) from oj_eventlog where memSno = '" . $memSno . "' and evlStatus = '1' "));
	$mstEventtotal = ($row[0] == NULL) ? 0 : $row[0];
	//兌換 my card
	$row = mysql_fetch_row(myquery(" select count(orgSno) from oj_ordergiftgamecard where memSno = '" . $memSno . "' and orgStatus = '1' "));
	$mstGiftgtotal = ($row[0] == NULL) ? 0 : $row[0];
	//兌換 現金
	$row = mysql_fetch_row(myquery(" select count(ormSno) from oj_ordergiftmoney where memSno = '" . $memSno . "' and ormStatus = '1' "));
	$mstGiftmtotal = ($row[0] == NULL) ? 0 : $row[0];
	//兌換 現金
	$row = mysql_fetch_row(myquery(" select count(orpSno) from oj_ordergiftproduct where memSno = '" . $memSno . "' and orpStatus = '1' "));
	$mstGiftptotal = ($row[0] == NULL) ? 0 : $row[0];
	//訂單
	$row = mysql_fetch_row(myquery(" select count(ordSno) from oj_orderinfo where memSno = '" . $memSno . "' and ordPaystatus = '1' "));
	$mstOrdertotal = ($row[0] == NULL) ? 0 : $row[0];
	$row = mysql_fetch_row(myquery(" select sum(ordTotalprice) from oj_orderinfo where memSno = '" . $memSno . "' and ordPaystatus = '1' "));
	$mstOrderprice = ($row[0] == NULL) ? 0 : $row[0];
	//退貨
	$row = mysql_fetch_row(myquery(" select sum(ommQt) from oj_ordermrbm where memSno = '" . $memSno . "' "));
	$mstOrdermrbm = ($row[0] == NULL) ? 0 : $row[0];
	//換貨
	$row = mysql_fetch_row(myquery(" select sum(ompQt) from oj_ordermrbp where memSno = '" . $memSno . "' "));
	$mstOrdermrbp = ($row[0] == NULL) ? 0 : $row[0];
	//抽獎
	$row = mysql_fetch_row(myquery(" select count(lojSno) from oj_lottery_join where memSno = '" . $memSno . "' and lojStatus = '1' "));
	$mstLotterytotal = ($row[0] == NULL) ? 0 : $row[0];
	$row = mysql_fetch_row(myquery(" select count(lojSno) from oj_lottery_join where memSno = '" . $memSno . "' and lojStatus = '2' "));
	$mstLotterywin = ($row[0] == NULL) ? 0 : $row[0];

	$sql = " replace into oj_memberstatistics set
	memSno = '" . $memSno . "' ,
	mstUpdate = '" . $today . "' ,
	mstBonustotal = '" . $mstBonustotal . "' ,
	mstBonususe = '" . $mstBonususe . "' ,
	mstBonus = '" . $mstBonus . "' ,
	mstEventtotal = '" . $mstEventtotal . "' ,
	mstGiftgtotal = '" . $mstGiftgtotal . "' ,
	mstGiftmtotal = '" . $mstGiftmtotal . "' ,
	mstGiftptotal = '" . $mstGiftptotal . "' ,
	mstOrdertotal = '" . $mstOrdertotal . "' ,
	mstOrderprice = '" . $mstOrderprice . "' ,
	mstOrdermrbm = '" . $mstOrdermrbm . "' ,
	mstOrdermrbp = '" . $mstOrdermrbp . "' ,
	mstLotterytotal = '" . $mstLotterytotal . "' ,
	mstLotterywin = '" . $mstLotterywin . "' ";
	$res = myquery($sql);
}

//會員權限資格 - 活動資料是否齊全
function check_event_power($memSno) {
	$res = myquery(" select * from oj_member where memSno = '" . $memSno . "' ");
	if (mysql_num_rows($res) > 0) {
		$row = mysql_fetch_assoc($res);
		if ($row['memEmail'] != "" and $row['memFbuid'] != "" and $row['memFbfans'] != "0" and $row['memGsm'] != "") {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

//會員權限資格 - 購物資料是否齊全
function check_shopping_power($memSno) {
	$res = myquery(" select * from oj_member where memSno = '" . $memSno . "' ");
	if (mysql_num_rows($res) > 0) {
		$row = mysql_fetch_assoc($res);
		if ($row['memEmail'] != "" and $row['memFbuid'] != "" and $row['memFbfans'] != "0" and $row['memGsm'] != "" and $row['memName'] != "" and $row['memHtelbef'] != "" and $row['memHtel'] != "" and $row['memZip'] != "" and $row['memCity'] != "" and $row['memArea'] != "" and $row['memAddress'] != "") {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

//會員權限資格 - 兌換資料是否齊全
function check_bonus_power($memSno) {
	$res = myquery(" select * from oj_member where memSno = '" . $memSno . "' ");
	if (mysql_num_rows($res) > 0) {
		$row = mysql_fetch_assoc($res);
		if ($row['memEmail'] != "" and $row['memFbuid'] != "" and $row['memFbfans'] != "0" and $row['memGsm'] != "" and $row['memName'] != "" and $row['memUid'] != "") {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

//依紅利歷程資料表 更新會員目前紅利
function sum_member_by_bonuslog($memSno) {
	global $today;
	$memBonus = 0;
	if ($memSno > 0 and !empty($memSno)) {
		$res = myquery(" select bolBonus from oj_bonuslog where memSno = '" . $memSno . "' and bolStatus = '1' ");
		while ($row = mysql_fetch_assoc($res)) {
			$memBonus += $row['bolBonus'];
		}
		myquery(" update oj_member set memBonus = '" . $memBonus . "' , memAutoupdate = '" . $today . "' where memSno = '" . $memSno . "' ");
	}
	return $memBonus;
}

// 抽獎 =====================================================================================
//新增抽獎資料
function add_lottery_join($pagename, $info) {
	global $today;
	$act_status = array();
	$rep = returnpost($info);
	$canadd = true;

	//查看是否有對應的抽獎資料
	$resl = myquery(" select * from oj_lottery where lotStatus > '0' and lotStart <= '" . $today . "' and lotEnd >= '" . $today . "' and lotSno = '" . $rep['lotSno'] . "' ");
	if (mysql_num_rows($resl) < 1) { $canadd = false;
		$act_status['lotSno'] = "無符合的抽獎活動";
	} else { $rowl = mysql_fetch_assoc($resl);
	}
	//查看是否有對應的會員
	$resm = myquery(" select * from oj_member where memStatus > 0 and memSno = '" . $rep['memSno'] . "' ");
	if (mysql_num_rows($resm) < 1) { $canadd = false;
		$act_status['memSno'] = "會員資格不符合";
	} else { $rowm = mysql_fetch_assoc($resm);
	}
	//查看會員是否已經參加過
	$resj = myquery(" select * from oj_lottery_join where lotSno = '" . $rowl['lotSno'] . "' and memSno = '" . $rowm['memSno'] . "' ");
	if (mysql_num_rows($resj) > 0) { $canadd = false;
		$act_status['memSno'] = "已參加過此抽獎";
	} else {
	}
	//查看會員紅利
	if ($rowm['memBonus'] < $rowl['lotBonus']) { $canadd = false;
		$act_status['memSno'] = "紅利點數不足";
	} else {
	}

	if ($canadd) {
		//新增參加記錄
		$sql = " insert into oj_lottery_join set
		lotSno = '" . $rowl['lotSno'] . "' ,
		memSno = '" . $rowm['memSno'] . "' ,
		lojBonus = '" . $rowl['lotBonus'] . "' ,
		lojTime = '" . $today . "' ,
		lojStatus = '1' ,
		lojShip = '0' ,
		lojPs = '' ";
		myquery($sql);

		//增加抽獎統計
		myquery(" update oj_lottery set lotJoin = lotJoin + 1 where lotSno = '" . $rowl['lotSno'] . "' ");

		//扣除會員紅利點數
		$memSno = $rowm['memSno'];
		$bolTable = "oj_lottery";
		$bolPk = $rowl['lotSno'];
		$bolBonus = $rowl['lotBonus'] * -1;
		$bolPaytime = $today;
		$bolPs = "紅利抽獎 - " . $rowl['lotTitle'];
		insert_bonuslog($memSno, $bolTable, $bolPk, $bolBonus, $bolPaytime, $bolPs);
		update_member_statistics($memSno);
		//更新會員統計數據
		$act_status[0] = true;
		return $act_status;
	} else {
		$act_status[0] = false;
		return $act_status;
	}
}

// 訂單 =====================================================================================
//新增訂單
function add_order($pagename, $info) {
	global $today;
	$act_status = array();
	$rep = returnpost($info);
	$canadd = true;

	//確定會員資料
	if (!empty($rep['memSno'])) {
		$memSno = $rep['memSno'];
	} elseif (!empty($rep['memFbuid'])) {
		$resm = myquery(" select memSno from oj_member where memFbuid = '" . $rep['memFbuid'] . "' ");
		if (mysql_num_rows($resm) > 0) {
			$rowm = mysql_fetch_assoc($resm);
			$memSno = $rowm['memSno'];
		} else {
			$member = $info;
			if (checkmemberinfo("", "", "", $member['memGsm'])) {
				//$member['memGsm'] =
			} else {
				$member['memGsm'] = "";
			}
			$mem_status = add_member($pagename, $member);
			if ($mem_status) {
				$memSno = $mem_status['memSno'];
			} else {
				$canadd = false;
				$act_status['memSno'] = "新增會員失敗";
			}
		}
	} else {
		$canadd = false;
		$act_status['memSno'] = "無法取得會員資料";
	}
	//抓出會員
	$rowm = mysql_fetch_assoc(myquery(" select * from oj_member where memSno = '" . $memSno . "' "));
	$act_status['memSno'] = $rowm['memSno'];

	//確定收件人
	if ($rep['sameas'] == 1) {
		$rep['ordName'] = $rep['memName'];
		$rep['ordEmail'] = $rep['memEmail'];
		$rep['ordTelbef'] = $rep['memHtelbef'];
		$rep['ordTel'] = $rep['memHtel'];
		$rep['ordGsm'] = $rep['memGsm'];
		$rep['ordZip'] = $rep['memZip'];
		$rep['ordCity'] = $rep['memCity'];
		$rep['ordArea'] = $rep['memArea'];
		$rep['ordAddress'] = $rep['memAddress'];
	}

	//php 多重簡察預設值
	//if($rep['ordSno'] == ""){ $canadd = false; $act_status['ordSno'] = "ordSno 欄位為必填"; }
	if (empty($rep['ordNum']) or $rep['ordNum'] == "") { $rep['ordNum'] = 0;
	}
	if (empty($rep['ordTime']) or $rep['ordTime'] == "") { $rep['ordTime'] = $today;
	}
	if ($rep['ordTable'] == "") { $canadd = false;
		$act_status['ordTable'] = "不知名的購物活動";
	}
	if ($rep['ordPk'] == "") { $canadd = false;
		$act_status['ordPk'] = "不知名的購物活動";
	}
	if ($rep['ordApi'] == "") { $rep['ordApi'] = "";
	}
	if ($rep['ordKey'] == "") { $rep['ordKey'] = "";
	}
	//if($rep['memSno'] == ""){ $canadd = false; $act_status['memSno'] = "memSno 欄位為必填"; }
	if ($rep['ordEmail'] == "") { $rep['ordEmail'] = "";
	}
	if ($rep['ordName'] == "") { $canadd = false;
		$act_status['ordName'] = "收件人姓名欄位未填";
	}
	if ($rep['ordTelbef'] == "") { $canadd = false;
		$act_status['ordTelbef'] = "收件人電話欄位未填";
	}
	if ($rep['ordTel'] == "") { $canadd = false;
		$act_status['ordTel'] = "收件人電話欄位未填";
	}
	if ($rep['ordGsm'] == "") { $canadd = false;
		$act_status['ordGsm'] = "收件人手機欄位未填";
	}
	if ($rep['ordZip'] == "") { $canadd = false;
		$act_status['ordZip'] = "收件人地址欄位未填";
	}
	if ($rep['ordCity'] == "") { $canadd = false;
		$act_status['ordCity'] = "收件人地址欄位未填";
	}
	if ($rep['ordArea'] == "") { $canadd = false;
		$act_status['ordArea'] = "收件人地址欄位未填";
	}
	if ($rep['ordAddress'] == "") { $canadd = false;
		$act_status['ordAddress'] = "收件人地址欄位未填";
	}
	if ($rep['ordShiptime'] == "") { $rep['ordShiptime'] = "";
	}
	if ($rep['ordShipotime'] == "") { $rep['ordShipotime'] = "";
	}
	if ($rep['ordNote'] == "") { $rep['ordNote'] = "";
	}
	if ($rep['ordTtype'] == "") { $rep['ordTtype'] = "";
	}
	if ($rep['ordTnum'] == "") { $rep['ordTnum'] = "";
	}
	if ($rep['ordTtitle'] == "") { $rep['ordTtitle'] = "";
	}
	$rep['ordItemprice'] = 0;
	$rep['ordShipprice'] = 0;
	$rep['ordTotalprice'] = 0;
	$rep['ordCouponprice'] = 0;
	if ($rep['ordCouponcode'] == "") { $rep['ordCouponcode'] = "";
	}
	$rep['ordAlreadyprice'] = 0;
	$rep['ordBonus'] = 0;
	if ($rowm['memBonusend'] >= $today) {
		$rep['ordSharememsno'] = $rowm['memBonuswho'];
	} else {
		$rep['ordSharememsno'] = 0;
	}
	$rep['ordSharebonus'] = 0;
	if (empty($rep['ordPaystatus']) or $rep['ordPaystatus'] == "") { $rep['ordPaystatus'] = 0;
	}
	if (empty($rep['ordPaytime']) or $rep['ordPaytime'] == "") { $rep['ordPaytime'] = 0;
	}
	if (empty($rep['paySno']) or $rep['paySno'] == "") { $rep['paySno'] = 0;
	}
	if ($rep['ordStatus'] == "") { $rep['ordStatus'] = 1;
	}
	if (empty($rep['ordCancel']) or $rep['ordCancel'] == "") { $rep['ordCancel'] = 0;
	}
	if (empty($rep['ordCanmrb']) or $rep['ordCanmrb'] == "") { $rep['ordCanmrb'] = 0;
	}
	if (empty($rep['ordMrbqt']) or $rep['ordMrbqt'] == "") { $rep['ordMrbqt'] = 0;
	}
	if (empty($rep['ordMrbprice']) or $rep['ordMrbprice'] == "") { $rep['ordMrbprice'] = 0;
	}
	if (empty($rep['ordMrbpaid']) or $rep['ordMrbpaid'] == "") { $rep['ordMrbpaid'] = 0;
	}
	if ($rep['ordUlog'] == "") { $rep['ordUlog'] = "";
	}
	if ($rep['ordAlog'] == "") { $rep['ordAlog'] = "";
	}
	if ($rep['ordSlog'] == "") { $rep['ordSlog'] = "";
	}
	if ($rep['ordPs'] == "") { $rep['ordPs'] = "";
	}
	$itemtotal = 0;
	foreach ($rep['orlQt'] as $proSno => $orlQt) {
		$itemtotal += $orlQt;
	}
	if ($itemtotal < 1) { $canadd = false;
		$act_status['orlQt'] = "未選擇商品";
	}

	//若都沒問題就開始建立資料
	if ($canadd) {
		$sql = " insert into oj_orderinfo set

		ordNum = '" . $rep['ordNum'] . "' ,
		ordTime = '" . $rep['ordTime'] . "' ,
		ordTable = '" . $rep['ordTable'] . "' ,
		ordPk = '" . $rep['ordPk'] . "' ,
		ordApi = '" . $rep['ordApi'] . "' ,
		ordKey = '" . $rep['ordKey'] . "' ,
		memSno = '" . $memSno . "' ,
		ordEmail = '" . $rep['ordEmail'] . "' ,
		ordName = '" . $rep['ordName'] . "' ,
		ordTelbef = '" . $rep['ordTelbef'] . "' ,
		ordTel = '" . $rep['ordTel'] . "' ,
		ordGsm = '" . $rep['ordGsm'] . "' ,
		ordZip = '" . $rep['ordZip'] . "' ,
		ordCity = '" . $rep['ordCity'] . "' ,
		ordArea = '" . $rep['ordArea'] . "' ,
		ordAddress = '" . $rep['ordAddress'] . "' ,
		ordShiptime = '" . $rep['ordShiptime'] . "' ,
		ordShipotime = '" . $rep['ordShipotime'] . "' ,
		ordNote = '" . $rep['ordNote'] . "' ,
		ordTtype = '" . $rep['ordTtype'] . "' ,
		ordTnum = '" . $rep['ordTnum'] . "' ,
		ordTtitle = '" . $rep['ordTtitle'] . "' ,
		ordItemprice = '" . $rep['ordItemprice'] . "' ,
		ordShipprice = '" . $rep['ordShipprice'] . "' ,
		ordTotalprice = '" . $rep['ordTotalprice'] . "' ,
		ordCouponprice = '" . $rep['ordCouponprice'] . "' ,
		ordCouponcode = '" . $rep['ordCouponcode'] . "' ,
		ordAlreadyprice = '" . $rep['ordAlreadyprice'] . "' ,
		ordBonus = '" . $rep['ordBonus'] . "' ,
		ordSharememsno = '" . $rep['ordSharememsno'] . "' ,
		ordSharebonus = '" . $rep['ordSharebonus'] . "' ,
		ordPaystatus = '" . $rep['ordPaystatus'] . "' ,
		ordPaytime = '" . $rep['ordPaytime'] . "' ,
		paySno = '" . $rep['paySno'] . "' ,
		ordStatus = '" . $rep['ordStatus'] . "' ,
		ordCancel = '" . $rep['ordCancel'] . "' ,
		ordCanmrb = '" . $rep['ordCanmrb'] . "' ,
		ordMrbqt = '" . $rep['ordMrbqt'] . "' ,
		ordMrbprice = '" . $rep['ordMrbprice'] . "' ,
		ordMrbpaid = '" . $rep['ordMrbpaid'] . "' ,
		ordUlog = '" . $rep['ordUlog'] . "' ,
		ordAlog = '" . $rep['ordAlog'] . "' ,
		ordSlog = '" . $rep['ordSlog'] . "' ,
		ordPs = '" . $rep['ordPs'] . "' ";
		myquery($sql);
		$ordSno = mysql_insert_id();
		$act_status['ordSno'] = $ordSno;

		//建立清單資料
		$ordItemprice = 0;
		$ordShipprice = 0;
		$ordTotalprice = 0;
		$ordBonus = 0;
		$ordSharebonus = 0;
		foreach ($rep['orlQt'] as $proSno => $Qt) {
			if ($Qt < 1) {
				continue;
			}
			$resp = myquery(" select * from oj_product where proSno = '" . $proSno . "' ");
			if (mysql_num_rows($resp) > 0) {
				$rowp = mysql_fetch_assoc($resp);

				if ($rowp['proStock'] >= $Qt) {
					$orlQt = $Qt;
				} elseif ($rowp['proStock'] < $Qt) {
					$orlQt = $rowp['proStock'];
				}
				$orlPrice = $rowp['proSprice'] * $orlQt;
				if ($rowp['proOnebyone'] == 1) {
					$orlShip = $rowp['proShip'] * $orlQt;
				} else {
					$orlShip = $rowp['proShip'] * 1;
				}
				$orlBonus = $rowp['proBonus'] * $orlQt;
				$orlSharebonus = $rowp['proSharebonus'] * $orlQt;

				$sql = " insert into oj_orderlist set

				ordSno = '" . $ordSno . "' ,
				adpSno = '" . $rowp['adpSno'] . "' ,
				proSno = '" . $rowp['proSno'] . "' ,
				proTitle = '" . $rowp['proTitle'] . "' ,
				proPrice = '" . $rowp['proSprice'] . "' ,
				proShip = '" . $rowp['proShip'] . "' ,
				proBonus = '" . $rowp['proBonus'] . "' ,
				proSharebonus = '" . $rowp['proSharebonus'] . "' ,
				proOnebyone = '" . $rowp['proOnebyone'] . "' ,
				orlPrice = '" . $orlPrice . "' ,
				orlShip = '" . $orlShip . "' ,
				orlBonus = '" . $orlBonus . "' ,
				orlSharebonus = '" . $orlSharebonus . "' ,
				orlQt = '" . $orlQt . "' ,
				orlShipstatus = '0' ,
				orlShipnumber = '' ,
				orlShiptime = '0' ,
				orlShipip = '' ,
				orlMrbdeadline = '0' ,
				orlMrbqtm = '0' ,
				orlMrbqtp = '0' ";
				myquery($sql);

				$ordItemprice += $orlPrice;
				$ordShipprice += $orlShip;
				$ordBonus += $orlBonus;
				$ordSharebonus += $orlSharebonus;
				$ordTotalprice += $orlPrice + $orlShip;
			} else {

			}
		}
		//更新訂單總金額
		$sql = " update oj_orderinfo set
		ordItemprice = '" . $ordItemprice . "' ,
		ordShipprice = '" . $ordShipprice . "' ,
		ordTotalprice = '" . $ordTotalprice . "' ,
		ordBonus = '" . $ordBonus . "' ,
		ordSharebonus = '" . $ordSharebonus . "'
		where ordSno = '" . $ordSno . "' ";
		myquery($sql);
		update_member_statistics($memSno);
		//更新會員統計數據
		$act_status[0] = true;
		return $act_status;
	} else {
		return $act_status;
	}
}

//廠商 ======================================================================================

//新增會員資料
function add_adm($pagename, $info) {
	global $today;
	$act_status = array();
	$rep = returnpost($info);
	$canadd = checkadminfo($rep['admaccount']);
	$act_status[0] = $canadd;
	//可否處理資料存在索引 0
	$act_status['account'] = "帳號已經被使用";


	//php 多重簡察預設值
	if ($rep['admaccount'] == "user@urbonus.com") { $canadd = false;
		$act_status['admaccount'] = "此帳號無效";
	}
	if ($rep['admaccount'] == "") { $canadd = false;
		$act_status['admaccount'] = "Email欄位為必填";
	}
	if ($rep['admmemPw'] == "") { $canadd = false;
		$act_status['memEmail'] = "password欄位為必填";
	}
	if ($rep['memFbname'] == "") { $rep['memFbname'] = "";
	}
	if ($rep['memFbfans'] == "") { $rep['memFbfans'] = "0";
	}

	if ($rep['admFbuid'] == "") { $rep['admFbuid'] = "";
	}


	if ($canadd) {
		$sql = " insert into oj_adminp set
		adpId = '".$rep['admaccount']."' ,
		adpPw = '".md5($rep['admmemPw'])."' ,
		adpPic = '' ,
		adpName = '' ,
		adpTax = '' ,
		adpCountry = '".$rep['admCountry']."',
		adpAddress = '' ,
		adpTel = '' ,
		adpFax = '' ,
		adpEmail = '' ,
		adpFile = '' ,
		adpFilename = '' ,
		adpFilemain = '' ,
		adpPs = '' ,
		adpCredits = '0' ,
		adpOrder = '0' ,
		adpStatus = '1' ,
		adpAddtime = '".$today."' ";
		myquery($sql);
		$adpSno = mysql_insert_id();
		saveWebsetTxt( " select * from oj_adminp order by adpSno " , "adminp" , array("adpSno") , array() , array() , "cms" , "" );
		saveWebsetTxt( " select * from oj_adminp where adpStatus > 0 order by adpSno " , "adminp" , array("adpSno") , array() , array() , "w" , "" );
		$act_status[0] = true;
		$act_status['adpSno'] = $adpSno;
		return $act_status;
	} else {
		//return $act_status;
		gotoAlert( "welcome.php", "此帳號已被使用，請檢查您輸入的電子郵箱是否正確" );
	}
}

//確認廠商資料有無重覆 , 不重覆回傳 true , 有重覆回傳 false
function checkadminfo($admaccount) {
	$where = array();
	if ($admaccount != "") { $where[] = " adpId = '" . $admaccount . "' ";
	}
	if (count($where) > 0) {
		$where_s = implode(" or ", $where);
		$res = myquery(" select adpSno from oj_adminp where " . $where_s . " ");
		if (mysql_num_rows($res) < 1) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

//廠商點數使用記錄 傳入 : 廠商主鍵 , 來源資料表名稱 , 來源資料表主鍵 , 用途 , 詳細說明 , 使用點數
function insert_creditslog($adpSno, $crlTable, $crlPk, $crlTitle, $crlWhy, $crlCredits) {
	if (!empty($adpSno) and !empty($crlTable) and !empty($crlPk) and !empty($crlCredits)) {
		global $today;
		//寫入 log
		$sql = " insert into oj_creditslog set
		adpSno = '" . $adpSno . "' ,
		crlTable = '" . $crlTable . "' ,
		crlPk = '" . $crlPk . "' ,
		crlTitle = '" . $crlTitle . "' ,
		crlWhy = '" . $crlWhy . "' ,
		crlCredits = '" . $crlCredits . "' ,
		crlTime = '" . $today . "' ";
		myquery($sql);

		//更新廠商點數
		$sql = " update oj_adminp set
		adpCredits = ( adpCredits + " . $crlCredits . " )
		where adpSno = '" . $adpSno . "' ";
		myquery($sql);

		saveWebsetTxt(" select * from oj_adminp order by adpSno ", "adminp", array("adpSno"), array(), array(), "cms", "");
		saveWebsetTxt(" select * from oj_adminp where adpStatus > 0 order by adpSno ", "adminp", array("adpSno"), array(), array(), "w", "");
	}
}

# 2013/05/25 add below function
/*
 $sql = select 語法;
 $dblink = 資料庫連線;
 回傳值為陣列
 */
function getAllData($sql, $dblink = null) {

	GLOBAL $db_hostname, $db_username, $db_password;

	if (is_null($dblink))
		$dblink = mysql_connect($db_hostname, $db_username, $db_password);

	$res = myquery($sql);
	$restotal = mysql_num_rows($res);

	if ($restotal) {
		$i = 0;
		while ($row = mysql_fetch_assoc($res)) {
			$aReturn[$i] = $row;
			$i++;
		}
	} else {
		$aReturn = null;
	}

	return $aReturn;

}

/*
 $sql = select 語法;
 $perPage = 單頁顯示幾筆資料
 $nowPage = 目前所在頁
 $totalPage = 函式回傳總頁數
 $dblink = 資料庫連線;
 回傳值為陣列
 */
function getPageData($sql, $perPage, $nowPage, &$totalPage, $dblink = null) {

	GLOBAL $db_hostname, $db_username, $db_password;

	if (is_null($dblink))
		$dblink = mysql_connect($db_hostname, $db_username, $db_password);

	$startFlag = $perPage * ($nowPage - 1);
	$stopFlag = $startFlag + $perPage;
	$res = myquery($sql);
	mysql_data_seek($res, $startFlag);
	$totalPage = ceil(mysql_num_rows($res) / $perPage);

	if ($totalPage) {
		$i = 0;
		while (($row = mysql_fetch_assoc($res)) && ($i < $perPage)) {
			$aReturn[$i] = $row;
			$i++;
		}
	} else {
		$aReturn = null;
	}

	return $aReturn;

}

function getPageEventData($sql, $perPage, $nowPage, &$totalPage, $dblink = null) {

	GLOBAL $db_hostname, $db_username, $db_password;

	if (is_null($dblink))
		$dblink = mysql_connect($db_hostname, $db_username, $db_password);

	$startFlag = $perPage * ($nowPage - 1);
	$stopFlag = $startFlag + $perPage;
	$res = mysql_query($sql);
	mysql_data_seek($res, $startFlag);
	$totalPage = ceil(mysql_num_rows($res) / $perPage);

	if ($totalPage) {
		$i = 0;
		while (($row = mysql_fetch_assoc($res)) && ($i < $perPage)) {
			$aReturn[$i] = $row;
			$i++;
		}
	} else {
		$aReturn = null;
	}

	return $aReturn;

}
/*
 $arrKind = 分類陣列;
 $kinSno = 目前所在分類
 $nowPage = 目前所在頁
 $totalPage = 函式回傳總頁數
 $dblink = 資料庫連線(尚無作用);
 回傳值為html
 */
function getNewsKind($arrKind, $kinSno, $type = 1, $dblink = null) {
	$lang = new Language();
    $lang->load("header");
	$newsCatgory = "";
	$tagItem = ($type == 1) ? "<img src='img/icon/tag.png' />" : "";

	foreach ($arrKind as $key => $value) {
		$_kinSno = $value['kinSno'];
		$_kinTitle = $value['kinTitle'];
		$_kinMain = $value['kinMain'];
		switch ($_kinTitle){
			case "全部":
				$_kinTitle=$lang->line("header.all");
			break;

			case "美容保養":
			 	$_kinTitle=$lang->line("header.beauty");
			break;

			case "流行時尚":
				$_kinTitle=$lang->line("header.fashion");
			break;

			case "餐飲美食":
				$_kinTitle=$lang->line("header.food");
			break;

			case "服飾配件":
				$_kinTitle=$lang->line("header.clothes");
			break;

			case "3C科技":
				$_kinTitle=$lang->line("header.3c");
			break;

			case "藝文娛樂":
				$_kinTitle=$lang->line("header.arts");
			break;

			case "旅遊休閒":
				$_kinTitle=$lang->line("header.travel");
			break;

			case "綜合百貨":
				$_kinTitle=$lang->line("header.generalstores");
			break;

			case "親子寶貝":
				$_kinTitle=$lang->line("header.paternity");
			break;

			case "音樂電影":
				$_kinTitle=$lang->line("header.musicandmovic");
			break;

			default:
				$_kinTitle = $value['kinTitle'];
		}

		if ($kinSno == $_kinSno) {
			$newsCatgory .= "<li class='active'><a href='announce.php?k={$_kinSno}'><b>{$tagItem}</b>{$_kinTitle}</a></li>";
		} else {
			$newsCatgory .= "<li><a href='announce.php?k={$_kinSno}'><b>{$tagItem}</b>{$_kinTitle}</a></li>";
		}
	}

	return $newsCatgory;
}

function getBrandsKind($arrKind, $kibSno, $type = 1, $dblink = null) {
	$lang = new Language();
    $lang->load("header");
	$brandsCatgory = "";
	$tagItem = ($type == 1) ? "<img src='img/icon/tag.png' />" : "";

	foreach ($arrKind as $key => $value) {
		$_kibSno = $value['kibSno'];
		$_kibTitle = $value['kibTitle'];
		$link = ($type == 1) ? "":" href='brand.php?k={$_kibSno}' ";
		$class= ($type == 1) ? " class='b-{$_kibSno}' ":"";

		switch ($_kibTitle){
			case "全部":
				$_kibTitle=$lang->line("header.all");
			break;

			case "美容保養":
			 	$_kibTitle=$lang->line("header.beauty");
			break;

			case "流行時尚":
				$_kibTitle=$lang->line("header.fashion");
			break;

			case "餐飲美食":
				$_kibTitle=$lang->line("header.food");
			break;

			case "服飾配件":
				$_kibTitle=$lang->line("header.clothes");
			break;

			case "3C科技":
				$_kibTitle=$lang->line("header.3c");
			break;

			case "藝文娛樂":
				$_kibTitle=$lang->line("header.arts");
			break;

			case "旅遊休閒":
				$_kibTitle=$lang->line("header.travel");
			break;

			case "綜合百貨":
				$_kibTitle=$lang->line("header.generalstores");
			break;

			case "親子寶貝":
				$_kibTitle=$lang->line("header.paternity");
			break;

			case "音樂電影":
				$_kibTitle=$lang->line("header.musicandmovic");
			break;

			case "線上遊戲":
				$_kibTitle=$lang->line("header.onlinegame");
			break;

			case "媒體出版":
				$_kibTitle=$lang->line("header.media");
			break;

			case "音樂唱片":
				$_kibTitle=$lang->line("header.music");
			break;

			case "公益慈善":
				$_kibTitle=$lang->line("header.charity");
			break;

			default:
				$_kibTitle = $value['kibTitle'];
		}

		if ($kibSno == $_kibSno) {
			$brandsCatgory .= "<li class='active'><a {$class} data-filter='.brand{$_kibSno}' {$link}><b>{$tagItem}</b>{$_kibTitle}</a></li>";
		} else {
			$brandsCatgory .= "<li><a {$class} data-filter='.brand{$_kibSno}' {$link}><b>{$tagItem}</b>{$_kibTitle}</a></li>";
		}
	}

	return $brandsCatgory;
}

/*
 $arrKind = 分類陣列;
 $nowPage = 目前所在頁
 $totalPage = 總頁數
 $scripts = 頁面名稱
 $kinSno = 目前所在分類
 回傳值為html
 */
function getPageBar($nowPage, $totalPage, $scripts, $kinSno = null, $key = null) {

	$pageBar = "";
	$prevPage = (($nowPage - 1) <= 0) ? 1 : ($nowPage - 1);
	$nextPage = (($nowPage + 1) >= $totalPage) ? $totalPage : ($nowPage + 1);
	$prevLi = (($nowPage - 1) <= 0) ? "class='disabled'" : "";
	$nextLi = (($nowPage + 1) > $totalPage) ? "class='disabled'" : "";
	$value = "";

	if (empty($key) || empty($kinSno)) {
		$value = "";
	} else {
		$value = "&{$key}={$kinSno}";
	}

	if ($totalPage > 1) {
		$pageBar .= "<li {$prevLi}><a href={$scripts}?page={$prevPage}{$value}'>«</a></li>";
		for ($i = 1; $i <= $totalPage; $i++) {

			if ($nowPage == $i) {
				$pageBar .= "<li class='active'><a href='{$scripts}?page={$i}{$value}'>{$i}</a></li>";
			} else {
				$pageBar .= "<li><a href='{$scripts}?page={$i}{$value}'>{$i}</a></li>";
			}
		}
		$pageBar .= "<li {$nextLi}><a href='{$scripts}?page={$nextPage}{$value}'>»</a></li>";
	} else {
		$pageBar = "";
	}

	return $pageBar;
}

function getPageBar2($nowPage, $totalPage, $scripts, $kinSno = null, $key = null) {
	$lang = new Language();
    $lang->load("index");
	$pageBar = "";
	$prevPage = (($nowPage - 1) <= 0) ? 1 : ($nowPage - 1);
	$nextPage = (($nowPage + 1) >= $totalPage) ? $totalPage : ($nowPage + 1);
	$prevLi = (($nowPage - 1) <= 0) ? "class='disabled'" : "";
	$nextLi = (($nowPage + 1) > $totalPage) ? "class='disabled'" : "";
	$startpage = floor(($nowPage - 1) / 10) * 10 + 1;
	$endpage = $startpage+9;
	$value = "";

	if (empty($key) || empty($kinSno)) {
		$value = "";
	} else {
		$value = "&{$key}={$kinSno}";
	}

	if ($totalPage > 1) {
		if($nowPage>1){
			$pageBar .= "<li><a href={$scripts}?page=1{$value}>'{$lang->line("index.FirstPage")}'</a></li>";
			$pageBar .= "<li {$prevLi}><a href={$scripts}?page={$prevPage}{$value}'>«</a></li>";
		}
		for ($i = $startpage; $i <= $endpage; $i++) {
			if($i==$totalPage+1){break;}else{
				if ($nowPage == $i) {
					$pageBar .= "<li class='active'><a href='{$scripts}?page={$i}{$value}'>{$i}</a></li>";
				} else {
					$pageBar .= "<li><a href='{$scripts}?page={$i}{$value}'>{$i}</a></li>";
				}
			}
		}
		$pageBar .= "<li {$nextLi}><a href='{$scripts}?page={$nextPage}{$value}'>»</a></li>";
		$pageBar .= "<li><a href='{$scripts}?page={$totalPage}{$value}'>'{$lang->line("index.LastPage")}'</a></li>";
	} else {
		$pageBar = "";
	}

	return $pageBar;

}

/*
 $nowPage = 目前所在頁 $_SERVER['PHP_SELF']
 回傳值為html
 */
function getServicePage($nowPage) {

	$html = "";
	$arrService = array(#"about" 	=> "關於紅利王",
	#"services" => "客服中心",
	#"terms" 	=> "會員條款",
	#"privacy" 	=> "隱私權政策",
	"contacts" => "聯絡我們", "cooperate" => "廠商合作", );
	foreach ($arrService as $k => $v) {
		if (substr_count($nowPage, $k) > 0) {
			$html .= "<li class='active'><a href='{$k}.php'><b><img src='img/icon/text-list.png'/></b>{$v}</a></li>";
		} else {
			$html .= "<li><a href='{$k}.php'><b><img src='img/icon/text-list.png'/></b>{$v}</a></li>";
		}
	}
	return $html;
}

/*
 $arrKind = 分類陣列;
 回傳值為html
 */
function getEventKind($arrKind = null, $nowKinSno) {

	$html = "";

	foreach ($arrKind as $k => $v) {
		$kieSno = $v['kieSno'];
		$kieTitle = $v['kieTitle'];
		$kieMain = $v['kieMain'];

		if ($kieSno == $nowKinSno) {
			$html .= "<li class='active'><a href='index.php?k={$kieSno}'><b><img src='img/icon/tag.png'/></b>{$kieTitle}</a></li>";
		} else {
			$html .= "<li><a href='index.php?k={$kieSno}'><b><img src='img/icon/tag.png'/></b>{$kieTitle}</a></li>";
		}
	}
	return $html;
}

/*
 $table = 資料表;
 $column = 欄位key名稱
 回傳值為html
 */
function getBonusItem($table, $column, $class, $imgPath, $arrMember, $dblink = null, &$html1) {
	$lang = new Language();
    $lang->load("exchange");
	GLOBAL $db_hostname, $db_username, $db_password;

	if (is_null($dblink))
		$dblink = mysql_connect($db_hostname, $db_username, $db_password);

	$nowBonus = intval($arrMember["memBonus"]);
	//$nowBonus= 4500;
	$html = "";
	$html1 = "";
	$class = trim($class);

	if ($class == "charity") {
		$columnOpic = "";
		$columnStock = "";
	} else {
		$columnOpic = "{$column}Opic,";
		$columnStock = "{$column}Stock,";
	}

	$Opic = ($class == "charity") ? "" : "";
	$sql = "SELECT
						{$columnOpic}{$columnStock}{$column}Sno,{$column}Lpic,{$column}Bpic,{$column}Title,{$column}Intro,{$column}Point,{$column}Main,{$column}Form,{$column}Bonus ,kicTitle
					FROM
						{$table}
					WHERE
						{$column}Status = 1
					ORDER BY
						{$column}Order , {$column}Sno";

	$arrData = getAllData($sql, $dblink);

	//echo $sql . "<br/>";
	if ($arrData) {
		foreach ($arrData as $key => $value) {
			$Sno = $value["{$column}Sno"];
			$Lpic = $value["{$column}Lpic"];
			$Bpic = $value["{$column}Bpic"];
			$Title = $value["{$column}Title"];
			$Intro = nl2br($value["{$column}Intro"]);
			$Point = $value["{$column}Point"];
			$Main = $value["{$column}Main"];
			$Form = $value["{$column}Form"];
			$Bonus = $value["{$column}Bonus"];
			$Price = $value["{$column}Price"];
			$Sold = $value["{$column}Sold"];
			$Country = $value["kicTitle"];

			$PointList = "";
			$arrPoint = explode(";;;", $Point);
			switch ($Country){
				case "香港":
					$Country=$lang->line("exchange.hk");
				break;
				case "全部":
					$Country=$lang->line("exchange.all");
				break;
				case "台灣":
					$Country=$lang->line("exchange.tw");
				break;
				case "馬來西亞":
					$Country=$lang->line("exchange.my");
				break;


				default:
					$Country = $value["kicTitle"];
			}
			foreach ($arrPoint as $k => $v) {
				$PointList .= "<li>{$v}</li>";
			}
			if ($class != "charity") {
				$Opic = $value["{$column}Opic"];
				$Stock = $value["{$column}Stock"];

				# 剩餘名額
				$Less = $Stock - $Sold;
				//$arrOpic  = explode(";;;", $Opic);
			} else {
				$Less = 1;
			}

			//$button = ($nowBonus >= $Bonus)? "<a href='#dialog-{$class}{$Sno}' class='btn btn-danger' rel='dialog'>兌換</a>":"<a class='btn disabled'>紅利不足</a>";
			$button = ($nowBonus >= $Bonus) ? "<a href='exchange-detail.php?c={$class}&s={$Sno}' class='btn btn-danger fancy'>{$lang->line("exchange.exchange")}</a>" : "<a class='btn disabled'>{$lang->line("exchange.InsufficientBonus")}</a>";
			$button = ($Less > 0) ? $button : "<a class='btn disabled'>{$lang->line("exchange.OutOf")}</a>";
			# LIST
			$html .= "<div class='item {$class}'>
							<div class='waterfall-content'>
								<img src='{$imgPath}{$Lpic}' />
								<h5>{$Title}</h5>
								<h6>{$lang->line("exchange.UseArea")}:{$Country}</h6>
								<div class='exchange-link'>
									<h6>{$lang->line("exchange.RequiredBonus")}：" . number_format($Bonus) . " {$lang->line("exchange.point")}</h6>
									{$button}
								</div>
							</div>
						</div>";

			#DETAIL
			$submitButton = "<input type='submit' class='btn btn-large btn-danger' value='申請兌換'/>";
			/*
			 if( empty($arrMember["memUid"]) ||
			 empty($arrMember["memName"]) ||
			 empty($arrMember["memBirth"]) ||
			 empty($arrMember["memEmail"])
			 ){
			 $submitButton = "<input type='button' class='btn btn-large btn-danger' value='編修個人資料' onclick='location.href=\"setting.php?next=exchange\";'/>";
			 $Form		  = "您個人資料尚不齊全，請先至會員專區填寫資料唷!";
			 }else{
			 $submitButton = "<input type='submit' class='btn btn-large btn-danger' value='申請兌換'/>";
			 }
			 */
			#FORM
			$formInput;
			switch($class) {
				case "cash" :
					$formInput = "<div class='form-inline pull-left'><label>真實姓名：</label><input type='text' class='{$class}{$Sno}_1' name='memName' value='" . $arrMember["memName"] . "' maxlength='32'/></div>
									<div class='form-inline pull-left'><label>聯絡手機：</label><input type='text' class='{$class}{$Sno}_2' name='memGsm' value='" . $arrMember["memGsm"] . "' maxlength='16'/></div>
									<div class='form-inline pull-left'><label>電子信箱：</label><input type='text' class='{$class}{$Sno}_3' name='memEmail' value='" . $arrMember["memEmail"] . "' maxlength='128'/></div>
									<div class='form-inline pull-left'><label>聯絡地址：</label><input type='text' class='{$class}{$Sno}_4' name='memAddr' value='" . $arrMember["memCity"] . $arrMember["memArea"] . $arrMember["memAddr"] . "' maxlength='128'/></div>
									<div class='form-inline pull-left'><label>銀行名稱：</label><input type='text' class='{$class}{$Sno}_5' name='bankTitle' value='' maxlength='64'/></div>
									<div class='form-inline pull-left'><label>銀行代號：</label><input type='text' class='{$class}{$Sno}_6' name='bankCode' value='' maxlength='32'/></div>
									<div class='form-inline pull-left'><label>戶名：</label><input type='text' class='{$class}{$Sno}_7' name='bankName' value='' maxlength='64'/></div>
									<div class='form-inline pull-left'><label>帳號：</label><input type='text' class='{$class}{$Sno}_8' name='bankAccount' value='' maxlength='32'/></div>";
					$Form = "銀行資訊將不整合至用戶資料庫。" . $Form;
					break;
				case "charity" :
					$formInput = "<div class='form-inline pull-left'><label>捐款人姓名：</label><input type='text' class='{$class}{$Sno}_1' name='memName' value='" . $arrMember["memName"] . "' maxlength='32'/></div>
									<div class='form-inline pull-left'><label>聯絡手機：</label><input type='text' class='{$class}{$Sno}_2' name='memGsm' value='" . $arrMember["memGsm"] . "' maxlength='16'/></div>
									<div class='form-inline pull-left'><label>電子信箱：</label><input type='text' class='{$class}{$Sno}_3' name='memEmail' value='" . $arrMember["memEmail"] . "' maxlength='128'/></div>
									<div class='form-inline pull-left'><label>身分證字號：</label><input type='text' class='{$class}{$Sno}_4' name='memUid' value='" . $arrMember["memUid"] . "' maxlength='128'/></div>";
					$Form = "身分證字號將不整合至用戶資料庫。" . $Form;
					break;
				case "present" :
					$formInput = "<div class='form-inline pull-left'><label>收貨人姓名：</label><input type='text' class='{$class}{$Sno}_1' name='memName' value='" . $arrMember["memName"] . "' maxlength='32'/></div>
									<div class='form-inline pull-left'><label>聯絡手機：</label><input type='text' class='{$class}{$Sno}_2' name='memGsm' value='" . $arrMember["memGsm"] . "' maxlength='16'/></div>
									<div class='form-inline pull-left'><label>電子信箱：</label><input type='text' class='{$class}{$Sno}_3' name='memEmail' value='" . $arrMember["memEmail"] . "' maxlength='128'/></div>
									<div class='form-inline pull-left'><label>聯絡地址：</label><input type='text' class='{$class}{$Sno}_4' name='memAddr' value='" . $arrMember["memCity"] . $arrMember["memArea"] . $arrMember["memAddr"] . "' maxlength='128'/></div>
									<div class='form-inline pull-left'><label>收貨時間：</label><input type='checkbox' name='rTime[]' style='width:auto;' value='1'>09:00~12:00
																								<input type='checkbox' name='rTime[]' style='width:auto;' value='2'>12:00~18:00
																								<input type='checkbox' name='rTime[]' style='width:auto;' value='3'>18:00~22:00
																								<input type='checkbox' name='rTime[]' style='width:auto;' value='4'>假日
																								<input type='checkbox' name='rTime[]' style='width:auto;' value='5'>平日
									(複選)</div>";
					$Form = "送貨時間將不整合至用戶資料庫。" . $Form;
					break;
				case "mycard" :
					$formInput = "<div class='form-inline pull-left'><label>真實姓名：</label><input type='text' class='{$class}{$Sno}_1' name='memName' value='" . $arrMember["memName"] . "' maxlength='32'/></div>
									<div class='form-inline pull-left'><label>聯絡手機：</label><input type='text' class='{$class}{$Sno}_2' name='memGsm' value='" . $arrMember["memGsm"] . "' maxlength='16'/></div>
									<div class='form-inline pull-left'><label>電子信箱：</label><input type='text' class='{$class}{$Sno}_3' name='memEmail' value='" . $arrMember["memEmail"] . "' maxlength='128'/></div>
									<div class='form-inline pull-left'><label>身分證字號：</label><input type='text' class='{$class}{$Sno}_4' name='memUid' value='" . $arrMember["memUid"] . "' maxlength='128'/></div>";
					$Form = $Form;
					break;
			}
			$form1 = "<form id='{$class}{$Sno}' class='form' name='orderbonus' action='exchange_process.php' method='post' onsubmit='return goNext(\"{$class}{$Sno}\",\"{$class}\")' >
								<input type='hidden' name='class' value='{$class}' />
								<input type='hidden' name='sno' value='{$Sno}' />
								<input type='hidden' name='point' value='{$Bonus}' />
								<input type='hidden' name='title' value='{$Title}' />
								{$formInput}
								<div class='form-inline'>
									<label>備註：</label>
									<textarea style='width:543px;height:60px;' class='{$class}{$Sno}_9' name='webform'>{$Form}</textarea>
								</div>
								{$submitButton}
							</form>";

			$html1 .= "
				<div id='dialog-{$class}{$Sno}' hide>
					<article class='dialog exchange-content clearfix'>
						<section class='info clearfix'>
							<img class='pull-right' src='{$imgPath}{$Bpic}' />
							<div class='pull-left'>
								<h4>{$Title}</h4>
								<p>{$Intro}</p>
								<ul>
									<li>現有紅利 " . number_format($nowBonus) . "</li>
									<li>需要紅利 " . number_format($Bonus) . "</li>
									<li>此商品已兌換 " . number_format($Sold) . " 次</li>
								</ul>
							</div>
						</section>
						<hr />
						<section class='notes clearfix'>
							<div class='pull-left'>
								<h5>申請兌換前，請先確認以下資訊：</h5>
								<ol class='style'>
									{$PointList}
								</ol>
							</div>
						</section>
						<hr />
						<section class='mode clearfix'>
							{$Main}
						</section>
						<hr />
						<section class='action clearfix'>
							<h5><img src='img/icon/checked.png' />現在就申請兌換：進行兌換前請先將下列表單填寫清楚，以避免兌換的過程問題。</h5>
							{$form1}
						</section>
					</article>
				</div>";
		}
	}

	return $html;
}

function getMemberData($memSno, $dblink) {

	GLOBAL $db_hostname, $db_username, $db_password;

	if (is_null($dblink))
		$dblink = mysql_connect($db_hostname, $db_username, $db_password);

	$memSno = intval($memSno);
	$sql = "SELECT
						memEmail, memEmail2,memPassword, memNick, memName, memFbuid, memPic, memUid, memSex, memGsm, memBonus, memStatus, memBy, memBm, memBd, memZip, memCity, memArea, memAddress,memHtel
				   FROM
						oj_member
				   WHERE
						memSno = {$memSno}";

	$arrData = getAllData($sql, $dblink);

	if ($arrData) {

		$arrUser = array("memEmail" => $arrData[0]['memEmail'], "memEmail2" => $arrData[0]['memEmail2'], "memPassword" => $arrData[0]['memPassword'], "memNick" => $arrData[0]['memNick'], "memName" => $arrData[0]['memName'], "memFbuid" => $arrData[0]['memFbuid'], "memPic" => $arrData[0]['memPic'], "memUid" => $arrData[0]['memUid'], "memSex" => $arrData[0]['memSex'], "memGsm" => $arrData[0]['memGsm'], "memBonus" => $arrData[0]['memBonus'], "memStatus" => $arrData[0]['memStatus'], "memBirth" => $arrData[0]['memBy'] . "-" . $arrData[0]['memBm'] . "-" . $arrData[0]['memBd'], "memCity" => $arrData[0]['memCity'], "memArea" => $arrData[0]['memArea'], "memAddress" => $arrData[0]['memAddress'], "memZip" => $arrData[0]['memZip'], "memHtel" => $arrData[0]['memHtel']);

		return $arrUser;
	} else {
		return false;
	}
}

function gotoAlert($goURL, $errMsg) {

	echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
	echo "<script>\n";

	if ($errMsg != "")
		echo "alert(\"$errMsg\");\n";

	if ($goURL == "")
		echo "history.go(-1);\n";
	else {
		if (strpos($goURL, "?") > 0)
			echo "location.href=\"" . $goURL . "\";\n";
		else
			echo "location.href=\"" . $goURL . "\";\n";
	}

	echo "</script></html>\n";
	exit ;

}

//add by bitty
function isLogin() {
	if ($_SESSION['web_login'] && !empty($_SESSION['web_memSno'])) {
		return true;
	} else {
		return false;
		header('location: welcome.php');
	}
}

function session($x) {
	return $_SESSION[$x];
}

function userID($x) {
	return $_SESSION['web_memSno'];
}
function adminID(){
	return $_SESSION['admin_admSno'];
}

function isAdminLogin() {
	// if ($_SESSION['web_login'] && !empty($_SESSION['web_memSno'])) {
	if (isset($_SESSION['admin_login']) && isset($_SESSION['admin_admSno']) && $_SESSION['admin_login'] == true) {
		return true;
	} else {
		header('location: http://www.urbonus.com/manage/');
		return false;
	}
}
?>
