<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../core/thumb.php");
admin::initialize('subastaRav','subastaRavAdd'); 
$token=admin::getParam("token");
$rav_uid = admin::getDbValue("select max(rav_uid) from mdl_rav");
if(!$rav_uid) $rav_uid=0;
$rav_uid++;
$rav_rol =admin::getParam("rav_rol");
$rav_monto =admin::getParam("rav_monto"); 
$rav_monto1 =admin::getParam("rav_monto1");
$rav_uni_uid =admin::getParam("rav_uni_uid");
$rav_tipo =admin::getParam("rav_tipo");
$rav_status =(admin::getParam("rav_status")==1)?'ACTIVE':'INACTIVE';
$rav_moneda = admin::getParam("rav_moneda");

//print_r($rav_uid);

    $sql="insert into mdl_rav (rav_uid,rav_rol_uid, rav_monto_inf, rav_monto_sup, rav_tipologia, rav_cur_uid, rav_delete, rav_status)"
            . " values ($rav_uid,$rav_rol,$rav_monto,$rav_monto1, $rav_tipo, $rav_moneda, 0, '$rav_status') ";
    //echo $sql;die;
   $db->query($sql);
   $valRavUID=admin::getDbValue("select count(*) from mdl_rav where rav_uid=$rav_uid");
   if($valRavUID>0){
   if(is_array($rav_uni_uid)){
       admin::getDbValue("delete from mdl_rav_access where raa_rav_uid=$rav_uid");   
   foreach($rav_uni_uid as $value)
   {
       $sql="insert into mdl_rav_access (raa_rav_uid, raa_uni_uid) values($rav_uid, $value)";
       //echo $sql;
       $db->query($sql);
   }//die;
  }
   }
//die;
header("Location: ../../subastasRavList.php?tipUid=$rav_tipo&token=$token");	    
?>