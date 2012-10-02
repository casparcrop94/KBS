<?php

include_once('/inc/mysql_connect.php'); // bevat functie om verbinding te maken met een database

if(!isset($_POST['login'])) {               // Controleren of beide velden (naam + wachtwoord zijn ingevuld)
    print("Geen gebruikersnaam ingevuld!");
} else if(!isset($_POST['password'])) {
    print("Geen wachtwoord ingevuld!");
}

$db = connectToDatabase("root", "usbw", "localhost", "3307", "kbs_test"); // Database verbinding wordt aangemaakt en vastgelegd in $db
        
$user = $db->escape_string($_POST['login']);   // De gebruikersnaam wordt tegen SQL-injectie beveiligd
$pass = $db->escape_string($_POST['password']);// Het wachtwoord wordt tegen SQL-injectie beveiligd

$res = $db->query("SELECT * FROM users WHERE username='".$user."' AND password='".$pass."' "); // Kijkt in de database of er een gebruiker bestaat met het opgegeven naam + wachtwoord

print($db->error);

print_r($res);
?>
