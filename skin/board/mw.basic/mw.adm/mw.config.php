<?
/**
 * Bechu-Basic Skin for Gnuboard4
 *
 * Copyright (c) 2008 Choi Jae-Young <www.miwit.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

include_once("_common.php");
include_once("$board_skin_path/mw.lib/mw.skin.basic.lib.php");

if ($is_admin != "super")
    alert_close("접근 권한이 없습니다.");

$admin_menu[config] = "select";

if (!$tn) $tn = 0;

if (!$mw_basic[cf_type]) $mw_basic[cf_type] = "list";

$g4[title] = "배추 BASIC SKIN 관리자";
//include_once("mw.head.php");
include_once("$g4[path]/head.sub.php");
?>

<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>

<link rel="stylesheet" href="<?=$board_skin_path?>/mw.js/ui-lightness/jquery-ui-1.7.2.custom.css" type="text/css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?="$board_skin_path/mw.js/selectbox.js"?>"></script>
<script type="text/javascript" src="<?="$board_skin_path/mw.js/mw.config.js"?>"></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#tabs").tabs();
    $("#tabs").tabs('option', 'selected', <?=$tn?>);

    $("#preloader").css('display', 'none');
    $("#load").css('display', 'block');
});
function fsend() {
    document.cf_form.tn.value = $('#tabs').tabs('option', 'selected')
    document.cf_form.submit();
}
function reload_config() {
    $.get("mw.reload.config.php?bo_table=<?=$bo_table?>", function (ret) {
        alert(ret);
        location.reload();
    });
}
</script>

<style type="text/css">
img { border:0; }
body { text-align:center; }
#preloader { margin:300px auto 0 auto; text-align:center; }
#load { display:none; }
.notice { margin:10px; padding:5px 0 5px 10px; color:#999; border:1px solid #ddd; display:none; }
#board { margin:0 10px 5px 10px; font-weight:bold; text-align:right; }
#tabs { margin:10px; font-family:dotum; font-size:12px; }
#tabs .tabs { margin:0 0 20px 0; }
#tabs .tabs .cf_item { padding:5px 0 5px 0; clear:both; }
#tabs .tabs .cf_item .cf_title { float:left; width:180px; font-weight:bold; }
#tabs .tabs .cf_item .cf_content { float:left; display:block; }
#tabs .tabs .cf_item span.cf_info { font-size:11px; color:#999; margin:0 0 0 10px; }
#tabs .tabs .cf_item span.cf_info a { font-size:11px; color:#999; }
#tabs .tabs .cf_item div.cf_info { font-size:11px; color:#999; margin:5px 0 0 0; }
#tabs .tabs .block { clear:both; }

input.ed { height:20px; border:1px solid #9A9A9A; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:0 0 0 3px; }
textarea { border:1px solid #9A9A9A; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:0 0 0 3px; }
input.bt { background-color:#efefef; height:20px; cursor:pointer; font-size:11px; font-family:dotum; }

</style>

<div id="preloader"><img src="<?=$board_skin_path?>/img/preloader.gif"></div>

<div id="load">

<div><a href="http://www.miwit.com" target="_blank"><img src="<?=$board_skin_path?>/img/logo_curlychoi.gif"></a></div>

<div id="board">
<input type="button" class="bt" value="설정다시읽기" onclick="reload_config()">
<span style="color:#1C94C4"><?=$board[bo_subject]?></span> 게시판 배추스킨 설정
</div>

<form name="cf_form" method="post" action="mw.config.update.php">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="tn" value="0">

<div id="tabs">
<ul>
    <li> <a href="#tabs-1">기본설정</a> </li>
    <li> <a href="#tabs-2">모양</a> </li>
    <li> <a href="#tabs-3">기능</a> </li>
    <li> <a href="#tabs-4">알림</a> </li>
    <li> <a href="#tabs-5">데이터</a> </li>
    <li> <a href="#tabs-5-2">이미지</a> </li>
    <li> <a href="#tabs-5-5">에디터</a> </li>
    <li> <a href="#tabs-6">접근권한</a> </li>
    <li> <a href="#tabs-7">플러그인</a> </li>
    <li> <a href="#tabs-8">컨텐츠샵</a> </li>
    <li> <a href="#tabs-8-5">실명인증</a> </li>
    <li> <a href="#tabs-9">통계</a> </li>
    <li> <a href="#tabs-10">버전확인</a> </li>
</ul>

<div class="notice">
    <input type=checkbox onclick="if (this.checked) all_checked(true); else all_checked(false);">
    체크시 이 그룹에 속한, 이 스킨을 사용하는 모든 게시판에 동일하게 적용합니다.
</div>

<div id="tabs-1" class="tabs"> <!-- 기본설정 -->
    <div class="cf_item">
	<div class="cf_title"><input type=checkbox name=chk[cf_type] value=1>&nbsp;  목록형태 </div>
	<div class="cf_content">
	    <table>
	    <colgroup width="80"/>
	    <colgroup width="80"/>
	    <colgroup width="80"/>
	    <colgroup width="80"/>
	    <tbody valign=top align=center>
	    <tr>
		<td>
		    <img src="<?=$board_skin_path?>/mw.adm/img/cf_type_list.gif" width=40 height=46 required itemname="목록 형태"> <br/>
		    <input type=radio name=cf_type value="list"> 목록형
		</td>
		<td>
		    <img src="<?=$board_skin_path?>/mw.adm/img/cf_type_thumb.gif" width=40 height=46 required itemname="목록 형태"> <br/>
		    <input type=radio name=cf_type value="thumb"> 썸네일형
		</td>
		<td>
		    <img src="<?=$board_skin_path?>/mw.adm/img/cf_type_gall.gif" width=40 height=46 required itemname="목록 형태"> <br/>
		    <input type=radio name=cf_type value="gall"> 갤러리형
		</td>
		<td>
		    <img src="<?=$board_skin_path?>/mw.adm/img/cf_type_desc.gif" width=40 height=46 required itemname="목록 형태"> <br/>
		    <input type=radio name=cf_type value="desc"> 요약형
		</td>
	    </tr>
	    </tbody>
	    </table>
	</div>
	<script type="text/javascript">
	var ct = document.cf_form.cf_type;
	for (i=0; i<ct.length; i++) {
	    if (ct[i].value == "<?=$mw_basic[cf_type]?>") {
		break;
	    }
	}
	document.cf_form.cf_type[i].checked = true;
	</script>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_desc_len] value=1>&nbsp; 요약형 길이 </div>
	<div class="cf_content">
	    <input type=text size=5 name=cf_desc_len class=ed required itemname="요약형 길이" numeric value="<?=$mw_basic[cf_desc_len]?>">
	    <span class="cf_info">(목록에서의 요약내용 글자수. 잘리는 글은 … 로 표시)</span>
	</div>
    </div>


    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_attribute] value=1>&nbsp; 속성 </div>
	<div class="cf_content">
	    <select name=cf_attribute onchange="attchg(this.value)">
	    <option value="basic"> 일반 게시판</option>
	    <option value="1:1"> 1:1 게시판 </option>
	    <option value="anonymous"> 익명 게시판 </option>
	    <option value="qna"> 질문 게시판 </option>
	    </select>
	</div>
    </div>

    <div class="cf_item" id="cf_attqna" style="display:none">
        <div class="cf_title">  <input type=checkbox name=chk[cf_qna_point_use] value=1>&nbsp;  질문 게시판 포인트 </div>
	<div class="cf_content">
            <input type="checkbox" name="cf_qna_point_use" value="1"> 사용
            <input type="text" class="ed" name="cf_qna_point_min" size="4" numeric value="<?=$mw_basic[cf_qna_point_min]?>"> 이상 ~
            <input type="text" class="ed" name="cf_qna_point_max" size="4" numeric value="<?=$mw_basic[cf_qna_point_max]?>"> 이하.
            채택자 <input type="text" class="ed" name="cf_qna_save" size="3" numeric value="<?=$mw_basic[cf_qna_save]?>"> % 적립
            + 추가 <input type="text" class="ed" name="cf_qna_point_add" size="4" numeric value="<?=$mw_basic[cf_qna_point_add]?>"> 포인트,
            보류시  <input type="text" class="ed" name="cf_qna_hold" size="4" numeric value="<?=$mw_basic[cf_qna_hold]?>">% 복원
            <div style="padding:10px 0 10px 0;">
            미해결 질문이 <input type="text" class="ed" name="cf_qna_count" size="4" numeric value="<?=$mw_basic[cf_qna_count]?>"> 개 
            이상이면 더이상 질문을 할 수 없음. <span class="cf_info">(0으로 하면 제한 없음)</span>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    document.cf_form.cf_attribute.value = "<?=$mw_basic[cf_attribute]?>";
    document.cf_form.cf_qna_point_use.checked = "<?=$mw_basic[cf_qna_point_use]?>";

    function attchg(v) {
        if (v == 'qna') {
            $("#cf_attqna").css("display", "block");
        } else {
            $("#cf_attqna").css("display", "none");
        }
    }
    attchg(document.cf_form.cf_attribute.value);
    </script>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_hot] value=1>&nbsp; 인기 게시물 </div>
	<div class="cf_content">
	    <select name=cf_hot>
	    <option value="0"> 사용안함 </option>
	    <option value="1"> 실시간 </option>
	    <option value="2"> 주간 </option>
	    <option value="3"> 월간 </option>
	    <option value="4"> 일간 </option>
	    </select>
	    <select name=cf_hot_basis>
	    <option value="hit"> 조회수 </option>
	    <option value="good"> 추천수 </option>
	    <option value="comment"> 댓글수 </option>
	    <option value="link1_hit"> 링크1 클릭수 </option>
	    </select>
	    <span class="cf_info">(목록상단에 인기게시물을 출력합니다.)</span>
	    <script type="text/javascript">
	    document.cf_form.cf_hot.value = "<?=$mw_basic[cf_hot]?>";
	    document.cf_form.cf_hot_basis.value = "<?=$mw_basic[cf_hot_basis]?>";
	    </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_related] value=1>&nbsp; 관련글 </div>
	<div class="cf_content">
	    <select name=cf_related>
	    <option value="0"> 사용안함 </option>
	    <option value="3"> 3건 출력 </option>
	    <option value="5"> 5건 출력 </option>
	    <option value="7"> 7건 출력 </option>
	    <option value="10"> 10건 출력 </option>
	    </select>
	    <span class="cf_info">(본문하단에 관련 게시물을 출력합니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_related.value = "<?=$mw_basic[cf_related]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_related_table] value=1>&nbsp; 관련글 타게시판 </div>
	<div class="cf_content">
            <input type="text" size="10" class="ed" name="cf_related_table" value="<?=$mw_basic[cf_related_table]?>">
	    <span class="cf_info">(관련 게시물을 다른게시판에서 검색합니다. 게시판 TABLE 명을 넣어주세요.)</span>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_latest] value=1>&nbsp; 최신글 </div>
	<div class="cf_content">
	    <select name=cf_latest>
	    <option value="0"> 사용안함 </option>
	    <option value="3"> 3건 출력 </option>
	    <option value="5"> 5건 출력 </option>
	    <option value="7"> 7건 출력 </option>
	    <option value="10"> 10건 출력 </option>
	    </select>
	    <span class="cf_info">(본문하단에 글작성자의 최근게시물을 출력합니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_latest.value = "<?=$mw_basic[cf_latest]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_latest_table] value=1>&nbsp; 최신글 타게시판 </div>
	<div class="cf_content">
            <input type="text" size="10" class="ed" name="cf_latest_table" value="<?=$mw_basic[cf_latest_table]?>">
	    <span class="cf_info">(관련 게시물을 다른게시판에서 검색합니다. 게시판 TABLE 명을 넣어주세요.)</span>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_print] value=1>&nbsp; 인쇄 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_print value=1> 사용 <span class="cf_info">(본문 인쇄 기능)</span>  
	    <script type="text/javascript"> document.cf_form.cf_print.checked = <?=$mw_basic[cf_print]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_link_board] value=1>&nbsp; 링크 게시판  </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_link_board value=1> 사용 <span class="cf_info">(제목을 클릭하면 link1 의 주소로 이동, 관리자제외)</span> 
	    <script type="text/javascript"> document.cf_form.cf_link_board.checked = <?=$mw_basic[cf_link_board]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_list_shuffle] value=1>&nbsp; 게시물 목록 셔플 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_list_shuffle value=1> 사용 <span class="cf_info">(페이지 내의 게시물 목록을 섞습니다.)</span>  
	    <script type="text/javascript"> document.cf_form.cf_list_shuffle.checked = '<?=$mw_basic[cf_list_shuffle]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_norobot_image] value=1>&nbsp; 이미지 방지코드 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_norobot_image value=1> 사용 <span class="cf_info">(그누보드 4.22.00 이전 버전은 사용불가)</span>
	    <script type="text/javascript"> document.cf_form.cf_norobot_image.checked = <?=$mw_basic[cf_norobot_image]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_subject_link] value=1>&nbsp; 권한별 제목링크  </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_subject_link value=1> 사용 <span class="cf_info">(권한이 없으면 제목링크를 삭제)</span>
	    <script type="text/javascript"> document.cf_form.cf_subject_link.checked = <?=$mw_basic[cf_subject_link]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_write_button] value=1>&nbsp; 쓰기버튼 항상 출력 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_write_button value=1> 사용 <span class="cf_info">(권한이 없어도 쓰기버튼 출력)</span>
	    <script type="text/javascript"> document.cf_form.cf_write_button.checked = <?=$mw_basic[cf_write_button]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_write] value=1>&nbsp; 코멘트 입력창 출력 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comment_write value=1> 항상
	    <span class="cf_info">(코멘트 입력창을 항상 출력, 로그인 메시지 출력)</span>
	    <script type="text/javascript"> document.cf_form.cf_comment_write.checked = <?=$mw_basic[cf_comment_write]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_default] value=1>&nbsp; 코멘트 기본내용 </div>
	<div class="cf_content" height=110>
	    <textarea name=cf_comment_default cols=60 rows=5 class=edarea><?=$mw_basic[cf_comment_default]?></textarea>
	    <div class="cf_info">코멘트 기본 입력 내용</div>
	</div>
    </div>

    <div class="block"></div>

</div> <!-- tabs-1 -->

<div id="tabs-2" class="tabs"> <!-- 모양 -->


    <div class="cf_item">
	<div class="cf_title"><input type=checkbox name=chk[cf_notice_name] value=1>&nbsp; 공지사항 이름 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_notice_name value=1> 출력안함 
	    <span class="cf_info">(체크하면 목록에서 출력하지 않습니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_notice_name.checked = <?=$mw_basic[cf_notice_name]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"><input type=checkbox name=chk[cf_notice_date] value=1>&nbsp; 공지사항 날짜</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_notice_date value=1> 출력안함 
	    <span class="cf_info">(체크하면 목록에서 출력하지 않습니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_notice_date.checked = <?=$mw_basic[cf_notice_date]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_notice_hit] value=1>&nbsp; 공지사항 조회수 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_notice_hit value=1> 출력안함 
	    <span class="cf_info">(체크하면 목록에서 출력하지 않습니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_notice_hit.checked = <?=$mw_basic[cf_notice_hit]?>; </script>
	</div>
    </div>


    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_post_num] value=1>&nbsp; 게시물 번호 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_post_num value=1> 출력안함 
	    <span class="cf_info">(체크하면 목록에서 출력하지 않습니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_post_num.checked = <?=$mw_basic[cf_post_num]?>; </script>
	</div>
    </div>
	
    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_post_name] value=1>&nbsp; 게시물 이름 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_post_name value=1> 출력안함 
	    <span class="cf_info">(체크하면 목록에서 출력하지 않습니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_post_name.checked = <?=$mw_basic[cf_post_name]?>; </script>
	</div>
    </div>
    
    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_post_date] value=1>&nbsp; 게시물 날짜 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_post_date value=1> 출력안함 
	    <span class="cf_info">(체크하면 목록에서 출력하지 않습니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_post_date.checked = <?=$mw_basic[cf_post_date]?>; </script>
	</div>
    </div>
    
    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_post_hit] value=1>&nbsp; 게시물 조회수 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_post_hit value=1> 출력안함 
	    <span class="cf_info">(체크하면 목록에서 출력하지 않습니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_post_hit.checked = <?=$mw_basic[cf_post_hit]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_list_good] value=1>&nbsp; 추천,비추천 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_list_good value=1> 출력안함 
	    <span class="cf_info">(체크하면 목록에서 출력하지 않습니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_list_good.checked = <?=$mw_basic[cf_list_good]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_good_graph] value=1>&nbsp; 추천,비추천 그래프 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_good_graph value=1> 사용 <span class="cf_info">(추천, 비추천 모두 사용함으로 되어있어야 정상작동)</span>
	    <script type="text/javascript"> document.cf_form.cf_good_graph.checked = '<?=$mw_basic[cf_good_graph]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comma] value=1>&nbsp; 콤마 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comma value=1> 사용 <span class="cf_info">(글번호,조회수 등에 3자리마다 콤마출력)</span>
	    <script type="text/javascript"> document.cf_form.cf_comma.checked = <?=$mw_basic[cf_comma]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_subject_style] value=1>&nbsp; 제목 스타일 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_subject_style value=1> 사용
            <select name="cf_subject_style_level">
            <? for ($i=1; $i<=10; $i++) { ?>
            <option value="<?=$i?>"> <?=$i?> </option>
            <? } ?>
            </select> 레벨 이상
            <span class="cf_info">(제목에 글꼴, 색상을 설정할 수 있습니다.)</span>
	    <script type="text/javascript">
            document.cf_form.cf_subject_style.checked = <?=$mw_basic[cf_subject_style]?>;
            document.cf_form.cf_subject_style_level.value = "<?=$mw_basic[cf_subject_style_level]?>";
            </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_search_top] value=1>&nbsp; 검색폼 상단표시</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_search_top value=1> 사용 <span class="cf_info">(검색폼을 상단에 표시하여 검색활성화)</span>
	    <script type="text/javascript"> document.cf_form.cf_search_top.checked = "<?=$mw_basic[cf_search_top]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_category_tab] value=1>&nbsp; 분류탭</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_category_tab value=1> 사용 <span class="cf_info">(목록에서 분류를 탭으로 표시합니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_category_tab.checked = "<?=$mw_basic[cf_category_tab]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_category_radio] value=1>&nbsp; 분류 라디오버튼</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_category_radio value=1> 사용 <span class="cf_info">(글작성시 분류를 라디오버튼으로 나타냅니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_category_radio.checked = "<?=$mw_basic[cf_category_radio]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_notice_top] value=1>&nbsp; 공지사항 별도</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_notice_top value=1> 사용 <span class="cf_info">(공지사항을 목록이 아닌 상단에 별도로 표기합니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_notice_top.checked = "<?=$mw_basic[cf_notice_top]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_file_head] value=1>&nbsp; 첨부파일 상단 </div>
	<div class="cf_content" height=110>
	    <textarea name=cf_file_head cols=60 rows=5 class=edarea><?=$mw_basic[cf_file_head]?></textarea>
	    <div class="cf_info">첨부파일 링크 상단에 출력될 코드 </div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_file_tail] value=1>&nbsp; 첨부파일 하단 </div>
	<div class="cf_content" height=110>
	    <textarea name=cf_file_tail cols=60 rows=5 class=edarea><?=$mw_basic[cf_file_tail]?></textarea>
	    <div class="cf_info">첨부파일 링크 하단에 출력될 코드 </div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_content_head] value=1>&nbsp; 본문상단 </div>
	<div class="cf_content" height=110>
	    <textarea name=cf_content_head cols=60 rows=5 class=edarea><?=$mw_basic[cf_content_head]?></textarea>
	    <div class="cf_info">게시글 본문 상단에 출력될 코드 </div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_content_tail] value=1>&nbsp; 본문하단 </div>
	<div class="cf_content" height=110>
	    <textarea name=cf_content_tail cols=60 rows=5 class=edarea><?=$mw_basic[cf_content_tail]?></textarea>
	    <div class="cf_info">게시글 본문 하단에 출력될 코드 </div>
	</div>
    </div>


    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_css] value=1>&nbsp; 사용자정의 CSS </div>
	<div class="cf_content" height=110>
	    <textarea name=cf_css cols=60 rows=5 class=edarea><?=$mw_basic[cf_css]?></textarea>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_include_view_top] value=1>&nbsp; View 최상단</div>
	<div class="cf_content">
	    <input type="text" size="60" name="cf_include_view_top" class="ed" value="<?=$mw_basic[cf_include_view_top]?>"> 
	    <div class="cf_info">글본문 최상단에 파일을 삽입합니다.</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_include_view_head] value=1>&nbsp; View 본문 상단 파일 </div>
	<div class="cf_content">
	    <input type="text" size="60" name="cf_include_view_head" class="ed" value="<?=$mw_basic[cf_include_view_head]?>"> 
	    <div class="cf_info">글본문 상단에 파일을 삽입합니다.</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_include_view] value=1>&nbsp; View 본문 추가 파일 </div>
	<div class="cf_content">
	    <input type="text" size="60" name="cf_include_view" class="ed" value="<?=$mw_basic[cf_include_view]?>"> 
	    <div class="cf_info">글본문에 파일을 삽입합니다.</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_include_view_tail] value=1>&nbsp; View 본문 하단 파일 </div>
	<div class="cf_content">
	    <input type="text" size="60" name="cf_include_view_tail" class="ed" value="<?=$mw_basic[cf_include_view_tail]?>"> 
	    <div class="cf_info">글본문 하단에 파일을 삽입합니다.</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_include_file_head] value=1>&nbsp; 첨부파일 상단 파일 </div>
	<div class="cf_content">
	    <input type="text" size="60" name="cf_include_file_head" class="ed" value="<?=$mw_basic[cf_include_file_head]?>"> 
	    <div class="cf_info">글파일 상단에 파일을 삽입합니다.</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_include_file_tail] value=1>&nbsp; 첨부파일 하단 파일 </div>
	<div class="cf_content">
	    <input type="text" size="60" name="cf_include_file_tail" class="ed" value="<?=$mw_basic[cf_include_file_tail]?>"> 
	    <div class="cf_info">글파일 하단에 파일을 삽입합니다.</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_include_head] value=1>&nbsp; 게시판 상단 파일 </div>
	<div class="cf_content">
	    <input type="text" size="60" name="cf_include_head" class="ed" value="<?=$mw_basic[cf_include_head]?>"> 
	    <div class="cf_info">게시판 상단에 파일을 삽입합니다.</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_include_tail] value=1>&nbsp; 게시판 하단 파일 </div>
	<div class="cf_content">
	    <input type="text" size="60" name="cf_include_tail" class="ed" value="<?=$mw_basic[cf_include_tail]?>"> 
	    <div class="cf_info">게시판 하단에 파일을 삽입합니다.</div>
	</div>
    </div>


    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_include_list_main] value=1>&nbsp; 목록 글 파일 </div>
	<div class="cf_content">
	    <input type="text" size="60" name="cf_include_list_main" class="ed" value="<?=$mw_basic[cf_include_list_main]?>"> 
	    <div class="cf_info">목록의 게시물마다 반복되는 파일을 삽입합니다.</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_include_comment_main] value=1>&nbsp; 코멘트 파일</div>
	<div class="cf_content">
	    <input type="text" size="60" name="cf_include_comment_main" class="ed" value="<?=$mw_basic[cf_include_comment_main]?>"> 
	    <div class="cf_info">코멘트마다 반복되는 파일을 삽입합니다.</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_download_popup] value=1>&nbsp; 다운로드 팝업 </div>
	<div class="cf_content">
            <input type=checkbox name=cf_download_popup value=1> 사용
            <span class="cf_info">(다운로드시 안내문 팝업창 오픈)</span>
	    <script type="text/javascript"> document.cf_form.cf_download_popup.checked = <?=$mw_basic[cf_download_popup]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_download_popup_size] value=1>&nbsp; 다운로드 팝업 크기 </div>
	<div class="cf_content">
            가로 <input type="text" size="4" class="ed" name="cf_download_popup_w" value="<?=$mw_basic[cf_download_popup_w]?>"> px ×
            세로 <input type="text" size="4" class="ed" name="cf_download_popup_h" value="<?=$mw_basic[cf_download_popup_h]?>"> px
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_download_popup_msg] value=1>&nbsp; 다운로드 팝업 메세지 </div>
	<div class="cf_content">
            <textarea name=cf_download_popup_msg cols=60 rows=5 class=edarea><?=$mw_basic[cf_download_popup_msg]?></textarea>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_attach_count] value=1>&nbsp; 첨부파일 기본갯수 </div>
	<div class="cf_content" height=60>
            <input type="text" size="3" class="ed" name="cf_attach_count" value="<?=$mw_basic[cf_attach_count]?>"> 개
	    <span class="cf_info">(글작성시 첨부파일 기본 출력 갯수를 설정합니다.)</span>
	</div>
    </div>
 
    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_replace_word] value=1>&nbsp; 자동치환 </div>
	<div class="cf_content" height=60>
	    <select name=cf_replace_word>
	    <? for ($i=2; $i<=10; $i++) {?>
	    <option value="<?=$i?>"><?=$i?></option>
	    <? } ?>
	    </select> 레벨
	    <span class="cf_info">({별명}을 게시물 조회자의 별명으로 자동치환, 사용할 수 있는 레벨제한)</span>
	    <script type="text/javascript"> document.cf_form.cf_replace_word.value = "<?=$mw_basic[cf_replace_word]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_name_title] value=1>&nbsp; 호칭 </div>
	<div class="cf_content" height=60>
            <input type="text" size="10" class="ed" name="cf_name_title" value="<?=$mw_basic[cf_name_title]?>">
	    <span class="cf_info">(이름옆에 호칭을 붙입니다.)</span>
	</div>
    </div>
 
    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_anonymous] value=1>&nbsp; 선택익명 </div>
	<div class="cf_content" height=60>
            <input type="checkbox" name="cf_anonymous" value="1">
	    <span class="cf_info">(글작성시 익명을 선택할 수 있습니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_anonymous.checked = "<?=$mw_basic[cf_anonymous]?>"; </script>
	</div>
    </div>
 
    <div class="block"></div>

</div>

<div id="tabs-3" class="tabs"> <!-- 기능 -->

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_ccl] value=1>&nbsp; CCL 표시 </div>
	<div class="cf_content">
	    <select name=cf_ccl>
	    <option value="0"> 사용안함 </option>
	    <option value="1"> 사용 </option>
	    </select>
	    <a href="http://www.creativecommons.or.kr/" target=_blank>CCL<span class="cf_info">(Creative Commons License 알아보기)</span></a>
	    <script type="text/javascript"> document.cf_form.cf_ccl.value = "<?=$mw_basic[cf_ccl]?>"; </script>
	</div>
    </div>
<!--
    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_star] value=1>&nbsp; 코멘트 별점 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_star value=1> 사용 <span class="cf_info">(코멘트작성시 별점을 함께 입력합니다.)</span>  
	    <script type="text/javascript"> document.cf_form.cf_star.checked = <?=$mw_basic[cf_star]?>; </script>
	</div>
    </div>
-->

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_link_blank] value=1>&nbsp; 링크 새창 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_link_blank value=1> 사용 <span class="cf_info">(본문의 링크가 무조건 새창으로 열림)</span>
	    <script type="text/javascript"> document.cf_form.cf_link_blank.checked = <?=$mw_basic[cf_link_blank]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_zzal] value=1>&nbsp; 짤방 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_zzal value=1> 사용
	    <input type=checkbox name=cf_zzal_must value=1> 필수
	    <span class="cf_info">(첨부파일을 짤방으로 이용합니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_zzal.checked = <?=$mw_basic[cf_zzal]?>; </script>
	    <script type="text/javascript"> document.cf_form.cf_zzal_must.checked = <?=$mw_basic[cf_zzal_must]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_source_copy] value=1>&nbsp; 출처 자동복사 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_source_copy value=1> 사용 <span class="cf_info">(본문 복사시 출처를 자동으로 복사합니다. IE 전용)</span>
	    <script type="text/javascript"> document.cf_form.cf_source_copy.checked = <?=$mw_basic[cf_source_copy]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_post_emoticon] value=1>&nbsp; 글작성시 이모티콘 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_post_emoticon value=1> 사용
	    <span class="cf_info">(에디터 사용시 자동 사용)</span>
	    <script type="text/javascript"> document.cf_form.cf_post_emoticon.checked = "<?=$mw_basic[cf_post_emoticon]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_html] value=1>&nbsp; 코멘트 html </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comment_html value=1> 허용 
	    <script type="text/javascript"> document.cf_form.cf_comment_html.checked = "<?=$mw_basic[cf_comment_html]?>"; </script>
	</div>
    </div>
 
    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_page] value=1>&nbsp; 코멘트 페이징 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comment_page value=1> 사용,
	    한페이지당 <input type="text" name="cf_comment_page_rows" size="3" value="<?=$mw_basic[cf_comment_page_rows]?>" class="ed"> 개 출력
	    <script type="text/javascript"> document.cf_form.cf_comment_page.checked = "<?=$mw_basic[cf_comment_page]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_file] value=1>&nbsp; 코멘트 첨부파일 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comment_file value=1> 사용
	    <span class="cf_info">(코멘트에 첨부파일 기능을 사용합니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_comment_file.checked = "<?=$mw_basic[cf_comment_file]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_emoticon] value=1>&nbsp; 코멘트 이모티콘 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comment_emoticon value=1> 사용
	    <span class="cf_info">(코멘트 에디터 사용시 자동 사용)</span>
	    <script type="text/javascript"> document.cf_form.cf_comment_emoticon.checked = <?=$mw_basic[cf_comment_emoticon]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_ban] value=1>&nbsp; 코멘트 허락 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comment_ban value=1> 사용
	    <span class="cf_info">(허락하지 않은 게시물에는 코멘트를 작성할 수 없음)</span>
	    <script type="text/javascript"> document.cf_form.cf_comment_ban.checked = <?=$mw_basic[cf_comment_ban]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_ban_level] value=1>&nbsp; 코멘트 허락 레벨 </div>
	<div class="cf_content">
	    <select name=cf_comment_ban_level>
	    <? for ($i=1; $i<=10; $i++) {?>
	    <option value="<?=$i?>"><?=$i?></option>
	    <? } ?>
	    </select>
	    <span class="cf_info">(코멘트 허락을 사용할 수 있는 레벨)</span>
	    <script type="text/javascript"> document.cf_form.cf_comment_ban_level.value = "<?=$mw_basic[cf_comment_ban_level]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_secret_no] value=1>&nbsp; 코멘트 비밀글 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comment_secret_no value=1> 사용 안함
	    <span class="cf_info">(코멘트 입력시 비밀글 옵션을 사용하지 않습니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_comment_secret_no.checked = '<?=$mw_basic[cf_comment_secret_no]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_secret] value=1>&nbsp; 코멘트 비밀글 기본 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comment_secret value=1> 사용
	    <span class="cf_info">(코멘트 입력시 비밀글 체크를 기본으로 합니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_comment_secret.checked = <?=$mw_basic[cf_comment_secret]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_period] value=1>&nbsp; 코멘트 기간 </div>
	<div class="cf_content">
	    <input type="text" size="5" numeric name=cf_comment_period class=ed value="<?=$mw_basic[cf_comment_period]?>"> 일
	    <span class="cf_info">(글작성 후 이 기간이 지나면 코멘트를 쓸 수 없음, 0이면 무제한)</span>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_download_comment] value=1>&nbsp; 다운로드 제한 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_download_comment value=1> 사용
	    <span class="cf_info">(코멘트를 남겨야 다운로드 가능)</span>
	    <script type="text/javascript"> document.cf_form.cf_download_comment.checked = <?=$mw_basic[cf_download_comment]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_uploader_point] value=1>&nbsp; 업로더 포인트 </div>
	<div class="cf_content" height=50>
	    <input type=text size=5 name=cf_uploader_day value="<?=$mw_basic[cf_uploader_day]?>" class=ed> 일 동안
	    <input type=text size=5 name=cf_uploader_point value="<?=$mw_basic[cf_uploader_point]?>" class=ed> 포인트 제공<br/>
	    <span class="cf_info">(첨부파일 다운로드시 업로더에게 포인트를 제공. 0일 입력시 무제한)</span>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_notice] value=1>&nbsp; 코멘트 공지 </div>
	<div class="cf_content" height=110>
	    <textarea name=cf_comment_notice cols=60 rows=5 class=edarea><?=$mw_basic[cf_comment_notice]?></textarea>
	    <div class="cf_info">글 작성시 자동 첫번째 코멘트 메시지 표시</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_write_notice] value=1>&nbsp; 글쓰기 버튼 공지 </div>
	<div class="cf_content" height=110>
	    <textarea name=cf_write_notice cols=60 rows=5 class=edarea><?=$mw_basic[cf_write_notice]?></textarea>
	    <div class="cf_info">글작성 버튼 클릭시 alert 공지 띄우기</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_guploader] value=1>&nbsp; 멀티업로더</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_guploader value=1> 사용
	    <span class="cf_info">(지업로더, 이미지만 업로드, 회원만 가능)</span>
	    <script type="text/javascript"> document.cf_form.cf_guploader.checked = "<?=$mw_basic[cf_guploader]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_under_construction] value=1>&nbsp; 서비스 점검중 메세지</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_under_construction value=1> 사용
	    <span class="cf_info">(서비스 점검중 alert 메세지)</span>
	    <script type="text/javascript"> document.cf_form.cf_under_construction.checked = "<?=$mw_basic[cf_under_construction]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_no_delete] value=1>&nbsp; 삭제금지</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_no_delete value=1> 사용
	    <span class="cf_info">(관리자만 게시물 삭제 가능)</span>
	    <script type="text/javascript"> document.cf_form.cf_no_delete.checked = "<?=$mw_basic[cf_no_delete]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_only_one] value=1>&nbsp; 글한개만 작성가능 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_only_one value=1> 사용 
	    <span class="cf_info">(한사람당 글한개만 작성가능, 예:가입인사)</span>
	    <script type="text/javascript"> document.cf_form.cf_only_one.checked = '<?=$mw_basic[cf_only_one]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_write_day] value=1>&nbsp; 글작성 제한 </div>
	<div class="cf_content">
	    <input type=text size=10 name=cf_write_day class=ed value="<?=$mw_basic[cf_write_day]?>"> 일에
	    <input type=text size=10 name=cf_write_day_count class=ed value="<?=$mw_basic[cf_write_day_count]?>"> 번 이하 
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_write_register] value=1>&nbsp; 글작성 조건 </div>
	<div class="cf_content">
	    <input type=text size=10 name=cf_write_point class=ed value="<?=$mw_basic[cf_write_point]?>"> 포인트 이상, 
	    가입후 <input type=text size=10 name=cf_write_register class=ed value="<?=$mw_basic[cf_write_register]?>"> 일 이상
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_sns] value=1>&nbsp; SNS 퍼가기 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_sns value=1> 사용 
	    <span class="cf_info">(me2day, twitter 등으로 글 퍼가기 버튼)</span>
	    <script type="text/javascript"> document.cf_form.cf_sns.checked = '<?=$mw_basic[cf_sns]?>'; </script>
	</div>
    </div>


    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_vote] value=1>&nbsp; 설문 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_vote value=1> 사용 
	    <span class="cf_info">(설문을 진행할 수 있습니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_vote.checked = '<?=$mw_basic[cf_vote]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_vote_level] value=1>&nbsp; 설문등록 가능레벨 </div>
	<div class="cf_content">
	    <select name=cf_vote_level>
	    <? for ($i=2; $i<=10; $i++) {?>
	    <option value="<?=$i?>"><?=$i?></option>
	    <? } ?>
	    </select>
	    <span class="cf_info">(설문을 등록할 수 있는 레벨)</span>
	    <script type="text/javascript"> document.cf_form.cf_vote_level.value = "<?=$mw_basic[cf_vote_level]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_vote_join_level] value=1>&nbsp; 설문참여 가능레벨 </div>
	<div class="cf_content">
	    <select name=cf_vote_join_level>
	    <? for ($i=1; $i<=10; $i++) {?>
	    <option value="<?=$i?>"><?=$i?></option>
	    <? } ?>
	    </select>
	    <span class="cf_info">(설문에 참여할 수 있는 레벨)</span>
	    <script type="text/javascript"> document.cf_form.cf_vote_join_level.value = "<?=$mw_basic[cf_vote_join_level]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_read_level] value=1>&nbsp; 게시물별 읽기 레벨 </div>
	<div class="cf_content">
	    <input type=checkbox name="cf_read_level" value="1"> 사용 
	    <select name="cf_read_level_own">
	    <? for ($i=1; $i<=10; $i++) {?>
	    <option value="<?=$i?>"><?=$i?></option>
	    <? } ?>
	    </select>
	    <span class="cf_info">(설정가능한 레벨)</span>
	    <script type="text/javascript">
            document.cf_form.cf_read_level.checked = "<?=$mw_basic[cf_read_level]?>";
            document.cf_form.cf_read_level_own.value = "<?=$mw_basic[cf_read_level_own]?>";
            </script>
	</div>
    </div>

    <? /* 
    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_preview_level] value=1>&nbsp; 본문 미리보기 </div>
	<div class="cf_content">
	    <select name="cf_preview_level">
	    <? for ($i=1; $i<=10; $i++) {?>
	    <option value="<?=$i?>"><?=$i?></option>
	    <? } ?>
	    </select>
            레벨 미만는
            <input type="text" size="5" name="cf_preview_size" class="ed" value="<?=$mw_basic[cf_preview_size]?>">
            글자만 보입니다.
            <span class="cf_info">(글읽기 권한이 있어야 미리보기가 작동합니다. 0 이면 작동하지 않습니다.)</span>
	    <script type="text/javascript">
            document.cf_form.cf_preview_level.value = "<?=$mw_basic[cf_preview_level]?>";
            </script>
	</div>
    </div>
    */ ?>
 
    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_must_notice] value=1>&nbsp; 공지필수</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_must_notice value=1> 사용 
	    <span class="cf_info">(게시판 공지를 모두 읽어야 게시글 작성이 가능함)</span>
	    <script type="text/javascript"> document.cf_form.cf_must_notice.checked = '<?=$mw_basic[cf_must_notice]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_good] value=1>&nbsp; 코멘트 추천</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comment_good value=1> 사용 
	    <span class="cf_info">(코멘트 추천 기능을 사용합니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_comment_good.checked = '<?=$mw_basic[cf_comment_good]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_nogood] value=1>&nbsp; 코멘트 반대</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comment_nogood value=1> 사용 
	    <span class="cf_info">(코멘트 반대 기능을 사용합니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_comment_nogood.checked = '<?=$mw_basic[cf_comment_nogood]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_best] value=1>&nbsp; 코멘트 베플</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comment_best value=1> 사용 
	    <span class="cf_info">(베스트 코멘트 기능을 사용합니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_comment_best.checked = '<?=$mw_basic[cf_comment_best]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_best_limit] value=1>&nbsp; 코멘트 베플 기준</div>
	<div class="cf_content">
            추천 <input type="text" name="cf_comment_best_limit" class="ed" size="3" value="<?=$mw_basic[cf_comment_best_limit]?>"> 개 이상
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_icon_level] value=1>&nbsp; 레벨아이콘</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_icon_level value=1> 사용, 
            레벨단위 <input type="text" name="cf_icon_level_point" class="ed" size="7" value="<?=$mw_basic[cf_icon_level_point]?>"> 포인트
	    <script type="text/javascript"> document.cf_form.cf_icon_level.checked = '<?=$mw_basic[cf_icon_level]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_good_point] value=1>&nbsp; 추천 포인트</div>
	<div class="cf_content">
            추천 받는 사람 :
            <input type="text" name="cf_good_point" class="ed" size="3" value="<?=$mw_basic[cf_good_point]?>"> 포인트,
            추천한 사람 :
            <input type="text" name="cf_good_re_point" class="ed" size="3" value="<?=$mw_basic[cf_good_re_point]?>"> 포인트
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_nogood_point] value=1>&nbsp; 비추 포인트</div>
	<div class="cf_content">
            비추 받는 사람 : 
            <input type="text" name="cf_nogood_point" class="ed" size="3" value="<?=$mw_basic[cf_nogood_point]?>"> 포인트,
            비추한 사람 :
            <input type="text" name="cf_nogood_re_point" class="ed" size="3" value="<?=$mw_basic[cf_nogood_re_point]?>"> 포인트
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_good_point] value=1>&nbsp; 코멘트 추천 포인트</div>
	<div class="cf_content">
            추천 받는 사람 :
            <input type="text" name="cf_comment_good_point" class="ed" size="3" value="<?=$mw_basic[cf_comment_good_point]?>"> 포인트,
            추천한 사람 :
            <input type="text" name="cf_comment_good_re_point" class="ed" size="3" value="<?=$mw_basic[cf_comment_good_re_point]?>"> 포인트
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_nogood_point] value=1>&nbsp; 코멘트 비추 포인트</div>
	<div class="cf_content">
            비추 받는 사람 : 
            <input type="text" name="cf_comment_nogood_point" class="ed" size="3" value="<?=$mw_basic[cf_comment_nogood_point]?>"> 포인트,
            비추한 사람 :
            <input type="text" name="cf_comment_nogood_re_point" class="ed" size="3" value="<?=$mw_basic[cf_comment_nogood_re_point]?>"> 포인트
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_good_days] value=1>&nbsp; 추천/비추 기간설정</div>
	<div class="cf_content">
            <input type="text" name="cf_good_days" class="ed" size="3" value="<?=$mw_basic[cf_good_days]?>"> 일
            <span class="cf_info">(0으로 하면 기간에 영향을 받지 않습니다.)</span>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_iframe_level] value=1>&nbsp; <strong>iframe 사용권한</strong> </div>
	<div class="cf_content">
            <select name="cf_iframe_level">
            <? for ($i=2; $i<=10; $i++) { ?>
            <option value="<?=$i?>"> <?=$i?> </option>
            <? } ?>
            </select> 레벨 이상
	    <script type="text/javascript">
            document.cf_form.cf_iframe_level.value = "<?=$mw_basic[cf_iframe_level]?>";
            </script>
	</div>
    </div>

    <div class="block"></div>

