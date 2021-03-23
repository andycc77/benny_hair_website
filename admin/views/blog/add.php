<?php
$folder = base_url('public/upload/tmp/');
$cms_ones = "Hpic";
${$cms_ones} = array();
if(!isset($r['Hpic'])){$r['Hpic'] ='';}
$cms_ones = "Lpic";
${$cms_ones} = array();
if(!isset($r['Lpic'])){$r['Lpic'] ='';}
?>
<script type="text/javascript" src="<?php echo base_url('asset/ckeditor/');?>/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url('asset/ckfinder/');?>/ckfinder.js"></script>
<script type="text/javascript">
    function addones(tar , inputname , info){
    if(inputname == 'Hpic'){
        var url = 'inputname='+inputname
        +'&allow=jpg_gif_png'
        +'&usecut=1'
        +'&cutw=940'
        +'&cuth=630'
        +'';
        openuploadiframe('<?php echo base_url('public/');?>/uploadfiles.php?'+url);
        $(".picfocus").removeClass('picfocus');
        $(tar).next("ul").addClass('picfocus');
    }else if(inputname == 're_Hpic' && tar == null){
        str = '<li class="clearfix">'
        +'<img src="<?php echo base_url('public/upload/tmp/')?>/'+info+'" class="borimg" width="50%"/>'
        +'<p class="actbtn"><a href="javascript:;" class="button white delone" onclick="delmeandshowaddlink(this);"><span class="packcolor _462"></span></a></p>'
        +'<input type="hidden" name="Hpic" value="'+info+'" />'
        +'</li>';
        $(".picfocus").append(str);
        $(".picfocus").prevAll("a.addlink").addClass("uclose");
        $(".picfocus").removeClass('picfocus');
    }else if(inputname == 'Lpic'){
        var url = 'inputname='+inputname
        +'&allow=jpg_gif_png'
        +'&usecut=1'
        +'&cutw=940'
        +'&cuth=630'
        +'';
        openuploadiframe('<?php echo base_url('public/');?>/uploadfiles.php?'+url);
        $(".picfocus").removeClass('picfocus');
        $(tar).next("ul").addClass('picfocus');
    }else if(inputname == 're_Lpic' && tar == null){
        str = '<li class="clearfix">'
        +'<img src="<?php echo base_url('public/upload/tmp/')?>/'+info+'" class="borimg" width="50%"/>'
        +'<p class="actbtn"><a href="javascript:;" class="button white delone" onclick="delmeandshowaddlink(this);"><span class="packcolor _462"></span></a></p>'
        +'<input type="hidden" name="Lpic" value="'+info+'" />'
        +'</li>';
        $(".picfocus").append(str);
        $(".picfocus").prevAll("a.addlink").addClass("uclose");
        $(".picfocus").removeClass('picfocus');
    }
}

