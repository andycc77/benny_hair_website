
    <script src="<?php echo base_url();?>public/js/jquery.imgareaselect.min.js" type="text/javascript"></script>

    <?php if($large_photo_exists && $thumb_photo_exists == NULL):?>
    <script src="<?php echo base_url();?>public/js/jquery.imgpreview.js" type="text/javascript"></script>
    <script type="text/javascript">
    // <![CDATA[
        var thumb_width    = <?php echo $thumb_width ;?> ;
        var thumb_height   = <?php echo $thumb_height ;?> ;
        var image_width    = <?php echo $img['image_width'] ;?> ;
        var image_height   = <?php echo $img['image_height'] ;?> ;
    // ]]>
    </script>
    <?php endif ;?>


<?php if($large_photo_exists && $thumb_photo_exists) :?>
<div id="content">
    <div class="box themed_box">
        <h2 class="box-header">首頁Banner-新增</h2>
        <div class="box-content box-table editmod">
        <form action="<?=site_url("/sitecontent_picture_add/add")?>" method="post"  >
            <table class="tablebox">
                <thead class="table-header"><tr><th>欄位</th><th>內容</th></tr></thead>
                <tbody class="table-data">
                    <tr>
                        <td width="10%" class="even">Picture</td>
                        <td width="40%" class="odd">
                            <img src="<?php echo base_url().'public/upload/thumbs/'.$thumb_photo_exists ?>" alt="Thumbnail Image" style="width:20%"/><input type="hidden" name="pic" value="<?php echo $thumb_photo_exists?>">&nbsp
                            <a class="button white" href="<?php echo $_SERVER["PHP_SELF"];?>"><span class="icon_single cancel"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td width="10%" class="even">狀態</td>
                        <td width="40%" class="odd">
                            <select id="status" name="status">
                                    <option value="1">上架</option>
                                    <option value="0">下架</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="10%" class="even">排序</td>
                        <td width="40%" class="odd">
                            <input type="text" name="order" id="order" value="0" class="form-field small">
                        </td>
                    </tr>
                </tbody>
            </table>
            <ul class="tablefooter">
                <input type="submit" name="upload_thumbnail" class="button themed" value="新增" id="save_thumb" />
            </ul>
        </form>
        </div>
    </div>
</div>
<?php elseif($large_photo_exists && $thumb_photo_exists == NULL) :?>
<div id="content">
    <div class="box themed_box">
        <h2 class="box-header">首頁Banner-新增</h2>
        <div class="box-content box-table editmod">
            <form name="thumbnail" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <table class="tablebox">
                <thead class="table-header"><tr><th>欄位</th><th>內容</th></tr></thead>
                <tbody class="table-data">
                    <tr>
                        <td width="10%" class="even">Picture</td>
                        <td width="40%" class="odd">
                            <img src="<?php echo base_url() . $upload_path.$img['file_name'];?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />
                            <!--div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
                                <img src="<?php echo base_url() . $upload_path.$img['file_name'];?>" style="position: relative;" alt="Thumbnail Preview" />
                            </div-->
                    <br style="clear:both;"/>
                <input type="hidden" name="x1" value="" id="x1" />
                <input type="hidden" name="y1" value="" id="y1" />
                <input type="hidden" name="x2" value="" id="x2" />
                <input type="hidden" name="y2" value="" id="y2" />
                <input type="hidden" name="file_name" value="<?php echo $img['file_name'] ;?>" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <ul class="tablefooter">
                <input type="submit" name="upload_thumbnail" class="button themed" value="裁切上傳" id="save_thumb" />
            </ul>
            </form>
        </div>
    </div>
</div>
<?php   else : ?>
<div id="content">
    <div class="box themed_box">
        <h2 class="box-header">首頁Banner-新增</h2>
        <div class="box-content box-table editmod">
            <table class="tablebox">
                <thead class="table-header"><tr><th>欄位</th><th>內容</th></tr></thead>
                <tbody class="table-data">
                    <tr>
                        <td width="10%" class="even">Picture</td>
                        <td width="40%" class="odd">
                            <form name="photo" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<input type="file" name="image" size="30"/> <input type="submit" name="upload" class="button themed" value="圖片上傳" />
</form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php   endif ?>

