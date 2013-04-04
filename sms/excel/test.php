<?php
	error_reporting(E_ALL ^ E_NOTICE);
	require_once 'excel_reader2.php';
	$data = new Spreadsheet_Excel_Reader("phone.xls");

	$excel_array = array();
	
	//Step through each row.
	for($row=1;$row<=$data->rowcount();$row++) {
		//Step through each column
        for($col=1;$col<=2;$col++){
			$excel_array[$row][$col] =$data->value($row,$col);			
		}
	}
?>
<html>
<head>
<style>
table.excel {
	border-style:ridge;
	border-width:1;
	border-collapse:collapse;
	font-family:sans-serif;
	font-size:12px;
}
table.excel thead th, table.excel tbody th {
	background:#CCCCCC;
	border-style:ridge;
	border-width:1;
	text-align: center;
	vertical-align:bottom;
}
table.excel tbody th {
	text-align:center;
	width:20px;
}
table.excel tbody td {
	vertical-align:bottom;
}
table.excel tbody td {
    padding: 0 3px;
	border: 1px solid #EEEEEE;
}
</style>
</head>

<body>
<?php 
	//echo $data->dump(true,true);
	//echo $data->rowcount();
	//echo $data->colcount();
	//echo $data->value(2,1);
	//echo $excel_array[1][1];
	foreach ($excel_array as $key=>$value) {
		//echo "The actual user is $key.<br/>";
		echo "<br/>";
		foreach ($value as $iKey => $iValue) {
			echo "  $iValue";
			//echo $excel_array[$key][$iKey];
		}	
	}
	

?>
</body>
</html>
