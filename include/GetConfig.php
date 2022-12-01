<?php
function GetConfig($ConfigName){

	
    global $con;
	
	$query="SELECT `FilterTo`, `ConfigValue` FROM `config_extra` WHERE `ConfigName`='$ConfigName' ";
	$query .=" AND `FilterTo`='Default' ";
	if(isset($SESSION["LoggedInUserID"])){ $query .=" OR `FilterTo`='UserID:$_SESSION[LoggedInUserID]' "; }
	$query .=" ORDER BY `OrderBy` ASC ";
	
    
    $result = $con->query($query);
	while($obj = mysqli_fetch_object($result)){
		if($obj->FilterTo=="Default"){ $Return="$obj->ConfigValue"; }
		if(isset($SESSION["LoggedInUserID"]) AND $obj->FilterTo=="UserID:".$_SESSION["LoggedInUserID"]){ $Return="$obj->ConfigValue"; }
	}
	
    //$Return="test";
    
	eval("\$Return = \"$Return\";");
	
    
    
	return $Return;
}
?>