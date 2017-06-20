<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('subastas','subastasList');
$shotAction = admin::toSql(admin::getParam("action"),"Text");

$shotAction();

function addCat(){
?>
	<input name="lab_category" type="text" class="input" id="lab_category" onfocus="setClassInput(this,'ON');document.getElementById('div_lab_category').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_lab_category').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_lab_category').style.display='none';" value="" size="20" />
	<a class="link2" href="javascript:categoryLabelsCancel();"><?=admin::labels('cancel');?></a>
<?php
}

function listCat(){
	$label_table = admin::toSql(admin::getParam("label_table"),"Text");

?>
	<select name="lab_category" class="listMenu" id="lab_category" onfocus="this.className='listMenu';document.getElementById('div_lab_category').style.display='none';">
			 <?php 
			 global $basedatos, $host, $user, $pass;
				$dset=new DBmysql;
				//$dset->connect($basedatos, $host, $user, $pass);
				switch ($label_table){
					case 'tbl_labels' : $sqldat = "select distinct lab_category from ".$label_table." WHERE lab_status='ACTIVE' order by lab_category"; break;
					case 'sys_labels' : $sqldat = "select distinct lab_uid as lab_category from ".$label_table." WHERE lab_status='ACTIVE' order by lab_uid"; break;
				}
				$dset->query($sqldat);
				$rowc = $dset->next_record();
				while(is_array($rowc)){ ?>
					<option <? if (label_category==$rowc["lab_category"]) echo "selected";?> value="<?=$rowc["lab_category"];?>"><?=$rowc["lab_category"];?></option>
				<?php
					$rowc = $dset->next_record();
				}
			 	?>
			</select>
			<a class="link2" href="javascript:categoryLabelsAdd();"><?=admin::labels('add');?></a>	
<?php
}

function labelsSave(){
		$label_table = admin::toSql(admin::getParam("label_table"),"Text");
			$lab_uid = admin::toSql(admin::getParam("lab_uid"),"Text");
			$lab_category = admin::toSql(admin::getParam("lab_category"),"Text");
			$new_value = admin::toSql(admin::getParam("new_value"),"Text");
		
		global $basedatos, $host, $user, $pass,$lang;
		$dset=new DBmysql;
		//$dset->connect($basedatos, $host, $user, $pass);
		if($label_table=="tbl_labels")
			$sqldat = "update ".$label_table." set lab_label='".$new_value."' where lab_uid='".$lab_uid."' and lab_category='".$lab_category."' and lab_language='".$lang."'";
		else 
			$sqldat = "update ".$label_table." set lab_label='".$new_value."' where lab_uid='".$lab_category."' and lab_category='".$lab_uid."' and lab_language='".$lang."'";
		$dset->query($sqldat);
			?>
			<a href="edit" onclick="label_edit('<?=$lab_uid?>','<?=$lab_category?>','<?=$label_table?>');return false;"><?=utf8_encode($new_value);?></a>
<?php
}
function labelsEdit(){
		$label_table = admin::toSql(admin::getParam("label_table"),"Text");
			$lab_uid = admin::toSql(admin::getParam("lab_uid"),"Text");
			$lab_category = admin::toSql(admin::getParam("lab_category"),"Text");
		global $basedatos, $host, $user, $pass,$lang;
		$dset=new DBmysql;
		//$dset->connect($basedatos, $host, $user, $pass);
		if($label_table=="tbl_labels")
			$sqldat = "select lab_label from ".$label_table." where lab_uid='".$lab_uid."' and lab_category='".$lab_category."' and lab_language='".$lang."'";
		else 
			$sqldat = "select lab_label from ".$label_table." where lab_uid='".$lab_category."' and lab_category='".$lab_uid."' and lab_language='".$lang."'";
		
		$dset->query($sqldat);
		$rowc = $dset->next_record();
		if(is_array($rowc)){
			?>
			<input type="text" id="input-<?=$lab_uid?>-<?=$lab_category?>-<?=$label_table?>" value="<?=utf8_encode($rowc["lab_label"])?>" size="80">			
			<a href="update" onclick="label_save('<?=$lab_uid?>','<?=$lab_category?>','<?=$label_table?>');return false;">Actualizar</a>
			<?php
		}
	?>
<a href="cancel" onclick="label_show('<?=$lab_uid?>','<?=$lab_category?>','<?=$label_table?>');return false;">Cancelar</a>
<?php
}

