<?
include_once("./_common.php");
switch($_GET['bo_table'])
{
	case '001':
		$p = 1;
		$p2 = 1;
		break;
	case '002':
		$p = 2;
		$p2 = 2;
		break;
	case '003':
		$p = 3;
		$p2 = 4;
		break;
	case '004':
		$p = 4;
		$p2 = 4;
		break;
	case '005':
		$p = 5;
		$p2 = 5;
		break;
	case '012':
		$p = 12;
		$p2 = 12;
		break;

}

include_once("./_common.php");

if (!$board[bo_table])
{
    if ($cwin) // 코멘트 보기
       alert_close("{$lang[281]}", $g4[path]);
    else
       alert("{$lang[281]}", $g4[path]);
}

if ($write[wr_is_comment])
{
    /*
    if ($cwin) // 코멘트 보기
        alert_close("코멘트는 상세보기 하실 수 없습니다.");
    else
        alert("코멘트는 상세보기 하실 수 없습니다.");
    */
    goto_url("./board.php?bo_table=$bo_table&wr_id=$write[wr_parent]#c_{$wr_id}");
}

if (!$bo_table)
{
    $msg = "{$lang[282]}\\n\\nboard.php?bo_table=code {$lang[283]}";
    if ($cwin) // 코멘트 보기
        alert_close($msg);
    else
        alert($msg);
}

// wr_id 값이 있으면 글읽기
if ($wr_id)
{
    // 글이 없을 경우 해당 게시판 목록으로 이동
    if (!$write[wr_id])
    {
        $msg = "{$lang[284]}\\n\\n{$lang[285]}";
        if ($cwin)
            alert_close($msg);
        else
            alert($msg, "./board.php?bo_table=$bo_table");
    }

    // 그룹접근 사용
    if ($group[gr_use_access])
    {
        if (!$member[mb_id]) {
            $msg = "{$lang[286]}\\n\\n{$lang[287]}";
            if ($cwin)
                alert_close($msg);
            else
                alert($msg, "./login.php?wr_id=$wr_id{$qstr}&url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id"));
        }

        // 그룹관리자 이상이라면 통과
        if ($is_admin == "super" || $is_admin == "group")
            ;
        else
        {
            // 그룹접근
            $sql = " select count(*) as cnt
                       from $g4[group_member_table]
                      where gr_id = '$board[gr_id]' and mb_id = '$member[mb_id]' ";
            $row = sql_fetch($sql);
            if (!$row[cnt])
                alert("{$lang[288]}\\n\\n{$lang[289]}", $g4[path]);
        }
    }

    // 로그인된 회원의 권한이 설정된 읽기 권한보다 작다면
    if ($member[mb_level] < $board[bo_read_level])
    {
        if ($member[mb_id])
            //alert("글을 읽을 권한이 없습니다.");
            alert("{$lang[288]}", $g4[path]);
        else
            alert("{$lang[288]}\\n\\n{$lang[287]}", "./login.php?wr_id=$wr_id{$qstr}&url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id"));
    }
    
    

    // 자신의 글이거나 관리자라면 통과
    if (($write[mb_id] && $write[mb_id] == $member[mb_id]) || $is_admin)
        ;
    else
    {
        // 비밀글이라면
        if (strstr($write[wr_option], "secret"))
        {
            // 회원이 비밀글을 올리고 관리자가 답변글을 올렸을 경우
            // 회원이 관리자가 올린 답변글을 바로 볼 수 없던 오류를 수정
            $is_owner = false;
            if ($write[wr_reply] && $member[mb_id])
            {
                $sql = " select mb_id from $write_table
                          where wr_num = '$write[wr_num]'
                            and wr_reply = ''
                            and wr_is_comment = '0' ";
                $row = sql_fetch($sql);
                if ($row[mb_id] == $member[mb_id])
                    $is_owner = true;
            }

            $ss_name = "ss_secret_{$bo_table}_$write[wr_num]";

            if (!$is_owner)
            {
                //$ss_name = "ss_secret_{$bo_table}_{$wr_id}";
                // 한번 읽은 게시물의 번호는 세션에 저장되어 있고 같은 게시물을 읽을 경우는 다시 패스워드를 묻지 않습니다.
                // 이 게시물이 저장된 게시물이 아니면서 관리자가 아니라면
                //if ("$bo_table|$write[wr_num]" != get_session("ss_secret"))
                if (!get_session($ss_name))
                    goto_url("./password.php?w=s&bo_table=$bo_table&wr_id=$wr_id{$qstr}");
            }

            set_session($ss_name, TRUE);
        }
    }

    // 한번 읽은글은 브라우저를 닫기전까지는 카운트를 증가시키지 않음
    $ss_name = "ss_view_{$bo_table}_{$wr_id}";
    if (!get_session($ss_name))
    {
        sql_query(" update $write_table set wr_hit = wr_hit + 1 where wr_id = '$wr_id' ");

        // 자신의 글이면 통과
        if ($write[mb_id] && $write[mb_id] == $member[mb_id]) {
            ;
        } else if ($is_guest && $board[bo_read_level] == 1 && $write[wr_ip] == $_SERVER['REMOTE_ADDR']) {
            // 비회원이면서 읽기레벨이 1이고 등록된 아이피가 같다면 자신의 글이므로 통과
            ;
        } else {
            /*
            // 회원이상 글읽기가 가능하다면
            if ($board[bo_read_level] > 1) {
                if ($member[mb_point] + $board[bo_read_point] < 0)
                    alert("보유하신 포인트(".number_format($member[mb_point]).")가 없거나 모자라서 글읽기(".number_format($board[bo_read_point]).")가 불가합니다.\\n\\n포인트를 모으신 후 다시 글읽기 해 주십시오.");

                insert_point($member[mb_id], $board[bo_read_point], "$board[bo_subject] $wr_id 글읽기", $bo_table, $wr_id, '읽기');
            }
            */
            // 글읽기 포인트가 설정되어 있다면
            if ($board[bo_read_point] && $member[mb_point] + $board[bo_read_point] < 0)
                alert("{$lang[290]}\\n\\n{$lang[291]}");

            insert_point($member[mb_id], $board[bo_read_point], "$board[bo_subject] $wr_id {$lang[292]}", $bo_table, $wr_id, '{$lang[293]}');
        }

        set_session($ss_name, TRUE);
    }

    $g4[title] = "$group[gr_subject] > $board[bo_subject] > " . strip_tags(conv_subject($write[wr_subject], 255));
}
else
{
    if ($member[mb_level] < $board[bo_list_level])
    {
        if ($member[mb_id])
            alert("{$lang[294]}", $g4[path]);
        else
            alert("{$lang[294]}\\n\\n{$lang[287]}", "./login.php?wr_id=$wr_id{$qstr}&url=".urlencode("board.php?bo_table=$bo_table&wr_id=$wr_id"));
    }

    if (!$page) $page = 1;

    $g4[title] = "$group[gr_subject] > $board[bo_subject] $page {$lang[295]}";
}

