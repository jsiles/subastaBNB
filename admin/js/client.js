// JavaScript Document
function verifyClient()
{
	sw=true;
	document.getElementById('div_cli_nit_ci').style.display='none';
	document.getElementById('div_cli_user').style.display='none';
	document.getElementById('div_cli_pass').style.display='none';
	document.getElementById('div_cli_socialreason').style.display='none';
	document.getElementById('div_cli_mainemail').style.display='none';
	document.getElementById('div_cli_interno').style.display='none';
	document.getElementById('div_cli_legalname').style.display='none';
	document.getElementById('div_cli_legallastname').style.display='none';
	
	if(document.getElementById('cli_pts_uid').value==4){
		document.getElementById('div_cli_pts_description8').style.display='none';
		document.getElementById('div_cli_pts_description9').style.display='none';
	}

	if (document.getElementById('cli_nit_ci').value==''){
		document.getElementById('cli_nit_ci').className='inputError';
		document.getElementById('div_cli_nit_ci').style.display='';
		document.getElementById('div_cli_nit_ci').innerHTML = "NIT o CI es necesario!";
		sw=false;
	}
	else
	{
		if (!isNumeric(document.getElementById('cli_nit_ci').value)){
			document.getElementById('cli_nit_ci').className='inputError';
			document.getElementById('div_cli_nit_ci').style.display='';
			document.getElementById('div_cli_nit_ci').innerHTML = "Solo Numeros";
			sw=false;
		}
	}
		
	if (document.getElementById('cli_user').value==''){
		document.getElementById('cli_user').className='inputError';
		document.getElementById('div_cli_user').style.display='';
		sw=false;
	}
	
	if (document.getElementById('cli_pass').value==''){
		document.getElementById('cli_pass').className='inputError';
		document.getElementById('div_cli_pass').style.display='';
		sw=false;
	}
	var pass = document.getElementById('cli_pass').value;
                if (pass.length<8){
                    document.getElementById('cli_pass').className='inputError';
                    document.getElementById('div_cli_pass').innerHTML="Cantidad de caracteres minimo es de 8";
                    document.getElementById('div_cli_pass').style.display='';
                   
			
			sw=false;
		} 
	if (document.getElementById('cli_socialreason').value==''){
		document.getElementById('cli_socialreason').className='inputError';
		document.getElementById('div_cli_socialreason').style.display='';
		sw=false;
	}
	
	if (document.getElementById('cli_mainemail').value==''){
		document.getElementById('cli_mainemail').className='inputError';
		document.getElementById('div_cli_mainemail').style.display='';
		sw=false;
	}
	
	if (document.getElementById('cli_interno').value==''){
		document.getElementById('cli_interno').className='inputError';
		document.getElementById('div_cli_interno').style.display='';
		sw=false;
	}
	
	if (document.getElementById('cli_legalname').value==''){
		document.getElementById('cli_legalname').className='inputError';
		document.getElementById('div_cli_legalname').style.display='';
		sw=false;
	}
		
	if (document.getElementById('cli_legallastname').value==''){
		document.getElementById('cli_legallastname').className='inputError';
		document.getElementById('div_cli_legallastname').style.display='';
		sw=false;
	}

	if(document.getElementById('cli_pts_uid').value==4){
		if (document.getElementById('cli_pts_description8').value==''){
			document.getElementById('cli_pts_description8').className='inputError';
			document.getElementById('div_cli_pts_description8').style.display='';
			sw=false;
		}
		if (document.getElementById('cli_pts_description9').value==''){
			document.getElementById('cli_pts_description9').className='inputError';
			document.getElementById('div_cli_pts_description9').style.display='';
			sw=false;
		}
	}

	if (sw){
		document.frmClient.submit();
	}
	else{
		scroll(0,0);
	}
}

