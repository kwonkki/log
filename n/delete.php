<?
include_once("./_common.php");

//$wr = sql_fetch(" select * from $write_table where wr_id = '$wr_id' ");

@include_once("$board_skin_path/delete.head.skin.php");

if ($is_admin == "super") // 최고관리자 통과
    ;
else if ($is_admin == "group") { // 그룹관리자
    $mb = get_member($write[mb_id]);
    if ($member[mb_id] != $group[gr_admin]) // 자신이 관리하는 그룹인가?
        alert("{$lang[298]}");
    else if ($member[mb_level] < $mb[mb_level]) // 자신의 레벨이 크거나 같다면 통과
        alert("{$lang[299]}");
} else if ($is_admin == "board") { // 게시판관리자이면
    $mb = get_member($write[mb_id]);
    if ($member[mb_id] != $board[bo_admin]) // 자신이 관리하는 게시판인가?
        alert("{$lang[300]}");
    else if ($member[mb_level] < $mb[mb_level]) // 자신의 레벨이 크거나 같다면 통과
        alert("{$lang[301]}");
} else if ($member[mb_id]) {
    if ($member[mb_id] != $write[mb_id])
        alert("{$lang[302]}");
} else {
    if ($write[mb_id])
        alert("{$lang[303]}", "./login.php?url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id"));
    else if (sql_password($wr_password) != $write[wr_password])
        alert("{$lang[304]}"); 
}

$len = strlen($write[wr_reply]);
if ($len < 0) $len = 0; 
$reply = substr($write[wr_reply], 0, $len);

// 원글만 구한다.
$sql = " select count(*) as cnt from $write_table
          where wr_reply like '$reply%'
            and wr_id <> '$write[wr_id]'
            and wr_num = '$write[wr_num]'
            and wr_is_comment = 0 ";
$row = sql_fetch($sql);
if ($row[cnt] && !$is_admin)
    alert("{$lang[305]}\\n\\n{$lang[306]}");

// 코멘트 달린 원글의 삭제 여부
$sql = " select count(*) as cnt from $write_table
          where wr_parent = '$wr_id'
            and mb_id <> '$member[mb_id]'
            and wr_is_comment = 1 ";
$row = sql_fetch($sql);
if ($row[cnt] >= $board[bo_count_delete] && !$is_admin)
    alert("{$lang[307]}\\n\\n{$lang[308]} {$board[bo_count_delete]}{$lang[309]}");


// 사용자 코드 실행
@include_once("$board_skin_path/delete.skin.php");


// 나라오름님 수정 : 원글과 코멘트수가 정상적으로 업데이트 되지 않는 오류를 잡아 주셨습니다.
//$sql = " select wr_id, mb_id, wr_comment from $write_table where wr_parent = '$write[wr_id]' order by wr_id ";
$sql = " select wr_id, mb_id, wr_is_comment from $write_table where wr_parent = '$write[wr_id]' order by wr_id ";
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) 
{
    // 원글이라면
    if (!$row[wr_is_comment]) 
    {
        // 원글 포인트 삭제
        if (!delete_point($row[mb_id], $bo_table, $row[wr_id], '{$lang[310]}'))
            insert_point($row[mb_id], $board[bo_write_point] * (-1), "$board[bo_subject] $row[wr_id] {$lang[82]}");

        // 업로드된 파일이 있다면 파일삭제
        $sql2 = " select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$row[wr_id]' ";
        $result2 = sql_query($sql2);
        while ($row2 = sql_fetch_array($result2))
            @unlink("$g4[path]/data/file/$bo_table/$row2[bf_file]");
            
        // 파일테이블 행 삭제
        sql_query(" delete from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$row[wr_id]' ");

        $count_write++;
    } 
    else 
    {
        // 코멘트 포인트 삭제
        if (!delete_point($row[mb_id], $bo_table, $row[wr_id], '{$lang[255]}'))
            insert_point($row[mb_id], $board[bo_comment_point] * (-1), "$board[bo_subject] {$write[wr_id]}-{$row[wr_id]} {$lang[319]}");

        $count_comment++;
    }
}

// 게시글 삭제
sql_query(" delete from $write_table where wr_parent = '$write[wr_id]' ");

// 최근게시물 삭제
sql_query(" delete from $g4[board_new_table] where bo_table = '$bo_table' and wr_parent = '$write[wr_id]' ");

// 스크랩 삭제
sql_query(" delete from $g4[scrap_table] where bo_table = '$bo_table' and wr_id = '$write[wr_id]' ");

// 공지사항 삭제
$notice_array = explode("\n", trim($board[bo_notice]));
$bo_notice = "";
for ($k=0; $k<count($notice_array); $k++)
    if ((int)$write[wr_id] != (int)$notice_array[$k])
        $bo_notice .= $notice_array[$k] . "\n";
$bo_notice = trim($bo_notice);
sql_query(" update $g4[board_table] set bo_notice = '$bo_notice' where bo_table = '$bo_table' ");

// 글숫자 감소
if ($count_write > 0 || $count_comment > 0)
    sql_query(" update $g4[board_table] set bo_count_write = bo_count_write - '$count_write', bo_count_comment = bo_count_comment - '$count_comment' where bo_table = '$bo_table' ");

@include_once("$board_skin_path/delete.tail.skin.php");

goto_url("./board.php?bo_table=$bo_table&page=$page" . $qstr);
?>