</div> <!-- tabs-3 -->


<div id="tabs-4" class="tabs"> <!-- 알림 -->
    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_singo] value=1>&nbsp; 신고 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_singo value=1> 사용
	    <span class="cf_info">(신고 통보 아이디에 쪽지로 알림)</span>
	    <script type="text/javascript"> document.cf_form.cf_singo.checked = <?=$mw_basic[cf_singo]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_singo_id] value=1>&nbsp; 신고통보 아이디 </div>
	<div class="cf_content" height=60>
	    <input type=text size=60 name=cf_singo_id class=ed value="<?=$mw_basic[cf_singo_id]?>">
	    <div class="cf_info">아이디 , (컴마) 로 구분</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_singo_after] value=1>&nbsp; 신고가능 레벨 </div>
	<div class="cf_content" height=60>
	    <select name=cf_singo_level>
	    <? for ($i=2; $i<=10; $i++) {?>
	    <option value="<?=$i?>"><?=$i?></option>
	    <? } ?>
	    </select>
	    <span class="cf_info">(게시물 신고를 할 수 있는 레벨)</span>
	    <script type="text/javascript"> document.cf_form.cf_singo_level.value = "<?=$mw_basic[cf_singo_level]?>"; </script>
	</div>
    </div>
 
    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_singo_after] value=1>&nbsp; 신고 후 </div>
	<div class="cf_content" height=60>
            <input type="text" size="3" name="cf_singo_number" value="<?=$mw_basic[cf_singo_number]?>" class="ed"> 회 이상
	    <input type=checkbox name=cf_singo_id_block value=1> 아이디 차단
	    <input type=checkbox name=cf_singo_write_block value=1> 게시물 차단
	    <input type=checkbox name=cf_singo_write_secret value=1> 게시물 잠금
	    <script type="text/javascript">
            document.cf_form.cf_singo_id_block.checked = "<?=$mw_basic[cf_singo_id_block]?>";
            document.cf_form.cf_singo_write_block.checked = "<?=$mw_basic[cf_singo_write_block]?>";
            document.cf_form.cf_singo_write_secret.checked = "<?=$mw_basic[cf_singo_write_secret]?>";
            </script>
	</div>
    </div>
 
    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_singo_writer] value=1>&nbsp; 신고 작성자 통보</div>
	<div class="cf_content">
	    <input type=checkbox name=cf_singo_writer value=1> 사용
	    <span class="cf_info">(신고를 당한 게시물의 작성자에게 신고 여부만 통보합니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_singo_writer.checked = <?=$mw_basic[cf_singo_writer]?>; </script>
	</div>
    </div>


    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_email] value=1>&nbsp; 글등록 알림메일 </div>
	<div class="cf_content" height=110>
	    <textarea name=cf_email cols=60 rows=5 class=edarea><?=$mw_basic[cf_email]?></textarea>
	    <div class="cf_info">이메일주소 Enter 로 구분</div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_hp] value=1>&nbsp; 글등록 알림문자 </div>
	<div class="cf_content" height=140>
	    <div>
		ID : <input type=text size=10 name=cf_sms_id value="<?=$mw_basic[cf_sms_id]?>" class=ed>
		PW : <input type=text size=10 name=cf_sms_pw value="<?=$mw_basic[cf_sms_pw]?>" class=ed>
		<span class="cf_info">(<a href="http://www.icodekorea.com" target=_blank>ICODEKOREA</a>,
		<a href="http://icodekorea.com/res/join_company_fix_a.php?sellid=sir2" target=_blank>건당 16원 가입</a>)</span>
	    </div>
	    <textarea name=cf_hp cols=60 rows=5 class=edarea><?=$mw_basic[cf_hp]?></textarea>
	    <div class="cf_info">핸드폰번호 Enter 로 구분</div>
	</div>
    </div>

    <div class="block"></div>
