<?php
$g4_path = ".."; // common.php 의 상대 경로
include_once("../common.php");

/*
 * Created on Apr 4, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include_once("ViaNettSMS.php");



try
{
	
	// Declare variables.
	$Username = "sherrychenbet@hotmail.com";
	$Password = "krrix";
	$MsgSender = "7777";
	/*
	$Username = "qkrdusen1004@gmail.com";
	$Password = "wdwvz";
	$MsgSender = "12bet";
	*/
	$DestinationAddress = $_POST['phone'];
	$contents_temp = $_POST['contents'];
	$copy = "";
	
	
	$Message = $contents_temp;
	 
	// result
	$Result_Msg = "";
	
	// Create ViaNettSMS object with params $Username and $Password
	$ViaNettSMS = new ViaNettSMS($Username, $Password);
	
	
	// Send SMS through the HTTP API
	$Result = $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
	
	
	
	if ($Result->Success == true){
		echo "{ \"ErrorCode\" : \"$Result->ErrorCode\", \"ErrorMessage\" : \"$Result->ErrorMessage\", \"Message\" : \"$Message\" }";
	}else{
		echo "{ \"ErrorCode\" : \"$Result->ErrorCode\", \"ErrorMessage\" : \"$Result->ErrorMessage\", \"Message\" : \"$Message\" }";
	}
	

	$sql = " INSERT INTO `g4_sms_history` 
			( 	`sms_sender`, 
				`sms_receiver`,
				`sms_msg`, 
				`sms_result`, 
				`sms_sending_time`,
				`sms_ip`,
				`sms_login_id`, 
				`sms_url`)
		VALUES ('$MsgSender', 
				'$DestinationAddress', 
				'$Message',
				'$Result->ErrorMessage',
				'$g4[time_ymdhis]',
				'$_SERVER[REMOTE_ADDR]',
				'$member[mb_id]',
				'$Result->Url') ";
				
	
				
 	sql_query($sql);
	
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
