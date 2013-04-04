<?
include_once("./_common.php");

if (!$config[cf_email_use])
    alert("{$lang[329]}");

if (!$is_member && $config[cf_formmail_is_member])  
    alert_close("{$lang[330]}");

if ($is_member && !$member[mb_open] && $is_admin != "super" && $member[mb_id] != $mb_id) 
    alert_close("{$lang[311]}");

if ($mb_id) 
{
    $mb = get_member($mb_id);
    if (!$mb[mb_id]) 
        alert_close("{$lang[345]}");

    if (!$mb[mb_open] && $is_admin != "super")
        alert_close("{$lang[346]}");
}

$sendmail_count = (int)get_session('ss_sendmail_count') + 1;
if ($sendmail_count > 3)
    alert_close('{$lang[347]}');

$g4[title] = "메일 쓰기";
include_once("$g4[path]/head.sub.php");

if (!$name)
    $name = base64_decode($email);

if (!isset($type)) 
    $type = 0;

$type_checked[0] = $type_checked[1] = $type_checked[2] = "";
$type_checked[$type] = "checked";

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/formmail.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
