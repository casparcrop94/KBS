<?php
//Include files to connect with database
include DOCROOT . 'inc/mysql.inc.php';
//Sla verbinding op in $db
$dbh = connectToDatabase();

$sth = $dbh->prepare ("SELECT * FROM Persoon");

$sth->execute();

$result = $sth->fetchAll(PDO::FETCH_ASSOC);


?>

<table>
<?php foreach($result as $row) {
?>
	<tr>
		<td><?php print($row["0voornaam"]); ?></td>
		<td><?php print($row["achternaam"]); ?></td>
	</tr>
<?php } ?>
</table>
