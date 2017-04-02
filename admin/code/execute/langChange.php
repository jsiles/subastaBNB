<?php
include_once("../../core/admin.php");
admin::initialize('content','contentList',false); 

$_SESSION["LANG"] = $_POST["language"];
header('Location: ../../../..'.$_POST["origin"].'?token='.admin::getParam("token"));	
?>