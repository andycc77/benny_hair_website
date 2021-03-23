<?php
$memNick= $_POST['memNick'];
$memAddtime = $_POST['memAddtime'];
$memBonus = $_POST['memBonus'];
$memEmail = $_POST['memEmail'];
$url = $_POST['url'];
	$emlTitle = ""; $emlMain = "";
	$Email = $memEmail; $Name = $memNick;
	require_once('./mailer/class.phpmailer.php');
	require_once("$url");
	require_once('../upload/webset/webset_sql.php');
	$mail  = new PHPMailer();
	if($sysemail_issmtp){ $mail->IsSMTP(); $mail->SMTPAuth = true; }
	$mail->SMTPSecure = $sysemail_ssl;
	$mail->Host       = $sysemail_host;
	$mail->Port       = $sysemail_port;
	$mail->Username   = $sysemail_id;
	$mail->Password   = $sysemail_pw;
	$mail->AddReplyTo($sysemail_email, $sysemail_name);
	$mail->SetFrom($sysemail_email, $sysemail_name);
	$mail->Subject = $emlTitle;
	$mail->AltBody    = "";
	$mail->MsgHTML($emlMain);
	$mail->AddAddress($memEmail , $Name);
	if(!$mail->Send()) {
	} else {
	}

?>