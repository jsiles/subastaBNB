// JavaScript Document
// ********************** MODULO DE BOLETINES	
function checkgroup(id)
	{
	var nrousers = document.getElementById('users_' + id).value;
	var groupcheck = document.getElementById('group_' + id).checked;
	var check=false;
	if (groupcheck)
		check=true;
	for (i=1;i<=nrousers;i++)
		{
		document.getElementById('usu_' + id + '_' + i).checked=check;
		}	
	}
function moreMinusUserL(ID)
	{
	if (document.getElementById('div_more_'+ID).style.display=='')
		{
		document.getElementById('div_minus_'+ID).style.display='';
		document.getElementById('div_more_'+ID).style.display='none';
        $('#subList_'+ID).fadeIn(500);
        }
	else
		{
		document.getElementById('div_more_'+ID).style.display='';
		document.getElementById('div_minus_'+ID).style.display='none';
        $('#subList_'+ID).fadeOut(500);
        }
	//Effect.toggle('subList_'+ID,'appear', { duration: 0.5 });
	//return false;
	}
function valitateBulletin1()
	{
	var bulletinOK = true;
	document.getElementById('div_bul_subject').style.display='none';

	if (document.getElementById("bul_subject").value=='')
		{
		document.getElementById('bul_subject').className='inputError';
		document.getElementById('div_bul_subject').style.display='';
		bulletinOK=false;
		}
	return bulletinOK;
	}
function validateNote()
	{
	var bulletinOK = true;
	document.getElementById('div_bun_title').style.display='none';
	document.getElementById('div_bun_descriptionl').style.display='none';
	if (document.getElementById('bun_title').value=='')
		{
		document.getElementById('bun_title').className='inputError';
		document.getElementById('div_bun_title').style.display='';
		bulletinOK=false;
		}		
	if (document.getElementById('bun_descriptionl').value=='')
		{
		document.getElementById('div_bun_descriptionl').style.display='';
		bulletinOK=false;
		}
	return bulletinOK;
	}
function editNote(uid,bul_uid)
	{
	var div_edit = document.getElementById('div_edit');
	var div_wait = document.getElementById('div_wait');
	div_edit.innerHTML=div_wait.innerHTML;
	ajax = objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/bulletinNoteEdit.php",true);		
	//instanciamos el objetoAjax
	ajax.onreadystatechange=function() {
									  	if (ajax.readyState==4) { 
									  		//mostrar resultados en esta capa
											div_edit.innerHTML=ajax.responseText;
											}
										}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send('uid='+uid+'&bul_uid=' + bul_uid)
	}
function addNote()
	{
	var verify = validateNote();
	if (verify==true)
		{
		document.frmBulletin2.action='code/execute/bulletinAdd2.php';
		document.frmBulletin2.submit();		
		}		
	}
function updNote()
	{
	var verify = validateNote();
	if (verify==true)
		{
		document.frmBulletin2.action='code/execute/bulletinUpd2.php';
		document.frmBulletin2.submit();
		}
	}
function regBulletinUser(uid)
	{
	var verify=true;
	
	document.getElementById('use_firstname').className='input3';
	document.getElementById('use_mail').className='input3';
//	document.getElementById('use_gru_uid') 
	if (document.getElementById('use_firstname').value=="")
		{
		document.getElementById('div_use_firstname').style.display='';
		document.getElementById('use_firstname').className='input3Error';
		verify=false;
		}
	if (document.getElementById('use_mail').value=="")
		{
		document.getElementById('div_use_mail').style.display='';
		document.getElementById('use_mail').className='input3Error';
		verify=false;
		}	
		
	if (verify)
		{
		document.frmBulletin3.action='code/execute/bulletinUserAdd.php?uid='+uid;
		document.frmBulletin3.submit();
		}	
	}
function regBulletinGroup(uid)
	{
	var verify=true;
	document.getElementById('div_gru_name').style.display='none';
	document.getElementById('gru_name').className='input3';
	if (document.getElementById('gru_name').value=="")
		{
		document.getElementById('div_gru_name').style.display='';
		document.getElementById('gru_name').className='input3Error';
		verify=false;
		}
	if (verify)
		{
		document.frmBulletin3.action='code/execute/bulletinGroupAdd.php?uid='+uid;
		document.frmBulletin3.submit();
		}
	}
function moregroups()
	{
	var div_users = document.getElementById('div_user_new');
	var div_groups = document.getElementById('div_group_new');
	if (div_groups.style.display=="block" || div_groups.style.display=="")
		$('#div_group_new').fadeOut(500);
	else
		{		
		if (div_users.style.display=="block" || div_users.style.display=="")
			$('#div_user_new').fadeOut(500);
        $('#div_group_new').fadeIn(500);
		}
	}
function moreusers()
	{
	var div_users = document.getElementById('div_user_new');
	var div_groups = document.getElementById('div_group_new');
	if (div_users.style.display=="block" || div_users.style.display=="")
        $('#div_user_new').fadeOut(500);		
	else
		{ 
		if (div_groups.style.display=="block" || div_groups.style.display=="")
			$('#div_group_new').fadeOut(500);	
		$('#div_user_new').fadeIn(500);
		}
	}

function sendTest(uid)
	{
	var mailtest = document.getElementById('bul_test_mail');	
	document.getElementById('div_bul_test_mail').style.display='none';
	if (mailtest.value!="")
		{
		var divsend = document.getElementById('div_wait_send');
		var divload = document.getElementById('div_wait_load');
		// Mostrando mensaje de espera
		divsend.innerHTML = divload.innerHTML;
		//instanciamos el objetoAjax
		ajax=objectAjax();
		//uso del medotod POST
		
		ajax.open("POST", "code/execute/bulletinTest.php",true);
		ajax.onreadystatechange=function() {
											if (ajax.readyState==4)
												{
												//mostrar resultados en esta capa
												divsend.innerHTML=ajax.responseText;
												}
											}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("bul_uid="+uid+"&mailtest="+mailtest.value)	
		}
	else
		{
		document.getElementById('bul_test_mail').className='inputError';
		document.getElementById('div_bul_test_mail').style.display='';
		}
	}	
function save_send_bulletin(option)
	{
	document.getElementById('bul_option').value=option;
	document.frmBulletin3.submit();
	}	
// ********************** FIN MODULO BOLETINES	