<?php

function textLimit($subject,$strlen,$killhtml='') {

    if(!extension_loaded('mbstring')) {

        dl("mbstring.so");

    }

    if($killhtml){

        $subject = strip_tags($subject);

    }

    if(function_exists('mb_substr')) {

        $newstr  = mb_substr($subject, 0, $strlen, "UTF8");

        if (mb_strlen($subject,'UTF-8') > $strlen) {

            $newstr .= '...';

        }

    }

    return $newstr;

}
//print_r($data);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <title>男生燙髮,台北女生染髮東區西門町推薦髮型設計師觀光客指定-尚洋髮藝BENNY</title>
    <meta NAME="keywords" CONTENT="台北染髮,台北燙髮,男生燙髮,台北女生染燙,西門町染髮">
    <meta NAME="description" CONTENT="男生燙髮、台北女生染髮尚洋BENNY技術團隊由十年以上專業男生燙髮、台北女生染髮技術師經驗、男生女生燙髮染髮擁有英國、法國、義大利、日本、新加坡專業講師證照，髮質、頭皮專業檢測儀，台北女生男生燙髮染髮隨時替客人做好髮質和頭皮的調理。">

    <link rel="shortcut icon" href="/favicon.ico"/>


    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>/3dparty/bootstrap/css/bootstrap.min.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>/css/global.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>/css/typo.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>/3dparty/colorbox/colorbox.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>/3dparty/sweetalert/dist/sweetalert.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>/css/portfolio.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>/css/testimonials.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>/css/page-nav.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>/css/slider.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>/css/social.css"/>


    <!--Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic'
          rel='stylesheet' type='text/css'/>

    <!--Fonts with Icons-->
    <link rel="stylesheet" href="<?php echo base_url('public/')?>/3dparty/fontello/css/fontello.css"/>
    
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1858089391073431'); // Insert your pixel ID here.
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1858089391073431&ev=PageView&noscript=1"
    /></noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->

</head>
<body>

<div id="pi-all">

<!-- Header -->
<div class="pi-header">

