<?
include_once("./_common.php");

// 게시판 관리자 이상 복사, 이동 가능
if ($is_admin != 'board' && $is_admin != 'group' && $is_admin != 'super') 
    alert_close("게시판 관리자 이상 접근이 가능합니다.");

if ($sw != "move" && $sw != "copy")
    alert("sw 값이 제대로 넘어오지 않았습니다.");

include_once("$board_skin_path/mw.lib/mw.skin.basic.lib.php");

// 원본 파일 디렉토리
$src_dir = "$g4[path]/data/file/$bo_table";

$save = array();
$save_count_write = 0;
$save_count_comment = 0;
$cnt = 0;

// SQL Injection 으로 인한 코드 보완
//$sql = " select distinct wr_num from $write_table where wr_id in (" . stripslashes($wr_id_list) . ") order by wr_id ";
$sql = " select distinct wr_num from $write_table where wr_id in ($wr_id_list) order by wr_id ";
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) 
{
    $wr_num = $row[wr_num];
    for ($i=0; $i<count($_POST['chk_bo_table']); $i++) 
    {
        $move_bo_table = $_POST['chk_bo_table'][$i];
        $move_write_table = $g4['write_prefix'] . $move_bo_table;

        $src_dir = "$g4[path]/data/file/$bo_table"; // 원본 디렉토리
        $dst_dir = "$g4[path]/data/file/$move_bo_table"; // 복사본 디렉토리

        $count_write = 0;
        $count_comment = 0;

        $next_wr_num = get_next_num($move_write_table);

        //$sql2 = " select * from $write_table where wr_num = '$wr_num' order by wr_parent, wr_comment desc, wr_id ";
        $sql2 = " select * from $write_table where wr_num = '$wr_num' order by wr_parent, wr_is_comment, wr_comment desc, wr_id ";
        $result2 = sql_query($sql2);
        while ($row2 = sql_fetch_array($result2)) 
        {
            $nick = cut_str($member[mb_nick], $config[cf_cut_name]);
            if (!$row2[wr_is_comment] && $config[cf_use_copy_log]) 
                $row2[wr_content] .= " \n[이 게시물은 {$nick}님에 의해 $g4[time_ymdhis] {$board[bo_subject]}에서 " . ($sw == 'copy' ? '복사' : '이동') ." 됨]";

            $sql = " insert into $move_write_table
                        set wr_num            = '$next_wr_num',
                            wr_reply          = '$row2[wr_reply]',
                            wr_is_comment     = '$row2[wr_is_comment]',
                            wr_comment        = '$row2[wr_comment]',
                            wr_comment_reply  = '$row2[wr_comment_reply]',
                            ca_name           = '".addslashes($row2[ca_name])."',
                            wr_option         = '$row2[wr_option]',
                            wr_subject        = '".addslashes($row2[wr_subject])."',
                            wr_content        = '".addslashes($row2[wr_content])."',
                            wr_link1          = '".addslashes($row2[wr_link1])."',
                            wr_link2          = '".addslashes($row2[wr_link2])."',
                            wr_link1_hit      = '$row2[wr_link1_hit]',
                            wr_link2_hit      = '$row2[wr_link2_hit]',
                            wr_trackback      = '".addslashes($row2[wr_trackback])."',
                            wr_hit            = '$row2[wr_hit]',
                            wr_good           = '$row2[wr_good]',
                            wr_nogood         = '$row2[wr_nogood]',
                            mb_id             = '$row2[mb_id]',
                            wr_password       = '$row2[wr_password]',
                            wr_name           = '".addslashes($row2[wr_name])."',
                            wr_email          = '".addslashes($row2[wr_email])."',
                            wr_homepage       = '".addslashes($row2[wr_homepage])."',
                            wr_datetime       = '$row2[wr_datetime]',
                            wr_last           = '$row2[wr_last]',
                            wr_ip             = '$row2[wr_ip]',
                            wr_1              = '".addslashes($row2[wr_1])."',
                            wr_2              = '".addslashes($row2[wr_2])."',
                            wr_3              = '".addslashes($row2[wr_3])."',
                            wr_4              = '".addslashes($row2[wr_4])."',
                            wr_5              = '".addslashes($row2[wr_5])."',
                            wr_6              = '".addslashes($row2[wr_6])."',
                            wr_7              = '".addslashes($row2[wr_7])."',
                            wr_8              = '".addslashes($row2[wr_8])."',
                            wr_9              = '".addslashes($row2[wr_9])."',
                            wr_10             = '".addslashes($row2[wr_10])."' ";
            sql_query($sql);

            $insert_id = mysql_insert_id();

            // 코멘트가 아니라면
            if (!$row2[wr_is_comment]) 
            {
                $save_parent = $insert_id;

                $sql3 = " select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$row2[wr_id]' order by bf_no ";
                $result3 = sql_query($sql3);
                for ($k=0; $row3 = sql_fetch_array($result3); $k++) 
                {
                    $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

                    $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $row3[bf_source]);

                    shuffle($chars_array);
                    $shuffle = implode("", $chars_array);

                    $filename = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename))); 

                    if ($row3[bf_file]) 
                    {
                        // 원본파일을 복사하고 퍼미션을 변경
                        @copy("$src_dir/$row3[bf_file]", "$dst_dir/$filename");
                        @chmod("$dst_dir/$filename", 0606);
                    }

                    $sql = " insert into $g4[board_file_table] 
                                set bo_table = '$move_bo_table', 
                                    wr_id = '$insert_id', 
                                    bf_no = '$row3[bf_no]', 
                                    bf_source = '$row3[bf_source]', 
                                    bf_file = '$filename', 
                                    bf_download = '$row3[bf_download]', 
                                    bf_content = '".addslashes($row3[bf_content])."',
                                    bf_filesize = '$row3[bf_filesize]',
                                    bf_width = '$row3[bf_width]',
                                    bf_height = '$row3[bf_height]',
                                    bf_type = '$row3[bf_type]',
                                    bf_datetime = '$row3[bf_datetime]' ";
                    sql_query($sql);

                    if ($sw == "move" && $row3[bf_file])
                        $save[$cnt][bf_file][$k] = "$src_dir/$row3[bf_file]";
                }

                $count_write++;

                if ($sw == "move" && $i == 0) 
                {
                    // 스크랩 이동
                    sql_query(" update $g4[scrap_table] set bo_table = '$move_bo_table', wr_id = '$save_parent' where bo_table = '$bo_table' and wr_id = '$row2[wr_id]' ");

                    // 최신글 이동
                    sql_query(" update $g4[board_new_table] set bo_table = '$move_bo_table', wr_id = '$save_parent', wr_parent = '$save_parent' where bo_table = '$bo_table' and wr_id = '$row2[wr_id]' ");
                }
            } 
            else 
            {
                $sql3 = " select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$row2[wr_id]' order by bf_no ";
                $result3 = sql_query($sql3);
                for ($k=0; $row3 = sql_fetch_array($result3); $k++) 
                {
                    $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

                    $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $row3[bf_source]);

                    shuffle($chars_array);
                    $shuffle = implode("", $chars_array);

                    $filename = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename))); 

                    if ($row3[bf_file]) 
                    {
                        // 원본파일을 복사하고 퍼미션을 변경
                        @copy("$src_dir/$row3[bf_file]", "$dst_dir/$filename");
                        @chmod("$dst_dir/$filename", 0606);
                    }

                    $sql = " insert into $g4[board_file_table] 
                                set bo_table = '$move_bo_table', 
                                    wr_id = '$insert_id', 
                                    bf_no = '$row3[bf_no]', 
                                    bf_source = '$row3[bf_source]', 
                                    bf_file = '$filename', 
                                    bf_download = '$row3[bf_download]', 
                                    bf_content = '".addslashes($row3[bf_content])."',
                                    bf_filesize = '$row3[bf_filesize]',
                                    bf_width = '$row3[bf_width]',
                                    bf_height = '$row3[bf_height]',
                                    bf_type = '$row3[bf_type]',
                                    bf_datetime = '$row3[bf_datetime]' ";
                    sql_query($sql);

                    if ($sw == "move" && $row3[bf_file])
                        $save[$cnt][bf_file][$k] = "$src_dir/$row3[bf_file]";
                }


                $count_comment++;

                if ($sw == "move")
                {
                    // 최신글 이동
                    sql_query(" update $g4[board_new_table] set bo_table = '$move_bo_table', wr_id = '$insert_id', wr_parent = '$save_parent' where bo_table = '$bo_table' and wr_id = '$row2[wr_id]' ");
                }
            }

            sql_query(" update $move_write_table set wr_parent = '$save_parent' where wr_id = '$insert_id' ");

            if ($sw == "move")
                $save[$cnt][wr_id] = $row2[wr_parent];

            $sql = " update $move_write_table set ";
            $sql.= "  wr_ccl = '$row2[wr_ccl]' ";
            $sql.= ", wr_singo = '$row2[wr_singo]' ";
            $sql.= ", wr_zzal = '$row2[wr_zzal]' ";
            $sql.= ", wr_related = '$row2[wr_related]' ";
            $sql.= ", wr_comment_ban = '$row2[wr_comment_ban]' ";
            $sql.= ", wr_contents_price = '$row2[wr_contents_price]' ";
            $sql.= ", wr_contents_domain = '$row2[wr_contents_domain]' ";
            $sql.= ", wr_umz = '$row2[wr_umz]' ";
            $sql.= ", wr_subject_font = '$row2[wr_subject_font]' ";
            $sql.= ", wr_subject_color = '$row2[wr_subject_color]' ";
            $sql.= ", wr_anonymous = '$row2[wr_anonymous]' ";
            $sql.= ", wr_comment_hide = '$row2[wr_comment_hide]' ";
            $sql.= ", wr_read_level = '$row2[wr_read_level]' ";
            $sql.= ", wr_kcb_use = '$row2[wr_kcb_use]' ";
            $sql.= ", wr_qna_status = '$row2[wr_qna_status]' ";
            $sql.= ", wr_qna_point = '$row2[wr_qna_point]' ";
            $sql.= ", wr_qna_id = '$row2[wr_qna_id]' ";
            $sql.= " where wr_id = '$insert_id' ";
            sql_query($sql);

            if ($sw == "copy")
            {
                // 리워드
                $tmp = sql_fetch("select * from $mw[reward_table] where bo_table = '$bo_table' and wr_id = '$row2[wr_id]'");
                if ($tmp) {
                    $sql_common = "bo_table     = '$move_bo_table'";
                    $sql_common.= ", wr_id      = '$insert_id'";
                    $sql_common.= ", re_site    = '".addslashes($tmp[re_site])."'";
                    $sql_common.= ", re_point   = '$tmp[re_point]'";
                    $sql_common.= ", re_url     = '".addslashes($tmp[re_url])."'";
                    $sql_common.= ", re_edate   = '$tmp[re_edate]'";
                    sql_query("insert into $mw[reward_table] set $sql_common, re_status = '1'");
                }

                // 설문
                $tmp = sql_fetch("select * from $mw[vote_table] where bo_table = '$bo_table' and wr_id = '$row2[wr_id]'");
                if ($tmp) {
                    $vt_id = $tmp[vt_id];

                    $sql = "insert into $mw[vote_table] set bo_table = '$move_bo_table'";
                    $sql.= ", wr_id = '$insert_id' ";
                    $sql.= ", vt_edate = '$tmp[vt_edate]' ";
                    $sql.= ", vt_total = '$tmp[vt_total]' ";
                    $sql.= ", vt_point = '$tmp[vt_point]' ";
                    sql_query($sql);

                    $insert_vt_id = mysql_insert_id();

                    $qry = sql_query("select * from $mw[vote_item_table] where vt_id = '$vt_id' order by vt_num");
                    while ($tmp = sql_fetch_array($qry)) {
                        sql_query("insert into $mw[vote_item_table] set vt_id = '$insert_vt_id', vt_num = '$tmp[vt_num]', vt_item = '$tmp[vt_item]', vt_hit = '$tmp[vt_hit]'");
                    }

                    $qry = sql_query("select * from $mw[vote_log_table] where vt_id = '$tmp[vt_id]' order by vt_num");
                    while ($tmp = sql_fetch_array($qry)) {
                        sql_query("insert into $mw[vote_log_table] set vt_id = '$insert_vt_id', vt_num = '$tmp[vt_num]', mb_id = '$tmp[mb_id]', vt_ip = '$tmp[vt_ip]', vt_datetime = '$tmp[vt_datetime]'");
                    }
                }

                // 썸네일 삭제
                @unlink("$thumb_path/$row2[wr_id]");
                @unlink("$thumb2_path/$row2[wr_id]");
                @unlink("$thumb3_path/$row2[wr_id]");

                // 워터마크 삭제
                $sql = "select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$row2[wr_id]' and bf_width > 0  order by bf_no";
                $qry = sql_query($sql);
                while ($file = sql_fetch_array($qry)) {
                    @unlink("$watermark_path/$row[bf_file]");
                }

                // 글 변경로그
                $qry = sql_query("select * from $mw[post_history_table] where bo_table = '$bo_table' and wr_id = '$row2[wr_id]' order by ph_id");
                while ($tmp = sql_fetch_array($qry)) {
                    $sql_common = "bo_table         = '$move_bo_table'";
                    $sql_common.= ", wr_id          = '$insert_id'";
                    $sql_common.= ", wr_parent      = '$tmp[wr_parent]'";
                    $sql_common.= ", mb_id          = '$tmp[mb_id]'";
                    $sql_common.= ", ph_name        = '$tmp[ph_name]'";
                    $sql_common.= ", ph_option      = '$tmp[ph_option]'";
                    $sql_common.= ", ph_subject     = '".addslashes($tmp[ph_subject])."'";
                    $sql_common.= ", ph_content     = '".addslashes($tmp[ph_content])."'";
                    $sql_common.= ", ph_ip          = '$tmp[ph_ip]'";
                    $sql_common.= ", ph_datetime    = '$tmp[ph_datetime]'";
                    sql_query("insert into $mw[post_history_table] set $sql_common");
                }

                // 다운로드 로그
                $qry = sql_query("select * from $mw[download_log_table] where bo_table = '$bo_table' and wr_id = '$row2[wr_id]' order by dl_id");
                while ($tmp = sql_fetch_array($qry)) {
                    $sql_common = "bo_table         = '$move_bo_table'";
                    $sql_common.= ", wr_id          = '$insert_id'";
                    $sql_common.= ", mb_id          = '$tmp[mb_id]'";
                    $sql_common.= ", bf_no          = '$tmp[bf_no]'";
                    $sql_common.= ", dl_name        = '$tmp[dl_name]'";
                    $sql_common.= ", dl_ip          = '$tmp[dl_ip]'";
                    $sql_common.= ", dl_datetime    = '$tmp[dl_datetime]'";
                    sql_query("insert into $mw[download_log_table] set $sql_common");
                }
            }

            if ($sw == "move")
            {
                // 리워드
                sql_query("update $mw[reward_table] set bo_table = '$move_bo_table', wr_id = '$insert_id' where bo_table = '$bo_table' and wr_id = '$row2[wr_id]'", false);
                sql_query("update from $mw[reward_log_table] set bo_table = '$move_bo_table', wr_id = '$insert_id'  where bo_table = '$bo_table' and wr_id = '$row2[wr_id]'", false);
                // 설문
                sql_query("update $mw[vote_table] set bo_table = '$move_bo_table', wr_id = '$insert_id' where bo_table = '$bo_table' and wr_id = '$row2[wr_id]'");

                // 썸네일 삭제
                @unlink("$thumb_path/$row2[wr_id]");
                @unlink("$thumb2_path/$row2[wr_id]");
                @unlink("$thumb3_path/$row2[wr_id]");

                // 워터마크 삭제
                $sql = "select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$row2[wr_id]' and bf_width > 0  order by bf_no";
                $qry = sql_query($sql);
                while ($file = sql_fetch_array($qry)) {
                    @unlink("$watermark_path/$row[bf_file]");
                }

                // 글 변경로그
                sql_query("update $mw[post_history_table] set bo_table = '$move_bo_table', wr_id = '$insert_id' where bo_table = '$bo_table' and wr_id = '$row2[wr_id]'");

                // 다운로드 로그
                sql_query("update $mw[download_log_table] set bo_table = '$move_bo_table', wr_id = '$insert_id' where bo_table = '$bo_table' and wr_id = '$row2[wr_id]'");
            }

            // 모아보기 삭제
            if (function_exists('mw_moa_delete')) mw_moa_delete($row2[wr_id]);

            // 팝업공지 삭제
            sql_query("delete from $mw[popup_notice_table] where bo_table = '$bo_table' and wr_id = '$row2[wr_id]' ", false);

            $cnt++;
        }


        sql_query(" update $g4[board_table] set bo_count_write   = bo_count_write   + '$count_write'   where bo_table = '$move_bo_table' ");
        sql_query(" update $g4[board_table] set bo_count_comment = bo_count_comment + '$count_comment' where bo_table = '$move_bo_table' ");
    }

    $save_count_write += $count_write;
    $save_count_comment += $count_comment;
}

if ($sw == "move") 
{
    for ($i=0; $i<count($save); $i++) 
    {
        for ($k=0; $k<count($save[$i][bf_file]); $k++)
            @unlink($save[$i][bf_file][$k]);    

        sql_query(" delete from $write_table where wr_parent = '{$save[$i][wr_id]}' ");
        sql_query(" delete from $g4[board_new_table] where bo_table = '$bo_table' and wr_id = '{$save[$i][wr_id]}' ");
        sql_query(" delete from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '{$save[$i][wr_id]}' ");
    }
    sql_query(" update $g4[board_table] set bo_count_write = bo_count_write - '$save_count_write', bo_count_comment = bo_count_comment - '$save_count_comment' where bo_table = '$bo_table' ");
}

$msg = "해당 게시물을 선택한 게시판으로 $act 하였습니다.";
$opener_href = "$g4[bbs_path]/board.php?bo_table=$bo_table&page=$page&$qstr";

echo <<<HEREDOC
<meta http-equiv='content-type' content='text/html; charset={$g4['charset']}'> 
<script type="text/javascript">
alert("{$msg}");
opener.document.location.href = "{$opener_href}";
window.close();
</script>
HEREDOC;
?>
