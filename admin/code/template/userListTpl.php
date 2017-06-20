<?php
if ($lang!='es') $urlLangAux=$lang.'/';
else $urlLangAux='';

$autor = admin::toSql(admin::getParam("autor"),"Number");
if ($autor==0 && !$autor) $autor='';
else $autor=" and new_nec_uid=".$autor;

$order = admin::toSql(admin::getParam("order"),"Number");
if ($order==0) {$orderCode=' order by usr_uid desc'; $titClass='up'; $nameClass='up'; $dateClass='up';}
elseif ($order==1) {$orderCode='  order by usr_firstname asc'; $titClass='up'; $nameClass='up'; $dateClass='up';}
elseif ($order==2) {$orderCode='  order by usr_firstname desc'; $titClass='down'; $nameClass='up'; $dateClass='up';}
elseif ($order==3) {$orderCode='  order by usr_lastname asc'; $titClass='up'; $nameClass='up'; $dateClass='up';}
elseif ($order==4) {$orderCode='  order by usr_lastname desc'; $titClass='up'; $nameClass='down'; $dateClass='up';}
elseif ($order==5) {$orderCode='  order by rol_description asc'; $titClass='up'; $nameClass='up'; $dateClass='up';}
elseif ($order==6) {$orderCode='  order by rol_description desc'; $titClass='up'; $nameClass='up'; $dateClass='down';}

if ($titClass=='up') $titOrder=2;
else $titOrder=1;
if ($nameClass=='up') $nameOrder=4;
else $nameOrder=3;
if ($dateClass=='up') $dateOrder=6;
else $dateOrder=5;

$noRoot=" ";
$search = admin::toSql(admin::getParam("search"),"Text");

if (!$search || $search==''){
	$_pagi_sql= "select usr_uid,usr_lastname,usr_firstname,usr_status, usr_email,rol_description, usr_login, usr_pass, usr_photo from sys_users,mdl_roles, mdl_roles_users where rus_rol_uid=rol_uid and usr_delete=0 and rus_usr_uid=usr_uid ".$noRoot.$orderCode;
	//$nroReg=admin::getDBvalue("select count(usr_uid) from sys_users,mdl_roles, mdl_roles_users where rus_rol_uid=rol_uid and usr_delete=0 and rus_usr_uid=usr_uid ".$noRoot);
}
else{
	$_pagi_sql= "select usr_uid,usr_lastname,usr_firstname,usr_status, usr_email, rol_description, rol_description, usr_login, usr_pass, usr_photo from sys_users,mdl_roles, mdl_roles_users where rus_rol_uid=rol_uid and usr_delete=0 and rus_usr_uid=usr_uid and (usr_login like '%".$search."%' or usr_firstname like '%".$search."%' or usr_lastname like '%".$search."%' or usr_email like '%".$search."%' or usr_phone like '%".$search."%' or usr_cellular like '%".$search."%' or rol_description like '%".$search."%') ".$noRoot.$orderCode;
	//$nroReg=admin::getDBvalue("select count(usr_uid) from sys_users,mdl_roles, mdl_roles_users where rus_rol_uid=rol_uid and usr_delete=0 and rus_usr_uid=usr_uid and usr_login like '%".$search."%' or usr_firstname like '%".$search."%' or usr_lastname like '%".$search."%' or usr_email like '%".$search."%' or usr_phone like '%".$search."%' or usr_cellular like '%".$search."%' or rol_description like '%".$search."%') ".$noRoot);
}	

//echo $_pagi_sql;
//krumo($_SESSION);
$_pagi_cuantos = 20;//Elegí un número pequeño para que se generen varias páginas
//cantidad de enlaces que se mostrarán como máximo en la barra de navegación
$_pagi_nav_num_enlaces = 5;//Elegí un número pequeño para que se note el resultado
//Decidimos si queremos que se muesten los errores de mysql
$_pagi_mostrar_errores = false;//recomendado true sólo en tiempo de desarrollo.
$nroReg=$db->numrows($_pagi_sql);
//echo $nroReg;
include("core/paginator.inc.php");

