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

if ($mw_basic[cf_contents_shop] == "1") { // 배추컨텐츠샵
    if (!$is_member)
	alert("로그인 해주세요.");

    //if (!mw_is_buy_contents($member[mb_id], $bo_table, $wr_id) && $is_admin != "super")
    $con = mw_is_buy_contents($member[mb_id], $bo_table, $wr_id);
    if (!$con)
    {
	alert("결제 후 다운로드 하실 수 있습니다.");
    }
    else
    {
        if ($mw_basic[cf_contents_shop_download_count]) {
            $sql1 = "select count(*) as cnt from $mw_cash[cash_list_table] where rel_table = '$bo_table' and rel_id = '$wr_id' and cl_cash < 0";
            $row1 = sql_fetch($sql1);
            $sql2 = "select count(*) as cnt from $mw[download_log_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and dl_datetime > '$con[cl_datetime]'";
            $row2 = sql_fetch($sql2);
            if ($row2[cnt] >= ($mw_basic[cf_contents_shop_download_count])) {
                alert("다운로드 횟수 ($mw_basic[cf_contents_shop_download_count]회) 를 넘었습니다.\\n\\n재결제 후 다운로드 할 수 있습니다.");
            }
        }

        if ($mw_basic[cf_contents_shop_download_day]) {
            $gap = floor(($g4[server_time] - strtotime($con[cl_datetime])) / (60*60*24));
            if ($gap >= $mw_basic[cf_contents_shop_download_day]) {
                alert("다운로드 기간 ($mw_basic[cf_contents_shop_download_day]일) 이 지났습니다.\\n\\n재결제 후 다운로드 할 수 있습니다.");
            }
        }
    }
}

// 컨텐츠샵 멤버쉽
if (function_exists("mw_cash_is_membership")) {
    $is_membership = @mw_cash_is_membership($member[mb_id], $bo_table, "mp_down");
    if ($is_membership == "no")
        ;
    else if ($is_membership != "ok")
        mw_cash_alert_membership($is_membership);
}

if ($mw_basic[cf_download_comment] && !$is_admin) { // 코멘트 남겨야 다운로드 가능
    if ($is_member) {
	$sql = "select wr_id from $write_table where wr_parent = '$wr_id' and wr_is_comment = 1 and mb_id = '$member[mb_id]'";
    } else {
	$sql = "select wr_id from $write_table where wr_parent = '$wr_id' and wr_is_comment = 1 and wr_ip = '$_SERVER[REMOTE_ADDR]'";
    }
    $row = sql_fetch($sql);
    if (!$row) {
        alert("코멘트를 남겨야 다운로드가 가능합니다.");
    }
}

// 이미 다운로드 받은 파일인지를 검사한 후 게시물당 한번만 포인트를 차감하도록 수정
$ss_name = "ss_down_{$bo_table}_{$wr_id}";
if (!get_session($ss_name))
{
    // 자신의 글이라면 통과
    // 관리자인 경우 통과
    if (($write[mb_id] && $write[mb_id] == $member[mb_id]) || $is_admin)
        ;
    else if ($board[bo_download_level] > 1) // 회원이상 다운로드가 가능하다면
    {
        // 다운로드 포인트가 음수이고 회원의 포인트가 0 이거나 작다면
        if ($member[mb_point] + $board[bo_download_point] < 0)
            alert("보유하신 포인트(".number_format($member[mb_point]).")가 없거나 모자라서 다운로드(".number_format($board[bo_download_point]).")가 불가합니다.\\n\\n포인트를 적립하신 후 다시 다운로드 해 주십시오.");

        // 게시물당 한번만 차감하도록 수정
        insert_point($member[mb_id], $board[bo_download_point], "$board[bo_subject] $wr_id 파일 다운로드", $bo_table, $wr_id, "다운로드");
    }

    if (!$is_admin) { // 관리자는 카운트 증가 안함
        // 다운로드 카운트 증가
        $sql = " update $g4[board_file_table] set bf_download = bf_download + 1 where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$no' ";
        sql_query($sql);
    }

    set_session($ss_name, TRUE);
}

if ($mw_basic[cf_uploader_point]) { // 업로더 포인트 제공
    $wr_name = $board[bo_use_name] ? $member[mb_name] : $member[mb_nick];
    $eval = 'insert_point($write[mb_id], $mw_basic[cf_uploader_point], "{$wr_name}님이 $board[bo_subject] $wr_id 파일 다운로드", $bo_table, $wr_id, "$member[mb_id] 다운로드");';
    if ($member[mb_id] == $write[mb_id]) // 본인 다운로드 제외
        ;
    elseif ($mw_basic[cf_uploader_day] > 0) { //기간제한
        $old = strtotime($write[wr_datetime]);
        $now = $g4[server_time];
        $gap = (int)(($now - $old) / 86400);
        if ($gap <= $mw_basic[cf_uploader_day]) {
            eval($eval);
        }
    } else {
        eval($eval);
    }
}

if ($mw_basic[cf_download_log]) { // 다운로드 기록
    $dl_name = $board[bo_use_name] ? $member[mb_name] : $member[mb_nick];
    $sql = "insert into $mw[download_log_table]
               set bo_table = '$bo_table'
                   , wr_id = '$wr_id'
                   , bf_no = '$no'
                   , mb_id = '$member[mb_id]'
                   , dl_name = '$dl_name'
                   , dl_ip = '$_SERVER[REMOTE_ADDR]'
                   , dl_datetime = '$g4[time_ymdhis]'";
    $qry = sql_query($sql, false);
    if (!$qry) { // 테이블 생성시 dl_name 필드가 빠져서 추가함 v.1.0.2 버그
        sql_query("alter table $mw[download_log_table] add dl_name varchar(20) not null after mb_id", false);
        sql_query($sql);
    }
}

$g4[title] = "$group[gr_subject] > $board[bo_subject] > " . conv_subject($write[wr_subject], 255) . " > 다운로드";

if (preg_match("/^utf/i", $g4[charset]))
    $original = urlencode($file[bf_source]);
else
    $original = $file[bf_source];

@include_once("$board_skin_path/download.tail.skin.php");

if(preg_match("/msie/i", $_SERVER[HTTP_USER_AGENT]) && preg_match("/5\.5/", $_SERVER[HTTP_USER_AGENT])) {
    header("content-type: doesn/matter");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-transfer-encoding: binary");
} else {
    header("content-type: file/unknown");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-description: php generated data");
}
header("pragma: no-cache");
header("expires: 0");
flush();

$fp = fopen("$filepath", "rb");

// 4.00 대체
// 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 방법보다는 이방법이...
//if (!fpassthru($fp)) {
//    fclose($fp);
//}

while(!feof($fp)) { 
    echo fread($fp, 100*1024); 
    flush(); 
} 
fclose ($fp); 
flush();
exit;
?>
