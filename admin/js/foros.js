// JavaScript Document
function verifyForos()
	{
	sw=true;	
	document.getElementById('div_fol_title').style.display='none';
	if (document.getElementById('fol_title').value=='')
		{
		document.getElementById('fol_title').className='inputError';
		document.getElementById('div_fol_title').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmForos.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function forosCS(uid,status)
  {
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  //uso del medotod POST
  ajax.open("POST", "code/execute/forosCS.php",true);
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