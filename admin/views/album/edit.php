<?
$folder = base_url('public/upload/tmp/');
$cms_ones = "Hpic";
${$cms_ones} = array();
if(!isset($r['Hpic'])){$r['Hpic'] ='';}
$cms_ones = "Lpic";
${$cms_ones} = array();
if(!isset($r['Lpic'])){$r['Lpic'] ='';}
?>
<script type="text/javascript">
    function addones(tar , inputname , info){
    if(inputname == 'Hpic'){
        var url = 'inputname='+inputname
        +'&allow=jpg_gif_png'
        +'&usecut=1'
        +'&cutw=900'
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
                新增相簿            </h2>
            <div class="box-content box-table editmod">
            <form name="webform" action="<?=site_url("/album_list/modify/{$data['Id']}")?>" method="post">
                <input type="hidden" name="act" value="upload">
                <table class="tablebox">
                    <thead class="table-header"><tr><th>欄位</th><th>內容</th><th>欄位</th><th>內容</th></tr></thead>
                    <tbody class="table-data">
                        <tr>
                            <td width="10%" class="even">相簿名稱</td>
                            <td width="40%" class="odd"><input type="text" name="name" id="name" value="<?php echo $data['Name']?>" class="form-field half"></td>
                            <td class="tt even" width="10%">敘述</td>
                            <td class="tt odd"  width="40%"><input type="text" name="desc" id="desc" value="<?php echo $data['Desc']?>" class="form-field half"></td>
                        </tr>
                        <tr>
                            <td width="10%" class="even">上架時間</td>
                            <td width="40%" class="odd"><input class="form-field datepicker" name="time_from" id="time_from" type="text" value="<?=(empty($data['Time_from']))?date("m/d/Y" , time()):date("m/d/Y" , $data['Time_from']);?>" /></td>
                            <td width="10%" class="even">置頂</td>
                            <td width="40%" class="odd"><input type="checkbox" id="top" name="top" <?=($data['albumOrder'] == "1")?"checked":"";?> value="<?php echo $data['albumOrder']?>" /></td>
                        </tr>
                        <tr>
                            <td width="10%" class="even">精選作品</td>
                            <td width="40%" class="odd"><a href="javascript:;" class="button white addlink <?=($data['Hpic'] != "")?"uclose":"";?>" onclick="addones(this , 'Hpic');" ><span class="icon_text pack _457"></span>上傳圖片 900 * 630</a>
                                <ul id="ul_Hpic" class="clearfix">
                                    <?php if($data['Hpic'] != ""){ ?>
                                    <li class="clearfix">
                                        <img src="<?php echo base_url('public/upload/tmp/').'/'.$data['Hpic']?>" class="borimg" width="50%"/>
                                        <p class="actbtn"><a href="javascript:;" class="button white delone" onclick="delmeandshowaddlink(this);"><span class="packcolor _462"></span></a></p>
                                        <input type="hidden" name="Hpic" value="<?php echo $data['Hpic']?>" />
                                    </li>
                                    <?php } ?>
                                </ul></td>
                            <td class="tt even" width="10%">作品集</td>
                            <td class="tt odd"  width="40%"><a href="javascript:;" class="button white addlink <?=($data['Lpic'] != "")?"uclose":"";?>" onclick="addones(this , 'Lpic');" ><span class="icon_text pack _457"></span>上傳圖片 940 * 630</a>
                                <ul id="ul_Lpic" class="clearfix">
                                    <?php if($data['Lpic'] != ""){ ?>
                                    <li class="clearfix">
                                        <img src="<?php echo base_url('public/upload/tmp/').'/'.$data['Lpic']?>" class="borimg" width="50%"/>
                                        <p class="actbtn"><a href="javascript:;" class="button white delone" onclick="delmeandshowaddlink(this);"><span class="packcolor _462"></span></a></p>
                                        <input type="hidden" name="Lpic" value="<?php echo $data['Lpic']?>" />
                                    </li>
                                    <?php } ?>
                                </ul></td>
                        </tr>
                    </tbody>
                </table>
                <ul class="tablefooter">
                    <input type="submit" value="修改資料" class="button themed" />
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