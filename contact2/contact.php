<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <form action="contact.php" method="post">
            Naam
            <br>
            <input type="text" name="naam">
            <br>
            E-mailadres
            <br>
            <input type="text" name="email">
            <br>
            Onderwerp
            <br>
            <input type="text" name="onderwerp">
            <br>
            Vraag
            <br>
            <textarea name="vraag">
            </textarea>
            <br>
            <input type="submit" name="verstuur" value="Versturen">
</form>
    </body>
</html>

<?php
$naam = $_POST['naam'];
$email = $_POST['email'];
$onderwerp = $_POST['onderwerp'];
$vraag = $_POST['vraag'];


//ini_set("SMTP", "test.smtp.org"); //de SMTP-server die gebruikt moet worden
ini_set("SMTP","smtp.gmail.com");   //de SNTP-server's adres
ini_set("smtp_port","587");         //de SMTP-server's port
ini_set("sendmail_from",$email);    //Hier de e-mail van het e-mail adres waarvan de mails gestuurd moeten worden


$to = 'maartendeboy@hotmail.com';   //Eigenaar's email, dus oom van Caspar (nu voor testen nog mijn e-mail
$subject = 'Vraag van bezoeker '.$naam;

//Hi
$message = 'Van: '.$naam."\n";
$message .= 'E-mail: '.$email."\n";
$message .= 'Onderwerp: '.$onderwerp;
$message .= 'Vraag: <br>'.$vraag;


//$headers = 'From: '.$email."\r\n";
$headers = 'From: maartendeboy@hotmail.com\r\n';
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
		alert('Bericht versturen mislukt. Probeer opnieuw of stuur een mail naar maartendeboy@hotmail.com');
		window.location = 'contact.html';
	</script>
<?php
}
?>

        <!DOCTYPE html>

