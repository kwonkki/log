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

// CCL 정보 업데이트
$wr_ccl = "";
if ($wr_ccl_by == "by") { $wr_ccl .= "by"; }
if ($wr_ccl_nc == "nc") { $wr_ccl .= $wr_ccl ? "-": ""; $wr_ccl .= "nc"; }
if ($wr_ccl_nd == "nd") { $wr_ccl .= $wr_ccl ? "-": ""; $wr_ccl .= "nd"; }
if ($wr_ccl_nd == "sa") { $wr_ccl .= $wr_ccl ? "-": ""; $wr_ccl .= "sa"; }
sql_query("update $write_table set wr_ccl = '$wr_ccl' where wr_id = '$wr_id'");

// 질문 업데이트
if ($mw_basic[cf_attribute] == 'qna')
{
    if ($w == '') {
        sql_query("update $write_table set wr_qna_point = '$wr_qna_point', wr_qna_status = '0' where wr_id = '$wr_id'");
        insert_point($mb_id, $wr_qna_point*-1, "질문 포인트", $bo_table, $wr_id, '@qna');
    }

    if (!$wr_qna_status) $wr_qna_status = '0';
    if (!$wr_qna_status && $notice && $is_admin) $wr_qna_status = '1';
    if ($is_admin) sql_query("update $write_table set wr_qna_status = '$wr_qna_status' where wr_id = '$wr_id'");
}

// 실명인증
if ($mw_basic[cf_kcb_post] && $mw_basic[cf_kcb_post_level] <= $member[mb_level]) {
    sql_query("update $write_table set wr_kcb_use = '$wr_kcb_use' where wr_id = '$wr_id'");
}

// 짤방 업데이트
if ($mw_basic[cf_zzal]) {
    sql_query("update $write_table set wr_zzal = '$wr_zzal' where wr_id = '$wr_id'");
}

// 관련글 업데이트
if ($mw_basic[cf_related]) {
    sql_query("update $write_table set wr_related = '$wr_related' where wr_id = '$wr_id'");
}

// 코멘트 허락
if ($mw_basic[cf_comment_ban] && $mw_basic[cf_comment_ban_level] <= $member[mb_level]) {
    sql_query("update $write_table set wr_comment_ban = '$wr_comment_ban' where wr_id = '$wr_id'");
}

// 로그남김
if ($w == "u" && $mw_basic[cf_post_history]) {
    $wr_name2 = $board[bo_use_name] ? $member[mb_name] : $member[mb_nick];
    $sql = "insert into $mw[post_history_table]
               set bo_table = '$bo_table'
                   ,wr_id = '$wr_id'
                   ,wr_parent = '$write[wr_parent]'
                   ,mb_id = '$member[mb_id]'
                   ,ph_name = '$wr_name2'
                   ,ph_option = '$write[wr_option]'
                   ,ph_subject = '".addslashes($write[wr_subject])."'
                   ,ph_content = '".addslashes($write[wr_content])."'
                   ,ph_ip = '$_SERVER[REMOTE_ADDR]'
                   ,ph_datetime = '$g4[time_ymdhis]'";
    sql_query($sql);
}

