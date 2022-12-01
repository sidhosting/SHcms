<?php 

Function config($name=''){

	global $Page;
	global $hostname;
	global $path;


	$MaintenanceMode="Disable"; //Enable/Disable
	$MaintenanceModeEmail="info@sidhosting.net"; //Enable/Disable
	$MaintenanceModeDisableForIP=array('');
	
    $MySQL_address="localhost"; // Older version then 3.1.1
    $MySQL_database=""; // Older version then 3.1.1
    $MySQL_username=""; // Older version then 3.1.1
    $MySQL_password=""; // Older version then 3.1.1
	if($name=="MySQL_address"){ $name='MySQL/hostname'; } // Older version then 3.1.1
	if($name=="MySQL_username"){ $name='MySQL/username'; } // Older version then 3.1.1
	if($name=="MySQL_password"){ $name='MySQL/password'; } // Older version then 3.1.1
	if($name=="MySQL_database"){ $name='MySQL/database'; } // Older version then 3.1.1
    
    $WebSiteName="PointOfSale";
	$WebSiteShortName="POS";
	
	$WebSiteFontIcon='<span class="fa fa-file-text-o fa-lg"></span>';
	
	$Default_CMS_Pages="include/Pages/"; /* always end with slush*/
	
	
	$Installed_Bootstrap3="Y"; /* (Y/N) */
    
	
	
	
	/*
	========
	== No Changes After this
	========
	*/
	
	// Comment OUT on "2020-11-21"
	// if(is_file($_SERVER['DOCUMENT_ROOT']."/include/config/".$name.".cfg.php")){
	// 	$ReturnFile=file_get_contents($_SERVER['DOCUMENT_ROOT']."/include/config/".$name.".cfg.php"); // Loading Default Setting
	// 	if(is_file($_SERVER['DOCUMENT_ROOT']."/include/config/".$name.".php")){ // When PHP file there
	// 		include($_SERVER['DOCUMENT_ROOT']."/include/config/".$name.".php");	
	// 	}
	// 	$name="ReturnFile";
	// } else {
	// 	$ReturnFile="";
	// 	$name="ReturnFile";
	// }
	

// New Style After 2020-11-21
if(is_file($_SERVER['DOCUMENT_ROOT']."/include/config/".$name.".php")){ // When PHP file there
	include($_SERVER['DOCUMENT_ROOT']."/include/config/".$name.".php");	
	$name="ReturnFile";
} else {
	// When there is no PHP File
	if(is_file($_SERVER['DOCUMENT_ROOT']."/include/config/".$name.".cfg.php")){
		$ReturnFile=file_get_contents($_SERVER['DOCUMENT_ROOT']."/include/config/".$name.".cfg.php"); // Loading Default Setting
		$name="ReturnFile";
	} else {
		// Back To Really Old 
		$ReturnFile="";
		$name="ReturnFile";
	}
}


	
	
	
	if(function_exists("VisiterIP")){
		$VisiterIP=VisiterIP(); 
		if (in_array("$VisiterIP", $MaintenanceModeDisableForIP)) {
			$MaintenanceMode="Disable"; //Enable/Disable
		}
	}
    return ${$name};	
}

?>