function openuploadiframe( url ){
    if($(".uploadfiles_wrapper").length == 0){
        $("#content").append('<div class="uploadfiles_wrapper"><div class="uploadfiles_iframe"><iframe width="100%" height="100%" frameborder="no" src="'+url+'"></iframe></div><a href="javascript:closeuploadiframe();"><div class="uploadfiles_overlay"></div></a></div>');
    }else{
        $(".uploadfiles_iframe iframe").attr("src" , url);
    }
    $(".uploadfiles_wrapper .uploadfiles_overlay").css("width" , $(document).width()+"px");
    $(".uploadfiles_wrapper .uploadfiles_overlay").css("height" , $(document).height()+"px");
    $(".uploadfiles_wrapper .uploadfiles_overlay").fadeTo(500, 0.8);
    $(".uploadfiles_wrapper .uploadfiles_iframe").css("width" , ($(window).width()-20)+"px");
    $(".uploadfiles_wrapper .uploadfiles_iframe").css("height" , ($(window).height()-20)+"px");
    $(".uploadfiles_wrapper .uploadfiles_iframe").delay(100).fadeIn(500);
}
function closeuploadiframe(){ $(".uploadfiles_wrapper .uploadfiles_iframe").fadeOut(500); $(".uploadfiles_wrapper .uploadfiles_overlay").fadeOut(500); }
function delmeandshowaddlink(me){ $(me).parents("td").find("a.addlink").removeClass("uclose"); $(me).parents("li").remove(); }
</script>
<style type="text/css">
ul#ul_Hpic li{ float:left; margin:10px; position:relative; }
ul#ul_Hpic li p.actbtn{ position:absolute; right:0px; bottom:5px; display:none;}
ul#ul_Hpic li:hover p.actbtn{ display:block; }
ul#ul_Hpic li p.actbtn a.button{ float:right;}
ul#ul_Lpic li{ float:left; margin:10px; position:relative; }
ul#ul_Lpic li p.actbtn{ position:absolute; right:0px; bottom:5px; display:none;}
ul#ul_Lpic li:hover p.actbtn{ display:block; }
ul#ul_Lpic li p.actbtn a.button{ float:right;}
</style>
<div id="content">
        <div class="box themed_box fl width90">
            <ul class="box-header-btn"></ul>
            <h2 class="box-header">
                <p class="icons_pack"><span class="pack _111"></span></p>
                新增文章            </h2>
            <div class="box-content box-table editmod">
            <form name="webform" action="<?=site_url("/blog_add/add")?>" method="post">
                <input type="hidden" name="act" value="upload">
                <table class="tablebox">
                    <thead class="table-header"><tr><th>欄位</th><th>內容</th><th>欄位</th><th>內容</th></tr></thead>
                    <tbody class="table-data">
                        <tr>
                            <td width="10%" class="even">標題</td>
                            <td width="40%" class="odd"><input type="text" name="name" id="name" value="" class="form-field half"></td>
                            <td class="tt even" width="10%">分類</td>
                            <td class="tt odd"  width="40%">
                                <select name="kind" id="kind">
                                <?php echo $data['blogkinditem']?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%" class="even">上架時間</td>
                            <td width="40%" class="odd"><input class="form-field datepicker" name="time_from" id="time_from" type="text" value="<?=date("m/d/Y" , time());?>" /></td>
                            <td class="tt even" width="10%">文章圖片</td>
                            <td class="tt odd"  width="40%"><a href="javascript:;" class="button white addlink" onclick="addones(this , 'Hpic');" ><span class="icon_text pack _457"></span>上傳圖片 940 * 630</a>
                                <ul id="ul_Hpic" class="clearfix">
                                    <?php if($r['Hpic'] != ""){ foreach(${$cms_ones} as $key => $val){ ?>
                                    <li class="clearfix">
                                        <img src="<?=$folder.${$cms_ones}[$key];?>" class="borimg" />
                                        <p class="actbtn"><a href="javascript:;" class="button white delone" onclick="delmeandshowaddlink(this);"><span class="packcolor _462"></span></a></p>
                                        <input type="hidden" name="<?=$bef.$cms_ones;?>[]" value="<?=$val;?>" />
                                    </li>
                                    <?php } } ?>
                                </ul></td>
                        </tr>
                        <tr>
                            <td width="10%" class="even">置頂</td>
                            <td width="40%" class="odd"><input type="checkbox" id="top" name="top" value="0" /></td>
                            <td class="tt even" width="10%"></td>
                            <td class="tt odd"  width="40%"></td>
                        </tr>
                        <tr>
                            <td width="10%" class="even">內容</td>
                            <td width="40%" class="odd" colspan="3"> <textarea name="main" class="ckeditor" id="main" cols="50" rows="20"></textarea>
                             <script type="text/javascript">
                            CKEDITOR.replace( 'main',
                            {
                                filebrowserBrowseUrl : '<?php echo base_url();?>asset/ckfinder/ckfinder.html',
                                filebrowserImageBrowseUrl : '<?php echo base_url();?>asset/ckfinder/ckfinder.html?type=Images',
                                filebrowserFlashBrowseUrl : '<?php echo base_url();?>asset/ckfinder/ckfinder.html?type=Flash',
                                filebrowserUploadUrl :
                                    '<?php echo base_url();?>asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&tFolder=/archive/',
                                filebrowserImageUploadUrl :
                                    '<?php echo base_url();?>asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&tFolder=/cars/',
                                filebrowserFlashUploadUrl : '<?php echo base_url();?>asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                            }
                        );
                        </script>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <ul class="tablefooter">
                    <input type="submit" value="儲存資料" class="button themed" />
                </ul>
                </form>
            </div>
        </div>
        <div class="clear">
    </div>
<div class="uploadfiles_wrapper"><div class="uploadfiles_iframe" style="width: 1329px; height: 346px; display: none;"><iframe width="100%" height="100%" frameborder="no" src="<?php echo base_url('public/');?>/uploadfiles.php"></iframe></div><a href="javascript:closeuploadiframe();"><div class="uploadfiles_overlay" style="width: 1349px; height: 1628px; opacity: 0.8; display: none;"></div></a></div>
</div>
<script type="text/javascript">
$("#top").click(function() {
 if($("#top").attr('checked')==true){
    $("#top").val('1');
 }else{
    $("#top").val('0');
 }
});
</script>
