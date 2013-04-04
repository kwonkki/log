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
			<?php echo $lang['246'];?></b></font></td>
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

<table width="99%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td>
				<table border="0" id="table11" cellpadding="2">
					<tr>
						<td align="center">
				<a class="btn2" href="<?=$prev_link?>"><?php echo $lang['124'];?></a></td>
						<td align="center">
				<a class="btn2" href="<?=$next_link?>"><?php echo $lang['125'];?></a></td>
					</tr>
				</table>
&nbsp;</td>
        </tr>
        <tr> 
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
            <td align="center" bgcolor="#F6F6F6">
			<table width="100%" border="0" cellspacing="1" id="table12">
				<tr>
					<td bgcolor="#EFEFEF" height="25">&nbsp;
        <?php echo $lang['54'];?>:
        <?
        //$nick = cut_str($mb[mb_nick], $config[cf_cut_name]);
        $nick = get_sideview($mb[mb_id], $mb[mb_nick], $mb[mb_email], $mb[mb_homepage]);
        if ($kind == "recv")
            echo "{$memo[me_send_datetime]}";

        if ($kind == "send") 
            echo "{$memo[me_send_datetime]}"; 
        ?>
    </td>
				</tr>
			</table>
			<table width="99%" height="110" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td valign="top" style='padding-top:10px; padding-bottom:10px;' class=lh><?=conv_content($memo[me_memo], 0)?></td>
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
        <? if ($kind == "recv") echo "<a class=\"btn3\" href='./memo_form.php?me_recv_mb_id=$mb[mb_id]&me_id=$memo[me_id]'>{$lang[594]}</a>";?>
        <a class="btn2" href="memo.php?kind=<?=$kind?>"><?php echo $lang['75'];?></a>
        <a class="btn2" href="javascript:window.close();"><?php echo $lang['227'];?></a></td>
</tr>
</table>
</div>
<br>