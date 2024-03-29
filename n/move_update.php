<?
include_once("./_common.php");

// 게시판 관리자 이상 복사, 이동 가능
if ($is_admin != 'board' && $is_admin != 'group' && $is_admin != 'super') 
    alert_close("{$lang[399]}");

if ($sw != "move" && $sw != "copy")
    alert("sw {$lang[355]}");

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

        $sql2 = " select * from $write_table where wr_num = '$wr_num' order by wr_parent, wr_comment desc, wr_id ";
        $result2 = sql_query($sql2);
        while ($row2 = sql_fetch_array($result2)) 
        {
            $nick = cut_str($member[mb_nick], $config[cf_cut_name]);
            if (!$row2[wr_is_comment] && $config[cf_use_copy_log]) 
				$row2[wr_content] .= " \n[{$lang[403]} {$nick}{$lang[404]} $g4[time_ymdhis] {$board[bo_subject]}{$lang[405]} " . ($sw == 'copy' ? '{$lang[398]}' : '{$lang[397]}') ." {$lang[406]}]";

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
                    if ($row3[bf_file]) 
                    {
                        // 원본파일을 복사하고 퍼미션을 변경
                        @copy("$src_dir/$row3[bf_file]", "$dst_dir/$row3[bf_file]");
                        @chmod("$dst_dir/$row3[bf_file]", 0606);
                    }

                    $sql = " insert into $g4[board_file_table] 
                                set bo_table = '$move_bo_table', 
                                    wr_id = '$insert_id', 
                                    bf_no = '$row3[bf_no]', 
                                    bf_source = '$row3[bf_source]', 
                                    bf_file = '$row3[bf_file]', 
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

$msg = "$lang[407] $act $lang[408]";
$opener_href = "./board.php?bo_table=$bo_table&page=$page&$qstr";

echo <<<HEREDOC
<meta http-equiv='content-type' content='text/html; charset={$g4['charset']}'> 
<script type="text/javascript">
alert("{$msg}");
opener.document.location.href = "{$opener_href}";
window.close();
</script>
HEREDOC;
?>
