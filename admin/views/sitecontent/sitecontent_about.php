<?php
if(isset($_GET["result"])){
?>
    <span class="message success"><strong>變更成功 </strong></span>
<?php
}

    $Rules= explode(";;;", $data['rule']);
    $RuleList='';
    $RuleNum = 0;
    $terms = count($Rules);
    # 活動規則條例
    if(!is_null($Rules)){
        foreach($Rules as $key=>$value){
            if($key == 0){
                $RuleList .="<input type=\"text\" name=\"rule[]\" class=\"form-field half\" value=\"{$value}\" style='margin-top:5px;width:400px;' maxlength='255'>
                            <a class=\"button white\" onclick=\"add_term()\"><span class=\"icon_single addnew\"></span></a>
                            <a class=\"button white\" onclick=\"del_term()\"><span class=\"icon_single cancel\"></span></a>";
            }else{
                $RuleList .="<br><input type=\"text\" id=\"rule{$key}\" name=\"rule[]\" class=\"form-field half\" value=\"{$value}\" style='margin-top:5px;width:400px;' maxlength='255'>";
            }
        }
        $RuleNum = count($Rules);
    }else{
        $RuleList .="<input type=\"text\" name=\"rule[]\" class=\"form-field half\" value=\"{$value}\" style='margin-top:5px;width:400px;' maxlength='255'>
                            <a class=\"button white\" onclick=\"add_term()\"><span class=\"icon_single addnew\"></span></a>
                            <a class=\"button white\" onclick=\"del_term()\"><span class=\"icon_single cancel\"></span></a>";
    }
?>
<div id="content">
    <div class="box themed_box">
        <h2 class="box-header">首頁編輯 - 關於我</h2>
        <form name="webform" action="<?=site_url("/sitecontent_about/update")?>" method="post">
        <div class="box-content box-table editmod">
            <table class="tablebox">
                <thead class="table-header"><tr><th>欄位</th><th>內容</th></tr></thead>
                <tbody class="table-data">
                    <tr class="odd">
                        <td width="10%" >主要內容 <br> (利用&ensp;&lt;br&gt;&ensp;換行)</td>
                        <td width="40%" >
                            <textarea class="form-field small ui-resizable" name="content" cols="" rows="" ><?php echo $data['content']?></textarea>
                        </td>
                    </tr>
                    <tr class="even">
                        <td width="10%" >項目 <br> (最多十行)</td>
                        <td width="40%" id="d1">
                            <?php echo $RuleList;?>
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
<script type="text/javascript">
var terms = <?php echo $terms?>;

function add_term(){
    if(terms<10){
        terms++;
        $("#d1").append("<br/><input type='text' id='rule"+terms+ "' name='rule[]'  value='' class='form-field half' style='margin-top:5px;width:400px;' maxlength='255'/>");
    }else{

    }
}

function del_term(){
    $("#rule"+terms).remove();
    terms--;
}
</script>