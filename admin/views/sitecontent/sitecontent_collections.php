<?php
if(isset($_GET["result"]) && $_GET["result"]=='success'){
?>
    <span class="message success"><strong>新增成功 </strong></span>
<?php
}else if(isset($_GET["result"]) && $_GET["result"]=='modify'){
?>
    <span class="message success"><strong>變更成功 </strong></span>
<?php
}else if(isset($_GET["result"]) && $_GET["result"]=='del'){
?>
    <span class="message success"><strong>刪除成功 </strong></span>
<?php
}
$x=0;
?>
<span class="message success" style="display: none"><strong>變更成功 </strong></span>
<div id="content">
    <div class="box themed_box">
        <ul class="box-header-btn">
        </ul>
        <h2 class="box-header">首頁編輯 - 精選作品</h2>
        <form name="webform" action="<?=site_url("/sitecontent_video/update")?>" method="post">
        <div class="box-content box-table editmod">
            <table class="tablebox">
                <thead class="table-header">
                    <tr>
                        <th>No.</th>
                        <th>分類名稱</th>
                        <th>選擇相簿 (每個分類最多選取兩本相簿，用ctrl鍵+滑鼠左鍵 做多選)</th>
                        <th>儲存變更</th>
                    </tr>
                </thead>
                <tbody class="openable-tbody">
                <?php foreach($data as $r){
                $AlbumIdAry = explode(',', $r['AlbumId'])   ?>
                    <tr <?php echo $x%2==0 ? "class=\"odd\"" : "class=\"even\""?>>
                        <td width="5%">
                            <?php echo $r['Id']?>
                        </td>
                        <td><input type="text" name="collectionname_<?php echo $r['Id']?>" id="collectionname_<?php echo $r['Id']?>" value="<?php echo $r['Collectionname']?>" class="form-field half"></td>
                        <td>
                           <select id="album_<?php echo $r['Id']?>" name="album_<?php echo $r['Id']?>" multiple="multiple">
                            <?php foreach($albumitem as $key => $val){
                                if(in_array($val['Id'],$AlbumIdAry)){?>
                                    <option selected value="<?php echo $val['Id']?>"><?php echo $val['Name']?></option>

                            <?php }else{
                            ?>
                            <option  value="<?php echo $val['Id']?>"><?php echo $val['Name']?></option>
                                <?php }}?>
                            </select>
                        </td>
                        <td>
                            <a class="button white" href="javascript:modify('<?php echo $r['Id']?>')"><span class="icon_single save"></span></a>
                        </td>
                    </tr>
                <?php $x++;}?>
                </tbody>
            </table>
        </div>
        </form>
    </div>
</div>
<script>
    function modify($id){
        var collectionname = $('#collectionname_'+$id).val();
        var albumname = $('#album_'+$id).val();
        jQuery.ajax({
        url: 'sitecontent_collections/modify/'+$id,
        type: "POST",
        data:"&collectionname="+collectionname+"&albumname="+albumname,
        dataType: "json",
        beforeSend: function() {
        },
        complete: function() {},
        success: function(json){
          //console.log(json);
          //alert(json['result']);
          if(json['result']=='updated'){
            $('.success').css("display","block");
          }
        }
        });
    }
</script>