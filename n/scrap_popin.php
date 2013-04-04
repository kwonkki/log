<?
include_once("./_common.php");

include_once("$g4[path]/head.sub.php");

if (!$member[mb_id]) {
    $href = "./login.php?$qstr&url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id");
    echo <<<HEREDOC
    <script type="text/javascript">
        alert("{$lang[330]}");
        opener.location.href = "$href";
        window.close();
    </script>
HEREDOC;
    exit;
}

echo <<<HEREDOC
<script type="text/javascript">
    if (window.name != "scrap") {
        alert("{$lang[470]}");
        window.close();
    }
</script>
HEREDOC;

if ($write[wr_is_comment])
    alert_close("{$lang[471]}");

$sql = " select count(*) as cnt from $g4[scrap_table]
          where mb_id = '$member[mb_id]'
            and bo_table = '$bo_table'
            and wr_id = '$wr_id' ";
$row = sql_fetch($sql);
if ($row[cnt]) {
    echo <<<HEREDOC
    <script type="text/javascript">
    if (confirm('{$lang[472]}'))
        document.location.href = './scrap.php';
    else
        window.close();
    </script>
HEREDOC;
    exit;
}

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/scrap_popin.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
