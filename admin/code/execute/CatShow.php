<table width="100%" border="0" cellpadding="5" class="box"><?
include_once("../../database/connection.php");  
include_once("../../core/admin.php");
admin::initialize('users','usersNew2'); 

$job_category=admin::getParam("job_category");
// CONSTRUIMOS EL NUEVO SELECT	
$sSQL= "SELECT distinct job_subcategory FROM mdl_jobs where job_category='".utf8_decode($job_category)."'";
//echo $sSQL;
$db2->query($sSQL);
while ($job = $db2->next_record())
{
	if ($job['job_subcategory'])
	{
	?>            
            <tr>
            	<td width="16%"><?=utf8_encode($job['job_subcategory'])?></td>
                <td width="84%"><input name="<?=utf8_encode($job['job_subcategory'])?>" type="text" class="input" id="<?=utf8_encode($job['job_subcategory'])?>" onfocus="setClassInput(this,'ON');document.getElementById('div_<?=utf8_encode($job['job_subcategory'])?>').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_<?=utf8_encode($job['job_subcategory'])?>').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_<?=utf8_encode($job['job_subcategory'])?>').style.display='none';" size="40" />
<br /><span id="div_<?=utf8_encode($job['job_subcategory'])?>" style="display:none;" class="error"><?=admin::labels('users','passreq');?></span> </td>
           </tr>
<?
	}
}
?>       
</table>     