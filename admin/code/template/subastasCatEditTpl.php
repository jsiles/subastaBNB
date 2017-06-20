<?php
$pca_uid = admin::toSql(admin::getParam("pca_uid"),"Number");
$sql = "select * 
		from mdl_subasta_category 
		left join mdl_subasta_category_languages on (pca_uid=pcl_pca_uid)
		where pcl_language='" . $lang . "' 
			  and pca_uid=" . $pca_uid . " 
		limit 1";
	
$db->query($sql);
$product_details = $db->next_record();

?>
<br />
<form name="frmCatProduct" method="post" action="code/execute/subastaCatUpd.php" enctype="multipart/form-data" >
<input type="hidden" name="pca_uid" id="pca_uid" value="<?=$pca_uid?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
		<span class="title"><?=admin::labels('subasta','catedit');?></span>
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
			<td width="57%" valign="top" rowspan="2">
			<table width="97%" border="0" cellpadding="5" cellspacing="5" class="box">			
				<tr>
				<td colspan="2" class="titleBox"><?=admin::labels('data');?></td>
				</tr>
				<tr>
					<td width="29%"><?=admin::labels('product');?>:</td>
					<td width="64%">
					<input type="hidden" name="pca_selected" id="pca_selected" value="<?=$product_details["pca_prd_uid"]?>" class="listMenu">
					<select name="pca_product" id="pca_product">
					<option value="1" <? if ($product_details["pca_prd_uid"]==1) echo 'selected="selected"'; ?>>Vino</option>
					<option value="2" <? if ($product_details["pca_prd_uid"]==2) echo 'selected="selected"'; ?>>Singani</option>
					</select>
					</td>
				</tr>
				<tr>
				<td><?=admin::labels('title');?>:</td>
				<td>
				<input name="pca_title" type="text" class="input" id="pca_title" onfocus="setClassInput(this,'ON');document.getElementById('div_pca_title').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_pca_title').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_pca_title').style.display='none';" size="50"  value="<?=$product_details["pcl_title"]?>"/>
				<br /><span id="div_pca_title" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subasta','titleerror');?></span>				</td>
			  	</tr>
		<tr>
			<td valign="top"><?=admin::labels('subasta','description');?> 1: </td>
			<td>
			<textarea name="pca_description1" cols="50" rows="8" class="textarea" id="pca_description1"  onfocus="setClassTextarea(this,'ON');" onblur="setClassTextarea(this,'OFF');" onclick="setClassTextarea(this,'ON');" onkeydown="growTextarea(this);"><?=$product_details["pcl_description1"]?></textarea>
			<span id="div_con_parent" style="display:none;" class="error"></span>			</td>
		</tr>
		<tr>
			<td valign="top"><?=admin::labels('subasta','description');?> 2: </td>
			<td>
			<textarea name="pca_description2" cols="50" rows="8" class="textarea" id="pca_description2"  onfocus="setClassTextarea(this,'ON');" onblur="setClassTextarea(this,'OFF');" onclick="setClassTextarea(this,'ON');" onkeydown="growTextarea(this);"><?=$product_details["pcl_description2"]?></textarea>
			<span id="div_con_parent" style="display:none;" class="error"></span>			</td>
		</tr>
          <tr>
            <td valign="top"><?=admin::labels('banner');?>:</td>
            <td>
			<? 
			$imgSavedroot2 = PATH_ROOT . "/admin/upload/subasta/" . $product_details["pcl_banner"];
			$imgSaveddomain2 = PATH_DOMAIN . "/admin/upload/subasta/" . $product_details["pcl_banner"];
			//echo $imgSaveddomain2;die;
			if (file_exists($imgSavedroot2) && $product_details["pcl_banner"]!="")
				{
				$extension = admin::getExtension($product_details["pcl_banner"]);
//				echo $extension;die;
				$imgextension = admin::getExtensionImage($extension);
			//	echo $imgextension;die;
			?>
			<div id="document_edit_<?=$product_details["pca_uid"]?>">
			<div id="changeFile">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="12%" rowspan="2" align="center" valign="top">
				<? if ($imgextension!="") { ?>
					<a href="<?=$imgSaveddomain2?>" target="_blank"><img border="0" src="<?=$imgextension?>" width="16" height="16"/></a>
				<? } ?> 
				</td>
				<td width="88%" style="font-size:11px;">
				<span class="nameFile"><?=substr($product_details["pcl_banner"],0,20)?></span>
			<br />
			<a href="javascript:chageUploadFile('on')" class="small2">
			<?=admin::labels('change');?>
				</a> <span class="pipe">|</span> <a href="#" onclick="removeFile(<?=$product_details["pca_uid"]?>);return false;" title="<?=admin::labels('del')?>" class="small3"><?=admin::labels('del')?></a>		
				</td>
			</tr>
			<tr>
				<td height="24" valign="top">
				<div id="div_adjunt_file_change" style="display:none;">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td width="67%">
					<input type="file" name="pca_banner" id="pca_banner" onchange="concepcion_files(this);" onclick="document.getElementById('div_pca_banner').style.display='none';" size="22" class="input" >
					</td>
					<td width="33%">
					<a href="javascript:chageUploadFile('off')" onclick="document.getElementById('pca_banner').value='';"><img border="0" src="lib/close.gif" align="top"/></a>					</td>
				</tr>
				</table>
				</div>
				</td>
			</tr>
			</table>
			</div>
			</div>
			<div id="image_add_<?=$product_details["pca_uid"]?>" style="display:none;"></div>
			<? } 
			else
				{ ?>
				<input type="file" name="pca_banner" id="pca_banner" onchange="concepcion_files(this);" onclick="document.getElementById('div_pca_banner').style.display='none';" size="31" class="input">				
			<?	} ?>
			<div id="div_pca_banner" style="display:none;" class="error"><?=admin::labels('banner_required');?></div>
			</td>
          </tr>
          <tr>
            <td valign="top"><?=admin::labels('status');?></td>
            <td><select name="pca_status" class="listMenu" id="pca_status">
            	<option <? if ($product_details["pca_status"]=='ACTIVE') echo 'selected="selected"'; ?> value="ACTIVE"><?=admin::labels('active');?></option>
              	<option <? if ($product_details["pca_status"]=='INACTIVE') echo 'selected="selected"'; ?> value="INACTIVE"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_bal_status" style="display:none;" class="error"></span>
			</td>
          </tr>
        </table>
			</td>
        <td width="43%" valign="top">
		<table width="98%" border="0" align="right" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('seo');?></td>
          </tr>
          <tr>
            <td width="25%"><?=admin::labels('seo','metatitle');?>:</td>
            <td width="66%"><input name="seo_metatitle" type="text" class="input" id="seo_metatitle"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" size="46" value="<?=$product_details["pcl_metatitle"]?>"/>
			<span id="div_col_metatitle" style="display:none;" class="error"></span>
			</td>
          </tr>
          <tr>
            <td><?=admin::labels('seo','metadescription');?>:</td>
            <td>
			<textarea name="seo_metadescription" cols="33" rows="6" class="textarea" id="seo_metadescription"  onfocus="setClassTextarea(this,'ON');" onblur="setClassTextarea(this,'OFF');" onclick="setClassTextarea(this,'ON');" onkeydown="growTextarea(this);" ><?=$product_details["pcl_metadescription"]?></textarea>
			</td>
          </tr>
          <tr>
            <td><?=admin::labels('seo','metakeywords');?>: </td>
            <td>
			<textarea name="seo_metakeyword" cols="33" rows="6" class="textarea" id="seo_metakeyword"  onfocus="setClassTextarea(this,'ON');" onblur="setClassTextarea(this,'OFF');" onclick="setClassTextarea(this,'ON');" onkeydown="growTextarea(this);"><?=$product_details["pcl_metakeyword"]?></textarea>
			</td>
          </tr>
        </table>
		</td>
		</tr>
		<tr>
		<td valign="top" style="padding-top:20px;">&nbsp;</td>
      </tr>
    </table>
	</td>
      </tr>
    </table></td>
    </tr>
</table>
</form>
<br />
<br />
<div id="contentButton">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td width="59%" align="center">
		<a href="javascript:verifyCatProd();" class="button">
		<?=admin::labels('public');?>
		</a> 
		</td>
		<td width="41%" style="font-size:11px;">
		<?=admin::labels('or');?> <a href="subastaList.php" ><?=admin::labels('cancel');?></a> 
		</td>
		</tr>
	</table>
</div>
<br /><br /><br /><br /><br /><br />
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
