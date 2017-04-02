<?php
$ban_uid = admin::getParam("ban_uid");
if(!$ban_uid) header('Location: bannerList.php?token='.admin::getParam("token"));
	
	$sql= "SELECT ban_file FROM mdl_banners where ban_uid='".$ban_uid."'";
	$db->query($sql);
	$news = $db->next_record();
?>
<script type="text/javascript">
function preview(img, selection) { 
	var scaleX = 770 / selection.width; 
	var scaleY = 150 / selection.height; 
	var imgwidth = document.getElementById('thumbnail').width;
	var imgheight = document.getElementById('thumbnail').height;
//	alert(imgwidth);
	$('#subthumbnail').css({ 
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
		
	
			$('#save_thumb2').click(function() {
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
				//$('#skip').val(1);	
				document.thumbnail.action = document.thumbnail.action+'&skip=true'
				document.thumbnail.submit();
	
				}
		});
		
	}); 
$(window).load(function () { 	
	$('#thumbnail').imgAreaSelect({ aspectRatio: '770:150', onSelectChange: preview }); 
});
</script>
<br />


<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
		<span class="title">Seleccione con el mouse en la imagen</span>
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
''''''''' Debe seleccionar un &aacute;rea de la imagen '''''''''
</div>
<br />
	<div style="padding-left:100px;">
	<img src="../img/banner/Original_<?=$news["ban_file"]?>?<?=time()?>" style="float:none; margin-right: 1px;" id="thumbnail" alt="Image">
   <br /> <br /> <span class="title">Vista previa</span>   <br />
        	           
            <div style="margin-top:10px; background-color:#003399;float:left; position:relative; overflow:hidden; width:770px; height:100px;">
			<img id="subthumbnail" src="../img/banner/Original_<?=$news["ban_file"]?>?<?=time()?>" style="position: relative;" alt="Vista previa">
		
		</div>
			<br style="clear:both;"/>			
			<!-- POSICIONES DE LA IMAGEN -->
			<form name="thumbnail" method="post" action="code/execute/bannerUpd2.php?token=<?=admin::getParam("token").$skip;?>" enctype="multipart/form-data" >
			<input type="hidden" name="ban_uid" value="<?=$ban_uid?>" />
       
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
<div id="contentButton" style="width:auto">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
        <td width="39%" align="center">
        <a href="#" class="button" id="save_thumb2">
		<?=admin::labels('register');?>
		</a> 
		</td>
        
		</tr>
	</table>
</div>
