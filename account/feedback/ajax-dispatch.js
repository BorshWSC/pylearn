$('.dispatch i').on('click',function(event) {

	event.preventDefault();

	var $dispatchID = $(this).parent().parent().attr('id'),
		$iconID = $(this).attr('id'),
		$statusID = ("#"+ $dispatchID + " .message__info__status p");

	if($($statusID).text() != ''){
		$($statusID).fadeOut(200);
	}

	if($(this).hasClass('active-icon')){
		$($statusID).fadeIn(200);
		$($statusID).removeClass('success');
		$($statusID).addClass('error');
		$($statusID).html('Вы не можете повторно отправлять сообщение более одного раза');
		return;
	}

	$.ajax({
		url: '../account/feedback/dispatch.php',
		type: 'POST',
		data: {
				id: $dispatchID,
				icon_id: $iconID
			},
	})
	.done(function(answer) {
		
		if(answer != ''){

			var $result = $.parseJSON(answer);

			if($iconID == 'delete'){

				if($result['error'] == ''){

					$("#" + $dispatchID).fadeOut(200, function() {
						$(this).remove();
					});

					if($result['success'] == '0'){
						$("<div class='message__empty'>История отправки пуста</div>").appendTo($(".tabcontent-feedback.tabcontent-feedback-active"));
					}

				}
				else{
					$($statusID).fadeIn(200);
					$($statusID).html($result['error']);
					$($statusID).removeClass('success');
					$($statusID).addClass('error');
				}

			}

			if($iconID == 'repeat'){

				if($result['error'] == ''){
					$("#" + $dispatchID + " #" + $iconID).addClass('active-icon');
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