<?php

$team_uid = $_REQUEST["team_uid"];
if ($team_uid=="")
 	header('Location: teamList.php');
	
 $sql= "select team_image
		from mdl_team 
		where team_uid=" . $team_uid ;

$db->query($sql);
$team = $db->next_record();
?>
<script type="text/javascript">
function preview(img, selection) { 
	var scaleX = 90 / selection.width; 
	var scaleY = 110 / selection.height; 
	var imgwidth = document.getElementById('thumbnail').width;
	var imgheight = document.getElementById('thumbnail').height;
//	alert(imgwidth);
	$('#thumbnail + div > img').css({ 
		width: Math.round(scaleX * imgwidth) + 'px', 
		height: Math.round(scaleY * imgheight) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
} 
$(document).ready(function () { 
		$('#save_thumb').click(function() {
			var x1 = $('#x1').val();
			var y1 = $('#y1').val();
			var x2 = $('#x2').val();
			var y2 = $('#y2').val();
			var w = $('#w').val();
			var h = $('#h').val();
			if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h=="")
				{
				scroll(0,0);
				$('#errorthump').fadeIn(700);
				setTimeout("$('#errorthump').fadeOut(700);",3000);
				}
			else
				{
				document.thumbnail.submit();
				}
		});
	}); 
$(window).load(function () { 	
	$('#thumbnail').imgAreaSelect({ aspectRatio: '90:110', onSelectChange: preview 
	}); 
});
</script>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
		<span class="title"><?=admin::labels('news','imagesize');?></span>
		</td>
		<td width="23%" height="40">&nbsp;</td>
	</tr>
  	<tr>
    	<td colspan="2" id="contentListing">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		 	<tr>
			<td width="50%" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td width="57%" valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%"  class="box">
			<tr>
			  <td valign="top">
<div id="errorthump" class="error" style="display:none;">
Debe seleccionar un área de la imagene
</div>
	<div style="padding-left:1px;">
		<img src="../img/team/img_<?=$team["team_image"]?>?<?=time()?>" style="float:none; margin-right: 1px;" id="thumbnail" alt="Imagen">
		<div style=" margin-top:10px; background-color:#003399;float:left; position:relative; overflow:hidden; width:90px; height:110px;">
			<img src="../img/team/img_<?=$team["team_image"]?>?<?=time()?>" style="position: relative;" alt="Vista previa">
		
		</div>
			<br style="clear:both;"/>			
			<!-- POSICIONES DE LA IMAGEN -->
			<form name="thumbnail" method="post" action="code/execute/teamUpd2.php" enctype="multipart/form-data" >
			<input type="hidden" name="team_uid" value="<?=$team_uid?>" />
			<input type="hidden" name="x1" value="" id="x1" />
			<input type="hidden" name="y1" value="" id="y1" />
			<input type="hidden" name="x2" value="" id="x2" />
			<input type="hidden" name="y2" value="" id="y2" />
			<input type="hidden" name="w" value="" id="w" />
			<input type="hidden" name="h" value="" id="h" />
			</form>
			<!-- POSICIONES DE LA IMAGEN -->
			
	</div>
  
		   </td></tr></table>
		   </td></tr></table>
		  </td></tr></table>
		 </td></tr></table>
		   		  
			  
			  
			  

<br />
<br />
<div id="contentButton">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td width="59%" align="center">
	
		<a href="#" class="button" id="save_thumb">
		<?=admin::labels('public');?>
		</a> 
		</td>
		<td width="41%" style="font-size:11px;">
		<?=admin::labels('or');?> <a href="newsList.php" ><?=admin::labels('cancel');?></a> 
		</td>
		</tr>
	</table>
</div>
<br /><br /><br /><br /><br /><br />

