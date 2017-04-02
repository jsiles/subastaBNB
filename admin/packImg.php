<?php include_once ("core/admin.php"); ?>
<?php  admin::initialize('news','packImg'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">    
<html>
<head>
<title>Sistema de Subastas > <?=admin::labels('htmltitlepage')?></title>
<link rel="shortcut icon" href="lib/favicon.ico" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/dhtml_horiz.css" type="text/css" />
<!--[if gte IE 5.5]>
<script language="JavaScript" src="css/dhtml.js" type="text/JavaScript"></script>
<![endif]-->
<META NAME="author" CONTENT="DEVZONE">
<META NAME="reply-to" CONTENT="info@devzone.xyz">
<META NAME="copyright" CONTENT="Software propietario de DEVZONE">
<META NAME="rating" CONTENT="General">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; ISO-8859-1">
<script language="javascript" type="text/javascript" src="uploader/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/ajaxlib.js?version=<?=VERSION?>"></script>
<script type="text/javascript" src="js/interface.js"></script>
<script language="javascript" type="text/javascript" src="js/package.js"></script>
<!-- TOOLTIPS DE ACRONYM -->
<script language="javascript" type="text/javascript" src="js/addEvent.js"></script>
<script language="javascript" type="text/javascript" src="js/sweetTitles.js"></script>
<link rel="stylesheet" href="css/sweetTitles.css" type="text/css" />
<!-- FIN -->
<!-- GROW de los Text areas -->
<script type="text/javascript">
function grow() {
	// Opera isn't just broken. It's really twisted.
	if (this.scrollHeight > this.clientHeight && !window.opera)
		{		
		while(this.scrollHeight > this.clientHeight)
			{
			this.rows += 1;
			}
		}
	}
function init() {
	if (!document.getElementById)
		return;
	/*
	document.getElementById("pac_description").rows=4;
	document.getElementById("pac_description").onkeypress = grow;		
	*/
	}
window.onload = init;
</script>
<!-- FIN -->
<!--BEGINIMPROMTU-->
<link rel="stylesheet" type="text/css" href="css/impromptu.css">
<script type="text/javascript" src="js/jquery.Impromptu.js"></script>
<!--ENDIMPROMTU--> 
<script language="javascript" type="text/javascript" src="js/ui/ui.core.js"></script>
<script language="javascript" type="text/javascript" src="js/ui/ui.menu.contex.js"></script>
<script language="javascript" type="text/javascript" src="js/ui/ui.ide.js"></script>
<script language="javascript" type="text/javascript" src="js/ui/ui.sortable.js"></script>
<script language="javascript" type="text/javascript" src="uploader/jquery.MultiFile.js"></script>

<script>
token = $.getUrlVar('token');

$(function(){

	
 $('#GALLERY_IMG').MultiFile({
  accept:'gif|jpg|bmp',  STRING: {
   remove:'Remover',
   selected:'Selecionado: $file',
   denied: 'Invalido arquivo de tipo $ext!'
  }
 });
$("textarea.textarea","#listImg").keyup(function(){
	var x = $(this).val();
	$(this).val(x.substring(0,130));
	//alert("aqui2");
});
 $(".editImg").click(function(){
 	var $obj = $(this).attr('id');
	$("textarea","."+$obj+"Img").show();
	$(".boxTxt","."+$obj+"Img").hide();
	$(".deleteImg","."+$obj+"Img").hide();
	$(".editImg","."+$obj+"Img").hide();
	$(".saveImg","."+$obj+"Img").show();
 });
 $(".saveImg").click(function(){
 	var $obj = $(this).attr('id');
	$("textarea","."+$obj+"Img").hide();
	$(".boxTxt","."+$obj+"Img").show();
	$(".deleteImg","."+$obj+"Img").show();
	$(".editImg","."+$obj+"Img").show();
	$(".saveImg","."+$obj+"Img").hide();
	title = $("textarea","."+$obj+"Img").val();
	$(".boxTxt","."+$obj+"Img").html(title)
		$.ajax(
		{
			type: "POST",
			url: "code/execute/packImgUpd.php",
			data: "uid="+$obj +"&title="+title+"&token="+token,
			success: function(datos)
			{
			  //alert( "La hora actual es:" + datos);
			},
			error: function(){
				alert("error"+datos);
			}
		});	
 }); 
 
 	$(".deleteImg").click(function(){
		var uid = $(this).attr('id');
		var $obj = this;
		var sw;
			$("#listImg :li [class='deleteImg']").each(function(index) {
				sw = uid == $(this).attr('id');
				//var $obj = this;
				if(sw)
				{
					var txt = '¿<?=admin::labels('delete','sure')?>?<br><input type="hidden" id="list" name="list" value="'+ uid +'" />';
					$.prompt(txt,{
						show:'fadeIn' ,
						opacity:0,
						buttons:{Eliminar:true, Cancelar:false},
						callback: function(v,m){
														   
							if(v){
									uid == $(this).attr('id');		
									$("#"+uid).remove();
									$(this).remove();
									$.ajax(
									{
											type: "POST",
											url: "code/execute/packImgDel.php",
											data: "uid="+uid+"&token="+token,
											success: function(datos)
											{
											  //alert( "La hora actual es:" + datos);
											  //alert($("#listImg li").length);
											  if($("#listImg li").length < 8){
											  	$("#uploaImg").show();
												var x = 8 - $("#listImg li").length ;
												$("#GALLERY_IMG").attr('maxlength',x);
											  }	
											  
											},
											error: function(){
												alert("error");
											}
									});	
							}
							else{}
							
						}
					});				
				}
			});
			$("#listImg li").each(function(index) {
				var $obj = this;
				var x = $(this).html();
				if($(x+" a").length == 3)
				{
					$($obj).remove();
				}
				
			});			
	
	});
	$("#listImg").sortable(
		{update : function(event,ui){
			var $obj = $("#objlis ul li img");
			var iuds="";
			jQuery.each($obj, function(i) {
	    		iuds = iuds + this.id + ",";
			});
			//alert(iuds);
			var uid = $("#pac_uid").val();
				$.ajax(
				{
				        type: "POST",
				        url: "code/execute/packImgPosition.php",
				        data: "uid="+uid+"&list="+iuds+"&token="+token,
				        success: function(datos)
						{
				          //alert( "La hora actual es:" + datos);
				        }
				});			
		}}
	);
});
 
function updateGallery(elem,new_uid){
	 if(elem.checked)
	 	value= 1;
	 else 
	 	value =0;
		  $.ajax({
				url: 'code/execute/updateGallery.php',
				data: 'value='+value+'&new_uid='+new_uid+'&token='+token,
				complete : function(ob){
								//$("#check_gallery").html(ob.responseText);
							}/*,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
            						alert('resultado='+datos);
        						 }*/	
	 });
}
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top"><? include_once("skin/header.php");?>
</td></tr>
  <tr>
    <td valign="top" id="content"><? include_once("code/template/packImgTpl.php"); ?></td>
  </tr>
<tr><td>
  <? include("skin/footer.php"); ?>
  </td></tr>
</table>
</body>
</html>