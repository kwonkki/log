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

$notice_list = array();
$tmp = explode("\n", trim($board[bo_notice]));
for ($i=0, $m=sizeof($tmp); $i<$m; $i++) {
    if (trim($tmp[$i])) {
        $notice_list[] = $tmp[$i];
    }
}

if ($mw_basic[cf_notice_top])
{
    if (sizeof($notice_list)) {
    ?>
        <div id="notice_top">
        <ul>
        <?
        for ($i=0, $m=sizeof($notice_list); $i<$m; $i++)
        {
            $sql = "select * from $write_table where wr_id = '{$notice_list[$i]}'";
            $qry = sql_query($sql);
            while ($row = sql_fetch_array($qry)) {
                $notice = get_list($row, $board, $skin_path, $board[bo_subject_len]);
                $notice[subject] = mw_reg_str($notice[subject]);
                ?>
                <li>
                    <span class="subject"><a href="<?=$notice[href]?>"><?=$notice[subject]?></a></span>
                    <? if ($notice[comment_cnt]) { ?> <span class=mw_basic_list_comment_count>+<?=$notice[wr_comment]?></span> <? } ?>
                    <?=$list[$i][icon_new]?>
                    <!--<span class="datetime"><?=$notice[datetime]?></span>-->
                </li>
                <?
            }
        }
        ?>
    </ul>
    </div>
    <?
    }
}
?>

