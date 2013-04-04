<?php
	error_reporting(E_ALL ^ E_NOTICE);
	require_once 'excel_reader2.php';
	$filename =  $_POST['file_name'];
	
	
	// 엑셀 파일이 있는지 체크..
	if(!$filename){
		echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
		echo "<script type='text/javascript'>alert('no excel');";
	    echo "history.go(-1);";
	    echo "</script>";
	}
	
	$data = new Spreadsheet_Excel_Reader($filename);

	$excel_array = array();
	
	//Step through each row.
	for($row=1;$row<=$data->rowcount();$row++) {
		//Step through each column
        for($col=1;$col<=1;$col++){
			$excel_array[$row][$col] =$data->value($row,$col);			
		}
	}
	//echo $data->dump(true,true);
	//echo $data->rowcount();
	//echo $data->colcount();
	//echo $data->value(2,1);
	//echo $excel_array[1][1];
	echo "<table border='1' class='sms_data' id='sms_data'>";
	echo "
		<COLGROUP align=\"center\">
		  <COL width=\"30%\" >
		  <COL width=\"30%\" >
		  <COL width=\"30%\">
		  <COL width=\"8%\">
		</COLGROUP>
		<tr>
			<th >Phone</th>
			<th >Country</th>
			<th >Result</th>
			<th >Delete</th>
		</tr> ";  
	
	foreach ($excel_array as $key=>$value) {
		//echo "The actual user is $key.<br/>";		
		echo "<tr>";	
		foreach ($value as $iKey => $iValue) {
			
			//substr($iValue,0, 2);
			
			echo "<td>$iValue</td>";
			
			$strValue =  substr($iValue,0, 2);
			switch($strValue){
				case 86 :
				echo "<td>china</td>";
				break;
				
				case  66:
				echo "<td>thailand</td>";
				break;
				
				case  84:
				echo "<td>vietnam</td>";
				break;
				
				case  63:
				echo "<td>philippines</td>";
				break;
				
				case  62:
				echo "<td>indonesia</td>";
				break;
				
				case  60:
					echo "<td>Malaysia</td>";
				break;
				
				default :
				echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
				echo "<script type='text/javascript'>alert('Check your excel format');";
			    echo "</script>";
			    echo "<script type='text/javascript'> location.replace('/sms/sms/excel_sms.php'); </script>";
			    exit;
				
			}
				
			
			//echo "  $iValue";
			//echo $excel_array[$key][$iKey];
		}	
		echo "<td class='result'><img src='../img/icon/big/Wait.gif' alt=\"Waiting\"></td>";
		echo "<td class='sms_delete'><img src='../img/icon/big/Cancel.gif' alt=\"Delete\"></td>";
		echo "</tr>";
	}
	echo "</table>";
?>
