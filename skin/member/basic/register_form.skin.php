<? include "css.php" ?>
<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<?
//==============================================================================
// jquery date picker
//------------------------------------------------------------------------------
// 참고) ie 에서는 년, 월 select box 를 두번씩 클릭해야 하는 오류가 있습니다.
//------------------------------------------------------------------------------
// jquery-ui.css 의 테마를 변경해서 사용할 수 있습니다.
// base, black-tie, blitzer, cupertino, dark-hive, dot-luv, eggplant, excite-bike, flick, hot-sneaks, humanity, le-frog, mint-choc, overcast, pepper-grinder, redmond, smoothness, south-street, start, sunny, swanky-purse, trontastic, ui-darkness, ui-lightness, vader
// 아래 css 는 date picker 의 화면을 맞추는 코드입니다.
?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/themes/base/jquery-ui.css" rel="stylesheet" />
<style type="text/css">
<!--
.ui-datepicker { font:12px dotum; }
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 70px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px; }
-->
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
<script type="text/javascript">
/* Korean initialisation for the jQuery calendar extension. */
/* Written by DaeKwon Kang (ncrash.dk@gmail.com). */
jQuery(function($){
	$.datepicker.regional['ko'] = {
		closeText: '<?php echo $lang['151'];?>',
		prevText: '<?php echo $lang['152'];?>',
		nextText: '<?php echo $lang['153'];?>',
		currentText: '<?php echo $lang['154'];?>',
		monthNames: ['1<?php echo $lang['13'];?>(JAN)','2<?php echo $lang['13'];?>(FEB)','3<?php echo $lang['13'];?>(MAR)','4<?php echo $lang['13'];?>(APR)','5<?php echo $lang['13'];?>(MAY)','6<?php echo $lang['13'];?>(JUN)',
		'7<?php echo $lang['13'];?>(JUL)','8<?php echo $lang['13'];?>(AUG)','9<?php echo $lang['13'];?>(SEP)','10<?php echo $lang['13'];?>(OCT)','11<?php echo $lang['13'];?>(NOV)','12<?php echo $lang['13'];?>(DEC)'],
		monthNamesShort: ['1<?php echo $lang['13'];?>','2<?php echo $lang['13'];?>','3<?php echo $lang['13'];?>','4<?php echo $lang['13'];?>','5<?php echo $lang['13'];?>','6<?php echo $lang['13'];?>',
		'7<?php echo $lang['13'];?>','8<?php echo $lang['13'];?>','9<?php echo $lang['13'];?>','10<?php echo $lang['13'];?>','11<?php echo $lang['13'];?>','12<?php echo $lang['13'];?>'],
		dayNames: ['<?php echo $lang['12'];?>','<?php echo $lang['13'];?>','<?php echo $lang['155'];?>','<?php echo $lang['156'];?>','<?php echo $lang['157'];?>','<?php echo $lang['158'];?>','<?php echo $lang['159'];?>'],
		dayNamesShort: ['<?php echo $lang['12'];?>','<?php echo $lang['13'];?>','<?php echo $lang['155'];?>','<?php echo $lang['156'];?>','<?php echo $lang['157'];?>','<?php echo $lang['158'];?>','<?php echo $lang['159'];?>'],
		dayNamesMin: ['<?php echo $lang['12'];?>','<?php echo $lang['13'];?>','<?php echo $lang['155'];?>','<?php echo $lang['156'];?>','<?php echo $lang['157'];?>','<?php echo $lang['158'];?>','<?php echo $lang['159'];?>'],
		weekHeader: 'Wk',
		dateFormat: 'yymmdd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ko']);

    $('#mb_birth').datepicker({
        showOn: 'button',
		buttonImage: '<?=$g4[path]?>/img/calendar.gif',
		buttonImageOnly: true,
        buttonText: "<?php echo $lang['160'];?>",
        changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
        yearRange: 'c-99:c+99',
        maxDate: '+0d'
    }); 
});
</script>
<?
//==============================================================================
?>

