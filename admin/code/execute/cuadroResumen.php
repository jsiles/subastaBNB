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
          if($prodTpl["sub_modalidad"]!="TIEMPO"){
		 ?>
<br />
<br />
                        <table width="100%" border="0">
         <tr>
            <td colspan="2" class="titleBox">Cuadro Resumen:</td>
            <td><!--<a href="excel" onclick="document.location.href='ficheroExcel.php?subasta=<?=$prod["sub_uid"]?>'; return false;" class="xls">
				<img border="0" src="lib/ext/excel.png" alt="Excel" title="Excel" />
					</a>--></td>
          </tr>
                
            <tr>
				<td width="25%" class="txt11 color2">Item:</td>
				<td width="25%" class="txt11 color2">Precio Base:</td>
                                <td width="25%" class="txt11 color2">Precio Ofertado:</td>
                                <td width="25%" class="txt11 color2">Beneficio Obtenido:</td>
                                <!--<td width="25%" class="txt11 color2">Documento Oferta:</td>-->
            </tr>         
               
                 <?php
                                
				$sql2 = "SELECT bid_xit_uid FROM mdl_biditem where bid_sub_uid='".$prod["sub_uid"]."' and bid_cli_uid!=0 group by bid_xit_uid";
				$db2->query($sql2);
                                //echo $sql2;
				while ($content=$db2->next_record())
				{

                                 if($subType=="COMPRA") $sqlType="min(bid_mountxfac)";else $sqlType="max(bid_mountxfac)"; 
                                    $montoWin = admin::getDbValue("select ".$sqlType." from mdl_biditem where bid_xit_uid =". $content["bid_xit_uid"]." group by bid_xit_uid");
                                    if(!isset($montoWin)) $montoWin=0;
                                    $montoBase = admin::getDBvalue("SELECT xit_price from mdl_xitem where xit_uid=".$content["bid_xit_uid"]." and xit_delete=0");
				 ?>
            <tr>
				<td width="25%"><?=admin::getDBvalue("SELECT xit_description from mdl_xitem where xit_uid=".$content["bid_xit_uid"]." and xit_delete=0");?></td>
                                <td width="25%"><?=admin::numberFormat($montoBase)?></td>
                                <td width="25%"><?=admin::numberFormat($montoWin)?></td>
                                <td width="25%"><?php if(($subType=="COMPRA")) echo (admin::numberFormat($montoBase-$montoWin)); else echo(admin::numberFormat($montoWin-$montoBase))?></td>
            </tr>
             	<?php
				 }
				 ?>    
        </table>
                        <?php
                                }
                                ?>
<br />
<br />
<br />