include_once("$g4[path]/head.sub.php");

$width = $board[bo_table_width];
if ($width <= 100) $width .= '%';

// IP보이기 사용 여부
$ip = "";
$is_ip_view = $board[bo_use_ip_view];
if ($is_admin) {
    $is_ip_view = true;
    $ip = $write[wr_ip];
} else // 관리자가 아니라면 IP 주소를 감춘후 보여줍니다.
    $ip = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", "\\1.♡.\\3.\\4", $write[wr_ip]);

// 분류 사용
$is_category = false;
$category_name = "";
if ($board[bo_use_category]) {
    $is_category = true;
    $category_name = $write[ca_name]; // 분류명
}

// 추천 사용
$is_good = false;
if ($board[bo_use_good])
    $is_good = true;

// 비추천 사용
$is_nogood = false;
if ($board[bo_use_nogood])
    $is_nogood = true;

$admin_href = "";
// 최고관리자 또는 그룹관리자라면
if ($member[mb_id] && ($is_admin == 'super' || $group[gr_admin] == $member[mb_id]))
    $admin_href = "$g4[admin_path]/board_form.php?w=u&bo_table=$bo_table";

if (!($board[bo_use_comment] && $cwin))
    include_once("./board_head.php");

echo "";

if (!($board[bo_use_comment] && $cwin)) {
    // 게시물 아이디가 있다면 게시물 보기를 INCLUDE
    if ($wr_id)
        include_once("./view.php");

    // 전체목록보이기 사용이 "예" 또는 wr_id 값이 없다면 목록을 보임
    //if ($board[bo_use_list_view] || empty($wr_id))
    if ($member[mb_level] >= $board[bo_list_level] && $board[bo_use_list_view] || empty($wr_id))
        include_once ("./list.php");

    include_once("./board_tail.php");
}
else
    include_once("./view_comment.php");

echo "\n<!-- 사용스킨 : $board[bo_skin] -->\n";

include_once("$g4[path]/tail.sub.php");
?>

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