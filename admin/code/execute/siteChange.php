<?php
include_once("../../core/admin.php");
admin::initialize('content','changesite'); 
$_SESSION["usr_site"]=admin::getParam("sities");
?>
<script language="javascript" type="text/javascript">
document.location.href='../../../..<?=admin::getParam("origin")?>';
</script>