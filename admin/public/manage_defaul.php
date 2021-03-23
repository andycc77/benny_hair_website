<?php
	$cms_filecheck = array("header.php" , "menuer.php" , "footer.php" , "index.php" , "forget.php" , "godie.php" , "uploadfiles.php" , "dashboard.php" , "nopower.php" , "tmp.php");
	if(in_array($cms_webBaseName , $cms_filecheck)) {
		$rootPath = "../";
		$managePath = "./";
	}else{
		$rootPath = "../../";
		$managePath = "../";
	}
	include_once($rootPath."upload/webset/webset_sql.php");
	include_once($rootPath."language/lang.php");

	$manageTitle = " MFA CMS ";
	$manageMeta = '
	<meta name="robots" content="noindex,nofollow" />
	<link rel="shortcut icon" href="'.$managePath.'images/myico.ico" />
	<link rel="Bookmark" href="'.$managePath.'images/myico.ico" />
	<title>'.$manageTitle.'</title>
	<link rel="stylesheet" type="text/css" href="'.$managePath.'css/jquery/jquery.ui.all.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="'.$managePath.'css/style.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="'.$managePath.'css/jelly.css" media="screen"/>
	
	<!--[if IE]><script type="text/javascript" src="'.$managePath.'js/excanvas.js"></script><![endif]-->
	<script type="text/javascript" src="'.$managePath.'js/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="'.$managePath.'js/jquery-ui-1.8.2.js"></script>
	<link rel="stylesheet" type="text/css" href="'.$managePath.'js/prettyphoto/prettyPhoto.css" media="screen"/>
	<script type="text/javascript" src="'.$managePath.'js/prettyphoto/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="'.$managePath.'js/jquery.validate.js" ></script>
	<script type="text/javascript" src="'.$managePath.'js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="'.$managePath.'js/jquery.flot.js"></script>
	<script type="text/javascript" src="'.$managePath.'js/jquery.flot.stack.js"></script>
	<script type="text/javascript" src="'.$managePath.'js/styleswitch.js"></script>
	
	<script type="text/javascript" src="'.$managePath.'js/jelly.js"></script>
	
	<script type="text/javascript" src="'.$rootPath.'ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="'.$rootPath.'ckfinder/ckfinder.js"></script>
	
	';
?>