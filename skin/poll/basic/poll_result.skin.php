<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<? include "css.php" ?>
<script language="JavaScript">
<!--
function FP_goToURL(url) {//v1.0
 window.location=url;
}
// -->
</script>
</head>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#FF973D">
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr> 
          <td width="21"><img src="<?=$poll_skin_path?>/img/spacer.gif"></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="26" align="center">
						<img src="<?=$poll_skin_path?>/img/poll_re_06.gif"></td>
                      <td height="40"  style="padding-top:2px;"><span style="font-size:11px; letter-spacing: -1px; color:#000000; font-weight:bold;"><?=$po_subject?></span><span style="font-size:11px; letter-spacing: -1px;"> (<?php echo $lang['433'];?><?=$nf_total_po_cnt?><?php echo $lang['434'];?>)</span></td>
                    </tr>
                    <tr align="center"> 
                      <td colspan="2" background="<?=$poll_skin_path?>/img/poll_re_09.gif">
						<img src="<?=$poll_skin_path?>/img/poll_re_09.gif"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td height="10"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="26">
						<img src="<?=$poll_skin_path?>/img/poll_re_11.gif"></td>
                      <td background="<?=$poll_skin_path?>/img/poll_re_13.gif">
						<img src="<?=$poll_skin_path?>/img/poll_re_13.gif"></td>
                      <td width="19">
						<img src="<?=$poll_skin_path?>/img/poll_re_15.gif"></td>
                    </tr>
                    <tr> 
                      <td background="<?=$poll_skin_path?>/img/poll_re_20.gif">
						<img src="<?=$poll_skin_path?>/img/poll_re_20.gif"></td>
                      <td bgcolor="#F8F8F8" style="padding-bottom:3px;"><table width=100% cellpadding=0 cellspacing=0>
                          <? for ($i=1; $i<=count($list); $i++) { ?>
                          <tr> 
                            <td width="45%" height="25" style="font-size:11px; letter-spacing: -1px;"><?=$list[$i][num]?> . <?=$list[$i][content]?></td>
                            <td width="30%"><img src="<?=$poll_skin_path?>/img/poll_graph_y.gif" width="<?=(int)$list[$i][bar]?>" height="7"></td>
                            <td width="25%" style="font-size:11px; letter-spacing: -1px; font-weight:bold;"><?=$list[$i][cnt]?>  <?php echo $lang['434'];?> (<?=number_format($list[$i][rate], 1)?>%)</td>
                          </tr>
						  <tr align="center" > 
                            <td height="1" colspan="3" background="<?=$poll_skin_path?>/img/poll_re_31.gif"><img src="<?=$poll_skin_path?>/img/poll_re_31.gif" width="3" height="1"></td>
                           </tr>
                          <? } ?>
                        </table></td>
                      <td background="<?=$poll_skin_path?>/img/poll_re_22.gif">
						<img src="<?=$poll_skin_path?>/img/poll_re_22.gif"></td>
                    </tr>
                    <tr> 
                      <td><img src="<?=$poll_skin_path?>/img/poll_re_24.gif"></td>
                      <td align="center" background="<?=$poll_skin_path?>/img/poll_re_26.gif">
						<img src="<?=$poll_skin_path?>/img/poll_re_26.gif"></td>
                      <td><img src="<?=$poll_skin_path?>/img/poll_re_28.gif"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td align="center" background="<?=$poll_skin_path?>/img/poll_re_31.gif">
						<img src="<?=$poll_skin_path?>/img/poll_re_31.gif"></td>
                    </tr>
                    <tr> 
                      <td height="10"></td>
                    </tr>
                  </table></td>
              </tr>
			  
			  
			  
