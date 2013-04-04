<?
include_once("./_common.php");

$g4[title] = "회원아이디 중복확인";
include_once("$g4[path]/head.sub.php");

$mb_id = trim($mb_id);

$mb = get_member($mb_id);
if ($mb[mb_id]) 
{
    echo "<script type=\"text/javascript\">";
    echo "alert(\"'{$mb_id}'{$lang[376]}\");";
    echo "parent.document.getElementById(\"mb_id_enabled\").value = -1;";
    echo "window.close();";
    echo "</script>";
} 
else 
{
    if (preg_match("/[\,]?{$mb_id}/i", $config[cf_prohibit_id]))
    {
        echo "<script type=\"text/javascript\">";
        echo "alert(\"'{$mb_id}'{$lang[377]}\");";
        echo "parent.document.getElementById(\"mb_id_enabled\").value = -2;";
        echo "window.close();";
        echo "</script>";
    }
    else
    {
        echo "<script type=\"text/javascript\">";
        echo "alert(\"'{$mb_id}'{$lang[378]}\");";
        echo "parent.document.getElementById(\"mb_id_enabled\").value = 1;";
        echo "window.close();";
        echo "</script>";
    }
}

include_once("$g4[path]/tail.sub.php");
?>