function verifyClientEdit()
{
	sw=true;
	document.getElementById('div_cli_nit_ci').style.display='none';
	document.getElementById('div_cli_user').style.display='none';
	document.getElementById('div_cli_pass').style.display='none';
	document.getElementById('div_cli_socialreason').style.display='none';
	document.getElementById('div_cli_mainemail').style.display='none';
	document.getElementById('div_cli_interno').style.display='none';
	document.getElementById('div_cli_legalname').style.display='none';
	document.getElementById('div_cli_legallastname').style.display='none';
	
        if (document.getElementById('cli_pass').style.display!='none'){
        if (document.getElementById('cli_pass').value==''){
		document.getElementById('cli_pass').className='inputError';
		document.getElementById('div_cli_pass').style.display='';
		sw=false;
	}
	var pass = document.getElementById('cli_pass').value;
                if (pass.length<8){
                    document.getElementById('cli_pass').className='inputError';
                    document.getElementById('div_cli_pass').innerHTML="Cantidad de caracteres minimo es de 8";
                    document.getElementById('div_cli_pass').style.display='';
                   
			
			sw=false;
		} 
            }
	if(document.getElementById('cli_pts_uid').value==4){
		document.getElementById('div_cli_pts_description8').style.display='none';
		document.getElementById('div_cli_pts_description9').style.display='none';
	}

	if (document.getElementById('cli_nit_ci').value==''){
		document.getElementById('cli_nit_ci').className='inputError';
		document.getElementById('div_cli_nit_ci').style.display='';
		document.getElementById('div_cli_nit_ci').innerHTML = "NIT o CI es necesario!";
		sw=false;
	}
	else
	{
		if (!isNumeric(document.getElementById('cli_nit_ci').value)){
			document.getElementById('cli_nit_ci').className='inputError';
			document.getElementById('div_cli_nit_ci').style.display='';
			document.getElementById('div_cli_nit_ci').innerHTML = "Solo Numeros";
			sw=false;
		}
	}
		
	if (document.getElementById('cli_user').value==''){
		document.getElementById('cli_user').className='inputError';
		document.getElementById('div_cli_user').style.display='';
		sw=false;
	}
		
	if (document.getElementById('cli_socialreason').value==''){
		document.getElementById('cli_socialreason').className='inputError';
		document.getElementById('div_cli_socialreason').style.display='';
		sw=false;
	}
	
	if (document.getElementById('cli_mainemail').value==''){
		document.getElementById('cli_mainemail').className='inputError';
		document.getElementById('div_cli_mainemail').style.display='';
		sw=false;
	}
	
	if (document.getElementById('cli_interno').value==''){
		document.getElementById('cli_interno').className='inputError';
		document.getElementById('div_cli_interno').style.display='';
		sw=false;
	}
	
	if (document.getElementById('cli_legalname').value==''){
		document.getElementById('cli_legalname').className='inputError';
		document.getElementById('div_cli_legalname').style.display='';
		sw=false;
	}
		
	if (document.getElementById('cli_legallastname').value==''){
		document.getElementById('cli_legallastname').className='inputError';
		document.getElementById('div_cli_legallastname').style.display='';
		sw=false;
	}

	if(document.getElementById('cli_pts_uid').value==4){
		if (document.getElementById('cli_pts_description8').value==''){
			document.getElementById('cli_pts_description8').className='inputError';
			document.getElementById('div_cli_pts_description8').style.display='';
			sw=false;
		}
		if (document.getElementById('cli_pts_description9').value==''){
			document.getElementById('cli_pts_description9').className='inputError';
			document.getElementById('div_cli_pts_description9').style.display='';
			sw=false;
		}
	}

	if (sw){
		document.frmClient.submit();
	}
	else{
		scroll(0,0);
	}
}


function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function nal2(flag)
{
	if(flag==1){
		$('#cal2').show();
		$('#nal2').show();
		$('#aal2').show();
		$('#l2a').hide();
		$('#l2b').show();	
	}
	else{
		$('#cal2').hide();
		$('#nal2').hide();
		$('#aal2').hide();
		$('#l2a').show();
		$('#l2b').hide();
		$('#cal3').hide();
		$('#nal3').hide();
		$('#aal3').hide();
		$('#l3a').show();
		$('#l3b').hide();
	}
}

function nal3(flag)
{
	if(flag==1){
		$('#cal3').show();
		$('#nal3').show();
		$('#aal3').show();
		$('#l3a').hide();
		$('#l3b').show();	
	}
	else{
		$('#cal3').hide();
		$('#nal3').hide();
		$('#aal3').hide();
		$('#l3a').show();
		$('#l3b').hide();
	}
}

function checkinOut()
{
	if(document.getElementById('cli_doc_uid[10]').checked){
		$(".subDocs").attr("checked", "true");
	}
	else{
		$(".subDocs").attr("checked", "");
	}
}

function checkinOut2(id)
{
	if(!document.getElementById('cli_doc_uid['+id+']').checked){
		$('.subDocs2').attr("checked", "");
	}
}

function ptsClient(token)
{
    uid=document.getElementById('cli_pts_uid').value
	divx = document.getElementById('div_cli_pts_uid_select');
  	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
 	//instanciamos el objetoAjax
 	ajax=objectAjax();
 	ajax.open("POST", "code/execute/waytopay.php",true);
 	ajax.onreadystatechange=function() {
			if (ajax.readyState==4) 
			{
				//mostrar resultados en esta capa
				divx.innerHTML=ajax.responseText;
			}
  	}  
 	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 	//enviando los valores
  	ajax.send("uid="+uid)	
}

function gsClient(token)
{
	uid=document.getElementById('item_uid').value
	divx = document.getElementById('div_cli_ite_uid_select');
  	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
 	//instanciamos el objetoAjax
 	ajax=objectAjax();
 	ajax.open("POST", "code/execute/item.php",true);
 	ajax.onreadystatechange=function() {
			if (ajax.readyState==4) 
			{
				//mostrar resultados en esta capa
				divx.innerHTML=ajax.responseText;
			}
  	}  
 	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 	//enviando los valores
  	ajax.send("uid="+uid)	
}