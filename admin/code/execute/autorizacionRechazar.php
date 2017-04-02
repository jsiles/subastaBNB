<?php
include_once("../../core/admin.php");
//admin::initialize('autorizacion','autorizacionList',false);
$sub_uid = $_POST["uid"];
$sql = "update mdl_subasta set sub_finish=6 where sub_uid=".$sub_uid;
$db->query($sql);
$usr_uid = admin::getSession("usr_uid");
$sql = "insert into mdl_subasta_aprobar "
        . "( sup_sub_uid, sup_user_uid, sup_date, sup_status)"
        . "values"
        . "( $sub_uid, $usr_uid, GETDATE(), 'INACTIVE')";
//echo $sql;die;
$db->query($sql);
        
?>