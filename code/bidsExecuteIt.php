<?php
include_once("../admin/core/admin.php");

$monto_ofertado=admin::getParam("ofert");
//echo $monto_ofertado."#";//die;
$cli_uid=admin::getParam("cli_uid");
$sub_uid=admin::getParam("sub_uid");
$xit_uid=admin::getParam("uid");
$round=admin::getParam("round");
$pro_uid=admin::getDBvalue("SELECT pro_uid FROM mdl_product where pro_sub_uid='".$sub_uid."'");
$bidsCompra=admin::getDBvalue("SELECT sub_type FROM mdl_subasta where sub_uid='".$sub_uid."'");
if($bidsCompra=='COMPRA')
$valBids=admin::getDBvalue("SELECT MIN(bid_mountxfac) FROM mdl_biditem where bid_sub_uid='".$sub_uid."' and bid_xit_uid=$xit_uid");
else
$valBids=admin::getDBvalue("SELECT MAX(bid_mountxfac) FROM mdl_biditem where bid_sub_uid='".$sub_uid."' and bid_xit_uid=$xit_uid");

$mBase=admin::getDBvalue("SELECT xit_price FROM mdl_xitem where xit_sub_uid='".$sub_uid."' and xit_uid=$xit_uid");
$unidad=admin::getDBvalue("SELECT xit_unidad FROM mdl_xitem where xit_sub_uid='".$sub_uid."' and xit_uid=$xit_uid");
$sub_tiempo=admin::getDBvalue("SELECT sub_tiempo FROM mdl_subasta where sub_uid='".$sub_uid."'");

$factor = admin::getDbValue("select inc_ajuste from mdl_incoterm where inc_delete=0 and inc_cli_uid=".admin::getSession("uidClient")." and inc_sub_uid=".$sub_uid);
if(!$factor) $factor=0;
$orig_monto_ofertado =$monto_ofertado;
if($bidsCompra=='COMPRA')
$monto_ofertado = $monto_ofertado + ($monto_ofertado*$factor/100);
else
$monto_ofertado = $monto_ofertado - ($monto_ofertado*$factor/100);
//echo $valBids;
if(!$valBids) {
	$mayVal=$mBase; 
    $valBids=$mBase;
//echo $valBids."#".$bidsCompra;
}
if($bidsCompra=='COMPRA') $mayVal=$valBids+$unidad;
else $mayVal=$valBids-$unidad;
//echo $mayVal."#".$valBids."#".$bidsCompra."#".$monto_ofertado;

//if($bidsCompra=='COMPRA')
//{
	if(!$monto_ofertado) echo 'Introduzca una mejor oferta al monto m&iscute;nimo:'.$mayVal;
//	elseif(round($orig_monto_ofertado,2)>round($mayVal,2)) echo 'Su oferta ya fue superada, introduzca una mejor oferta al monto mínimo:'.$mayVal;
	else {
            
           	
		
		$sql = "insert into mdl_biditem( bid_sub_uid, bid_round, bid_cli_uid, bid_mount, bid_mountxfac, bid_date, bid_xit_uid,bid_flag0,bid_flag1)
						values	($sub_uid, $round,$cli_uid ,$orig_monto_ofertado, $monto_ofertado, GETDATE(),$xit_uid,0,0)";
                //echo $sql;//die;
		$db->query($sql);
		//$sql = "update mdl_subasta set sub_finish=1 where sub_uid=".$sub_uid;
		//$db->query($sql);
	//	echo '<form name="formBids" class="formLabel">Se acepto su oferta:'.$monto_ofertado.' '.date('d-m-Y H:i:s').'.<br><br> <p> <a href="Cerrar" onclick="$.facebox.close();return false;">Continuar</a></p></form><br>';
		echo 'Se acepto su oferta:'.$monto_ofertado.' fecha: '.date('d-m-Y H:i:s');	
	}
//}
/*else
{

	if(!$monto_ofertado) echo 'Introduzca una mejor oferta al monto m&iacute;nimo:'.$mayVal;
//	elseif(round($monto_ofertado,2)<round($mayVal,2)) echo 'Su oferta ya fue superada, introduzca una mejor oferta al monto mínimo:'.$mayVal;
	else {
		$maxUid=admin::getDBvalue("SELECT max(bid_uid) FROM mdl_biditem");
		if($maxUid == NULL) $maxUid=0;
		$maxUid++;
		$sql = "insert into mdl_biditem(bid_uid, bid_sub_uid, bid_round, bid_cli_uid, bid_mount, bid_mountxfac, bid_date, bid_xit_uid,bid_flag0,bid_flag1)
						values	($maxUid,$sub_uid, $round,$cli_uid,$monto_ofertado,GETDATE(),$xit_id,0,0)";
		$db->query($sql);
		//$sql = "update mdl_subasta set sub_finish=1 where sub_uid=".$sub_uid;
		//$db->query($sql);
		echo 'Se acepto su oferta:'.$monto_ofertado.' '.date('d-m-Y H:i:s');	
	}
}*/
?>