// 지업로더
if ($mw_basic[cf_guploader] == "1" && $is_member) // 싱글모드
{
    $sql = "select * from $mw[guploader_table] where bo_table = '$bo_table' and mb_id = '$member[mb_id]' and bf_ip = '$_SERVER[REMOTE_ADDR]' order by bf_no";
    $qry = sql_query($sql, false);
    for ($i=0; $row=sql_fetch_array($qry); $i++) {
        $source = "$g4[path]/data/guploader/$row[bf_file]";
        $dest = "$g4[path]/data/file/$bo_table/$row[bf_file]";
        @copy($source, $dest);
        @unlink($source);
        sql_query("insert into $g4[board_file_table]
                   set bo_table = '$bo_table'
                     , wr_id = '$wr_id'
                     , bf_no = '$i'
                     , bf_source = '$row[bf_source]'
                     , bf_file = '$row[bf_file]'
                     , bf_filesize = '$row[bf_filesize]'
                     , bf_width = '$row[bf_width]'
                     , bf_height = '$row[bf_height]'
                     , bf_type = '$row[bf_type]'
                     , bf_datetime = '$row[bf_datetime]'");
    }
    sql_query("delete from $mw[guploader_table] where bo_table = '$bo_table' and mb_id = '$member[mb_id]' and bf_ip = '$_SERVER[REMOTE_ADDR]'", false);
}

// 원본 강제 리사이징
if ($mw_basic[cf_original_width] && $mw_basic[cf_original_height]) {
    $sql = "select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_width > 0  order by bf_no";
    $qry = sql_query($sql);
    while ($row = sql_fetch_array($qry)) {
        $file = "$file_path/$row[bf_file]";
        $size = getImageSize($file);
        if ($size[0] > $mw_basic[cf_original_width] || $mw_basic[cf_original_height] < $size[1]) {
            mw_make_thumbnail($mw_basic[cf_original_width], $mw_basic[cf_original_height], $file, $file, true);
            $size = getImageSize($file);
        }
        sql_query("update $g4[board_file_table] set bf_width = '$size[0]', bf_height = '$size[1]',
            bf_filesize = '".filesize($file)."'
            where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$row[bf_no]'");
    }
}

// 첨부이미지 사이즈 사용자 변경
if ($mw_basic[cf_change_image_size] && $member[mb_level] >= $mw_basic[cf_change_image_size_level] && $change_image_size) {
    $sql = "select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_width > 0  order by bf_no";
    $qry = sql_query($sql);
    while ($row = sql_fetch_array($qry)) {
        $file = "$file_path/$row[bf_file]";
        mw_make_thumbnail($change_image_size, $change_image_size, $file, $file, true);
        $size = getImageSize($file);
        sql_query("update $g4[board_file_table] set bf_width = '$size[0]', bf_height = '$size[1]',
            bf_filesize = '".filesize($file)."'
            where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$row[bf_no]'");
    }
}

// 섬네일 생성, 무조건 생성으로 변경 (1.0.6)
//if ($mw_basic[cf_type] != "list") {

// 첫번째 첨부이미지 본문 출력 안할시 (1.1.2);
// 삭제 (1.2.5);
/*if ($mw_basic[cf_img_1_noview]) {
    $file = mw_get_first_file($bo_table, $wr_id, true);
    if (!empty($file)) {
        $source_file = "$file_path/{$file[bf_file]}";
        $dest_file = "$thumb_path/{$wr_id}"; 
        @copy($source_file, $dest_file);
    }
}
else
{*/
    $thumb_file = "";
    $file = mw_get_first_file($bo_table, $wr_id, true);
    if (!empty($file)) {
        $source_file = "$file_path/{$file[bf_file]}";
        $thumb_file = "$thumb_path/{$wr_id}";
        mw_make_thumbnail($mw_basic[cf_thumb_width], $mw_basic[cf_thumb_height], $source_file, $thumb_file, $mw_basic[cf_thumb_keep]);
        if ($mw_basic[cf_thumb2_width])
            @mw_make_thumbnail($mw_basic[cf_thumb2_width], $mw_basic[cf_thumb2_height], $source_file, "{$thumb2_path}/{$wr_id}", $mw_basic[cf_thumb2_keep]);
        if ($mw_basic[cf_thumb3_width])
            @mw_make_thumbnail($mw_basic[cf_thumb3_width], $mw_basic[cf_thumb3_height], $source_file, "{$thumb3_path}/{$wr_id}", $mw_basic[cf_thumb3_keep]);
    } else {
        $thumb_file = "$thumb_path/{$wr_id}";
        preg_match("/<img.*src=\\\"(.*)\\\"/iUs", stripslashes($wr_content), $match);
        if ($match[1]) {
            $match[1] = str_replace($g4[url], "..", $match[1]);
            if (file_exists($match[1])) {
                mw_make_thumbnail($mw_basic[cf_thumb_width], $mw_basic[cf_thumb_height], $match[1], $thumb_file, $mw_basic[cf_thumb_keep]);
                if ($mw_basic[cf_thumb2_width])
                    @mw_make_thumbnail($mw_basic[cf_thumb2_width], $mw_basic[cf_thumb2_height], $match[1], "{$thumb2_path}/{$wr_id}", $mw_basic[cf_thumb2_keep]);
                if ($mw_basic[cf_thumb3_width])
                    @mw_make_thumbnail($mw_basic[cf_thumb3_width], $mw_basic[cf_thumb3_height], $match[1], "{$thumb3_path}/{$wr_id}", $mw_basic[cf_thumb3_keep]);
            }
        } else {
            @unlink($thumb_file);
        }
    }
//}
//}

// 원본 워터마크
for ($i=0, $m=sizeof($watermark_files); $i<$m; $i++) // 기존 원터마크 파일 삭제
    unlink($watermark_files[$i]);

if ($mw_basic[cf_watermark_use] && file_exists($mw_basic[cf_watermark_path]))
{
    $sql = "select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_width > 0  order by bf_no";
    $qry = sql_query($sql);
    while ($row = sql_fetch_array($qry))
        mw_watermark_file("$file_path/$row[bf_file]");
}

// 메일발송 사용 (수정글은 발송하지 않음)
if (!($w == "u" || $w == "cu") && $config[cf_email_use])
{
    $emails = explode("\n", $mw_basic[cf_email]);

    if (count($emails) > 0)
    {
        $wr_subject = get_text(stripslashes($wr_subject));

        $tmp_html = 0;
        if (strstr($html, "html1"))
            $tmp_html = 1;
        else if (strstr($html, "html2"))
            $tmp_html = 2;

        $wr_content = conv_content(stripslashes($wr_content), $tmp_html);

        $warr = array( ""=>"입력", "u"=>"수정", "r"=>"답변", "c"=>"코멘트", "cu"=>"코멘트 수정" );
        $str = $warr[$w];

        $subject = "'{$board[bo_subject]}' 게시판에 {$str}글이 올라왔습니다.";
        $link_url = "$g4[url]/$g4[bbs]/board.php?bo_table=$bo_table&wr_id=$wr_id&$qstr";

        include_once("$g4[path]/lib/mailer.lib.php");

        ob_start();
        include ("$g4[bbs_path]/write_update_mail.php");
        $content = ob_get_contents();
        ob_end_clean();

        foreach ($emails as $email)
        {
            $email = trim($email);
            if (!$email) continue;
            if ($email == "test@test.com") continue;
            mailer($wr_name, $wr_email, $email, $subject, $content, 1);
	    write_log("$g4[path]/data/mail.log", "$email\n");
        }
    }
}

// SMS 전송
if ($w == "" && $mw_basic[cf_sms_id] && $mw_basic[cf_sms_pw] && trim($mw_basic[cf_hp]) && $is_admin != "super")
{
    $strDest = array();
    $hps = explode("\r\n", $mw_basic[cf_hp]);
    foreach ($hps as $hp) {
        $hp = mw_get_hp($hp, 0);
        if (trim($hp)) {
            $strDest[] = $hp;
        }
    }
    $strCallBack = "0000";
    $strData = "{$board[bo_subject]} 게시판에 {$wr_name} 님이 글을 올리셨습니다.";
    include("$board_skin_path/mw.proc/mw.proc.sms.php");
}

//컨텐츠 가격 및 사용도메인
if ($mw_basic[cf_contents_shop]) {
    sql_query("update $write_table set wr_contents_price = '$wr_contents_price', wr_contents_domain = '$wr_contents_domain' where wr_id = '$wr_id'");
}

// 짧은 글주소 사용
if ($mw_basic[cf_umz]) {
    $url = "$g4[url]/$g4[bbs]/board.php?bo_table=$bo_table&wr_id=$wr_id";
    $umz = umz_get_url($url);
    sql_query("update $write_table set wr_umz = '$umz' where wr_id = '$wr_id'");
}

// 제목 스타일
if ($mw_basic[cf_subject_style] && $mw_basic[cf_subject_style_level] <= $member[mb_level]) {
    sql_query("update $write_table set wr_subject_font = '$wr_subject_font', wr_subject_color = '$wr_subject_color' where wr_id = '$wr_id'");
}

// 설문 
if ($mw_basic[cf_vote] && $mw_basic[cf_vote_level] <= $member[mb_level])
{
    $tmp = array();
    for ($i=0, $m=sizeof($vt_item); $i<$m; $i++) {
        if (trim($vt_item[$i])) {
            $tmp[] = strip_tags(trim($vt_item[$i]));
        }
    }
    $vt_item = $tmp;
    if ($w == "" && sizeof($vt_item)) {
        $sql = "insert into $mw[vote_table] set bo_table = '$bo_table', wr_id = '$wr_id', vt_edate = '$vt_edate', vt_point = '$vt_point'";
        $qry = sql_query($sql);
        $vt_id = mysql_insert_id();

        for ($i=0, $m=sizeof($vt_item); $i<$m; $i++) {
            $sql = "insert into $mw[vote_item_table] set vt_id = '$vt_id', vt_num = '$i', vt_item = '{$vt_item[$i]}'";
            $qry = sql_query($sql);
        }
    }
    //else if ($w == "u" && sizeof($vt_item)) {
    else if ($w == "u") {

        $sql = "select vt_id from $mw[vote_table] where bo_table = '$bo_table' and wr_id = '$wr_id'";
        $row = sql_fetch($sql);
        if (!$row) {
            $sql = "insert into $mw[vote_table] set bo_table = '$bo_table', wr_id = '$wr_id', vt_edate = '$vt_edate', vt_point = '$vt_point'";
            $qry = sql_query($sql);
            $vt_id = mysql_insert_id();
        } else {
            $vt_id = $row[vt_id];

            $sql = "update $mw[vote_table] set vt_edate = '$vt_edate', vt_point = '$vt_point' where bo_table = '$bo_table' and wr_id = '$wr_id'";
            $qry = sql_query($sql);
        }

        for ($i=0, $m=sizeof($vt_item); $i<$m; $i++) {
            $sql = "select * from $mw[vote_item_table] where vt_id = '$vt_id' and vt_num = '$i'";
            $row = sql_fetch($sql);

            if ($row) {
                $sql = "update $mw[vote_item_table] set vt_item = '{$vt_item[$i]}' where vt_id = '$vt_id' and vt_num = '$i' ";
                $qry = sql_query($sql);
            } else {
                $sql = "insert into $mw[vote_item_table] set vt_id = '$vt_id', vt_num = '$i', vt_item = '{$vt_item[$i]}'";
                $qry = sql_query($sql);
            }
        }
        $sql = "delete from $mw[vote_item_table] where vt_id = '$vt_id' and vt_num >= '$i'";
        $qry = sql_query($sql);

        $sql = "delete from $mw[vote_log_table] where vt_id = '$vt_id' and vt_num >= '$i'";
        $qry = sql_query($sql);

        if (!$i) sql_query("delete from $mw[vote_table] where vt_id = '$vt_id'");
    }
    else if (!sizeof($vt_item)) {
        $sql = "delete from $mw[vote_table] where vt_id = '$vt_id'";
        $qry = sql_query($sql);

        $sql = "delete from $mw[vote_item_table] where vt_id = '$vt_id'";
        $qry = sql_query($sql);

        $sql = "delete from $mw[vote_log_table] where vt_id = '$vt_id'";
        $qry = sql_query($sql);
    }
}

// 리워드
if ($mw_basic[cf_reward])
{
    $sql_common = "bo_table = '$bo_table'";
    $sql_common.= ", wr_id = '$wr_id'";
    $sql_common.= ", re_site = '$re_site'";
    $sql_common.= ", re_point = '$re_point'";
    $sql_common.= ", re_url = '$re_url'";
    $sql_common.= ", re_edate = '$re_edate'";

    if ($w == "") {
        $sql = "insert into $mw[reward_table] set $sql_common, re_status = '1'";
        $qry = sql_query($sql);
    } else {
        $sql = "update $mw[reward_table] set $sql_common, re_status = '$re_status' where bo_table = '$bo_table' and wr_id = '$wr_id'";
        $qry = sql_query($sql);
    }
}

// 익명
if ($mw_basic[cf_anonymous]) {
    sql_query(" update $write_table set wr_anonymous = '$wr_anonymous' where wr_id = '$wr_id' ");
}

// 글읽기 레벨
if ($mw_basic[cf_read_level] && $mw_basic[cf_read_level_own] <= $member[mb_level]) {
    sql_query(" update $write_table set wr_read_level = '$wr_read_level' where wr_id = '$wr_id' ");
}

?>
