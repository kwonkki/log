<?

$nhn1 = $_GET['nhn1'];
if($nhn1 != ''){
	@setcookie('lang',$nhn1,time()+3600*24,'/');
	include("lang/$nhn1.php");
}else{
	$file = $_COOKIE['lang'];
	if(!$file) $file = 'kr';
	include("lang/$file.php");
}

if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$url = '';
if ($g4['https_url']) {
    if (preg_match("/^\./", $urlencode))
        $url = $g4[url];
    else
        $url = $g4[url].$urlencode;
} else {
    $url = $urlencode;
}
?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<script type="text/javascript" language=JavaScript>
// 엠파스 로긴 참고
var bReset = true;
function chkReset(f) 
{
    if (bReset) { if ( f.mb_id.value == '{$lang[34]}' ) f.mb_id.value = ''; bReset = false; }
    document.getElementById("pw1").style.display = "none";
    document.getElementById("pw2").style.display = "";
}
</script>

<!-- 로그인 전 외부로그인 시작 -->
					





<table border="0" width="100%" id="table37" bgcolor="#B6B8BB" cellspacing="1">
					<form name="fhead" method="post" action="javascript:fhead_submit(document.fhead);" autocomplete="off">
		            <input type="hidden" name="url" value="<?=$url?>">
						<tr>
							<td bgcolor="#FFFFFF">
							<div align="center">
								<table border="0" width="100%" id="table43" cellspacing="1" bgcolor="#FAFAFA">
									<tr>
										<td align="center">
								<table border="0" width="95%" id="table44" cellspacing="1">
									<tr>
										<td height="20"><font color="#2F3743"><b>
										<?php echo $lang['33'];?></b></font></td>
									</tr>
									<tr>
										<td>
										<table border="0" id="table45" cellspacing="0" cellpadding="0">
											<tr>
												<td>
							<table onmouseover="this.style.background='#32AF00'" onmouseout="this.style.background=''" cellspacing="0" id="table46" cellpadding="0">
								<tr>
									<td>
													<input name="mb_id" type="text" size="25" maxlength="20" required itemname="<?php echo $lang['34'];?>" value='<?php echo $lang['34'];?>' onMouseOver='chkReset(this.form);' onFocus='chkReset(this.form);' class="nhn2"></td>
								</tr>
							</table>
												</td>
												<td width="4">&nbsp;</td>
												<td>
												<input type="checkbox" name="auto_login" value="1" onclick="if (this.checked) { if (confirm('<?php echo $lang['35'];?>')) { this.checked = true; } else { this.checked = false; } }"><font color="#6B6D70">ID<?php echo $lang['36'];?></font></td>
											</tr>
											<tr>
												<td height="2"></td>
												<td height="2" width="4"></td>
												<td height="2"></td>
											</tr>
											<tr>
												<td>
													<table onmouseover="this.style.background='#32AF00'" onmouseout="this.style.background=''" cellspacing="0" id="table47" cellpadding="0">
														<tr>
															<td id=pw1>
															<input type="text" size="25" maxlength="20" required itemname="<?php echo $lang['37'];?>" value='<?php echo $lang['37'];?>' onMouseOver='chkReset(this.form);' onfocus='chkReset(this.form);' class="nhn2"></td>
															<td id=pw2 style='display:none;'>
															<input name="mb_password" type="password" size="25" maxlength="20" itemname="<?php echo $lang['37'];?>" onMouseOver='chkReset(this.form);' onfocus='chkReset(this.form);' class="nhn2"></td>
														</tr>
													</table></td>
												<td width="4">&nbsp;</td>
												<td>
					<input type="submit" value="<?php echo $lang['38'];?>" name="B1" class="nhn9" style="color:#2F3743"></td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td><hr color="#DCDCDC" size="0"></td>
									</tr>
									<tr>
										<td><b>
										<a href="<?=$g4[bbs_path]?>/register.php">
										<font color="#2F3743"><?php echo $lang['39'];?></font></a></b> 
										<font color="#D6D6D6">| 
										</font> 
										<a href="javascript:win_password_forget();">
										<font color="#848689"><?php echo $lang['40'];?></font></a></td>
									</tr>
								</table>
										</td>
									</tr>
								</table>
							</div>
							</td>
						</tr>
					</form>
					</table>

<script language="JavaScript">
function fhead_submit(f)
{
    if (!f.mb_id.value)
    {
        alert("<?php echo $lang['41'];?>");
        f.mb_id.focus();
        return;
    }

    if (document.getElementById('pw2').style.display!='none' && !f.mb_password.value)
    {
        alert("<?php echo $lang['42'];?>");
        f.mb_password.focus();
        return;
    }

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/login_check.php';";
    else
        echo "f.action = '$g4[bbs_path]/login_check.php';";
    ?>
    f.submit();
}
</script>
<!-- 로그인 전 외부로그인 끝 -->