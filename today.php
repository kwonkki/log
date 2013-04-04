<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript">
<!--
function FP_openNewWindow(w,h,nav,loc,sts,menu,scroll,resize,name,url) {//v1.0
 var windowProperties=''; if(nav==false) windowProperties+='toolbar=no,'; else
  windowProperties+='toolbar=yes,'; if(loc==false) windowProperties+='location=no,'; 
 else windowProperties+='location=yes,'; if(sts==false) windowProperties+='status=no,';
 else windowProperties+='status=yes,'; if(menu==false) windowProperties+='menubar=no,';
 else windowProperties+='menubar=yes,'; if(scroll==false) windowProperties+='scrollbars=no,';
 else windowProperties+='scrollbars=yes,'; if(resize==false) windowProperties+='resizable=no,';
 else windowProperties+='resizable=yes,'; if(w!="") windowProperties+='width='+w+',';
 if(h!="") windowProperties+='height='+h; if(windowProperties!="") { 
  if( windowProperties.charAt(windowProperties.length-1)==',') 
   windowProperties=windowProperties.substring(0,windowProperties.length-1); } 
 window.open(url,name,windowProperties);
}
// -->
</script>
</head>

<title>슬라이딩 배너</title>

<div id="MainLayer" style="position:relative; left:5px; top: 100px;">
  <div id="div_scroll" style="position:absolute;z-index:1; left: 0px; top:0px;">
  <table border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td>
		<!--webbot bot="HTMLMarkup" startspan --><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=909046590&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:909046590:47" alt="点击这里给我发消息" title="点击这里给我发消息"></a><!--webbot bot="HTMLMarkup" endspan --></td>
    </tr>
    <tr> 
      <td>
		&nbsp;</td>
    </tr>
    <tr> 
      <td>
		<a href="#">
		<img border="0" src="<?=$g4['path']?>/images/msn.png" onclick="FP_openNewWindow('580', '500', false, false, false, false, false, false, '', /*href*/'http://settings.messenger.live.com/Conversation/IMMe.aspx?invitee=82f6592f331df427@apps.messenger.live.com&amp;mkt=ko')" alt="실시간 1:1상담 서비스"></a></td>
    </tr>
  </table>

	  </div>
	 </div>
				<script language=javascript>
					<!-- // 슬라이딩 배너

					var isDOM = (document.getElementById ? true : false); 
					var isIE4 = ((document.all && !isDOM) ? true : false);
					var isNS4 = (document.layers ? true : false);

					function getRef(id) {
						if (isDOM) return document.getElementById(id);
						if (isIE4) return document.all[id];
						if (isNS4) return document.layers[id];
					}

					var isNS = navigator.appName == "Netscape";

					function moveRightEdge() {
						var yMenuFrom, yMenuTo, yOffset, timeoutNextCheck;
						if (isNS4) {
							yMenuFrom   = div_scroll.top;
							yMenuTo     = windows.pageYOffset + 1;   // 기준 테이블로 부터 레이어 위쪽 위치
						} else if (isDOM) {
							yMenuFrom   = parseInt (div_scroll.style.top, 10);
							yMenuTo     = (isNS ? window.pageYOffset : document.body.scrollTop) + 100; // 기준 테이블로 부터 레이어 위쪽 위치
						}

						timeoutNextCheck = 500;

						if (yMenuFrom != yMenuTo) {

							yOffset = Math.ceil(Math.abs(yMenuTo - yMenuFrom) / 20);
							if (yMenuTo < yMenuFrom)
								yOffset = -yOffset;
							if (isNS4)
								div_scroll.top += yOffset;
							else if (isDOM)
								div_scroll.style.top = parseInt (div_scroll.style.top, 10) + yOffset;
								timeoutNextCheck = 10;
						}

						setTimeout ("moveRightEdge()", timeoutNextCheck);

					}

					// 슬라이딩 배너 코드
					if (isNS4) {
						var div_scroll = document["div_scroll"];
						div_scroll.top = top.pageYOffset + 50;
						div_scroll.visibility = "visible";
						moveRightEdge();
					} else if (isDOM) {
						var div_scroll = getRef('div_scroll');
						div_scroll.style.top = (isNS ? window.pageYOffset : document.body.scrollTop) + 50;
						div_scroll.style.visibility = "visible";
						moveRightEdge();
					}
					//-->
					</script>