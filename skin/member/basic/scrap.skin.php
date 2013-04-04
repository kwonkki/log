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
			<?php echo $lang['48'];?></b></font></td>
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
    <td height="200" align="center" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="20"></td>
        </tr>
        <tr> 
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
            <td bgcolor="#FFFFFF">
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                <tr bgcolor=#E1E1E1 align=center> 
                    <td width="10%" height="24"><b><?php echo $lang['58'];?></b></td>
                    <td width="12%"><b><?php echo $lang['252'];?></b></td>
                    <td width="38%"><b><?php echo $lang['59'];?></b></td>
                    <td width="25%"><b><?php echo $lang['253'];?></b></td>
                    <td width="10%"><b><?php echo $lang['82'];?></b></td>
                </tr>

                <? for ($i=0; $i<count($list); $i++) { ?>
                    <tr height=25 bgcolor="#F6F6F6" align="center"> 
                        <td height="24"><?=$list[$i][num]?></td>
                        <td><a href="javascript:;" onclick="opener.document.location.href='<?=$list[$i][opener_href]?>';"><?=$list[$i][bo_subject]?></a></td>
                        <td align="left" style='word-break:break-all;'>&nbsp;<a href="javascript:;" onclick="opener.document.location.href='<?=$list[$i][opener_href_wr_id]?>';"><?=$list[$i][subject]?></a></td>
                        <td><?=$list[$i][ms_datetime]?></td>
                        <td><a href="javascript:del('<?=$list[$i][del_href]?>');">
						<img src="<?=$member_skin_path?>/img/btn_comment_delete.gif" border="0"></a></td>
                    </tr>
                <? } ?>

                <? if ($i == 0) echo "<tr><td colspan=5 align=center height=100>{$lang[280]}</td></tr>"; ?>
                </table></td>
        </tr>
        </table></td>
</tr>
<tr> 
    <td height="30" align="center"><?=get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");?></td>
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
<br>