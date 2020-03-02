	<?php
	
	require_once '../phpMailer/PHPMailer.php';
	require_once '../phpMailer/SMTP.php';
	require_once '../phpMailer/Exception.php';


	$data = $_POST;

	if(isset($data['refresh'])){
		post_email();
		$_SESSION['refresh'] = "Письмо было отправлено повторно";
	}

	if(isset($data['refresh_rec'])){
		post_email('rec');
		$_SESSION['refresh'] = "Письмо было отправлено повторно";
	}


	function post_email($text = 'reg'){

		if(isset($_SESSION['email']) && !empty($_SESSION['email'])){  

			$id = $_SESSION['id'];
			$code = $_SESSION['code'];
			require_once 'emailForm.php';

			if($text == 'reg'){

				$subject = "Подтверждение регистрации на сайте PyLearn.";

				$email_text = get_message_reg();

				$email_text_alt = "Для продолжения регистрации перейдите по ссылке указанной ниже. Спасибо, что выбрали нас. http://pylearn.info/validation/confirmForm.php?id=$id&code=$code";

			}elseif ($text == 'rec') {

				$subject = "Сброс пароля на сайте PyLearn";

				$email_text = get_message_rec();

				$email_text_alt = "Вы сделали запрос на восстановление пароля. Для того, чтобы сбросить пароль перейдите по ссылке ниже. http://pylearn.info/validation/resetForm.php?id=$id&code=$code
					Если вы не делали запроса на сброс пароля, то проигнорируйте или удалите это письмо";

			}


			$mail = new PHPMailer\PHPMailer\PHPMailer();
			try{

				$mail->CharSet = 'UTF-8';
				$mail->isSMTP();
				$mail->SMTPAuth   = true;

				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPSecure = 'ssl';
				$mail->Port = 465;
				$mail->Username = 'pylearn.info@gmail.com';
				$mail->Password = 'oStOnFLoPLaT';

				$mail->setFrom('pylearn.info@gmail.com', 'PyLearn.info');		

				$mail->addAddress($_SESSION['email']);

				$mail->isHTML(true);   
				$mail->Subject = $subject;
				$mail->Body = $email_text;
				$mail->AltBody = $email_text_alt;  

				$mail->send();
			}
			catch(Exception $e){
				echo $mail->ErrorInfo;
			}

		}

	}

?>