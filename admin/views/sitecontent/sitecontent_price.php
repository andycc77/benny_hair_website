<?php
if(isset($data['0']['name'])){
  $url1 = base_url('public/upload_file/img/').'/'.$data['0']['name'];
  $name1 = $data['0']['name'];
}else{
  $url1 = '';
  $name1 = '';
}

if(isset($data['1']['name'])){
  $url2 = base_url('public/upload_file/img/').'/'.$data['1']['name'];
  $name2 = $data['1']['name'];
}else{
  $url2 = '';
  $name2 = '';
}

if(isset($data['2']['name'])){
  $url3 = base_url('public/upload_file/img/').'/'.$data['2']['name'];
  $name3 = $data['2']['name'];
}else{
  $url3 = '';
  $name3 = '';
}
?>
<script type="text/javascript">
function uploadFile(sno){
  var formName = "form1"; //表單名稱
  var prevImg = "preUpLoadImg_"+sno; //顯示圖片ID
  var upFloder = "img"; //上傳目錄名稱
  var rePicName = "rePicFileName_"+sno; //回傳圖片上傳名稱
  var subName ="jpg,png,gif"; //可上傳副檔名
  var maxSize = 1024;

  var winTitle = "fileUpload"; //視窗名稱
  var winWidth = 400; //視窗寬
  var winHeight = 180;　//視窗高
  var sno = sno;
  window.open('<?php echo base_url('public')?>/upload_file/mwt_upload_control.php?formName='+formName+'&prevImg='+prevImg+'&upFloder='+upFloder+'&rePicIpt='+rePicName+'&subName='+subName+"&maxSize="+maxSize+'&sno='+sno,winTitle,'width='+winWidth+',height='+winHeight);
}
jQuery(window).load(function() {
  jQuery('.contact-save-btn').click(function(e){
    var contact =  jQuery('#contact-area').val();
    var sendval = "contact="+contact;
    //alert(contact);
    if(contact !=''){
      jQuery.ajax({
        url: './ajax/contact.php',
        type: "POST",
        data: sendval,
        beforeSend: function() {
        },
        complete: function() {},
        success: function(json){
          //console.log(json);
          jQuery('#contact-area').val(json);
          alert('修改成功');
        }
      });
    }else{
      alert('請輸入聯絡方式');
    }
  })
})

</script>
<div id="content">
    <div class="box themed_box">
        <h2 class="box-header">首頁編輯 - 價目表</h2>
        <div class="box-content box-table editmod">
        <form name="form1" id="form1">
            <table class="tablebox">
                <thead class="table-header"><tr><th>欄位</th><th>內容</th></tr></thead>
                <tbody class="table-data">
                    <tr class="odd">
                        <td width="10%">第一張</td>
                        <td width="40%">
                        <span>第1張:</span>&nbsp;<img src="<?php echo  $url1?>" alt="顯示上傳預覽圖片" name="preUpLoadImg_1" border="0" id="preUpLoadImg_1" width="100"/>&nbsp;<input name="rePicFileName_1" type="text" id="rePicFileName_1" value="<?php echo  $name1?>" readonly /><span class="button-wrap"><button id="bt1" onclick="uploadFile(1)">變更圖片</button></span>
                        </td>
                    </tr>
                    <tr class="even">
                        <td width="10%">第二張</td>
                        <td>
                            <span>第2張:</span>&nbsp;<img src="<?php echo  $url2?>" alt="顯示上傳預覽圖片" name="preUpLoadImg_2" border="0" id="preUpLoadImg_2" width="100"/>&nbsp;<input name="rePicFileName_2" type="text" id="rePicFileName_2" value="<?php echo  $name2?>" readonly /><span class="button-wrap"><button id="bt2" onclick="uploadFile(2)">變更圖片</button></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="10%">第三張</td>
                        <td>
                            <span>第3張:</span>&nbsp;<img src="<?php echo  $url3?>" alt="顯示上傳預覽圖片" name="preUpLoadImg_3" border="0" id="preUpLoadImg_3" width="100"/>&nbsp;<input name="rePicFileName_3" type="text" id="rePicFileName_3" value="<?php echo  $name3?>" readonly /><span class="button-wrap"><button id="bt3" onclick="uploadFile(3)">變更圖片</button></span>
                        </td>
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
    </div>
</div>