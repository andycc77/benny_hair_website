<div id="content">
        <div class="box themed_box fl width90">
            <ul class="box-header-btn"></ul>
            <h2 class="box-header">
                <p class="icons_pack"><span class="pack _111"></span></p>
                回覆留言            </h2>
            <div class="box-content box-table editmod">
            <form name="webform" action="<?=site_url("/comments_list/update/{$data['Id']}")?>" method="post">
                <table class="tablebox">
                    <thead class="table-header"><tr><th>欄位</th><th>內容</th><th>欄位</th><th>內容</th></tr></thead>
                    <tbody class="table-data">
                        <tr>
                            <td width="10%" class="even">姓名</td>
                            <td width="40%" class="odd"><?php echo $data['Name']?></td>
                            <td class="tt even" width="10%">E-mail</td>
                            <td class="tt odd"  width="40%"><?php echo $data['Email']?></td>
                        </tr>
                        <tr>
                            <td width="10%" class="even">聯絡電話</td>
                            <td width="40%" class="odd"><?php echo $data['Phone']?></td>
                            <td class="tt even" width="10%">時間</td>
                            <td class="tt odd"  width="40%"><?php echo date("Y-m-d H:s:i",$data['Time'])?></td>
                        </tr>
                        <tr>
                            <td width="10%" class="even">諮詢內容</td>
                            <td width="40%" class="odd"><?php echo $data['Main']?></td>
                            <td class="tt even" width="10%">顯示</td>
                            <td class="tt odd"  width="40%">
                                <select id="display" name="display">
                                    <option value="1" <?php echo $data['Display'] ==1 ? "selected=\"selected\"" : ""?>>公開</option>
                                    <option value="0" <?php echo $data['Display'] ==0 ? "selected=\"selected\"" : ""?>>隱藏</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" class="even">狀態</td>
                            <td width="40%" class="odd">
                                <select id="status" name="status">
                                    <option value="1" <?php echo $data['Status'] ==1 ? "selected=\"selected\"" : ""?>>已讀</option>
                                    <option value="0" <?php echo $data['Status'] ==0 ? "selected=\"selected\"" : ""?>>未讀</option>
                                </select>
                            </td>
                            <td class="tt even" width="10%"></td>
                            <td class="tt odd"  width="40%"></td>
                        </tr>
                        <tr>
                            <td width="10%" class="even">回覆</td>
                            <td  width="40%" class="odd"><textarea class="form-field small ui-resizable" name="reply" cols="" rows="" ><?php echo $data['Reply']?></textarea></td>
                            <td class="tt even" width="10%"></td>
                            <td class="tt odd"  width="40%"></td>
                        </tr>
                    </tbody>
                </table>
                <ul class="tablefooter">
                    <input type="submit" value="儲存資料" class="button themed" />
                    <input type="button" onclick="del('<?php echo $data['Id']?>');" value="刪除資料" class="button red" />
                </ul>
                </form>
            </div>
        </div>
        <div class="clear">
    </div>
</div>
<script>
    function del($id){
        var r = confirm("確定要刪除此筆資料?");
        if (r == true) {
            window.location = "<?php echo site_url('comments_list/del/').'/'.$data['Id']?>";
        }
    }
</script>