<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert_close("{$lang[330]}");

if (!$member[mb_open] && $is_admin != "super" && $member[mb_id] != $mb_id) 
    alert_close("{$lang[387]}");

$content = "";
// 탈퇴한 회원에게 쪽지 보낼 수 없음
if ($me_recv_mb_id) 
{
    $mb = get_member($me_recv_mb_id);
    if (!$mb[mb_id]) 
        alert_close("{$lang[345]}");

    if (!$mb[mb_open] && $is_admin != "super")
        alert_close("{$lang[346]}");

    // 4.00.15
    $row = sql_fetch(" select me_memo from $g4[memo_table] where me_id = '$me_id' and (me_recv_mb_id = '$member[mb_id]' or me_send_mb_id = '$member[mb_id]') ");
    if ($row[me_memo]) 
    {
        $content = "\n\n\n>"
                 . "\n>"
                 . "\n> " . preg_replace("/\n/", "\n> ", get_text($row[me_memo], 0)) 
                 . "\n>"
                 . "\n";

    }
}

$g4[title] = "쪽지 보내기";
include_once("$g4[path]/head.sub.php");

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/memo_form.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
