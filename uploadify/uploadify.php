<?php
/*
Uploadify v3.1.0
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/sms/uploads'; // Relative to the root

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('xls'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		//echo '';
	} else {
		//echo 'Invalid file type.';
	}
	
	/*	STR : Excel End */
	error_reporting(E_ALL ^ E_NOTICE);
	require_once 'excel_reader2.php';
	$filename =  $targetFile;
	
	
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
		  <COL width=\"25%\" >
		  <COL width=\"30%\" >
		  <COL width=\"15%\">
		  <COL width=\"10%\">
		  <COL width=\"8%\">
		</COLGROUP>
		<tr>
			<th >Phone</th>
			<th >Country</th>
			<th >Result</th>
			<th >Delete</th>
			<th >Seq</th>
		</tr> ";  
	
	$seqnum = 1;
	
	
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
		echo "<td class='result'><img src='../img/icon/big/Wait.gif' onclick=\"alert('Ready to send the Message');\" alt=\"Waiting\"></td>";
		echo "<td class='sms_delete'><img src='../img/icon/big/Cancel.gif' onclick=\"alert('not yet implemented');\" alt=\"Delete\"></td>";
		echo "<td>$seqnum</td>";
		echo "</tr>";
		
		$seqnum++;
		
	}
	echo "</table>";
	
	/*	END : Excel End */
	
	
	// Excel file remove
}
?>