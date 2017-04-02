<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('client','clientNew',false); 
$pts_type=admin::getParam("pts_uid");

// REGISTRANDO LENGUAGE DE LAS CATEGORIAS
$sql = "insert into mdl_paymenttosupplier(
					pts_type, 
					pts_status,
					pts_delete
					)
				values
					(
						'".$pts_type."', 
						'ACTIVE', 
						0
					)";
$db->query($sql);	
// CONSTRUIMOS EL NUEVO SELECT	
?>
<select name="cli_pts_uid" class="txt10" id="cli_pts_uid">
                <? 
				$sql = "select pts_uid, pts_type from mdl_paymenttosupplier where pts_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
						($content["pts_type"]==$pts_type)?$selected="selected":$selected="";
				?>
            	    <option value="<?=$content["pts_uid"]?>" <?=$selected?>><?=$content["pts_type"]?></option>	
              	<? 
					}
				?>
			</select>
            <a href="javascript:changeClientType();" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="javascript:deleteClientType();" class="small3"><?=admin::labels('del');?></a>
                <div id="div_client_type" style="display:none;">
		<input type="text" name="client_type" id="client_type" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_cli_pts_uid').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_cli_pts_uid').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_cli_pts_uid').style.display='none';"/>		
		<a href="javascript:TypeClientAdd()" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeClientType();" class="link2">Cerrar</a>		</div>
        <br /><span id="div_cli_pts_uid" style="display:none;" class="error">Forma de pago al proveedor es necesaria</span>