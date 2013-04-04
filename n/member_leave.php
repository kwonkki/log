<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert("{$lang[330]}");

if ($is_admin == "super") 
    alert("{$lang[379]}"); 

if (!($_POST[mb_password] && $member[mb_password] == sql_password($_POST[mb_password])))
    alert("{$lang[317]}");

// 회원탈퇴일을 저장
$date = date("Ymd");
$sql = " update $g4[member_table] set mb_leave_date = '$date' where mb_id = '$member[mb_id]' ";
sql_query($sql);

// 3.09 수정 (로그아웃)
session_unregister("ss_mb_id");

if (!$url) 
    $url = $g4[path]; 

alert("{$member[mb_nick]}{$lang[380]} " . date("Y{$lang[14]} m{$lang[13]} d{$lang[12]}") . "{$lang[381]}", $url);
?>
