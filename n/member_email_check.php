<?
include_once("./_common.php");

$g4[title] = "E-mail 중복확인";
include_once("$g4[path]/head.sub.php");

$mb_email = trim($mb_email);

if ($member[mb_id]) // 수정중 중복확인이면
    $sql = " select mb_email from $g4[member_table] where mb_email = '$mb_email' and mb_id <> '$member[mb_id]' ";
else
    $sql = " select mb_email from $g4[member_table] where mb_email = '$mb_email' ";
$row = sql_fetch($sql);

if ($row[mb_email]) {
    echo <<<HEREDOC
    <script type="text/javascript"> 
        alert("'{$mb_email}'{$lang[373]}"); 
        //opener.fmbform.mb_email_enabled.value = "0"; // 새창으로 열 경우에...
        parent.document.getElementById("mb_email_enabled").value = -1;
        window.close();
    </script>
HEREDOC;
} else {
    if (!preg_match("/([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/", $mb_email)) {
        echo <<<HEREDOC
        <script type="text/javascript"> 
            alert("'{$mb_email}'{$lang[374]}"); 
            parent.document.getElementById("mb_email_enabled").value = "";
            window.close();
        </script>
HEREDOC;
    } else {
        echo <<<HEREDOC
        <script type="text/javascript"> 
            alert("'{$mb_email}'{$lang[375]}"); 
            parent.document.getElementById("mb_email_enabled").value = 1;
            window.close();
        </script>
HEREDOC;
    }
}

include_once("$g4[path]/tail.sub.php");
?>