<?php
include_once("../../core/admin.php");
admin::initialize('informe','informeList',false);
//@session_start();
$sub_uid = admin::getParam("uid");

$sql = "update mdl_subasta set sub_finish=4 where sub_uid=".$sub_uid;
$db->query($sql);

$sql = "update mdl_subasta_informe set sua_usr_apr=".admin::getSession("usr_uid").", sua_dateApr=GETDATE() where sua_sub_uid=".$sub_uid;

//echo $sql;die;
$db->query($sql);
/*
 * Mandar agradecimiento a los proveedores
 */
$sSQL="select inc_cli_uid from mdl_incoterm where inc_sub_uid=$sub_uid";
$nroReg=$db->numrows($sSQL);
if($nroReg>0){
    //admin::doLog($nroReg);
    $db->query($sSQL);
    while($list=$db->next_record())
    {
        $cli_uid=$list["inc_cli_uid"];
        $cli_email=admin::getDbValue("select cli_mainemail from mdl_client where cli_uid=$cli_uid");
        $nti_uid=3;
        $attach=admin::getDbValue("select pro_document from mdl_product where pro_sub_uid=$sub_uid");
        if(strlen($attach)>0)  $attach="/docs/subasta/".$attach;
        else $attach="";

        
        admin::insertMail($cli_uid, $nti_uid, $attach, $cli_email);
        
        $cli_email=admin::getDbValue("select cli_commercialemail from mdl_client where cli_uid=$cli_uid");
        if(strlen($cli_email)>0){
            admin::insertMail($cli_uid, $nti_uid, $attach, $cli_email);
        }
    }
}        
?>