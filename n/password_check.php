<?
include_once("./_common.php");

if ($w == "s") {
    $qstr = "bo_table=$bo_table&sfl=$sfl&stx=$stx&sop=$sop&wr_id=$wr_id&page=$page";

    $wr = get_write($write_table, $wr_id);

    if (sql_password($wr_password) != $wr[wr_password]) 
        alert("{$lang[317]}");

    // 세션에 아래 정보를 저장. 하위번호는 패스워드없이 보아야 하기 때문임.
    //$ss_name = "ss_secret_{$bo_table}_{$wr_id}";
    $ss_name = "ss_secret_{$bo_table}_{$wr[wr_num]}";
    //set_session("ss_secret", "$bo_table|$wr[wr_num]");
    set_session($ss_name, TRUE);

} else
    alert("w {$lang[355]}");

goto_url("./board.php?$qstr");
?>
