<? include "css.php" ?>
<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

//if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'></nobr>
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<script language="JavaScript"> 
function errors() 
{ 
 return true; 
} 
window.onerror = errors; 
</script>

<!-- 게시판 목록 시작 -->

<table width="<?=$width?>" cellpadding=0 cellspacing=0>
	<tr>
		<td>

<!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 -->
		<table border="0" width="100%" id="table14" cellspacing="0" cellpadding="0">
			<tr>
				<td>
<table valign="bottom" width='100%' cellpadding="0" cellspacing="0" id="table15">
<tr align="center">
<?php
    $arr = explode("|", $board[bo_category_list]);
    $arr1   = explode("|", $board[bo_10]);
	$str = "";
    for ($i=0; $i<count($arr); $i++)
        if (trim($arr[$i])){
            if($arr[$i]==$sca){ 
			    $key    = array_search($sca, $arr);
			    $cate   = explode("^", $arr1[$key]);
			    $subca1 = $cate[0];
				$str .= "
				<td width='3'><img src='$board_skin_path/img/cat_tap_on_01.gif'></td>
				<td background='$board_skin_path/img/cat_tap_on_02.gif' style='padding:4 2 0 2' nowrap>
				<a href='$category_location$arr[$i]&sfl=wr_10&stx=$subca1&nca=$subca1'><b><font color=#1B57B3>$arr[$i]</font></b></a></td>
				<td width='3'><img src='$board_skin_path/img/cat_tap_on_03.gif'></td>
				";
				}else{ 
			    $key    = array_search($arr[$i], $arr);
			    $cate   = explode("^", $arr1[$key]);
			    $subca1=$cate[0];
				$str .= "
				<td width='3'><img src='$board_skin_path/img/cat_tap_off_01.gif'></td>
				<td background='$board_skin_path/img/cat_tap_off_02.gif' style='padding:4 2 0 2' nowrap>
				<a href='$category_location$arr[$i]&sfl=wr_10&stx=$subca1&nca=$subca1'><b><font color=#B8B8B8>$arr[$i]</font></b></a></td>
				<td width='3'><img src='$board_skin_path/img/cat_tap_off_03.gif'></td>
				";
				}
			}
	echo $str;
	echo "<td width='100%'></td>";
?>
</tr>
</table>
				</td>
				<td width="500">
				<div align="right">
				<table border="0" id="table16" cellspacing="1">
					<tr>
						<td>
        <? if ($rss_href) { ?><a href="<?=$rss_href?>" target="_blank"><img src='<?=$board_skin_path?>/img/btn_rss.gif' border=0 align=middle></a><?}?></td>
					</tr>
				</table>
				</div>
				</td>
			</tr>
			</table>

<!-- 제목 -->
		<form name="fboardlist" method="post" style="margin:0;">
			<input type='hidden' name='bo_table' value='<?=$bo_table?>'>
			<input type='hidden' name='sfl'  value='<?=$sfl?>'>
			<input type='hidden' name='stx'  value='<?=$stx?>'>
			<input type='hidden' name='spt'  value='<?=$spt?>'>
			<input type='hidden' name='page' value='<?=$page?>'>
			<input type='hidden' name='sw'   value=''>
			<table width=100% border="0" cellspacing="0" cellpadding="0" id="table8">
				<tr height=28 align=center>
					<td width=1 align="center" background="<?=$board_skin_path?>/img/3.jpg">
					<b>
					<img border="0" src="<?=$board_skin_path?>/img/1.jpg"></b></td>
					<td width=40 align="center" background="<?=$board_skin_path?>/img/3.jpg">
					<b><?php echo $lang['58'];?></b></td>
					<td width=1 align="center" background="<?=$board_skin_path?>/img/3.jpg">
					<img border="0" src="<?=$board_skin_path?>/img/4.jpg"></td>
    <?/* if ($is_category) { ?>
					<?}*/?>
    <? if ($is_checkbox) { ?><td align="center" background="<?=$board_skin_path?>/img/3.jpg">
						<input onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox name="C1" value="ON"></td>
    <?}?>
    <?/*?><?*/?>
    <? if ($is_good) { ?><?}?>
    <? if ($is_nogood) { ?><?}?>
    				<td align="center" background="<?=$board_skin_path?>/img/3.jpg">
					<b><?php echo $lang['59'];?></b></td>
    				<td align="center" width="1" background="<?=$board_skin_path?>/img/3.jpg">
					<img border="0" src="<?=$board_skin_path?>/img/4.jpg"></td>
    				<td align="center" background="<?=$board_skin_path?>/img/3.jpg" width="80">
					<b><?php echo $lang['60'];?></b></td>
    				<td align="center" width="1" background="<?=$board_skin_path?>/img/3.jpg">
					<img border="0" src="<?=$board_skin_path?>/img/4.jpg"></td>
					<td align="center" background="<?=$board_skin_path?>/img/3.jpg" width="40">
					<b><?php echo $lang['61'];?></b></td>
					<td align="center" width="1" background="<?=$board_skin_path?>/img/3.jpg">
					<img border="0" src="<?=$board_skin_path?>/img/4.jpg"></td>
					<td align="center" background="<?=$board_skin_path?>/img/3.jpg" width="40">
					<b><?php echo $lang['53'];?></b></td>
					<td align="center" width="1" background="<?=$board_skin_path?>/img/3.jpg">
					<b>
					<img border="0" src="<?=$board_skin_path?>/img/2.jpg"></b></td>
				</tr>

