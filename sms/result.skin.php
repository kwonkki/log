<?
	if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
	
	$g4_path = ".."; // common.php 의 상대 경로
	include_once("$g4_path/common.php");
	
	// STR : SQL PROCESS 
	
	
	
	$sql = "SELECT  `sms_no` ,  `sms_sender` ,  `sms_receiver` ,  `sms_msg` ,  `sms_result` ,  `sms_sending_time` ,  `sms_ip` ,  `sms_login_id` ,  `sms_url` FROM  `g4_sms_history`
			WHERE `sms_login_id` = '$member[mb_id]'	";
	$board = sql_fetch($sql);
	
	echo $board[sms_receiver]; 
	
	
	
	
	
	
	
	
	
	// END : SQL PROCESS	
	include_once("./result.skin_html.php");
	
?>
