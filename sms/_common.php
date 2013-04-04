<?
$g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");


if($is_member && $member['mb_level'] >= 3 ){
	; 
}else{ 
	echo "<script>alert('you are not authorized.\\nContact your manager')</script>";
	goto_url($g4[path]);
	exit;
} 

?>