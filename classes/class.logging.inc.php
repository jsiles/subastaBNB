<?php
 /** 
  * logging class: 
  * - contains lopen and lwrite methods 
  * - lwrite will write message to the log file 
  * - first call of the lwrite will open log file implicitly 
  * - message is written with the following format: hh:mm:ss (script name) message 
  */  
 class logging{  
   // define log file  
   private $log_file = PATH_LOG;  
   // define file pointer  
   private $fp = null;  
   // write message to the log file  
function __construct($fileName = ''){
	if($fileName!='')
		$this->log_file = PATH_ROOT."/docs/".$fileName;
	}
public function lwrite($message){  
     // if file pointer doesn't exist, then open log file  
     if (!$this->fp) $this->lopen();  
     // define script name  
//     $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);  
     $script_name = $_SERVER['PHP_SELF'];  	 
     // define current time  
     $time = date('H:i:s');  
     // write current time, script name and message to the log file  
     fwrite($this->fp, "$time ($script_name) $message\n");  
   }  
   // open log file  

private function lopen(){  
     // define log file path and name
     	$lfile = $this->log_file;  
     // define the current date (it will be appended to the log file name)  
     $today = date('Y-m-d');  
     // open log file for writing only; place the file pointer at the end of the file  
     // if the file does not exist, attempt to create it  
     $this->fp = fopen($lfile . '/log_' . $today.'.txt', 'a') or exit("Can't open $lfile!");  
   }  
   
   
 public function saveToFile(){
		$parameters = func_get_args();
		$merged = "";
		foreach ($parameters as $value){
			$merged .= $value."\n";
		}
		$this->lwrite($merged);		
	}	
	
 }
 ?>