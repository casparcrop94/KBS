<?php

if(isset($_GET['option'])) {
    $dbh = connectToDatabase();
    
    if($_GET['option'] == "remove") { 
	$IDs = $_POST['id[]'];
	$IDs = explode(",", $IDs);
	
	foreach($IDs as $row) {
	    $sth = $dbh->prepare("DELETE FROM clients WHERE ID=:id");
	    $sth->bindParam(":id", $row);
	    $result = $sth->execute();
	    
	    if(!$result) {
		// todo after merge
	    }
	}
	
	
    } elseif($_GET['option'] == "pwreset") {
	$IDs = $_POST['id[]'];
	
	$IDs = explode(",", $IDs); // Maak een array van alle IDs
	
	foreach($IDs as $row) {
	    $pw = "";
	    
	    $sth = $dbh->prepare("SELECT email FROM clients WHERE ID=:id");
	    $sth->bindParam(":id", $row);
	    $sth->execute();
	    $res = $sth->fetchAll(PDO::FETCH_ASSOC);
	    $email = $res[0];
	    
	    mail($email,"Uw wachtwoord is gereset","Blah");
	    
	    $sth = $dbh->prepare("UPDATE clients SET password=:pw WHERE ID=:id");
	    $sth->bindParam(":pw", $pw);
	    $sth->bindParam(":id", $row);
	    //$sth->execute();
	}
    }
}

if($_GET['option'] == "edit") { 
    $id = $_GET['id'];
}
?>