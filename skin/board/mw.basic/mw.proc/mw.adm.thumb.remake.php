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

include_once("_common.php");
include_once("$board_skin_path/mw.lib/mw.skin.basic.lib.php");
header("Content-Type: text/html; charset=$g4[charset]");

if ($is_admin != 'super')
    die("로그인 해주세요.");

if (!$bo_table)
    die("bo_table 값이 없습니다.");

$sql = " select * from $g4[board_file_table] where bo_table = '$bo_table' and bf_width = 0 ";
$sql.= " and ( ";
$sql.= " right(lower(bf_source), 3) = 'jpg' ";
$sql.= " or right(lower(bf_source), 3) = 'gif' ";
$sql.= " or right(lower(bf_source), 3) = 'png') ";
$qry = sql_query($sql);
while ($row = sql_fetch_array($qry)) {
    $file = "$g4[path]/data/file/$bo_table/$row[bf_file]";
    $size = getImageSize($file);
    sql_query(" update $g4[board_file_table] set bf_width = '$size[0]', bf_height = '$size[1]', bf_type = '$size[2]' where bo_table = '$bo_table' and wr_id = '$row[wr_id]' and bf_no = '$row[bf_no]' ");
}

$sql = "select wr_id, wr_content from $write_table where wr_is_comment = '0' order by wr_num";
$qry = sql_query($sql);
while ($row = sql_fetch_array($qry)) {
    $wr_id = $row[wr_id];
    $wr_content = $row[wr_content];

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
        preg_match("/<img.*src=\"(.*)\"/iU", $wr_content, $match);
        if ($match[1]) {
            $match[1] = str_replace($g4[url], "..", $match[1]);
            mw_make_thumbnail($mw_basic[cf_thumb_width], $mw_basic[cf_thumb_height], $match[1], $thumb_file, $mw_basic[cf_thumb_keep]);
            if ($mw_basic[cf_thumb2_width])
                @mw_make_thumbnail($mw_basic[cf_thumb2_width], $mw_basic[cf_thumb2_height], $match[1], "{$thumb2_path}/{$wr_id}", $mw_basic[cf_thumb2_keep]);
            if ($mw_basic[cf_thumb3_width])
                @mw_make_thumbnail($mw_basic[cf_thumb3_width], $mw_basic[cf_thumb3_height], $match[1], "{$thumb3_path}/{$wr_id}", $mw_basic[cf_thumb3_keep]);
        } else {
            @unlink($thumb_file);
        }
    }
}

echo "썸네일을 모두 재생성하였습니다.";
?>