<!-- Header Variant 8 -->

    <!-- Header row -->
    <div class="pi-section-w pi-section-white pi-shadow-bottom" style="z-index: 9999;">
            <div class="pi-section pi-row-lg">

            <!-- Logo -->
            <div class="pi-row-block pi-row-block-logo" style="margin-right: 25px;">
                <a href="<?php echo site_url('/welcome')?>"><img src="<?php echo base_url('public/')?>/img/logo-base.png" alt=""></a>
            </div>
            <!-- End logo -->

            <!-- Phone -->
            <div class="pi-row-block pi-row-block-txt pi-hidden-2xs">
                <i class="pi-row-block-icon icon-phone pi-icon-base pi-icon-square"></i>預約專線: <a href="tel:+886223820588"><strong>(02) 2382-0588</strong></a>
            </div>
            <!-- End phone -->

            <!-- Mobile menu button -->
            <div class="pi-row-block pi-pull-right pi-hidden-lg-only pi-hidden-md-only">
                <button class="btn pi-btn pi-mobile-menu-toggler" data-target="#pi-mobile-menu-8">
                    <i class="icon-menu pi-text-center"></i>
                </button>
            </div>
            <!-- End mobile menu button -->

            <!-- Social icons -->
            <div class="pi-row-block pi-pull-right pi-hidden-md">
                <ul class="pi-social-icons pi-round-corners pi-jump pi-colored-bg pi-active-bg pi-small">
                    <!--<li><a href="http://www.benny.com.tw/" class="pi-social-icon-twitter"><i class="icon-megaphone"></i></a></li>-->
                    <li><a href="https://www.facebook.com/bennysunyoung" class="pi-social-icon-facebook"><i class="icon-facebook"></i></a></li>
                    <!--<li><a href="http://kikimp6586.pixnet.net/blog" class="pi-social-icon-dribbble"><i class="icon-compass"></i></a></li>-->
                    <li style="width: 28px;height: 28px;"><a href="http://blog.yam.com/sunyoungbenny"><img src="<?php echo base_url('public/')?>/img/28benny.png" alt="" /></a></li>
                    <li style="width: 28px;height: 28px;"><a href="http://kikimp6586.pixnet.net/blog"><img src="<?php echo base_url('public/')?>/img/28pixnet.png" alt="" /></a></li>
                </ul>
            </div>
            <!-- End social icons -->

            <!-- Menu -->
            <div class="pi-row-block pi-pull-right">
                <ul class="pi-simple-menu pi-has-hover-border pi-full-height pi-hidden-sm">

                    <!-- Home -->
                    <li>
                        <a href="<?php echo site_url("/welcome") ?>"><span>首頁</span></a>
                    </li>
                    <!-- End home -->

                    <!-- Company -->
                    <li>
                        <a href="<?php echo site_url("/welcome#aboutme") ?>"><span>關於Benny</span></a>
                    </li>
                    <!--<li class="pi-has-dropdown">
                        <a href="#"><span>關於Benny</span></a>
                        <ul class="pi-submenu pi-has-border pi-items-have-borders pi-has-shadow pi-submenu-dark">
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Meet the team</a></li>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="#">Clients</a></li>
                            <li><a href="#">We are hiring</a></li>
                        </ul>
                    </li>-->
                    <!-- End company -->

                    <!-- Company -->
                    <li >
                        <a href="<?php echo site_url("/blog") ?>"><span>最新消息</span></a>
                    </li>
                    <!--<li class="pi-has-dropdown">
                        <a href="blog.html"><span>最新消息</span></a>
                        <ul class="pi-submenu pi-has-border pi-items-have-borders pi-has-shadow pi-submenu-dark">
                            <li><a href="#"><i class="icon-lamp"></i>Strategy solutions</a></li>
                            <li><a href="#"><i class="icon-monitor"></i>Digital design</a></li>
                            <li><a href="#"><i class="icon-cog"></i>Web development</a></li>
                            <li><a href="#"><i class="icon-link"></i>Social marketing</a></li>
                            <li><a href="#"><i class="icon-feather"></i>Copywriting</a></li>
                        </ul>
                    </li>-->
                    <!-- End company -->

                    <!-- Work -->
                    <li class="active">
                        <a href="<?php echo site_url("/album") ?>"><span>作品集</span></a>
                    </li>
                    <!-- End work -->


                    <!-- Contact -->
                    <li>
                        <a href="<?php echo site_url("/welcome#price") ?>"><span>價目表</span></a>
                    </li>
                    <!-- End contact -->

                    <!-- Contact -->
                    <li>
                        <a href="<?php echo site_url("/welcome#anchor-contact") ?>"><span>聯絡我們</span></a>
                    </li>
                    <!-- End contact -->
                    <li><a href="#" class="reservedBtn"><span style="color: rgb(255, 102, 0); font-weight: 600;">立即預約</span></a></li>

                </ul>
            </div>
            <!-- End menu -->

            <!-- Mobile menu -->
            <div id="pi-mobile-menu-8" class="pi-section-menu-mobile-w pi-section-dark">
                <div class="pi-section-menu-mobile">

                    <!-- Search form -->
                    <form class="form-inline pi-search-form-wide" role="form">
                        <div class="pi-input-with-icon">
                            <div class="pi-input-icon"><i class="icon-search-1"></i></div>
                            <input type="text" class="form-control pi-input-wide" placeholder="搜尋..">
                        </div>
                    </form>
                    <!-- End search form -->

                    <ul class="pi-menu-mobile pi-menu-mobile-dark">
                        <li><a href="<?php echo site_url("/welcome") ?>">首頁</a></li>
                        <li>
                            <a href="<?php echo site_url("/welcome#aboutme") ?>">關於Benny</a>
                            <!--<ul>
                                <li>
                                    <a href="index.html">首頁</a>
                                </li>
                                <li>
                                    <a href="index.html">Portfolio</a>
                                </li>
                                <li>
                                    <a href="index.html">Blog</a>
                                </li>
                            </ul>-->
                        <li>
                            <a href="<?php echo site_url("/blog") ?>">最新消息</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo site_url("/album") ?>">作品集</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("/welcome#price") ?>">服務價目</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("/welcome#anchor-contact") ?>">聯絡我們</a>
                        </li>
                    </ul>

                </div>
            </div>

            <!-- End mobile menu -->

            </div>
        </div>
    <!-- End header row -->

