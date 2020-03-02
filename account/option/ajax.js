$('.form').submit(function(event) {

	event.preventDefault();

	var $formID = $(this).attr('id'),
		$inputID = $("#" + $formID + ' input[name *=' + $formID + "]"),
		$header_pID = $('div[data-hide= "#' + $formID + '"] p'),
		$pID = $("#"+ $formID +" .form__info p");
	

	if($formID == 'sex'){
		return;
	}

	if($pID.text() != ''){
		$pID.fadeOut(200);	
	}

	var $flag = false;

	$inputID.next().removeClass('error');

	$($inputID).each(function(index, el) {
		if($(this).val() == ""){
			$(this).next().addClass('error');
			$flag = true
		}
	});

	if($flag){

		return;

	}
	else{

		$inputID.next().removeClass('error');

		$.ajax({
			url: '../account/option/option.php',
			type: 'POST',
			data: $('#' + $formID).serialize(),
		})
		.done(function(answer) {

			if(answer != ''){

				var $result = $.parseJSON(answer);

				if($result['error'] != ""){

					$pID.fadeIn(200);	

					$pID.html($result['error']);
					$pID.removeClass('success');
					$pID.addClass('error');
					$inputID.next().addClass('error');

				}
				else{

					$pID.fadeIn(200);	

					$inputID.val('');
					$inputID.removeClass('active');

					$pID.removeClass('error');
					$pID.addClass('success');

					$pID.html($result["success"]);
					$header_pID.html($result["date"]);
					
				}
			}

		})

	}

	return false;
	
});

$('#sex').submit(function(event) {
	
	event.preventDefault();

	var $formID = $(this).attr('id'),
		$pID = $("#"+ $formID +" .form__info p"),
		$inputType = $("#"+ $formID),
		$header_pID = $('div[data-hide= #sex] p');

	if($pID.text() != ''){
		$pID.fadeOut(200);	
	}	

	if(!$("#radio_male").is(':checked') && !$("#radio_female").is(':checked')){
		return;
	}

	$.ajax({
			url: '../account/option/option.php',
			type: 'POST',
			data: $('#' + $formID).serialize(),
		})
		.done(function(answer) {

			if(answer != ''){

				var $result = $.parseJSON(answer);

				if($result['error'] != ""){

					$pID.fadeIn(200);	

					$pID.html($result['error']);
					$pID.removeClass('success');
					$pID.addClass('error');

					$header_pID.html('');

				}
				else{

					$pID.fadeIn(200);	

					$pID.removeClass('error');
					$pID.addClass('success');
					$pID.html($result["success"]);
					
				}
			}

		})

});

$(".tablinks").click(function(event) {

	event.preventDefault();

	$(".tablinks").removeClass('tablinks-active');
	$(".tabcontent").removeClass('tabcontent-active');

	$(this).addClass('tablinks-active');
	$("#" + $(this).attr('name')).addClass('tabcontent-active');
	
});

$("[data-hide]").click(function(event) {

	event.preventDefault();

	var $formID = $(this).data('hide'),
		$inputID = $($formID + ' input[name *=' + $formID.replace('#','') + "]"),
		$pID = $($formID + " .inner__form .form__info p");

	if($pID.hasClass('success')){
		$pID.empty();
	}

	$($formID).slideToggle(200);
	$(this).toggleClass('rcv-active');
	$(this).toggleClass('rcv-active:after');

	
});

