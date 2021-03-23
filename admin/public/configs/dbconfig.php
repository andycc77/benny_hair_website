<?php
	session_start(); //中


	/*if($_SERVER['REMOTE_ADDR'] == "182.235.182.232" ){
	}else{
		header("location:../404.shtml");
	}*/
	$db_hostname="localhost"; $db_username="root"; $db_password="benny55688"; $db_database="bennycom_db";
	//$db_hostname="localhost"; $db_username="root"; $db_password="urbonus"; $db_database="urbonus_jelly";
	//$db_hostname="localhost"; $db_username="jellyhttp"; $db_password="dontwork30"; $db_database="urbonus";
	if(!($dblink=mysql_connect($db_hostname,$db_username,$db_password))){ echo("mysql connect false"); exit(); }
	@ mysql_query("SET NAMES 'UTF8'");
	if (!mysql_select_db($db_database,$dblink)){ echo("select database false"); exit(); }
	function myquery($sql){
		if(preg_match('/union/i',$sql)){
			mysql_query("insert into oj_sqlinjection set fuip = '".$_SERVER['REMOTE_ADDR']."' , fuurl = '".mysql_real_escape_string($_SERVER['REQUEST_URI'])."' , fuget = '".mysql_real_escape_string($_SERVER['QUERY_STRING'])."' , fusql = '".mysql_real_escape_string($sql)."' ");
			return NULL;
		}

		$match_arr = array();
		$match_arr[] = "\\sselect";
		//$match_arr[] = "select\\s";
		$match_arr[] = "\\sselect\\s";
		$match_arr[] = "\\supdate";
		//$match_arr[] = "update\\s";
		$match_arr[] = "\\supdate\\s";
		$match_arr[] = "\\sinsert";
		//$match_arr[] = "insert\\s";
		$match_arr[] = "\\sinsert\\s";
		$match_arr[] = "\\sdelete";
		//$match_arr[] = "delete\\s";
		$match_arr[] = "\\sdelete\\s";
		$match_arr[] = "\\sreplace";
		//$match_arr[] = "replace\\s";
		$match_arr[] = "\\sreplace\\s";
		$match_str = implode("|", $match_arr);
		preg_match_all('/'.$match_str.'/i',$sql,$match);
		$sqlnum = count($match[0]);
		if($sqlnum <= 1){
			$res = mysql_query($sql);
			return $res;
		}else{
			mysql_query("insert into oj_sqlinjection set fuip = '".$_SERVER['REMOTE_ADDR']."' , fuurl = '".mysql_real_escape_string($_SERVER['REQUEST_URI'])."' , fuget = '".mysql_real_escape_string($_SERVER['QUERY_STRING'])."' , fusql = '".mysql_real_escape_string($sql)."' ");
			return NULL;
		}
	}
	include_once("phperror.php");
	$cms_webBaseName = basename($_SERVER['PHP_SELF']);

	//當以下條件伏合時表示為管理員 , 可使用 $jellydev 放於它處進行判別
	//if($_SERVER['REMOTE_ADDR'] == "220.135.49.66" or $_SERVER['REMOTE_ADDR'] == "192.168.1.3" or $_SERVER['REMOTE_ADDR'] == "127.0.0.1" or $_COOKIE['admin_admId'] == "jellyalex978"){ $jellydev = true; }else{ $jellydev = false; }

?>