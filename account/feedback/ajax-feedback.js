$('.form-feedback').submit(function(event) {

	event.preventDefault();

	var $form = $(this).attr('class'),
		$input = $("." +$form + ' input'),
		$status = $("." + $form + " .form-feedback__status p"),
		$textarea =$("." +$form + ' textarea');

	if($status.text() != ''){
		$status.fadeOut(200);
	}
	
	var $flag = false;

	$input.next().removeClass('error');

	$($input).each(function(index, el) {
		if($(this).val() == ""){
			$(this).next().addClass('error');
			$flag = true
		}
	});

	if($flag){

		return;

	}
	else{

		$input.next().removeClass('error');

		$.ajax({
			url: '../account/feedback/letter.php',
			type: 'POST',
			data: $(this).serialize(),
		})
		.done(function(answer) {

			if(answer != ''){

				var $result = $.parseJSON(answer);

				if($result['error'] == '' && $result['error_login'] == '' && $result['error_title'] == ''){

					$status.removeClass('error');
					$status.addClass('success');

					$input.val('');
					$input.removeClass('active');
					$textarea.val('')

					$status.html($result['success']);

					$status.fadeIn(200);
				}
				else{

					$status.removeClass('success');
					$status.addClass('error');
					if($result['error_login'] != ''){
						$status.html($result['error_login']).fadeIn(200);
						$("." + $form  + " input[name='login']").next().addClass('error');
						return;
					}

					if($result['error_title'] != ''){
						$status.html($result['error_title']).fadeIn(200);
						$("." + $form + " input[name='title']").next().addClass('error');
						return;
					}

					$status.html($result['error']);

					$status.fadeIn(200);
					
				}

			}


		})

	}

	return false;
	
});


$(".tablinks-feedback").on('click', function(event) {

	event.preventDefault();

	if($(this).hasClass('tablinks-feedback-active')){

	}
	else{
		if($('.form-feedback .form-feedback__status p').hasClass('success')){
			$('.form-feedback .form-feedback__status p').empty();
		}
	}

	$(".tablinks-feedback").removeClass('tablinks-feedback-active');
	$(".tabcontent-feedback").removeClass('tabcontent-feedback-active');

	$(this).addClass('tablinks-feedback-active');
	$("#" + $(this).attr('name')).addClass('tabcontent-feedback-active');
	
});
