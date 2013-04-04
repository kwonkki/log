
function run_order(item)
{
    if (!confirm("정렬을 시작하시겠습니까?")) return false;

    var btn = $("#btn_order_"+item).html();

    $("#btn_order_"+item).html("<img src=\"../img/icon_loading.gif\">");

    var url = "../mw.proc/mw.adm.order.php";
    $.post (url, { 'bo_table':g4_bo_table, 'item':item }, function (req) {
            alert(req);
            $("#btn_order_"+item).html(btn);
    });
}

function run_watermark_remake()
{
    if (!confirm("데이터 양에 따라 오래걸릴수도 있습니다.\n\n워터마크를 재생성을 시작하시겠습니까?")) {
        return false;
    }

    var btn = $("#btn_watermark_remake").html();

    $("#btn_watermark_remake").html("<img src=\"../img/icon_loading.gif\">");

    var url = "../mw.proc/mw.adm.watermark.remake.php";
    $.post(url, { 'bo_table':g4_bo_table }, function (req) {
            alert(req);
            $("#btn_watermark_remake").html(btn);
    });
}

function run_thumb_remake()
{
    if (!confirm("데이터 양에 따라 오래걸릴수도 있습니다.\n\n썸네일 재생성을 시작하시겠습니까?")) {
        return false;
    }

    var btn = $("#btn_thumb_remake").html();

    $("#btn_thumb_remake").html("<img src=\"../img/icon_loading.gif\">");

    var url = "../mw.proc/mw.adm.thumb.remake.php";
    $.post(url, { 'bo_table':g4_bo_table }, function (req) {
            alert(req);
            $("#btn_thumb_remake").html(btn);
    });
}

function run_emoticon_sync()
{
    if (!confirm("DB손실의 위험이 있으니 반드시 백업 후 진행하세요!\n\n이모티콘 싱크를 시작하시겠습니까?")) {
        return false;
    }

    var btn = $("#btn_emoticon_sync").html();

    $("#btn_emoticon_sync").html("<img src=\"../img/icon_loading.gif\">");

    var url = "../mw.proc/mw.adm.emoticon.sync.php";
    var param = "bo_table=" + g4_bo_table + "&em_old=" + encodeURIComponent($("#em_old").val()) + "&em_new=" + encodeURIComponent($("#em_new").val());
    $.ajax ({
	url:url,
        type: 'post',
        data: param,
        success: function (req)
        {
            alert(req);
            $("#btn_emoticon_sync").html(btn);
        }
    });
}

function run_category_change()
{
    if (!confirm("정말 변경하시겠습니까?")) {
        return false;
    }

    var btn = $("#btn_category_change").html();

    $("#btn_category_change").html("<img src=\"../img/icon_loading.gif\">");

    var url = "../mw.proc/mw.adm.category.change.php";
    var param = "bo_table=" + g4_bo_table + "&ca_old=" + encodeURIComponent($("#ca_old").val()) + "&ca_new=" + encodeURIComponent($("#ca_new").val());
    $.ajax ({
	url:url,
        type: 'post',
        data: param,
        success: function (req)
        {
            alert(req);
            $("#btn_category_change").html(btn);
        }
    });
}

function all_checked(sw) {
    var f = document.cf_form;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name.substr(0,4) == "chk[")
            f.elements[i].checked = sw;
    }
}
