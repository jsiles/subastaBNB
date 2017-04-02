<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('users','usersNew2'); 

// OBTENEMOS LA ULTIMA POSICION EN LA CUAL SERA COLOCADA LA CATEGORIA
$position = admin::getDBvalue("select MAX(job_uid) from mdl_jobs");
$position = $position+1;

$category=admin::getParam("category");

// REGISTRAMOS LA CATEGORIA
// dca_uid, dca_delete, 
$sql = "insert into mdl_jobs( job_uid, job_category, job_delete, job_status)
					values	(".$position.",'".$category."',0,'ACTIVE')";
$db->query($sql);

// CONSTRUIMOS EL NUEVO SELECT	
?>
<select name="usr_category" class="txt10" id="usr_category" onchange="Doc(); return false;">
				<option value="0" selected="selected">Seleccionar</option>
				<?
				$sSQL= "SELECT distinct job_category, job_uid FROM mdl_jobs";
				$db2->query($sSQL);
				while ($job = $db2->next_record())
				{
				?>            
            	<option value="<?=$job['job_uid']?>"><?=$job['job_category']?></option>
				<?
				}
				?>            
            </select>
			<a href="" onclick="changeOtherCategory(); return false;" class="link2">AGREGAR</a>	</div>