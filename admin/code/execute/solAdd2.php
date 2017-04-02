<?php
include_once("../../core/admin.php");
admin::initialize('solicitud','solicitudAdd'); 
$tipUid=  admin::getParam("tipUid");
$token= admin::getParam("token");
$solUid =  admin::getParam("sol_uid");
$nivel1_uid =  admin::getParam("nivel1_uid");
$nivel2_uid =  admin::getParam("nivel2_uid");
$nivel3_uid =  admin::getParam("nivel3_uid");
$sol_description =  admin::getParam("sol_description");
$sol_cantidad =  admin::getParam("sol_cantidad");
$sol_unidad =  admin::getParam("sol_unidad");

$sSQL="insert into mdl_solicitud_material "
        . "( "
        . "som_sol_uid,"
        . "som_ca1_uid,"
        . "som_ca2_uid,"
        . "som_ca3_uid,"
        . "som_description,"
        . "som_cantidad,"
        . "som_unidad,"
        . "som_delete)"
        . " values ("
        . "$solUid,"
        . "$nivel1_uid,"
        . "$nivel2_uid,"
        . "$nivel3_uid,"
        . "'$sol_description',"
        . "$sol_cantidad,"
        . "'$sol_unidad',"
        . "0)";
//echo$sSQL; die;
$db->query($sSQL);


header('Location: ../../solicitudNew2.php?token='.$token."&sol_uid=".$solUid."&tipUid=".$tipUid);	
?>