<!-- End header Variant 8 -->

</div>


</div>
<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-white">
<div class="pi-section">

<div class="pi-text-center pi-margin-bottom-50">
    <h1 class="pi-uppercase pi-weight-700 pi-has-border pi-has-tall-border pi-has-short-border">
        作品集
    </h1>
</div>

<div class="pi-row pi-padding-bottom-20 isotope" data-isotope-mode="masonry">
    <?php foreach ($data as $key => $val) {
        $Name = textLimit($val['Name'],30);
        ?>
    <div class="pi-col-sm-4 pi-col-xs-6 isotope-item">
        <div class="pi-portfolio-item pi-portfolio-description-box pi-portfolio-item-round-corners">

            <div class="pi-img-w pi-img-round-corners pi-img-hover-zoom">
                <!--<a href="<?php echo base_url('admin/public/upload/tmp')?>/<?php echo $val['Lpic']?>" class="pi-colorbox cboxElement">-->
                <a href="<?php echo site_url('/albuminside/index')?>/<?php echo $val['Id']?>" class="cboxElement">
                    <img src="<?php echo base_url('admin/public/upload/tmp')?>/<?php echo $val['Lpic']?>" alt="">

                    <div class="pi-img-overlay pi-no-padding pi-img-overlay-dark">
                        <div class="pi-caption-centered">
                            <div>
                                <span class="pi-caption-icon pi-caption-icon-dark pi-caption-scale icon-search"></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="pi-portfolio-description pi-portfolio-description-round-corners">

                <ul class="pi-portfolio-cats">
                    <li><i class="icon-clock"></i><?php echo date("Y-m-d",$val['Time_from']);?></li>
                    <!--<li><i class="icon-comment"></i><a href="#">14</a></li>-->
                    <!--<li><i class="icon-eye"></i>372</li>-->
                </ul>

                <h2 class="h4"><a href="<?php echo site_url('/albuminside/index')?>/<?php echo $val['Id']?>" class="pi-link-no-style"><?php echo $Name?></a>
                </h2>

                <p><?php echo $val['Desc']?></p>


            </div>
        </div>
    </div>
<?php }?>
</div>


<!--div class="pi-pagenav pi-text-center">
    <ul>
        <li><a href="#">上一頁</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#" class="pi-active">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">...</a></li>
        <li><a href="#">115</a></li>
        <li><a href="#">下一頁</a></li>
    </ul>
</div-->

</div>
</div>

<!-- - - - - - - - - - END SECTION - - - - - - - - - --></div>

