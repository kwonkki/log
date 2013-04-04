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
?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<!-- 로그인 후 외부로그인 시작 -->
					



<table border="0" width="100%" id="table48" bgcolor="#B6B8BB" cellspacing="1">
					<form name="fhead" method="post" action="javascript:fhead_submit(document.fhead);" autocomplete="off">
		            <input type="hidden" name="url" value="<?=$url?>">
						<tr>
							<td bgcolor="#FFFFFF">
							<div align="center">
								<table border="0" width="100%" id="table49" cellspacing="1" bgcolor="#FAFAFA">
									<tr>
										<td align="center">
							<div align="center">
								<table border="0" width="95%" id="table50" cellspacing="1">
									<tr>
										<td height="20"><font color="#2F3743"><b>
										<?php echo $lang['43'];?></b></font></td>
									</tr>
									<tr>
										<td height="25">
							<font color="#F76319"><b><?=$nick?></b></font><?php echo $lang['44'];?><? if ($is_admin == "super" || $is_auth) { ?><a href="<?=$g4['admin_path']?>/"><font color="#FF5050">A</font></a><? } ?></td>
									</tr>
									<tr>
										<td>
										<a href="javascript:win_point();">
						<font color="#666666"><b><?php echo $lang['45'];?>:</b><?=$point?>,<?php echo $lang['46'];?></font></a> 
										/ <a href="javascript:win_memo();">
						<font color="#666666"><?php echo $lang['47'];?> </font><font color="#FF6600">[<?=$memo_not_read?>]</font></a> 
												/
						<a href="javascript:win_scrap();"><font color="#666666"><?php echo $lang['48'];?></font></a></td>
									</tr>
									<tr>
										<td><hr color="#DCDCDC" size="0"></td>
									</tr>
									<tr>
										<td><b>
										<a href="<?=$g4['bbs_path']?>/member_confirm.php?url=register_form.php">
										<font color="#2F3743"><?php echo $lang['49'];?></font></a></b> 
										<font color="#D6D6D6">| 
										</font> 
										<a href="<?=$g4['bbs_path']?>/logout.php">
										<font color="#848689"><?php echo $lang['50'];?></font></a></td>
									</tr>
								</table>
							</div>
										</td>
									</tr>
								</table>
							</div>
							</td>
						</tr>
					</form>
					</table>

<script language="JavaScript">
// 탈퇴의 경우 아래 코드를 연동하시면 됩니다.
function member_leave() 
{
    if (confirm("정말 회원에서 탈퇴 하시겠습니까?")) 
            location.href = "<?=$g4['bbs_path']?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- 로그인 후 외부로그인 끝 -->