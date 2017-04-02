<?php
include_once("../../core/admin.php");
admin::initialize('users','usersNew',false);
$mcl_uid = $_POST["uid"];
$sql = "update mdl_client set cli_delete=1 where cli_uid=".$mcl_uid;
$db->query($sql);
?>