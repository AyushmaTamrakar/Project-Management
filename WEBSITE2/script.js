var totalRecord = 0;
var category = getCheckboxValues('category');
$.ajax({
	type: 'POST',
	url : "load_products.php",
	dataType: "json",			
	data:{totalRecord:totalRecord, category:category},
	success: function (data) {
		$("#results").append(data.products);
		totalRecord++;
	}
});	
$(window).scroll(function() {
	scrollHeight = parseInt($(window).scrollTop() + $(window).height());		
	if(scrollHeight == $(document).height()){	
		if(totalRecord <= totalData){
			loading = true;
			$('.loader').show();                
			$.ajax({
				type: 'POST',
				url : "load_products.php",
				dataType: "json",			
				data:{totalRecord:totalRecord, brand:brand, material:material, size:size},
				success: function (data) {
					$("#results").append(data.products);
					$('.loader').hide();
					totalRecord++;
				}
			});
		}            
	}
});