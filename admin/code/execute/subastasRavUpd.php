<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../core/thumb.php");
admin::initialize('subastaRav','subastaRavUpd'); 
$token=admin::getParam("token");
$rav_uid = admin::getParam("rav_uid");
$rav_rol =admin::getParam("rav_rol");
$rav_monto =admin::getParam("rav_monto"); 
$rav_monto1 =admin::getParam("rav_monto1");
$rav_tipo =admin::getParam("rav_tipo");
$rav_status =(admin::getParam("rav_status")==1)?"ACTIVE":"INACTIVE";
$rav_moneda = admin::getParam("rav_moneda");
$rav_uni_uid =admin::getParam("rav_uni_uid", "strip");

    $sql="update mdl_rav set ".
         "rav_rol_uid= ". $rav_rol.
         ",rav_monto_inf= ". $rav_monto.
         ",rav_monto_sup= ". $rav_monto1.
         ",rav_status= '". $rav_status."'".
         ",rav_cur_uid= ". $rav_moneda.
         " where ".   
         " rav_uid=".$rav_uid;
   $db->query($sql);

   if(is_array($rav_uni_uid)){
       admin::getDbValue("delete from mdl_rav_access where raa_rav_uid=$rav_uid");
   foreach($rav_uni_uid as $value)
   {
       $sql="insert into mdl_rav_access (raa_rav_uid, raa_uni_uid) values($rav_uid, $value)";
      // echo $rav_tipo."#".$sql;
       $db->query($sql);
   }
   }
   //die;
header("Location: ../../subastasRavList.php?tipUid=".$rav_tipo);	
?>