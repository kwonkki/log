<?
include_once("./_common.php");

$po = sql_fetch(" select * from $g4[poll_table] where po_id = '$po_id' ");
if (!$po[po_id]) 
    alert_close('{$lang[420]}');

$g4[title] = "{$lang[421]}";

$po_subject = $po[po_subject];

$max = 1;
$total_po_cnt = 0;
for ($i=1; $i<=9; $i++) 
{
    $poll = $po["po_poll{$i}"];
    if ($poll == "") { break; }
    $total_po_cnt += $po["po_cnt{$i}"];

    if ($po["po_cnt{$i}"] > $max)
        $max = $po["po_cnt{$i}"];
}
$nf_total_po_cnt = number_format($total_po_cnt);

$list = array();

for ($i=1; $i<=9; $i++) 
{
    $poll = $po["po_poll" . $i];
    if ($poll == "") { break; }

    $list[$i][content] = $poll;
    $list[$i][cnt] = $po["po_cnt" . $i];
    if ($total_po_cnt > 0) 
        $list[$i][rate] = ($list[$i][cnt] / $total_po_cnt) * 100;

    $bar = (int)($list[$i][cnt] / $max * 100);
    
    $list[$i][bar] = $bar;
    $list[$i][num] = $i;
}

$list2 = array();

// 기타의견 리스트
$sql = " select a.*, b.mb_open
           from $g4[poll_etc_table] a
           left join $g4[member_table] b on (a.mb_id = b.mb_id)
          where po_id = '$po_id' order by pc_id desc ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) 
{
    $list2[$i][name] = get_sideview($row[mb_id], cut_str($row[pc_name],10), '', '', $row[mb_open]);
    $list2[$i][idea] = get_text(cut_str($row[pc_idea], 255));
    $list2[$i][datetime] = $row[pc_datetime];

    $list2[$i][del] = "";
    if ($is_admin == "super" || ($row[mb_id] == $member[mb_id] && $row[mb_id])) 
        $list2[$i][del] = "<a href=\"javascript:del('./poll_etc_update.php?w=d&pc_id=$row[pc_id]&po_id=$po_id');\">";
}

// 기타의견 입력
$is_etc = false;
if ($po[po_etc]) 
{
    $is_etc = true;
    $po_etc = $po[po_etc];
    if ($member[mb_id]) 
        $name = "<b>$member[mb_nick]</b> <input type='hidden' name='pc_name' value='$member[mb_nick]'>";
    else 
        $name = "<input type='text' name='pc_name' size=10 class=input required itemname='{$lang[164]}'>";
}

$list3 = array();

// 다른투표
$sql = " select po_id, po_subject, po_date from $g4[poll_table] order by po_id desc ";
$result = sql_query($sql);
for ($i=0; $row2=sql_fetch_array($result); $i++) 
{
    $list3[$i][po_id]   = $row2[po_id];
    $list3[$i][date]    = substr($row2[po_date],2,8);
    $list3[$i][subject] = cut_str($row2[po_subject],60,"…");
}

include_once("$g4[path]/head.sub.php");

echo "";

if (!$skin_dir) $skin_dir = "basic";
$poll_skin_path = "$g4[path]/skin/poll/$skin_dir";
if (!file_exists("$poll_skin_path/poll_result.skin.php")) die("skin error");
include_once ("$poll_skin_path/poll_result.skin.php");

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