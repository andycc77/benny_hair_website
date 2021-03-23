<?php
if(isset($_GET["result"]) && $_GET["result"]=='success'){
?>
    <span class="message success"><strong>新增成功 </strong></span>
<?php
}else if(isset($_GET["result"]) && $_GET["result"]=='modify'){
?>
    <span class="message success"><strong>修改成功 </strong></span>
<?php
}else if(isset($_GET["result"]) && $_GET["result"]=='del'){
?>
    <span class="message success"><strong>刪除成功 </strong></span>
<?php
}
?>
<div id="content">
    <div class="column full">

            <div class="box themed_box">
                <h2 class="box-header"><?php echo $data['album']['Name']?></h2>
                <div class="box-content">

                <ul class="gallery-list">
                <?php foreach($data['pic'] as $key=>$val){
                    $nameAry = explode('.',$val['Name']);
                   $nameAry = explode('.', $val['rename']);
                    ?>
                    <li>
                        <p class="gallery-buttons">
                        <a class="button white" href="<?=site_url("/album_list/delitem/{$data['album']['Id']}/{$val['Id']}")?>"><span class="icon_single cancel"></span></a>
                        <!--a class="button white" href="<?=site_url("/album_list/delitem/{$data['album']['Id']}/{$val['Id']}")?>"><span class="icon_single edit"></span></a-->
                        </p>
                        <a class="lightbox" rel="lighbox-gallery"  href="<?php echo base_url('public/upload/album_pic/').'/'.$val['Name'];?>" title="<?php echo $val['Name']?>"><img src="<?php echo base_url('public/upload/album_pic/').'/'.$val['Name'];?>" alt="image-gallery"/><b><?php echo $nameAry[0]?></b></a>
                    </li>
                    <?php }?>
                </ul>
                <div class="clear"></div>
                </div>
            </div>

    </div>
</div>