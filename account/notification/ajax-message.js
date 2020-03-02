$('.message i').on('click',function(event) {

	event.preventDefault();

	var $messageID = $(this).parent().parent().attr('id'),
		$iconID = $(this).attr('id'),
		$statusID = ("#"+ $messageID + " .message__info__status p");

	if($($statusID).text() != ''){
		$($statusID).fadeOut(200);
	}

	$.ajax({
		url: '../account/notification/new_message.php',
		type: 'POST',
		data: {
				id: $messageID,
				icon_id: $iconID
			},
	})
	.done(function(answer) {
		
		if(answer != ''){

			var $result = $.parseJSON(answer);

			if($iconID == 'delete'){

				if($result['error'] == ''){

					$("#" + $messageID).fadeOut(200, function() {
						$(this).remove();
					});

					if($result['success'] == '0'){
						$("<div class='message__empty'>Пусто</div>").appendTo($(".tabcontent-message.tabcontent-message-active"));
					}

				}
				else{
					$($statusID).fadeIn(200);
					$($statusID).html($result['error']);
					$($statusID).removeClass('success');
					$($statusID).addClass('error');
				}

			}

			if($iconID == 'chosen'){

				if($result['error'] == ''){
					$("#" + $messageID + " #" + $iconID).toggleClass('active-icon');
					$("#modal" + $messageID + " #" + $iconID).toggleClass('active-icon');
					$($statusID).fadeIn(200);
					$($statusID).html($result['success']);
					$($statusID).addClass('success');
					$($statusID).removeClass('error');
				}
				else{
					$($statusID).fadeIn(200);
					$($statusID).html($result['error']);
					$($statusID).removeClass('success');
					$($statusID).addClass('error');
				}

			}

			if($iconID == 'read'){

				if($result['error'] == ''){
					$("#" + $messageID + " #" + $iconID).addClass('active-icon');
					$($statusID).fadeIn(200);
					$($statusID).html($result['success']);
					$($statusID).addClass('success');
					$($statusID).removeClass('error');
				}
				else{
					$($statusID).fadeIn(200);
					$($statusID).html($result['error']);
					$($statusID).removeClass('success');
					$($statusID).addClass('error');
				}
			}

		}

	})

});

$('.message .message__read p').on('click', function(event) {

	event.preventDefault();

	var $modalID = $(this).data('modal'),
		$iconID = 'read',
		$messageID = $modalID.replace('#modal','');

	$.ajax({
		url: '../account/notification/new_message.php',
		type: 'POST',
		data: {
			id: $messageID,
			icon_id: $iconID
		},
	})
	.done(function(answer) {

		if(answer != ''){

			$('#' + $messageID + " #read").addClass('active-icon');

		}else{
			$($modalID + " .modal__info__status p").html('Сообщение не было добавлено в прочитанные');
			$($modalID + " .modal__info__status p").addClass('error');
		}
	})
	
});

$('.modal i').on('click',function(event) {

	event.preventDefault();
	event.stopImmediatePropagation();

	var $modalID = $(this).parent().parent().parent().parent().attr('id'),
		$iconID = $(this).attr('id'),
		$statusID = ("#"+ $modalID + " .modal__info__status p"),
		$messageID = $modalID.replace('modal','');

	if($($statusID).text() != ''){
		$($statusID).fadeOut(200);
	}

	var $modal = $(this).data("modal");

	$.ajax({
		url: '../account/notification/new_message.php',
		type: 'POST',
		data: {
				id: $messageID,
				icon_id: $iconID
			},
	})
	.done(function(answer) {
		
		if(answer != ''){

			var $result = $.parseJSON(answer);

			if($iconID == 'delete'){

				if($result['error'] == ''){

					$("#" + $messageID).remove();
	
					$($modal).removeClass("open");

					setTimeout( function(){	
						$($modal).parents(".overlay").removeClass("open");
					}, 200);

					$(".modal .modal__info__status p").empty();

					if($result['success'] == '0'){
						$("<div class='message__empty'>Пусто</div>").appendTo($(".tabcontent-message.tabcontent-message-active"));
					}

				}
				else{
					$($statusID).fadeIn(200);
					$($statusID).html($result['error']);
					$($statusID).removeClass('success');
					$($statusID).addClass('error');
				}

			}

			if($iconID == 'chosen'){

				if($result['error'] == ''){

					$("#" + $messageID + " #" + $iconID).toggleClass('active-icon');
					$("#" + $modalID + " #" + $iconID).toggleClass('active-icon');
					$($statusID).fadeIn(200);
					$($statusID).html($result['success']);
					$($statusID).removeClass('error');
					$($statusID).addClass('success');

				}
				else{
					$($statusID).fadeIn(200);
					$($statusID).html($result['error']);
					$($statusID).removeClass('success');
					$($statusID).addClass('error');
				}

			}

		}

	})

});


$(".tablinks-message").on('click', function(event) {

	event.preventDefault();

	$(".tablinks-message").removeClass('tablinks-message-active');
	$(".tabcontent-message").removeClass('tabcontent-message-active');

	$(this).addClass('tablinks-message-active');
	$("#" + $(this).attr('name')).addClass('tabcontent-message-active');
	
});


