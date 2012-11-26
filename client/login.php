<?php
session_start();
include_once(DOCROOT . 'inc/mysql.inc.php'); // bevat functie om verbinding te maken met een database

if(isset($_SESSION['client']) && $_SESSION['client'] == true)
{
	header('location:/client/home');
}

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

            $sth = $dbh->prepare("SELECT * FROM clients WHERE username=:user AND password=:pass");
            $sth->bindParam(":user", $user);
            $sth->bindParam(":pass", $pass);
            $sth->execute();
            if($sth->rowCount())
            {
            	$_SESSION['client'] = true;
            	
            	header('location:/client/home');
            }
            else {
            	echo 'Combinatie gebruikersnaam/wachtwoord onjuist.';
            }
            //print_r($sth->fetchAll(PDO::FETCH_ASSOC));
	}
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Juridische hulp</title>
		<link rel="stylesheet" type="text/css" href="/styles/client.css" />
	</head>
	<body>
		<div id="login-form">
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
				<table>
					<tr>
						<td>Gebruikersnaam:</td>
					</tr>
					<tr>
						<td><input type="text" name="login" value="test"/></td>
					</tr>
					<tr>
						<td>Wachtwoord:</td>
					</tr>
					<tr>
						<td><input type="password" name="password" value="test"/></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="Inloggen"/></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>