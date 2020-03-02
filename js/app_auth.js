$(function(){

	$('input[value!=""]').addClass('active');

	$(".input-text input").on("focus", function(){
		$(this).addClass("active");
	})

	$(".input-text input").on("blur", function(){
		if($(this).val() == "" && $(this).is(":password")){
			$(this).removeClass("active");
		}

		if($.trim($(this).val()) == "" && $(this).is(":text")){
			$(this).removeClass("active");
			$(this).val("");
		}

		if($(this).is(":text")){
			$(this).val($.trim($(this).val()));
		}
	})

	setTimeout(function(){
		$('html').css('visibility','visible');
	},200);
			
})
