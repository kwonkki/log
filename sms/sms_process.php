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
	
	switch($contents_temp){
		case "china" :
		$copy = "尊敬的会员：你的提款已经成功汇出，请查收。谢谢！12BET";
		break;
		
		case "thailand" :
		//$copy = "เรียนสมาชิก : เรายินดีที่จะ แจ้งให้คุณทราบว่า เงินที่คุณแจ้ง ถอน ได้รับการอนุมัติเรียบร้อย ขอขอบคุณ จาก 12BET";
		$copy = "ยอดการถอนเงินของคุณได้รับการอนุมัติแล้ว, 12BET";
		break;
			
		case "vietnam" :
		//$copy = "Thành viên thân mến: Yêu cầu rút tiền của bạn đã xét duyệt, vui lòng kiểm tra. Cám ơn, 12BET!";
		$copy = "Yêu cầu rút tiền của bạn đã được phê duyệt, 12BET!";
		break;
			
		case "philippines" :
		$copy = "Dear member: We are happy to inform you that your withdrawal request was approved. Thank you, 12BET";
		break;
			
		case "indonesia" :
		$copy = "Terima kasih, 12BET";
		break;	
		
		case "Malaysia" :
		$copy = "Thank you, 12BET";
		break;	
		
		default :
		$copy = "Country is not in the listed";
		
	}
	$Message = $copy;
	 
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
