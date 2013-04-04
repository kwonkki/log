<? include "css.php" ?>
<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<script type="text/javascript" src="<?=$g4[path]?>/js/capslock.js"></script>

<form name=fmemberconfirm method=post onsubmit="return fmemberconfirm_submit(this);">
<input type=hidden name=mb_id value='<?=$member[mb_id]?>'>
<input type=hidden name=w     value='u'>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td width="628" bgcolor="#8F8F8F"></td>
</tr>
<tr> 
    <td width="628" align="right" background="<?=$member_skin_path?>/img/modify_table_bg_top.gif">
	<img src="<?=$member_skin_path?>/img/modify_img.gif"></td>
</tr>
<tr> 
    <td width="628" align="center" background="<?=$member_skin_path?>/img/modify_table_bg.gif">
        <table width="460" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="460" height="223" align="center" bgcolor="#FFFFFF">
                <table width="350" border="0" cellpadding="0" cellspacing="0">
                <tr> 
                    <td width="250">
                        <table width="250" border="0" cellpadding="0" cellspacing="0">
                        <tr> 
                            <td width="10"><img src="<?=$member_skin_path?>/img/icon.gif" width="3" height="3"></td>
                            <td width="90" height="26"><b><?php echo $lang['34'];?></b></td>
                            <td width="150"><b><?=$member[mb_id]?></b></td>
                        </tr>
                        <tr> 
                            <td><img src="<?=$member_skin_path?>/img/icon.gif" width="3" height="3"></td>
                            <td height="26"><b><?php echo $lang['37'];?></b></td>
                            <td><INPUT type=password maxLength=20 size=15 name="mb_password" id="confirm_mb_password" itemname="<?php echo $lang['37'];?>" required onkeypress="check_capslock('confirm_mb_password');"></td>
                        </tr>
                        </table>
                    </td>
                    <td width="100" valign="top">
					<input type="submit" value="<?php echo $lang['232'];?>" name="image1" class="btn13"><INPUT name="image" type=image src="<?=$member_skin_path?>/img/y.gif" border=0 id="btn_submit"></td>
                </tr>
                <tr> 
                    <td height="20" colspan="2"></td>
                </tr>
                <tr> 
                    <td height="1" background="<?=$member_skin_path?>/img/dot_line.gif" colspan="2"></td>
                </tr>
                </table>

                <table>
                <tr align="center"> 
                    <td height="80" colspan="2"><?php echo $lang['231'];?></td>
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
document.onload = document.fmemberconfirm.mb_password.focus();

function fmemberconfirm_submit(f)
{
    document.getElementById("btn_submit").disabled = true;

    f.action = "<?=$url?>";
    return true;
}
</script>