</div> <!-- tabs-4 -->
 
<div id="tabs-5" class="tabs"> <!-- 데이터 -->

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox disabled>&nbsp; 정렬 </div>
	<div class="cf_content">
	    <div> 게시물을 날짜순으로 정렬합니다. <span id=btn_order_date><input type=button class="bt" value="정렬시작" onclick="run_order('date')"></span></div>
	    <div> 게시물을 제목순으로 정렬합니다. <span id=btn_order_subject><input type=button class="bt" value="정렬시작" onclick="run_order('subject')"></span></div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox disabled>&nbsp; 이모티콘 싱크 </div>
	<div class="cf_content" height=80>
	    디렉토리명 변경으로 이모티콘이 엑박으로 출력되는 것을 수정합니다.<br/>
	    기존 : <input type=text size=30 id=em_old class=ed value="mw.basic.v.1.0.0/emoticon"><br/>
	    신규 : <input type=text size=30 id=em_new class=ed value="mw.basic/mw.emoticon">
	    <span id=btn_emoticon_sync><input type=button class="bt" value="시작" onclick="run_emoticon_sync()"></span>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox disabled>&nbsp; 분류명 변경 </div>
	<div class="cf_content" height=80>
	    기존 : <input type=text size=30 id=ca_old class=ed value=""><br/>
	    신규 : <input type=text size=30 id=ca_new class=ed value="">
	    <span id=btn_category_change><input type=button class="bt" value="시작" onclick="run_category_change()"></span>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_download_log] value=1>&nbsp; 다운로드 로그 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_download_log value=1> 사용
	    <span class="cf_info">(다운로드 기록을 남깁니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_download_log.checked = "<?=$mw_basic[cf_download_log]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_post_history] value=1>&nbsp; 글변경 로그 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_post_history value=1> 사용
	    <span class="cf_info">(수정된 글의 원본을 보관합니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_post_history.checked = "<?=$mw_basic[cf_post_history]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_link_log] value=1>&nbsp; 링크 로그 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_link_log value=1> 사용
	    <span class="cf_info">(링크 클릭 기록을 남깁니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_link_log.checked = "<?=$mw_basic[cf_link_log]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_delete_log] value=1>&nbsp; 삭제글 남김 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_delete_log value=1> 사용
	    <span class="cf_info">(글을 삭제하면 "삭제되었습니다" 로 변경, 선택삭제는 그냥 삭제됨)</span>
	    <script type="text/javascript"> document.cf_form.cf_delete_log.checked = "<?=$mw_basic[cf_delete_log]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_post_history_level] value=1>&nbsp; 글변경 로그 확인 </div>
	<div class="cf_content">
	    <select name=cf_post_history_level>
	    <? for ($i=1; $i<=10; $i++) {?>
	    <option value="<?=$i?>"><?=$i?></option>
	    <? } ?>
	    </select>
	    <span class="cf_info">(글변경 로그를 확인할 수 있는 레벨)</span>
	    <script type="text/javascript"> document.cf_form.cf_post_history_level.value = "<?=$mw_basic[cf_post_history_level]?>"; </script>
	</div>
    </div>

     <div class="cf_item">
	<div class="cf_title"> <input type=checkbox disabled>&nbsp; 공지사항 순서 변경 </div>
	<div class="cf_content">
	    <select name=bo_notice id=bo_notice multiple style="width:400px; height:200px;">
            <?
            $bo_notice = explode("\n", $board[bo_notice]);
            for ($i=0, $m=sizeof($bo_notice); $i<$m; $i++) { 
                if (!trim($bo_notice[$i])) continue;
                $row = sql_fetch("select wr_id, wr_subject from $write_table where wr_id = '{$bo_notice[$i]}'");
            ?>
                <option value="<?=$row[wr_id]?>"> <?=get_text($row[wr_subject],1)?> </option>
            <? } ?>
	    </select>
            <div style="margin:10px 0 0 0;">
                <input type="button" class="bt" value="↑" onclick="$('#bo_notice').moveOptionUp();">
                <input type="button" class="bt" value="↓" onclick="$('#bo_notice').moveOptionDown();">
                <input type="button" class="bt" value="저장" onclick="bo_notice_submit()">
            </div>
            <script type="text/javascript">
            function bo_notice_submit() {
                var bo_notice = "";
                $('#bo_notice').selectAllOptions();
                $('#bo_notice :selected').each(function (i, sel) {
                    bo_notice += $(sel).val() + "\n";
                });
                $.post("<?=$board_skin_path?>/mw.proc/mw.bo_notice.php", { bo_table:'<?=$bo_table?>', bo_notice:bo_notice }, function (req) {
                    if (req == "true")
                        alert("공지사항 순서변경이 완료되었습니다.");
                    else
                        alert("공지사항 순서변경에 실패하였습니다.");
                });
            }
            </script>
	</div>
    </div>

    <div class="block"></div>
</div> <!-- tabs-5 -->

<div id="tabs-5-2" class="tabs"> <!-- 이미지 -->

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_thumb] value=1>&nbsp; 썸네일1 (기본)</div>
	<div class="cf_content">
	    가로 <input type=text size=3 name=cf_thumb_width class=ed value="<?=$mw_basic[cf_thumb_width]?>">px
	    세로 <input type=text size=3 name=cf_thumb_height class=ed value="<?=$mw_basic[cf_thumb_height]?>">px
	    <input type=checkbox name=cf_thumb_keep value=1> 썸네일 비율을 유지합니다.
	    <script type="text/javascript"> document.cf_form.cf_thumb_keep.checked = '<?=$mw_basic[cf_thumb_keep]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_thumb2] value=1>&nbsp; 썸네일2 </div>
	<div class="cf_content">
	    가로 <input type=text size=3 name=cf_thumb2_width class=ed value="<?=$mw_basic[cf_thumb2_width]?>">px
	    세로 <input type=text size=3 name=cf_thumb2_height class=ed value="<?=$mw_basic[cf_thumb2_height]?>">px
	    <input type=checkbox name=cf_thumb2_keep value=1> 썸네일 비율을 유지합니다.
	    <script type="text/javascript"> document.cf_form.cf_thumb2_keep.checked = '<?=$mw_basic[cf_thumb2_keep]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_thumb3] value=1>&nbsp; 썸네일3 </div>
	<div class="cf_content">
	    가로 <input type=text size=3 name=cf_thumb3_width class=ed value="<?=$mw_basic[cf_thumb3_width]?>">px
	    세로 <input type=text size=3 name=cf_thumb3_height class=ed value="<?=$mw_basic[cf_thumb3_height]?>">px
	    <input type=checkbox name=cf_thumb3_keep value=1> 썸네일 비율을 유지합니다.
	    <script type="text/javascript"> document.cf_form.cf_thumb3_keep.checked = '<?=$mw_basic[cf_thumb3_keep]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_original] value=1>&nbsp; 원본 강제 리사이징 </div>
	<div class="cf_content">
	    가로 <input type=text size=3 name=cf_original_width class=ed value="<?=$mw_basic[cf_original_width]?>">px
	    세로 <input type=text size=3 name=cf_original_height class=ed value="<?=$mw_basic[cf_original_height]?>">px
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_watermark_use] value=1>&nbsp; 워터마크 </div>
	<div class="cf_content">
            <input type="checkbox" name="cf_watermark_use" value="1"> 본문에 사용 <span class="cf_info">(원본은 변경되지 않습니다.)</span>
            <input type="checkbox" name="cf_watermark_use_thumb" value="1"> 썸네일에 사용
	    <script type="text/javascript">
            document.cf_form.cf_watermark_use.checked = '<?=$mw_basic[cf_watermark_use]?>';
            document.cf_form.cf_watermark_use_thumb.checked = '<?=$mw_basic[cf_watermark_use_thumb]?>';
            </script>
        </div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_watermark_path] value=1>&nbsp; 워터마크 파일경로</div>
	<div class="cf_content">
            <input type="text" size="50" name="cf_watermark_path" class="ed" value="<?=$mw_basic[cf_watermark_path]?>">
            <span class="cf_info">(그누보드 bbs 디렉토리 기준 상대경로 입력 예: ../img/watermark.gif)</span>
        </div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_watermark_position] value=1>&nbsp; 워터마크 위치</div>
	<div class="cf_content">
            <select name="cf_watermark_position">
                <option value="center">가운데</option>
                <option value="left_top">왼쪽 상단</option>
                <option value="left_bottom">왼쪽 하단</option>
                <option value="right_top">오른쪽 상단</option>
                <option value="right_bottom">오른쪽 하단</option>
            </select>
	    <script type="text/javascript">
            document.cf_form.cf_watermark_position.value = '<?=$mw_basic[cf_watermark_position]?>';
            </script>
        </div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_watermark_transparency] value=1>&nbsp; 워터마크 선명도</div>
	<div class="cf_content">
            <select name="cf_watermark_transparency">
            <? for ($i=100; $i>=0; $i=$i-10) { ?>
            <option value="<?=$i?>"><?=$i?></option>
            <? } ?> 
            </select>
	    <script type="text/javascript">
            document.cf_form.cf_watermark_transparency.value = '<?=$mw_basic[cf_watermark_transparency]?>';
            </script>
        </div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox disabled>&nbsp; 워터마크 재생성 </div>
	<div class="cf_content">
	    워터마크를 모두 다시 생성합니다. <span class="cf_info">(본문)</span>
	    <span id=btn_watermark_remake><input type=button class="bt" value="시작" onclick="run_watermark_remake()"></span>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox disabled>&nbsp; 썸네일 재생성 </div>
	<div class="cf_content">
	    썸네일을 모두 다시 생성합니다. <span class="cf_info">(썸네일 워터마크 포함)</span>
	    <span id=btn_thumb_remake><input type=button class="bt" value="시작" onclick="run_thumb_remake()"></span>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_exif] value=1>&nbsp; 이미지 메타정보 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_exif value=1> 사용 <span class="cf_info">(이미지 클릭시 출력됨, 사용시 사진확대기능 off)</span>
	    <script type="text/javascript"> document.cf_form.cf_exif.checked = '<?=$mw_basic[cf_exif]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_no_img_ext] value=1>&nbsp; 이미지 새창 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_no_img_ext value=1> 사용안함 <span class="cf_info">(사진확대기능 off)</span>
	    <script type="text/javascript"> document.cf_form.cf_no_img_ext.checked = '<?=$mw_basic[cf_no_img_ext]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_img_1_noview] value=1>&nbsp; 첫이미지 출력 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_img_1_noview value=1> 출력안함 
	    <span class="cf_info">(첫번째 첨부이미지를 본문에서 출력하지 않습니다.)</span>
	    <script type="text/javascript"> document.cf_form.cf_img_1_noview.checked = '<?=$mw_basic[cf_img_1_noview]?>'; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_change_image_size] value=1>&nbsp; 이미지크기 사용자설정 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_change_image_size value=1> 사용 
            <select name="cf_change_image_size_level">
            <? for ($i=1; $i<=10; $i++) { ?>
            <option value="<?=$i?>"> <?=$i?> </option>
            <? } ?>
            </select> 레벨 이상
	    <span class="cf_info">(글등록시 이미지 크기를 사용자가 설정할 수 있습니다. 작게만 가능)</span>

	    <script type="text/javascript">
            document.cf_form.cf_change_image_size.checked = '<?=$mw_basic[cf_change_image_size]?>';
            document.cf_form.cf_change_image_size_level.value = '<?=$mw_basic[cf_change_image_size_level]?>';
            </script>
	</div>
    </div>


    <div class="block"></div>
