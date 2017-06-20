<?php
include_once("../../core/admin.php");
admin::initialize('content','contentList',false); 

$_SESSION["LANG"] = admin::getParam("language");
header('Location: ../../../..'.admin::getParam("origin"));	
?>