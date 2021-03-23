var menu_autotimer = false;
var menu_autotimer_time = 5000;
var menu_autotimer_id;

$(function() {
	//msg handel
	$(".message").click(function() { closemsg($(this)); });
	//menu handel
	$("#subnavbar>ul.active").show();
	$("#navbar>li").each(function(i) { 
		$(this).click(function(){
			$("#subnavbar>ul").hide();
			$("#subnavbar>ul").eq(i).show();
			clearTimeout(menu_autotimer_id);
			menu_autotimer_id = setTimeout("menu_auto_active()" , menu_autotimer_time);
		});/*.mouseover(function(){
			$("#subnavbar>ul").hide();
			$("#subnavbar>ul").eq(i).show();
			clearTimeout(menu_autotimer_id);
			menu_autotimer_id = setTimeout("menu_auto_active()" , menu_autotimer_time);
		});*/
	});
	//box hide handel
	$(".searchbox .box-header").click(function() {
		$(this).toggleClass("box-header closed").toggleClass("box-header");
		$(this).find(".hideandshow").toggleClass("hideandshow closenow").toggleClass("hideandshow opennow");
		$(this).parents(".box:first").find(".box-content").toggle();
	});
	//only number
	$("input[name*='Order']").attr('maxlength' , '4');
	$("input[name*='Order'],.onlynum").keyup(function() {
		var val = $(this).val();
		var newval = val.replace(/[^\d]/g,'');
		$(this).val(newval);
	});
	$("input[name*='rice'],.onlynumcom").keyup(function() {
		var val = $(this).val();
		var newval = val.replace(/[^\d.]/g,'');
		$(this).val(newval);
	});
	$("input[name='createmore']").attr('maxlength' , '2');
	$("input[name='createmore']").keyup(function() {
		var val = $(this).val();
		var newval = val.replace(/[^\d.]/g,'');
		$(this).val(newval);
	});
	$(".timepicker").keyup(function() {
		var val = $(this).val();
		var newval = val.replace(/[^\d:]/g,'');
		$(this).val(newval);
	});
	//easycheckbox
	$(".easycheck").click(function() {
		var tar = $(this).parent().find("input[name='selecter[]']");
		if($(tar).attr("checked") == true){
			$(tar).attr("checked" , "");
		}else{
			$(tar).attr("checked" , "checked");
		}
	});
	$(".listmod tbody select").change(function() {
		var tar = $(this).parent().parent().find("input[name='selecter[]']");
		$(tar).attr("checked" , "checked");
	});
	$(".listmod tbody input[type='text']").keyup(function() {
		var tar = $(this).parent().parent().find("input[name='selecter[]']");
		$(tar).attr("checked" , "checked");
	});
	//TEXTAREA INPUT//
	textarearesizable();
	//searchmod table td width
	$(".searchmod .tablebox").each(function(){
		$(this).find("tbody td:odd").attr("width","40%").addClass("odd");
		$(this).find("tbody td:even").attr("width","10%").addClass("even");
	});
	$(".viewmod .tablebox").each(function(){
		$(this).find("tbody td:odd").attr("width","40%").addClass("odd");
		$(this).find("tbody td:even").attr("width","10%").addClass("even");
	});
	$(".addmod .tablebox").each(function(){
		$(this).find("tbody td:odd").attr("width","40%").addClass("odd");
		$(this).find("tbody td:even").attr("width","10%").addClass("even");
	});
	$(".editmod .tablebox").each(function(){
		$(this).find("tbody td:odd").attr("width","40%").addClass("odd");
		$(this).find("tbody td:even").attr("width","10%").addClass("even");
	});
	//DATAPICKER//
	var datepickertimerange = $("#timefrom , #timeto ").datepicker({
		dateFormat:'yy-mm-dd',
		dayNamesMin:['日','一','二','三','四','五','六'],
		monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
		monthNamesShort: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
		showOtherMonths: true, selectOtherMonths: true, changeMonth: true, changeYear: true,
		onSelect: function( selectedDate ) {
			var option = this.id == "timefrom" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			datepickertimerange.not( this ).datepicker( "option", option, date );
		}
	});
	$(".datepicker").datepicker({
		dateFormat:'yy-mm-dd',
		dayNamesMin:['日','一','二','三','四','五','六'],
		monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
		monthNamesShort: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']
	});
	$("input[class*='irthday']").datepicker({
		dateFormat:'yy-mm-dd',
		dayNamesMin:['日','一','二','三','四','五','六'],
		monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
		monthNamesShort: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
		showOtherMonths: true, selectOtherMonths: true, changeMonth: true, changeYear: true,
		yearRange:'1911:'+new Date().getFullYear()
	});
	$.datepicker.setDefaults($.datepicker.regional["zh-TW"]);
	//table color class
	$(".listmod .tablebox").each(function(){
		$(this).find("tbody tr:odd").addClass("even");
		$(this).find("tbody tr:even").addClass("odd");
	});
	$(".viewmodlist .tablebox").each(function(){
		$(this).find("tbody tr:odd").addClass("even");
		$(this).find("tbody tr:even").addClass("odd");
	});
	//editor
	var alleditor = new Object();
	$(".myckeditor").each(function(i){
		alleditor["ediotr"+i] = CKEDITOR.replace($(this).attr("name"));
		CKFinder.setupCKEditor(alleditor["ediotr"+i] , '../../ckfinder/');
	});
});
function textarearesizable(){
	$("textarea.resizable").resizable({
		helper: "ui-resizable-helper",
		animate: true,
		containment: '.box-content'
	});
}
function dellistone(i , myl_page_list_qdel){
	$(".listmod tbody tr td input[name='selecter[]']").removeAttr("checked");
	$(".listmod tbody tr td input[name='selecter[]']").eq(i).attr("checked" , "checked");
	dellistselect(myl_page_list_qdel);
}
function dellistselect(myl_page_list_qdel){
	var msg = new Array();
	$(".listmod tbody input[name='selecter[]']:checked").each(function(){ msg.push($(this).attr("selecttitle")); });
	var sure = window.confirm(myl_page_list_qdel+msg.toString());
	if (sure){ document.listform.act.value = "delselect"; document.listform.submit(); }
}
function delme(sno , page , myl_page_btn_qdel){
	var sure = window.confirm(myl_page_btn_qdel);
	if (sure){ document.webform.act.value = "delme"; document.webform.submit(); }
}

