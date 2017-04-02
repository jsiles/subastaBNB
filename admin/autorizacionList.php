<?php 
include_once ("core/admin.php");
admin::initialize('parametrizaciones','parametrizacionesList'); 
$rol = $_SESSION["usr_rol"];
if(($rol>3)&&($rol<5))
{
	$rolMax = admin::getDbValue("SELECT adj_monto FROM mdl_adjudicar WHERE adj_rol_uid=".$rol);
	$valAdj = admin::getDbValue("SELECT adj_validacion FROM mdl_adjudicar WHERE adj_rol_uid=".$rol);
}
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
<meta name="author" content="DEVZONE">
<meta name="reply-to" content="info@devzone.xyz">
<meta name="copyright" content="Software propietario de DEVZONE">
<meta name="rating" content="General">
<meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
<script type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/ajaxlib.js?version=<?=VERSION?>"></script>
<script type="text/javascript" src="js/interface.js"></script>
<!--BEGINIMPROMTU-->
<link rel="stylesheet" type="text/css" href="css/impromptu.css">
<script type="text/javascript" src="js/jquery.Impromptu.js"></script>
<!--ENDIMPROMTU--> 
<script type="text/javascript">      
// ELIMINA LOS REGISTROS DE LA CATEGORIA PRINCIPAL
function removeListCat(id){
	var txt = '<?=admin::labels('delete','sure')?><br><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();
				  $('#'+id).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/autorizacionCatDel.php',
						type: 'POST',
						data: 'uid='+id
					});
				 /********BeginResetColorDelete*************/  
				  resetOrderRemove(id);  
				 /********EndResetColorDelete*************/ 
		 
			}
			else{}
			
		}
	});
}
// ELIMINA LOS REGISTROS DE LA CATEGORIA PRINCIPAL
function removeList(id){
	var txt = '<?=admin::labels('delete','sure')?>?<br><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();
				  $('#sub_'+id).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/autorizacionDel.php',
						type: 'POST',
						data: 'uid='+id
					});
				/********BeginResetColorDelete*************/  
				//	  resetOrderRemove(id);  
				/********EndResetColorDelete*************/ 
				}
			else {}
		$("#list_"+id).hide();	
		}
	});
}


function aprobarSubasta(id){
	var txt = 'Esta seguro de Aprobar esta Solicitud?<br><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Aprobar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();
				  $('#sub_'+id).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/autorizacionApr.php',
						type: 'POST',
						data: 'uid='+id,
						 success: function() { 
								window.location.href='./autorizacionList.php?token=<?=admin::getParam("token")?>';
							}
					});
					 
				}
			else {}
		//$("#list_"+id).hide();	
		}
	});
}

function rechazarSubasta(id){
	var txt = 'Esta seguro de Rechazar esta Solicitud?<br><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Rechazar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();
				  $('#sub_'+id).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/autorizacionRechazar.php',
						type: 'POST',
						data: 'uid='+id,
						 success: function() { 
								window.location.href='./autorizacionList.php?token=<?=admin::getParam("token")?>';
							}
					});
					 
				}
			else {}
		//$("#list_"+id).hide();	
		}
	});
}
function adjudicarSubasta(id){
	var txt = '<span style="align="left">Orden de compra <input type="file" id="adjuntarID" name="adjuntarID" value="" /></span><br>(Pdf,Excel, Word)<br><br><br><br> * Sólo para compras con montos <?=$valAdj.$rolMax?> ';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Adjuidcar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();
				  $('#sub_'+id).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/adjudicarSubasta.php',
						type: 'POST',
						data: 'uid='+id,
						 success: function() { 
								window.location.href='./autorizacionList.php?token=<?=admin::getParam("token")?>';
							}
					});
					 
				}
			else {}
		//$("#list_"+id).hide();	
		}
	});
}
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top"><?php include_once("skin/header.php");?>
</td></tr>
  <tr>
    <td valign="top" id="content"><?php include_once("code/template/autorizacionListTpl.php"); ?></td>
  </tr>
<tr><td>
  <?php include("skin/footer.php"); ?>
  </td></tr>
</table>
</body>
</html>