<? 
	include_once("./configs/dbconfig.php");
	include_once("./include/includepath.php");
	include_once("./upload/webset/kindevent_sql.php");
	include_once('incl/doctype.php');
	include_once("./upload/webset/bannert_sql.php");
	shuffle($tmp_bannert_normal); $bannert = array();
	foreach($tmp_bannert_top as $one){ if(count($bannert) >= $webset_hbanTnum ){ break; } if($one['banStime'] <= $today and $today <= $one['banOtime']){ $bannert[] = $one; } }
	foreach($tmp_bannert_normal as $one){ if(count($bannert) >= $webset_hbanTnum ){ break; } if($one['banStime'] <= $today and $today <= $one['banOtime']){ $bannert[] = $one; } }
	
	# 預設
	$bannerHtml = "";
	$eventList  = "";
	$pageBar  	= "";
	$perPage  	= 5;
	$nowPage  	= (empty($_GET['page']) || !isset($_GET['page']))? 1: intval($_GET['page']);
	$kinSno		= (empty($_GET['k']) || !isset($_GET['k']))? 	   5: intval($_GET['k']);
	$lastLoginTag;
		
	# 如果已經登入 - 表示由紅利王進入 - 自動撈取使用者資料
	if($_COOKIE['web_login']){
		$sql = " select * from oj_member where memSno = '".$_COOKIE['web_memSno']."' ";
		$rowm = mysql_fetch_assoc(myquery($sql));
		$logintime = date('Y-m-d H:i:s',$_COOKIE['web_logintime']);
		$lastLoginTag = "<ul><li>最近一次登入時間：<br>{$logintime}</li></ul>";
	}
	
	
	# slider banner
	$i=0;
	foreach($bannert as $onebanner){ 
		//$bannerHtml .= "<a href=''><img src='img/temp/banner-{$i}.jpg' /></a>";
		$bannerHtml .= "<a href='{$onebanner['banLink']}' onclick='clicklink('bannert','{$onebanner['banSno']}','{$onebanner['banLink']}');' target='_blank'><img src='upload/bannert/{$onebanner['banPic']}' title='{$onebanner['banTitle']}'></a>";
	}

?>
<html lang="<?=$lang;?>">
    <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" charset="utf-8" />
		<?=$webMeta;?>
        <? include_once ('incl/setting.php'); ?>
		<script src="js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
		<link href="js/fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css"  media="screen" />
        <script type="text/javascript">
            $(function(){
				$(".fancy").fancybox({
					'autoDimensions': true,
					'titleShow'		: true,
					'transitionIn'	: 'fade',
					'transitionOut'	: 'fade',
					'width' : 740
				});
                $('.slides').slides({
                    preload: true,
                    preloadImage: 'img/loading.gif',
                    play: 7000,
                    pause: 2500,
                    hoverPause: true,
                    fadeEasing: "easeOutQuad",
                    fadeSpeed: 650,
                    effect: 'fade'
                });
            });
		function clicklink(table , sno , url){
			$.post("ajax/adclick.php", { act:"adclick", table:table, sno:sno },
				function(data){
					//window.open(url , "adwindow");
			},"text");
		}
		
        </script>
    </head>
    
    <body>
        <?php include_once('incl/header.php') ?>
        <div id="wrap">
            <div class="basicWidth clearfix">
                <aside id="side-wrap" class="pull-left">
                    <?php include_once('incl/side-personal.php') ?>
                    <nav class="side-box side-nav side-category">
                        <ul>
							<?php if($countrycode=='220'){ ?><li><a href="index.php"><b><img src="img/icon/tag.png"/></b>站內活動</a></li><?php }?>
							<li><a href="rewardme.php"><b><img src="img/icon/tag.png"/></b>RewardMint</a></li>
							<li  class="active"><a href="offerme.php"><b><img src="img/icon/tag.png"/></b>Offerme2</a></li>
							<?	//getEventKind($tmp_kindevent, $kinSno)?>
                        </ul>
                        <ul>
                            <li><a href="about.php"><b><img src="img/icon/about.png" /></b>關於我們</a></li>
                            <li><a href="terms.php"><b><img src="img/icon/text-list.png" /></b>會員條款</a></li>
                            <li><a href="privacy.php"><b><img src="img/icon/text-list.png" /></b>隱私權政策</a></li>
                        </ul>
                            <ul><li><a href="http://web.syinlu.org.tw/help/invoice_collection" target="_new"><img src="./img/syinlu.png" /></a></li></ul>
                        <ul>
							<li><div id="ajax-back"></div></li>
						</ul>
                            <?=$lastLoginTag?>
                    <? include_once('incl/side-fb.php') ?>
                    </nav>
                </aside>
                <div id="container" class="pull-right">
                    <div class="slides banner banner-large">
                        <div class="slides_container banner-list box-shadow shadow-bottom" data-focus="0">
                            <?=$bannerHtml?>
                        </div>
                    </div>
                    <hr />
                    <hr />
                    <div class="content-wrap activity-list">
                        <iframe style="overflow: hidden" src="http://pub.offerme2.com/78b539d6eb99b23f017c7e9f1b7d3c73?snuid=<?=$rowm['memFbuid']?>" frameborder="0" width="720" height="600"></iframe>
                    </div>
					<div class="pagination pagination-right">
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('incl/footer.php') ?>

        <?=$eventDetail?>

    </body>
</html>