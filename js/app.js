$(function(){

	var header = $(".header"),
		intro = $(".intro").innerHeight(),
		scroll = $(window).scrollTop();

		checkScroll(scroll)

	$(".intro").css("margin-top",header.innerHeight());

	$(window).on("scroll",function() {

		scroll = $(this).scrollTop();
		
		checkScroll(scroll);

	})

	$(window).resize(function(){
		$(".intro").css("margin-top",header.innerHeight());
	})


	function checkScroll(scroll) {
		if(scroll >= (intro + header.innerHeight() - 10) ){
			header.addClass("fixed");
		} else{
			header.removeClass("fixed");
		}
	}


	$("[data-scroll]").on("click",function(event) {
		event.preventDefault();

		var id = $(this).data('scroll'),
			block = $(id).offset().top;
		$("html, body").animate({
			scrollTop: (block)
		}, 400);

	})

	$("[data-slick]").slick({
		dots: true,
		autoplay: true,
		autoplaySpeed: 3000,
		pauseOnFocus: true,
		pauseOnHover: true,
		fade: true
	});

});