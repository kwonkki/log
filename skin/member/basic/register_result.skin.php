<? include "css.php" ?>
<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
        <td width="550" bgcolor="#CFCFCF"></td>
    </tr>
    <tr> 
        <td width="550" align="center" valign="top" bgcolor="#F8F5F8" height="200"><table width="500" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td height="40"></td>
                </tr>
                <tr>
                    <td><b><?=$mb[mb_name]?></b><?php echo $lang['217'];?><p><?php echo $lang['218'];?> <b><?=$mb[mb_id]?></b> <?php echo $lang['219'];?><p><? if ($config[cf_use_email_certify]) { ?>E-mail(<?=$mb[mb_email]?>)<?php echo $lang['220'];?><? } ?><p><?php echo $lang['221'];?></td>
                </tr>
            </table></td>
    </tr>
    <tr> 
        <td width="550" height="20"></td>
    </tr>
    <tr>
        <td height="1" bgcolor="#F1F1F1"></td>
    </tr>
    <tr align="center" valign="bottom"> 
        <td width="550" height="60">
							<a class="btn2" href="<?=$g4['path']?>/"><?php echo $lang['216'];?></a></td>
    </tr>
</table>