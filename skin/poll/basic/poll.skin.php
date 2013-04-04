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

global $is_admin;

// 투표번호가 넘어오지 않았다면 가장 큰(최근에 등록한) 투표번호를 얻는다
if (!$po_id) 
{
    $po_id = $config[cf_max_po_id];

    if (!$po_id) return;
}

$po = sql_fetch(" select * from $g4[poll_table] where po_id = '$po_id' ");
?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<? include "css.php" ?>
<!-- 설문조사 시작 -->


<table align="center" cellpadding="0" cellspacing="0" width="100%" border="0" id="table4">
	<tr height="1">
		<td bgcolor="#d9d9d9" colspan="3"></td>
	</tr>
	<tr>
		<td width="1" bgcolor="#d9d9d9"></td>
		<td>
		<table cellpadding="0" cellspacing="2" width="100%" id="table5">
			<tr>
				<td background="<?=$poll_skin_path?>/img/title_bg_25.gif">
				<table cellpadding="5" cellspacing="0" width="100%" border="0" id="table6">
					<tr height="25">
						<td>
						<font color="#555555" ><b><?php echo $lang['428'];?></b></font></td>
						<td align="right">&nbsp;</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>		
		</td>
		<td width="1" bgcolor="#d9d9d9"></td>
	</tr>
	<tr height="1">
		<td bgcolor="#d9d9d9" colspan="3"></td>
	</tr>
</table>

<table align="center" cellpadding="0" cellspacing="0" width="100%" border="0" id="table7">
	<tr height="5"><td width="1" bgcolor="#d9d9d9"></td><td colspan="2"></td><td width="1" bgcolor="#d9d9d9"></td></tr>
	<tr>
		<td width="1" bgcolor="#d9d9d9"></td>
		<td width="5"></td>
		<td>

<table width="100%" border="0" cellpadding="0" cellspacing="0" id="table8">
	<form name="fpoll" method="post" action="<?=$g4[bbs_path]?>/poll_update.php" onsubmit="return fpoll_submit(this);" target="winPoll">
		<input type="hidden" name="po_id" value="<?=$po_id?>">
		<input type="hidden" name="skin_dir" value="<?=$skin_dir?>">
<!--   <tr>
    <td><img src="<?=$poll_skin_path?>/img/sm_t.gif" width="93" height="31"></td>
  </tr> -->
  		<tr>
			<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" id="table9">
				<tr>
					<td>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" id="table10">
						<tr>
							<td style="padding:6px">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table11">
								<tr>
									<td>
									<img src="<?=$poll_skin_path?>/img/sm_q.gif" align="middle">
									<b><font color="#666698"><?=$po[po_subject]?></font></b><? if ($is_admin == "super") { ?><a href="<?=$g4[admin_path]?>/poll_form.php?w=u&po_id=<?=$po_id?>"><img src="<?=$poll_skin_path?>/img/admin.gif" border=0 align=middle></a></center><? } ?></td>
								</tr>
								<tr>
									<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table12">
						<? for ($i=1; $i<=9 && $po["po_poll{$i}"]; $i++) { ?>
											<tr>
							<!-- <td width="25" align="center"><? if ($i == 1) { echo "<img src='$poll_skin_path/img/a.gif' width='12' height='13'>"; } else { echo "&nbsp;"; } ?></td> -->
												<td width="30" height="20" align="center">
												<input type="radio" name="gb_poll" value="<?=$i?>" id='gb_poll_<?=$i?>'></td>
												<td width="">
												<font color="#848484">
												<label for='gb_poll_<?=$i?>'><?=$po['po_poll'.$i]?></label></font></td>
										</tr>
						<? } ?>
										</table></td>
								</tr>
								<tr>
									<td>
									<table border="0" cellspacing="1" id="table13">
										<tr>
											<td>
											<input type="submit" value="<?php echo $lang['431'];?>" name="B1" class="btn1111"></td>
											<td align="center">
											<a class="btn1111" href="javascript:poll_result('<?=$po_id?>');"><?php echo $lang['432'];?></a></td>
										</tr>
									</table></td>
								</tr>
							</table>
							</td>
						</tr>
					</table></td>
				</tr>
			</table></td>
		</tr>
	</form>
</table>

		</td>
		<td width="1" bgcolor="#d9d9d9"></td>
	 </tr>
	 <tr height="5"><td width="1" bgcolor="#d9d9d9"></td><td colspan="2"></td><td width="1" bgcolor="#d9d9d9"></td></tr>
	 <tr height="1">
		<td bgcolor="#d9d9d9" colspan="4"></td>
	</tr>
</table>

<script language='JavaScript'>
function fpoll_submit(f)
{
    var chk = false;
    for (i=0; i<f.gb_poll.length;i ++) {
        if (f.gb_poll[i].checked == true) {
            chk = f.gb_poll[i].value;
            break;
        }
    }

    <?
    if ($member[mb_level] < $po[po_level])
        echo " alert('{$lang[422]} $po[po_level] {$lang[423]}'); return false; ";
    ?>

    if (!chk) {
        alert("<?php echo $lang['429'];?>");
        return false;
    }

    win_poll();
    return true;
}

function poll_result(po_id)
{
    <?
    if ($member[mb_level] < $po[po_level])
        echo " alert('{$lang[422]} $po[po_level] {$lang[430]}'); return false; ";
    ?>

    win_poll("<?=$g4[bbs_path]?>/poll_result.php?po_id="+po_id+"&skin_dir="+document.fpoll.skin_dir.value);
}
</script>

<!-- 설문조사 끝 -->