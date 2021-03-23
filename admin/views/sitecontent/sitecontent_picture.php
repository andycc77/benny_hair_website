<?php
//print_r($data);
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
            <li class="button white"><a href="sitecontent_picture_add"><span class="icon_text addnew"></span>新增一個大圖</a></li>
        </ul>
        <h2 class="box-header">首頁編輯 - 首頁輪播大圖</h2>
        <form name="webform" action="<?=site_url("/sitecontent_video/update")?>" method="post">
        <div class="box-content box-table editmod">
            <table class="tablebox">
                <thead class="table-header">
                    <tr>
                        <th>大圖</th>
                        <th>狀態</th>
                        <th>排序</th>
                        <th>刪除照片&ensp;或&ensp;儲存變更</th>
                    </tr>
                </thead>
                <tbody class="openable-tbody">
                <?php foreach($data as $r){   ?>
                    <tr <?php echo $x%2==0 ? "class=\"odd\"" : "class=\"even\""?>>
                        <td width="25%"><img src="<?php echo base_url('public/upload/thumbs/').'/'.$r['Pic'];?>" class="borimg" width="70%"></td>
                        <td width="25%">
                            <select id="status_<?php echo  $r['Id']?>" name="status_<?php echo  $r['Id']?>">
                                <option value="1" <?php echo $r['Status'] ==1 ? "selected=\"selected\"" : ""?>>顯示</option>
                                <option value="0" <?php echo $r['Status'] ==0 ? "selected=\"selected\"" : ""?>>隱藏</option>
                            </select>
                        </td>
                        <td width="25%">
                            <input type="text" name="order_<?php echo  $r['Id']?>" id="order_<?php echo  $r['Id']?>" value="<?php echo $r['Order']?>" class="form-field small">
                        </td>
                        <td width="25%">
                            <a class="button white" href="sitecontent_picture/del/<?php echo $r['Id']?>" onclick="return confirm('確定要刪除此筆資料?')"><span class="icon_single cancel"></span></a>
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
        var status = $('#status_'+$id).val();
        var order = $('#order_'+$id).val();
        jQuery.ajax({
        url: 'sitecontent_picture/modify/'+$id+'/'+status+'/'+order,
        type: "GET",
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