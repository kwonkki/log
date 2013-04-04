<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가


	$birthday	= $write['wr_1'];
	$tel		= explode("-",$write['wr_2']);
	$input_date	= $write['wr_3'];
	$su_day		= $write['wr_4'];
	$room		= $write['wr_5'];
	$people_cnt	= $write['wr_6'];
	$arrive		= $write['wr_7'];
	$vehicle	= $write['wr_8'];
	$etc		= $write['wr_9'];
	$rooms		= explode("|",$board['bo_2']);
?>

<script language="JavaScript" src="<?="$g4[path]/js/board.js"?>"></script>
<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script language="JavaScript"> window.onload=function() { drawFont(); } </script>

<link rel="stylesheet" href="<?=$board_skin_path?>/css/reserve.css" type="text/css">
<link rel="stylesheet" href="<?=$board_skin_path?>/css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css">
<script type="text/javascript">

function fwrite_submit(f) 
{
	if(!f.name.value)
	{
		alert("'예약자명' 항목은 필수 입력 사항입니다.");
		$("#name").focus();
		return false;
	}

	if(!$("#tel1").val() || !$("#tel2").val() || !$("#tel3").val())
	{
		alert("'전화번호' 항목은 필수 입력 사항입니다.");
		$("#tel1").focus();
		return false;
	}

	if(!$("#birthday").val() )
	{
		alert("'생년월일' 항목은 필수 입력 사항입니다.");
		$("#birthday").focus();
		return false;
	}

	if(!$("#input_date").val() )
	{
		alert("'입실일' 항목은 필수 입력 사항입니다.");
		$("#input_date").focus();
		return false;
	}

	if(!$("#su_day").val() )
	{
		alert("'숙박기간' 항목은 필수 입력 사항입니다.");
		$("#su_day").focus();
		return false;
	}

	if(!$("#room").val() )
	{
		alert("'예약객실' 항목은 필수 입력 사항입니다.");
		$("#room").focus();
		return false;
	}

	if(!$("#people_cnt").val() )
	{
		alert("'인원수' 항목은 필수 입력 사항입니다.");
		$("#people_cnt").focus();
		return false;
	}

	if(!$("#arrive").val() )
	{
		alert("'도착시간' 항목은 필수 입력 사항입니다.");
		$("#arrive").focus();
		return false;
	}

	if(!$("#arrive").val() )
	{
		alert("'도착시간' 항목은 필수 입력 사항입니다.");
		$("#arrive").focus();
		return false;
	}

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/write_update.php';";
    else
        echo "f.action = './write_update.php';";
    ?>
    
    return true;
}

$(function(){
    $.fn.serializeAnything = function() {
 
        var toReturn    = [];
        var els         = $(this).find(':input').get();
 
        $.each(els, function() {
            if (this.name && !this.disabled && (this.checked || /select|textarea/i.test(this.nodeName) || /text|hidden|password/i.test(this.type))) {
                var val = $(this).val();
                toReturn.push( encodeURIComponent(this.name) + "=" + encodeURIComponent( val ) );
            }
        });
 
        return toReturn.join("&").replace(/%20/g, "+");
 
    }

	$('li',".tab").click(function()
	{
		$('li.btn',".tab").removeClass('hide');
		$('li.btn',".tab").addClass('sel');
		$(this).addClass('hide');
		if($(this).attr('btn') == 'search')
		{
			$("#reserve_register").fadeOut(500,function()
			{
				$("#reserve_search").fadeIn();
			})
		}else
		{
			$("#reserve_search").fadeOut(500,function()
			{
				$("#reserve_register").fadeIn();
			})
		}
	});
 $.datepicker.regional['ko'] = {
 closeText: '닫기'
 , prevText: '이전달'
 , nextText: '다음달'
 , currentText: '오늘'
 , monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)','7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)']
 , monthNamesShort: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)','7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)']
 , dayNames: ['일','월','화','수','목','금','토']
 , dayNamesShort: ['일','월','화','수','목','금','토']
 , dayNamesMin: ['일','월','화','수','목','금','토']
 , showOn: 'button'
 , buttonImageOnly: true
 , dateFormat: 'yy-mm-dd'
 };
 $.datepicker.setDefaults($.datepicker.regional['ko']);

	$( ".datepicker" ).datepicker({
		showOn: "button",
		buttonImage: "<?=$board_skin_path?>/img/calender.png ",
		buttonImageOnly: true,
		dateFormat: 'yy-mm-dd'
	});
});

