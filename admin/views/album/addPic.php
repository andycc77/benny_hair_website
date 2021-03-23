  <link href="<?php echo base_url('public/dropzone/'); ?>/css/dropzone.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url('public/dropzone'); ?>/dropzone.js"></script>
<div id="content">
        <div class="box themed_box fl width90">
            <ul class="box-header-btn"></ul>
            <h2 class="box-header">
                <p class="icons_pack"><span class="pack _111"></span></p>
                新增圖片            </h2>
            <div class="box-content box-table editmod">
                <table class="tablebox">
                    <thead class="table-header"><tr><th>欄位</th><th>內容</th></tr></thead>
                    <tbody class="table-data">
                        <tr>
                            <td width="10%" class="even">選擇相簿</td>
                            <td width="40%" class="odd">
                                <select name="aid" id="aid">
                                <?php echo $data['albumitem']?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" class="even">上傳圖片</td>
                            <td width="40%" class="odd">
                                <form action="<?php echo site_url('/album_list/upload'); ?>" class="dropzone" method="POST">
                                    <input type="hidden" name="albumid" id="albumid" value="">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clear">
    </div>
</div>
<script type="text/javascript">
$('#albumid').val($('#aid').val());
$("#aid").change(function(){
    $('#albumid').val($('#aid').val());
});
</script>