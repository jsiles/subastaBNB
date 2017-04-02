<?php
/********BeginResetColorDelete*************/
$arrayscript = "<script>
var items =new Array();
";

if ($_SESSION["usr_uid"]!=1 && $_SESSION["usr_uid"]!=2)	$filtro_usr_uid = " and use_usr_uid>2";
else $filtro_usr_uid="";

/********EndResetColorDelete*************/
if ($_REQUEST["ordertype"]!="")	$ordertype = $_REQUEST["ordertype"];
else $ordertype="desc";
if ($_REQUEST["orderby"]!="") $orderby = $_REQUEST["orderby"];
else $orderby = 3;
if ($_REQUEST["keyword"]!="") $keyword=$_REQUEST["keyword"];
else $keyword="";

/*$pagDb=new DBmysql;
$pagDb->connect("$basedatos", "$host", "$user", "$pass");
 */	
if ($keyword!="") $filter2 = " and (use_name like('%" . $keyword . "%') or use_lastname like('%" . $keyword . "%'))";
else $filter2 = " ";

if ($orderby!="" && $ordertype!="")
	{				
	switch($orderby)
		{
		//Cantidad
		case 0: $order = "order by use_lastname ";break;
		case 1: $order = "order by use_city ";break;
		//Porcentaje minimo
		case 2: $order = "order by use_country ";break;
		//Fecha
		case 3: $order = "order by use_mail ";break;
		default: $order = " order by use_dateing ";
		}
	$order= $order . $ordertype;
	}
else
	$order = " ORDER BY use_dateing DESC ";

$nroReg=admin::getDBvalue("select count(use_uid) from mdl_users where use_delete<>1 ".$filtro_usr_uid.$filter2.$order);

$_pagi_sql="select *, DATE_FORMAT(use_dateing,'%Y-%m-%d') as dateingreso 
			from mdl_users 
			where use_delete<>1 " .$filtro_usr_uid . $filter2 . $order;
$_pagi_cuantos = 10;//Elegí un número pequeño para que se generen varias páginas
//cantidad de enlaces que se mostrarán como máximo en la barra de navegación
$_pagi_nav_num_enlaces = 5;//Elegí un número pequeño para que se note el resultado
//Decidimos si queremos que se muesten los errores de mysql
$_pagi_mostrar_errores = false;//recomendado true sólo en tiempo de desarrollo.
include("core/paginator.inc.php");


$sSQL= "select * 
		from mdl_users 
		where use_delete<>1 " . $filter2 . $order;
