<? include "css.php" ?>
<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<table width="<?=$width?>" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<table border="0" width="100%" id="table3" cellspacing="0" cellpadding="0">
			<tr>
				<td>
			<div style="float:left; margin-top:6px;">
				<img src="<?=$board_skin_path?>/img/icon_date.gif" align=absmiddle border='0'>
				<span style="color:#888888; font-size:8pt; font-family:;"><?php echo $lang['77'];?> : <?=date("y-m-d H:i", strtotime($view[wr_datetime]))?></span>
			</div>

    			</td>
				<td align="right">
	<div style="float:right;" align="center">
    <? 
    ob_start(); 
    ?>
    <? if ($copy_href) { echo "<a class=\"btn5\" href=\"$copy_href\">{$lang[78]}</a> "; } ?>
    <? if ($move_href) { echo "<a class=\"btn5\" href=\"$move_href\">{$lang[79]}</a> "; } ?>
    <? if ($search_href) { echo "<a class=\"btn2\" href=\"$search_href\">{$lang[80]}</a> "; } ?>
    <? echo "<a class=\"btn6\" href=\"$list_href\">{$lang[75]}</a> "; ?>
    <? if ($update_href) { echo "<a class=\"btn6\" href=\"$update_href\">{$lang[81]}</a> "; } ?>
    <? if ($delete_href) { echo "<a class=\"btn6\" href=\"$delete_href\">{$lang[82]}</a> "; } ?>
    <? if ($reply_href) { echo "<a class=\"btn6\" href=\"$reply_href\">{$lang[83]}</a> "; } ?>
    <? if ($write_href) { echo "<a class=\"btn1\" href=\"$write_href\">{$lang[76]}</a> "; } ?>
    <?
    $link_buttons = ob_get_contents();
    ob_end_flush();
    ?>
    </div></td>
			</tr>
		</table>
		<div style="border:1px solid #dddddd; clear:both; height:60px; background:url(<?=$board_skin_path?>/img/title_bg.gif) repeat-x;">
			<table border=0 cellpadding=0 cellspacing=0 width=100%>
				<tr>
					<td style="padding:6px 0 0 10px;">
					<div style="font-family:; color:#505050; font-size:16px; font-weight:bold; word-break:break-all;">
				<font color="<?=$view[wr_1]?>">
				<? if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?>
				</font><font color="<?=$view[wr_1]?>">
				<?//테이블이 깨지지 않도록 글자수 조정
				$title_strlen = strlen(cut_hangul_last(get_text($view[wr_subject])));
				if($title_strlen <= 60) echo cut_hangul_last(get_text($view[wr_subject]));
				else echo substr(cut_hangul_last(get_text($view[wr_subject])),0,58)."..."
				?>				
					</font>				
					</div></td>
					<td align="right" style="padding:4px 6px 0 0;" valign=top>
				
<table border="0" id="table5" cellspacing="1">
	<tr>
		<td align="center">
				
<a class="btn7" onclick="win_scrap('<?=$scrap_href?>');" href="javascript:;"><?php echo $lang['84'];?></a></td>
		<td align="center">
				<? if ($trackback_url) { ?><a class="btn8" href="javascript:trackback_send_server('<?=$trackback_url?>');"><?php echo $lang['85'];?></a><?}?></td>
	</tr>
</table>
					</td>
				</tr>
				<tr>
					<td style="padding:14px 0 3px 10px;">
					<div style="font-size:8pt; font-family:;"><?php echo $lang['60'];?> : 
				<?=$view[name]?><? if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>
					</div></td>
					<td style="padding:14px 2px 0 0;">
					<div style="float:right;font-size:8pt; font-family:; color:#aaaaaa;"><?php echo $lang['53'];?> : <?=number_format($view[wr_hit])?>
				<? if ($is_good) { ?>&nbsp;<img src="<?=$board_skin_path?>/img/icon_good.gif" border='0' align=absmiddle> <?php echo $lang['55'];?> : <?=number_format($view[wr_good])?><? } ?>
				<? if ($is_nogood) { ?>&nbsp;<img src="<?=$board_skin_path?>/img/icon_nogood.gif" border='0' align=absmiddle> <?php echo $lang['86'];?> : <?=number_format($view[wr_nogood])?><? } ?>
				&nbsp;
				</div></td>
				</tr>
		</div>
    		</table></div>
		<div style="height:3px; background:url(<?=$board_skin_path?>/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px;">
		</div>
<?if($title_strlen > 60){?>
		<div style="padding-top:5px;"></div>
		<div style="border:1px solid #dddddd;padding:5px;">
<?=cut_hangul_last(get_text($view[wr_subject]))?>
</div>
		<div style="height:3px; background:url(<?=$board_skin_path?>/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px;">
		</div>
<?}?>
		<table border=0 cellpadding=0 cellspacing=0 width="<?=$width?>"?>
