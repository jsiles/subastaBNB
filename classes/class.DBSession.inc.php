<?php
@session_start();
class DBSession
{
    //private $SessionName;
   
    /**
     * Establece nombre de la session
     *
     * @param string $encrypt
     */
    function __construct($sesName='default'){
        //$this->SessionName=md5($sesName.session_id());
    }
	
    /* Function name: Set
    Params:
        @Setting - The key to set
        @Value - The value to set
    */
function Get($param_name)
{
	global $_SESSION;
	$param_value = "";
	if(isset($_SESSION[$param_name])) //$param_value = $_SESSION[$param_name];
	//$param_value = trim(SymmetricCrypt::Decrypt($_SESSION[$param_name]));
	$param_value = trim($_SESSION[$param_name]);
	else $param_value="";
	return $param_value;
}
function Set($param_name, $param_value){
 	/* 
 	  	$_SESSION[$this->SessionName][$Setting]=SymmetricCrypt::Encrypt($Value);
    }
    /* Function name: Get
    Params:
        @Setting - The key to get
        @Default - Value to return if the requested key is empty.
    
    function Get($Setting){
        if(isset($_SESSION[$this->SessionName][$Setting]) && !empty($_SESSION[$this->SessionName][$Setting])){
        		return rtrim(SymmetricCrypt::Decrypt($_SESSION[$this->SessionName][$Setting]));
        }
        else
            return '';
	*/
		global $_SESSION;
		if(isset($_SESSION[$param_name]))
		$_SESSION[$param_name]='';
		$param_value=$param_value;
		//$param_value=SymmetricCrypt::Encrypt($param_value);
		$param_value=$param_value;
	    $_SESSION[$param_name] = $param_value;
		return true;		
    }
   
/** Function name: Set
    Params:
        @Setting - The key to set
        @Value - The value to set
*/
 function Del($Setting){
            unset($_SESSION[$Setting]);
    }


/**
 * Unsets all sessions
 *
 */
function DestroyAll(){
		unset($_SESSION[$this->SessionName]);
}

}
/*
// Example Usage:
include('classes/class.DBSession.inc.php');

$Session = new DBSession('Script');

// Sets the session data
$Session->Set('user','username');
$Session->Set('pass','password');

// Retrieving of the data
$User = $Session->Get('user');

// Delete data
$Session->Del('user');
$Session->DestroyAll();
 */
?>
