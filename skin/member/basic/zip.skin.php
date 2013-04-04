<? include "css.php" ?>
<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<table border="0" width="100%" id="table1" cellspacing="0" cellpadding="0">
	<tr>
		<td height="3"></td>
	</tr>
</table>
<div align="center">

<table width="99%" border="0" cellpadding="0" cellspacing="0" id="table10">
<tr>
    <td align="center" bgcolor="#EBEBEB">
        <table border="0" width="100%" id="table11" cellpadding="3" cellspacing="3">
			<tr>
				<td>
        <table width="100%" height="40" border="0" cellspacing="0" cellpadding="0" id="table12">
        <tr> 
            <td width="25" align="center" bgcolor="#FFFFFF" >
			<img src="<?=$member_skin_path?>/img/icon_01.gif"></td>
            <td bgcolor="#FFFFFF" ><font color="#666666"><b>
			<?php echo $lang['256'];?></b></font></td>
        </tr>
        </table></td>
			</tr>
		</table>
	</td>
</tr>
</table>

</div>

<div align="center">

<table border="0" width="100%" id="table15" cellspacing="0" cellpadding="0">
	<tr>
		<td height="5"></td>
	</tr>
</table>
	<table border="0" width="99%" id="table13" cellspacing="0" cellpadding="0">
		<tr>
			<td>

<table border="0" cellspacing="0" cellpadding="0" id="table14">
<form name="fzip" method="get" autocomplete="off">
<input type=hidden name=frm_name  value='<?=$frm_name?>'>
<input type=hidden name=frm_zip1  value='<?=$frm_zip1?>'>
<input type=hidden name=frm_zip2  value='<?=$frm_zip2?>'>
<input type=hidden name=frm_addr1 value='<?=$frm_addr1?>'>
<input type=hidden name=frm_addr2 value='<?=$frm_addr2?>'>
<tr> 
    <td><b>
			<?php echo $lang['257'];?></b></td>
    <td>&nbsp;</td>
    <td><input type=text name=addr1 value='<?=$addr1?>' required minlength=2 itemname='<?php echo $lang['257'];?>' size=35> 
				<input type="submit" value="<?php echo $lang['04'];?>" name="B1" style="font-weight: bold" class="btn4"></td>
</tr>
</table>
			</td>
		</tr>
	</table>

<table border="0" width="100%" id="table16" cellspacing="0" cellpadding="0">
	<tr>
		<td height="5"></td>
	</tr>
</table>
</div>
<!-- 검색결과 여기서부터 -->

<script type='text/javascript'>
document.fzip.addr1.focus();
</script>


<? if ($search_count > 0) { ?>
<div align="center">
<table width="99%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td height="1" background="<?=$g4[bbs_img_path]?>/post_dot_bg.gif"></td>
</tr>
<tr> 
    <td height="50"><b>
			<?php echo $lang['118'];?></b> (<?=$search_count?>)</td>
</tr>
<tr> 
    <td height="50">
        <table width=100% cellpadding=0 cellspacing=0 id="table17">
        <?
        for ($i=0; $i<count($list); $i++) 
        {
            echo "<tr><td height=19><a href='javascript:;' onclick=\"find_zip('{$list[$i][zip1]}', '{$list[$i][zip2]}', '{$list[$i][addr]}');\">{$list[$i][zip1]}-{$list[$i][zip2]} : {$list[$i][addr]} {$list[$i][bunji]}</a></td></tr>\n";
        }
        ?>
        <tr>
            <td height=23>
			<hr style="border-style: dotted; border-width: 1px" color="#EBEBEB" size="0"></td>
        </tr>
        </table>
	</td>
</tr>
</table>

</div>

<script type="text/javascript">
function find_zip(zip1, zip2, addr1)
{
    var of = opener.document.<?=$frm_name?>;

    of.<?=$frm_zip1?>.value  = zip1;
    of.<?=$frm_zip2?>.value  = zip2;

    of.<?=$frm_addr1?>.value = addr1;

    of.<?=$frm_addr2?>.focus();
    window.close();
    return false;
}
</script>
<? } ?>