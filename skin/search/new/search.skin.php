<? include "css.php" ?>
<?
if (!defined("_GNUBOARD_")) exit; //  
?>
<?
function remove_tags_($str) 
{ 
	$str = html_entity_decode($str); 
	$str = ereg_replace("<[^>]*>","",$str); 
	$str = strip_tags($str); 
	return $str; 
};
?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<script language="JavaScript"> 
function errors() 
{ 
 return true; 
} 
window.onerror = errors; 
</script>



<table width="100%" cellpadding=5 cellspacing=0 border="0" bordercolor="#dddddd" style="
border-collapse:collapse;
border-top:1 solid gray;
background:url(<?=$search_skin_path?>/img/yaho.gif) no-repeat 98% 44%;
background-color:#f3f3f3;
">
<form name=fsearch method=get action="javascript:fsearch_submit(document.fsearch);"
onsubmit="return check_value()">
<input type="hidden" name="srows" value="<?=$srows?>">
<tr height="40">
    <td style="padding-left:10">
	<!--script language="JavaScript">document.getElementById("gr_id").value = "<?=$gr_id?>";</script-->
	<table cellpadding="0" cellspacing="0"><tr>
		<td>
		<?=$group_select?>
		<select name=sfl class=select style="background-color:#ffffff">
		<option value="wr_subject||wr_content"><?php echo $lang['59'];?>+<?php echo $lang['64'];?></option>
		<option value="wr_subject"><?php echo $lang['59'];?></option>
		<option value="wr_content"><?php echo $lang['64'];?></option>
		<option value="mb_id"><?php echo $lang['34'];?></option>
		<option value="wr_name"><?php echo $lang['65'];?></option>
		</select>
		<td style="padding:0 5 1 5">
		<input name="stx" maxlength="25" required itemname="<?php echo $lang['66'];?>" value="<?=$text_stx?>" style="
		border:1px solid #999999; width:160px; height:20px; background-color: #ffffff;"></td>
		<td>
				<input type="submit" value="<?php echo $lang['04'];?>" name="B1" style="font-weight: bold" class="btn400"></td>
		<td style="padding-left:5">
		<input type="radio" name="sop" value="or" <?=($sop == "or") ? "checked" : "";?>></td>
		<td>OR</td><td>
		<input type="radio" name="sop" value="and" <?=($sop == "and") ? "checked" : "";?>></td>
		<td>AND</td>
	</tr></table>
    </td>
</tr>
</form>
</table>

<?
if($_GET[stx] != "")
{
?>

<table border="0" width="100%" cellspacing="0">
	<tr>
		<td>
	<b><?php echo $lang['118'];?></b> (<b><?=$board_count?></b>/<b><?=number_format($total_count)?></b>, <?=number_format($page)?>/<b><?=number_format($total_page)?></b> <?php echo $lang['119'];?>)
		</td>
	</tr>
	<tr>
		<td>
	<table border=0 width="100%" cellpadding=10 cellspacing=0>
	<? 
	$k=0;
	for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) 
	{ 
		echo"<tr height=10><td></td></tr>";
		echo "<tr><td bgcolor=#f6f6f6 colspan=3 style='border-top:1 solid #dddddd; padding:5 0 5 10'><b><img src='$search_skin_path/img/search.gif' align=absmiddle>&nbsp;<a href='./board.php?bo_table={$search_table[$idx]}&{$search_query}'><font color=#FF6600>{$bo_subject[$idx]}</font></a></b></td></tr>";
		$comment_href = "";
		for ($i=0; $i<count($list[$idx]) && $k<$rows; $i++, $k++) 
		{
			echo "<tr><td style='border-bottom:1px dotted #dedede; padding:5 10 5 15'><img src='$search_skin_path/img/sub.gif' align=absmiddle>";
			if ($list[$idx][$i][wr_is_comment]) 
			{
				echo "&nbsp;<font color=green><img src='$search_skin_path/img/icon_ment.gif' align=absmiddle> [{$lang[255]}]</font> ";
				$comment_href = "#c_".$list[$idx][$i][wr_id];
			}
			if (!$list[$idx][$i][wr_is_comment]) echo "&nbsp;<img src='$search_skin_path/img/icon_memo.gif' border=0 align=absmiddle>&nbsp;";
			echo "<a href='{$list[$idx][$i][href]}{$comment_href}'><font color='#1747b7'>";
			echo $list[$idx][$i][subject];
			echo "</font></a> <a href='{$list[$idx][$i][href]}{$comment_href}' target=_blank><img src='$search_skin_path/img/icon_new.gif' align=absmiddle border=0 alt='{$lang[477]}'></a><br>";
			echo "".cut_str(remove_tags_($list[$idx][$i][content]),200);
			echo "<br><font color=#999999>{$list[$idx][$i][wr_datetime]}</font>&nbsp;&nbsp;&nbsp;";
			echo "</td></tr>";
		}
	}
	?>
	</table>
    	</td>
	</tr>
	<tr>
		<td>
		 <? if ($prev_part_href) { echo "<a href='$prev_part_href'>이전검색</a>"; } ?>
 <div class="paginate"><?=$write_pages?></div>
 <? if ($next_part_href) { echo "<a href='$next_part_href'>다음검색</a>"; } ?></td>
	</tr>
</table>
<?
}
else
{
	print("<div style='padding:10;'><font color=orange>* </font>{$lang[478]}</div>");
}
?>

<script language="javascript">
document.fsearch.sfl.value = "<?=$sfl?>";
function fsearch_submit(f)
{
	/*
	// 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
	var cnt = 0;
	for (var i=0; i<f.stx.value.length; i++)
	{
		if (f.stx.value.charAt(i) == ' ')
			cnt++;
	}

	if (cnt > 1)
	{
		alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
		f.stx.select();
		f.stx.focus();
		return;
	}
	*/
	f.action = "";
	f.submit();
};
function check_value()
{
	var s = document.all.stx.value.replace(" ", "");
	if(s.length == 1)
	{
		alert("<?php echo $lang['479'];?>");
		document.all.stx.focus();
		return false;
	}
	return true;
};
</script>

<script language="javascript">document.all.stx.focus();</script>

