//alert('test');
$(document).ready(function(){
	
	$('.excel_form').submit(function(e){
		
		
		var filename = document.getElementById('excel_reading').value;
		var valid_extensions = /(\.xls)$/i;
		//var valid_extensions = /(\.jpg|\.jpeg|\.gif)$/i;		
		//var file_name = document.getElementById("excel_reading").files[0].fileName;
		
		
		if(valid_extensions.test(filename))
		{
			
			// extract the filename
			//var file_name = getFileName(this.value);
			//alert(file_name );
			alert($(this).serialize());
			
			$.ajax({
				url : "excel_reader_process.php",
				data : $(this).serialize(),
				type : "POST",
				beforeSend : function() {
				},
				success : function(msg) {
					alert(msg);
				}
			});
		}
		else
		{
		   alert('Invalid File. please select the excel file (ex : xxx.xls)');
		   return;
		}
		e.preventDefault();
	});
	
	
	
	$('.excel_reading').change(function() { 
		$('.excel_form').trigger("submit");

	});
		
});

function getFileName(path) {
	return path.match(/[-_\w]+[.][\w]+$/i)[0];
}