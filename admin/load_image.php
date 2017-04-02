<script language="javascript" type="text/javascript">
function verifyImageUpload()
	{
	//document.getElementById('div_con_image').style.display="none";
	var cv = document.getElementById('con_image').value;
	var filepart = cv.split(".");
	var part = filepart.length-1;
	var extension = filepart[part];
	extension = extension.toLowerCase();
	if (extension!='jpg' && extension!='jpeg'  && extension!='gif' && extension!='png')	
		{
		document.getElementById('con_image').value="";
		$('#div_con_image').fadeIn(500);
		//document.getElementById('button_next').innerHTML='<?=admin::labels('public');?>';
		}
	else
		{
		//document.getElementById('button_next').innerHTML='<?=admin::labels('continue');?>';
		}
	}
</script>
<?php 
$displayImage = $_REQUEST["wys"]=="off" ? "none" : "";
?>
<tr id="load_image" style="display:<?=$displayImage;?>">
            <td valign="top"><?=admin::labels('news','image');?>:</td>
            <td>
			<?php
			$imgSavedroot1 = PATH_ROOT."/img/".$ruta."/thumb2_".$con_image;
			$imgSaveddomain1 = PATH_DOMAIN."/img/".$ruta."/thumb2_".$con_image;
			$imgSaveddomain2 = PATH_DOMAIN."/img/".$ruta."/thumb2_".$con_image;
			if (file_exists($imgSavedroot1) && $con_image!="")
				{
			?>
			<div id="image_edit_<?=$con_uid?>">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableUpload">
			<tr>
				<td width="25%" rowspan="2" align="center" valign="middle" style="padding:4px;">
				<a href="<?=$imgSaveddomain2?>" target="_blank"><img src="<?=$imgSaveddomain1.'?'.date('Hms')?>" border="0" width="60"/></a>				</td>
				<td width="75%" style="font-size:11px;">
				<?=substr($con_image,0,20);?>... <br />
				<a href="javascript:viewInputFile('on')" title="<?=admin::labels('change');?>" class="small2"><?=admin::labels('change');?></a>
				<span class="pipe">|</span> <a href="#" onclick="removeImg(<?=$con_uid?>);return false;" title="<?=admin::labels('del')?>" class="small3"><?=admin::labels('del')?></a>				</td>
			</tr>
			<tr>
				<td height="24">
				<div id="imageChange1" style="display:none">
			<input type="file" name="con_image" id="con_image" size="14" onchange="verifyImageUpload();" style="font-size:11px;"  >  <a href="javascript:viewInputFile('off')"><img border="0" src="lib/close.gif" align="top"/></a>
			
			<span id="div_new_image" class="error" style="display:none">Solo archivos jpg gif png </span>			</div></td>
			</tr>
			</table>
			</div>
			<div id="image_add_<?=$con_uid?>" style="display:none;"></div>
			<?php	}
			else
				{ ?>
				<input type="file" name="con_image" id="con_image" size="32" class="input" onchange="verifyImageUpload();">
				<span id="div_con_image" class="error" style="display:none">Solo archivos jpg gif png </span>	
			<?php	} ?>	</td>
			
          </tr>