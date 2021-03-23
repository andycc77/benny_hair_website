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
/*
    $a=0;
    $b=0;
    foreach($data as $r){
        if($r['Status']==1){
            $a++;
        }else if($r['Status']==0){
            $b++;
        }
    }
*/
?>
<span class="message success" style="display: none"><strong>修改成功 </strong></span>
<div id="content">
    <div class="box themed_box">
        <ul class="box-header-btn">
        </ul>
        <h2 class="box-header">留言管理 - 留言列表 &nbsp&nbsp已讀:<span id="readcount"></span> &nbsp&nbsp未讀:<span id="notreadcount"></span></h2>
        <form name="webform" action="<?=site_url("/sitecontent_video/update")?>" method="post">
        <div class="box-content box-table editmod">
            <table class="tablebox">
                <thead class="table-header">
                    <tr>
                        <th>諮詢內容</th>
                        <th>姓名</th>
                        <th>E-mail</th>
                        <th>聯絡電話</th>
                        <th>狀態</th>
                        <th>顯示</th>
                        <th>時間</th>
                        <th>執行</th>
                    </tr>
                </thead>
                <tbody class="openable-tbody">
                <?php foreach($data as $r){   ?>
                    <tr <?php echo $x%2==0 ? "class=\"odd\"" : "class=\"even\""?>>
                        <td width="20%"><?php echo $r['Main']?></td>
                        <td width="20%"><?php echo $r['Name']?></td>
                        <td width="20%"><?php echo $r['Email']?></td>
                        <td width="20%"><?php echo $r['Phone']?></td>
                        <td width="10%">
                            <select id="status_<?php echo  $r['Id']?>" name="status_<?php echo  $r['Id']?>">
                                <option value="1" <?php echo $r['Status'] ==1 ? "selected=\"selected\"" : ""?>>已讀</option>
                                <option value="0" <?php echo $r['Status'] ==0 ? "selected=\"selected\"" : ""?>>未讀</option>
                            </select>
                        </td>
                        <td width="10%">
                            <select id="display_<?php echo  $r['Id']?>" name="display__<?php echo  $r['Id']?>">
                                <option value="1" <?php echo $r['Display'] ==1 ? "selected=\"selected\"" : ""?>>公開</option>
                                <option value="0" <?php echo $r['Display'] ==0 ? "selected=\"selected\"" : ""?>>隱藏</option>
                            </select>
                        </td>
                        <td width="20%">
                            <?php echo date("Y-m-d h:i:s",$r['Time'])?>
                        </td>
                        <td width="20%">
                            <a class="button white" href="comments_list/del/<?php echo $r['Id']?>" onclick="return confirm('確定要刪除此筆資料?')"><span class="icon_single cancel"></span></a>
                            <a class="button white" href="comments_list/edit/<?php echo $r['Id']?>"><span class="icon_single edit"></span></a>
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
$(function () {
    readcount()
})
function readcount(){
       jQuery.ajax({
    url: 'comments_list/readcount/',
    type: "GET",
    dataType: "json",
    beforeSend: function() {
    },
    complete: function() {},
    success: function(json){
        //alert(json['result']);
        $('#readcount').html(json['result']);
      //console.log(json);
    }
    });

    jQuery.ajax({
    url: 'comments_list/notreadcount/',
    type: "GET",
    dataType: "json",
    beforeSend: function() {
    },
    complete: function() {},
    success: function(json){
        //alert(json['result']);
        $('#notreadcount').html(json['result']);
      //console.log(json);
    }
    });
}
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
            readcount();
          if(json['result']=='updated'){
            $('.success').css("display","block");
          }
        }
        });
    }
</script>
