<?php
include_once("../../core/admin.php");
admin::initialize('content','changesite'); 
$_SESSION["usr_site"]=$_POST["sities"];
?>
<script language="javascript" type="text/javascript">
document.location.href='../../../..<?=$_POST["origin"]?>';
</script>