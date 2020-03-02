$(".modal").each( function(){

	$(this).wrap('<div class="overlay"></div>')

});

$(".message__read p").on('click', function(event){

	event.preventDefault();
	event.stopImmediatePropagation();
	
	var $modal = $(this).data("modal");
	
	$($modal).parents(".overlay").addClass("open");

	setTimeout( function(){
		$($modal).addClass("open");
	}, 200);
	
	$(document).on('click', function(event){
		var target = $(event.target);
		
		if ($(target).hasClass("overlay")){
			$(target).find(".modal").each( function(){
				$(this).removeClass("open");
				$(".modal .modal__info__status p").empty();
				$(".message .message__info__status p").empty();
			});

			setTimeout( function(){
				$(target).removeClass("open");
			}, 200);

		}
		
	});
	
});

$(".modal__icons__close").on('click', function(event){

	event.preventDefault();
	event.stopImmediatePropagation();
	
	var $modal = $(this).data("modal");
	
	$($modal).removeClass("open");
	$(".modal .modal__info__status p").empty();
	$(".message .message__info__status p").empty();
	
	setTimeout( function(){	
		$($modal).parents(".overlay").removeClass("open");
	}, 200);
	
});
