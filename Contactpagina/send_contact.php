<!DOCTYPE html>
<?php

// Contact subject
$subject ="$subject";

// Details
$message="$detail";


// Mail van zender
$mail_from="$customer_mail";

// Van
$header="from: $name <$mail_from>";


// Voer je e-mailadres in
$to ='maartendeboy@hotmail.com';

$send_contact=mail($to,$subject,$message,$header);


// Check, if message sent to your email
// display message "We've recived your information"
if($send_contact){
echo "We've recived your contact information";
}
else {
echo "ERROR";
}
?>