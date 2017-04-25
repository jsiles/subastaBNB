<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../core/thumb.php");
admin::initialize('solicitud','solicitudAdd'); 
$tipUid=  admin::getParam("tipUid");
$token= admin::getParam("token");
$solObservaciones=  admin::getParam("sol_observaciones");
$rav_uni_uid =admin::getParam("rav_uni_uid");
$cli_uid =  admin::getParam("sol_cli_uid");
//print_r($cli_uid);die;
$sol_status =  admin::getParam("sol_status");
$sol_monto =  admin::getParam("sol_monto");
$sol_moneda =  admin::getParam("sol_moneda");
$solUid =  admin::getDbValue("select max(sol_uid) from mdl_solicitud_compra");
if($solUid=='NULL') $solUid=0;
$solUid++;
$mythumb = new thumb(); 
$sql = "insert into mdl_solicitud_compra
                                 (
                                 sol_uid,
                                 sol_date,
                                 sol_usu_uid,
                                 sol_monto,
                                 sol_moneda,
                                 sol_observaciones,
                                 sol_doc,
                                 sol_apr_uid,
                                 sol_apr_date,
                                 sol_imp_date,
                                 sol_estado,
                                 sol_status,
                                 sol_delete
					)
			values	(
                                 $solUid,
                                 GETDATE(),
                                 ".admin::getSession("usr_uid").",
                                 $sol_monto,
                                 $sol_moneda,
                                 '$solObservaciones',
                                 '',
                                 0,
                                 GETDATE(),
                                 GETDATE(),
                                 0,
                                 '$sol_status',
                                 0
				)";
//echo $sql;//die;
	$db->query($sql);

        
$FILES2 = $_FILES ['sol_document'];
if ($FILES2["name"] != '')
	{
	$ext = admin::getExtension($FILES2 ["name"]);
	$nomDOC = "sol_".$solUid.".".$ext;	
	classfile::uploadFile($FILES2,PATH_ROOT.'/docs/subasta/',$nomDOC);	
	$sql = "UPDATE mdl_solicitud_compra SET sol_doc='".$nomDOC."' WHERE sol_uid=$solUid";
	$db->query($sql);
	}
//if(is_array($rav_uni_uid)){
       admin::getDbValue("delete from mdl_solicitud_unidad where sou_sol_uid=$solUid");
//   foreach($rav_uni_uid as $value)
//   {
       $sql="insert into mdl_solicitud_unidad (sou_sol_uid, sou_uni_uid) values($solUid, $rav_uni_uid)";
       $db->query($sql);
//   }
//}
//print_r($cli_uid);
if(is_array($cli_uid)){
       admin::getDbValue("delete from mdl_solicitud_proveedor where sop_sol_uid=$solUid");
   foreach($cli_uid as $value)
   {
       $sql="insert into mdl_solicitud_proveedor (sop_sol_uid, sop_cli_uid, sop_date, sop_delete) values($solUid, $value, GETDATE(), 0)";
       $db->query($sql);
   }
}
//die;
header('Location: ../../solicitudNew2.php?token='.$token."&sol_uid=".$solUid."&tipUid=".$tipUid);	
?>