if ($nroReg>0){
	?>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="85%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
      <td width="15%" height="40">
        <?php
        $moduleId=6;
        $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleId and mop_lab_category='Crear' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
            <a href="<?=admin::modulesLink('usersNew')?>"><?=admin::modulesLabels('usersNew')?></a>
        <?php
        }
        ?>
        &nbsp;     
      </td>
  </tr>
  <tr>
	<td width="90%" height="40"></td>
    <td>
        <div class="boxSearch">
        <form  method="post" name="frmbuySearch" action="userList.php" >
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
          <td>
            <input type="text" name="search" id="search" value="<?=$search?>" class="input7" />
          </td>
          <td>
          <input name="Buscar" id="Buscar" type="image" src="lib/buscar.png" />
           <input type="hidden" name="qfiltro" id="qfiltro" value="1"/>
           <input type="hidden" name="token" value="<?=admin::getParam("token")?>" />
          </td>
         </tr>
        </table>
         </form>
       </div>
   </td>
  </tr>
  <tr>
    <td colspan="2" width="100%">
  <table width="100%" border="0">
	<tr>
    	<td width="14%" class="list1a" style="color:#16652f">
         	<a href="userList.php?order=<?=$titOrder?><?=$searchURL?>" class="<?=$titClass;?>">
		 		<?=admin::labels('firstname');?>:
            </a>
        </td>
		<td width="14%" class="list1a" style="color:#16652f">
        	<a href="userList.php?order=<?=$nameOrder?><?=$searchURL?>" class="<?=$nameClass;?>">
				<?=admin::labels('lastname');?>:
            </a>
        </td>
		<td width="14%">
        	<a href="userList.php?order=<?=$dateOrder?><?=$searchURL?>" class="<?=$dateClass;?>">
				<?=admin::labels('user','userrol');?>:
            </a>
        </td>
        
        <td width="12%" style="color:#16652f">
        			
                                Correo electr&oacute;nico:
        </td>
        
        <td width="12%" style="color:#16652f">Usuario:</td>
        <td width="8%" style="color:#16652f">Imagen:</td>
        <td align="center" width="5%" height="5"></td>
   		<td align="center" width="5%" height="5"></td>
		<td align="center" width="5%" height="5"></td>
		<td align="center" width="5%" height="5"></td>
	</tr>
	</table>
</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
	<?php
	$i=1;
	while ($user_list = $pagDb->next_record()){
		$usr_uidA = $user_list["usr_uid"];
		$UserRol=$user_list["rol_description"];
		$usr_lastnameA = $user_list["usr_lastname"];
		$usr_firstnameA = $user_list["usr_firstname"];
                $usr_loginA = $user_list["usr_login"];
                $usr_passA = $user_list["usr_pass"];
		$usr_status = $user_list["usr_status"];
		$usr_email = $user_list["usr_email"];
                $usr_photoA =$user_list["usr_photo"];
		if ($usr_status=='ACTIVE') $labels_content='status_on';
		else $labels_content='status_off';
		if ($i%2==0) $class='row';
		else  $class='row0';
	
  	?> 
  	<div id="sub_<?=$usr_uidA?>" class="<?=$class?>">
<table class="list" width="100%" border="0">
	<tr><td width="14%"><?=$usr_firstnameA;?></td>
    <td width="14%"><?=$usr_lastnameA;?></td>
    <td width="14%"><?=$UserRol;?></td>
    <td width="12%"><?=$usr_email;?></td>
   
    <td width="12%"><?=$usr_loginA;?></td>
     <td width="8%">
    <?php if(strlen($usr_photoA)>0)
        {
            ?>
        
        <img src="<?=PATH_DOMAIN."/admin/upload/profile/thumb_".($usr_photoA)?>"  border="0">
<?php
        }
?>
    </td>
	<td align="center" width="5%" height="5">
            <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=5 and mop_lab_category='Ver' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){
            ?>
		   <a href="userView.php?usr_uidA=<?=$usr_uidA?>">
		<img src="lib/view_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">
		</a>
            <?php 
        }else{
        ?>
    	<img src="lib/view_off_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">
	     
       <?php
        }
            ?>
	</td>
	<td align="center" width="5%" height="5">
            <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=5 and mop_lab_category='Editar' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){
            ?>
		<a href="userEdit.php?usr_uidA=<?=$usr_uidA?>">
		<img src="lib/edit_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
		</a>
            <?php 
        }else{
        ?>
    	<img src="lib/edit_off_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
	     
       <?php
        }
            ?>
	</td>
	<td align="center" width="5%" height="5">
          <?php 
	if($_SESSION['usr_uid']==$usr_uidA){
	?>
		<img src="lib/delete_off_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
    <?php }
	else{?>
                
              <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=5 and mop_lab_category='Eliminar' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){
            ?>  
		<a href="" onclick="removeList(<?=$usr_uidA?>); return false;">
		<img src="lib/delete_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>
    <?php }
	else{?>
                <img src="lib/delete_off_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
              <?php
        }
    ?>            
                
    <?php } ?>
	</td>
	<td align="center" width="5%" height="5">
	<div id="status_<?=$usr_uidA?>">
    <?php 
	if($_SESSION['usr_uid']==$usr_uidA){
	$status = ($usr_status=='ACTIVE') ? 'active_off_es.gif':'inactive_off_es';
	?>
		<img src="lib/<?=$status?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
    <?php }
	else{?>
                
                  <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=5 and mop_lab_category='Estado' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){
            ?>
	   <a href=""  onclick="userCS('<?=$usr_uidA?>','<?=$usr_status?>'); return false;">
		<img src="<?=admin::labels($labels_content,'linkImage')?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
		</a>
              <?php }
	else{
            $status = ($usr_status=='ACTIVE') ? 'active_off_es.gif':'inactive_off_es.gif';
            ?>
             <img src="lib/<?=$status?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
        <?php
        
        }
        ?>
    <?php } ?>
	</div>
	</td>
		</tr>
	</table>
	</div>
	<?php
	$i++;
	}  ?>
    </td>
    </tr>
    <tr><td width="100%">
	<table border="0" width="100%">
			  <td colspan="3" align="right" class="txt10"><span class="txt11">
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
<?php 	} 
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
	No existen registros.
	</td></tr>	
 </table>
</div>
</td></tr></table>

<?php 	} ?>