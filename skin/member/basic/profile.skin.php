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
			<?php echo $lang['183'];?></b></font></td>
        </tr>
        </table></td>
			</tr>
		</table>
	</td>
</tr>
</table>

</div>

<div align="center">

<table width="99%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td valign="top">
        <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="20" colspan="3"></td>
        </tr>
        <tr> 
            <td width="174" height="149" align="center" valign="middle" background="<?=$member_skin_path?>/img/self_intro_bg.gif">
                <table width="170" height="130" border="0" cellpadding="0" cellspacing="0">
                <tr> 
                    <td align="center" valign="middle"><?=$mb_nick?></td>
                </tr>
                </table></td>
            <td width="15" height="149"></td>
            <td width="351" height="149" align="center" valign="middle" background="<?=$member_skin_path?>/img/self_intro_bg_1.gif">
                <table width="300" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td width="30" height="25" align="center">
					<img src="<?=$member_skin_path?>/img/arrow_01.gif"></td>
                    <td width="270"><?php echo $lang['249'];?> : <?=$mb[mb_level]?></td>
                </tr>
                <tr> 
                    <td height="1" colspan="2" bgcolor="#FFFFFF"></td>
                </tr>
                <tr> 
                    <td width="30" height="25" align="center">
					<img src="<?=$member_skin_path?>/img/arrow_01.gif"></td>
                    <td width="270"><?php echo $lang['45'];?> : <?=number_format($mb[mb_point])?> <?php echo $lang['46'];?></td>
                </tr>
                <tr> 
                    <td height="1" colspan="2" bgcolor="#FFFFFF"></td>
                </tr>

                <? if ($mb_homepage) { ?>
                <tr> 
                    <td width="30" height="25" align="center">
					<img src="<?=$member_skin_path?>/img/arrow_01.gif"></td>
                    <td width="270"><?php echo $lang['99'];?> : <a href="<?=$mb_homepage?>" target="<?=$config[cf_link_target]?>"><?=$mb_homepage?></a></td>
                </tr>
                <tr> 
                    <td height="1" colspan="2" bgcolor="#FFFFFF"></td>
                </tr>
                <? } ?>

                <tr> 
                    <td width="30" height="25" align="center">
					<img src="<?=$member_skin_path?>/img/arrow_01.gif"></td>
                    <td width="270"><?php echo $lang['250'];?> : <?=($member[mb_level] >= $mb[mb_level]) ?  substr($mb[mb_datetime],0,10) ." (".$mb_reg_after.")" : "*^^*"; ?></td>
                </tr>
                <tr> 
                    <td height="1" colspan="2" bgcolor="#FFFFFF"></td>
                </tr>
                <tr> 
                    <td width="30" height="25" align="center">
					<img src="<?=$member_skin_path?>/img/arrow_01.gif"></td>
                    <td width="270"><?php echo $lang['251'];?> : <?=($member[mb_level] >= $mb[mb_level]) ? $mb[mb_today_login] : "*^^*";?></td>
                </tr>
                </table></td>
        </tr>
        <tr> 
            <td width="540" height="15" colspan="3" bgcolor="#FFFFFF"></td>
        </tr>
        <tr> 
            <td height="15" colspan="3" bgcolor="#FFFFFF">
			<img src="<?=$member_skin_path?>/img/top_line.gif"></td>
        </tr>
        <tr align="center" valign="top"> 
            <td colspan="3" background="<?=$member_skin_path?>/img/mid_line.gif" bgcolor="#FFFFFF"><table width="500" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td height="30" valign="top">
						<img src="<?=$member_skin_path?>/img/self_intro_icon_01.gif"></td>
                    </tr>
                    <tr>
                        <td height="100" valign="top"><?=$mb_profile?></td>
                    </tr>
                </table></td>
        </tr>
        <tr> 
            <td height="15" colspan="3" bgcolor="#FFFFFF">
			<img src="<?=$member_skin_path?>/img/down_line.gif"></td>
        </tr>
        <tr>
            <td height="50" colspan="3" bgcolor="#FFFFFF"></td>
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
    <td height="40" align="center" valign="bottom"> <input type="button" value="<?php echo $lang['227'];?>" name="B36" class="btn2" onclick="FP_goToURL(/*href*/'javascript:window.close();')"></td>
</tr>
</table>
</div>

