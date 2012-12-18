<!--
Auteur: Jelle Kapitein
	s1058427
	ICTM1e
-->

<?php

$dbh = connectToDatabase();

if(isset($_POST['search']) && !empty($_POST['search'])) {
  $search = "%".$_POST['search']."%";
  $sth = $dbh->prepare("SELECT ID,username,name,email FROM clients WHERE username LIKE :search OR email LIKE :search");
  $sth->bindParam(":search", $search);
  $sth->execute(array(":search" => $_POST['search']));
  
  $res = $sth->fetchAll(PDO::FETCH_ASSOC);
  
} else {
    $sth = $dbh->query("SELECT ID,username,name,email FROM clients LIMIT 0,30");
    $sth->execute();

    $res = $sth->fetchAll(PDO::FETCH_ASSOC);
}

?>

<form action="" method="post">
    <br/>
    <input type="button" onclick="window.location = '/admin/clients/new'" value="Nieuw"/>
    <input type="button" onclick="window.location = '/admin/clients/remove'" value="Verwijderen"/>
    <input type="button" onclick="window.location = '/admin/clients/pwreset'" value="Wachtwoord resetten"/>
    <br/><br/>
    <input type="text" placeholder="Zoeken..." name="search"/>
    <br/><br/>
    <table>
	<tr>
	    <th align="center"><input type="checkbox" id="checkall" value=""/></th>
	    <th>Gebruikersnaam</th>
	    <th>Volledige naam</th>
	    <th>E-mail adres</th>
	</tr>
	
    <?php
    foreach($res as $row) {
    ?>
	<tr>
	    <td align="center"><input type="checkbox" name="id[]" value="<?php echo($row['ID'])?>"/></td>
	    <td><?php echo("<a href=/admin/clients/edit/".$row['ID'].">".$row['username'])."</a>" ?></td>
	    <td><?php echo($row['name']); ?></td>
	    <td><?php echo($row['email']); ?></td>
	</tr>
    
    <?php
    }
    ?>
    </table>
</form>