<?php
include_once("./core/admin.php");
admin::initialize('subastas','subastasList');
$sub_uid=admin::getParam("subasta");
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=pujas_de_subasta.xls");
header("Pragma: no-cache");
header("Expires: 0");
$PrintTable='<table border="1" >
          <tr>
            <td colspan="2" class="titleBox">Listado de ofertas:</td>
            <td></td>
          </tr>
             <tr>
				<td >Nombre de usuario:</td>
				<td >Fecha y hora:</td>
                <td >Monto:</td>
			</tr>';         

				$sql2 = "SELECT * FROM mdl_bid where bid_sub_uid='".$sub_uid."'";
				$db2->query($sql2);
				while ($content=$db2->next_record())
				{
				 $clientName=admin::getDBvalue("SELECT cli_socialreason FROM mdl_client where cli_uid='".$content["bid_cli_uid"]."'");
				$PrintTable.='
                <tr>
				<td >'.$clientName.'</td>
				<td >'.$content["bid_date"].'</td>
                <td >'.$content["bid_mount"].'</td></tr>';
				 }
      $PrintTable.='</table>';
echo $PrintTable;
?>