<style type="text/css">
<!--
.m_title    { BACKGROUND-COLOR: #F7F7F7; PADDING-LEFT: 15px; PADDING-top: 5px; PADDING-BOTTOM: 5px; }
.m_padding  { PADDING-LEFT: 15px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px; }
.m_padding2 { PADDING-LEFT: 0px; PADDING-top: 5px; PADDING-BOTTOM: 0px; }
.m_padding3 { PADDING-LEFT: 0px; PADDING-top: 5px; PADDING-BOTTOM: 5px; }
-->
</style>

<script>
var member_skin_path = "<?=$member_skin_path?>";
</script>

<script language="JavaScript"> 
var reg_mb_id_check = function() {
    $.ajax({
        type: 'POST',
        url: member_skin_path+'/ajax_mb_id_check.php',
        data: {
            'reg_mb_id': encodeURIComponent($('#reg_mb_id').val())
        },
        cache: false,
        async: false,
        success: function(result) {
            var msg = $('#msg_mb_id');
            switch(result) {
                case '110' : msg.html('<?php echo $lang['332'];?>').css('color', 'red'); break;
                case '120' : msg.html('<?php echo $lang['333'];?>').css('color', 'red'); break;
                case '130' : msg.html('<?php echo $lang['334'];?>').css('color', 'red'); break;
                case '140' : msg.html('<?php echo $lang['335'];?>').css('color', 'red'); break;
                case '000' : msg.html('<?php echo $lang['336'];?>').css('color', 'blue'); break;
                default : alert( '<?php echo $lang['320'];?>\n\n' + result ); break;
            }
            $('#mb_id_enabled').val(result);
        }
    });
}

var reg_mb_nick_check = function() {
    $.ajax({
        type: 'POST',
        url: member_skin_path+'/ajax_mb_nick_check.php',
        data: {
            'reg_mb_nick': ($('#reg_mb_nick').val())
        },
        cache: false,
        async: false,
        success: function(result) {
            var msg = $('#msg_mb_nick');
            switch(result) {
                case '110' : msg.html('<?php echo $lang['337'];?>').css('color', 'red'); break;
                case '120' : msg.html('<?php echo $lang['338'];?>').css('color', 'red'); break;
                case '130' : msg.html('<?php echo $lang['339'];?>').css('color', 'red'); break;
                case '000' : msg.html('<?php echo $lang['340'];?>').css('color', 'blue'); break;
                default : alert( '<?php echo $lang['320'];?>\n\n' + result ); break;
            }
            $('#mb_nick_enabled').val(result);
        }
    });
}

var reg_mb_email_check = function() {
    $.ajax({
        type: 'POST',
        url: member_skin_path+'/ajax_mb_email_check.php',
        data: {
            'reg_mb_id': encodeURIComponent($('#reg_mb_id').val()),
            'reg_mb_email': $('#reg_mb_email').val()
        },
        cache: false,
        async: false,
        success: function(result) {
            var msg = $('#msg_mb_email');
            switch(result) {
                case '110' : msg.html('<?php echo $lang['341'];?>').css('color', 'red'); break;
                case '120' : msg.html('<?php echo $lang['342'];?>').css('color', 'red'); break;
                case '130' : msg.html('<?php echo $lang['343'];?>').css('color', 'red'); break;
                case '000' : msg.html('<?php echo $lang['344'];?>').css('color', 'blue'); break;
                default : alert( '<?php echo $lang['320'];?>\n\n' + result ); break;
            }
            $('#mb_email_enabled').val(result);
        }
    });
}
</script>

<script type="text/javascript" src="<?=$g4[path]?>/js/md5.js"></script>

<script type="text/javascript">

if (typeof(SIDEVIEW_JS) == 'undefined') // 한번만 실행
{
    if (typeof g4_is_member == 'undefined')
        alert('g4_is_member js/sideview.js');
    if (typeof g4_path == 'undefined')
        alert('g4_path js/sideview.js');

    var SIDEVIEW_JS = true;

    // 아래의 소스코드는 daum.net 카페의 자바스크립트를 참고하였습니다.
    // 회원이름 클릭시 회원정보등을 보여주는 레이어
    function insertHead(name, text, evt) 
    {
        var idx = this.heads.length;
        var row = new SideViewRow(-idx, name, text, evt);
        this.heads[idx] = row;
        return row;
    }

    function insertTail(name, evt) 
    {
        var idx = this.tails.length;
        var row = new SideViewRow(idx, name, evt);
        this.tails[idx] = row;
        return row;
    }

    function SideViewRow(idx, name, onclickEvent) 
    {
        this.idx = idx;
        this.name = name;
        this.onclickEvent = onclickEvent;
        this.renderRow = renderRow;
        
        this.isVisible = true;
        this.isDim = false;
    }

    function renderRow() 
    {
        if (!this.isVisible)
            return "";
        
        var str = "<tr height='19'><td id='sideViewRow_"+this.name+"'>&nbsp;<font color=gray>&middot;</font>&nbsp;<span style='color: #A0A0A0;  font-family: ; font-size: 11px;'>"+this.onclickEvent+"</span></td></tr>";
        return str;
    }

    function showSideView(curObj, mb_id, name, email, homepage) 
    {
        var sideView = new SideView('nameContextMenu', curObj, mb_id, name, email, homepage);
        sideView.showLayer();
    }

    function SideView(targetObj, curObj, mb_id, name, email, homepage) 
    {
        this.targetObj = targetObj;
        this.curObj = curObj;
        this.mb_id = mb_id;
        name = name.replace(/…/g,"");
        this.name = name;
        this.email = email;
        this.homepage = homepage;
        this.showLayer = showLayer;
        this.makeNameContextMenus = makeNameContextMenus;
        this.heads = new Array();
        this.insertHead = insertHead;
        this.tails = new Array();
        this.insertTail = insertTail;
        this.getRow = getRow;
        this.hideRow = hideRow;		
        this.dimRow = dimRow;
    
        // 회원이라면 // (비회원의 경우 검색 없음)
        //if (g4_is_member) {
            // 쪽지보내기
            if (mb_id) 
                // 불여우 자바스크립트창이 뜨는 오류를 수정
                this.insertTail("memo", "<a href=\"javascript:win_memo('"+g4_path+"/" + g4_bbs + "/memo_form.php?me_recv_mb_id="+mb_id+"');\"><?php echo $lang['573'];?></a>");
            // 메일보내기
            if (email) 
                this.insertTail("mail", "<a href=\"javascript:;\" onclick=\"win_formmail('"+mb_id+"','"+name+"','"+email+"');\"><?php echo $lang['572'];?></a>");
            // 홈페이지
            if (homepage) 
                this.insertTail("homepage", "<a href=\"javascript:;\" onclick=\"window.open('"+homepage+"');\"><?php echo $lang['571'];?></a>");
            // 자기소개
            if (mb_id) 
                this.insertTail("info", "<a href=\"javascript:;\" onclick=\"win_profile('"+mb_id+"');\"><?php echo $lang['570'];?></a>");
        //}

        // 게시판테이블 아이디가 넘어왔을 경우
        if (g4_bo_table) {
            if (mb_id) // 회원일 경우 아이디로 검색
                this.insertTail("mb_id", "<a href='"+g4_path+"/" + g4_bbs + "/board.php?bo_table="+g4_bo_table+"&sca="+g4_sca+"&sfl=mb_id,1&stx="+mb_id+"'><?php echo $lang['569'];?></a>");
            else // 비회원일 경우 이름으로 검색
                this.insertTail("name", "<a href='"+g4_path+"/" + g4_bbs + "/board.php?bo_table="+g4_bo_table+"&sca="+g4_sca+"&sfl=wr_name,1&stx="+name+"'><?php echo $lang['568'];?></a>");
        }
        if (mb_id)
            this.insertTail("new", "<a href='"+g4_path+"/" + g4_bbs + "/new.php?mb_id="+mb_id+"'><?php echo $lang['567'];?></a>");

        // 최고관리자일 경우
        if (g4_is_admin == "super") {
            // 회원정보변경
            if (mb_id)
                this.insertTail("modify", "<a href='"+g4_path+"/" + g4_admin + "/member_form.php?w=u&mb_id="+mb_id+"' target='_blank'><?php echo $lang['566'];?></a>");
            // 포인트내역
            if (mb_id)
                this.insertTail("point", "<a href='"+g4_path+"/" + g4_admin + "/point_list.php?sfl=mb_id&stx="+mb_id+"' target='_blank'><?php echo $lang['565'];?></a>");
        }
    }

    function showLayer() 
    {
        clickAreaCheck = true;
        var oSideViewLayer = document.getElementById(this.targetObj);
        var oBody = document.body;
            
        if (oSideViewLayer == null) {
            oSideViewLayer = document.createElement("DIV");
            oSideViewLayer.id = this.targetObj;
            oSideViewLayer.style.position = 'absolute';
            oBody.appendChild(oSideViewLayer);
        }
        oSideViewLayer.innerHTML = this.makeNameContextMenus();
        
        if (getAbsoluteTop(this.curObj) + this.curObj.offsetHeight + oSideViewLayer.scrollHeight + 5 > oBody.scrollHeight)
            oSideViewLayer.style.top = getAbsoluteTop(this.curObj) - oSideViewLayer.scrollHeight;
        else
            oSideViewLayer.style.top = getAbsoluteTop(this.curObj) + this.curObj.offsetHeight;

        oSideViewLayer.style.left = getAbsoluteLeft(this.curObj) - this.curObj.offsetWidth + 14;

        divDisplay(this.targetObj, 'block');

        selectBoxHidden(this.targetObj);
    }

    function getAbsoluteTop(oNode)
    {
        var oCurrentNode=oNode;
        var iTop=0;
        while(oCurrentNode.tagName!="BODY") {
            iTop+=oCurrentNode.offsetTop - oCurrentNode.scrollTop;
            oCurrentNode=oCurrentNode.offsetParent;
        }
        return iTop;
    }

    function getAbsoluteLeft(oNode)
    {
        var oCurrentNode=oNode;
        var iLeft=0;
        iLeft+=oCurrentNode.offsetWidth;
        while(oCurrentNode.tagName!="BODY") {
            iLeft+=oCurrentNode.offsetLeft;
            oCurrentNode=oCurrentNode.offsetParent;
        }
        return iLeft;
    }


    function makeNameContextMenus() 
    {
        var str = "<table border='0' cellpadding='0' cellspacing='0' width='90' style='border:1px solid #E0E0E0;' bgcolor='#F9FBFB'>";
        
        var i=0;
        for (i=this.heads.length - 1; i >= 0; i--)
            str += this.heads[i].renderRow();
       
        var j=0;
        for (j=0; j < this.tails.length; j++)
            str += this.tails[j].renderRow();
        
        str += "</table>";
        return str;
    }

    function getRow(name) 
    {
        var i = 0;
        var row = null;
        for (i=0; i<this.heads.length; ++i) 
        {
            row = this.heads[i];
            if (row.name == name) return row;
        }

        for (i=0; i<this.tails.length; ++i) 
        {
            row = this.tails[i];
            if (row.name == name) return row;
        }
        return row;
    }

    function hideRow(name) 
    {
        var row = this.getRow(name);
        if (row != null)
            row.isVisible = false;
    }

    function dimRow(name) 
    {
        var row = this.getRow(name);
        if (row != null)
            row.isDim = true;
    }
    // Internet Explorer에서 셀렉트박스와 레이어가 겹칠시 레이어가 셀렉트 박스 뒤로 숨는 현상을 해결하는 함수
    // 레이어가 셀렉트 박스를 침범하면 셀렉트 박스를 hidden 시킴
    // <div id=LayerID style="display:none; position:absolute;" onpropertychange="selectBoxHidden('LayerID')">
    function selectBoxHidden(layer_id) 
    {
        //var ly = eval(layer_id);
        var ly = document.getElementById(layer_id);

        // 레이어 좌표
        var ly_left   = ly.offsetLeft;
        var ly_top    = ly.offsetTop;
        var ly_right  = ly.offsetLeft + ly.offsetWidth;
        var ly_bottom = ly.offsetTop + ly.offsetHeight;

        // 셀렉트박스의 좌표
        var el;

        for (i=0; i<document.forms.length; i++) {
            for (k=0; k<document.forms[i].length; k++) {
                el = document.forms[i].elements[k];    
                if (el.type == "select-one") {
                    var el_left = el_top = 0;
                    var obj = el;
                    if (obj.offsetParent) {
                        while (obj.offsetParent) {
                            el_left += obj.offsetLeft;
                            el_top  += obj.offsetTop;
                            obj = obj.offsetParent;
                        }
                    }
                    el_left   += el.clientLeft;
                    el_top    += el.clientTop;
                    el_right  = el_left + el.clientWidth;
                    el_bottom = el_top + el.clientHeight;

                    // 좌표를 따져 레이어가 셀렉트 박스를 침범했으면 셀렉트 박스를 hidden 시킴
                    if ( (el_left >= ly_left && el_top >= ly_top && el_left <= ly_right && el_top <= ly_bottom) || 
                         (el_right >= ly_left && el_right <= ly_right && el_top >= ly_top && el_top <= ly_bottom) ||
                         (el_left >= ly_left && el_bottom >= ly_top && el_right <= ly_right && el_bottom <= ly_bottom) ||
                         (el_left >= ly_left && el_left <= ly_right && el_bottom >= ly_top && el_bottom <= ly_bottom) ||
                         (el_top <= ly_bottom && el_left <= ly_left && el_right >= ly_right)
                        )
                        el.style.visibility = 'hidden';
                }
            }
        }
    }

    // 감추어진 셀렉트 박스를 모두 보이게 함
    function selectBoxVisible() 
    {
        for (i=0; i<document.forms.length; i++) 
        {
            for (k=0; k<document.forms[i].length; k++) 
            {
                el = document.forms[i].elements[k];    
                if (el.type == "select-one" && el.style.visibility == 'hidden')
                    el.style.visibility = 'visible';
            }
        }
    }


    function getAbsoluteTop(oNode)
    {
        var oCurrentNode=oNode;
        var iTop=0;
        while(oCurrentNode.tagName!="BODY") {
            iTop+=oCurrentNode.offsetTop - oCurrentNode.scrollTop;
            oCurrentNode=oCurrentNode.offsetParent;
        }
        return iTop;
    }


    function getAbsoluteLeft(oNode)
    {
        var oCurrentNode=oNode;
        var iLeft=0;
        iLeft+=oCurrentNode.offsetWidth;
        while(oCurrentNode.tagName!="BODY") {
            iLeft+=oCurrentNode.offsetLeft;
            oCurrentNode=oCurrentNode.offsetParent;
        }
        return iLeft;
    }

    function divDisplay(id, act) 
    {
        selectBoxVisible();

        document.getElementById(id).style.display = act;
    }

    function hideSideView() 
    {
        if (document.getElementById("nameContextMenu"))
            divDisplay ("nameContextMenu", 'none');
    }

    var clickAreaCheck = false;
    document.onclick = function() 
    {
        if (!clickAreaCheck) 
            hideSideView();
        else 
            clickAreaCheck = false;
    }
}


</script>

</head>




<div style="margin-bottom : 10px;">
<img src="<?=$g4['path']?>/img/icon/big/Dots.gif" style="float : left; margin-right : 5px;"><h1><font color="blue">CSD Registration Form</form></h1>
</div>
<form id="fregisterform" name=fregisterform method=post onsubmit="return fregisterform_submit(this);" enctype="multipart/form-data" autocomplete="off">
<input type=hidden name=w                value="<?=$w?>">
<input type=hidden name=url              value="<?=$urlencode?>">
<input type=hidden name=mb_jumin         value="<?=$jumin?>">
<input type=hidden name=mb_id_enabled    value="" id="mb_id_enabled">
<input type=hidden name=mb_nick_enabled  value="" id="mb_nick_enabled">
<input type=hidden name=mb_email_enabled value="" id="mb_email_enabled">
<!-- <input type=hidden name=token value="<?=$token?>"> -->

<table width=100% cellspacing=0 cellpadding="0">
	<tr>
		<td>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<TABLE cellSpacing=1 width=100% bgcolor="#DDDDDD">
					<TR bgcolor="#FFFFFF">
						<TD width="160" class=m_title style="background-color: #F6F6F6">
						<?php echo $lang['34'];?></TD>
						<TD class=m_padding>
						<input class=ed maxlength=20 size=20 id='reg_mb_id' name="mb_id" value="" <? if ($w=='u') { echo "readonly style='background-color:#dddddd;'"; } ?>
                    <? if ($w=='') { echo "onblur='reg_mb_id_check();'"; } ?>>
						<span id='msg_mb_id'></span>
						<table height=25 cellspacing=0 cellpadding=0 border=0>
							<tr>
								<td><font color="#66a2c8"><?php echo $lang['161'];?></font></td>
							</tr>
						</table></TD>
					</TR>
					<TR bgcolor="#FFFFFF">
						<TD class=m_title style="background-color: #F6F6F6"><?php echo $lang['162'];?></TD>
						<TD class=m_padding>
						<INPUT class=ed type=password name="mb_password" size=20 maxlength=20 <?=($w=="")?"required":"";?> itemname="<?php echo $lang['162'];?>"></TD>
					</TR>
					<TR bgcolor="#FFFFFF">
						<TD class=m_title style="background-color: #F6F6F6"><?php echo $lang['163'];?></TD>
						<TD class=m_padding>
						<INPUT class=ed type=password name="mb_password_re" size=20 maxlength=20 <?=($w=="")?"required":"";?> itemname="<?php echo $lang['163'];?>"></TD>
					</TR>
        <!-- <TR bgcolor="#FFFFFF">
            <TD class=m_title>패스워드 분실시 질문</TD>
            <TD class=m_padding>
                <select name=mb_password_q_select onchange="this.form.mb_password_q.value=this.value;">
                    <option value="">선택하십시오.</option>
                    <option value="내가 좋아하는 캐릭터는?">내가 좋아하는 캐릭터는?</option>
                    <option value="타인이 모르는 자신만의 신체비밀이 있다면?">타인이 모르는 자신만의 신체비밀이 있다면?</option>
                    <option value="자신의 인생 좌우명은?">자신의 인생 좌우명은?</option>
                    <option value="초등학교 때 기억에 남는 짝꿍 이름은?">초등학교 때 기억에 남는 짝꿍 이름은?</option>
                    <option value="유년시절 가장 생각나는 친구 이름은?">유년시절 가장 생각나는 친구 이름은?</option>
                    <option value="가장 기억에 남는 선생님 성함은?">가장 기억에 남는 선생님 성함은?</option>
                    <option value="친구들에게 공개하지 않은 어릴 적 별명이 있다면?">친구들에게 공개하지 않은 어릴 적 별명이 있다면?</option>
                    <option value="다시 태어나면 되고 싶은 것은?">다시 태어나면 되고 싶은 것은?</option>
                    <option value="가장 감명깊게 본 영화는?">가장 감명깊게 본 영화는?</option>
                    <option value="읽은 책 중에서 좋아하는 구절이 있다면?">읽은 책 중에서 좋아하는 구절이 있다면?</option>
                    <option value="기억에 남는 추억의 장소는?">기억에 남는 추억의 장소는?</option>
                    <option value="인상 깊게 읽은 책 이름은?">인상 깊게 읽은 책 이름은?</option>
                    <option value="자신의 보물 제1호는?">자신의 보물 제1호는?</option>
                    <option value="받았던 선물 중 기억에 남는 독특한 선물은?">받았던 선물 중 기억에 남는 독특한 선물은?</option>
                    <option value="자신이 두번째로 존경하는 인물은?">자신이 두번째로 존경하는 인물은?</option>
                    <option value="아버지의 성함은?">아버지의 성함은?</option>
                    <option value="어머니의 성함은?">어머니의 성함은?</option>
                </select>

                <table width="350" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class=m_padding2><input class=ed type=text name="mb_password_q" size=55 required itemname="패스워드 분실시 질문" value="<?=$member[mb_password_q]?>"></td>
                </tr>
                </table>
            </TD>
        </TR>
        <TR bgcolor="#FFFFFF">
            <TD class=m_title>패스워드 분실시 답변</TD>
            <TD class=m_padding><input class=ed type=text name='mb_password_a' size=38 required itemname='패스워드 분실시 답변' value='<?=$member[mb_password_a]?>'></TD>
        </TR> -->
        		</TABLE></td>
			</tr>
		</table>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td height="1" bgcolor="#ffffff"></td>
			</tr>
		</table>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<TABLE cellSpacing=1 width=100% bgcolor="#DDDDDD">
					<TR bgcolor="#FFFFFF">
						<TD width="160" class=m_title style="background-color: #F6F6F6">
						<?php echo $lang['164'];?></TD>
						<TD class=m_padding>
						<input name=mb_name itemname="<?php echo $lang['164'];?>" value="<?=$member[mb_name]?>" <?=$member[mb_name]?"readonly class=ed2":"class=ed";?>> 
                <?php echo $lang['165'];?>
            </TD>
					</TR>

        <? if ($member[mb_nick_date] <= date("Y-m-d", $g4[server_time] - ($config[cf_nick_modify] * 86400))) { // 별명수정일이 지났다면 수정가능 ?>
        			<input type=hidden name=mb_nick_default value='<?=$member[mb_nick]?>'>
					<TR bgcolor="#FFFFFF">
						<TD class=m_title style="background-color: #F6F6F6"><?php echo $lang['166'];?></TD>
						<TD class='m_padding lh'>
						<input class=ed type=text id='reg_mb_nick' name='mb_nick' maxlength=20 value=''
                    onblur="reg_mb_nick_check();"> <span id='msg_mb_nick'>
            			</TD>
					</TR>
        <? } else { ?>
        			<input type=hidden name="mb_nick_default" value='<?=$member[mb_nick]?>'>
					<input type=hidden name="mb_nick" value="<?=$member[mb_nick]?>">
        <? } ?>

        <input type=hidden name='old_email' value='<?=$member[mb_email]?>'>
					<TR bgcolor="#FFFFFF">
						<TD class=m_title style="background-color: #F6F6F6">
						E-mail</TD>
						<TD class='m_padding lh'>
						<input class=ed type=text id='reg_mb_email' name='mb_email' size=38 maxlength=100 value=''
                    onblur="reg_mb_email_check()"> <span id='msg_mb_email'>
						</span>
                <? if ($config[cf_use_email_certify]) { ?>
                    <? if ($w=='') { echo "<br>{$lang[278]}"; } ?>
                    <? if ($w=='u') { echo "<br>{$lang[279]}"; } ?>
                <? } ?>
            </TD>
					</TR>

        <? if ($w=="") { ?>
            		<TR bgcolor="#FFFFFF">
						<TD class=m_title style="background-color: #F6F6F6"><?php echo $lang['170'];?></TD>
						<TD class=m_padding>
						<input class=ed type=text id=mb_birth name='mb_birth' size=8 maxlength=8 minlength=8 required numeric itemname='<?php echo $lang['170'];?>' value='<?=$member[mb_birth]?>' readonly title=''></TD>
					</TR>
        <? } ?>

        <? if ($member[mb_sex]) { ?>
            		<input type=hidden name=mb_sex value='<?=$member[mb_sex]?>'>
        <? } else { ?>
            		<TR bgcolor="#FFFFFF">
						<TD class=m_title style="background-color: #F6F6F6"><?php echo $lang['171'];?></TD>
						<TD class=m_padding>
						<select id=mb_sex name=mb_sex required itemname='<?php echo $lang['171'];?>'>
						<option value=''><?php echo $lang['172'];?>
                    	<option value='F'><?php echo $lang['173'];?>
                    	<option value='M'><?php echo $lang['174'];?></select>
                    <script type="text/javascript">//document.getElementById('mb_sex').value='<?=$member[mb_sex]?>';</script>
                    	</td>
					</TR>
        <? } ?>
        <? if ($config[cf_use_homepage]) { ?>
        			<TR bgcolor="#FFFFFF">
						<TD class=m_title style="background-color: #F6F6F6"><?php echo $lang['99'];?></TD>
						<TD class=m_padding>
						<input class=ed type=text name='mb_homepage' size=38 maxlength=255 <?=$config[cf_req_homepage]?'required':'';?> itemname='<?php echo $lang['99'];?>' value='<?=$member[mb_homepage]?>'></TD>
					</TR>
        <? } ?>

        <? if ($config[cf_use_tel]) { ?>
        			<TR bgcolor="#FFFFFF">
						<TD class=m_title style="background-color: #F6F6F6"><?php echo $lang['175'];?></TD>
						<TD class=m_padding>
						<input class=ed type=text name='mb_tel' size=21 maxlength=20 <?=$config[cf_req_tel]?'required':'';?> itemname='<?php echo $lang['175'];?>' value='<?=$member[mb_tel]?>'></TD>
					</TR>
        <? } ?>

        <? if ($config[cf_use_hp]) { ?>
        			<TR bgcolor="#FFFFFF">
						<TD class=m_title style="background-color: #F6F6F6">
						<?php echo $lang['176'];?></TD>
						<TD class=m_padding>
						<input class=ed type=text name='mb_hp' size=21 maxlength=20 <?=$config[cf_req_hp]?'required':'';?> itemname='<?php echo $lang['176'];?>' value='<?=$member[mb_hp]?>'></TD>
					</TR>
        <? } ?>

        <? if ($config[cf_use_addr]) { ?>
        			<TR bgcolor="#FFFFFF">
						<TD class=m_title style="background-color: #F6F6F6"><?php echo $lang['177'];?></TD>
						<TD valign="middle" class=m_padding>
						<table width="330" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="25">
								<input class=ed type=text name='mb_zip1' size=4 maxlength=3 readonly <?=$config[cf_req_addr]?'required':'';?> itemname='<?php echo $lang['178'];?>' value='<?=$member[mb_zip1]?>'>
                         		- 
                        <input class=ed type=text name='mb_zip2' size=4 maxlength=3 readonly <?=$config[cf_req_addr]?'required':'';?> itemname='<?php echo $lang['179'];?>' value='<?=$member[mb_zip2]?>'>
                        		&nbsp;<a class="btn12" onclick="win_zip('fregisterform', 'mb_zip1', 'mb_zip2', 'mb_addr1', 'mb_addr2');" href="javascript:;"><?php echo $lang['181'];?></a></td>
							</tr>
							<tr>
								<td height="25" colspan="2">
								<input class=ed type=text name='mb_addr1' size=60 readonly <?=$config[cf_req_addr]?'required':'';?> itemname='<?php echo $lang['177'];?>' value='<?=$member[mb_addr1]?>'></td>
							</tr>
							<tr>
								<td height="25" colspan="2">
								<input class=ed type=text name='mb_addr2' size=60 <?=$config[cf_req_addr]?'required':'';?> itemname='<?php echo $lang['180'];?>' value='<?=$member[mb_addr2]?>'></td>
							</tr>
						</table></TD>
					</TR>
        <? } ?>

        		</TABLE></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td height="1" bgcolor="#ffffff"></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<TABLE cellSpacing=1 width=100% bgcolor="#DDDDDD">

        <? if ($config[cf_use_signature]) { ?>
        			<TR bgcolor="#FFFFFF">
						<TD width="160" class=m_title style="background-color: #F6F6F6">
						<?php echo $lang['182'];?></TD>
						<TD class=m_padding>
						<textarea name=mb_signature class=tx rows=3 style='width:95%;' <?=$config[cf_req_signature]?'required':'';?> itemname='<?php echo $lang['182'];?>'><?=$member[mb_signature]?></textarea></TD>
					</TR>
        <? } ?>

        <? if ($config[cf_use_profile]) { ?>
        			<TR bgcolor="#FFFFFF">
						<TD width="160" class=m_title style="background-color: #F6F6F6">
						<?php echo $lang['183'];?></TD>
						<TD class=m_padding>
						<textarea name=mb_profile class=tx rows=3 style='width:95%;' <?=$config[cf_req_profile]?'required':'';?> itemname='<?php echo $lang['183'];?>'><?=$member[mb_profile]?></textarea></TD>
					</TR>
        <? } ?>

        <? if ($member[mb_level] >= $config[cf_icon_level]) { ?>
        			<TR bgcolor="#FFFFFF">
						<TD width="160" class=m_title style="background-color: #F6F6F6">
						<?php echo $lang['184'];?></TD>
						<TD class=m_padding>
						<INPUT class=ed type=file name='mb_icon' size=30>
						<table width="350" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class=m_padding3><?php echo $lang['185'];?>(<?=$config[cf_member_icon_width]?>px) x <?php echo $lang['186'];?>(<?=$config[cf_member_icon_height]?>px) 
								<br><?php echo $lang['187'];?><?=number_format($config[cf_member_icon_size])?> Byte)
                            <? if ($w == "u" && file_exists($mb_icon)) { ?>
                                <br><img src='<?=$mb_icon?>' align=absmiddle>
								<input type=checkbox name='del_mb_icon' value='1'><?php echo $lang['82'];?>
                            <? } ?>
                        </td>
							</tr>
						</table></TD>
					</TR>
        <? } ?>
					<!--
        			<TR bgcolor="#FFFFFF">
						<TD width="160" class=m_title style="background-color: #F6F6F6">
						<?php echo $lang['188'];?></TD>
						<TD class=m_padding>
						<input type=checkbox name=mb_mailling value='1' <?=($w=='' || $member[mb_mailling])?'checked':'';?>><?php echo $lang['189'];?></TD>
					</TR>
					<TR bgcolor="#FFFFFF">
						<TD width="160" class=m_title style="background-color: #F6F6F6">
						<?php echo $lang['190'];?></TD>
						<TD class=m_padding>
						<input type=checkbox name=mb_sms value='1' <?=($w=='' || $member[mb_sms])?'checked':'';?>><?php echo $lang['191'];?></TD>
					</TR>
					
        <? if ($member[mb_open_date] <= date("Y-m-d", $g4[server_time] - ($config[cf_open_modify] * 86400))) { // 정보공개 수정일이 지났다면 수정가능 ?> 
        			<input type=hidden name=mb_open_default value='<?=$member[mb_open]?>'>
					<TR bgcolor="#FFFFFF">
						<TD width="160" class=m_title style="background-color: #F6F6F6">
						<?php echo $lang['192'];?></TD>
						<TD class=m_padding>
						<input type=checkbox name=mb_open value='1' <?=($w=='' || $member[mb_open])?'checked':'';?>><?php echo $lang['193'];?> 
                		<br>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $lang['194'];?><?=(int)$config[cf_open_modify]?><?php echo $lang['195'];?></td>
					</TR> 
					
					-->
        <? } else { ?> 
        			<input type=hidden name="mb_open" value="<?=$member[mb_open]?>">
					<TR bgcolor="#FFFFFF">
						<TD width="160" class=m_title style="background-color: #F6F6F6">
						<?php echo $lang['192'];?></TD>
						<TD class=m_padding><?php echo $lang['196'];?><?=(int)$config[cf_open_modify]?><?php echo $lang['197'];?><?=date("Y/m/j", strtotime("$member[mb_open_date] 00:00:00") + ($config[cf_open_modify] * 86400))?><?php echo $lang['198'];?>
						<br><?php echo $lang['199'];?> 
            			</td>
					</tr> 
        <? } ?> 

        <? if ($w == "" && $config[cf_use_recommend]) { ?>
        			<TR bgcolor="#FFFFFF">
						<TD width="160" class=m_title style="background-color: #F6F6F6">
						<?php echo $lang['200'];?></TD>
						<TD class=m_padding>
						<input type=text name=mb_recommend class=ed></TD>
					</TR>
        <? } ?>

        		</TABLE></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td height="1" bgcolor="#ffffff"></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<TABLE cellSpacing=1 width=100% bgcolor="#DDDDDD">
					<TR bgcolor="#FFFFFF">
						<td width="160" height="28" class=m_title style="background-color: #F6F6F6">
						<img id='kcaptcha_image' /> </td>
						<td class=m_padding>
						<input type=input class=ed size=10 name=wr_key itemname="<?php echo $lang['94'];?>" required>&nbsp;&nbsp;<?php echo $lang['95'];?>
            			</td>
					</tr>
				</table></td>
			</tr>
		</table>
		<p align=center>
