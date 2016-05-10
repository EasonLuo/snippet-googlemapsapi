<?php
/**
 * Email Builder
 * @author eason.luo
 *
 */
class Email {
	private $elements;
	private $mail;
	function __construct() {
		// require_once '/phpmailer/class.phpmailer.php';
		require '../phpmailer/PHPMailerAutoload.php';
		$this->elements = array ();
		$this->mail = new PHPMailer;
		$this->mail->isSMTP();
		$this->mail->Host       = 'xxx.xxx.com';
		$this->mail->Port       = 999;
		$this->mail->SMTPSecure = "ssl";
		$this->mail->SMTPAuth   = true;
		$this->mail->Username   = 'xxx@xxx.com.au';
		$this->mail->Password   = 'xxxx';
	}
	function to($addr,$name="") {
		return $this->set ( 'to', $addr )->set('toname', $name);
	}
	function from($addr,$name) {
		return $this->set ( 'from', $addr )->set('fromname', $name);
	}
	function subject($subject = null) {
		return $this->set ( 'subject', $subject );
	}
	function message($msg = null) {
		return $this->set ( 'message', $msg );
	}
	function set($name, $value) {
		if (is_string ( $value )) {
			$this->elements [$name] = $value;
		} else {
			$ref = new ReflectionFunction($value);
			$this->elements [$name] = $ref->invokeArgs(array());
		}
		return $this;
	}
	function error(){
		return $this->mail->ErrorInfo;
	} 
	function send() {
		$emailto  = $this->elements ['to'];
		$toname   = $this->elements['toname'];
		$from     = $this->elements['from'];
		$formname = $this->elements['fromname'];
		$subject  = $this->elements ['subject'];
		$message  = $this->elements ['message'];

		$this->mail->From     = $from;
		$this->mail->FromName = $formname;
		$this->mail->addAddress($emailto, $toname);
		$this->mail->addReplyTo($from, $fromname);
		$this->mail->Subject = $subject;
		$this->mail->Body    = $message;
		$this->mail->isHTML(true);
		return $this->mail->send();
	}
}
