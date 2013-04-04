<?
include_once("./_common.php");
include_once("$g4[path]/lib/mailer.lib.php");

if (!$config[cf_email_use])
    alert("{$lang[329]}");

if (!$is_member && $config[cf_formmail_is_member])
    alert_close("{$lang[330]}");

$to = base64_decode($to);

if (substr_count($to, "@") > 1)
    alert_close('{$lang[348]}');


$key = get_session("captcha_keystring");
if (!($key && $key == $_POST[wr_key])) {
    session_unregister("captcha_keystring");
    alert("{$lang[320]}");
}


for ($i=1; $i<=$attach; $i++) 
{
    if ($_FILES["file".$i][name])
        $file[] = attach_file($_FILES["file".$i][name], $_FILES["file".$i][tmp_name]);
}

$content = stripslashes($content);
if ($type == 2) 
{
    $type = 1;
    $content = preg_replace("/\n/", "<br>", $content);
} 

// html 이면
if ($type) 
{
    $current_url = $g4[url];
    $mail_content = "<html><head><meta http-equiv='content-type' content='text/html; charset=$g4[charset]'><title>{$lang[226]}</title><link rel='stylesheet' href='$current_url/style.css' type='text/css'></head><body>$content</body></html>";
} 
else 
    $mail_content = $content;

mailer($fnick, $fmail, $to, $subject, $mail_content, $type, $file);

//$html_title = $tmp_to . "님께 메일발송";
$html_title = "{$lang[349]}";
include_once("$g4[path]/head.sub.php");

alert_close("{$lang[350]}");

include_once("$g4[path]/tail.sub.php");
?>