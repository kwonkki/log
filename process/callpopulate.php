<?php

$g4_path = "."; // common.php 의 상대 경로
$g4['path'] = $g4_path;

include_once("../config.php");  // 설정 파일
include_once("../dbconfig.php");  // 설정 파일
include_once("../lib/common.lib.php");
$connect_db = sql_connect($mysql_host, $mysql_user, $mysql_password);
$select_db = sql_select_db($mysql_db, $connect_db);
	
	 if (!$select_db)
        die("<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'><script type='text/javascript'> alert('DB 접속 오류'); </script>");
		
if($_POST['historyid']!=""){
	$result = sql_query("SELECT call_history.*, call_result.result_name  FROM call_history LEFT JOIN call_result ON call_history.result_id=call_result.result_id WHERE call_history.id=".$_POST['historyid']);

	$history = mysql_fetch_assoc($result);
	echo json_encode(array($history["id"],
						   $history["call_type"],
						   $history["mb_no"],
						   $history["category_id"],
						   $history["call_start"],
						   $history["call_end"],
						   $history["outcome_id"],
						   $history["comment"],
						   $history["sms"],
						   $history["email"],
						   $history["result_id"],
						   $history["call_duration"],
						   $history["call_status"],
						   $history["result_name"],
						   $history["call_id"]
						   ));
}else{
	echo "";
}
?>