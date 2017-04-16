// JavaScript Document

function verifyPermit(){
   sw=false;
   var collection = document.getElementsByName('con_uid[]');
	for(i=0 ; i<collection.length;i++){
			if(collection.item(i).checked==true)
				{
				if (sw==false) sw=true;							
				}
	}

  x= $('#mcc_permit').val();
  valor= /^[a-z0-9A-Z \u00C0-\u00ff]+$/
	  
	if(!valor.test(x) || x==''){
		$('#div_mcc_permit').fadeIn(600);
		if (sw==false) $('#div_con_uid').show();
    	return;
    	}
	else{
		if (sw==false){
   			$('#div_con_uid').show();
			return;
   		}
		else document.frmPermit.submit();	
    }	
}

function hideMsg(){
   $('#div_con_uid').hide();
}


$(document).ready(function(){

});