<?php
include_once("../../core/admin.php");
//admin::initialize('autorizacion','autorizacionList',false);
$sub_uid = $_POST["uid"];
$sql = "update mdl_subasta set sub_finish=1 where sub_uid=".$sub_uid;
$db->query($sql);
$usr_uid = admin::getSession("usr_uid");
admin::getDbValue("delete from mdl_subasta_aprobar where sup_sub_uid=$sub_uid");
$sql = "insert into mdl_subasta_aprobar "
        . "( sup_sub_uid, sup_user_uid, sup_date, sup_status)"
        . "values"
        . "( $sub_uid, $usr_uid, GETDATE(), 'ACTIVE')";
//echo $sql;die;
$db->query($sql);
$sSQL="select inc_cli_uid from mdl_incoterm where inc_sub_uid=$sub_uid";
$nroReg=$db->numrows($sSQL);
//echo $nroReg;
if($nroReg>0){
    $db->query($sSQL);
    while($list=$db->next_record())
    {
        $cli_uid=$list["inc_cli_uid"];
        $cli_email=admin::getDbValue("select cli_mainemail from mdl_client where cli_uid=$cli_uid");
        $nti_uid=1;
        $attach =admin::getDbValue("select pro_document from mdl_product where pro_sub_uid=$sub_uid");
        if(strlen($attach)>0) $attach="/docs/subasta/".$attach;
        else $attach="";
        admin::insertMail($cli_uid, $nti_uid, $attach, $cli_email, $sub_uid);
        $cli_email=admin::getDbValue("select cli_commercialemail from mdl_client where cli_uid=$cli_uid");
        if(strlen($cli_email)>0){
            admin::insertMail($cli_uid, $nti_uid, $attach, $cli_email, $sub_uid);
        }
    }
}
echo 'OK';
?>