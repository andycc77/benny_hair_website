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
$x=0;
?>
<span class="message success" style="display: none"><strong>修改成功 </strong></span>
<div id="content">
    <div class="box themed_box">
        <ul class="box-header-btn">
            <li class="button white"><a href="<?=site_url("/album_list/addPic
            ")?>"><span class="icon_text addnew"></span>新增圖片</a></li>
            <li class="button white"><a href="album_add"><span class="icon_text addnew"></span>新增相簿</a></li>
        </ul>
        <h2 class="box-header">作品集 - 相簿管理</h2>
        <div class="box-content box-table editmod">
            <table class="tablebox">
                <thead class="table-header">
                    <tr>
                        <th>相簿</th>
                        <th>上架日期</th>
                        <!--th>下架日期</th-->
                        <th>名稱</th>
                        <th>敘述</th>
                        <th>執行</th>
                    </tr>
                </thead>
                <tbody class="openable-tbody">
                <?php foreach($data as $r){   ?>
                    <tr <?php echo $x%2==0 ? "class=\"odd\"" : "class=\"even\""?>>
                        <td width="20%"><img src="<?php echo base_url('public/upload/tmp/').'/'.$r['Hpic'];?>" class="borimg" width="95%"></td>
                        <td width="20%">
                            <?php echo date("Y-m-d",$r['Time_from'])?>
                        </td>
                        <!--td width="15%">
                            <?php echo date("Y-m-d",$r['Time_to'])?>
                        </td-->
                        <td width="20%">
                            <?php echo $r['Name']?>
                        </td>
                        <td width="20%">
                            <?php echo $r['Desc']?>
                        </td>
                        <td>
                            <a class="button white" href="album_list/del/<?php echo $r['Id']?>" onclick="return confirm('確定要刪除此筆資料?')"><span class="icon_single cancel"></span></a>
                            <a class="button white" href="album_list/edit/<?php echo $r['Id']?>"><span class="icon_single edit"></span></a>
                            <a href="album_list/item/<?php echo $r['Id']?>" target="_blank" class="button white"><span class="pack _354"></span></a>
                        </td>
                    </tr>
                <?php $x++;}?>
                </tbody>
            </table>
        </div>
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