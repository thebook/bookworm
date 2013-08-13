<?php

/**
* a email sending class
*/
class email extends alpha
{
	var $email;
	var $name;

	function __construct()
	{
		parent::__construct('email');
		$this->email = 'noreply@recyclabook.com';
		$this->name  = 'Recyclabook';
	}

	public function set_email ($name, $email, $subject, $text)
	{
		require_once ABSPATH .'/wp-includes/class-phpmailer.php';
		require_once ABSPATH .'/wp-includes/class-pop3.php';
		require_once ABSPATH .'/wp-includes/class-smtp.php';

		$mail = new PHPMailer();
		$mail->SetFrom($this->email, $this->name);
		$mail->AddReplyTo($this->email, $this->name);
		$mail->AddAddress($email, $name);
		$mail->Subject = $subject;
		$mail->MsgHTML($text);

		if(!$mail->Send()) {
		  return "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  return "Message sent!";
		}
	}
}
	
?>