function TextBoxInputLengthCheck(maxSize, contentname, textlimitname) {
    var strCount = 0;
    var tempStr, tempStr2;

    var strCount = 0;
    for (j = 0; j < document.getElementById(contentname).value.length; j++) {
    	var chr = document.getElementById(contentname).value.charAt(j);
    	strCount += (chr.charCodeAt() > 128) ? 2 : 1
    }
    
    if (strCount > maxSize) {
        alert("최대 " + maxSize + "byte이므로 초과된 글자수는 자동으로 삭제됩니다.");
        strCount = 0;
        tempStr2 = "";
        for (i = 0; i < document.getElementById(contentname).value.length; i++) {
            tempStr = document.getElementById(contentname).value.charAt(i);
            if (escape(tempStr).length > 4) strCount += 2;
            else strCount += 1;
            if (strCount > maxSize) {
                if (escape(tempStr).length > 4) strCount -= 2;
                else strCount -= 1;
                break;
            }
            else tempStr2 += tempStr;
        }
        document.getElementById(contentname).value = tempStr2;
    }
    document.getElementById(textlimitname).innerHTML = strCount;
}

function searchCheck()
{
	var frm = document.fsearch
	if(!frm.name.value)
	{
		alert("'예약자명' 항목은 필수항목입니다.")
		frm.name.focus();
		return;
	}

	var tel =document.getElementsByName("tel[]");

	if(!tel[0].value)
	{
		alert("'연락처' 항목은 필수항목입니다.")
		tel[0].focus();
		return;
	}

	if(!tel[1].value)
	{
		alert("'연락처' 항목은 필수항목입니다.")
		tel[1].focus();
		return;
	}

	if(!tel[2].value)
	{
		alert("'연락처' 항목은 필수항목입니다.")
		tel[2].focus();
		return;
	}

	if(!frm.input_date.value)
	{
		alert("'입실일' 항목은 필수항목입니다.")
		frm.input_date.focus();
		return;
	}

	$.ajax({
	  type: "POST",
	  url: "<?=$board_skin_path?>/reserve_check.php",
	  data: $("#fsearch").serializeAnything(),
	 success : function( data ){
	  alert( data );
	 }
	})


}
</script>

<div style="padding:0px 10px 0px 10px;">
	<div class="tabDefault02" id="menu" style="margin-top:10px;">
		<ul class="tab">
			<li class="btn hide"  btn="register" style="">예약신청</li>
			<li class="btn sel"  btn="search" style="">예약확인</li>
			<li class="txt">

	    <a href="<?=$g4[path]?>/adm" target="_blank"><img src='<?=$board_skin_path?>/img/btn_admin.gif'></a></li>
		<?
		if($is_admin)
		{
		?>
			<li class="txt"><a href="./board.php?bo_table=<?=$bo_table?>">[예약목록]</a></li>
		<?
		}
		?>
		</ul>
		<div class="cont">


