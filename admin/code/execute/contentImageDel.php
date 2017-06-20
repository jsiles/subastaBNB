<?php
include_once("../../core/admin.php");
admin::initialize('product','productEdit',false);
$con_uid = admin::getParam("uid");
$sql="update mdl_contents_languages set col_image='' where col_con_uid='".$con_uid."'";
$db->query($sql);
?>
