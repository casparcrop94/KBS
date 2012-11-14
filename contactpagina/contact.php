<?php
$naam = $_POST['naam'];
$email = $_POST['email'];
$vraag = $_POST['vraag'];

$to = 'maartendeboy@hotmail.com';
$subject = 'Vraag van bezoeker '.$naam;

$message = 'From: '.$naam."\n";
$message .= 'E-mail: '.$email."\n";
$message .= 'Message: '.$vraag;

$headers = 'From: '.$email."\r\n";
$headers .= 'Reply-To: '.$email."\r\n";

$mail_status = mail($to, $subject, $message, $headers);

if ($mail_status) { ?>
	<script language="javascript" type="text/javascript">
		alert('Thank you for the message. We will contact you shortly.');
		window.location = 'contact.html';
	</script>
<?php
}
else { ?>
	<script language="javascript" type="text/javascript">
		alert('Message failed. Please, send an email to gordon@template-help.com');
		window.location = 'contact.html';
	</script>
<?php
}
?>