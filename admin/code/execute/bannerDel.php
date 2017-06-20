<?php  
include_once("../../core/admin.php");
admin::initialize('banner','bannerList',false);
$mbc_uid = $_REQUEST["uid"];
$sql = "update mdl_banners_contents set mbc_delete=1 where mbc_ban_uid=".$mbc_uid;
$db->query($sql);
?>