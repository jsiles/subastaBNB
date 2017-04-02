<?php
include_once("../../core/admin.php");
admin::initialize('subastas','docsCatAdd2',false); 
$ca1_description =  admin::getParam("nivel1_desc");
$sql = "insert into mdl_categoria1(
					ca1_description,
					ca1_delete
					)
				values
					(
						'".admin::toSql($ca1_description, "Text")."', 
						0
					)";

$db->query($sql);	
?>
<select name="nivel1_uid" id="nivel1_uid" class="input" onchange="actualizaNiveles();">
    <option value="" selected="selected" >Seleccionar</option>
               	<?php
                    $sql = "select ca1_uid, ca1_description from mdl_categoria1 where ca1_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{	
					?>
					<option value="<?=$content["ca1_uid"]?>"><?=$content["ca1_description"]?></option>					
					<?php
					}
                ?>
</select>
                <a href="nuevo" onclick="addNivel1();return false;" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="borrar" onclick="deleteNivel1();return false;" class="small3"><?=admin::labels('del');?></a>
                <div id="div_nivel1" style="display:none;">
		<input type="text" name="nivel1" id="nivel1" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_nivel1_error').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_nivel1_error').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_nivel1_error').style.display='none';"/>		
		<a href="" onclick="nivel1Add();return false;" class="button3"><?=admin::labels('add');?></a><a href="javascript:nivel1();" class="link2">Cerrar</a>		</div>
		<br /><span id="div_nivel1_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
