<?
/**
 * Bechu-Basic Skin for Gnuboard4
 *
 * Copyright (c) 2008 Choi Jae-Young <www.miwit.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 거꾸로 읽는 이유는 답변글부터 삭제가 되어야 하기 때문임
for ($i=count($tmp_array)-1; $i>=0; $i--) 
{
    $write = sql_fetch(" select * from $write_table where wr_id = '{$tmp_array[$i]}' ");

    if ($is_admin == "super") // 최고관리자 통과
        ;
    else if ($is_admin == "group") // 그룹관리자
    {
        $mb = get_member($write[mb_id]);
        if ($member[mb_id] == $group[gr_admin]) // 자신이 관리하는 그룹인가?
        {
            if ($member[mb_level] >= $mb[mb_level]) // 자신의 레벨이 크거나 같다면 통과
                ;
            else
                continue;
        } 
        else
            continue;
    } 
    else if ($is_admin == "board") // 게시판관리자이면
    {
        $mb = get_member($write[mb_id]);
        if ($member[mb_id] == $board[bo_admin]) // 자신이 관리하는 게시판인가?
            if ($member[mb_level] >= $mb[mb_level]) // 자신의 레벨이 크거나 같다면 통과
                ;
            else
                continue;
        else
            continue;
    } 
    else if ($member[mb_id] && $member[mb_id] == $write[mb_id]) // 자신의 글이라면
    {
        ;
    } 
    else if ($wr_password && !$write[mb_id] && sql_password($wr_password) == $write[wr_password]) // 패스워드가 같다면
    {
        ;
    } 
    else
        continue;   // 나머지는 삭제 불가

    $wr_id = $tmp_array[$i];

    // 로그 지움
    $row = sql_fetch(" select wr_parent from $write_table where wr_id = '$wr_id' ");
    sql_query("delete from $mw[post_history_table] where wr_parent = '$row[wr_parent]'");

    // 설문 지움
    $row = sql_fetch("select vt_id from $mw[vote_table] where bo_table = '$bo_table' and wr_id = '$wr_id'");
    sql_query("delete from $mw[vote_item_table] where vt_id = '$row[vt_id]'");
    sql_query("delete from $mw[vote_log_table] where vt_id = '$row[vt_id]'");
    sql_query("delete from $mw[vote_table] where vt_id = '$row[vt_id]'");

    // 리워드 지움
    sql_query("delete from $mw[reward_table] where bo_table = '$bo_table' and wr_id = '$wr_id'", false);
    sql_query("delete from $mw[reward_log_table] where bo_table = '$bo_table' and wr_id = '$wr_id'", false);

    // 팝업공지 삭제
    sql_query("delete from $mw[popup_notice_table] where bo_table = '$bo_table' and wr_id = '$wr_id' ", false);

    // 코멘트 첨부파일 지움
    $sql = "select * from $write_table where wr_parent = '$wr_id' and wr_is_comment = '1'";
    $qry = sql_query($sql);
    while ($row = sql_fetch_array($qry)) {
        // 업로드된 파일이 있다면 파일삭제
        $sql2 = " select * from $mw[comment_file_table] where bo_table = '$bo_table' and wr_id = '$row[wr_id]' ";
        $qry2 = sql_query($sql2);
        while ($row2 = sql_fetch_array($qry2))
            @unlink("$g4[path]/data/file/$bo_table/$row2[bf_file]");
            
        // 파일테이블 행 삭제
        sql_query(" delete from $mw[comment_file_table] where bo_table = '$bo_table' and wr_id = '$row[wr_id]' ");
    }

    // 썸네일 삭제
    $thumb_file = "$thumb_path/{$wr_id}";
    if (file_exists($thumb_file)) @unlink($thumb_file);

    $thumb_file = "$thumb2_path/{$wr_id}";
    if (file_exists($thumb_file)) @unlink($thumb_file);

    $thumb_file = "$thumb3_path/{$wr_id}";
    if (file_exists($thumb_file)) @unlink($thumb_file);

    // 워터마크 삭제
    $sql = "select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_width > 0  order by bf_no";
    $qry = sql_query($sql);
    while ($row = sql_fetch_array($qry)) {
        @unlink("$watermark_path/$row[bf_file]");
    }

    // 에디터 이미지 및 워터마크 삭제
    $sql = "select * from $write_table where wr_parent = '$wr_id'";
    $qry = sql_query($sql);
    while ($row = sql_fetch_array($qry)) {
        mw_delete_editor_image($row[wr_content]);
    }

    // 모아보기 삭제
    if (function_exists('mw_moa_delete')) mw_moa_delete($wr_id);
}

?>
