$(".addCat").click(function() {
	$('#modalContent')
		.load($(this).attr('label'));
});