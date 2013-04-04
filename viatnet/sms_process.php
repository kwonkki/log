<?php

/*
 * Created on Apr 4, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include_once("ViaNettSMS.php");

// Declare variables.
$Username = "kasdf.kk@pacificseainvests.com";
$Password = "zrf3vv";
$MsgSender = "";
$DestinationAddress = "639157929773";
$Message = $_POST['contents'];

// result
$Result_Msg = "";

// Create ViaNettSMS object with params $Username and $Password
$ViaNettSMS = new ViaNettSMS($Username, $Password);
try
{
	// Send SMS through the HTTP API
	$Result = $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
	
	if ($Result->Success == true){
		echo "{ \"ErrorCode\" : \"$Result->ErrorCode\", \"ErrorMessage\" : \"$Result->ErrorMessage\", \"Message\" : \"$Message\" }";
	}else{
		echo "{ \"ErrorCode\" : \"$Result->ErrorCode\", \"ErrorMessage\" : \"$Result->ErrorMessage\", \"Message\" : \"$Message\" }";
	}
	
	
	// Check result object returned and give response to end user according to success or not.
	/*
	if ($Result->Success == true){
		$Result_Msg = 
				"<p>$Result->Success</p>";
				"<p>$Result->ErrorCode</p>";
				"<p>$Result->ErrorMessage</p>";
				"<p>$Result->Username</p>";
		
					
	}
	else{
		$Result_Msg = "Errorcode: " . $Result->ErrorCode . "<br />Errormessage: " . $Result->ErrorMessage
		. "<p>$Result->Username</p>"; 
					
	}
	*/
}
catch (Exception $e)
{
	//Error occured while connecting to server.
	$Result_Msg = $e->getMessage();
}
?>
