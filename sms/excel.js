//alert('test');
$(document).ready(function(){
	
		
	$('.excel_reading').change(function() { 
		
		//var filename = document.getElementById('excel_reading').value;
		//var tmx = document.getElementById('excel_reading').selection.createRange().text;
		//alert(tmx);
		
		//jQuery('#excel_reading').replaceWith(jQuery('#excel_reading').clone(true));
		
		//var filename = document.getElementById('excel_reading').value;
		//var filename = document.getElementById('excel_reading').value;
		//var filename = $('#excel_reading').attr("value");
		//var filename = document.getElementById('excel_reading').value;
		
		//document.sms_form.excel_reading.select();
		//alert(document.selection.createRange().text);
		//var filename = document.getElementById('excel_reading').value;
		alert(document.getElementById('filetext').value);
		var filename = document.getElementById('filetext').value;
		
		var valid_extensions = /(\.xls)$/i;
		//var valid_extensions = /(\.jpg|\.jpeg|\.gif)$/i;		
		
		
		
		if(valid_extensions.test(filename))
		{
			
			// extract the filename
			//var file_name = getFileName(this.value);
			//alert(file_name );
			
			$.ajax({
				url : "excel_reader_process.php",
				data : "file_name=" + filename,
				type : "POST",
				beforeSend : function() {
				},
				success : function(msg) {
					$('.data_area').html(msg);
				}
			});
		}
		else
		{
		   alert('Invalid File. please select the excel file (ex : xxx.xls)');
		   return;
		}

	});
		
});

function updateFilename(path) {
	var name = extractFilename(path);
	alert(name);
}

function extractFilename(path) {
	  if (path.substr(0, 12) == "C:\\fakepath\\")
	    return path.substr(12); // modern browser
	  var x;
	  x = path.lastIndexOf('/');
	  if (x >= 0) // Unix-based path
	    return path.substr(x+1);
	  x = path.lastIndexOf('\\');
	  if (x >= 0) // Windows-based path
	    return path.substr(x+1);
	  return path; // just the filename
	}



function getFileName(path) {
	return path.match(/[-_\w]+[.][\w]+$/i)[0];
}