<? if ($is_etc) { ?>
              <tr> 
                <td>								
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="26">
						<img src="<?=$poll_skin_path?>/img/poll_re_34.gif"></td>
                      <td background="<?=$poll_skin_path?>/img/poll_re_13.gif" style="padding-top:3px; font-size:11px; letter-spacing: -1px; color:#000000;"><?=$po_etc?></td>
                      <td width="19">
						<img src="<?=$poll_skin_path?>/img/poll_re_15.gif"></td>
                    </tr>
                    <tr> 
                      <td background="<?=$poll_skin_path?>/img/poll_re_20.gif">
						<img src="<?=$poll_skin_path?>/img/poll_re_20.gif"></td>
                      <td bgcolor="#F8F8F8" style="padding-bottom:3px;">
					  
					  <? if ($member[mb_level] >= $po[po_level]) { ?>					  
						  <br>
&nbsp;<table width=100% cellpadding=0 cellspacing=0 border="0">
					  <form name="fpollresult" method="post" action="javascript:fpollresult_submit(document.fpollresult);" autocomplete="off">
                         <input type=hidden name=po_id value="<?=$po_id?>">
                           <input type=hidden name=w value="">
                          						  
						  
                          <tr> 
							<td><input type='text' name='pc_idea' style='width:100%; height:17px; font-size:11px;' class=input required itemname='<?php echo $lang['435'];?>' maxlength="100"></td>
							
							<? if ($member[mb_id]) { ?>
							<td width="50" align="center"><input type=hidden name=pc_name value="<?=cut_str($member[mb_nick],255)?>"><?=$member[mb_nick]?></td>
							<? } else { ?>
							<td width="30"  style="font-size:11px; letter-spacing: -1px;" align="center"><?php echo $lang['164'];?></td>
							<td width="60" ><input type='text' name='pc_name' style='width:100%; height:17px; font-size:11px;'  class=input required itemname='<?php echo $lang['164'];?>'></td>							
							 <? } ?>
							<td width="60" align="right" >
											<input type="submit" value="<?php echo $lang['232'];?>" name="B1" class="btn1111"></td>

                          </tr>
						  </form>
                        </table>
					<script language="JavaScript">
                     function fpollresult_submit(f)
                     {
                       f.action = "./poll_etc_update.php";
                       f.submit();
                    }
                    </script>
                  <? } ?>
						
						
						
                        <? for ($i=0; $i<count($list2); $i++) { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="15" colspan="2"></td>
                          </tr>
                          <tr> 
                            <td style="padding-left:7px; font-size:11px; letter-spacing: -1px;" bgcolor="#EAEAEA" height="25" width=""><?=$list2[$i][name]?><? if ($list2[$i][del]) { echo $list2[$i][del] . "&nbsp;&nbsp;<img src='$g4[bbs_img_path]/btn_comment_delete.gif' border=0 align=absmiddle ></a>"; } ?></td>
                              <td style="padding-right:7px; font-size:11px; color:#000000;" align="right"  bgcolor="#EAEAEA"><?=$list2[$i][datetime]?></td>
                          </tr>
						  
                          <tr> 
                            <td height="1" colspan="2" background="<?=$g4[bbs_img_path]?>/dot_bg.gif"  bgcolor="#EAEAEA"></td>
                          </tr>
                          <tr> 
                            <td height="25" colspan="2" bgcolor="#EAEAEA" style="padding-left:7px; font-size:11px; letter-spacing: -1px; color:#000000;"><?=$list2[$i][idea]?></td>
                          </tr>
                        </table>
                        <? } ?>
						
						
						
						
                      </td>
                      <td background="<?=$poll_skin_path?>/img/poll_re_22.gif">
						<img src="<?=$poll_skin_path?>/img/poll_re_22.gif"></td>
                    </tr>
                    <tr> 
                      <td><img src="<?=$poll_skin_path?>/img/poll_re_24.gif"></td>
                      <td align="center" background="<?=$poll_skin_path?>/img/poll_re_26.gif">
						<img src="<?=$poll_skin_path?>/img/poll_re_26.gif"></td>
                      <td><img src="<?=$poll_skin_path?>/img/poll_re_28.gif"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
 <? } ?>
			  
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<form name=fpolletc>
                    <tr> 
                      <td width="26">
						<img src="<?=$poll_skin_path?>/img/poll_re_44.gif"></td>
                        <td background="<?=$poll_skin_path?>/img/poll_re_46.gif" style="padding-bottom:19px; font-size:11px; letter-spacing: -1px; color:#000000; font-weight:bold;"><?php echo $lang['436'];?></td>
                      <td width="19">
						<img src="<?=$poll_skin_path?>/img/poll_re_48.gif"></td>
                    </tr>
                    <tr> 
                      <td background="<?=$poll_skin_path?>/img/poll_re_20.gif">
						<img src="<?=$poll_skin_path?>/img/poll_re_20.gif"></td>
                      <td bgcolor="#F8F8F8" style="padding: 0 5 7 0px;"> 
                          <select name=po_id onchange="select_po_id(this)" style='width:100%; height:17px; font-size:11px;'>
                            <? for ($i=0; $i<count($list3); $i++) { ?>
                            <option value='<?=$list3[$i][po_id]?>'>[ 
                            <?=$list3[$i][date]?>
                            ] 
                            <?=$list3[$i][subject]?>
                            <? } ?>
                          </select>
                          <script>document.fpolletc.po_id.value='<?=$po_id?>';</script>
                      </td>
                      <td background="<?=$poll_skin_path?>/img/poll_re_22.gif">
						<img src="<?=$poll_skin_path?>/img/poll_re_22.gif"></td>
                    </tr>
                    <tr> 
                      <td><img src="<?=$poll_skin_path?>/img/poll_re_24.gif"></td>
                      <td align="center" background="<?=$poll_skin_path?>/img/poll_re_26.gif">
						<img src="<?=$poll_skin_path?>/img/poll_re_26.gif"></td>
                      <td><img src="<?=$poll_skin_path?>/img/poll_re_28.gif"></td>
                    </tr>
					</form>
                  </table></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td align="right">
	<input type="button" value="<?php echo $lang['227'];?>" name="B36" class="btn2222" onclick="FP_goToURL(/*href*/'javascript:window.close();')"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          <td width="34" valign="top">
			<img src="<?=$poll_skin_path?>/img/poll_re_03.gif"></td>
        </tr>
      </table></td>
  </tr>
</table>
<script language='JavaScript'>
function select_po_id(fld) 
{
    document.location.href = "./poll_result.php?po_id="+fld.options[fld.selectedIndex].value;
}
</script>