<?php
define (SYS_LANG,$lang);
$maxLine=20;
$order=0; 
//variables para filtros de productos*******************************************
$timeNow= date("Y-m-d H:i:s");//sub_finish<>0
//echo $timeNow;
$maxLine2 = admin::toSql(admin::getParam("maxLineP"),"Number");
if ($maxLine2) {$maxLine=$maxLine2; admin::setSession("maxLineP",$maxLine2);}
else {
		$maxLine2=admin::getSession("maxLineP");
		if ($maxLine2) $maxLine=$maxLine2;
	}

if ($lang=='es') $urlFrontLang='';
else $urlFrontLang=$lang.'/';

$UrlProduct=admin::getDBvalue("select col_url FROM mdl_contents_languages where col_con_uid=3 and col_language='".$lang."'");

$contentURL = admin::getContentUrl($con_uid,SYS_LANG);
$rav_uid=  admin::getParam("rav_uid");
$qsearch="select * from mdl_rav where rav_tipologia=$tipUid and rav_uid=".$rav_uid;
$db->query($qsearch);
$rav = $db->next_record();
?>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<br>
    <form name="addRav" method="post" action="code/execute/subastasRavUpd.php?token=<?=admin::getParam("token")?>" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" valign="top"><table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
         <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('user','personaldata');?></td>
         </tr>
          
	<tr>
            <td width="5%" >Rol:</td>
        <td width="25%" ><select name="rav_rol" class="input"  >
                <option selected="selected" value="" class="txt10">Seleccionar Rol</option>
                	<?php
                    $sql3 = "select rol_uid, rol_description from mdl_roles";
					$db3->query($sql3);
					while ($content=$db3->next_record())
					{	
                                            ($rav["rav_rol_uid"]==$content["rol_uid"])?$select = 'selected="selected"':$select="";
					?>
					<option <?=$select?> value="<?=$content["rol_uid"]?>"><?=$content["rol_description"]?></option>					
					<?php
					}
                    ?>
				</select></td>
                                <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Monto inferior:</td>    
            <td width="20%" ><input name="rav_monto" value="<?=$rav["rav_monto_inf"]?>" class="input"></td>
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Monto superior:</td>
            <td width="20%" ><input name="rav_monto1" value="<?=$rav["rav_monto_sup"]?>" class="input"></td>
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Unidad Solicitante:</td>
             <td width="20%">
                  <span id="div_sub_unidad">
                <?php
                  $uUnidad = admin::getDbValue("select max(uni_uid) from mdl_unidad where uni_delete=0");
                  $arrayUnidad = admin::dbFillArray("select uni_uid, uni_description from mdl_unidad where uni_delete=0 order by uni_uid");
                  if(is_array($arrayUnidad)){
                  foreach($arrayUnidad as $key=>$value)
                   {            
                        if($key==$uUnidad) $nuevaLinea = "";
                        else $nuevaLinea = "<br>";
                        $valChecked=admin::getDbValue("select count(raa_uni_uid) from mdl_rav_access where raa_uni_uid=$key and raa_rav_uid=$rav_uid");
                        if($valChecked>0)$selectUni ='checked="checked"';
                        else $selectUni ="";
                        ?>
                      <input name="rav_uni_uid[]" value="<?=$key?>" class="input" type="checkbox" <?=$selectUni?>>&nbsp;<span class="txt10"><?=$value?></span>&nbsp;<?=$nuevaLinea?>
                        <?php
                   }
                  } else{
		?>
                        <span class="txt10">No existen unidades.</span>&nbsp;
                <?php
                    }
                ?>
                  </span>
                         
                <a href="javascript:addUnidad();" class="small2">agregar</a> | 
                <a href="javascript:delUnidad();" class="small3"><?=admin::labels('del');?></a>

                 <div id="div_add_unidad" style="display:none;">
		<input type="text" name="add_unidad" id="add_unidad" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_add_unidad_error').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_add_unidad_error').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_add_unidad_error').style.display='none';"/>		
		<a href="javascript:addUnidadOption()" class="button3"><?=admin::labels('add');?></a><a href="javascript:closeUnidad();" class="link2">Cerrar</a>		
                 </div>
	     <br /><span id="div_add_unidad_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                <br />
            </td>
            <td width="7%">&nbsp;</td>
            
        </tr>
        <tr>
            <td width="5%" >Moneda</td>
        
        <td>
    <?php 
				
				$arrayMoneda = admin::dbFillArray("select cur_uid, cur_description from mdl_currency where cur_delete=0");
				
				?>
                <span id="div_sub_moneda">
                <select name="rav_moneda" id="sub_moneda" class="input" >
                <?php
				foreach($arrayMoneda as $key=>$value)
				{   
                                    echo $rav["rav_cur_uid"];
                                    if($key==$rav["rav_cur_uid"]) $echoSel = 'selected="selected"';
                                    else $echoSel = "";
                                    
				?>
                	<option <?=$echoSel?> value="<?=$key?>"><?=$value?></option>
				<?php
				}
				?>
                </select>
                                &nbsp;<a href="javascript:addCurrency();" class="small2">agregar</a> | 
                <a href="javascript:delCurrency();" class="small3"><?=admin::labels('del');?></a></span>

                 <div id="div_add_currency" style="display:none;">
		<input type="text" name="add_currency" id="add_currency" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_add_currency_error').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_add_currency_error').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_add_currency_error').style.display='none';"/>		
		<a href="javascript:addCurrencyOption()" class="button3"><?=admin::labels('add');?></a><a href="javascript:closeCurrency();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_add_currency_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                </div>
                <br /><span id="div_sub_mount_base" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
				</td>
        </tr>
        <tr>
            <td width="5%" >Estado:</td>
            <td width="10%">
                <?php
                $selectA = "";
                $selectB = "";
                
                ($rav["rav_status"]=="ACTIVE")?$selectA = 'selected="selected"':$selectB = 'selected="selected"';
                        
                ?>
			<select name="rav_status" class="txt10" id="usr_status">
            	<option <?=$selectA?> value="1"><?=admin::labels('active');?></option>
              	<option <?=$selectB?> value="0"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_col_status" style="display:none;" class="error"></span>			</td>
                        <input name="rav_tipo" type="hidden" value="<?=$tipUid?>" />
                        <input name="rav_uid" type="hidden" value="<?=$rav_uid?>" />
                    <td width="7%">&nbsp;</td>
        </tr>
    </table>
    </form>
</div>
</td></tr>
</table>
    </td>
  </tr></table>
       
<br />
      <br />
      <div id="contentButton">
	  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="59%" align="center">
				<a href="guardar" onclick="document.addRav.submit(); return false;" class="button">
				<?=admin::labels('update');?>
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="subastasRavList.php?token=<?=admin::getParam("token")?>&tipUid=<?=$tipUid?>" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>
      <br /><br />
<br />
<br />

      <br />
      <br />

