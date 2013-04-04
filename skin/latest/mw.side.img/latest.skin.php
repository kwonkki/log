<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

global $mw_side_img_cnt;

if (!$mw_side_img_cnt)
    $mw_side_img_cnt = 0;

$mw_side_img_cnt++;

$rows = count($list);
$style_name = "mw-side-img-$bo_table-$rows-$subject_len-$mw_side_img_cnt";
?>
<style type="text/css">
#<?=$style_name?> { clear:both; width:240px; margin:0px 0 0 0; border:0px solid #e1e1e1; }
#<?=$style_name?> .item { clear:both; display:none; }
#<?=$style_name?> .file-img { width:240px; height:180px; border:1px solid #e1e1e1; border-left:0; }
#<?=$style_name?> .subject { clear:both; height:20px; padding:5px 5px 0 0; text-align:center; }
#<?=$style_name?> .subject a:hover { color:#438A01; text-decoration:underline; }
#<?=$style_name?> .prev { float:left; margin:0 0 0 5px; cursor:pointer; }
#<?=$style_name?> .next	{ float:left; margin:0 5px 0 0; cursor:pointer; }
#<?=$style_name?> .link	{ float:left; margin:0 0 0 5px; text-align:center; }

</style>

<div id="<?=$style_name?>">
<? for ($i=0; $i<$rows; $i++) { ?>
<?
$img = "$g4[path]/data/file/$bo_table/thumb/{$list[$i][wr_id]}";
if (!@file_exists($img)) $img = "$g4[path]/data/file/$bo_table/thumbnail/{$list[$i][wr_id]}";
if (!@file_exists($img)) $img = "{$list[$i][file][0][path]}/{$list[$i][file][0][file]}";
if (!@file_exists($img)) $img = "$latest_skin_path/img/noimage.gif";
if (!$list[$i][wr_id]) $img = "$latest_skin_path/img/noimage.gif";
if (@is_dir($img)) $img = "$latest_skin_path/img/noimage.gif";
global $member;
if ($member[mb_id]) {
    $list[$i][subject] = str_replace("{닉네임}", $member[mb_nick], $list[$i][subject]);
} else {
    $list[$i][subject] = str_replace("{닉네임}", "회원", $list[$i][subject]);
}
?>
<div id="<?=$style_name.$i?>" class="item">
    <div class="file"><a href="<?=$list[$i][href]?>"><img src="<?=$img?>" class="file-img"></a></div>
    <table width=100% height=25 border=0 cellpadding=0 cellspacing=0>
    <tr>
	<td width="20"><img src="<?=$latest_skin_path?>/img/btn-prev.gif" onclick="latest_side_img_prev<?=$mw_side_img_cnt?>()" class="prev" align="absmiddle"></td>
	<td align="center"><a href="<?=$list[$i][href]?>"><?=$list[$i][subject]?></a></td>
	<td width="20"><img src="<?=$latest_skin_path?>/img/btn-next.gif" onclick="latest_side_img_next<?=$mw_side_img_cnt?>()" class="next" align="absmiddle"></td>
    </tr>
    </table>
</div>
<? } ?>
</div>

<script type="text/javascript">
side_img_val<?=$mw_side_img_cnt?> = 0;
side_img_delay<?=$mw_side_img_cnt?> = 3000;
side_img_time<?=$mw_side_img_cnt?> = null;
function latest_side_img_prev<?=$mw_side_img_cnt?>() {
    latest_side_img_next<?=$mw_side_img_cnt?>(-1);
}
function latest_side_img_next<?=$mw_side_img_cnt?>(val) { 
    if (val < 0) 
	side_img_val<?=$mw_side_img_cnt?>--;
    else
	side_img_val<?=$mw_side_img_cnt?>++;
    if (side_img_val<?=$mw_side_img_cnt?> >= <?=$rows?>) side_img_val<?=$mw_side_img_cnt?> = 0;
    if (side_img_val<?=$mw_side_img_cnt?> < 0) side_img_val<?=$mw_side_img_cnt?> = <?=$rows-1?>;

    for (i=0; i<<?=$rows?>; i++) {
	document.getElementById("<?=$style_name?>" + i).style.display = "none";
    }
    img = document.getElementById("<?=$style_name?>" + side_img_val<?=$mw_side_img_cnt?>);
    img.style.display = "block";
}
function latest_side_img_auto<?=$mw_side_img_cnt?>() {
    side_img_time<?=$mw_side_img_cnt?> = setInterval("latest_side_img_next<?=$mw_side_img_cnt?>()", side_img_delay<?=$mw_side_img_cnt?>);
}
function latest_side_img_over<?=$mw_side_img_cnt?>() {
    clearInterval(side_img_time<?=$mw_side_img_cnt?>);
    side_img_time<?=$mw_side_img_cnt?> = null;
}
function latest_side_img_out<?=$mw_side_img_cnt?>() {
    latest_side_img_auto<?=$mw_side_img_cnt?>();
}
document.getElementById("<?=$style_name?>0").style.display = "block";
latest_side_img_auto<?=$mw_side_img_cnt?>();
document.getElementById("<?=$style_name?>").onmouseover = latest_side_img_over<?=$mw_side_img_cnt?>;
document.getElementById("<?=$style_name?>").onmouseout = latest_side_img_out<?=$mw_side_img_cnt?>;
</script>

