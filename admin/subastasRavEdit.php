<?php 
include_once ("core/admin.php");
$tipUid=  admin::getParam("tipUid");
switch($tipUid){
    case 1: $opcionMenu = "subastaRavParametros";
            $opocionSubMenu ="subastasRavEdit";
            $etiquetaCrear = "subastasRavNew";
            $moduleListId=8;
            $moduleCrearId=9;
            break;
    case 2: $opcionMenu = "subastaRavInforme";
            $opocionSubMenu ="subastasRavInfEdit";
            $etiquetaCrear = "subastasRavInfNew";
            $moduleListId=11;
            $moduleCrearId=12;
            break;    
    case 3: $opcionMenu = "ravSolicitud";
            $opocionSubMenu ="ravSolicitudEdit";
            $etiquetaCrear = "ravSolicitudNew";
            $moduleListId=32;
            $moduleCrearId=33;
            break;    
    case 4: $opcionMenu = "ravOrden";
            $opocionSubMenu ="ravOrdenEdit";
            $etiquetaCrear = "ravOrdenNew";
            $moduleListId=35;
            $moduleCrearId=36;
            break;                
    default :
            $opcionMenu = "subastaRavParametros";
            $opocionSubMenu ="subastasRavEdit";
            $moduleListId=8;
            $moduleCrearId=9;         

}
admin::initialize($opcionMenu, $opocionSubMenu); 
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
<script type="text/javascript">var SERVER='<?=$domain?>'; </script>
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
						url: 'code/execute/subastaCatDel.php',
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
						url: 'code/execute/subastasDel.php',
						type: 'POST',
						data: 'sub_uid='+id
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
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top"><?php include_once("skin/header.php");?>
</td></tr>
  <tr>
    <td valign="top" id="content"><?php include_once("code/template/subastasRavEditTpl.php"); ?></td>
  </tr>
<tr><td>
  <?php include("skin/footer.php"); ?>
  </td></tr>
</table>
</body>
</html>