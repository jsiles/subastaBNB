<?php
include ("core/admin.php");
admin::initialize('client','permitList'); 
?>
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
<script type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/ajaxlib.js?version=<?=VERSION?>"></script>
<!--BEGINIMPROMTU-->
<link rel="stylesheet" type="text/css" href="css/impromptu.css">
<script type="text/javascript" src="js/jquery.Impromptu.js"></script>
<!--ENDIMPROMTU--> 
<script type="text/javascript">      
// ELIMINA LOS REGISTROS DE LA CATEGORIA PRINCIPAL
function removeList(id){
	var txt = '¿<?=admin::labels('delete','sure')?>?<br><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();
				  $('#'+id).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/permitDel.php',
						type: 'POST',
						data: 'uid='+id
					});
				 }
			else {}
			
		}
	});
}
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top"><? include_once("skin/header.php");?>
</td></tr>
  <tr>
    <td valign="top" id="content"><? include_once("code/template/permitListTpl.php"); ?></td>
  </tr>
<tr><td>
  <? include("skin/footer.php"); ?>
  </td></tr>
</table>
</body>
</html>