<!--
Auteur: Maarten Engels
-->
<?php
//Het zelfafhandelende gedeelte, waarbij het formulier wordt getoond als nog niet op de verstuur-knop is gedrukt
if (isset($_POST["verstuur"])){
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $onderwerp = $_POST['onderwerp'];
    $vraag = $_POST['vraag'];

    $to = EMAIL_KLANT;   //Eigenaar's email, dus gerelateerde van Caspar (nu voor testen nog mijn e-mail
    $subject = 'Vraag van bezoeker '.$naam;

    //Hier de info over de mail en de vraag
    $message = 'Van: '.$naam."\n";
    $message .= 'E-mail: '.$email."\n";
    $message .= 'Onderwerp: '.$onderwerp;
    $message .= 'Vraag: <br>'.$vraag;

    //$headers = 'From: '.$email."\r\n";
    $headers = 'From: ' .EMAIL_KLANT. '\r\n';
    $headers .= 'Reply-To: '.$email."\r\n";

    $mail_status = mail($to, $subject, $message, $headers);
    if (!$mail_status) { 
      echo '<div class="message_error"><p>Helaas, het versturen van de mail is mislukt</p></div>';   
    }
    else {
     echo '<div class="message_success"><p>Geslaagd, de mail is verstuurd</p></div>';       
}
}
?>
        
        <form method="post">
            <table>
                <tr>
                    <td>Naam</td>
                    <td><input type="text" name="naam"></td>
                </tr>
                <tr>
                    <td>E-mailadres</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td>Onderwerp</td>
                    <td><input type="text" name="onderwerp"></td>
                </tr>
                <tr>
                    <td>Vraag</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2"><textarea name="vraag"></textarea></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                    <td align="right" ><input type="submit" name="verstuur" value="Versturen"></td>
                </tr>
            </table>
        </form>
