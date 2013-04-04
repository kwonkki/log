<?php

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

if($_POST['rdoTagType']!=""){	
	$result = sql_query("UPDATE call_log SET  
						`call_status` = '".$_POST['rdoTagType']."' WHERE id='".$_POST['txtTagID']."'");
		
	echo "Successfully updated";
}else{
	echo "";
}
?>