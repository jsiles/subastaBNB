<?php
$new_uid = admin::toSql($_GET["new_uid"],"Number");
//$new_uid = 2;
$sql = "select * 
		from mdl_news 
		left join mdl_news_languages on (nel_new_uid=new_uid) 
		where nel_language='" . $lang . "'
			  and new_uid=" . $new_uid;
$db->query($sql);
$images_details = $db->next_record();
?>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<div id="div_wait_2" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<br />
<form name="frmPack" method="post" action="code/execute/packImgAdd.php?token=<?=admin::getParam('token');?>" enctype="multipart/form-data" >
<input type="hidden" name="pac_uid" id="pac_uid" value="<?=$images_details["new_uid"]?>" />
<input type="hidden" name="pal_title" id="pal_title" value="<?=$images_details["nel_title"]?>" />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
		<span class="title"><?=admin::labels('gallery');?>: <?=$images_details["nel_title"]?></span>
		</td>
		<td width="23%" height="40" align="right"></td>
	</tr>
        <tr>
		<td colspan="2">
		<ul id="flapSubmenu">
			<li><a href="newsEdit.php?new_uid=<?=$new_uid?>&token=<?=admin::getParam("token");?>" >Noticia</a></li>
			<li><a href="packImg.php?new_uid=<?=$new_uid?>&token=<?=admin::getParam("token");?>" class="active">Galer&iacute;a</a></li>
		</ul>
		</td>
	</tr>
  	<tr>
   	  <td colspan="2" id="contentListing">
	  
	  			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="box">
                <tr>
				<td>
<?php
	$sql = "select nei_uid,nei_image,nei_description   
			from mdl_news_images
			where nei_new_uid=" . $new_uid . " 
				  and nei_delete<>1 
			order by nei_position";
	$db2->query($sql);
	$numrows = $db2->numrows();
	$l=0;	
	$j=0;
	if ($numrows>0){
?>			
<div id="objlis">	
<ul id="listImg">
<?php 		
while ($img_list = $db2->next_record()) {
	$nei_uid = $img_list['nei_uid']; 
?>
	<li id="<?=$nei_uid ?>" class="<?=$nei_uid ?>Img">
		<a href="javascript:void(0);">
			<img id="<?=$nei_uid?>" width="70" height="49" alt="Imagen 01" src="<?=PATH_DOMAIN?>/img/packgallery/thumb3_<?=$img_list['nei_image'];?>?<?=time();?>"/>
		</a>
<span>		
		<textarea cols="39" rows="5" style="display:none;"
		class="textarea" id="seo_metadescription"
		onfocus="setClassTextarea(this,'ON');"
		onblur="setClassTextarea(this,'OFF');"
		onclick="setClassTextarea(this,'ON');"
		onkeydown="growTextarea(this);"><?= $img_list["nei_description"] ?></textarea>		
		<div class="boxTxt" style="background-color:#FFF"><?= $img_list["nei_description"] ?></div>
</span>		
<span>
		<a class="deleteImg" id="<?=$nei_uid ?>"  href="javascript:void(0);" >eliminar</a><br />
		<a class="editImg" id="<?=$nei_uid ?>"  href="javascript:void(0);" >editar</a><br />
		<a class="saveImg" id="<?=$nei_uid ?>" style="display:none;"  href="javascript:void(0);" >guardar</a>
</span>		
	</li>
<?php 
}
?>	
</ul>	
<?php 
	}
?>	
</div>	
	</td>
                </tr>
              </table>			
			  	  
			<!-- ADICION MULTIPLE DE IMAGENES -->
			<div id="DIV_IMAGES" >
			<? if ($l!=0) { ?>
				<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td style="background-color:#eef0f1" height="20"></td></tr></table>
				<? } ?>
			<table <?= ($numrows>=80?'style="display:none;"':'')?> id="uploaImg" width="100%" border="0" cellpadding="5" cellspacing="5" class="box">
				<tr>
				<td width="100%">
				
				<a name="anc_upload"></a>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="box">
		<tr>
		<br />
		<td style="padding-left:10px;"></span><br />
		<?=admin::labels('news','home'); ?> : <input type="checkbox" id="new_gallery" name="new_gallery" onclick="updateGallery(this,<?=$new_uid?>)" <?=($images_details["new_gallery"] ? 'checked="checked"':''); ?> />			
		</td>
		</tr>
		<tr><td height="10"></td></tr>
		<tr><td style="padding-left:30px;">		
		<input type="file" id="GALLERY_IMG" name="file[]" maxlength="<?= 80 - $numrows ?>" /></td>
		</tr>
		<tr><td height="10"></td></tr>
		<tr><td colspan="2" height="10"></td></tr>
		<tr><td colspan="2" style="padding-left:30px; padding-bottom:10px;" id="check_gallery">
		<input type="button" name="btnSubir" value="<?=admin::labels('gallery','uploadphoto'); ?>" onclick="document.frmPack.submit();" />		
		</td>
		</tr>
	</table></td>
                </tr>
              </table>
	</div>

	  </td>
    </tr>
	<tr>
		<td width="77%" height="19">&nbsp;</td>
		<td width="23%" height="19" align="right"></td>
	</tr>
</table>
</form>

<div id="contentButton">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td width="59%" align="center">
		<a href="newsList.php?new_public=2&token=<?=admin::getParam('token')?>" class="button" tabindex="15">
		<?=admin::labels('continue');?>
		</a> 
		</td>
		<!--<td width="41%" style="font-size:11px;">
		<?=admin::labels('or');?> <a href="newsList.php?token=<?=admin::getParam('token')?>" tabindex="16" ><?=admin::labels('cancel');?></a> 
		</td>-->
		</tr>
	</table>
</div>
<br /><br /><br /><br /><br /><br />
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>