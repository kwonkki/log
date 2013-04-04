<? include "css.php" ?>
<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<head>
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

<table width="99%" border="0" cellpadding="0" cellspacing="0" id="table7">
<tr>
    <td align="center" bgcolor="#EBEBEB">
        <table border="0" width="100%" id="table8" cellpadding="3" cellspacing="3">
			<tr>
				<td>
        <table width="100%" height="40" border="0" cellspacing="0" cellpadding="0" id="table9">
        <tr> 
            <td width="25" align="center" bgcolor="#FFFFFF" >
			<img src="<?=$member_skin_path?>/img/icon_01.gif"></td>
            <td bgcolor="#FFFFFF" ><font color="#666666"><b>
			<?php echo $lang['236'];?></b></font></td>
        </tr>
        </table></td>
			</tr>
		</table>
	</td>
</tr>
</table>

</div>

<table border="0" width="100%" id="table10" cellspacing="0" cellpadding="0">
	<tr>
		<td height="5"></td>
	</tr>
</table>
<div align="center">
	<table border="0" width="99%" id="table11" cellspacing="0" cellpadding="0">
		<tr>
			<td>

<table border="0" cellspacing="0" cellpadding="0" id="table12">
<tr> 
    <td width="99" align="center" valign="middle">
	<input type="button" value="<?php echo $lang['234'];?>" name="B33" class="btn18" onclick="FP_goToURL(/*href*/'memo.php?kind=recv')" style="color: #FFFFFF"></td>
    <td width="2"  align="center" valign="middle">&nbsp;</td>
    <td width="99" align="center" valign="middle">
	<input type="button" value="<?php echo $lang['235'];?>" name="B34" class="btn18" onclick="FP_goToURL(/*href*/'memo.php?kind=send')" style="color: #FFFFFF"></td>
    <td width="2"  align="center" valign="middle">&nbsp;</td>
    <td width="99" align="center" valign="middle">
	<input type="button" value="<?php echo $lang['236'];?>" name="B35" class="btn19" onclick="FP_goToURL(/*href*/'memo_form.php')" style="color: #FFFFFF"></td>
    <td width="2"  valign="middle">&nbsp;</td>
    <td width="60" bgcolor="#EFEFEF">&nbsp;</td>
    <td width="4"  bgcolor="#EFEFEF"">&nbsp;</td>
    <td width="18" bgcolor="#EFEFEF">&nbsp;</td>
    <td width="148" bgcolor="#EFEFEF">&nbsp;</td>
    <td width="4" bgcolor="#EFEFEF">&nbsp;</td>
    <td width="3" bgcolor="#EFEFEF"></td>
</tr>
</table>

			</td>
		</tr>
	</table>
</div>
<div align="center">

<table width="99%" border="0" cellspacing="0" cellpadding="0">
<form name=fmemoform method=post onsubmit="return fmemoform_submit(this);" autocomplete="off">
<tr> 
    <td height="300" valign="top">
        <table width="546" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="5"></td>
        </tr>
        <tr> 
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
            <td height="2" align="center" valign="top" bgcolor="#FFFFFF">
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                <tr bgcolor=#E1E1E1 align=center> 
                    <td width="30%" height="24" rowspan="2"><b><?php echo $lang['244'];?></b></td>
                    <td width="70%" align="center"><input type=text name="me_recv_mb_id" required itemname="<?php echo $lang['244'];?>" value="<?=$me_recv_mb_id?>" style="width:95%;"></td>
                </tr>
                <tr bgcolor=#E1E1E1 align=center> 
                    <td><?php echo $lang['245'];?></td>
                </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td height="180" align="center" bgcolor="#F6F6F6">
                <textarea name=me_memo rows=10 style='width:95%;' required itemname='<?php echo $lang['64'];?>'><?=$content?></textarea></td>
        </tr>
        <tr> 
            <td>
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                <tr align=center> 
                    <td width="30%" height="24" rowspan="2"><img id='kcaptcha_image' /></td>
                    <td width="70%" align="left">
                        <input type=input size=10 name=wr_key itemname="<?php echo $lang['94'];?>" required>&nbsp;&nbsp;<?php echo $lang['95'];?>
                    </td>
                </tr>
                </table>
            </td>
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
        <input type="submit" value="<?php echo $lang['236'];?>" name="B1" class="btn3"><input id=btn_submit type=image src="<?=$member_skin_path?>/img/y.gif" border=0> <input type="button" value="<?php echo $lang['227'];?>" name="B36" class="btn2" onclick="FP_goToURL(/*href*/'javascript:window.close();')"></td>
</tr>
</form>
</table>

</div>

<script type="text/javascript" src="<?=$g4[path]?>/js/md5.js"></script>
<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"></script>
<script type="text/javascript">
with (document.fmemoform) {
    if (me_recv_mb_id.value == "")
        me_recv_mb_id.focus();
    else
        me_memo.focus();
}

function fmemoform_submit(f)
{
    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    document.getElementById("btn_submit").disabled = true;

    f.action = "./memo_form_update.php";
    return true;
}
</script>