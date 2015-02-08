function callPage(page,targetDiv){
	 $.ajax({
		url:page,
		cache: false,
		beforeSend: function() { 
				
		},
		success: function(data) {
			if(data.success == false)
			{  	
				alert ("Please try again");
			} 
			else 
			{	
				$(targetDiv).html(data);
			}
		},
		error: function(xhr, textStatus, thrownError) {
			alert("Something went to wrong.Please try again later.");
		}
	});
	return false;
}
