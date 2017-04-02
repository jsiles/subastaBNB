<?php
include_once("../../core/admin.php");
//admin::initialize('autorizacion','autorizacionList',false);
$uid = $_POST["uid"];
$sql = "update mdl_orden_compra set orc_estado=1, orc_status='ACTIVE', orc_aprusr_uid=".admin::getSession("usr_uid").",orc_apr_datetime=GETDATE() where orc_uid=".$uid;
$db->query($sql);
/*
 * Mandar orden compra a los proveedores
 */
$sSQL="select orc_nro_oc, orc_cli_uid, orc_document  from mdl_orden_compra where orc_uid=$uid";
$db->query($sSQL);
$list=$db->next_record();
if(is_array($list)){
        $cli_uid=$list["orc_cli_uid"];
        $cli_email=admin::getDbValue("select cli_mainemail from mdl_client where cli_uid=$cli_uid");
        $nti_uid=2;
        $nro_oc=$list["orc_nro_oc"];
        $attach="/admin/upload/oc/".$list["orc_document"];
        //if (strlen($attach)>0)
         admin::insertMail($cli_uid, $nti_uid, $attach, $cli_email, 'NULL','NULL',$nro_oc);
}
?>