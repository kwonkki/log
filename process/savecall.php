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
	$duration = date_compute($_POST['startcall'], $_POST['endcall']);
	if($_POST['lastresultid']==2 || $_POST['lastresultid']==4 || $_POST['lastresultid']==6){
		$valduration = "00:00:00";
	}else{
		$valduration = sprintf("%02d:%02d:%02d", (($duration['hours_total']>24)? $duration['hours'] :  $duration['hours_total'] ), $duration['minutes'], $duration['seconds']);
	}
	
	$result = sql_query("INSERT INTO call_log(`mb_no`, `call_type`, `category_id`, `username`, `currency`, `call_start`, `call_end`, `outcome_id`, `comment`, `sms`, `email`, `result_id`, `call_duration`, `product`, `call_status`) VALUES ('".$_POST['userid']."', '".$_POST['cbocalltype']."', '".$_POST['cboCategory']."', '".$_POST['txtuser']."', '".$_POST['txtcurrency']."', '".$_POST['startcall']."', '".$_POST['endcall']."', '".$_POST['cboOutcome']."', '".$_POST['comment']."', '".(($_POST['sendsms']=="on")? 1 : 0)."', '".(($_POST['sendemail']=="on")? 1 : 0)."', '".$_POST['lastresultid']."', '".$valduration."', '".$_POST['cboproduct']."', '".$_POST['rdoType']."')");
		
	$result = sql_query("INSERT INTO call_history(`mb_no`, `call_id`, `call_type`, `category_id`,  `call_start`, `call_end`, `outcome_id`, `comment`, `sms`, `email`, `result_id`, `call_duration`, `call_status`) VALUES ('".$_POST['userid']."', '".mysql_insert_id()."', '".$_POST['cbocalltype']."', '".$_POST['cboCategory']."', '".$_POST['startcall']."', '".$_POST['endcall']."', '".$_POST['cboOutcome']."', '".$_POST['comment']."', '".(($_POST['sendsms']=="on")? 1 : 0)."', '".(($_POST['sendemail']=="on")? 1 : 0)."', '".$_POST['lastresultid']."', '".$valduration."', '".$_POST['rdoType']."')");

	echo  "INSERT INTO call_log(`mb_no`, `call_type`, `category_id`, `username`, `currency`, `call_start`, `call_end`, `outcome_id`, `comment`, `sms`, `email`, `result_id`, `call_duration`, `product`) VALUES ('".$_POST['userid']."', '".$_POST['cbocalltype']."', '".$_POST['cboCategory']."', '".$_POST['txtuser']."', '".$_POST['txtcurrency']."', '".$_POST['startcall']."', '".$_POST['endcall']."', '".$_POST['cboOutcome']."', '".$_POST['comment']."', '".$_POST['sendsms']."', '".$_POST['sendemail']."', '".$_POST['lastresultid']."', '".$valduration."', '".$_POST['cboproduct']."')"."Successfully added";
}else{
	echo "";
}
?>