// JavaScript Document
function verifyModules(){
	sw=true;
	document.getElementById('div_mod_name').style.display='none'; 
	document.getElementById('div_mod_alias').style.display='none'; 
	document.getElementById('div_mod_index').style.display='none';
	document.getElementById('div_doc_dca_uid').style.display='none';

	if (document.getElementById('mod_name').value==''){
		document.getElementById('mod_name').className='inputError';
		document.getElementById('div_mod_name').style.display='';
		sw=false;
	}
	if (document.getElementById('mod_alias').value==''){
		document.getElementById('mod_alias').className='inputError';
		document.getElementById('div_mod_alias').style.display='';
		sw=false;
	}
	if (document.getElementById('mod_index').value==''){
		document.getElementById('mod_index').className='inputError';
		document.getElementById('div_mod_index').style.display='';
		sw=false;
	}
	
/*	var category = document.getElementById('doc_dca_uid');
	if (category.selectedIndex==0){		
		document.getElementById('doc_dca_uid').className='listMenuError';
		document.getElementById('div_doc_dca_uid').style.display='';
		sw=false;
	}
	*/
	if (sw){
		document.frmModules.submit();
	}
	else{
		scroll(0,0);
	}
}