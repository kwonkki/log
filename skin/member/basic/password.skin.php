<? include "css.php" ?>
<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<script type="text/javascript" src="<?=$g4[path]?>/js/capslock.js"></script>

<form name="fboardpassword" method=post onsubmit="return fboardpassword_submit(this);">
<input type=hidden name=w           value="<?=$w?>">
<input type=hidden name=bo_table    value="<?=$bo_table?>">
<input type=hidden name=wr_id       value="<?=$wr_id?>">
<input type=hidden name=comment_id  value="<?=$comment_id?>">
<input type=hidden name=sfl         value="<?=$sfl?>">
<input type=hidden name=stx         value="<?=$stx?>">
<input type=hidden name=page        value="<?=$page?>">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td width="628" bgcolor="#8F8F8F"></td>
</tr>
<tr> 
    <td width="628" align="right" background="<?=$member_skin_path?>/img/secrecy_table_bg_top.gif">
	<img src="<?=$member_skin_path?>/img/secrecy_img.gif"></td>
</tr>
<tr> 
    <td width="628" align="center" background="<?=$member_skin_path?>/img/secrecy_table_bg.gif">
        <table width="460" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="460" height="223" align="center" bgcolor="#FFFFFF">
                <table width="350" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td width="30" align="center">
					<img src="<?=$member_skin_path?>/img/icon.gif"></td>
                    <td width="70" align="left"><b><?php echo $lang['247'];?></b></td>
                    <td width="150"><INPUT type=password maxLength=20 size=15 name="wr_password" id="password_wr_password" itemname="<?php echo $lang['37'];?>" required onkeypress="check_capslock(event, 'password_wr_password');"></td>
                    <td width="100" height="100" valign="middle">
<input type="submit" value="<?php echo $lang['232'];?>" name="B1" class="btn13"></td>
                </tr>
                <tr align="center"> 
                    <td height="1" colspan="4" background="<?=$member_skin_path?>/img/dot_line.gif"></td>
                </tr>
                <tr align="center">
                    <td height="60" colspan="4"><?php echo $lang['248'];?></td>
                </tr>
                </table></td>
        </tr>
        </table></td>
</tr>
<tr> 
    <td width="628" bgcolor="#F0F0F0"></td>
</tr>
</table>

</form>

<script type='text/javascript'>
document.fboardpassword.wr_password.focus();

function fboardpassword_submit(f)
{
    f.action = "<?=$action?>";
    return true;
}
</script>
