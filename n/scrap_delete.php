<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert("{$lang[330]}");

$sql = " delete from $g4[scrap_table] where mb_id = '$member[mb_id]' and ms_id = '$ms_id' ";
sql_query($sql);

goto_url("./scrap.php?page=$page");
?>
