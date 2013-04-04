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
		
		
		var filename = document.getElementById('excel_reading').value;
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

function getFileName(path) {
	return path.match(/[-_\w]+[.][\w]+$/i)[0];
}