function send(id){
	$.ajax({
		type: "POST",
		url: "?page=bac&func=addAjax&id=" + id,
		success: function (date) {
			$('#bac').html(date);
		}
	});
}