<?
// 가변 파일
$cnt = 0;
for ($i=0; $i<count($view[file]); $i++) {
    if ($view[file][$i][source] && !$view[file][$i][view]) {
        $cnt++;
        echo "<tr><td height=30 background=\"$board_skin_path/img/view_dot.gif\">";
        echo "&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_file.gif' align=absmiddle border='0'>";
        echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}' style='font-weight:bold;'>";
        echo "&nbsp;{$view[file][$i][source]}</a> <span style='font-size:8pt; font-family:;'>({$view[file][$i][size]})</span>	";
        echo "&nbsp;&nbsp;{$lang[89]} : <span style=\"color:#ff6600; font-size:11px;\">{$view[file][$i][download]}</span>";
        echo "</td></tr>";
    }
}

// 링크
$cnt = 0;
for ($i=1; $i<=$g4[link_count]; $i++) {
    if ($view[link][$i]) {
        $cnt++;
        $link = cut_str($view[link][$i], 70);
        echo "<tr><td height=30 background=\"$board_skin_path/img/view_dot.gif\">";
        echo "&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_link.gif' align=absmiddle border='0'>";
        echo "<a href='{$view[link_href][$i]}' target=_blank>";
        echo "&nbsp;<span style=\"color:#888;\">{$link}</span></a>";
        echo "&nbsp;&nbsp;클릭수 : <span style=\"color:#ff6600; font-size:11px;\">{$view[link_hit][$i]}</span>";
        echo "</td></tr>";
    }
}
?><tr>
				<td height="150" style="word-break:break-all; padding:10px;">
        <? 
        // 파일 출력
        for ($i=0; $i<=count($view[file]); $i++) {
            if ($view[file][$i][view]) 
                echo $view[file][$i][view] . "<p>";
        }
        ?>

        <!-- 내용 출력 -->
        		<span id="writeContents"><?=$view[content];?></span>
        
        <?//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
        <!-- 테러 태그 방지용 --></xml></xmp><a href=""></a>

        <? if ($nogood_href) {?>
        		<div style="width:72px; height:55px; background:url(<?=$board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
					<div style="color:#888; margin:7px 0 5px 0;"><?php echo $lang['86'];?> : <?=number_format($view[wr_nogood])?></div>
					<div><a href="<?=$nogood_href?>" target="hiddenframe">
						<img src="<?=$board_skin_path?>/img/icon_nogood.gif" border='0' align="absmiddle"></a></div>
				</div>
        <? } ?>

        <? if ($good_href) {?>
        		<div style="width:72px; height:55px; background:url(<?=$board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
					<div style="color:#888; margin:7px 0 5px 0;">
						<span style='color:crimson;'><?php echo $lang['55'];?> : <?=number_format($view[wr_good])?></span></div>
					<div><a href="<?=$good_href?>" target="hiddenframe">
						<img src="<?=$board_skin_path?>/img/icon_good.gif" border='0' align="absmiddle"></a></div>
				</div>
        <? } ?>

</td>
			</tr>
<? if ($is_signature) { echo "<tr><td align='center' style='border-bottom:1px solid #E7E7E7; padding:5px 0;'>$signature</td></tr>"; } // 서명 출력 ?>
		</table><br>

<?
// 코멘트 입출력
include_once("./view_comment.php");
?>

		<div style="height:1px; line-height:1px; font-size:1px; background-color:#ddd; clear:both;">&nbsp;</div>
		<div style="clear:both; height:43px;">
        <div style="float:left; margin-top:10px;">
        <table border="0" id="table8" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center">
        <? if ($prev_href) { echo "<a class=\"btn11\" href=\"$prev_href\" title=\"$prev_wr_subject\">{$lang[124]}</a>&nbsp;"; } ?>
        		</td>
				<td align="center">
        <? if ($next_href) { echo "<a class=\"btn11\" href=\"$next_href\" title=\"$next_wr_subject\">{$lang[125]}</a>&nbsp;"; } ?>
        		</td>
			</tr>
		</table>
        </div>
    	<div style="float:right; margin-top:10px;">
    <table border="0" id="table7" cellspacing="0" cellpadding="0">
		<tr>
			<td align="center">
    <?=$link_buttons?>
    </td>
		</tr>
	</table>
    </div></div>
		<div style="height:2px; line-height:1px; font-size:1px; background-color:#dedede; clear:both;">&nbsp;</div>
		</td>
	</tr>
</table>
<br>

<script language="JavaScript">
function file_download(link, file) {
    <? if ($board[bo_download_point] < 0) { ?>if (confirm("<?php echo $lang['90'];?>(<?=number_format($board[bo_download_point])?><?php echo $lang['91'];?>"))<?}?>
    document.location.href=link;
}
</script>

<script language="JavaScript" src="<?="$g4[path]/js/board.js"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"></script>
<script language="JavaScript">
window.onload=function() {
    resizeBoardImage(<?=(int)$board[bo_image_width]?>);
    drawFont();
}
</script>
<!-- 게시글 보기 끝 -->