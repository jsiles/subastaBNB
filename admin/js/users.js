// JavaScript Document
function verifyUsers()
	{
	sw=true;
	document.getElementById('div_usr_email').style.display='none';
	document.getElementById('div_usr_pass').style.display='none';
	document.getElementById('div_usr_login').style.display='none';
	
        if (document.getElementById('usr_login').value==''){
		document.getElementById('usr_login').className='inputError';
		document.getElementById('div_usr_login').style.display='';
		sw=false;
                }
	
		var pass = document.getElementById('usr_pass').value;
                if (pass.length<8){
                    document.getElementById('usr_pass').className='inputError';
                    document.getElementById('div_usr_pass').innerHTML="Cantidad de caracteres minimo es de 8"
			document.getElementById('div_usr_pass').style.display='';
			sw=false;
		} 
       	if (document.getElementById('usr_pass').value==''){
			document.getElementById('usr_pass').className='inputError';
			document.getElementById('div_usr_pass').style.display='';
			sw=false;
		}
        
	if (document.getElementById('usr_email').value==''){
		document.getElementById('usr_email').className='inputError';
		document.getElementById('div_usr_email').style.display='';
		sw=false;
	}
	
	if (sw){
		document.frmUsers.submit();
	}
	else{
		scroll(0,0);
	}
}
function verifyUsersEdit()
	{
	sw=true;

	document.getElementById('div_usr_pass').style.display='none';
	
		
	if(document.getElementById('pass_edit').style.display!='none'){
           	if (document.getElementById('usr_pass').value==''){
			document.getElementById('usr_pass').className='inputError';
			document.getElementById('div_usr_pass').style.display='';
			sw=false;
		}
                var pass = document.getElementById('usr_pass').value;
                if (pass.length<8){
                    document.getElementById('usr_pass').className='inputError';
                    document.getElementById('div_usr_pass').innerHTML="Cantidad de caracteres minimo es de 8"
			document.getElementById('div_usr_pass').style.display='';
			sw=false;
		}         
            }
       
	if (sw){
		document.frmUsers.submit();
	}
	else{
		scroll(0,0);
	}
}

function verifyUsers2()
	{
	sw=true;
	document.getElementById('div_usr_name').style.display='none';
	document.getElementById('div_usr_email').style.display='none';
	document.getElementById('div_usr_city').style.display='none';
	document.getElementById('div_usr_pass').style.display='none';
	if (document.getElementById('usr_name').value=='')
		{
		document.getElementById('usr_name').className='inputError';
		document.getElementById('div_usr_name').style.display='';
		sw=false;
		}
	if (document.getElementById('usr_city').value=='')
		{
		document.getElementById('usr_city').className='inputError';
		document.getElementById('div_usr_city').style.display='';
		sw=false;
		}			
	if (document.getElementById('usr_email').value=='')
		{
		document.getElementById('usr_email').className='inputError';
		document.getElementById('div_usr_email').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmUsers.submit();
		}
	else
		{
		scroll(0,0);
		}
	}	
function verifyClient()
	{
	sw=true;
	document.getElementById('div_cli_email').style.display='none';
	if (document.getElementById('cli_email').value=='')
		{
		document.getElementById('cli_email').className='inputError';
		document.getElementById('div_cli_email').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmClient.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function verifyClient2()
	{
	sw=true;
//	document.getElementById('div_mcl_login').style.display='none';
	document.getElementById('div_cli_email').style.display='none';
/*	if (document.getElementById('mcl_login').value=='')
		{
		document.getElementById('mcl_login').className='inputError';
		document.getElementById('div_mcl_login').style.display='';
		sw=false;
		}*/
	if (document.getElementById('cli_email').value=='')
		{
		document.getElementById('cli_email').className='inputError';
		document.getElementById('div_cli_email').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmClient.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function usersCS(uid,status)
  {
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  //uso del medotod POST
  ajax.open("POST", "code/execute/usersCS.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("uid="+uid+"&status="+status)
  }
  
function Doc(e)
{
	$("#ShowDoc").show();
		divx = document.getElementById('generateForm');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		ajax=objectAjax();
		ajax.open("POST", "code/execute/CatShow.php",true);
		ajax.onreadystatechange=function() {
					if (ajax.readyState==4) 
						{
						//mostrar resultados en esta capa
						divx.innerHTML=ajax.responseText;
						}
					}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("job_category="+e.value)	
}