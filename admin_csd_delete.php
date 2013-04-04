<?
$sub_menu = "200100";
include_once("./_common.php");



$msg = "";

$mb = get_member($_POST['mb_id']);

if (!$mb[mb_id]) {
    $msg .= "$mb[mb_id] : no member data existing.\\n";
} else if ($member[mb_id] == $mb[mb_id]) {
    $msg .= "$mb[mb_id] : cant delete your own id";
} else if (is_admin($mb[mb_id]) == "super") {
    $msg .= "$mb[mb_id] : error - 3.\\n";
} else if ($is_admin != "super" && $mb[mb_level] >= $member[mb_level]) {
    $msg .= "$mb[mb_id] : error - 4 \\n";
} else {
    // 회원자료 삭제                                   
    $sql = " delete from g4_member
          where mb_id = '$mb[mb_id]' 
          ";
	sql_query($sql);          
    $msg .= "member data has been deleted";
}

if ($msg)
    echo $msg;

?>