$db->query($sSQL);
$nroReg = $db->numrows();
if ($nroReg>0)
	{
	?>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="77%" height="40">
	  <div class="boxSearch">
		  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
			<input type="text" name="sim_search" id="sim_search" value="<?=$_REQUEST["keyword"]?>" class="input7" onkeyup="if (event.keyCode == 13) filter_search(document.getElementById('sim_search').value,'usersList.php');"/>
			
			</td>
            <td><input name="Buscar" type="image" id="Buscar" src="lib/buscar.png" onclick="filter_search(document.getElementById('sim_search').value,'usersList.php')" /></td>
          </tr>
        </table>
		</div>
	  <div class="left">
		<span class="title"><?=admin::labels('user')?></span>
		</div>
		</td>
  </tr>
  	<tr>
		<td height="6">		</td>
		</tr>
		
	<tr><td>
	<table border="0" width="100%">
			<tr><td width="66%" class="txt11">
			
			</td>			 
			  <td width="15%" class="txt11" align="right">&nbsp;</td>
			  <td width="19%" align="right" class="txt10"><span class="txt11">
			    <?php		   
				//Incluimos la barra de navegación
				if ($_pagi_totalReg==0) 
					{
					echo "<font face=arial></font>";
					}
					else
					{
					echo $_pagi_navegacion;
					//Incluimos la información de la página actual
					echo $_pagi_info;
					}		
				?>
			  </span>
			  </td>
			</tr>
			</table>
	</td></tr>
  <tr>
    <td colspan="2" id="contentListing">
	<div class="row" >
				<table class="list" width="100%">		
					<tr>
					<td width="20%">
					<?php 
					if ($ordertype=='desc' && $orderby==0)
						{
						$prodURL = "usersList.php?orderby=0&ordertype=asc";
						$classOrder = "down";
						}
					else
						{
						$prodURL = "usersList.php?orderby=0&ordertype=desc";
						$classOrder = "up";
						}
					?>
					<a href="<?=$prodURL?>" class="<?=$classOrder?>">Nombre</a>					
					</td>
					<td width="22%">
					<?php 
					if ($ordertype=='desc' && $orderby==3)
						{
						$prodURL = "usersList.php?orderby=3&ordertype=asc";
						$classOrder = "down";
						}
					else
						{
						$prodURL = "usersList.php?orderby=3&ordertype=desc";
						$classOrder = "up";
						}
					?>
					<a href="<?=$prodURL?>" class="<?=$classOrder?>">
					Correo electr&oacute;nico
					</a>
					</td>
					<td width="8%" align="left">
					<?php
					if ($ordertype=='desc' && $orderby==2)
						{
						$prodURL = "usersList.php?orderby=2&ordertype=asc";
						$classOrder = "down";
						}
					else
						{
						$prodURL = "usersList.php?orderby=2&ordertype=desc";
						$classOrder = "up";
						}
					?>
					<a href="<?=$prodURL?>" class="<?=$classOrder?>">Pa&iacute;s</a>
					</td>
					<td width="8%" align="left">
					<?php
					if ($ordertype=='desc' && $orderby==1)
						{
						$prodURL = "usersList.php?orderby=1&ordertype=asc";
						$classOrder = "down";
						}
					else
						{
						$prodURL = "usersList.php?orderby=1&ordertype=desc";
						$classOrder = "up";
						}
					?>
					<a href="<?=$prodURL?>" class="<?=$classOrder?>">Ciudad</a>
					</td>
					<td width="5%" >&nbsp;</td>
					<td width="5%" >&nbsp;</td>
					<td width="5%" >&nbsp;</td>
					<td width="5%" >&nbsp;</td>
					</tr>		
				</table>
				</div>
	<?php
$i=1;
$j=0;
$scriptChecked = '<script language="javascript" type="text/javascript">';
while ($user_list = $pagDb->next_record())
	{
	$use_uid = $user_list["use_uid"];
	$use_login = $user_list["use_login"];
	$use_fullname = $user_list["use_lastname"] . " " . $user_list["use_name"];
	$use_status = $user_list["use_status"];
	if ($use_status=='ACTIVE') $labels_content='status_on';
	else $labels_content='status_off';
	if ($i%2==0) 
		{
		$class='row';
		$backcolorclass = '#ffffff';
		}
	else  
		{
		$class='row0';
		$backcolorclass = '#f7f8f8';
		}
	if ($user_list["use_new"]=="1")
		{
		$scriptChecked .="Fat.fade_element('" . $use_uid . "', 10, 2000, '#fff8cc', '" . $backcolorclass . "');" . chr(13);
		$sql = "update mdl_users set use_new=0 where use_uid=" . $use_uid;
		$db2->query($sql);
		}
	/********BeginResetColorDelete*************/  
	$arrayscript .= "items[" . $j . "]=" . $use_uid . ";";
	/********EndResetColorDelete*************/  
  	?> 
  	<div class="<?=$class?>" id="<?=$use_uid?>">
<table class="list" width="100%">
	<tr>
	<td width="20%" align="left"><?=$use_fullname;?></td>
	<td width="22%" align="left"><?=$user_list["use_mail"]?></td>
	<td width="8%" align="left"><?=$user_list["use_country"]?></td>
	<td width="8%" align="left"><?=$user_list["use_city"]?></td>
	<td align="center" width="5%" height="5">
		   <a href="usersView.php?use_uid=<?=$use_uid?>">
		<img src="<?=admin::labels('view','linkImage')?>" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>"></a></td>
	<td align="center" width="5%" height="5">
		<a href="usersEdit.php?use_uid=<?=$use_uid?>">
		<img src="<?=admin::labels('edit','linkImage')?>" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">		</a>	</td>
	<td align="center" width="5%" height="5">
	
	<a href="removeList" onclick="removeList(<?=$use_uid?>);return false;">
		<img src="<?=admin::labels('delete','linkImage')?>" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>		
	</td>
	<td align="center" width="5%" height="5">
	<div id="status_<?=$use_uid?>">
	   <a href="javascript:usersCS('<?=$use_uid?>','<?=$use_status?>');">
		<img src="<?=admin::labels($labels_content,'linkImage')?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">		</a>	</div>	</td>
		</tr>
	</table>
	</div>
	<?php
	$i++;
	$j++;
	}
	$scriptChecked.="</script>";
	echo $scriptChecked;
	?>
	
    </td>
    </tr>
	<tr><td>
	<table border="0" width="100%">
			<tr><td width="66%" class="txt11">
			
			</td>			 
			  <td width="15%" class="txt11" align="right">&nbsp;</td>
			  <td width="19%" align="right" class="txt10"><span class="txt11">
			    <?php		   
				//Incluimos la barra de navegación
				if ($_pagi_totalReg==0) 
					{
					echo "<font face=arial></font>";
					}
					else
					{
					echo $_pagi_navegacion;
					//Incluimos la información de la página actual
					echo $_pagi_info;
					}		
				?>
			  </span></td>
			</tr>
			</table>
	</td></tr>
</table><br />
<br />
<br />
<?php

/********BeginResetColorDelete*************/    
$arrayscript .= "
function resetOrderRemove(uid)
	{
	var nvector = new Array();
	j=0;
	for (i=0;i<items.length;i++)
		{
		if (items[i]!=uid)
			{
			nvector[j]= items[i]; 
			j++; 
			}
		 }
	 for (i=0;i<nvector.length;i++)
		{
		if (i%2!=0) document.getElementById(nvector[i]).className='row';
		else document.getElementById(nvector[i]).className='row0';
		}
	items=nvector;
	}
</script>\n";
echo $arrayscript;
/********EndResetColorDelete*************/

 	} 
else
	{ ?>
	<br />
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">   
  <tr>
    <td colspan="2" id="contentListing">
<div  style="background-color: #f7f8f8;">
<table class="list"  width="100%">
	<tr><td height="30px" align="center" class="bold">
	<?=admin::labels('nousers')?>
	</td></tr>	
 </table>
</div>
</td></tr></table>

<?php 	} ?>