</div> <!-- tabs-5-2 -->

<div id="tabs-5-5" class="tabs"> <!-- 에디터 -->

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_editor] value=1>&nbsp; 에디터 종류 </div>
	<div class="cf_content">
	    <select name="cf_editor">
	    <option value=""></option>
	    <option value="cheditor"> CHEditor </option>
	    <option value="geditor"> GEditor </option>
	    </select>
	    <script type="text/javascript"> document.cf_form.cf_editor.value = "<?=$mw_basic[cf_editor]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_comment_editor] value=1>&nbsp; 코멘트 에디터 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_comment_editor value=1> 사용
	    <span class="cf_info">(최소, 최대 코멘트수 제한 기능을 사용할 수 없음)</span>
	    <script type="text/javascript"> document.cf_form.cf_comment_editor.checked = <?=$mw_basic[cf_comment_editor]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_admin_dhtml] value=1>&nbsp; 관리자 에디터 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_admin_dhtml value=1> 본문 사용 
	    <input type=checkbox name=cf_admin_dhtml_comment value=1> 코멘트 사용 
	    <span class="cf_info">(관리자만 DHTML 에디터를 사용하도록 합니다.)</span>
	    <script type="text/javascript">
            document.cf_form.cf_admin_dhtml.checked = '<?=$mw_basic[cf_admin_dhtml]?>';
            document.cf_form.cf_admin_dhtml_comment.checked = '<?=$mw_basic[cf_admin_dhtml_comment]?>';
            </script>
	</div>
    </div>

    <div class="block"></div>
