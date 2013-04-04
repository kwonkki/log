<? include "css.php" ?>
<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript">
<!--
function FP_goToURL(url) {//v1.0
 window.location=url;
}
// -->
</script>
</head>



<table border="0" width="100%" id="table1" cellspacing="0" cellpadding="0">
	<tr>
		<td height="3"></td>
	</tr>
</table>
<div align="center">

<table width="99%" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td align="center" bgcolor="#EBEBEB">
        <table border="0" width="100%" id="table5" cellpadding="3" cellspacing="3">
			<tr>
				<td>
        <table width="100%" height="40" border="0" cellspacing="0" cellpadding="0" id="table6">
        <tr> 
            <td width="25" align="center" bgcolor="#FFFFFF" >
			<img src="<?=$member_skin_path?>/img/icon_01.gif"></td>
            <td bgcolor="#FFFFFF" ><font color="#666666"><b>
			<?php echo $lang['233'];?></b></font></td>
        </tr>
        </table></td>
			</tr>
		</table>
	</td>
</tr>
</table>

</div>

<table border="0" width="100%" id="table2" cellspacing="0" cellpadding="0">
	<tr>
		<td height="5"></td>
	</tr>
</table>
<div align="center">

<table border="0" width="99%" id="table3" cellspacing="0" cellpadding="0">
	<tr>
		<td>

<table border="0" cellspacing="0" cellpadding="0" id="table4">
<tr> 
    <td width="99" align="center" valign="middle">
	<input type="button" value="<?php echo $lang['234'];?>" name="B33" class="btn15" onclick="FP_goToURL(/*href*/'memo.php?kind=recv')" style="color: #FFFFFF"></td>
    <td width="2" align="center" valign="middle">&nbsp;</td>
    <td width="99" align="center" valign="middle">
	<input type="button" value="<?php echo $lang['235'];?>" name="B34" class="btn16" onclick="FP_goToURL(/*href*/'memo.php?kind=send')" style="color: #FFFFFF"></td>
    <td width="2" align="center" valign="middle">&nbsp;</td>
    <td width="99" align="center" valign="middle">
	<input type="button" value="<?php echo $lang['236'];?>" name="B35" class="btn17" onclick="FP_goToURL(/*href*/'memo_form.php')" style="color: #FFFFFF"></td>
    <td width="2" align="center" valign="middle">&nbsp;</td>
    <td width="60" valign="middle" bgcolor="#EFEFEF">&nbsp;</td>
    <td width="4" align="center" valign="middle">
	<img src="<?=$member_skin_path?>/img/left_img.gif"></td>
    <td width="18" align="center" valign="middle" background="<?=$member_skin_path?>/img/bar_bg_img.gif">
	<img src="<?=$member_skin_path?>/img/arrow_01.gif"></td>
    <td width="148" align="left" valign="middle" background="<?=$member_skin_path?>/img/bar_bg_img.gif"><?php echo $lang['237'];?> [ <B><?=$total_count?></B> ] <?php echo $lang['238'];?></td>
    <td width="4"><img src="<?=$member_skin_path?>/img/right_img.gif"></td>
    <td width="3" bgcolor="#EFEFEF"></td>
</tr>
</table>

		</td>
	</tr>
</table>

</div>
<div align="center">

<table width="99%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td height="200" align="center" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="30">* <?php echo $lang['239'];?> <?=$config[cf_memo_del]?> <?php echo $lang['240'];?></td>
        </tr>
        <tr> 
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
            <td bgcolor="#FFFFFF">
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                <tr bgcolor=#E1E1E1 align=center> 
                    <td width="30%" height="24"><b><?php echo $lang['141'];?></b></td>
                    <td width=25%><b><?php echo $lang['241'];?></b></td>
                    <td width=25%><b><?php echo $lang['242'];?></b></td>
                    <td width=20%><b><?php echo $lang['243'];?></b></td>
                </tr>

                <? for ($i=0; $i<count($list); $i++) { ?>
                <tr height=25 bgcolor=#F6F6F6 align=center> 
                    <td width="30%"><?=$list[$i][name]?></td>
                    <td width="25%"><a href="<?=$list[$i][view_href]?>"><?=$list[$i][send_datetime]?></font></td>
                    <td width="25%"><a href="<?=$list[$i][view_href]?>"><?=$list[$i][read_datetime]?></font></td>
                    <td width="20%"><a href="javascript:del('<?=$list[$i][del_href]?>');">
					<img src="<?=$member_skin_path?>/img/btn_comment_delete.gif" border="0"></a></td>
                </tr>
                <? } ?>

                <? if ($i==0) { echo "<tr><td height=100 align=center colspan=4>{$lang[275]}</td></tr>"; } ?>
                </table></td>
        </tr>
        </table></td>
</tr>
<tr> 
    <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
</tr>
<tr>
    <td height="2" align="center" valign="top" bgcolor="#E6E6E6"></td>
</tr>
<tr>
    <td height="40" align="center" valign="bottom">
	<input type="button" value="<?php echo $lang['227'];?>" name="B36" class="btn2" onclick="FP_goToURL(/*href*/'javascript:window.close();')"><br>
	<br></td>
</tr>
</table>

</div>