function updatelistselect(myl_page_list_qupdate){
	var msg = new Array();
	$(".listmod tbody input[name='selecter[]']:checked").each(function(){ msg.push($(this).attr("selecttitle")); });
	var sure = window.confirm(myl_page_list_qupdate+msg.toString());
	if (sure){ document.listform.act.value = "updateselect"; document.listform.submit(); }
}
function cms_list_selectall(tar){
	var sta = tar.checked;
	if(sta){ $('input[name="selecter[]"]').attr('checked','checked'); }else{ $('input[name="selecter[]"]').attr('checked',''); }
}
function actsearch(val){ var tar = document.datesearch; if(val == 1){ tar.act.value = "sSearch"; }else if(val == 2){ tar.act.value = "cSearch"; } tar.submit(); }
function changeshowlist(how){ var tar = document.datesearch; tar.act.value = "sSearch"; tar.Slimit.value = how; tar.submit(); }
function changeorder(who){ 
	var tar = document.datesearch;
	tar.act.value = "sSearch";
	var oldSorder = tar.Sorder.value;
	var oldSascdesc = tar.Sascdesc.value;
	if(oldSorder != who){
		tar.Sorder.value = who;
		tar.Sascdesc.value = "asc";
	}else{ 
		if(oldSascdesc == "asc"){ 
			tar.Sascdesc.value = "desc"; 
		}else{ 
			tar.Sascdesc.value = "asc"; 
		} 
	}
	tar.submit(); 
}
function menu_auto_active(){ $("#subnavbar>ul").hide(); $("#subnavbar>ul.active").show(); $("#navbar>li:not(.active)").blur(); }
function showmsg( kind , msg , autohide){
	$("#showmsg").append("<span class='message "+kind+"'>"+msg+"</span>");
	var tarmsg = $("#showmsg span:last");
	if(autohide > 0){
		$(tarmsg).delay(autohide).hide('blind', 300 );
	}else{
		$(tarmsg).click(function() { closemsg($(this)); });
	}
}
function closemsg(who){ $(who).hide('blind', 300 ); }

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










