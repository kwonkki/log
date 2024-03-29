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

$ca_new = urldecode($ca_new);
$ca_old = urldecode($ca_old);

if (strtolower(str_replace($g4[charset], "-", "")) != "utf8") {
    $ca_new = set_euckr($ca_new);
    $ca_old = set_euckr($ca_old);
}

$flag = false;
$cate = explode("|", $board[bo_category_list]);
for ($i=0, $m=count($cate); $i<$m; $i++) {
    $cate[$i] = trim($cate[$i]);
    if (!$cate[$i]) continue;

    if ($cate[$i] == $ca_old) {
        $flag = true;
        break;
    }
}
if (!$flag)
    die("$ca_old 분류명이 잘못되었습니다.");

$sql = "update $g4[board_table] set bo_category_list = replace (bo_category_list, '$ca_old', '$ca_new') where bo_table = '$bo_table'";
$qry = sql_query($sql);

$sql = "update $write_table set ca_name = '$ca_new' where ca_name = '$ca_old'";
$qry = sql_query($sql);

echo "분류명 변경을 완료하였습니다.";
?>