<!-- Footer -->
<!-- Widget area -->
<div class="pi-section-w pi-border-bottom pi-border-top-light pi-section-dark">
    <div class="pi-section pi-padding-top-60 pi-padding-bottom-10">

        <!-- Row -->
        <div class="pi-row">

            <!-- Col 3 -->
            <div class="pi-col-md-3 pi-col-xs-6 pi-padding-bottom-30">

                <div class="pi-icon-box-vertical pi-text-center">

                    <div class="pi-icon-box-icon pi-icon-box-icon-dark">
                        <i class="icon-location"></i>
                    </div>

                    <h6 class="pi-margin-bottom-20 pi-weight-700 pi-uppercase pi-letter-spacing">
                        尚洋成都店
                    </h6>

                    <p>
                        台北市成都路54號2樓 <br>
                        (捷運西門站1號出口,康是美樓上)
                    </p>

                </div>

            </div>
            <!-- End col 3 -->

            <!-- Col 3 -->
            <div class="pi-col-md-3 pi-col-xs-6 pi-padding-bottom-30">

                <div class="pi-icon-box-vertical pi-text-center">

                    <div class="pi-icon-box-icon pi-icon-box-icon-dark">
                        <i class="icon-phone"></i>
                    </div>

                    <h6 class="pi-margin-bottom-20 pi-weight-700 pi-uppercase pi-letter-spacing">
                        預約專線
                    </h6>

                    <p>
                        <a href="tel:+886223820588">(02) 2382-0588</a>
                    </p>

                </div>

            </div>
            <!-- End col 3 -->

            <!-- Col 3 -->
            <div class="pi-col-md-3 pi-col-xs-6 pi-padding-bottom-30">

                <div class="pi-icon-box-vertical pi-text-center">

                    <div class="pi-icon-box-icon pi-icon-box-icon-dark">
                        <i class="icon-eye"></i>
                    </div>

                    <h6 class="pi-margin-bottom-20 pi-weight-700 pi-uppercase pi-letter-spacing">
                        相關連結
                    </h6>
                    
                    <!--<img src="<?php echo base_url('public/')?>/img/logo-fg.png" alt="" style="width: 26px; height: 26px;"/>-->

                    <ul class="pi-social-icons pi-colored-bg pi-round pi-jump pi-clearfix">
                        <li><a href="https://www.facebook.com/bennysunyoung" class="pi-social-icon-facebook"><i class="icon-facebook"></i></a></li>
                        <li><a href="http://blog.fashionguide.com.tw/8400/posts" class="pi-social-icon-fg"><i class="logo-fg"></i></a></li>
                        <li><a href="http://blog.xuite.net/bennychen0213/wretch" class="pi-social-icon-twitter"><i class="logo-benny"></i></a></li>
                        <li><a href="http://kikimp6586.pixnet.net/blog" class="pi-social-icon-pixnet"><i class="logo-pixnet"></i></a></li>
                    </ul>

                </div>

            </div>
            <!-- End col 3 -->

            <!-- Col 3 -->
            <div class="pi-col-md-3 pi-col-xs-6 pi-padding-bottom-30">

                <div class="pi-icon-box-vertical pi-text-center">

                    <div class="pi-icon-box-icon pi-icon-box-icon-dark">
                        <i class="icon-briefcase"></i>
                    </div>

                    <h6 class="pi-margin-bottom-20 pi-weight-700 pi-uppercase pi-letter-spacing">
                        線上預約
                    </h6>

                    <p>
                        立即預約
                        <br>
                        <a href="#" class="reservedBtn">預約網址</a>
                    </p>

                </div>

            </div>
            <!-- End col 3 -->

        </div>
        <!-- End row -->

    </div>
</div>
<!-- End widget area -->

<!-- Copyright area -->
<div class="pi-section-w pi-section-dark pi-border-top-light pi-border-bottom-strong-base">
    <div class="pi-section pi-row-lg pi-center-text-2xs pi-clearfix">


        <!-- Text -->
        <span class="pi-row-block pi-row-block-txt pi-hidden-xs">&copy; 2015. &laquo;<a href="#">KasePlay</a>&raquo;.
            All right reserved.
        </span>
        <!-- End text -->



    </div>
</div>
<!-- End copyright area -->
<!-- End footer -->

</div>
<div class="pi-scroll-top-arrow" data-scroll-to="0"></div>

<script src="<?php echo base_url('public/')?>/3dparty/jquery-1.11.0.min.js"></script>
<script src="<?php echo base_url('public/')?>/3dparty/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo base_url('public/')?>/js/phantas-custom.js"></script>
<script src="<?php echo base_url('public/')?>/3dparty/bootstrap/js/bootstrap.min.js"></script>
<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/masonry/3.2.2/masonry.pkgd.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url('public/')?>/3dparty/FitVids.js/jquery.fitvids.js"></script>
<script src="<?php echo base_url('public/')?>/3dparty/jquery.touchSwipe.min.js"></script>
<script src="<?php echo base_url('public/')?>/3dparty/isotope/isotope.js"></script>
<script src="<?php echo base_url('public/')?>/3dparty/requestAnimationFramePolyfill.min.js"></script>
<script src="<?php echo base_url('public/')?>/3dparty/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url('public/')?>/3dparty/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url('public/')?>/3dparty/colorbox/jquery.colorbox-min.js"></script>
<script src="<?php echo base_url('public/')?>/scripts/pi.global.js"></script>
<!--<script src="<?php echo base_url('public/')?>/scripts/pi.init.fitvids.js"></script>-->
<script src="<?php echo base_url('public/')?>/scripts/pi.slider.js"></script>
<script src="<?php echo base_url('public/')?>/scripts/pi.init.slider.js"></script>
<script src="<?php echo base_url('public/')?>/scripts/pi.init.isotope.js"></script>



</body>
</html>