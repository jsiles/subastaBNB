<?php
$dca_uid = admin::getParam("dca_uid");
if ($dca_uid=="")
	echo "<script>document.location.href='teamList.php';</script>";
$sql= "select *
		from mdl_team_category 
		where tca_uid=" . $dca_uid . " and tca_delete=0";
//echo $sql;die;		
$db->query($sql);
$docs_category = $db->next_record();
?>
<br />
<form name="frmDocsCat" method="post" action="code/execute/teamCatUpd.php" enctype="multipart/form-data" >
<input type="hidden" name="dca_uid" id="dca_uid" value="<?=$dca_uid?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
		<span class="title"><?=admin::labels('docs','catedit');?></span>
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
			<td width="50%" valign="top" rowspan="2">
			<div style="background-color:#FFFFFF; height:100%; width:98%;">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr><td  valign="top">
			
			<table width="100%" border="0" cellpadding="5" cellspacing="5"  class="box">			
				<tr>
				<td colspan="2" class="titleBox"><?=admin::labels('data');?></td>
				</tr>
				<tr>
				<td width="29%" valign="top"><?=admin::labels('title');?>:</td>
				<td width="64%" valign="top"><input name="dca_category" type="text" class="input" id="dca_category" onfocus="setClassInput(this,'ON');document.getElementById('div_dca_category').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_dca_category').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_dca_category').style.display='none';" value="<?=$docs_category["tca_category"]?>" size="50"/>
				  <br />
				  <span id="div_dca_category" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('docs','catCategoryerror');?></span>					</td>
				</tr>
				<tr>
				<td><?=admin::labels('status');?></td>
				<td>
				<select name="dcl_status" class="listMenu" id="dcl_status">
					<option <? if ($docs_category["tca_status"]=="ACTIVE") echo "selected";?> value="ACTIVE"><?=admin::labels('active');?></option>
					<option <? if ($docs_category["tca_status"]=="INACTIVE") echo "selected";?> value="INACTIVE"><?=admin::labels('inactive');?></option>
				</select>
				<span id="div_dcl_status" style="display:none;" class="error"></span>				</td>
				</tr>
			</table>
			</td>
		</tr>
	</table>
	</div>
		</td>
        <td width="50%" valign="top">
		
		</td>
    </table></td>
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
		<a href="javascript:verifyCatDocs();" class="button">
		<?=admin::labels('public');?>
		</a> 
		</td>
		<td width="41%" style="font-size:11px;">
		<?=admin::labels('or');?> <a href="teamList.php" ><?=admin::labels('cancel');?></a> 
		</td>
		</tr>
	</table>
</div>
<br /><br /><br /><br /><br /><br />
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
