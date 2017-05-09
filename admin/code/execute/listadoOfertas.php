<?php
/*include_once("../../core/admin.php");
include_once("../../core/safeHtml.php");
include_once("../../core/files.php");
include_once("../../core/images.php");*/
admin::initialize('content','contentList',false);

$sqlTpl = "SELECT * FROM mdl_product, mdl_subasta, mdl_pro_category WHERE sub_uid=pro_sub_uid and pca_uid=sub_pca_uid and sub_uid='".$uidTpl."'";
$db->query($sqlTpl);
$prodTpl = $db->next_record();
$style='style="background-color:yellow;"';
$subType =$prodTpl["sub_type"];
          if($prodTpl["sub_modalidad"]=="TIEMPO"){
		 $countBids=admin::getDBvalue("SELECT count(*) FROM mdl_bid where bid_sub_uid='".$prodTpl["sub_uid"]."' and bid_cli_uid!=0 group by bid_uid order by bid_uid desc");
		 if ($countBids>0){
                     		 ?>
         <table width="100%" border="0">
         <tr>
            <td colspan="2" class="titleBox">Listado de ofertas:</td>
            <td><!--<a href="excel" onclick="document.location.href='ficheroExcel.php?subasta=<?=$prod["sub_uid"]?>'; return false;" class="xls">
				<img border="0" src="lib/ext/excel.png" alt="Excel" title="Excel" />
					</a>--></td>
          </tr>
                
            <tr>
				<td width="25%" class="txt11 color2">Proveedor:</td>
				<td width="25%" class="txt11 color2">Fecha y hora:</td>
                <td width="25%" class="txt11 color2">Monto:</td>
                    <?php
    if($sub_type!='VENTA'){
    ?>

                <td width="25%" class="txt11 color2">Monto con factor de ajuste:</td>
    <?php } ?>
			</tr>         
               
                 <?php
				$sql2 = "SELECT * FROM mdl_bid where bid_sub_uid='".$prod["sub_uid"]."' and bid_cli_uid!=0 order by bid_uid desc";
				$db2->query($sql2); $i=0;
                                
				while ($content=$db2->next_record())
				{
				 $clientName=admin::getDBvalue("SELECT cli_socialreason FROM mdl_client where cli_uid='".$content["bid_cli_uid"]."'");
				 ?><tr>
				<td width="25%" <?php if($i==0) echo $style;?>><?=$clientName?></td>
				<td width="25%" <?php if($i==0) echo $style;?>><?=$content["bid_date"]?></td>
                <td width="25%" <?php if($i==0) echo $style;?>><?=admin::numberFormat($content["bid_mount"])?></td>
                    <?php
    if($sub_type!='VENTA'){
    ?>

                <td width="25%" <?php if($i==0) echo $style;?>><?=admin::numberFormat($content["bid_mountxfac"])?></td>
    <?php } ?>
                                 </tr>
             	<?php
                                    $i++;
				 }
				 ?>    
        </table>
         <?php
                 }
                                }elseif($prodTpl["sub_modalidad"]=="ITEM"){
		 ?>
                        <table width="100%" border="0">
         <tr>
            <td colspan="2" class="titleBox">Cuadro de ofertas:</td>
            <td><!--<a href="excel" onclick="document.location.href='ficheroExcel.php?subasta=<?=$prod["sub_uid"]?>'; return false;" class="xls">
				<img border="0" src="lib/ext/excel.png" alt="Excel" title="Excel" />
					</a>--></td>
          </tr>
                
            <tr>
				<td width="25%" class="txt11 color2">Proveedor:</td>
				<td width="25%" class="txt11 color2">Fecha y hora:</td>
                                <td width="25%" class="txt11 color2">Monto:</td>
                                    <?php
    if($sub_type!='VENTA'){
    ?>

                                <td width="25%" class="txt11 color2">Monto con factor de ajuste:</td>
    <?php } ?>
                                <td width="25%" class="txt11 color2">Item:</td>
                                <!--<td width="25%" class="txt11 color2">Documento Oferta:</td>-->
                                
			</tr>         
               
                 <?php
                                
				$sql2 = "SELECT * FROM mdl_biditem where bid_sub_uid='".$prod["sub_uid"]."' and bid_cli_uid!=0 order by bid_uid desc";
				$db2->query($sql2);
				while ($content=$db2->next_record())
				{
                                 if($subType=="COMPRA") $sqlType="min(bid_mountxfac)";else $sqlType="max(bid_mountxfac)"; 
                                 $valWin = admin::dbFillArray("select bid_xit_uid,".$sqlType." from mdl_biditem where bid_xit_uid =". $content["bid_xit_uid"]." group by bid_xit_uid");
                                 if($valWin[$content["bid_xit_uid"]]!=$content["bid_mountxfac"]) $style="";else $style='style="background-color:yellow;"';
				 $clientName=admin::getDBvalue("SELECT cli_socialreason FROM mdl_client where cli_uid='".$content["bid_cli_uid"]."'");
				 ?><tr>
				<td width="25%" <?=$style?> ><?=$clientName?></td>
				<td width="25%" <?=$style?> ><?=$content["bid_date"]?></td>
                                <td width="25%" <?=$style?> ><?=admin::numberFormat($content["bid_mount"])?></td>
                                    <?php
    if($sub_type!='VENTA'){
    ?>

                                <td width="25%" <?=$style?> ><?=admin::numberFormat($content["bid_mountxfac"])?></td>
    <?php } ?> 
                                <td width="25%" <?=$style?> ><?=admin::getDBvalue("SELECT xit_description from mdl_xitem where xit_uid=".$content["bid_xit_uid"]." and xit_delete=0");?></td>
                               <!-- <td width="25%" <?=$style?> ><?php
                                if(file_exists(PATH_ROOT."/docs/subasta/".$content["bid_doc"])){
                                    
                                   ?>
                                    <a href="<?=PATH_DOMAIN."/docs/subasta/".$content["bid_doc"]?>" target="blank"><img src="<?=PATH_DOMAIN."/admin/lib/ext/doc-txt.png"?>" border="0" /></a>
                                    <?php
                                    
                                }else{
                                    ?>&nbsp;
                                    <?php
                                    
                                }
                                ?></td> -->
                                 </tr>
             	<?php
				 }
				 ?>    
        </table>
                        <?php
                                }else{
                                    
                                   ?>
                        <table width="100%" border="0">
         <tr>
            <td colspan="2" class="titleBox">Cuadro de ofertas:</td>
            <td><!--<a href="excel" onclick="document.location.href='ficheroExcel.php?subasta=<?=$prod["sub_uid"]?>'; return false;" class="xls">
				<img border="0" src="lib/ext/excel.png" alt="Excel" title="Excel" />
					</a>--></td>
          </tr>
                
            <tr>
				<td width="25%" class="txt11 color2">Proveedor:</td>
				<td width="25%" class="txt11 color2">Fecha y hora:</td>
                                <td width="25%" class="txt11 color2">Monto:</td>
                                    <?php
    if($sub_type!='VENTA'){
    ?>

                                <td width="25%" class="txt11 color2">Monto con factor de ajuste:</td>
    <?php } ?>
                                <td width="25%" class="txt11 color2">Item:</td>
                                <td width="25%" class="txt11 color2">Documento Oferta:</td>
                                
			</tr>         
               
                 <?php
				$sql2 = "SELECT * FROM mdl_biditem where bid_sub_uid='".$prod["sub_uid"]."' and bid_cli_uid!=0 order by bid_uid desc";
				$db2->query($sql2);
				while ($content=$db2->next_record())
				{
                                 if($subType=="COMPRA") $sqlType="min(bid_mountxfac)";else $sqlType="max(bid_mountxfac)"; 
                                 $valWin = admin::dbFillArray("select bid_xit_uid,".$sqlType." from mdl_biditem where bid_xit_uid =". $content["bid_xit_uid"]." group by bid_xit_uid");
                                 if($valWin[$content["bid_xit_uid"]]!=$content["bid_mountxfac"]) $style="";else $style='style="background-color:yellow;"';
				 
				 $clientName=admin::getDBvalue("SELECT cli_socialreason FROM mdl_client where cli_uid='".$content["bid_cli_uid"]."'");
				 ?><tr>
				<td width="25%" <?=$style?> ><?=$clientName?></td>
				<td width="25%" <?=$style?> ><?=$content["bid_date"]?></td>
                                <td width="25%" <?=$style?> ><?=admin::numberFormat($content["bid_mount"])?></td>
                                    <?php
    if($sub_type!='VENTA'){
    ?>

                               <td width="25%" <?=$style?> ><?=admin::numberFormat($content["bid_mountxfac"])?></td>
    <?php } ?>
                                <td width="25%" <?=$style?> ><?=admin::getDBvalue("SELECT xit_description from mdl_xitem where xit_uid=".$content["bid_xit_uid"]." and xit_delete=0");?></td>
                                <td width="25%" <?=$style?> ><?php
                                
                                if((file_exists(PATH_ROOT."/docs/subasta/".$content["bid_doc"]))&&(strlen($content["bid_doc"])>0)){
                                    
                                   ?>
                                    <a href="<?=PATH_DOMAIN."/docs/subasta/".$content["bid_doc"]?>" target="blank"><img src="<?=PATH_DOMAIN."/admin/lib/ext/doc-txt.png"?>" border="0" /></a>
                                    <?php
                                    
                                }else{
                                    ?>&nbsp;
                                    <?php
                                    
                                }
                                ?></td> 
                                 </tr>
             	<?php
				 }
				 ?>    
        </table>
                        <?php 
                                    
                                }
                        ?>