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
					<?php echo $lang['224'];?> <?=$name?> <?php echo $lang['225'];?></b></font></td>
        </tr>
        </table></td>
			</tr>
		</table>
	</td>
</tr>
</table>

</div>

<form name="fformmail" method="post" onsubmit="return fformmail_submit(this);" enctype="multipart/form-data" style="margin:0px;">
<input type="hidden" name="to"     value="<?=$email?>">
<input type="hidden" name="attach" value="2">
<input type="hidden" name="token"  value="<?=$token?>">
<div align="center">
<table width="99%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td height="330" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="5"></td>
        </tr>
        <tr> 
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
            <td width="540" height="2" align="center" valign="top" bgcolor="#FFFFFF">
                <table border="0" width="100%" id="table2" cellspacing="0" cellpadding="0">
					<tr>
						<td height="5"></td>
					</tr>
				</table>
                <table width="540" border="0" cellspacing="0" cellpadding="0">
                <colgroup width="130">
                <colgroup width="10">
                <colgroup width="400">
                <? if ($is_member) { // 회원이면 ?>
                <input type='hidden' name='fnick'  value='<?=$member[mb_nick]?>'>
                <input type='hidden' name='fmail'  value='<?=$member[mb_email]?>'>
                <? } else { ?>
                <tr> 
                    <td height="21" align="center"><b><?php echo $lang['164'];?></b></td>
                    <td valign="bottom"><img src="<?=$member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input type=text style='width:90%;' name='fnick' required minlength=2 itemname='<?php echo $lang['164'];?>'></td>
                </tr>
                <tr> 
                    <td height="33" align="center"><b>E-mail</b></td>
                    <td valign="bottom"><img src="<?=$member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input type=text style='width:90%;' name='fmail' required email itemname='E-mail'></td>
                </tr>
                <? } ?>

                <tr> 
                    <td height="27" align="center"><b><?php echo $lang['59'];?></b></td>
                    <td valign="bottom"><img src="<?=$member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input type=text style='width:90%;' name='subject' required itemname='<?php echo $lang['59'];?>'></td>
                </tr>
                <tr> 
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr> 
                    <td height="28" align="center"><b><?php echo $lang['222'];?></b></td>
                    <td valign="bottom"><img src="<?=$member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input type='radio' name='type' value='0' checked> TEXT <input type='radio' name='type' value='1' > HTML <input type='radio' name='type' value='2' > TEXT+HTML</td>
                </tr>
                <tr> 
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr> 
                    <td height="110" align="center"><b><?php echo $lang['64'];?></b></td>
                    <td valign="bottom"><img src="<?=$member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><textarea name="content" style='width:90%;' rows='7' required itemname='<?php echo $lang['64'];?>'></textarea></td>
                </tr>
                <tr> 
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr> 
                    <td height="27" align="center"><?php echo $lang['223'];?> #1</td>
                    <td valign="bottom"><img src="<?=$member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input type=file style='width:90%;' name='file1'></td>
                </tr>
                <tr> 
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr> 
                    <td height="27" align="center"><?php echo $lang['223'];?> #2</td>
                    <td valign="bottom"><img src="<?=$member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input type=file style='width:90%;' name='file2'></td>
                </tr>
                <tr> 
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr> 
                    <td height="70" align="center"><img id='kcaptcha_image' /></td>
                    <td valign="bottom"><img src="<?=$member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input class='ed' type=input size=10 name=wr_key itemname="<?php echo $lang['94'];?>" required>&nbsp;&nbsp;<?php echo $lang['95'];?></td>
                </tr>
                <tr> 
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
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
<input type="submit" value="<?php echo $lang['226'];?>" name="B1" class="btn3">&nbsp;<input type="button" value="<?php echo $lang['227'];?>" name="B33" class="btn2" onclick="FP_goToURL(/*href*/'javascript:window.close();')"></td>
</tr>
</table>
</div>
</form>

<script type="text/javascript" src="<?="$g4[path]/js/md5.js"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"></script>
<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"></script>
<script type="text/javascript">
with (document.fformmail) {
    if (typeof fname != "undefined")
        fname.focus();
    else if (typeof subject != "undefined")
        subject.focus();
}

function fformmail_submit(f)
{
    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    if (f.file1.value || f.file2.value) {
        // 4.00.11
        if (!confirm("<?php echo $lang['273'];?>\n\n<?php echo $lang['274'];?>"))
            return false;
    }

    document.getElementById('btn_submit').disabled = true;

    f.action = "./formmail_send.php";
    return true;
}
</script>