// handles the response received from the server
function pageResponse()
{
	
	if(Ajax.checkReadyState('listing_container') == "200"){
		var textResponse = Ajax.getResponse();
		
 		// display the user message
		var myDiv = document.getElementById("listing_container");
		myDiv.innerHTML = textResponse;
		return false;
	}
  
}

function paginate(pageNumber){
	 try{
		if(typeof pageNumber == 'undefined') pageNumber=1;
		 var searchQuery = document.getElementById('search').value;
		// get the existing GET variables
		var getVars = '';
		
		/*var inputs = document.forms[0].getElementsByTagName('input');
		for(var i=0;i<inputs.length;i++){
			if(inputs[i].id != 'search' && inputs[i].id != ''){
				var getVars = getVars+'&'+inputs[i].id+"="+inputs[i].value;
			}

		}*/
		var by_category = document.getElementById('by_category').value;
		if(parseInt(by_category)){
			getVars = '&by_category='+by_category;
		}
		// create the params string
		var url = "code/execute/sub_page.php";
		var params = 'page='+pageNumber+'&search='+searchQuery+getVars;
		
		// NOTE: You don't have to use this framework just whatever ajax handler you like
		
		// method | url | parameters | callback function to handle the response
		AjaxUpdater.Update("GET",url,params,pageResponse);
		return false;
    }
    // display the error in case of failure
    catch (e){
      alert("Can't connect to server:\n" + e.toString());
      return false;
    }
	
}