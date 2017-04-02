<?php
 include ("core/admin.php"); 
 admin::initialize('informes','informesView'); 
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
<META HTTP-EQUIV="Content-Type" content="text/html; ISO-8859-1">
<script language="javascript" type="text/javascript" src="js/jquery-1.3.2.js"></script>
<script language="javascript" type="text/javascript" src="js/ajaxlib.js?version=<?=VERSION?>"></script>
<!-- PROMPT -->
<!--<script language="javascript" type="text/javascript" src="js/jquery.js"></script>-->
<script language="javascript" type="text/javascript" src="js/jquery.Impromptu.js"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.sortable.js" type="text/javascript"></script>
<script type="text/javascript" src="js/interface.js"></script>
<!-- TOOLTIPS DE ACRONYM -->
<script language="javascript" type="text/javascript" src="js/addEvent.js"></script>
<script language="javascript" type="text/javascript" src="js/sweetTitles.js"></script>
<link rel="stylesheet" href="css/sweetTitles.css" type="text/css" />
<!-- FIN -->
<!--BEGINIMPROMTU-->
<link rel="stylesheet" type="text/css" href="css/impromptu.css" />
<script type="text/javascript" src="js/jquery.Impromptu.js"></script>

<!--ENDIMPROMTU--> 
<!-- GROW de los Text areas -->
<script type="text/javascript">
function removeImg(id){
	var txt = '<?=admin::labels('imagequestion');?>?<br><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = id; /* m.find('#list').val(); */

				  $('#image_edit_'+uid).fadeOut(1, function(){ $(this).remove(); });
				  
					  $.ajax({
						url: 'code/execute/subastaImageDel.php',
						type: 'POST',
						data: 'uid='+uid
					});
					document.getElementById('image_add_'+uid).innerHTML = '<input type="file" name="pro_image" id="pro_image" size="31" class="input">';
					$('#image_add_'+uid).fadeIn(700);
			}
			else{}
			
		}
	});
}	

</script>
<script type="text/javascript">      
// ELIMINA LOS REGISTROS DE LA CATEGORIA PRINCIPAL
function removeList(id){
	var txt = '<?=admin::labels('delete','sure')?>?<br /><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();
				  $('#'+id).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/incotermDel.php',
						type: 'POST',
						data: 'uid='+id+'&token=<?=admin::getParam("token")?>'
					});
				   
				 }
			else {}
		}
	});
}
</script>
<script type="text/javascript">
		$(function() {
			$("ul").sortable(
				{ 
					update : function(event,ui){ 
						serial = $.SortSerialize('child');
						//alert ($(this).attr('id'));
						$("."+$(this).attr('id')+"").each(function(index) {
						});						
					}
				}			
			);
			$("ul").disableSelection();
		});
	$(document).ready(function(){
		$(".listOpt li a img").click(function(){
		var sw = $(this).attr('class');
			if($(this).attr('src')!='lib/more_off.gif'){
				if($(this).attr('id')=='close'){
					$(this).attr('id','open');
					$("#"+sw+"child").hide();
					$(this).attr('src','lib/more.gif');							
				}else{
					$(this).attr('id','close');				
					$("#"+sw+"child").show();
					$(this).attr('src','lib/minus.gif');		
				}				
			}	
		});		
	});		
	</script>	
<!-- FIN -->

</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top"><?php include_once("skin/header.php");?>
</td></tr>
  <tr>
    <td valign="top" id="content"><?php include_once("code/template/adjudicarSubastaTpl.php"); ?></td>
  </tr>
<tr><td>
  <?php include("skin/footer.php"); ?>
  </td></tr>
</table>
</body>
</html>