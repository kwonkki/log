<? 

include_once(dirname(__FILE__)."\config.php");  // 설정 파일
include_once(dirname(__FILE__)."\dbconfig.php");  // 설정 파일
include_once(dirname(__FILE__)."\lib\common.lib.php");

$connect_db = sql_connect($mysql_host, $mysql_user, $mysql_password);
$select_db = sql_select_db($mysql_db, $connect_db);
	
	 if (!$select_db)
        die("<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'><script type='text/javascript'> alert('DB 접속 오류'); </script>"); 
 
$file_name = date("Ymd")."-agent-summary-report";
 
//header( "Content-type: application/vnd.ms-excel" ); 
//header( "Content-Disposition: attachment; filename=$file_name.xls" ); 
//header( "Content-Description: PHP4 Generated Data" );
 
//$agents = sql_query("SELECT mb_no, mb_nick, mb_level FROM ".$g4['table_prefix']."member ORDER BY mb_level DESC, mb_nick");
$agents = sql_query("SELECT ".$g4['table_prefix']."member.mb_no, 
					mb_nick, 
					mb_level, 
					SUM( IF( DATE_SUB( DATE_FORMAT( NOW( ) , '%Y-%m-%d' ) , INTERVAL 1 DAY ) = DATE_FORMAT( call_end, '%Y-%m-%d' ) , 1, 0 ) ) AS totalSum
					FROM ".$g4['table_prefix']."member
					LEFT JOIN call_history ON ".$g4['table_prefix']."member.mb_no = call_history.mb_no
					WHERE mb_id <> 'admin'
					GROUP BY ".$g4['table_prefix']."member.mb_no
					ORDER BY mb_level DESC , totalSum DESC , mb_nick");

$agentInfo = sql_fetch_array($agents);
mysql_data_seek($agents, 0);
$rheader = sql_query("SELECT * FROM call_result");

$callingtime = sql_query("SELECT id FROM call_history WHERE MONTH( NOW( )) = MONTH(call_end) AND YEAR( NOW( )) = YEAR(call_end) AND mb_no=".$agentInfo['mb_no']. " GROUP BY date_format(call_end, '%Y-%m-%d')");

$pagecontent='<h2>Agent Daily Report :: '.date("Y-m-d"). '</h2><table class="table" border="1" cellspacing=0 cellpadding=0>
            	<tbody>
            	<tr>
                	<th rowspan=2 bgcolor=#8DB4E2>Name of Staff</th>
					<th rowspan=2 bgcolor=#8DB4E2>Total Call List</th>'; 
					$qryStr=""; 
					$bgcoloreff="#eeeded";
					while($row = sql_fetch_array($rheader)){ 
							$arrResult[] = array( $row['result_id'] => $row['result_name']);
							$qryStr .= "SUM(CASE WHEN result_id=".$row['result_id']." THEN 1 ELSE 0 END) as result_".$row['result_id'].", ";
							$countoutcome = sql_query("SELECT * FROM call_outcome WHERE result_id='".$row['result_id']."'");					
							
                    $pagecontent.='<th';
					if($row['result_id']==1 || $row['result_id']==2 || $row['result_id']==3){
						$pagecontent.=' rowspan=2 bgcolor=#8DB4E2';
					}else{ 
						$pagecontent.=' bgcolor=#FDE9D9 colspan='. mysql_num_rows($countoutcome); 
					}
					$pagecontent.=' >'. $row['result_name'].'</th>';
                    if($row['result_id']==1){
                    	 $pagecontent.='<th rowspan=2 bgcolor=#8DB4E2>Call Duration</th>';
						 $pagecontent.='<th rowspan=2 bgcolor=#8DB4E2>SMS</th>
										<th rowspan=2 bgcolor=#8DB4E2>Email</th>';
                    }
					
					$outcome = sql_query("SELECT * FROM call_outcome WHERE result_id='".$row['result_id']."' AND result_id NOT IN(1,2,3)");					
					while($rowoutcome = sql_fetch_array($outcome)){
						$arrOutcome[] = array( $rowoutcome['outcome_id'] => array($rowoutcome['outcome_name'], $row['result_id']));
						$qryStr .= "SUM(CASE WHEN outcome_id=".$rowoutcome['outcome_id']." THEN 1 ELSE 0 END) as outcome_".$rowoutcome['outcome_id'].", ";
					}					
					} 
                    $pagecontent.='</tr><tr>';
					 //var_dump($arrOutcome);
						foreach($arrResult as $b => $c ){
							$x = array_keys($c);
							if($x[0]!=1 && $x[0]!=2 && $x[0]!=3){
							foreach($arrOutcome as $k => $v ){ 
							  $a = array_keys($v);
							  if($x[0]==$v[$a[0]][1]){					
								$pagecontent.='<th bgcolor=#E6B8B7>'. $v[$a[0]][0].'</th>';						
							  }
							} 
							}
						}
				$pagecontent.='</tr>';
				
                while($agentInfo = sql_fetch_array($agents)){
					$qry = "SELECT $qryStr SEC_TO_TIME(SUM(TIME_TO_SEC(IF(result_id=1,CAST( call_duration AS TIME
					),'00:00:00')))) as rTime, count(id) as totalSum, SUM(sms) as cntSMS, SUM(email) as cntEmail 
					FROM call_history WHERE DATE_SUB(DATE_FORMAT( NOW( ) , '%Y-%m-%d' ) , INTERVAL 1 DAY ) = DATE_FORMAT(call_end, '%Y-%m-%d') AND mb_no=".$agentInfo['mb_no'];	
					//echo $qry."<br><br>";
					$rtable = sql_query($qry);					
					$row = sql_fetch_array($rtable);											
				
				if($bgcoloreff == "#eeeded"){
					$bgcoloreff="#ffffff";
				}else{
					$bgcoloreff="#eeeded";
				}
				if($agentInfo['mb_level']==2 && $prev!=2){
					$pagecontent.='<tr bgcolor="#a6f1f6"><td colspan="50">CSD</td></tr>';
					$prev = $agentInfo['mb_level'];
				}
				if($agentInfo['mb_level']==1 && $prev!=1){
					$pagecontent.='<tr bgcolor="#a6f1f6"><td colspan="50">CRM</td></tr>';
					$prev = $agentInfo['mb_level'];
				}
                $pagecontent.='<tr bgcolor="'.$bgcoloreff.'">                	
                	<td>'. $agentInfo['mb_nick'] . '</td>
					<td>'. (($row['totalSum']=="")? 0: $row['totalSum'])	.'</td>';
                    $totcall =0; 
					foreach($arrResult as $k => $v ){ 						
						$a = array_keys($v);
						$callcount = (($row['result_'.$a[0]]=="")? 0 : $row['result_'.$a[0]]); $totcall += $callcount;
						
						if($a[0]!=1 && $a[0]!=2 && $a[0]!=3){
							foreach($arrOutcome as $b => $c ){ 
							  $x = array_keys($c);
							  if($a[0]==$c[$x[0]][1]){							  
								$pagecontent.='<td>'.(($row['outcome_'.$x[0]]=="")? 0 : $row['outcome_'.$x[0]]) . '</td>';						
							  }
							}
						}else{
							$pagecontent.='<td>'.$callcount.'</td>';
						}
						
						if($a[0]==1){ 
                    	$pagecontent.='<td>'. (($row['rTime']=="")? "00:00:00" : $row['rTime']) .'</td>';
						$pagecontent.='<td>' .(($row['cntSMS']=="")? 0: $row['cntSMS']) .'</td>
										<td>' . (($row['cntEmail']=="")? 0: $row['cntEmail']) . '</td>';
						}
                    }
                    $pagecontent.='</tr>';
                } unset($arrResult); unset($arrOutcome);
                $pagecontent.='</tbody></table>';

echo $pagecontent;
?>