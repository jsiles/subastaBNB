<?php 
include_once("admin/core/path.php");
$sSQL = "delete from sys_session where ses_user_uid=" . $_SESSION["uidClient"];
$db->query($sSQL);
//echo $sSQL; die;
unset($_SESSION["uidClient"]);
unset($_COOKIE["state"]);
session_destroy(); 
$uidClient = $_GET["uidClient"];
if(isset($uidClient))
{
    $sSQL = "delete from sys_session where ses_user_uid=" . $uidClient;
    $db->query($sSQL);
}
@session_start();
session_regenerate_id(true);
header('Location: '.$domain);
?>