<input type="submit" value="Register" name="B1" class="btn3"></td>
	</tr>
</table>

</form>


<script type="text/javascript" src="<?="$g4[path]/js/jquery.kcaptcha.js"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"?>"></script>
<script type="text/javascript">
$(function() {
    // 폼의 첫번째 입력박스에 포커스 주기 
    $("#fregisterform :input[type=text]:visible:enabled:first").focus(); 
});

// submit 최종 폼체크
function fregisterform_submit(f) 
{
    // 회원아이디 검사
    if (f.w.value == "") {

        reg_mb_id_check();

        if (document.getElementById('mb_id_enabled').value!='000') {
            alert('<?php echo $lang['201'];?>');
            document.getElementById('reg_mb_id').select();
            return false;
        }
    }

    if (f.w.value == '') {
        if (f.mb_password.value.length < 3) {
            alert('<?php echo $lang['202'];?>');
            f.mb_password.focus();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        alert('<?php echo $lang['203'];?>');
        f.mb_password_re.focus();
        return false;
    }

    if (f.mb_password.value.length > 0) {
        if (f.mb_password_re.value.length < 3) {
            alert('<?php echo $lang['204'];?>');
            f.mb_password_re.focus();
            return false;
        }
    }

    /*
    if (f.mb_password_q.value.length < 1) {
        alert('패스워드 분실시 질문을 선택하거나 입력하십시오.');
        f.mb_password_q.focus();
        return false;
    }

    if (f.mb_password_a.value.length < 1) {
        alert('패스워드 분실시 답변을 입력하십시오.');
        f.mb_password_a.focus();
        return false;
    }
    */

    // 이름 검사
    if (f.w.value=='') {
        if (f.mb_name.value.length < 1) {
            alert('<?php echo $lang['205'];?>');
            f.mb_name.focus();
            return false;
        }

        /*var pattern = /([^가-힣\x20])/i; 
        if (pattern.test(f.mb_name.value)) {
            alert('<?php echo $lang['206'];?>');
            f.mb_name.focus();
            return false;
        }*/
    }

    // 별명 검사
    if ((f.w.value == "") ||
        (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {

        reg_mb_nick_check();

        if (document.getElementById('mb_nick_enabled').value!='000') {
            alert('<?php echo $lang['207'];?>');
            document.getElementById('reg_mb_nick').select();
            return false;
        }
    }

    // E-mail 검사
    if ((f.w.value == "") ||
        (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {

        reg_mb_email_check();

        if (document.getElementById('mb_email_enabled').value!='000') {
            alert('<?php echo $lang['208'];?>');
            document.getElementById('reg_mb_email').select();
            return false;
        }

        // 사용할 수 없는 E-mail 도메인
        var domain = prohibit_email_check(f.mb_email.value);
        if (domain) {
            alert("'"+domain+"'<?php echo $lang['209'];?>");
            document.getElementById('reg_mb_email').focus();
            return false;
        }
    }

    if (typeof(f.mb_birth) != 'undefined') {
        if (f.mb_birth.value.length < 1) {
            alert('<?php echo $lang['210'];?>');
            //f.mb_birth.focus();
            return false;
        }

        var todays = <?=date("Ymd", $g4['server_time']);?>;
        // 오늘날짜에서 생일을 빼고 거기서 140000 을 뺀다.
        // 결과가 0 이상의 양수이면 만 14세가 지난것임
        var n = todays - parseInt(f.mb_birth.value) - 140000;
        if (n < 0) {
            alert("<?php echo $lang['211'];?>");
            return false;
        }
    }

    if (typeof(f.mb_sex) != 'undefined') {
        if (f.mb_sex.value == '') {
            alert('<?php echo $lang['212'];?>');
            f.mb_sex.focus();
            return false;
        }
    }

    if (typeof f.mb_icon != 'undefined') {
        if (f.mb_icon.value) {
            if (!f.mb_icon.value.toLowerCase().match(/.(gif)$/i)) {
                alert('<?php echo $lang['213'];?>');
                f.mb_icon.focus();
                return false;
            }
        }
    }

    if (typeof(f.mb_recommend) != 'undefined') {
        if (f.mb_id.value == f.mb_recommend.value) {
            alert('<?php echo $lang['214'];?>');
            f.mb_recommend.focus();
            return false;
        }
    }

            if (!check_kcaptcha(f.wr_key)) { 
                return false; 
            }

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/register_form_update.php';";
    else
        echo "f.action = './register_form_update.php';";
    ?>

    // 보안인증관련 코드로 반드시 포함되어야 합니다.
    set_cookie("<?=md5($token)?>", "<?=base64_encode($token)?>", 1, "<?=$g4['cookie_domain']?>");

    return true;
}

// 금지 메일 도메인 검사
function prohibit_email_check(email)
{
    email = email.toLowerCase();

    var prohibit_email = "<?=trim(strtolower(preg_replace("/(\r\n|\r|\n)/", ",", $config[cf_prohibit_email])));?>";
    var s = prohibit_email.split(",");
    var tmp = email.split("@");
    var domain = tmp[tmp.length - 1]; // 메일 도메인만 얻는다

    for (i=0; i<s.length; i++) {
        if (s[i] == domain)
            return domain;
    }
    return "";
}
</script>