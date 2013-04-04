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

<form name="fregister" method="POST" onsubmit="return fregister_submit(this);" autocomplete="off">

<table width="100%" cellspacing=0 cellspacing=0 cellpadding="0">
	<tr>
		<td>

    <? if ($config[cf_use_jumin]) { // 주민등록번호를 사용한다면 ?>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td bgcolor="#cccccc">
				<table cellspacing=1 cellpadding=0 width=100% border=0>
					<tr bgcolor="#ffffff">
						<td width="140" height=30>&nbsp;&nbsp;&nbsp;<b>이름</b></td>
						<td width="">&nbsp;&nbsp;&nbsp;<input name=mb_name itemname="이름" required minlength="2" nospace hangul class=ed></td>
					</tr>
					<tr bgcolor="#ffffff">
						<td height=30>&nbsp;&nbsp;&nbsp;<b>주민등록번호</b></td>
						<td>&nbsp;&nbsp;&nbsp;<input name=mb_jumin itemname="주민등록번호" required jumin minlength="13" maxlength=13 class=ed><font style="font-family:; font-size:9pt; color:#66a2c8">&nbsp;&nbsp;※ 숫자 13자리 중간에 - 없이 입력하세요.</font></td>
					</tr>
				</table></td>
			</tr>
		</table>
    <? } ?><table width="100%" cellspacing="1" bgcolor=#DDDDDD>
			<tr>
				<td height=40 bgcolor="#F6F6F6">&nbsp; <b><?php echo $lang['126'];?></b></td>
			</tr>
			<tr>
				<td align="center" valign="top" bgcolor="#FFFFFF">
				<textarea style="border:1px solid #FFFFFF; width: 98%; background-color:#FFFFFF" rows=10 readonly cols="1" name="reg"><?=get_text($config[cf_stipulation])?></textarea></td>
			</tr>
			<tr>
				<td height=40 bgcolor="#F6F6F6">&nbsp; 
				<input type=radio value=1 name=agree id=agree11>&nbsp;<label for=agree11><?php echo $lang['127'];?></label>
                &nbsp; <input type=radio value=0 name=agree id=agree10>&nbsp;<label for=agree10><?php echo $lang['128'];?></label>
				</td>
			</tr>
		</table><br>
		<table width="100%" cellspacing="1" bgcolor=#DDDDDD>
			<tr>
				<td height=40 bgcolor="#F6F6F6">&nbsp; <b><?php echo $lang['129'];?></b></td>
			</tr>
			<tr>
				<td align="center" valign="top" bgcolor="#FFFFFF">
				<textarea style="border:1px solid #FFFFFF; width: 98%; background-color:#FFFFFF" rows=10 readonly name="reg2" cols="1"><?=get_text($config[cf_privacy])?></textarea></td>
			</tr>
			<tr>
				<td height=40 bgcolor="#F6F6F6">&nbsp; 
				<input type=radio value=1 name=agree2 id=agree21>&nbsp;<label for=agree21><?php echo $lang['127'];?></label>
                &nbsp; <input type=radio value=0 name=agree2 id=agree20>&nbsp;<label for=agree20><?php echo $lang['128'];?></label>
				</td>
			</tr>
		</table></td>
	</tr>
</table>

<br>
<div align=center>
<input type="submit" value="<?php echo $lang['130'];?>" name="B1" class="btn3">
							<input type="button" value="<?php echo $lang['131'];?>" name="B33" class="btn2" onclick="FP_goToURL(/*href*/'javascript:history.back(-1);')"></div>

</form>


<script type="text/javascript">
function fregister_submit(f) 
{
    var agree1 = document.getElementsByName("agree");
    if (!agree1[0].checked) {
        alert("<?php echo $lang['276'];?>");
        agree1[0].focus();
        return false;
    }

    var agree2 = document.getElementsByName("agree2");
    if (!agree2[0].checked) {
        alert("<?php echo $lang['277'];?>");
        agree2[0].focus();
        return false;
    }

    f.action = "./register_form.php";
    return true;
}

if (typeof(document.fregister.mb_name) != "undefined")
    document.fregister.mb_name.focus();
</script>