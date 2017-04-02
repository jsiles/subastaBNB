<?php 
include_once("../../core/admin.php");

admin::initialize('subastas','docsCatAdd2',false); 
$inl_uid=admin::getParam("inl_uid");
$maxUid=admin::getDBvalue("SELECT max(inl_uid) FROM mdl_incoterm_language");
$maxUid++;
// REGISTRANDO LENGUAGE DE LAS CATEGORIAS
$sql = "update mdl_incoterm_language set inl_delete=1 where inl_uid='".$inl_uid."'";
			$db->query($sql);
// CONSTRUIMOS EL NUEVO SELECT	
?>
<select name="inc_inl_uid" id="inc_inl_uid" class="input"  >
                	<?
                    $sql = "select inl_uid, inl_name from mdl_incoterm_language where inl_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{	
					?>
					<option value="<?=$content["inl_uid"]?>"><?=$content["inl_name"]?></option>					
					<?
					}
                    ?>
				</select>
                <a href="nuevo" onclick="changeOtherIncoterm();return false;" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="borrar" onclick="deleteOtherIncoterm();return false;" class="small3"><?=admin::labels('del');?></a>
                <div id="div_other_incoterm" style="display:none;">
		<input type="text" name="other_incoterm" id="other_incoterm" class="input3" />		
		<a href="" onclick="incotermAdd();return false;" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeOtherincoterm();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_other_incoterm_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                </div>
                