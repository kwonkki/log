<?
$sub_menu = "100200";
include_once("./_common.php");

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

$token = get_token();

$sql_common = " from $g4[auth_table] a left join $g4[member_table] b on (a.mb_id=b.mb_id) ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "a.mb_id, au_menu";
    $sod = "";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common 
         $sql_search 
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * 
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$g4[title] = "관리권한설정";
include_once("./admin.head.php");

$colspan = 5;
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

<script type="text/javascript">
var list_update_php = "";
var list_delete_php = "auth_list_delete.php";
</script>

<table width=100%>
<form name=fsearch method=get>
<tr>
    <td width=50% align=left>
        <?=$listall?> (건수 : <?=number_format($total_count)?>)
    </td>
    <td width=50% align=right>
        <select name=sfl class=cssfl>
            <option value='a.mb_id'>회원아이디</option>
        </select>
        <input type=text name=stx class=ed required itemname='검색어' value='<?=$stx?>'>
        <input type=image src='<?=$g4[admin_path]?>/img/btn_search.gif' align=absmiddle></td>
</tr>
</form>
</table>

<form name=fauthlist method=post>
<input type=hidden name=sst   value='<?=$sst?>'>
<input type=hidden name=sod   value='<?=$sod?>'>
<input type=hidden name=sfl   value='<?=$sfl?>'>
<input type=hidden name=stx   value='<?=$stx?>'>
<input type=hidden name=page  value='<?=$page?>'>
<input type=hidden name=token value='<?=$token?>'>

<table width=100% cellpadding=0 cellspacing=0>
<colgroup width=30>
<colgroup width=120>
<colgroup width=150>
<colgroup width=''>
<colgroup width=100>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></td>
    <td><?=subject_sort_link('a.mb_id')?>회원아이디</a></td>
    <td><?=subject_sort_link('mb_nick')?>별명</a></td>
	<td>메뉴</td>
	<td>권한</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) 
{
    $mb_nick = get_sideview($row[mb_id], $row[mb_nick], $row[mb_email], $row[mb_homepage]);

    // 메뉴번호가 바뀌는 경우에 현재 없는 저장된 메뉴는 삭제함
    if (!isset($auth_menu[$row[au_menu]]))
    {
        sql_query(" delete from $g4[auth_table] where au_menu = '$row[au_menu]' ");
        continue;
    }

    $list = $i%2;
    echo "
    <input type=hidden name=mb_id[$i] value='$row[mb_id]'>
    <input type=hidden name=au_menu[$i] value='$row[au_menu]'>
    <tr class='list$list col1 ht center'>
        <td><input type=checkbox name=chk[] value='$i'></td>
        <td><a href='?sfl=a.mb_id&stx=$row[mb_id]'>$row[mb_id]</a></td>
        <td>$mb_nick</td>
        <td align=left>&nbsp; [$row[au_menu]] {$auth_menu[$row[au_menu]]}</td>
        <td>$row[au_auth]</td>
    </tr>";
}

if ($i==0) 
    echo "<tr><td colspan='$colspan' height=100 align=center bgcolor='#FFFFFF'>자료가 없습니다.</td></tr>";

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
echo "<table width=100% cellpadding=3 cellspacing=1>";
echo "<tr><td width=50%>";
echo "<input type=button class='btn1' value='선택삭제' onclick=\"btn_check(this.form, 'delete')\">";
echo "</td>";
echo "<td width=50% align=right>$pagelist</td></tr></table>\n";

if ($stx)
    echo "<script type='text/javascript'>document.fsearch.sfl.value = '$sfl';</script>\n";

if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";
?>
</form>

<script type='text/javascript'> document.fsearch.stx.focus(); </script>

<?$colspan=5?>
<p>

<form name=fauthlist2 method=post onsubmit="return fauthlist2_submit(this);" autocomplete="off">
<input type=hidden name=sfl   value='<?=$sfl?>'>
<input type=hidden name=stx   value='<?=$stx?>'>
<input type=hidden name=sst   value='<?=$sst?>'>
<input type=hidden name=sod   value='<?=$sod?>'>
<input type=hidden name=page  value='<?=$page?>'>
<input type=hidden name=token value='<?=$token?>'>

<table width='100%' cellpadding=0 cellspacing=0>
<colgroup width=150>
<colgroup width=''>
<colgroup width=150>
<colgroup width=120>
<colgroup width=100>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td>회원아이디</td>
    <td>접근가능메뉴</td>
    <td>권한</td>
    <td>관리자패스워드</td>
    <td>입력</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<tr class='ht center'>
    <td><input type=text class=ed name=mb_id required itemname='회원아이디' value='<?=$mb_id?>'></td>
    <td>
        <select name=au_menu required itemname='접근가능메뉴'>
        <option value=''>-- 선택하세요
        <?
        foreach($auth_menu as $key=>$value)
        {
            if (!(substr($key, -3) == "000" || $key == "-" || !$key))
                echo "<option value='$key'>[$key] $value";
        }
        ?>
        </select>
    </td>
    <td>
        <table width=210 align=center>
        <tr align=center>
        	<td width=33%><input type=checkbox name='r' value='r' checked></td>
        	<td width=33%><input type=checkbox name='w' value='w'></td>
        	<td width=33%><input type=checkbox name='d' value='d'></td>
        </tr>
        <tr align=center>
        	<td>r<br>(읽기)</td>
        	<td>w<br>(입력,수정)</td>
        	<td>d<br>(삭제)</td>
        </tr>
        </table></td>
    <td><input type=password class=ed name=admin_password required itemname='관리자 패스워드'></td>
    <td><input type=submit class=btn1 value='  확  인  '></td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
</table>

</form>

<script type="text/javascript">
function fauthlist2_submit(f)
{
    f.action = "./auth_update.php";
    return true;
}
</script>

<?
include_once ("./admin.tail.php");
?>
