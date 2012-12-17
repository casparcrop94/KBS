<?php

$dbh = connectToDatabase();
$sth = $dbh->query("SELECT ID,username,email FROM clients LIMIT 0,30");
$sth->execute();

$res = $sth->fetchAll(PDO::FETCH_ASSOC);

?>

<form action="" method="post">
    <br/>
    <input type="button" onclick="window.location = '/admin/clients/new'" value="Nieuw"/>
    <br/><br/>
    <table>
	<tr>
	    <th><input type="checkbox" id="checkall" value=""/></th>
	    <th>Gebruikersnaam</th>
	    <th>E-mail adres</th>
	</tr>
	
    <?php
    foreach($res as $row) {
    ?>
	<tr>
	    <td align="center"><input type="checkbox" name="id[]" value="<?php echo($row['ID'])?>"/></td>
	    <td><?php echo($row['username']); ?></td>
	    <td><?php echo($row['email']); ?></td>
	</tr>
    
    <?php
    }
    ?>
    </table>
</form>