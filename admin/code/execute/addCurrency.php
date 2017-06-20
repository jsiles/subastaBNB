<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('subastas','subastasEdit'); 
$category=admin::getParam("currency");

// REGISTRAMOS LA CATEGORIA
// dca_uid, dca_delete, 
$sql = "insert into mdl_currency(cur_description, cur_delete)
					values	('".$category."',0)";
$db->query($sql);
				$arrayMoneda = admin::dbFillArray("select cur_uid, cur_description from mdl_currency where cur_delete=0");
				
				?>
                <select name="sub_moneda" id="sub_moneda" class="input" >
                <?php
				foreach($arrayMoneda as $key=>$value)
				{                
				?>
                	<option <? if ($key==$prod["sub_moneda"]) echo 'selected="selected"';?> value="<?=$key?>"><?=$value?></option>
				<?php
				}
				?>
                </select>
                                &nbsp;<a href="javascript:addCurrency();" class="small2">agregar</a> | 
                <a href="javascript:delCurrency();" class="small3"><?=admin::labels('del');?></a>