<form name="fwrite" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=null> 
<input type=hidden name=w        value="<?=$w?>">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=wr_id    value="<?=$wr_id?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sfl      value="<?=$sfl?>">
<input type=hidden name=stx      value="<?=$stx?>">
<input type=hidden name=spt      value="<?=$spt?>">
<input type=hidden name=sst      value="<?=$sst?>">
<input type=hidden name=sod      value="<?=$sod?>">
<input type=hidden name=page     value="<?=$page?>">


			<div id="reserve_register" class="contIn" style="display: block; ">
				<div class="help">
					예약신청을 하시면 펜션관리자가 예약가능 여부 확인후 연락드립니다.<br>
					빠른 처리를 원하시면 <b><?=$board['bo_1']?></b> 으로 연락바랍니다.
				</div>

				<table class="write_form" style="margin-top:10px;">
				<colgroup>
				<col width="80">
				<col>
				</colgroup>
				<tbody><tr>
				<th>예약자명</th>
				<td>
					<input name="name" type="text" size="10" id="name" value="<?=$write['wr_name']?>">
				</td>
				</tr>
				<tr>
				<th>전화번호</th>
				<td>
					<select name="tel[0]" id="tel1" class="ddl">
					<option value="" >선택</option>
					<option value="010" <?=($tel[0] == "010")?'selected':'';?>>010</option>
					<option value="011" <?=($tel[0] == "011")?'selected':'';?>>011</option>
					<option value="016" <?=($tel[0] == "016")?'selected':'';?>>016</option>
					<option value="017" <?=($tel[0] == "017")?'selected':'';?>>017</option>
					<option value="018" <?=($tel[0] == "018")?'selected':'';?>>018</option>
					<option value="019" <?=($tel[0] == "019")?'selected':'';?>>019</option>
					</select> - 
					<input name="tel[1]" type="text" maxlength="4" size="4" id="tel2" value="<?=$tel[1]?>"> - 
					<input name="tel[2]" type="text" maxlength="4" size="4" id="tel3" value="<?=$tel[2]?>">
				</td>
				</tr>
				<tr>
				<th>생년월일</th>
				<td>
					<input name="birthday" type="text" size="10" id="birthday" value="<?=$birthday?>">
					&nbsp;&nbsp;
					ex) 800822
				</td>
				</tr>
				<tr>
				<th>입실일</th>
				<td>
					<span style="display:inline-block;"><input name="input_date" type="text" maxlength="10" size="10" id="input_date" value="<?=$input_date?>" class="datepicker"> </span>
					부터
					&nbsp;&nbsp;
					<select name="su_day" id="su_day" class="ddl">
					<option  value="1박2일" <?=($su_day == "1박2일")?'selected':'';?>>1박2일</option>
					<option value="2박3일" <?=($su_day == "2박3일")?'selected':'';?>>2박3일</option>
					<option value="3박4일" <?=($su_day == "3박4일")?'selected':'';?>>3박4일</option>
					<option value="4박5일" <?=($su_day == "4박5일")?'selected':'';?>>4박5일</option>
					</select>
				</td>
				</tr>
				<tr>
				<th>예약객실</th>
				<td>
					<select name="room" id="room" class="ddl">
					<option value="">선택</option>
					<?php
					foreach((array)$rooms as $room_name)
					{
						$selected = ($room==$room_name) ? "selected" : "";

						echo '<option value="'.$room_name.'" '.$selected.'>'.$room_name.'</option>';

					}
					?>
					</select>
				</td>
				</tr>
				<tr>
				<th>인원수</th>
				<td>
					<input name="people_cnt" type="text" size="2" id="people_cnt" value="<?=$people_cnt?>"  style="text-align:right;ime-mode:disabled;"> 명
				</td>
				</tr>
				<tr>
				<th>도착시간</th>
				<td>
					<select name="arrive" id="arrive" class="ddl">
					<option value="">선택</option>
					<option value="15:00" <?=($arrive=="15:00")?'selected':'';?>>15:00</option>
					<option value="16:00" <?=($arrive=="16:00")?'selected':'';?>>16:00</option>
					<option value="17:00" <?=($arrive=="17:00")?'selected':'';?>>17:00</option>
					<option value="18:00" <?=($arrive=="18:00")?'selected':'';?>>18:00</option>
					<option value="19:00" <?=($arrive=="19:00")?'selected':'';?>>19:00</option>
					<option value="20:00" <?=($arrive=="20:00")?'selected':'';?>>20:00</option>
					<option value="21:00" <?=($arrive=="21:00")?'selected':'';?>>21:00</option>
					<option value="22:00" <?=($arrive=="22:00")?'selected':'';?>>22:00</option>
					</select>
				</td>
				</tr>
				<tr>
				<th>교통편</th>
				<td>
					<select name="vehicle" id="vehicle" class="ddl">
					<option value="">선택</option>
					<option value="승용차" <?=($vehicle=="승용차")?'selected':'';?>>승용차</option>
					<option value="버스" <?=($vehicle=="버스")?'selected':'';?>>버스</option>
					<option value="기차" <?=($vehicle=="기차")?'selected':'';?>>기차</option>
					<option value="기타" <?=($vehicle=="기타")?'selected':'';?>>기타</option>
					</select>
				</td>
				</tr>
				<tr>
				<th>기타사항</th>
				<td>
					<textarea name="etc" rows="3" cols="20" id="etc" onkeyup="TextBoxInputLengthCheck(200,'etc','textlimit');"><?=$etc?></textarea>
					<div class="txtaralimit"><span id="textlimit">0</span>/200 bytes (최대 한글 100자, 영문 200자)</div>

				</td>
				</tr>

				</tbody></table>

				<div class="btnArea">
				<button type="submit" class="btn"><span>신청하기</span></button>
				</div>
			</div>

</form>

<form name="fsearch" id="fsearch" method="post"  style="margin:0px;">
<input type=hidden name=bo_table value="<?=$bo_table?>">

			<div id="reserve_search" class="contIn" style="display: none; ">
				<div class="help">
				예약신청시 입력한 성함과 연락처를 입력후 확인을 클릭하세요.<br>
				</div>
	
				<table class="write_form" style="margin-top:10px;">
				<colgroup>
				<col width="80">
				<col>
				</colgroup>
				<tbody><tr>
				<th>예약자명</th>
				<td>
					<input name="name" type="text" size="10">
				</td>
				</tr>
				<tr>
				<th>전화번호</th>
				<td>
					<select name="tel[]" class="ddl">
					<option selected="selected" value="">선택</option>
					<option value="010">010</option>
					<option value="011">011</option>
					<option value="016">016</option>
					<option value="017">017</option>
					<option value="018">018</option>
					<option value="019">019</option>

					</select> - 
					<input name="tel[]" type="text" maxlength="4" size="4" > - 
					<input name="tel[]" type="text" maxlength="4" size="4" >
				</td>
				</tr>
				<tr>
				<th>입실일</th>
				<td>
					<span style="display:inline-block;"><input name="input_date" type="text" maxlength="10" size="10" id="input_date2" value="" class="datepicker"> </span>
				</td>
				</tr>
				</tbody></table>


				<div class="btnArea">
				<button type="button" class="btn" onclick="searchCheck()"><span>조회하기</span></button>
				</div>
			</div>
</form>
		</div>
	</div>
</div>

