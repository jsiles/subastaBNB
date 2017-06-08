<?php
include_once("../admin/core/admin.php");
$deadTime = admin::getParam("deadTime");
$year = substr($deadTime,0,4);
$month = substr($deadTime,5,2);
$day = substr($deadTime,8,2);
$hora = substr($deadTime,11,2);
$minuto = substr($deadTime,14,2);
$segundo = substr($deadTime,17,2);
$timeSubasta = admin::getParam("timeSubasta");
$deadTime1 = date("Y-m-d H:i:s", mktime($hora,$minuto+$timeSubasta
,$segundo, $month, $day, $year));
$sub_uid = admin::getParam("sub_uid");
$pro_uid=admin::getDBvalue("SELECT pro_uid FROM mdl_product where pro_sub_uid=$sub_uid");
$catUid=admin::getDBvalue("SELECT sub_pca_uid FROM mdl_subasta where sub_uid=$sub_uid");

$unidadMejora=admin::getDBvalue("SELECT sub_mount_unidad FROM mdl_subasta where sub_uid=$sub_uid");

$bidsCompra=admin::getDBvalue("SELECT sub_type FROM mdl_subasta where sub_uid=$sub_uid");
									if($bidsCompra=='COMPRA') 
									$valBids=admin::getDBvalue("SELECT min(bid_mountxfac) FROM mdl_bid where bid_pro_uid=$pro_uid and bid_cli_uid!=0");
									else
									$valBids=admin::getDBvalue("SELECT max(bid_mountxfac) FROM mdl_bid where bid_pro_uid=$pro_uid and bid_cli_uid!=0");

	
									if(!$valBids) 
								    {
																	$valBids=$details["sub_mount_base"];
										}
//$sql="insert into mdl_bid values(null, $sub_uid, $pro_uid, 0, $valBids, '".$deadTime."',$catUid)";

$cantBids=admin::getDbValue("select count(*) from mdl_bid where bid_sub_uid=$sub_uid and bid_mount=$valBids and bid_cli_uid!=0");
$valBids -= $unidadMejora; 

if($cantBids>1)
{
	$sql="update mdl_subasta set sub_deadtime='".$deadTime1."' where sub_uid=$sub_uid";
	//echo $deadTime."#".$year."#".$month."#".$day."#".$hora."#".$minuto."#".$segundo."#".$deadTime1;
	$db->query($sql);
	$sql="insert into mdl_bid values(null, $sub_uid, $pro_uid, 0, $valBids, $valBids, '".$deadTime."',$catUid)";
	}
else
{
	$sql="update mdl_subasta set sub_finish=1 where sub_uid=$sub_uid";
	echo 1;
}
$db->query($sql);


//echo $sql;
?>