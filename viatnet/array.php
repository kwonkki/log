<html>
	<head>
		<title>SMS</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script>
		$(document).ready(function(){
			  var matrix = new Array(4);
			    matrix[0] = new Array(4);
			    matrix[1] = new Array(4);
			    matrix[2] = new Array(4);
			    matrix[3] = new Array(4);
			
			    matrix[0][0] = "A1";
			    matrix[0][1] = "A2";
			    matrix[0][2] = "A3";
			    matrix[0][3] = "A4";
			    
			    matrix[1][0] = "B1";
			    matrix[1][1] = "B2";
			    matrix[1][3] = "B3";
			
			    matrix[2][0] = "C1";
			    matrix[2][1] = "C2";
			    matrix[2][3] = "C3";
			
			
			    matrix[3][0] = "D1";
			    matrix[3][1] = "D2";
			    matrix[3][3] = "D3";
			
			    for (var i = 0; i < matrix.length; i++){
			     for (var j = 0; j < matrix.length; j++){
			        document.write ("Element (" + i + ", " + j + ") is " + matrix[i][j] + " -- ");
			       }
			       document.write("<br>");
			    }
					
		});
			
		</script>
	</head>
	<body>	
	<div>
		<h1>SMS System</h1>
	</div>
	<div>
		<h2>seding data information</h2>
		<table>
		</table>
		</div>		
	</div>
	</body>
</html>