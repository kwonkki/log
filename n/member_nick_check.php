<?
include_once("./_common.php");

$g4[title] = "별명 중복확인";
include_once("$g4[path]/head.sub.php");

$mb_nick = trim($mb_nick);

// 별명은 한글, 영문, 숫자만 가능
if (!check_string($mb_nick, _G4_HANGUL_ + _G4_ALPHABETIC_ + _G4_NUMERIC_)) {
    echo "<script type='text/javascript'>";
    echo "alert(\"{$lang[337]}\");";
    echo "parent.document.getElementById('mb_nick_enabled').value = '';";
    echo "window.close();";
    echo "</script>";
    exit;
}

$mb = sql_fetch(" select mb_nick from $g4[member_table] where mb_nick = '$mb_nick' ");
if ($mb[mb_nick]) {
    echo "<script type='text/javascript'>";
    echo "alert(\"'{$mb_nick}'{$lang[382]}\");";
    echo "parent.document.getElementById('mb_nick_enabled').value = -1;";
    echo "window.close();";
    echo "</script>";
} else {
    if (preg_match("/[\,]?{$mb_nick}/i", $config[cf_prohibit_id])) {
        echo "<script type='text/javascript'>";
        echo "alert(\"'{$mb_nick}'{$lang[383]}\");";
        echo "parent.document.getElementById('mb_nick_enabled').value = -2;";
        echo "window.close();";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert(\"'{$mb_nick}'{$lang[384]}\");";
        echo "parent.document.getElementById('mb_nick_enabled').value = 1;";
        echo "window.close();";
        echo "</script>";
    }
}

include_once("$g4[path]/tail.sub.php");
?>