function labelsShow(){

		$label_table = admin::toSql(admin::getParam("label_table"),"Text");
			$lab_uid = admin::toSql(admin::getParam("lab_uid"),"Text");
			$lab_category = admin::toSql(admin::getParam("lab_category"),"Text");

		global $basedatos, $host, $user, $pass,$lang;
		$dset=new DBmysql;
		//$dset->connect($basedatos, $host, $user, $pass);
		if($label_table=="tbl_labels")
			$sqldat = "select lab_label from ".$label_table." where lab_uid='".$lab_uid."' and lab_category='".$lab_category."' and lab_language='".$lang."'";
		else 
			$sqldat = "select lab_label from ".$label_table." where lab_uid='".$lab_category."' and lab_category='".$lab_uid."' and lab_language='".$lang."'";
		$dset->query($sqldat);
		$rowc = $dset->next_record();
		if(is_array($rowc)){
			?>
			<a href="edit" onclick="label_edit('<?=$lab_uid?>','<?=$lab_category?>','<?=$label_table?>');return false;"><?=$rowc["lab_label"];?></a>
			<?php
		}
}

function labelsCS(){
global $basedatos, $host, $user, $pass,$lang;
		$dset=new DBmysql;
		//$dset->connect($basedatos, $host, $user, $pass);
		
			$label_table = admin::toSql(admin::getParam("label_table"),"Text");
			$lab_uid = admin::toSql(admin::getParam("lab_uid"),"Text");
			$lab_category = admin::toSql(admin::getParam("lab_category"),"Text");
			$status = admin::toSql(admin::getParam("status"),"Text");
			

if ($status=='ACTIVE'){
	$mediatatus = 'INACTIVE';
	$imgStatus = "lib/inactive_" . $lang . ".gif";
	}
else
	{
	$mediatatus = 'ACTIVE';
	$imgStatus = "lib/active_" . $lang . ".gif";	
	}
		if($label_table=="tbl_labels")
			$sqldat = "update tbl_labels set lab_status='" . $mediatatus . "' where lab_uid='".$lab_uid."' and lab_category='".$lab_category."' and lab_language='".$lang."'";
		else 
			$sqldat = "update sys_labels set lab_status='" . $mediatatus . "' where lab_uid='".$lab_category."' and lab_category='".$lab_uid."' and lab_language='".$lang."'";
	$dset->query($sqldat);
?>
<a href="javascript:labelsCS('<?=$lab_uid?>','<?=$lab_category?>','<?=$label_table?>','<?=$mediatatus?>');">
<img border="0" src="<?=$imgStatus?>" title="<?=admin::labels('status_on')?>" alt="<?=admin::labels('status_on')?>">
</a>
<?php
}

function labelsDel(){
global $basedatos, $host, $user, $pass,$lang;
		$dset=new DBmysql;
		//$dset->connect($basedatos, $host, $user, $pass);
		
			$label_table = admin::toSql(admin::getParam("label_table"),"Text");
			$lab_uid = admin::toSql(admin::getParam("lab_uid"),"Text");
			$lab_category = admin::toSql(admin::getParam("lab_category"),"Text");
			$status = admin::toSql(admin::getParam("status"),"Text");
			

		if($label_table=="tbl_labels")
			$sqldat = "update tbl_labels set lab_delete='1' where lab_uid='".$lab_uid."' and lab_category='".$lab_category."' and lab_language='".$lang."'";
		else 
			$sqldat = "update sys_labels set lab_delete='1' where lab_uid='".$lab_category."' and lab_category='".$lab_uid."' and lab_language='".$lang."'";
	$dset->query($sqldat);
}
?>
