<?php
include_once("../../core/admin.php");

admin::initialize('subastas','docsCatAdd2',false); 
$tra_uid=admin::getParam("tra_uid");
$maxUid=admin::getDBvalue("SELECT max(tra_uid) FROM mdl_transporte");
$maxUid++;
// REGISTRANDO LENGUAGE DE LAS CATEGORIAS
$sql = "update mdl_transporte set tra_delete=1 where tra_uid='".$tra_uid."'";
			$db->query($sql);
// CONSTRUIMOS EL NUEVO SELECT	
?>
<select name="inc_tra_uid" id="inc_tra_uid" class="input"  >
                	<?
                    $sql = "select tra_uid, tra_name from mdl_transporte where tra_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{	
					?>
					<option value="<?=$content["tra_uid"]?>"><?=$content["tra_name"]?></option>					
					<?
					}
                    ?>
				</select>
                <a href="nuevo" onclick="changeOtherTransporte();return false;" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="borrar" onclick="deleteOtherTransporte();return false;" class="small3"><?=admin::labels('del');?></a>
             <div id="div_other_transporte" style="display:none;">
		<input type="text" name="other_transporte" id="other_transporte" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_other_transporte_error').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_other_transporte_error').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_other_transporte_error').style.display='none';"/>		
		<a href="" onclick="transporteAdd();return false;" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeOtherTransporte();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_other_transporte_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>  
             