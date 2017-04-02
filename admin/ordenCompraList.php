<?php
 include ("core/admin.php"); 
 $tipUid=  admin::getParam("tipUid");
switch($tipUid){
    case 1: $opcionMenu = "ordCompras";
            $opocionSubMenu ="ordComprasList";
            $etiquetaCrear = "ordComprasNew";
            $moduleListId=43;
            $moduleCrearId=44;
            break;
    case 2: $opcionMenu = "aprOrdCompras";
            $opocionSubMenu ="aprOrdComprasList";
            $etiquetaCrear = "aprOrdComprasNew";
            $moduleListId=46;
            $moduleCrearId=46;
            break;    
    default :
            $opcionMenu = "ordCompras";
            $opocionSubMenu ="ordComprasList";
            $etiquetaCrear = "ordComprasNew";
            $moduleListId=43;
            $moduleCrearId=44;
            break;
}
admin::initialize($opcionMenu, $opocionSubMenu); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">    
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de Subastas > <?=admin::labels('htmltitlepage')?></title>
<link rel="shortcut icon" href="lib/favicon.ico" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/dhtml_horiz.css" type="text/css" />
<!--[if gte IE 5.5]>
<script language="JavaScript" src="css/dhtml.js" type="text/JavaScript"></script>
<![endif]-->
<META NAME="author" CONTENT="Jorge Siles" />
<META NAME="reply-to" CONTENT="" />
<META NAME="copyright" CONTENT="" />
<META NAME="rating" CONTENT="General" />

<script type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/ajaxlib.js?version=<?=VERSION?>"></script>
<script type="text/javascript" src="js/interface.js"></script>
<!--BEGINIMPROMTU-->
<link rel="stylesheet" type="text/css" href="css/impromptu.css">
<script type="text/javascript" src="js/jquery.Impromptu.js"></script>
<!--ENDIMPROMTU--> 
<script type="text/javascript">        
function removeList(id){
	var txt = '<?=admin::labels('delete','sure')?>?<br><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();

				  $('#sub_'+uid).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/ordenDel.php?token=<?=admin::getParam("token");?>',
						type: 'POST',
						data: 'uid='+uid
					});
		 
			}
			else{}
			
		}
	});
}
function aprobarOC(id){
	var txt = 'Esta seguro de Aprobar esta Solicitud?<br><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Aprobar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();
				  $('#sol_'+id).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/ordenApr.php',
						type: 'POST',
						data: 'uid='+id,
						 success: function() { 
								window.location.href='./ordenCompraList.php?token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>';
							}
					});
					 
				}
			else {}
		//$("#list_"+id).hide();	
		}
	});
}

function rechazarOC(id){
	var txt = 'Esta seguro de Rechazar esta Solicitud?<br><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Rechazar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();
				  $('#sol_'+id).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/ordenRechazar.php',
						type: 'POST',
						data: 'uid='+id,
						 success: function() { 
								window.location.href='./ordenCompraList.php?token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>';
							}
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
<tr><td valign="top"><?php include_once("skin/header.php");?>
</td></tr>
  <tr>
    <td valign="top" id="content"><?php include_once("code/template/ordenCompraListTpl.php"); ?></td>
  </tr>
<tr><td>
  <?php include("skin/footer.php"); ?>
  </td></tr>
</table>
</body>
</html>