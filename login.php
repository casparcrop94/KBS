<?php
include_once('/inc/config.inc.php');
include_once(DOCROOT . 'inc/mysql.inc.php'); // bevat functie om verbinding te maken met een database

if(isset($_POST['submit']))
{
	if(!isset($_POST['login'])) {               // Controleren of beide velden (naam + wachtwoord zijn ingevuld)
	    print("Geen gebruikersnaam ingevuld!");
	} else if(!isset($_POST['password'])) {
	    print("Geen wachtwoord ingevuld!");
	}
        else {
            $dbh = connectToDatabase(); // Database verbinding wordt aangemaakt en vastgelegd in $dbh

            $user = $_POST['login'];   
            $pass = $_POST['password'];

            $sth = $dbh->prepare("SELECT * FROM users WHERE username=:user AND password=:pass");
            $sth->bindParam(":user", $user);
            $sth->bindParam(":pass", $pass);
            $sth->execute();
            
            print_r($sth->fetchAll(PDO::FETCH_ASSOC));
	}
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="text" name="login" value="test"/><br/>
    <input type="password" name="password" value="test"/><br/>
    <input type="submit" name="submit" value="Sturen"/><br/>
</form>