</div> <!-- tabs-5-5 -->



<div id="tabs-6" class="tabs"> <!-- 접근권한 -->

    <iframe width="720" height="300" style="margin:0 0 10px 0; border:1px solid #ccc;" src="mw.board.member.php?bo_table=<?=$bo_table?>"></iframe>

    <div class="cf_item">
	<div class=cf_title> 게시판 접근권한 </div>
	<div class=cf_content>
	    <input type=checkbox name=cf_board_member value=1> 사용
	    <span class="cf_info">(회원의 게시판 접근권한을 제한함)</span>
	    <script type="text/javascript"> document.cf_form.cf_board_member.checked = "<?=$mw_basic[cf_board_member]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class=cf_title> 게시판 접근목록 </div>
	<div class=cf_content>
	    <input type=checkbox name=cf_board_member_list value=1> 사용
	    <span class="cf_info">(접근권한이 없어도 목록은 보여줌)</span>
	    <script type="text/javascript"> document.cf_form.cf_board_member_list.checked = "<?=$mw_basic[cf_board_member_list]?>"; </script>
	</div>
    </div>

    <div class="block"></div>
</div> <!-- tabs-6 -->

<div id="tabs-7" class="tabs"> <!-- 플러그인 -->

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_umz] value=1>&nbsp; 짧은링크 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_umz value=1> 사용 <span class="cf_info">(게시물마다 umz.kr/xxxxx 형식의 짧은 글주소 자동생성)</span>  
	    <script type="text/javascript"> document.cf_form.cf_umz.checked = <?=$mw_basic[cf_umz]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_shorten] value=1>&nbsp; 짧은링크-자체도메인 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_shorten value=1> 사용 <span class="cf_info">(주소:도메인/게시판/글번호 형식, <a href="http://g4.miwit.com/plugin/product/pr_shorten.php" target="_blank">플러그인 설치 후 사용가능 ⇒ <u>다운로드 클릭!</u></a>)</span>  
	    <script type="text/javascript"> document.cf_form.cf_shorten.checked = <?=$mw_basic[cf_shorten]?>; </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_reward] value=1>&nbsp; 제휴마케팅-리워드 </div>
	<div class="cf_content">
	    <input type=checkbox name=cf_reward value=1> 사용
                <span class="cf_info">(
                <a href="http://click.linkprice.com/click.php?m=linkprice&a=A100226477&l=0000" target="_blank"><u>링크프라이스 가입</u></a>
                , <a href="http://www.ilikeclick.com" target="_blank"><u>아이라이크클릭 가입</u></a>
                , <a href="http://g4.miwit.com/plugin/product/pr_reward.php" target="_blank">플러그인 설치 후 사용가능 ⇒ <u>다운로드 클릭!</u></a>
                )</span>  
	    <script type="text/javascript"> document.cf_form.cf_reward.checked = "<?=$mw_basic[cf_reward]?>"; </script>
	</div>
    </div>

    <div class="cf_item">
        <div class="cf_title">  <input type=checkbox name=chk[cf_lucky_writing_chance] value=1>&nbsp;  럭키라이팅 </div>
	<div class="cf_content">
            <?  $mb = get_member("@lucky-writing", "mb_nick"); ?>
            이름 변경 : <input type="text" class="ed" name="cf_lucky_writing_name" size="20" value="<?=$mb[mb_nick]?>">
            <span class="cf_info">(모든 게시판에 적용됨)</span>
            <span class="cf_info">(<a href="http://g4.miwit.com/plugin/product/pr_lucky_writing.php" target="_blank">플러그인 설치 후 사용가능 ⇒ <u>다운로드 클릭!</u></a>)</span><br/>

            <?
            if (!$mw_basic[cf_lucky_writing_ment]) {
                $mw_basic[cf_lucky_writing_ment] = "축하드립니다. ;)<br/>";
                $mw_basic[cf_lucky_writing_ment].= "{별명}님은 ";
                $mw_basic[cf_lucky_writing_ment].= "{럭키}에 당첨되어 {포인트} 지급되었습니다.";
            }
            ?>
            당첨 문구 : <input type="text" class="ed" name="cf_lucky_writing_ment" size="50" value="<?=$mw_basic[cf_lucky_writing_ment]?>">
            <span class="cf_info">(사용가능 치환자 {별명}, {럭키}, {포인트})</span><br/>

            본문 확률 : <input type="text" class="ed" name="cf_lucky_writing_chance" size="4" numeric value="<?=$mw_basic[cf_lucky_writing_chance]?>"> %, 포인트
            <input type="text" class="ed" name="cf_lucky_writing_point_start" size="4" numeric value="<?=$mw_basic[cf_lucky_writing_point_start]?>"> 이상 ~
            <input type="text" class="ed" name="cf_lucky_writing_point_end" size="4" numeric value="<?=$mw_basic[cf_lucky_writing_point_end]?>"> 이하.<br/>

            댓글 확률 : <input type="text" class="ed" name="cf_lucky_writing_comment_chance" size="4" numeric value="<?=$mw_basic[cf_lucky_writing_comment_chance]?>"> %, 포인트
            <input type="text" class="ed" name="cf_lucky_writing_comment_point_start" size="4" numeric value="<?=$mw_basic[cf_lucky_writing_comment_point_start]?>"> 이상 ~
            <input type="text" class="ed" name="cf_lucky_writing_comment_point_end" size="4" numeric value="<?=$mw_basic[cf_lucky_writing_comment_point_end]?>"> 이하.

        </div>
    </div>

    <div class="block"></div>
