<?php
 include ("core/admin.php"); 
 admin::initialize('divisas','divisasCreate'); 
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
<script type="text/javascript">var SERVER='<?=$domain?>'; </script>

<script language="javascript" type="text/javascript" src="js/jquery-1.3.2.js"></script>
<script language="javascript" type="text/javascript" src="js/ajaxlib.js?version=<?=VERSION?>"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.sortable.js" type="text/javascript"></script>
<script type="text/javascript" src="js/interface.js"></script>
<script type="text/javascript" src="js/subastas.js?version=<?=VERSION?>"></script>

<!--BEGINIMPROMTU-->
<link rel="stylesheet" type="text/css" href="css/impromptu.css">
<script type="text/javascript" src="js/jquery.Impromptu.js"></script>
<!--ENDIMPROMTU--> 

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
	}
window.onload = init;
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
<tr><td valign="top"><? include_once("skin/header.php");?>
</td></tr>
  <tr>
    <td valign="top" id="content"><? include_once("code/template/divisasNewTpl.php"); ?></td>
  </tr>
<tr><td>
  <? include("skin/footer.php"); ?>
  </td></tr>
</table>
</body>
</html>