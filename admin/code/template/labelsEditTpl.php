<?php

$label_table = admin::toSql(safeHtml($_REQUEST["label_table"]),"String"); 
$_label_uid = admin::toSql(safeHtml($_REQUEST["label_uid"]),"String"); 
$_label_category = admin::toSql(safeHtml($_REQUEST["label_category"]),"String"); 
switch($label_table){
	case 'tbl_labels' : $label_uid = $_label_uid; $label_category = $_label_category; break;
	case 'sys_labels' : $label_uid = $_label_category; $label_category = $_label_uid; break;
}
 $sql= "select *
		from ".$label_table." 
		where lab_uid='" . $label_uid . "' and lab_category='" . $label_category . "' and lab_language='".$lang."'";

$db->query($sql);
$row_office = $db->next_record();
?>
<br />
<form name="frmLabels" id="frmLabels" method="post" action="code/execute/labelsUpd.php" enctype="multipart/form-data" onsubmit="return false;">
<input type="hidden" name="label_uid" value="<?=($label_table=='tbl_labels' ? $label_uid : $label_category); ?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
		<span class="title"><?=admin::labels('offices','edit');?></span>
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
	<table border="0" cellpadding="0" cellspacing="0" width="97%"  class="box">
		<tr>
        
        <td valign="top">
		<table width="100%" border="0" cellpadding="5" cellspacing="5" class="box">			
		<tr>
		<td colspan="2" class="titleBox"><?=admin::labels('data');?></td>
		</tr>
		<tr>
            <td><?=admin::labels('labels','location');?>:</td>
            <td><select name="label_table" class="listMenu" id="label_table">
					<option <?=$label_table=="tbl_labels" ?"selected":"";?> value="tbl_labels">General</option>
					<option <?=$label_table=="sys_labels" ?"selected":"";?> value="sys_labels">Sistema</option>
			</select>
			<span id="div_label_table" style="display:none;" class="error"></span>
			</td>
          </tr>
          	
          <tr>
				<td width="29%"><?=admin::labels('labels','category');?>:</td>
				<td width="64%">
				<div id="category">
	<select name="lab_category" class="listMenu" id="lab_category" onfocus="this.className='listMenu';document.getElementById('div_lab_category').style.display='none';">
			 <?php 
			 global $basedatos, $host, $user, $pass;
				$dset=new DBmysql;
				//$dset->connect($basedatos, $host, $user, $pass);
				switch ($label_table){
					case 'tbl_labels' : $sqldat = "select distinct lab_category from ".$label_table." WHERE lab_status='ACTIVE' order by lab_category"; break;
					case 'sys_labels' : $sqldat = "select distinct lab_uid as lab_category from ".$label_table." WHERE lab_status='ACTIVE' order by lab_uid"; break;
				}
				$dset->query($sqldat) ;
				$rowc = $dset->next_record();
				while(is_array($rowc)){ 
				 $sel_field = ($label_table=='tbl_labels' ? $label_category : $label_uid);
				 ?>
					<option <? if ($sel_field==$rowc["lab_category"]) echo "selected";?> value="<?=$rowc["lab_category"];?>"><?=$rowc["lab_category"];?></option>
				<?php
					$rowc = $dset->next_record();
				}
			 	?>
			</select>
			<a class="link2" href="javascript:categoryLabelsAdd();"><?=admin::labels('add');?></a>
			</div>

		<span id="div_lab_category" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('offices','titleerror');?></span>
				</td>
			  	</tr>   
  		 <tr>
				<td width="29%"><?=admin::labels('labels');?>:</td>
				<td width="64%">
	<input name="lab_label" type="text" class="input" id="lab_label" onfocus="setClassInput(this,'ON');document.getElementById('div_lab_label').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_lab_label').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_lab_label').style.display='none';" value="<?=$row_office["lab_label"]?>" size="67" />
<br /><span id="div_lab_label" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('offices','titleerror');?></span>				
				</td>
			  	</tr>	
          <tr>
            <td><?=admin::labels('status');?>:</td>
            <td><select name="ofl_status" class="listMenu" id="ofl_status">
            	<option <? if ($row_office["ofl_status"]=='ACTIVE') echo "selected";?> value="ACTIVE"><?=admin::labels('active');?></option>
              	<option <? if ($row_office["ofl_status"]=='INACTIVE') echo "selected";?> value="INACTIVE"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_bal_status" style="display:none;" class="error"></span>
			</td>
          </tr>

        </table>
			</td>
		</tr>
	</table>
		</td>
        <td width="44%" valign="top">
		</td></tr>
    </table></td>
      </tr>
      
      <tr><td colspan="2"><br /> </td></tr>
         
      
     </table></td>
    </tr>
</table>
</form>
      <br />
<br />
<br />
<div id="contentButton">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td width="59%" align="center">
		<a href="javascript:verifylabels();" class="button">
		<span id="button_next"><?=admin::labels('update');?></span>
		</a> 
		</td>
		<td width="41%" style="font-size:11px;">
		<?=admin::labels('or');?> <a href="labelsList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		</td>
		</tr>
	</table>
</div>
<br /><br /><br /><br /><br /><br />