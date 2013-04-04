<?
$g4_path = ".."; // common.php 의 상대 경로
include_once("../common.php");


	$sql = " INSERT INTO `g4_sms_history` 
			( 	`sms_sender`, 
				`sms_receiver`,
				`sms_result`, 
				`sms_sending_time`,
				`sms_ip`,
				`sms_login_id`, 
				`sms_url`)
		VALUES ('$MsgSender', 
				'$DestinationAddress', 
				'$Result->ErrorMessage',
				'$g4[time_ymdhis]',
				'$_SERVER[REMOTE_ADDR]',
				'$member[mb_id]',
				'$Result->Url') ";
				
 	sql_query($sql);




?>