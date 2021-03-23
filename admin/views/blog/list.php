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
            <li class="button white"><a href="blog_add"><span class="icon_text addnew"></span>新增文章</a></li>
        </ul>
        <h2 class="box-header">部落格 - 文章管理</h2>
        <form name="webform" action="<?=site_url("/sitecontent_video/update")?>" method="post">
        <div class="box-content box-table editmod">
            <table class="tablebox">
                <thead class="table-header">
                    <tr>
                        <th>標題</th>
                        <th>作者</th>
                        <th>日期</th>
                        <th>執行</th>
                    </tr>
                </thead>
                <tbody class="openable-tbody">
                <?php foreach($data as $r){   ?>
                    <tr <?php echo $x%2==0 ? "class=\"odd\"" : "class=\"even\""?>>
                        <td width="20%"><?php echo $r['Title']?></td>
                        <td width="20%"><?php if($r['Author']==1) echo 'admin'?></td>
                        <td width="20%"><?php echo date("Y-m-d",$r['Time'])?></td>
                        <td width="20%">
                            <a class="button white" href="blog_list/del/<?php echo $r['ArticleID']?>" onclick="return confirm('確定要刪除此筆資料?')"><span class="icon_single cancel"></span></a>
                            <a class="button white" href="blog_list/edit/<?php echo $r['ArticleID']?>"><span class="icon_single edit"></span></a>
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