</div> <!-- tabs-7 -->


<div id="tabs-8" class="tabs"> <!-- 컨텐츠샵 -->

    <div class="cf_item" style="font-weight:bold; text-align:center; background-color:#fff; border:1px solid #ddd;
        padding:20px 0 20px 0; margin:0 0 10px 0; color:#ff0000;">
        <? if ($mw_cash[cf_cash_name]) { ?>
        <div style="color:#444;">컨텐츠샵이 설치되어 있는 것으로 추정됩니다. 캐쉬이름은 [<?=$mw_cash[cf_cash_name]?>] 입니다.</div>
        <? } else {?>
        컨텐츠샵이 설치되어 있지 않습니다.<br/><br/> 컨텐츠샵은
        배추 패밀리 회원만 이용하실 수 있습니다.  ⇒ <a href="http://g4.miwit.com/" target="_blank"><u>가입하기</u></a>
        <? } ?>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox disabled>&nbsp; <strong>멤버쉽</strong> </div>
	<div class="cf_content">
            <input type=checkbox disabled> 
            <a href="<?=$g4[admin_path]?>/mw.cash/mw.membership.php"
                target="_blank" style="text-decoration:underline">관리자 - 컨텐츠샵 - 멤버쉽 설정</a> 메뉴에서 설정해주세요.
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_contents_shop] value=1>&nbsp; <strong>다운로드 결제</strong> </div>
	<div class="cf_content">
            <div>
                <input type=checkbox name=cf_contents_shop value=1> 사용 : 
                다운로드 <input type="text" size="3" name="cf_contents_shop_download_count" class="ed" value="<?=$mw_basic[cf_contents_shop_download_count]?>"> 회,
                기간 <input type="text" size="3" name="cf_contents_shop_download_day" class="ed" value="<?=$mw_basic[cf_contents_shop_download_day]?>"> 일 제한
                <div class="cf_info">&nbsp;&nbsp;▶ 0 으로 설정하면 제한하지 않습니다.</div>
                <div class="cf_info">&nbsp;&nbsp;▶ 데이터-다운로드 로그 사용 기능을 사용해야 제한 가능합니다.</div>
                <script type="text/javascript"> document.cf_form.cf_contents_shop.checked = '<?=$mw_basic[cf_contents_shop]?>'; </script>
            </div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_contents_shop] value=1>&nbsp; <strong>업로더 수익</strong> </div>
	<div class="cf_content">
            <div>
                <input type=checkbox name=cf_contents_shop_uploader value=1> 사용 : 
                판매가격의 <input type="text" size="3" name="cf_contents_shop_uploader_cash" class="ed" value="<?=$mw_basic[cf_contents_shop_uploader_cash]?>">%
                <script type="text/javascript"> document.cf_form.cf_contents_shop_uploader.checked = '<?=$mw_basic[cf_contents_shop_uploader]?>'; </script>
            </div>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_contents_write] value=1>&nbsp; <strong>글작성시 결제</strong> </div>
	<div class="cf_content">
            <div>
                <input type=checkbox name=cf_contents_shop_write value=1> 사용 : 
                <?=$mw_cash[cf_cash_name]?>
                <input type="text" size="3" name="cf_contents_shop_write_cash" class="ed" value="<?=$mw_basic[cf_contents_shop_write_cash]?>">
                <?=$mw_cash[cf_cash_unit]?>
                <script type="text/javascript"> document.cf_form.cf_contents_shop_write.checked = '<?=$mw_basic[cf_contents_shop_write]?>'; </script>
            </div>
	</div>
    </div>

    <div class="block"></div>
