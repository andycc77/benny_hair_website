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
<span class="message success" style="display:none"><strong>新增成功 </strong></span>
<div id="content">
        <div class="box themed_box fl width50">
            <ul class="box-header-btn"></ul>
            <h2 class="box-header">
                <p class="icons_pack"><span class="pack _111"></span></p>
                文章分類            </h2>
            <div class="box-content box-table editmod">
                <input type="hidden" name="act" value="upload">
                <table class="tablebox">
                    <thead class="table-header"><tr><th>欄位</th><th>內容</th><th>執行</th></tr></thead>
                    <tbody class="table-data">
                    <?php foreach($data as $key => $val){?>
                        <tr>
                            <td width="20%" class="even"><?php echo $val['Id']?></td>
                            <td width="50%" class="odd"><input type="text" name="name_<?php echo  $val['Id']?>" id="name_<?php echo  $val['Id']?>" value="<?php echo $val['Name']?>" class="form-field small"></td>
                            <td width="30%" class="even">
                            <a class="button white" href="blog_kind/del/<?php echo $val['Id']?>" onclick="return confirm('確定要刪除此筆資料?')"><span class="icon_single cancel"></span></a>
                            <a class="button white" href="javascript:modify('<?php echo $val['Id']?>')"><span class="icon_single save"></span></a></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box themed_box fl width70">
            <ul class="box-header-btn"></ul>
            <h2 class="box-header">
                <p class="icons_pack"><span class="pack _111"></span></p>
                新增分類            </h2>
            <div class="box-content box-table editmod">
            <form name="webform" action="<?=site_url("/blog_kind/add")?>" method="post">
                <input type="hidden" name="act" value="upload">
                <table class="tablebox">
                    <thead class="table-header"><tr><th>欄位</th><th>內容</th></tr></thead>
                    <tbody class="table-data">
                        <tr>
                            <td width="20%" class="even">分類名稱</td>
                            <td width="80%" class="odd"><input type="text" name="name" id="name" value="" class="form-field half"></td>
                        </tr>
                    </tbody>
                </table>
                <ul class="tablefooter">
                    <input type="submit" value="新增資料" class="button themed" />
                </ul>
                </form>
            </div>
        </div>
        <div class="clear">
    </div>
<script>
    function modify($id){
        var name = $('#name_'+$id).val();
        var sendval = "name="+name;
        jQuery.ajax({
        url: 'blog_kind/modify/'+$id,
        type: "POST",
        data: sendval,
        dataType: "json",
        beforeSend: function() {
        },
        complete: function() {},
        success: function(json){
            $('.success').css("display","block");
        }
        });
    }
</script>