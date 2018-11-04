$(".addCat").click(function() {
	$("#modal").modal('show')
		.find('#modalContent')
		.load($(this).attr('value'));
});


$('li:has(ul)').attr('class', 'expand');
$('li.expand > span').html("-");


$("ul > li > span").click(function() {
	console.log($(this)[0].innerHTML);
	if ($(this)[0].innerHTML == ("+")){
		$(this).html("-");
		$(this).parent().closest('li').attr('class', 'expand');
	}else {
		$(this).parent().closest('li').attr('class', 'collapsed');
		$(this).html("+");
	}
});