<?php
//print_r($data);
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
        </ul>
        <h2 class="box-header">首頁編輯 - 聯絡我們</h2>
        <form name="webform" action="<?=site_url("/sitecontent_video/update")?>" method="post">
        <div class="box-content box-table editmod">
            <table class="tablebox">
                <thead class="table-header">
                    <tr>
                        <th>訊息內容</th>
                        <th>姓名</th>
                        <th>E-mail</th>
                        <th>聯絡電話</th>
                        <th>時間</th>
                    </tr>
                </thead>
                <tbody class="openable-tbody">
                <?php foreach($data as $r){   ?>
                    <tr <?php echo $x%2==0 ? "class=\"odd\"" : "class=\"even\""?>>
                        <td width="20%"><?php echo $r['Main']?></td>
                        <td width="20%"><?php echo $r['Name']?></td>
                        <td width="20%"><?php echo $r['Email']?></td>
                        <td width="20%"><?php echo $r['Phone']?></td>
                        <td width="20%">
                            <?php echo date("Y-m-d h:i:s",$r['Time'])?>
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
        var display = $('#display_'+$id).val();
        jQuery.ajax({
        url: 'comments_list/modify/'+$id+'/'+status+'/'+display,
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