<!-- 목록 -->
<? for ($i=0; $i<count($list); $i++) { ?>
				<tr height=28 align=center>
					<td width="1" background="<?=$board_skin_path?>/img/bg.gif" height="31">
        </td>
					<td width="40" background="<?=$board_skin_path?>/img/bg.gif" height="31">
        <? 
        if ($list[$i][is_notice]) // 공지사항 
            echo "<img src=\"$board_skin_path/img/icon_notice.gif\">";
        else if ($wr_id == $list[$i][wr_id]) // 현재위치
            echo "<span style='font:bold 11px tahoma; color:#E15916;'>{$list[$i][num]}</span>";
        else
            echo "<span style='font:normal 11px tahoma; color:#B3B3B3;'>{$list[$i][num]}</span>";
        ?>    </td>
					<td width="1" background="<?=$board_skin_path?>/img/bg.gif" height="31">
        </td>
    <?/* if ($is_category) { ?>
					<? } */?>
    <? if ($is_checkbox) { ?><td background="<?=$board_skin_path?>/img/bg.gif" height="31">
					<input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"></td>
    <? } ?>
    <?/*?><?*/?>
    <? if ($is_good) { ?><? } ?>
    <? if ($is_nogood) { ?><? } ?>
    				<td background="<?=$board_skin_path?>/img/bg.gif" height="31">
						<table border="0" width="100%" id="table9" cellspacing="0" cellpadding="0">
							<tr>
								<td><? if ($list[$i][wr_2]) { ?><b><? }?><a href="<?=$list[$i][href]?>"><font color="<?=$list[$i][wr_1]?>">
								[<?=$list[$i][ca_name]?>] <?=$list[$i][subject]?></font></a></b> <?=$list[$i][icon_reply]?>&nbsp;<?=$list[$i][icon_new]?>&nbsp;<font color="#FF0066" size="1"><?=$list[$i][comment_cnt]?></font> <?=$list[$i][icon_file]?></td>
							</tr>
						</table>
					</td>
    				<td background="<?=$board_skin_path?>/img/bg.gif" height="31" width="1">
						</td>
    				<td background="<?=$board_skin_path?>/img/bg.gif" height="31" width="80">
      <?=$list[$i][name]?></td>
    				<td background="<?=$board_skin_path?>/img/bg.gif" height="31" width="1">
      </td>
					<td background="<?=$board_skin_path?>/img/bg.gif" height="31" width="40">
      <font color="#999999">
      <?=$list[$i][datetime2]?></font></td>
					<td background="<?=$board_skin_path?>/img/bg.gif" height="31" width="1">
      </td>
					<td background="<?=$board_skin_path?>/img/bg.gif" height="31" width="40">
      <font color="#999999">
      <?=$list[$i][wr_hit]?></font></td>
					<td width="1" background="<?=$board_skin_path?>/img/bg.gif" height="31"></td>
				</tr>
<?}?>

