<?php
include_once ("core/admin.php"); 
admin::initialize('labels','labelsList'); ?>

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
<meta name="ROBOTS" content="NOINDEX,NOFOLLOW">
<META HTTP-EQUIV="Content-Type" content="text/html; ISO-8859-1">
<script type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/ajaxlib.js?version=<?=VERSION?>"></script>
<script type="text/javascript" src="js/interface.js"></script>
<!--BEGINIMPROMTU-->
<link rel="stylesheet" type="text/css" href="css/impromptu.css">
<script type="text/javascript" src="js/jquery.Impromptu.js"></script>
<!--ENDIMPROMTU--> 
<script type="text/javascript">      
// ELIMINA LOS REGISTROS DE LA CATEGORIA PRINCIPAL
function removeList(lab_uid,lab_category,label_table){
	var txt = '¿<?=admin::labels('delete','sure')?>?<br/><input type="hidden" id="list" name="list" value="'+ lab_uid +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();
				  $('#groupSubItem_'+lab_uid+'_'+lab_category).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/labelsCategoryAdd2.php',
						type: 'POST',
						data: 'action=labelsDel&lab_uid='+lab_uid+'&lab_category='+lab_category+'&label_table='+label_table
					});
				 /********BeginResetColorDelete*************/  
				  //resetOrderRemove(id);  
				 /********EndResetColorDelete*************/ 
				 }
			else {}
			
		}
	});
}

function labelsCS(lab_uid,lab_category,label_table,status){
	  divx = document.getElementById('status_' + lab_uid+"_"+lab_category);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  ajax=objectAjax();

  ajax.open("POST", "code/execute/labelsCategoryAdd2.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("action=labelsCS&lab_uid="+lab_uid+"&lab_category="+lab_category+"&label_table="+label_table+"&status="+status)
  }	

 function label_save(lab_uid,lab_category,label_table){
 	new_value = $("#input-"+lab_uid+"-"+lab_category+"-"+label_table).val();
 	$("#listado_"+lab_uid+"_"+lab_category).load("code/execute/labelsCategoryAdd2.php?action=labelsSave&lab_uid="+lab_uid+"&lab_category="+lab_category+"&label_table="+label_table+"&new_value="+new_value);
 }

 function label_show(lab_uid,lab_category,label_table){
 	$("#listado_"+lab_uid+"_"+lab_category).load("code/execute/labelsCategoryAdd2.php?action=labelsShow&lab_uid="+lab_uid+"&lab_category="+lab_category+"&label_table="+label_table);
 }
 function label_edit(lab_uid,lab_category,label_table){
 	$("#listado_"+lab_uid+"_"+lab_category).load("code/execute/labelsCategoryAdd2.php?action=labelsEdit&lab_uid="+lab_uid+"&lab_category="+lab_category+"&label_table="+label_table);
 }
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top"><? include_once("skin/header.php");?>
</td></tr>
  <tr>
    <td valign="top" id="content"><? include_once("code/template/labelsListTpl.php"); ?></td>
  </tr>
<tr><td>
  <? include("skin/footer.php"); ?>
  </td></tr>
</table>
</body>
</html>