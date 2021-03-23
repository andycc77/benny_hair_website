<?php
    $nowPage='';
    $nowPageLink    = $_SERVER['PHP_SELF'];
    $nowPageAry = explode('/', $nowPageLink);
    foreach($nowPageAry as $key => $val){
        if(strstr($val,'_')){
            $nowPage = $val;
        }
    }
    $nowPageAry = explode('_', $nowPage);
    $nowtitle = $nowPageAry['0'];

    switch ($nowtitle) {
        case 'sitecontent':
            $subtitleDisplay=0;
            break;
        case 'album':
            $subtitleDisplay=1;
            break;
        case 'comments':
            $subtitleDisplay=3;
            break;
        case 'blog':
            $subtitleDisplay=2;
            break;
        default:
            # code...
            break;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>
            <?php
                if(isset($pageTitle)){
                    echo $pageTitle ; //透過變數設定
                } else{
                    echo "管理系統" ; //預設標題
                }
            ?>
        </title>
            <?php echo css('jquery/jquery.ui.all.css'); ?>
            <?php echo css('table_data.css'); ?>
            <?php echo css('lightbox/style.css'); ?>
            <?php echo css('style.css'); ?>



            <!--[if IE]><script type="text/javascript" src="js/excanvas.js"></script><![endif]-->
            <?php echo script('jquery-1.4.2.js'); ?>
            <?php echo script('jquery-ui-1.8.2.js'); ?>
            <?php echo script('jquery.fancybox-1.3.2.js'); ?>
            <?php echo script('jquery.validate.js'); ?>
            <?php echo script('jquery.wysiwyg.js'); ?>
            <?php echo script('jquery.dataTables.js'); ?>
            <?php echo script('jquery.flot.js'); ?>
            <?php echo script('jquery.flot.stack.js'); ?>
            <?php echo script('styleswitch.js'); ?>
            <?php echo script('custom.js'); ?>
<script type="text/javascript">
$(function() {
    $("#subnavbar>ul").eq(<?php echo $subtitleDisplay?>).show();
    $("#subnavbar>ul.active").show();
    $("#navbar>li").each(function(i) {
        $(this).click(function(){
            $("#subnavbar>ul").hide();
            $("#subnavbar>ul").eq(i).show();
            clearTimeout(menu_autotimer_id);
            menu_autotimer_id = setTimeout("menu_auto_active()" , menu_autotimer_time);
        });
    });
});
</script>
    </head>
<body>
<div id="wrapper">
      <ul id="topbar">
        <li><a class="button white fl" title="preview" target="_new" href="<?php echo base_url('../')?>"><span class="icon_single preview"></span></a></li>
        <li class="s_1"></li>
        <li class="logo">
        <?php if(isset($_SESSION["user"]) && $_SESSION["user"] != null){ ?>
            <li class="fr"><a class="button red fl" title="logout" href="<?php echo site_url('admin/logout')?>"><span class="icon_text logout"></span>logout</a></li>
        <?php }?>
      </ul>
    <?php if(isset($_SESSION["user"]) && $_SESSION["user"] != null){ ?>
        <ul id="navbar">
            <li <?php echo ($nowtitle == 'sitecontent')? "class='active'":"";?>><a href='#'></span>首頁編輯</a>
            </li>
            <li <?php echo ($nowtitle == 'album')? "class='active'":"";?>><a href='#'><span class="icon_text design"></span>作品集</a>
            </li>
            <li <?php echo ($nowtitle == 'blog')? "class='active'":"";?>><a href='#'><span class="icon_text pages"></span>部落格</a></li>
            <li <?php echo ($nowtitle == 'comments')? "class='active'":"";?>><a href='#'><span class="icon_text pages"></span>留言管理</a></li>
        </ul>
        <div id="subnavbar">
            <ul class="" style="display: none;">
                <li class="<?=($nowPageAry['1'] == 'picture')?"active":"";?>"><a class="subbutton white" href="<?php echo site_url('sitecontent_picture')?>"><span class="icon_text gallery"></span>首頁Banner</a></li>
                <li class="<?=($nowPageAry['1'] == 'video')?"active":"";?>"><a class="subbutton white" href="<?php echo site_url('sitecontent_video')?>"><span class="icon_text pack _28"></span>首頁影片</a></li>
                <li><a class="subbutton white" href="<?php echo site_url('sitecontent_collections')?>"><span class="icon_text pack _33"></span>精選作品</a></li>
                <li class="<?=($nowPageAry['1'] == 'about')?"active":"";?>"><a class="subbutton white" href="<?php echo site_url('sitecontent_about')?>"><span class="icon_text pack _55"></span>關於我</a></li>
                <li class="<?=($nowPageAry['1'] == 'price')?"active":"";?>"><a class="subbutton white" href="<?php echo site_url('sitecontent_price')?>"><span class="icon_text pack _14"></span>價目表</a></li>
                <li class="<?=($nowPageAry['1'] == 'contact')?"active":"";?>"><a class="subbutton white" href="<?php echo site_url('sitecontent_contact')?>"><span class="icon_text pack _284"></span>聯絡我們</a></li>
            </ul>
            <ul class="" style="display: none;">
                <li class="<?=($nowPageAry['1'] == 'list')?"active":"";?>"><a class="subbutton white" href="<?php echo site_url('album_list')?>"><span class="icon_text pack _56"></span>相簿管理</a></li>
            </ul>
            <ul class="" style="display: none;">
                <li class="<?=($nowPageAry['1'] == 'list')?"active":"";?>"><a class="subbutton white" href="<?php echo site_url('blog_list')?>"><span class="icon_text pack _56"></span>文章管理</a></li>
                <li class="<?=($nowPageAry['1'] == 'kind')?"active":"";?>"><a class="subbutton white" href="<?php echo site_url('blog_kind')?>"><span class="icon_text pack _56"></span>文章分類</a></li>
            </ul>
            <ul class="" style="display: none;">
                <li class="<?=($nowPageAry['1'] == 'list')?"active":"";?>"><a class="subbutton white" href="<?php echo site_url('comments_list')?>"><span class="icon_text pack _284"></span>留言列表</a></li>
            </ul>
        </div>
    <?php }?>
    <?php $this->load->view($subview); ?>

</div>

    <div id="footer">
      <p class="copy fl">Copyright 2015<strong> KasePlay </strong> All right reserved.</p>
      <!--ul class="button language_button white fr">
        <li class="icon_single language fl"></li>
        <li class="flag en fl"></li>
        <li class="flag es fl"></li>
        <li class="flag de fl"></li>
        <li class="flag it fl"></li>
        <li class="clear"></li>
      </ul-->

      <!--ul class="skinner fr">
        <li class="fl"><a href="#" rel="style_blue" class="styleswitch skin skin_blue fl"></a></li>
        <li class="fl"><a href="#" rel="style_green" class="styleswitch skin skin_green fl"></a></li>
        <li class="fl"><a href="#" rel="style_red" class="styleswitch skin skin_red fl"></a></li>
        <li class="fl"><a href="#" rel="style_purple" class="styleswitch skin skin_purple fl"></a></li>
        <li class="clear"></li>
     </ul-->
    </div>
</body>
</html>