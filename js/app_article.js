$("[data-hide]").click(function(event) {

	event.preventDefault();

	var $formID = $(this).data('hide');

	$($formID).slideToggle(200);

	$(this).toggleClass('sidebar__section-active');
	$(this).toggleClass('sidebar__section-active:after');

	$(this).children('stablinks').toggleClass('stablinks__a-active');

});

$(".stablinks__inner a").click(function(event) {

	$(".stablinks__inner a").removeClass('stablinks__a-active');

	$(this).addClass('stablinks__a-active');
});