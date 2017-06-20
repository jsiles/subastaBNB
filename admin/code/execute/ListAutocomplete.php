<?php
include_once("../../core/admin.php");
admin::initialize('subastas','subastasList');
$searchA = admin::getParam("searchA");
$sub_uid = admin::getParam("sub_uid");
if ($searchA)
{									
	$countList=admin::getDBvalue("SELECT distinct count(cli_uid)
										FROM mdl_client
										WHERE (cli_firstname  like ('".$searchA."%') 
										or cli_lastname like ('".$searchA."%'))
										and cli_uid not in (select inc_cli_uid as nombre from mdl_incoterm WHERE inc_sub_uid='".$sub_uid."' and inc_delete=0) and cli_delete=0 ");
	if ($countList>0)
	{									
		?>
		<ul id="listBox">
		<?php
		$sql = "SELECT distinct cli_uid,concat(cli_firstname ,' ',cli_lastname) as nombre, cli_uid FROM mdl_client WHERE (cli_firstname like ('".$searchA."%') or cli_lastname like ('".$searchA."%')) and cli_uid not in (select inc_cli_uid as nombre from mdl_incoterm WHERE inc_sub_uid='".$sub_uid."' and inc_delete=0) and cli_delete=0";
		$db->query($sql);
		while ($add_class = $db->next_record())
		{
			$cli_name=utf8_encode($add_class['nombre']);
		?>
			<li>
				  <a href=" " onclick="fill('<?=$cli_name;?>','<?=$add_class['cli_uid']?>'); return false;">
				  <span ><?=$cli_name;?></span>
				  </a>
			</li>
		<?php
		}
		?>
		</ul>
<?php
    }
    }
?>