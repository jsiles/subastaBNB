<?php
include_once("../../core/admin.php");
$ca3_description =  admin::getParam("nivel3_desc");
$ca2_uid=  admin::getParam("ca2_uid");
if(strlen($ca3_description)>0&&$ca2_uid!=''){
$sql = "insert into mdl_categoria3(
                                        ca3_ca2_uid,
					ca3_description,
					ca3_delete
					)
				values
					(
                                                $ca2_uid,
						'".admin::toSql($ca3_description, "Text")."', 
						0
					)";

$db->query($sql);	
}
?>
<select name="nivel3_uid" id="nivel3_uid" class="input">
    <option value="" selected="selected" >Seleccionar</option>
               	<?php
                    $sql = "select ca3_uid, ca3_description from mdl_categoria3 where ca3_delete=0 and ca3_ca2_uid=$ca2_uid";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{	
					?>
					<option value="<?=$content["ca3_uid"]?>"><?=$content["ca3_description"]?></option>					
					<?php
					}
                ?>
</select>
                <a href="nuevo" onclick="addNivel3();return false;" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="borrar" onclick="deleteNivel3();return false;" class="small3"><?=admin::labels('del');?></a>
                <div id="div_nivel3" style="display:none;">
		<input type="text" name="nivel3" id="nivel3" class="input3" 
                       onfocus="setClassInput3(this,'ON');document.getElementById('div_nivel3_error').style.display='none';" 
                       onblur="setClassInput3(this,'OFF');document.getElementById('div_nivel3_error').style.display='none';" 
                       onclick="setClassInput3(this,'ON');document.getElementById('div_nivel3_error').style.display='none';"/>		
		<a href="" onclick="nivel3Add();return false;" class="button3"><?=admin::labels('add');?></a><a href="javascript:nivel3();" class="link2">Cerrar</a>		
                </div>
		<br /><span id="div_nivel3_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>