</div> <!-- tabs-8 -->

<div id="tabs-8-5" class="tabs"> <!-- 실명인증 -->

    <div class="cf_item" style="font-weight:bold; background-color:#fff; border:1px solid #ddd;
        padding:20px 0 20px 20px; margin:0 0 10px 0; color:#ff0000; line-height:20px;">
        실명인증은 신용평가 전문기관인 <a href="http://click.linkprice.com/click.php?m=allcredit&a=A100226477&l=0000"
        target="_blank">KCB</a> 를 통해 이루어집니다.<br/>
        건수 무제한 상품을 월 3만원에 제공해드립니다.
        (<a href="http://help.miwit.com/bbs/board.php?bo_table=g4_notice&wr_id=1024" target="_blank">연선납시 월 2만원 제공, 국내 최저가</a>)<br/>
        마이위트 제휴로 계약한다고 하시면 됩니다.<br/>
        KCB 상담전화 : 02-708-6079
        (<a href="http://help.miwit.com/bbs/board.php?bo_table=g4_notice&wr_id=1024" target="_blank">계약서 다운로드</a>)
    </div>

    <?
    $p32 = substr(sprintf('%o', fileperms("../mw.okname/okname")), -4);
    $p64 = substr(sprintf('%o', fileperms("../mw.okname/okname64")), -4);

    if (!($p32 == $p64 && $p64 == '0755')) {
    ?>
    <div class="cf_item" style="font-weight:bold; background-color:#fff; border:1px solid #ddd;
        padding:20px 0 20px 20px; margin:0 0 10px 0; color:#ff0000; line-height:20px;">
            mw.okname/okname 파일과 mw.okname/okname64 파일 권한을 755 로 변경해주세요.
            <a href="http://g4.miwit.com/bbs/board.php?bo_table=mw_tip&wr_id=726" target="_blank">[변경방법 자세히보기]</a>
    </div>
    <?} ?>


    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_kcb_type] value=1>&nbsp; <strong>인증종류</strong> </div>
	<div class="cf_content">
            <select name="cf_kcb_type">
            <option value=""> 사용안함 </option>
            <option value="okname"> 실명인증 </option>
            <option value="19ban"> 성인인증 (19금) </option>
            </select>
	    <script type="text/javascript">
            document.cf_form.cf_kcb_type.value = "<?=$mw_basic[cf_kcb_type]?>";
            </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_kcb_id] value=1>&nbsp; <strong>KCB 아이디</strong> </div>
	<div class="cf_content">
            <input type="text" size="15" maxlength="12" name="cf_kcb_id" class="ed" value="<?=$mw_basic[cf_kcb_id]?>">
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_kcb_list] value=1>&nbsp; <strong>적용</strong> </div>
	<div class="cf_content">
            <input type="checkbox" name="cf_kcb_list" value="1"> 목록 
            <input type="checkbox" name="cf_kcb_read" value="1"> 읽기 
            <input type="checkbox" name="cf_kcb_write" value="1"> 쓰기 
            <script type="text/javascript">
            document.cf_form.cf_kcb_list.checked = '<?=$mw_basic[cf_kcb_list]?>';
            document.cf_form.cf_kcb_read.checked = '<?=$mw_basic[cf_kcb_read]?>';
            document.cf_form.cf_kcb_write.checked = '<?=$mw_basic[cf_kcb_write]?>';
            </script>
	</div>
    </div>

    <div class="cf_item">
	<div class="cf_title"> <input type=checkbox name=chk[cf_kcb_post] value=1>&nbsp; <strong>게시물별 설정</strong> </div>
	<div class="cf_content">
            <input type="checkbox" name="cf_kcb_post" value="1"> 사용,
            설정권한
            <select name="cf_kcb_post_level">
            <? for ($i=2; $i<=10; $i++) { ?>
            <option value="<?=$i?>"> <?=$i?> </option>
            <? } ?>
            </select> 레벨 이상
            <span class="cf_info">(실명인증을 게시물별로 설정할 수 있습니다.)</span>
	    <script type="text/javascript">
            document.cf_form.cf_kcb_post.checked = "<?=$mw_basic[cf_kcb_post]?>";
            document.cf_form.cf_kcb_post_level.value = "<?=$mw_basic[cf_kcb_post_level]?>";
            </script>
	</div>
    </div>

    <div class="block"></div>
