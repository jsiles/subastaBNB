<?php
include_once("../../core/admin.php");
//admin::initialize('autorizacion','autorizacionList',false);
$sol_uid = $_POST["uid"];
$sql = "update mdl_solicitud_compra set sol_estado=1, sol_status='ACTIVE', sol_apr_uid=".admin::getSession("usr_uid").", sol_apr_date=GETDATE() where sol_uid=".$sol_uid;
//admin::doLog($sql);
$db->query($sql);
/*
 * Mandar solicitudes a los proveedores
 */
/*$sSQL="select sop_cli_uid from mdl_solicitud_proveedor where sop_sol_uid=$sol_uid";
$nroReg=$db->numrows($sSQL);
if($nroReg>0){
    $db->query($sSQL);
    while($list=$db->next_record())
    {
        $cli_uid=$list["sop_cli_uid"];
        $cli_email=admin::getDbValue("select cli_mainemail from mdl_client where cli_uid=$cli_uid");
        $nti_uid=1;
        $attach="/docs/subasta/".admin::getDbValue("select sol_doc from mdl_solicitud_compra where sol_uid=$sol_uid");
        admin::insertMail($cli_uid, $nti_uid, $attach, $cli_email, $sol_uid);
    }
}*/
?>