<?php include ("core/admin.php"); 
include ("core/safeHtml.php"); 
admin::initialize('offices','officesEdit'); ?>
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
<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/ajaxlib.js?version=<?=VERSION?>"></script>

<!-- TOOLTIPS DE ACRONYM -->
<script language="javascript" type="text/javascript" src="js/addEvent.js"></script>

<!-- FIN -->

<!-- PROMPT -->
<script language="javascript" type="text/javascript" src="js/jquery.Impromptu.js"></script>
<link rel="stylesheet" type="text/css" href="css/impromptu.css">
<!-- FIN PROMPT -->

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
	//document.getElementById("ofl_address").onkeypress = grow;		
	}
window.onload = init;

function removeDoc(id){
	var txt = 'Está seguro de eliminar el documento?<br/><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = id; /* m.find('#list').val(); */

				  $('#document_edit_'+uid).fadeOut(1, function(){ $(this).remove(); });
				  
					  $.ajax({
						url: 'code/execute/officesDocumentDel.php',
						type: 'POST',
						data: 'uid='+uid
					});
					document.getElementById('document_add_'+uid).innerHTML = '<input type="file" name="off_adjunt" id="off_adjunt" size="31" class="input">';					
					$('#document_add_'+uid).fadeIn(700);
			}
			else{}
			
		}
	});
}
function removeImg(id){
	var txt = 'Está seguro de eliminar la imágen?<br/><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = id; /* m.find('#list').val(); */

				  $('#image_edit_'+uid).fadeOut(1, function(){ $(this).remove(); });
				  
					  $.ajax({
						url: 'code/execute/officesImageDel.php',
						type: 'POST',
						data: 'uid='+uid
					});
					document.getElementById('image_add_'+uid).innerHTML = '<input type="file" name="off_image" id="off_image" onchange="verifyImageUpload();" size="32" class="input"><span id="div_off_image" class="error" style="display:none">Solo archivos jpg gif png </span>	';
					$('#image_add_'+uid).fadeIn(700);
			}
			else{}
			
		}
	});
}


function removeList(id){
	var txt = 'Está seguro de eliminar el registro?<br/><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();

				  $('#'+uid).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/officesCommentDel.php',
						type: 'POST',
						data: 'uid='+uid
					});
				 /********BeginResetColorDelete*************/  
				  resetOrderRemove(uid);  
				 /********EndResetColorDelete*************/ 
		 
			}
			else{}
			
		}
	});
}

// validate
	function verifylabels(){
	sw=true;
	
	
	if (document.getElementById('lab_uid').value==''){
		document.getElementById('lab_uid').className='inputError';
		document.getElementById('div_lab_uid').style.display='';
		sw=false;
		}
	
	if (sw){
		document.frmLabels.submit();
		}
	else{
		scroll(0,0);
		}
	}
</script>
<!-- FIN -->
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td valign="top"><? include_once("skin/header.php");?>
	</td>
</tr>
  <tr>
    <td valign="top" id="content">
	<? include_once("code/template/labelsEditTpl.php"); ?>
	</td>
  </tr>
<tr>
	<td>
  <? include("skin/footer.php"); ?>
  </td>
  </tr>
</table>
</body>
</html>