<? if (count($list) == 0) { echo "<tr><td colspan='$colspan' height=100 align=center>{$lang[264]}</td></tr>"; } ?>
			</table>
		</form>
		<table border="0" width="100%" id="table17" cellpadding="2">
			<tr>
				<td><table border="0" id="table18" cellpadding="2">
		<tr>
			<? if ($is_checkbox) { ?>
			<td align="center"><a class="btn3" href="javascript:select_delete();"><?php echo $lang['72'];?></a></td>
			<td align="center">
				<a class="btn3" href="javascript:select_copy('copy');"><?php echo $lang['73'];?></a></td>
			<td align="center">
				<a class="btn3" href="javascript:select_copy('move');"><?php echo $lang['74'];?></a></td>
			<? } ?>
			<td align="center">
    <? if ($admin_href) { ?><a class="btn6" href="<?=$admin_href?>"><?php echo $lang['62'];?></a><?}?></td>
			<td align="center">
    <? if ($list_href) { ?><a class="btn6" href="<?=$list_href?>"><?php echo $lang['75'];?></a><? } ?></td>
		</tr>
	</table></td>
				<td align="center" width="20"><? if ($write_href) { ?><a class="btn1" href="<?=$write_href?>"><?php echo $lang['76'];?></a><? } ?></td>
			</tr>
</table>
		<div style="height:1px; line-height:1px; font-size:1px; background-color:#eee; clear:both;">&nbsp;</div>
		<div style="height:1px; line-height:1px; font-size:1px; background-color:#ddd; clear:both;">&nbsp;</div>

 <? if ($prev_part_href) { echo "<a href='$prev_part_href'>이전검색</a>"; } ?>
 <div class="paginate"><?=$write_pages?></div>
 <? if ($next_part_href) { echo "<a href='$next_part_href'>다음검색</a>"; } ?>

		<div style="text-align:center;">
			<table border="0" width="100%" id="table10" cellspacing="1" bgcolor="#E7E7E7">
				<tr>
					<td bgcolor="#F8F7F7" height="41">
					<div align="right">
					<table border="0" id="table11" cellspacing="1">
					<form name=fsearch method=get style="margin:0px;">
				    <input type=hidden name=bo_table value="<?=$bo_table?>">
				    <input type=hidden name=sca      value="<?=$sca?>">
						<tr>
							<td>
				<select name=sfl style="height:25; width:94" size="0">
				<option value='wr_subject||wr_content||wr_1||wr_2||wr_3||wr_4||wr_5||wr_6||wr_7||wr_8||wr_9||wr_10||mb_id,0||wr_name,1||wr_name,0'><?php echo $lang['63'];?></option>
				<option value='wr_subject'><?php echo $lang['59'];?></option>
				<option value='wr_content'><?php echo $lang['64'];?></option>
				<option value='wr_subject||wr_content'><?php echo $lang['59'];?>+<?php echo $lang['64'];?></option>
				<option value='mb_id,1'><?php echo $lang['34'];?></option>
				<option value='mb_id,0'><?php echo $lang['34'];?>(Re)</option>
				<option value='wr_name,1'><?php echo $lang['65'];?></option>
				<option value='wr_name,0'><?php echo $lang['65'];?>(Re)</option></select></td>
							<td>
				<input name=stx maxlength=15 itemname="<?php echo $lang['66'];?>" required value='<?=$stx?>' style="width:204px; border:1px solid #BDBDBD; height:21px" size="10"></td>
							<td>
				<input type="submit" value="<?php echo $lang['04'];?>" name="B1" style="font-weight: bold" class="btn4"></td>
							<td>
				<input type=radio name=sop value=and>and 
			</td>
							<td>
				<input type=radio name=sop value=or checked>or 
			</td>
							<td width="10">&nbsp;
				</td>
						</tr>
					</form>
					</table>
					</div>
					</td>
					</tr>
				</table>
			</div></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>

<script language="JavaScript">
if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
    document.fsearch.sfl.value = '<?=$sfl?>';

    if ('<?=$sop?>' == 'and') 
        document.fsearch.sop[0].checked = true;

    if ('<?=$sop?>' == 'or')
        document.fsearch.sop[1].checked = true;
} else {
    document.fsearch.sop[0].checked = true;
}
</script>

<? if ($is_checkbox) { ?>
<script language="JavaScript">
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function check_confirm(str) {
    var f = document.fboardlist;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(str + "<?php echo $lang['68'];?>");
        return false;
    }
    return true;
}

// 선택한 게시물 삭제
function select_delete() {
    var f = document.fboardlist;

    str = "<?php echo $lang['67'];?>";
    if (!check_confirm(str))
        return;

    if (!confirm("<?php echo $lang['71'];?>"))
        return;

    f.action = "./delete_all.php";
    f.submit();
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "<?php echo $lang['69'];?>";
    else
        str = "<?php echo $lang['70'];?>";
                       
    if (!check_confirm(str))
        return;

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<? } ?><!-- 게시판 목록 끝 -->