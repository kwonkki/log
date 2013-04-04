<?php

function date_compute($d1, $d2){
    $d1 = (is_string($d1) ? strtotime($d1) : $d1);
    $d2 = (is_string($d2) ? strtotime($d2) : $d2);

    $diff_secs = abs($d1 - $d2);
    $base_year = min(date("Y", $d1), date("Y", $d2));

    $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
    return array(
        "years" => date("Y", $diff) - $base_year,
        "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
        "months" => date("n", $diff) - 1,
        "days_total" => floor($diff_secs / (3600 * 24)),
        "days" => date("j", $diff) - 1,
        "hours_total" => floor($diff_secs / 3600),
        "hours" => date("G", $diff),
        "minutes_total" => floor($diff_secs / 60),
        "minutes" => (int) date("i", $diff),
        "seconds_total" => $diff_secs,
        "seconds" => (int) date("s", $diff)
    );
}


error_reporting(E_ALL);
$g4_path = "."; // common.php 의 상대 경로
$g4['path'] = $g4_path;

include_once("../config.php");  // 설정 파일
include_once("../dbconfig.php");  // 설정 파일
include_once("../lib/common.lib.php");
$connect_db = sql_connect($mysql_host, $mysql_user, $mysql_password);
$select_db = sql_select_db($mysql_db, $connect_db);
	
	 if (!$select_db)
        die("<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'><script type='text/javascript'> alert('DB 접속 오류'); </script>");

if($_POST['userid']!=""){
	$duration = date_compute($_POST['followstart'], $_POST['followend']);		
	if($_POST['followlastresultid']==2 || $_POST['followlastresultid']==4 || $_POST['followlastresultid']==6){
		$valduration = "00:00:00";
	}else{
		$valduration = sprintf("%02d:%02d:%02d", (($duration['hours_total']>24)? $duration['hours_total'] :  $duration['hours'] ), $duration['minutes'], $duration['seconds']);
	}
	
	if($_POST['historyid']!=""){
		
		$result = sql_query("select call_log.id from call_log INNER JOIN call_history ON call_log.id=call_history.call_id where call_log.id='".$_POST['followid']."'
							AND call_log.call_type= call_history.call_type
							AND call_log.call_start= call_history.call_start
							AND call_log.call_end=call_history.call_end
							AND call_history.id='".$_POST['historyid']."'");
		
		$compare_parent = mysql_num_rows($result);
		
		if($compare_parent>0){		
		$result = sql_query("UPDATE call_log SET 
							`mb_no` = '".$_POST['userid']."', 							
							`call_type` = '".$_POST['cbofollowcalltype']."', 
							`category_id` = '".$_POST['cbofollowCategory']."', 
							`call_start` = '".$_POST['followstart']."', 
							`call_end` = '".$_POST['followend']."', 
							`outcome_id` = '".$_POST['cbofollowOutcome']."', 
							`comment` = '".$_POST['followcomment']."', 
							`sms` = '".(($_POST['followsendsms']=="on")? 1 : 0)."', 
							`email` = '".(($_POST['followsendemail']=="on")? 1 : 0)."', 
							`result_id` = '".$_POST['followlastresultid']."', 
							`call_duration` = '".$valduration."', 
							`call_status` = '".$_POST['followrdoType']."'
							WHERE id = '".$_POST['followid']."'");
		}
							
		$result = sql_query("UPDATE call_history SET 
							`mb_no` = '".$_POST['userid']."', 							
							`call_type` = '".$_POST['cbofollowcalltype']."', 
							`category_id` = '".$_POST['cbofollowCategory']."', 
							`call_start` = '".$_POST['followstart']."', 
							`call_end` = '".$_POST['followend']."', 
							`outcome_id` = '".$_POST['cbofollowOutcome']."', 
							`comment` = '".$_POST['followcomment']."', 
							`sms` = '".(($_POST['followsendsms']=="on")? 1 : 0)."', 
							`email` = '".(($_POST['followsendemail']=="on")? 1 : 0)."', 
							`result_id` = '".$_POST['followlastresultid']."', 
							`call_duration` = '".$valduration."', 
							`call_status` = '".$_POST['followrdoType']."'
							WHERE id = '".$_POST['historyid']."'");
	}else{		
		$result = sql_query("INSERT INTO call_history(`mb_no`, `call_id`, `call_type`, `category_id`,  `call_start`, `call_end`, `outcome_id`, `comment`, `sms`, `email`, `result_id`, `call_duration`, `call_status`) VALUES ('".$_POST['userid']."', '".$_POST['followid']."', '".$_POST['cbofollowcalltype']."', '".$_POST['cbofollowCategory']."', '".$_POST['followstart']."', '".$_POST['followend']."', '".$_POST['cbofollowOutcome']."', '".$_POST['followcomment']."', '".(($_POST['followsendsms']=="on")? 1 : 0)."', '".(($_POST['followsendemail']=="on")? 1 : 0)."', '".$_POST['followlastresultid']."', '".$valduration."', '".$_POST['followrdoType']."')");
		
		$result = sql_query("UPDATE call_log SET `mb_no` = '".$_POST['userid']."', 
							`call_type` = '".$_POST['cbofollowcalltype']."', 
							`category_id` = '".$_POST['cbofollowCategory']."', 
							`call_start` = '".$_POST['followstart']."', 
							`call_end` = '".$_POST['followend']."', 
							`outcome_id` = '".$_POST['cbofollowOutcome']."', 
							`comment` = '".$_POST['followcomment']."', 
							`sms` = '".(($_POST['followsendsms']=="on")? 1 : 0)."', 
							`email` = '".(($_POST['followsendemail']=="on")? 1 : 0)."', 
							`result_id` = '".$_POST['followlastresultid']."', 
							`call_status` = '".$_POST['followrdoType']."', 
							`call_duration` = '".$valduration."' WHERE id='".$_POST['followid']."'");
		

		echo "Successfully added";
	}
}else{
	echo "";
}
?>