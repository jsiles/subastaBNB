<?php
/*include_once("../../core/admin.php");
include_once("../../core/safeHtml.php");
include_once("../../core/files.php");
include_once("../../core/images.php");*/
admin::initialize('content','contentList',false);

$sqlTpl = "SELECT * FROM mdl_product, mdl_subasta, mdl_pro_category WHERE sub_uid=pro_sub_uid and pca_uid=sub_pca_uid and sub_uid='".$uidTpl."'";
$db->query($sqlTpl);
$prodTpl = $db->next_record();


          if($prodTpl["sub_modalidad"]=="TIEMPO"){
		 $countBids=admin::getDBvalue("SELECT count(*) FROM mdl_bid where bid_sub_uid='".$prodTpl["sub_uid"]."' and bid_cli_uid!=0");
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
				<td width="40%" class="txt11 color2">Nombre de usuario:</td>
				<td width="30%" class="txt11 color2">Fecha y hora:</td>
                <td width="30%" class="txt11 color2">Monto:</td>
                <td width="30%" class="txt11 color2">Monto coon factor de ajuste:</td>
			</tr>         
               
                 <?php
				$sql2 = "SELECT * FROM mdl_bid where bid_sub_uid='".$prod["sub_uid"]."' and bid_cli_uid!=0";
				$db2->query($sql2);
				while ($content=$db2->next_record())
				{
				 $clientName=admin::getDBvalue("SELECT cli_socialreason FROM mdl_client where cli_uid='".$content["bid_cli_uid"]."'");
				 ?><tr>
				<td width="40%"><?=$clientName?></td>
				<td width="30%"><?=$content["bid_date"]?></td>
                <td width="30%"><?=$content["bid_mount"]?></td>
                <td width="30%"><?=$content["bid_mountxfac"]?></td>
                                 </tr>
             	<?php
				 }
				 ?>    
        </table>
         <?php
                 }
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
				<td width="25%" class="txt11 color2">Nombre de usuario:</td>
				<td width="25%" class="txt11 color2">Fecha y hora:</td>
                                <td width="25%" class="txt11 color2">Monto:</td>
                                <td width="25%" class="txt11 color2">Monto con factor de ajuste:</td>
                                <td width="25%" class="txt11 color2">Item:</td>
                                <td width="25%" class="txt11 color2">Especificaci&oacute;n T&eacute;cnica:</td>
                                
			</tr>         
               
                 <?php
				$sql2 = "SELECT * FROM mdl_biditem where bid_sub_uid='".$prod["sub_uid"]."' and bid_cli_uid!=0";
				$db2->query($sql2);
				while ($content=$db2->next_record())
				{
				 $clientName=admin::getDBvalue("SELECT cli_socialreason FROM mdl_client where cli_uid='".$content["bid_cli_uid"]."'");
				 ?><tr>
				<td width="25%"><?=$clientName?></td>
				<td width="25%"><?=$content["bid_date"]?></td>
                                <td width="25%"><?=$content["bid_mount"]?></td>
                                <td width="25%"><?=$content["bid_mountxfac"]?></td>
                                <td width="25%"><?=admin::getDBvalue("SELECT xit_description from mdl_xitem where xit_uid=".$content["bid_xit_uid"]." and xit_delete=0");?></td>
                                <td width="25%"><?php
                                if(file_exists(PATH_ROOT."/docs/subasta/".$content["bid_doc"])){
                                    
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