</div> <!-- tabs-8 -->


<div id="tabs-9" class="tabs"> <!-- 통계 -->

    <iframe width="720" height="300" style="margin:0 0 10px 0; border:1px solid #ccc;" src="mw.stats.php?bo_table=<?=$bo_table?>"></iframe>

</div> <!-- tabs-9 -->

<div id="tabs-10" class="tabs"> <!-- 버전확인 -->

    <div style="font-weight:bold; font-size:15px; margin:0 0 5px 0;"> -버전확인 </div>
    <div><textarea cols="130" rows="10" readonly><?@include("../HISTORY")?></textarea></div>

    <div style="font-weight:bold; font-size:15px; margin:10px 0 5px 0;"> - 라이센스 </div>
    <div><textarea cols="130" rows="10" readonly><?@include("../LICENSE")?></textarea></div>

</div> <!-- tabs-10 -->


</div> <!-- tabs -->

<p align=center>
    <input type=button class="bt" value="확     인" onclick="fsend()">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type=button class="bt" value="닫     기" onclick="self.close();">
</p>

</form>

<br/>
<br/>

</td></tr></table>

</div> <!-- load -->

<?
//sql_query("alter table $mw[basic_config_table] change cf_hot_basis cf_hot_basis varchar(10) default 'hit' not null", false);

include_once("$g4[path]/tail.sub.php");
?>
