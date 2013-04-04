<?
/**
 * Bechu basic skin for gnuboard4
 *
 * copyright (c) 2008 Choi Jae-Young <www.miwit.com>
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

ini_set("gd.jpeg_ignore_warning", true);
ini_set('memory_limit', '-1'); 

include_once("$board_skin_path/mw.lib/mw.ccl.lib.php");

$mw[basic_config_table] = $g4[table_prefix]."mw_basic_config";
$mw[board_member_table] = $g4[table_prefix]."mw_board_member";
$mw[download_log_table] = $g4[table_prefix]."mw_download_log";
$mw[link_log_table]     = $g4[table_prefix]."mw_link_log";
$mw[post_history_table] = $g4[table_prefix]."mw_post_history";
$mw[guploader_table]    = $g4[table_prefix]."mw_guploader";
$mw[vote_table]         = $g4[table_prefix]."mw_vote";
$mw[vote_item_table]    = $g4[table_prefix]."mw_vote_item";
$mw[vote_log_table]     = $g4[table_prefix]."mw_vote_log";
$mw[reward_table]       = $g4[table_prefix]."mw_reward";
$mw[reward_log_table]   = $g4[table_prefix]."mw_reward_log";
$mw[singo_log_table]    = $g4[table_prefix]."mw_singo_log";
$mw[must_notice_table]  = $g4[table_prefix]."mw_must_notice";
$mw[comment_good_table] = $g4[table_prefix]."mw_comment_good";
$mw[comment_file_table] = $g4[table_prefix]."mw_comment_file";
$mw[popup_notice_table] = $g4[table_prefix]."mw_popup_notice";
$mw[okname_table]       = $g4[table_prefix]."mw_okname";
$mw[temp_table]         = $g4[table_prefix]."mw_temp";

// 환경설정 파일 경로
$mw_basic_config_path = "$g4[path]/data/mw.basic.config";
$mw_basic_config_file = "$mw_basic_config_path/$bo_table";
mw_mkdir($mw_basic_config_path, 0707);

$mw_basic_upgrade_time_file = "$mw_basic_config_path/{$bo_table}_upgrade_time";
//if (!file_exists($mw_basic_upgrade_time_file)) mw_write_file($mw_basic_upgrade_time_file, filectime("$board_skin_path/mw.adm/mw.upgrade.php"));

$mw_basic_upgrade_time = mw_read_file($mw_basic_upgrade_time_file);

// 스킨 환경정보
//$sql = "select * from $mw[basic_config_table] where bo_table = '$bo_table'";
//$mw_basic = sql_fetch($sql, false);

// 업그레이드 파일 생성시간을 검사해서 변경되었을 경우에만 업그레이드 파일 실행
if (!file_exists($mw_basic_upgrade_time_file) || filectime("$board_skin_path/mw.adm/mw.upgrade.php") != $mw_basic_upgrade_time) {
    include_once("$board_skin_path/mw.adm/mw.upgrade.php");
    mw_write_file($mw_basic_upgrade_time_file, filectime("$board_skin_path/mw.adm/mw.upgrade.php"));
}

// 환경설정  파일 없으면 생성
if (!file_exists($mw_basic_config_file)) mw_basic_write_config_file();
    
// 환경설정 변수
$mw_basic = mw_basic_read_config_file();

// 플러그인 컨텐츠샵
$sql = "select * from $mw_cash[board_config_table] limit 1";
$row = sql_fetch($sql, false);
$mw_cash[c_name] = $row[c_name];
$mw_cash[c_list] = $row[c_list];
$mw_cash[c_view] = $row[c_view];
$mw_cash[c_down] = $row[c_down];
$mw_cash[c_write] = $row[c_write];
$mw_cash[c_msg] = $row[c_msg];
$mw_cash[c_url] = $row[c_url];

// 모아보기
$moa_path = "$g4[path]/plugin/smart-alarm";
if (file_exists("$moa_path/_config.php")) include_once("$moa_path/_config.php");

// 럭키라이팅
$lucky_writing_path = "$g4[path]/plugin/lucky-writing";
if (file_exists("$lucky_writing_path/_lib.php")) include_once("$lucky_writing_path/_lib.php");

if ($mw_basic[cf_write_notice]) {
    $mw_basic[cf_write_notice] = trim($mw_basic[cf_write_notice]);
    $mw_basic[cf_write_notice] = str_replace("\r", "", $mw_basic[cf_write_notice]);
    $mw_basic[cf_write_notice] = str_replace("\n", "\\n", $mw_basic[cf_write_notice]);
}

if (!$mw_basic[cf_singo_id])
    $mw_basic[cf_singo_id] = "admin,";

if (!$mw_basic[cf_email])
    $mw_basic[cf_email] = "test@test.com\ntest@test.com\n";

if (!$mw_basic[cf_hp])
    $mw_basic[cf_hp] = "010-000-0000\n010-000-0000\n";

// CCL 정보
$view[wr_ccl] = $write[wr_ccl] = mw_get_ccl_info($write[wr_ccl]);

// 1:1 게시판
if ($mw_basic[cf_attribute] == "1:1" && !$is_admin && $wr_id && $w != "u")
{
    if (!strstr($board[bo_notice], "$wr_id") && $is_admin != 'super' && $member[mb_id] != $write[mb_id]) {
        goto_url("board.php?bo_table=$bo_table");
    }

    if (!$board[bo_use_list_view]) {
        if (trim($sql_search) && substr(trim($sql_search), 0, 3) != "and")
            $sql_search = " and " . $sql_search;

        // 윗글을 얻음
        $sql = " select wr_id, wr_subject from $write_table where mb_id = '$member[mb_id]' and wr_is_comment = 0 and wr_num = '$write[wr_num]' and wr_reply < '$write[wr_reply]' $sql_search order by wr_num desc, wr_reply desc limit 1 ";
        $prev = sql_fetch($sql);
        // 위의 쿼리문으로 값을 얻지 못했다면
        if (!$prev[wr_id])     {
            $sql = " select wr_id, wr_subject from $write_table where mb_id = '$member[mb_id]' and wr_is_comment = 0 and wr_num < '$write[wr_num]' $sql_search order by wr_num desc, wr_reply desc limit 1 ";
            $prev = sql_fetch($sql);
        }

        // 아래글을 얻음
        $sql = " select wr_id, wr_subject from $write_table where mb_id = '$member[mb_id]' and wr_is_comment = 0 and wr_num = '$write[wr_num]' and wr_reply > '$write[wr_reply]' $sql_search order by wr_num, wr_reply limit 1 ";
        $next = sql_fetch($sql);
        // 위의 쿼리문으로 값을 얻지 못했다면
        if (!$next[wr_id]) {
            $sql = " select wr_id, wr_subject from $write_table where mb_id = '$member[mb_id]' and wr_is_comment = 0 and wr_num > '$write[wr_num]' $sql_search order by wr_num, wr_reply limit 1 ";
            $next = sql_fetch($sql);
        }
    }

    // 이전글 링크
    $prev_href = "";
    if ($prev[wr_id]) {
        $prev_wr_subject = get_text(cut_str($prev[wr_subject], 255));
        $prev_href = "./board.php?bo_table=$bo_table&wr_id=$prev[wr_id]&page=$page" . $qstr;
    }

    // 다음글 링크
    $next_href = "";
    if ($next[wr_id]) {
        $next_wr_subject = get_text(cut_str($next[wr_subject], 255));
        $next_href = "./board.php?bo_table=$bo_table&wr_id=$next[wr_id]&page=$page" . $qstr;
    }
}

// 썸네일 경로
$file_path = "$g4[path]/data/file/$bo_table";
$thumb_path = "$file_path/thumbnail";
$thumb2_path = "$file_path/thumbnail2";
$thumb3_path = "$file_path/thumbnail3";

mw_mkdir($thumb_path);
mw_mkdir($thumb2_path);
mw_mkdir($thumb3_path);

$watermark_path = "$file_path/watermark";
mw_mkdir($watermark_path);

// 회원 코멘트 이미지 경로
$comment_image_path = "$g4[path]/data/mw.basic.comment.image";

// 서비스 점검중
if ($mw_basic[cf_under_construction] && $is_admin != "super") {
    alert("죄송합니다. 현재 서비스 점검중입니다."); 
}

// 디렉토리 생성
function mw_mkdir($path, $permission=0707) {
    if (is_dir($path)) return;
    if (file_exists($path)) @unlink($path);

    @mkdir($path, $permission);
    @chmod($path, $permission);

    // 디렉토리에 있는 파일의 목록을 보이지 않게 한다.
    $file = $path . "/index.php";
    $f = @fopen($file, "w");
    @fwrite($f, "");
    @fclose($f);
    @chmod($file, 0606);
}

// 관련글 얻기.. 080429, curlychoi
function mw_related($related, $field="wr_id, wr_subject, wr_content, wr_datetime, wr_comment")
{
    global $bo_table, $write_table, $g4, $wr_id, $mw_basic;

    if (!trim($related)) return;

    $bo_table2 = $bo_table;
    $write_table2 = $write_table;

    if (trim($mw_basic[cf_related_table])) {
        $bo_table2 = $mw_basic[cf_related_table];
        $write_table2 = "$g4[write_prefix]$bo_table2";
    }

    $sql_where = "";
    $related = explode(",", $related);
    foreach ($related as $rel) {
        $rel = trim($rel);
        if ($rel) {
            $rel = addslashes($rel);
            if ($sql_where) {
                $sql_where .= " or ";
            }
            $sql_where .= " (instr(wr_subject, '$rel') or instr(wr_content, '$rel')) ";
        }
    }
    if (!trim($mw_basic[cf_related_table]))
        $sql_where .= " and wr_id <> '$wr_id' ";

    $sql = "select $field from $write_table2 where wr_is_comment = 0 and ($sql_where) order by wr_num ";
    $qry = sql_query($sql, false);

    $list = array();
    $i = 0;
    while ($row = sql_fetch_array($qry)) {
        $row[href] = "$g4[bbs_path]/board.php?bo_table=$bo_table2&wr_id=$row[wr_id]";
        $row[comment] = $row[wr_comment] ? "<span class='comment'>($row[wr_comment])</span>" : "";
        $row[subject] = get_text($row[wr_subject]);
        $row[subject] = mw_reg_str($row[subject]);
        $list[$i] = $row;
        if (++$i >= $mw_basic[cf_related]) {
            break;
        }
    }
    return $list;
}

// 관련글 얻기.. 080429, curlychoi
function mw_view_latest($field="wr_id, wr_subject, wr_content, wr_datetime, wr_comment")
{
    global $bo_table, $write_table, $g4, $wr_id, $write, $mw_basic;

    $bo_table2 = $bo_table;
    $write_table2 = $write_table;

    if (trim($mw_basic[cf_latest_table])) {
        $bo_table2 = $mw_basic[cf_latest_table];
        $write_table2 = "$g4[write_prefix]$bo_table2";
    }

    $sql = "select $field from $write_table2 where wr_is_comment = 0 and wr_id <> '$wr_id' and mb_id = '$write[mb_id]' order by wr_num limit $mw_basic[cf_latest] ";
    $qry = sql_query($sql, false);

    $list = array();
    $i = 0;
    for ($i=0; $row=sql_fetch_array($qry); $i++) {
        $row[href] = "$g4[bbs_path]/board.php?bo_table=$bo_table2&wr_id=$row[wr_id]";
        //$row[comment] = $row[wr_comment] ? "<span class='comment'>($row[wr_comment])</span>" : "";
        $row[comment] = $row[wr_comment] ? "<span class='comment'>+$row[wr_comment]</span>" : "";
        $row[subject] = get_text($row[wr_subject]);
        $row[subject] = mw_reg_str($row[subject]);
        $list[$i] = $row;
    }
    return $list;
}

function mw_thumbnail_keep($size, $set_width, $set_height) {
    if ($size[0] > $size[1]) {
	@$rate = $set_width / $size[0];
	$get_width = $set_width;
	$get_height = (int)($size[1] * $rate);
    } else {
	@$rate = $set_width / $size[1];
	$get_height = $set_width;
	$get_width = (int)($size[0] * $rate);
    }
    return array($get_width, $get_height);
}

// 썸네일 생성.. 080408, curlychoi
function mw_make_thumbnail($set_width, $set_height, $source_file, $thumbnail_file='', $keep=false)
{
    global $mw_basic;

    if (!$thumbnail_file)
        $source_file = $thumbnail_file;

    $size = @getimagesize($source_file);

    switch ($size[2]) {
        case 1: $source = @imagecreatefromgif($source_file); break;
        case 2: $source = @imagecreatefromjpeg($source_file); break;
        case 3: $source = @imagecreatefrompng($source_file); break;
        default: return false;
    }

    if ($keep)
    {
	$keep_size = mw_thumbnail_keep($size, $set_width, $set_height);
	$set_width = $get_width = $keep_size[0];
	$set_height = $get_height = $keep_size[1];
    }
    else
    {
        $rate = $set_width / $size[0];
        $get_width = $set_width;
        $get_height = (int)($size[1] * $rate); 

        if ($get_height < $set_height) {
            //$get_width = $set_width + $set_height - $get_height;
            //$get_height = $set_height;
            $rate = $set_height / $size[1];
            $get_height = $set_height;
            $get_width = (int)($size[0] * $rate); 
        }       
    }

    $target = @imagecreatetruecolor($set_width, $set_height);
    $white = @imagecolorallocate($target, 255, 255, 255);
    @imagefilledrectangle($target, 0, 0, $set_width, $set_height, $white);
    @imagecopyresampled($target, $source, 0, 0, 0, 0, $get_width, $get_height, $size[0], $size[1]);

    if ($mw_basic[cf_watermark_use_thumb] && file_exists($mw_basic[cf_watermark_path])) { // watermark
        mw_watermark($target, $set_width, $set_height
            , $mw_basic[cf_watermark_path]
            , $mw_basic[cf_watermark_position]
            , $mw_basic[cf_watermark_transparency]);
    }

    @imagejpeg($target, $thumbnail_file, 100);
    @chmod($thumbnail_file, 0606);

    @imagedestroy($target);
    @imagedestroy($source);
}

function mw_watermark($target, $tw, $th, $source, $position, $transparency=100)
{
    global $mw_basic;

    $wf = $source;
    $ws = @getimagesize($wf);

    switch ($ws[2]) {
        case 1: $wi = @imagecreatefromgif($wf); break;
        case 2: $wi = @imagecreatefromjpeg($wf); break;
        case 3: $wi = @imagecreatefrompng($wf); break;
        default: $wi = "";
    }

    switch($position) {
        case "center":
            $wx = (int)($tw/2 - $ws[0]/2);
            $wy = (int)($th/2 - $ws[1]/2);
            break;
        case "left_top":
            $wx = $wy = 0;
            break;
        case "left_bottom":
            $wx = 0;
            $wy = $th - $ws[1];
            break;
        case "right_top":
            $wx = $tw - $ws[0];
            $wy = 0;
            break;
        case "right_bottom":
            $wx = $tw - $ws[0];
            $wy = $th - $ws[1];
            break;
        default:
            $wx = (int)($tw/2 - $ws[0]/2);
            $wy = (int)($th/2 - $ws[1]/2);
            break;
    }
    @imagecopymerge($target, $wi, $wx, $wy, 0, 0, $ws[0], $ws[1], $transparency);
    @imagedestroy($wi);
}

function mw_watermark_file($source_file)
{
    global $watermark_path, $mw_basic, $g4;

    if (!file_exists($source_file)) return;

    $pathinfo = pathinfo($source_file);
    $basename = md5(basename($source_file)).'.'.$pathinfo[extension];
    $watermark_file = "$watermark_path/$basename";

    if (file_exists($watermark_file)) return $watermark_file;

    $size = @getimagesize($source_file);
    switch ($size[2]) {
        case 1: $source = @imagecreatefromgif($source_file); break;
        case 2: $source = @imagecreatefromjpeg($source_file); break;
        case 3: $source = @imagecreatefrompng($source_file); break;
    }
    mw_watermark($source, $size[0], $size[1]
        , $mw_basic[cf_watermark_path]
        , $mw_basic[cf_watermark_position]
        , $mw_basic[cf_watermark_transparency]);

    @imagejpeg($source, $watermark_file, 100);
    @chmod($watermark_file, 0606);
    @imagedestroy($source);

    return $watermark_file;
}

// 첨부파일의 첫번째 파일을 가져온다.. 080408, curlychoi
// 이미지파일을 가져오는 인수 추가.. 080414, curlychoi
function mw_get_first_file($bo_table, $wr_id, $is_image=false)
{
    global $g4;
    $sql_image = "";
    if ($is_image) $sql_image = " and bf_width > 0 ";
    $sql = "select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' $sql_image order by bf_no limit 1";
    $row = sql_fetch($sql);
    return $row;
}

// 핸드폰번호 형식으로 return
function mw_get_hp($hp, $hyphen=1)
{
    if (!mw_is_hp($hp)) return '';

    if ($hyphen) $preg = "$1-$2-$3"; else $preg = "$1$2$3";

    $hp = str_replace('-', '', trim($hp));
    $hp = preg_replace("/^(01[016789])([0-9]{3,4})([0-9]{4})$/", $preg, $hp);

    return $hp;
}

// 핸드폰번호 여부
function mw_is_hp($hp)
{
    $hp = str_replace('-', '', trim($hp));
    if (preg_match("/^(0[17][016789])([0-9]{3,4})([0-9]{4})$/", $hp))
        return true;
    else
        return false;
}

// 분류 옵션을 얻음
function mw_get_category_option($bo_table='')
{
    global $g4, $board;

    $arr = explode("|", $board[bo_category_list]); // 구분자가 , 로 되어 있음
    $str = "";
    for ($i=0; $i<count($arr); $i++)
        if (trim($arr[$i]))
            $str .= "<option value='".urlencode($arr[$i])."'>$arr[$i]</option>\n";

    return $str;
}

function mw_set_sync_tag($content) {
    global $member;
    preg_match_all("/<([^>]*)</iUs", $content, $matchs);
    for ($i=0, $max=count($matchs[0]); $i<$max; $i++) {
	$pos = strpos($content, $matchs[0][$i]);
	$len = strlen($matchs[0][$i]);
	$content = substr($content, 0, $pos + $len - 1) . ">" . substr($content, $pos + $len - 1, strlen($content));
    }
 
    $content = mw_get_sync_tag($content, "div");
    $content = mw_get_sync_tag($content, "table");
    $content = mw_get_sync_tag($content, "font");
    return $content;
}

// html 태그 갯수 맞추기
function mw_get_sync_tag($content, $tag) {
    $tag = strtolower($tag);
    $res = strtolower($content);

    $open  = substr_count($res, "<$tag");
    $close = substr_count($res, "</$tag");

    if ($open > $close) {

        $gap = $open - $close;
        for($i=0; $i<$gap; $i++)
            $content .= "</$tag>";

    } else {

        $gap = $close - $open;
        for($i=0; $i<$gap; $i++)
            $content = "<$tag>".$content;
    }

    return $content;
}

// 엄지 짧은링크 얻기
function umz_get_url($url) {
    $url2 = urlencode($url);
    $fp = fsockopen ("umz.kr", 80, $errno, $errstr, 30);
    if (!$fp) return false;
    fputs($fp, "POST /plugin/shorten/update.php?url=$url2 HTTP/1.0\r\n");
    fputs($fp, "Host: umz.kr:80\r\n");
    fputs($fp, "\r\n");
    while (trim($buffer = fgets($fp,1024)) != "") $header .= $buffer;
    while (!feof($fp)) $buffer .= fgets($fp,1024);
    fclose($fp);
    return trim($buffer);
}

// euckr -> utf8 
if (!function_exists("set_utf8")) {
function set_utf8($str)
{
    if (!is_utf8($str))
        $str = convert_charset('cp949', 'utf-8', $str);

    $str = trim($str);

    return $str;
}}

// utf8 -> euckr 
if (!function_exists("set_euckr")) {
function set_euckr($str)
{
    if (is_utf8($str))
        $str = convert_charset('utf-8', 'cp949', $str);

    $str = trim($str);

    return $str;
}}


// Charset 을 변환하는 함수 
if (!function_exists("convert_charset")) {
function convert_charset($from_charset, $to_charset, $str) {
    if( function_exists('iconv') )
        return iconv($from_charset, $to_charset, $str);
    elseif( function_exists('mb_convert_encoding') )
        return mb_convert_encoding($str, $to_charset, $from_charset);
    else
        die("Not found 'iconv' or 'mbstring' library in server.");
}}

// 텍스트가 utf-8 인지 검사하는 함수 
if (!function_exists("is_utf8")) {
function is_utf8($string) {

  // From http://w3.org/International/questions/qa-forms-utf-8.html
  return preg_match('%^(?:
        [\x09\x0A\x0D\x20-\x7E]            # ASCII
      | [\xC2-\xDF][\x80-\xBF]            # non-overlong 2-byte
      |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
      | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
      |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
      |  \xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
      | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
      |  \xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
 )*$%xs', $string);
}}

// syntax highlight 
function _preg_callback($m)
{
    $str = str_replace(array("<br/>", "&nbsp;"), array("\n", " "), $m[1]);
    return "<pre class='brush:php;'>$str</pre>";
}

function mw_get_level($mb_id) {
    global $icon_level_mb_id;
    global $icon_level_mb_point;
    global $mw_basic;
    $point = 0;
    if (!is_array($icon_level_mb_id)) $icon_level_mb_id = array();
    if (!is_array($icon_level_mb_point)) $icon_level_mb_point = array();
    if (!in_array($mb_id, $icon_level_mb_id)) {
        $icon_level_mb_id[] = $mb_id;
        $mb = get_member($mb_id, "mb_point");
        $icon_level_mb_point[$mb_id] = $mb[mb_point];
        $point = $mb[mb_point];
    } else {
        $point = $icon_level_mb_point[$mb_id];
    }
    $level = intval($point/$mw_basic[cf_icon_level_point]);
    if ($level > 99) $level = 99;
    if ($level < 0) $level = 0;
    return $level;
}

// 코멘트 첨부된 파일을 얻는다. (배열로 반환)
function get_comment_file($bo_table, $wr_id)
{
    global $g4, $mw, $qstr;

    $file["count"] = 0;
    $sql = " select * from $mw[comment_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' order by bf_no ";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $no = $row[bf_no];
        $file[$no][href] = "./download.php?bo_table=$bo_table&wr_id=$wr_id&no=$no" . $qstr;
        $file[$no][download] = $row[bf_download];
        // 4.00.11 - 파일 path 추가
        $file[$no][path] = "$g4[path]/data/file/$bo_table";
        //$file[$no][size] = get_filesize("{$file[$no][path]}/$row[bf_file]");
        $file[$no][size] = get_filesize($row[bf_filesize]);
        //$file[$no][datetime] = date("Y-m-d H:i:s", @filemtime("$g4[path]/data/file/$bo_table/$row[bf_file]"));
        $file[$no][datetime] = $row[bf_datetime];
        $file[$no][source] = $row[bf_source];
        $file[$no][bf_content] = $row[bf_content];
        $file[$no][content] = get_text($row[bf_content]);
        //$file[$no][view] = view_file_link($row[bf_file], $file[$no][content]);
        $file[$no][view] = view_file_link($row[bf_file], $row[bf_width], $row[bf_height], $file[$no][content]);
        $file[$no][file] = $row[bf_file];
        // prosper 님 제안
        //$file[$no][imgsize] = @getimagesize("{$file[$no][path]}/$row[bf_file]");
        $file[$no][image_width] = $row[bf_width] ? $row[bf_width] : 640;
        $file[$no][image_height] = $row[bf_height] ? $row[bf_height] : 480;
        $file[$no][image_type] = $row[bf_type];
        $file["count"]++;
    }

    return $file;
}

// 호칭
function get_name_title($name, $wr_name) {
    global $mw_basic;
    if (strlen(trim($mw_basic[cf_name_title]))) {
        $name = str_replace("<span class='member'>{$wr_name}</span>", "<span class='member'>{$wr_name}{$mw_basic[cf_name_title]}</span>", $name);
    }
    return $name;
}

// 에디터 첨부 이미지 목록 가져오기
function mw_get_editor_image($data)
{
    global $g4, $watermark_path;

    $editor_image = $ret = array();

    $url = $g4[url];
    $url = preg_replace("(\/)", "\\\/", $url);
    $url = preg_replace("(\.)", "\.", $url);

    $ext = "src=\"({$url}\/data\/geditor[^\"]+)\"";
    preg_match_all("/$ext/iUs", $data, $matchs);
    for ($j=0; $j<count($matchs[1]); $j++) {
        $editor_image[] = $matchs[1][$j];
    }

    $ext = "src=\"({$url}\/data\/mw\.cheditor[^\"]+)\"";
    preg_match_all("/$ext/iUs", $data, $matchs);
    for ($j=0; $j<count($matchs[1]); $j++) {
        $editor_image[] = $matchs[1][$j];
    }

    for ($j=0, $m=count($editor_image); $j<$m; $j++) {
        $match = $editor_image[$j];
        if (strstr($match, $g4[url])) { // 웹에디터로 첨부한 이미지 뿐 아니라 다양한 상황을 고려함.
            $path = str_replace($g4[url], "..", $match);
        } elseif (substr($match, 0, 1) == "/") {
            $path = $_SERVER[DOCUMENT_ROOT].$match;
        } else {
            $path = $match;
        }
        $ret[http_path][$j] = $match;
        $ret[local_path][$j] = $path;
    }
    return $ret;
}

// 에디터 이미지 워터마크 생성
function mw_create_editor_image_watermark($data)
{
    global $g4, $watermark_path;

    $editor_image = mw_get_editor_image($data);

    for ($j=0, $m=count($editor_image[local_path]); $j<$m; $j++) {
        $match = $editor_image[http_path][$j];
        $path = $editor_image[local_path][$j];
        $size = @getimagesize($path);
        if ($size[0] > 0) {
            $watermark_file = mw_watermark_file($path);
            $data = str_replace($match, $watermark_file, $data);
        }
    }
    return $data;
}

// 에디터 이미지 및 워터마크 삭제
function mw_delete_editor_image($data)
{
    global $g4, $watermark_path;

    $editor_image = mw_get_editor_image($data);

    for ($j=0, $m=count($editor_image[local_path]); $j<$m; $j++) {
        $path = $editor_image[local_path][$j];
        $size = @getimagesize($path);
        if ($size[0] > 0) {
            $watermark_file = "$watermark_path/".basename($path);
            if (file_exists($path)) @unlink($path); // 에디터 이미지 삭제
            if (file_exists($watermark_file)) @unlink($watermark_file); // 에디터 워터마크 삭제
        }
    }
}

// 팝업공지
function mw_board_popup($view, $html=0)
{
    global $is_admin, $bo_table, $g4, $board_skin_path, $mw_basic, $board;

    $dialog_id = "mw_board_popup_$view[wr_id]";

    $board[bo_image_width] = 550;

    // 파일 출력
    ob_start();
    $cf_img_1_noview = $mw_basic[cf_img_1_noview];
    for ($i=0; $i<=$view[file][count]; $i++) {
        if ($cf_img_1_noview && $view[file][$i][view]) {
            $cf_img_1_noview = false;
            continue;
        }
        if ($view[file][$i][view])
        {
            // 이미지 크기 조절
            if ($board[bo_image_width] < $view[file][$i][image_width]) {
                $img_width = $board[bo_image_width];
            } else {
                $img_width = $view[file][$i][image_width];
            }
            $view[file][$i][view] = str_replace("<img", "<img width=\"{$img_width}\"", $view[file][$i][view]);

            // 워터마크 이미지 출력
            if ($mw_basic[cf_watermark_use]) {
                preg_match("/src='([^']+)'/iUs", $view[file][$i][view], $match);
                $watermark_file = mw_watermark_file($match[1]);
                $view[file][$i][view] = str_replace($match[1], $watermark_file, $view[file][$i][view]);
            }

            echo $view[file][$i][view] . "<br/><br/>";
        }
    }
    $file_viewer = ob_get_contents();
    ob_end_clean();

    $html = 0;
    if (strstr($view['wr_option'], "html1"))
        $html = 1;
    else if (strstr($view['wr_option'], "html2"))
        $html = 2;

    $view[content] = conv_content($view[wr_content], $html);
    $view[rich_content] = preg_replace("/{이미지\:([0-9]+)[:]?([^}]*)}/ie", "view_image(\$view, '\\1', '\\2')", $view[content]);
    $view[rich_content] = mw_reg_str($view[rich_content]);

    $subject = get_text($view[subject]);
    $content = $file_viewer.$view[rich_content];

    $add_script = "";
    if ($is_admin && $view[wr_id]) {
        $add_script = <<<HEREDOC
            "팝업내림": function () {
                var q = confirm("정말로 팝업공지를 내리시겠습니까?")
                if (q) {
                    $.get("$board_skin_path/mw.proc/mw.popup.php?bo_table=$bo_table&wr_id=$view[wr_id]", function () {
                        $("#dialog-message-$wr_id").dialog('close');
                    });
                }
            },
HEREDOC;
    }
    if ($_COOKIE[$dialog_id]) return false;
    
    echo <<<HEREDOC
        <div id="dialog-message-$view[wr_id]" class="dialog-content" title="$subject">
            <div>$content</div>
        </div>
        <script type="text/javascript">
        $(function() {
            $("#dialog-message-$view[wr_id]").dialog({
                modal: true,
                minWidth: 600,
                minHeight: 300,
                buttons: {
                    $add_script
                    "24시간 동안 창을 띄우지 않습니다.": function () {
                        set_cookie("mw_board_popup_$view[wr_id]", "1", 24, "$g4[cookie_domain]");
                        $(this).dialog("close");
                    },
                    Ok: function() {
                        $(this).dialog("close");
                    }
                }
            });
        });
        </script>
HEREDOC;
}

function is_okname()
{
    global $g4, $mw, $member, $mw_basic;

    if (!$mw_basic[cf_kcb_type]) return true;
    if (!$mw_basic[cf_kcb_id]) return true;

    if (get_session("ss_okname")) return true;

    if ($member[mb_id]) {
        $sql = "select * from $mw[okname_table] where mb_id = '$member[mb_id]'";
        $row = sql_fetch($sql, false);
        if ($row) {
            set_session("ss_okname", $row[ok_name]);
            return true;
        }
    }
    return false;
}

function check_okname()
{
    global $mw_basic, $g4, $member, $board_skin_path;

    if (!$mw_basic[cf_kcb_id]) return false;

    echo "<link rel='stylesheet' href='$board_skin_path/style.common.css' type='text/css'>\n";
    echo "<style type='text/css'> #mw_basic { display:none; } </style>\n";

    $req_file = null;

    if ($mw_basic[cf_kcb_type] == "19ban")
        $req_file = "$board_skin_path/mw.proc/mw.19ban.php"; // 19금
    else
        $req_file = "$board_skin_path/mw.proc/mw.okname.php"; // 실명인증

    if (file_exists($req_file)) require($req_file);
}

// 자동치환
function mw_reg_str($str)
{
    global $member;

    if ($member[mb_id]) {
        $str = str_replace("{닉네임}", $member[mb_nick], $str);
        $str = str_replace("{별명}", $member[mb_nick], $str);
    } else {
        $str = str_replace("{닉네임}", "회원", $str);
        $str = str_replace("{별명}", "회원", $str);
    }

    return $str;
}

function mw_write_file($file, $contents)
{
    $fp = fopen($file, "w");
    ob_start();
    print_r($contents);
    $msg = ob_get_contents();
    ob_end_clean();
    fwrite($fp, $msg);
    fclose($fp);
}

function mw_read_file($file)
{
    ob_start();
    @readfile($file);
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;
}

function mw_basic_read_config_file()
{
    global $g4, $mw_basic, $mw_basic_config_file;

    $contents = mw_read_file($mw_basic_config_file);
    $contents = base64_decode($contents);
    $contents = unserialize($contents);

    return $contents;
}

function mw_basic_write_config_file()
{
    global $g4, $mw, $bo_table, $mw_basic_config_file, $mw_basic_config_path;

    $sql = "select * from $mw[basic_config_table] where bo_table = '$bo_table'";
    $mw_basic = sql_fetch($sql, false);

    $contents = $mw_basic;
    $contents = serialize($contents);
    $contents = base64_encode($contents);

    $f = fopen($mw_basic_config_file, "w");
    fwrite($f, $contents);
    fclose($f);
    @chmod($mw_basic_config_file, 0600);

    if (!file_exists("$mw_basic_config_path/.htaccess")) {
        $f = fopen("$mw_basic_config_path/.htaccess", "w");
        fwrite($f, "Deny from All");
        fclose($f);
    }
}

?>
