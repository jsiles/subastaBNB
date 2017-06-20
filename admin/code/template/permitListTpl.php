<?php
$sSQL= "select * from mdl_client_category where mcc_delete=0";			
$db->query($sSQL);
$nroReg = $db->numrows();
if ($nroReg>0)
	{
	?>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="77%" height="40"><span class="title"><?=admin::labels('permit','list')?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
	<?php
$i=1;
while ($user_list = $db->next_record())
	{
	$mcc_uid = $user_list["mcc_uid"];
	$rol_description = $user_list["mcc_permit"];

	if ($i%2==0) $class='row';
	else  $class='row0';
  	?> 
  	<div id="<?=$mcc_uid?>" class="<?=$class?>">
<table class="list" width="100%">
	<tr><td width="50%"><?=$rol_description?></td>
	<td align="center" width="12%" height="5">
		<img src="lib/view_off_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">
	</td>
	<td align="center" width="12%" height="5">
		<a href="permitEdit.php?mcc_uid=<?=$mcc_uid?>">
		<img src="lib/edit_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
		</a>
	</td>
	<td align="center" width="12%" height="5">
		<a href="#" onclick="removeList(<?=$mcc_uid?>);return false;">
		<img src="lib/delete_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>
	</td>
	<td align="center" width="14%" height="5">
	<div id="status_<?=$mcc_uid?>">
		<img src="lib/active_off_es.gif" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
	</div>
	</td>
		</tr>
	</table>
	</div>
	<?php
	$i++;
	}  ?>
    </td>
    </tr>
</table><br />
<br />
<br />
<?php 	} 
else
	{ ?>
	<br />
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
      <td width="77%" height="40"><span class="title"><?=admin::labels('permit','list')?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>   
  <tr>
    <td colspan="2" id="contentListing">
<div  style="background-color: #f7f8f8;">
<table class="list"  width="100%">
	<tr><td height="30px" align="center" class="bold">
	<?=admin::labels('permit','nopermit')?>
	</td></tr>	
 </table>
</div>
</td></tr></table>

<?php 	} ?>