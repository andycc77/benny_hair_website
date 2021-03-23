<?php
if(isset($_GET["result"])){
?>
    <span class="message success"><strong>變更成功 </strong></span>
<?php
}
?>
<div id="content">
    <div class="box themed_box">
        <h2 class="box-header">首頁編輯 - 首頁影片</h2>
        <form name="webform" action="<?=site_url("/sitecontent_video/update")?>" method="post">
        <div class="box-content box-table editmod">
            <table class="tablebox">
                <thead class="table-header"><tr><th>欄位</th><th>內容</th></tr></thead>
                <tbody class="table-data">
                    <tr>
                        <td width="10%" class="even">URL&ensp;(請輸入完整&quot;Youtube&quot;網址)</td>
                        <td width="40%" class="odd">
                            <input type="text" name="url1" class="form-field half" value="<?= (isset($data['url'][0]))? $data['url'][0]:"";?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="10%" class="even">URL&ensp;(請輸入完整&quot;Youtube&quot;網址)</td>
                        <td width="40%" class="odd">
                            <input type="text" name="url2" class="form-field half" value="<?= (isset($data['url'][1]))? $data['url'][1]:"";?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <ul class="tablefooter">
                <input type="submit" value="儲存變更" class="button themed" />
            </ul>
        </div>
        </form>
    </div>
</div>