<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
$category=admin::getParam("lista");

// REGISTRAMOS LA CATEGORIA
// dca_uid, dca_delete, 
$sql = "update mdl_unidad set uni_delete=1 where uni_uid in ($category) ";
$db->query($sql);
		        ?>
                <span id="div_sub_unidad">
                <?php
                  $uUnidad = admin::getDbValue("select max(uni_uid) from mdl_unidad where uni_delete=0");
                  $arrayUnidad = admin::dbFillArray("select uni_uid, uni_description from mdl_unidad where uni_delete=0 order by uni_uid");
                  if(is_array($arrayUnidad)){
                      $unidades=true;
                  foreach($arrayUnidad as $key=>$value)
                   {            
                        if($key==$uUnidad) $nuevaLinea = "";
                        else $nuevaLinea = "<br>";
                         
                        ?>
                      <input name="rav_uni_uid[]" value="<?=$key?>" class="input" type="checkbox">&nbsp;<span class="txt10"><?=$value?></span>&nbsp;<?=$nuevaLinea?>
                        <?php
                   }
                  }
                  ?>
                </span>