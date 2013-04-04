<?
include_once("./_common.php");
include_once("$g4[path]/1.php");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
</head>

<body>

<? include "top.php" ?>

<div align="center">
	<table border="0" width="898" id="table1" cellspacing="0" cellpadding="0">
		<tr>
			<td width="60" valign="top">

<? include "menu.php" ?>

					</td>
			<td width="18" valign="top">&nbsp;</td>
			<td valign="top">
					<table border="0" width="100%" id="table82" cellspacing="0" cellpadding="0">
						<tr>
							<td width="1">
							<img border="0" src="images/nhn1_r9_c2.jpg"></td>
							<td background="images/nhn1_r9_c4.jpg">
							<img border="0" src="images/nhn1_r9_c4.jpg"></td>
							<td width="1">
							<img border="0" src="images/nhn1_r9_c26.jpg"></td>
						</tr>
						<tr>
							<td width="1" background="images/nhn1_r29_c2.jpg"></td>
							<td valign="top" align="center">
							<table border="0" width="100%" id="table83" cellspacing="0" cellpadding="0">
								<tr>
									<td>
									<table border="0" width="100%" id="table84" cellspacing="1">
										<tr>
											<td height="20">
											<font color="#2660C9"><b>도메인이란 ?</b></font></td>
										</tr>
										<tr>
											<td><font color="#717171">도메인이란 컴퓨터의 숫자로 표시된 
												인터넷주소(IP주소)를 이용자가 사용하기 쉽도록 문자로 변환하여 표시한 
												것입니다.</font></td>
										</tr>
										<tr>
											<td><font color="#717171">컴퓨터의 주소는 
											숫자로 표현된 주소와 영문자로 표현 된 주소 2가지가 있는데 
											숫자로 표현된 주소는</font></td>
										</tr>
										<tr>
											<td><font color="#717171">도트(.)로 구분 되어 
												4단계로 표시되며 이러한 주소를인터넷 공인 IP(Internet Protocol) 
												주소라고 합니다.</font></td>
										</tr>
										<tr>
											<td><font color="#717171">그러나 인터넷 
											사용자들이 다른 컴퓨터와의 통신을 이렇게 숫자로 표현된 주소를 
											사용하게 되면</font></td>
										</tr>
										<tr>
											<td><font color="#717171">주소를 이해하기 
											힘들고 기억하기가 어렵기 때문에 숫자로 표현된 주소대신에영문자로</font></td>
										</tr>
										<tr>
											<td><font color="#717171">표현된 주소를 사용할 수 있도록 
												하였습니다.</font></td>
										</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td>
						<hr style="border-style: dotted; border-width: 3px" color="#D8D8D8" size="0">
									</td>
								</tr>
								<tr>
									<td>
									<table border="0" width="100%" id="table85" cellspacing="1">
										<tr>
											<td height="20">
											<font color="#2660C9"><b>什么是域名 ?</b></font></td>
										</tr>
										<tr>
											<td height="20">
											<font color="#717171">域名（Domain 
											Name），是由一串用点分隔的名字组成的Internet上某一台计算机或计算机组的名称，</font></td>
										</tr>
										<tr>
											<td height="20">
											<font color="#717171">
											用于在数据传输时标识计算机的电子方位（有时也指地理位置），</font></td>
										</tr>
										<tr>
											<td height="20">
											<font color="#717171">
											目前域名已经成为互联网的品牌、网上商标保护必备的产品之一。</font></td>
										</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
						<hr style="border-style: dotted; border-width: 3px" color="#D8D8D8" size="0">
									</td>
								</tr>
								<tr>
									<td>
			                        <table border="0" width="100%" id="table69" cellspacing="0" cellpadding="0">
									<form name="form1" method="POST" action="whois.php" target="_blank">
									<input type="hidden" name="action" value="whois">
										<tr>
											<td>
											<table border="0" id="table70" cellspacing="1">
												<tr>
													<td>
													<b><font size="6">www.</font></b></td>
													<td>
													<input style="border:5px solid #535564; padding:5px; IME-MODE: active; HEIGHT: 35; FONT-SIZE: 15px; FONT-WEIGHT: bold; width:335" size="35" name="ym1" jQuery1283634221250="43"></td>
													<td>



                          <input type="submit" value="<?php echo $lang['04'];?>" name="B1" class="nhn1" style="font-weight: bold"></td>
												</tr>
											</table>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
											</td>
										</tr>
										<tr>
											<td>
											<table border="0" width="100%" id="table71" cellspacing="1" bgcolor="#E0E0E0">
												<tr>
													<td bgcolor="#FCFCFC">
													<table border="0" id="table72" cellpadding="2">
														<tr>
															<td>

                          <font color="#808000">

                          <input type="checkbox" name="ym[]" value="com" checked style="font-weight: 700"><b> 
															.com</b></font></td>
															<td>

                          <font color="#808000">

                          <input type="checkbox" name="ym[]" value="net" checked style="font-weight: 700"  ><b> 
							.net</b></font></td>
															<td>

                          <font color="#808000">

                          <input type="checkbox" name="ym[]" value="org" style="font-weight: 700" ><b> .org</b></font></td>
															<td>



                          <font color="#808000">



                          <input type="checkbox" name="ym[]" value="com.cn" style="font-weight: 700"><b> .com.cn</b></font></td>
															<td>

                          <font color="#808000">

                          <input type="checkbox" name="ym[]" value="net.cn" style="font-weight: 700" ><b>.net.cn</b></font></td>
															<td>



                          <font color="#666666">



                          <input type="checkbox" name="ym[]1" value="org.cn" style="font-weight: 700" ><b>.org.cn</b></font></td>
															<td>



                          <font color="#666666">



                          <input type="checkbox" name="ym[]2" value="gov.cn" style="font-weight: 700" ><b> .gov.cn</b></font></td>
															<td>

                          <font color="#666666">

                          <input type="checkbox" name="ym[]3" value="info" style="font-weight: 700" ><b> 
							.info</b></font></td>
															<td>

                          <font color="#666666">

                          <input type="checkbox" name="ym[]4" value="biz" value="yes" style="font-weight: 700" ><b>



                          .biz</b></font></td>
														</tr>
														<tr>
															<td>



                          <font color="#666666">



                          <input type="checkbox" name="ym[]5" value="com.tw" style="font-weight: 700" ><b> .com.tw</b></font></td>
															<td>



                          <font color="#666666">

                          <input type="checkbox" name="ym[]6" value="net.tw" style="font-weight: 700" ><b> .net.tw</b></font></td>
															<td>

                          <font color="#666666">

                          <input type="checkbox" name="ym[]7" value="gov.tw" value="yes" style="font-weight: 700" ><b> 
							.gov.tw</b></font></td>
															<td>

                          

                          <font color="#666666">



                          <input type="checkbox" name="ym[]8" value="tv" style="font-weight: 700" ><b> .tv</b></font></td>
															<td>



                          <font color="#666666">

                          <input type="checkbox" name="ym[]9" value="cc" style="font-weight: 700" ><b> .cc</b></font></td>
															<td>



                          <font color="#666666">

                          <input type="checkbox" name="ym[]10" value="sh" value="yes" style="font-weight: 700" ><b> 
							.sh</b></font></td>
															<td>



                          &nbsp;</td>
															<td>



                          &nbsp;</td>
															<td>



                          &nbsp;</td>
														</tr>
														</table>
													</td>
												</tr>
											</table>
											</td>
										</tr>
									</form>
									</table></td>
								</tr>
								<tr>
									<td>
						<hr style="border-style: dotted; border-width: 3px" color="#D8D8D8" size="0"></td>
								</tr>
								<tr>
									<td>
											<table border="0" width="100%" id="table107" cellspacing="1" bgcolor="#E0E0E0">
												<tr>
													<td bgcolor="#FFFFFF">
													<table border="0" width="100%" id="table109" cellspacing="0" cellpadding="0">
														<tr>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<font color="#8C8C8C">
															<b>NAME</b></font></td>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<img border="0" src="images/zz.jpg"></td>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<font color="#8C8C8C">
															<b>NS</b></font></td>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<img border="0" src="images/zz.jpg"></td>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<font color="#8C8C8C">
															<b>A</b></font></td>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<img border="0" src="images/zz.jpg"></td>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<font color="#8C8C8C">
															<b>CNAME</b></font></td>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<img border="0" src="images/zz.jpg"></td>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<font color="#8C8C8C">
															<b>MX</b></font></td>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<img border="0" src="images/zz.jpg"></td>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<font color="#8C8C8C">
															<b>TXT</b></font></td>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<img border="0" src="images/zz.jpg"></td>
															<td background="images/ie_soft_01_r64_c16.jpg" height="28" align="center">
															<font color="#8C8C8C">
															<b><?php echo $lang['a24'];?></b></font></td>
														</tr>
														<tr>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#333333">.COM</font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">
															130.00<?php echo $lang['a18'];?></font></td>
														</tr>
														<tr>
															<td height="28" align="center">
															<font color="#333333">.NET</font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">
															130.00<?php echo $lang['a18'];?></font></td>
														</tr>
														<tr>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#333333">.ORG</font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">
															130.00<?php echo $lang['a18'];?></font></td>
														</tr>
														<tr>
															<td height="28" align="center">
															<font color="#333333">.CN</font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">
															130.00<?php echo $lang['a18'];?></font></td>
														</tr>
														<tr>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#333333">.BIZ</font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">
															550.00<?php echo $lang['a18'];?></font></td>
														</tr>
														<tr>
															<td height="28" align="center">
															<font color="#333333">.CC</font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">
															700.00<?php echo $lang['a18'];?></font></td>
														</tr>
														<tr>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#333333">.TV</font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">
															990.00<?php echo $lang['a18'];?></font></td>
														</tr>
														<tr>
															<td height="28" align="center">
															<font color="#333333">.NAME</font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">
															160.00<?php echo $lang['a18'];?></font></td>
														</tr>
														<tr>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#333333">.INFO</font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">
															500.00<?php echo $lang['a18'];?></font></td>
														</tr>
														<tr>
															<td height="28" align="center">
															<font color="#333333">.MOBI</font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center">&nbsp;</td>
															<td height="28" align="center">
															<font color="#717171">
															260.00<?php echo $lang['a18'];?></font></td>
														</tr>
														<tr>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#333333">.CO.KR</font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">20<?php echo $lang['a25'];?></font></td>
															<td height="28" align="center" bgcolor="#F9F9F9">&nbsp;</td>
															<td height="28" align="center" bgcolor="#F9F9F9">
															<font color="#717171">
															200.00<?php echo $lang['a18'];?></font></td>
														</tr>
													</table>
													</td>
												</tr>
											</table>
											</td>
								</tr>
							</table>
							</td>
							<td width="1" background="images/nhn1_r29_c26.jpg"></td>
						</tr>
						<tr>
							<td width="1">
							<img border="0" src="images/nhn1_r30_c2.jpg"></td>
							<td background="images/nhn1_r30_c4.jpg">
							<img border="0" src="images/nhn1_r30_c4.jpg"></td>
							<td width="1">
							<img border="0" src="images/nhn1_r30_c26.jpg"></td>
						</tr>
					</table>
					</td>
		</tr>
	</table>
</div>

<? include "tail.php" ?>

</body>

</html>