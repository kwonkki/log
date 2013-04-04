<html>
	<head>
		<title>SMS</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script>
		$(document).ready(function(){
			
		var tb_rows  	= $('.sms_data  tr').length;			
		var tb_cells	= document.getElementById("sms_data").rows[0].cells.length;
		
		var col1 = "";
		var col2 = "";
		var loop = 1;
		
		for(var i=1; i <= tb_rows; i++){
		
			for(var j=1; j <= tb_cells-1; j++ ){
				
					if(j == 1){
						$(".result_phone").html(
						$(".sms_data tr:nth-child("+i+") td:nth-child("+j+")").text()
						);
					}
					if(j==2){
						$(".result_content").html(
						$(".sms_data tr:nth-child("+i+") td:nth-child("+j+")").text()
						);
						
						break;
					}
			}
			alert(loop);
			loop++;
		}
		
			
			/*
			$('.sms_data  tr').length;
			$(".sms_data tr:nth-child(1) td:nth-child(2)").text()
			document.getElementById("sms_data").rows.length
			var rows = document.getElementById("sms_data").rows.length;
			var tabel_dom  = document.getElementById("sms_data");			
			var cells = document.getElementById("sms_data").rows[0].cells.length;
			
			$(".test").html(
				$(".sms_data tr:nth-child(i) td:nth-child(j)").text()
			);
			
		for(var i=1; i <= tb_rows; i++){
			for(var j=1; j <= tb_cells-1; j++ ){
				$(".sms_data tr:nth-child("+i+") td:nth-child("+j+")").text()
			}
		}
					
					
							for(var i=1; i <= tb_rows; i++){
			for(var j=1; j <= tb_cells-1; j++ ){
				$(".test").html(
				$(".sms_data tr:nth-child("+i+") td:nth-child("+j+")").text()
				);
			}
		}
					
					
					alert($(".sms_data tr:nth-child("+i+")"  ).text());				
			
			for(var i=0; i < rows; i++){
				for(j=0; j< cells-1; j++ ){
					
					tabel_dom.rows[i].cells[j].innerHTML = "1";
					
				}
			}
			*/
			/*
			$('td').each(function(index, value){	
				//alert(index + ': ' + value);
				if(index == 1){
				alert($(value).text());
				}
			});
			*/
		});
			
		</script>
	</head>
	<body>	
	<div>
		<h1>SMS System</h1>
	</div>	
	<div>
		<h2>data</h2>
		<div class="test">
			<div class="result_phone"></div>
			<div class="result_content"></div>
		</div>
		
	
		<h2>seding data information</h2>		
		
		<div >
			<table border="1" id="sms_data" class="sms_data">

			<input type="hidden" name="phone" 		class="phone" 	value="" />
			<input type="hidden" name="contents"  	class="contents"	value="" />
			<tr>
				<td class="data_phone">639157929773</td>
				<td class="data_contents">test01</td>
				<td class="result">no result</td>
			</tr>
			<tr>
				<td class="data_phone">xxxxxxx</td>
				<td class="data_contents">xxxxx</td>
				<td class="result">no xxxxx</td>
			</tr>
			<tr>
				<td class="data_phone">asdfasdf</td>
				<td class="data_contents">test01</td>
				<td class="result">no result</td>
			</tr>
			<tr>
				<td class="data_phone">asdfasdf</td>
				<td class="data_contents">test01</td>
				<td class="result">no result</td>
			</tr>
			<tr>
				<td class="data_phone">asdfasdf</td>
				<td class="data_contents">test01</td>
				<td class="result">no result</td>
			</tr>
			<tr>
				<td class="data_phone">asdfasdf</td>
				<td class="data_contents">test01</td>
				<td class="result">no result</td>
			</tr>
			<tr>
				<td class="data_phone">asdfasdf</td>
				<td class="data_contents">test01</td>
				<td class="result">no result</td>
			</tr>
			<tr>
				<td class="data_phone">asdfasdf</td>
				<td class="data_contents">test01</td>
				<td class="result">no result</td>
			</tr>
		</table>
		</div>		
	</div>
	</body>
</html>