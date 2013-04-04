<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<head>

<style>
.n_title1 { font-family:; font-size:9pt; color:#3366CC; }
.n_title2 { font-family:; font-size:9pt; color:#5E5E5E; }
select {
	font-family: "", "";
	font-size: 12px;
	background-color: #f6f6f6;
	width: 102px;
	height: 23px;
	border: 1px solid #7f9db9;
}
</style>

</style>

<!-- 분류 시작 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<? include "css.php" ?>
<form name=fnew method=get style="margin:0px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height=30>
    <?
		if(!$mb_id){
			$mb_id = "{$lang[411]}";
			$click = "onfocus=\"cls(this.form)\"";
			echo "<a href=\"javascript:;\" onmousedown=\"cls(document.fnew)\">$group_select</a>";
		}else{
			echo $group_select;
		}
		?>
        
        <select name=view id=view <?=$click?> onchange="select_change()">
            <option value=''><?php echo $lang['412'];?>
            <option value='w'><?php echo $lang['413'];?>
            <option value='c'><?php echo $lang['414'];?>
        </select>&nbsp;&nbsp;
        
        <input type=text itemname='<?php echo $lang['389'];?>' name='mb_id' value='<?=$mb_id?>' <?=$click?> required style="width:150px; background-color:#f6f6f6; border:1px solid #7f9db9; height:20px;">
        		<input type="submit" value="<?php echo $lang['04'];?>" name="B1" style="font-weight: bold" class="btn4000">
        <script language="JavaScript">
        function select_change()
        {
            document.fnew.submit();
        }
        document.getElementById("gr_id").value = "<?=$gr_id?>";
        document.getElementById("view").value = "<?=$view?>";
        </script>
    </td>
</tr>
</table>
</form>
<!-- 분류 끝 -->

<!-- 제목 시작 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td width="100" align="center" style="border:1px solid #ddd; background:url(<?=$new_skin_path?>/img/title_bg.gif) repeat-x;" height="30"><font class=n_title1><strong>
	<?php echo $lang['415'];?></strong></font></td>
    <td width="5" align="center" valign="middle">&nbsp;</td>

    <td width="100" align="center" style="border-top:1px solid #ddd; border-left:1px solid #ddd; border-bottom:1px solid #ddd; background:url(<?=$new_skin_path?>/img/title_bg.gif) repeat-x;"><font class=n_title2><strong>
	<?php echo $lang['252'];?></strong></font></td>
    <td width="" align="center" style="border-top:1px solid #ddd; border-bottom:1px solid #ddd; background:url(<?=$new_skin_path?>/img/title_bg.gif) repeat-x;"><font class=n_title2><strong>
	<?php echo $lang['59'];?></strong></font></td>
    <td width="120" align="center" style="border-top:1px solid #ddd; border-bottom:1px solid #ddd; background:url(<?=$new_skin_path?>/img/title_bg.gif) repeat-x;"><font class=n_title2><strong>
	<?php echo $lang['141'];?></strong></font></td>
    <td width="60" align="center" style="border-top:1px solid #ddd; border-right:1px solid #ddd; border-bottom:1px solid #ddd; background:url(<?=$new_skin_path?>/img/title_bg.gif) repeat-x;"><font class=n_title2><strong>
	<?php echo $lang['259'];?></strong></font></td>
</tr>
<tr> 
    <td style="height:3px; background:url(<?=$new_skin_path?>/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px;">&nbsp;</td>
    <td></td>
    <td colspan="4" style="height:3px; background:url(<?=$new_skin_path?>/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px;">&nbsp;</td>
  </tr>
<?
for ($i=0; $i<count($list); $i++) 
{
    $gr_subject = cut_str($list[$i][gr_subject], 10);
    $bo_subject = cut_str($list[$i][bo_subject], 10);
    $wr_subject = get_text(cut_str($list[$i][wr_subject], 40));

    echo <<<HEREDOC
<tr> 
    <td align="center" height="30" style="padding:3px 0 0 0; border-bottom:1px dotted #B3D9FF;"><a href='./new.php?gr_id={$list[$i][gr_id]}'><font color="#3366CC">{$gr_subject}</font></a></td>
	<td width="5"></td>
    <td align="center" style="padding:3px 0 0 0; border-bottom:1px dotted #cccccc;"><a href='./board.php?bo_table={$list[$i][bo_table]}'><font color="#ff9900">{$bo_subject}</font></a></td>
    <td width="" style="padding:3px 0 0 0; border-bottom:1px dotted #cccccc;">&nbsp;<a href='{$list[$i][href]}'><font color="#000000">{$list[$i][comment]}{$wr_subject}</font></a></td>
    <td align="center" style="padding:3px 0 0 0; border-bottom:1px dotted #cccccc;">{$list[$i][name]}</td>
    <td align="center" style="padding:3px 0 0 0; border-bottom:1px dotted #cccccc;">{$list[$i][datetime2]}</td>
    <!-- <a href="javascript:;" onclick="document.getElementById('mb_id').value='{$list[$i][mb_id]}';">&middot;</a> -->
</tr>

HEREDOC;
}
?>

<? if ($i == 0) { ?>
<tr><td colspan="6" height=50 align=center><?php echo $lang['416'];?></td></tr>
<? } ?>
<tr> 
    <td colspan="6" height="30" align="center">
 <? if ($prev_part_href) { echo "<a href='$prev_part_href'>이전검색</a>"; } ?>
 <div class="paginate"><?=$write_pages?></div>
 <? if ($next_part_href) { echo "<a href='$next_part_href'>다음검색</a>"; } ?>
          		</td>
</tr>
</table>
<script language="JavaScript">
function cls_check(f)
{
	var f=f;
	if(f.mb_id.value == "<?php echo $lang['411'];?>")
		cls(f)
}
function cls(f)
{
	var f=f;
	f.mb_id.value="";
}
</script>