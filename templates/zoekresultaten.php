<?php 
$zoekwoord = $_POST["zoekwoord"];
//Include files to connect with database
include DOCROOT . 'inc/mysql.inc.php';
//Sla verbinding op in $db
$dbh = connectToDatabase();
    $sth = $dbh->prepare (" SELECT * 
                            FROM article 
                            WHERE title LIKE '%$zoekwoord%'
                            OR text LIKE '%$zoekwoord%' 
                            ");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

?>
<table border="3">
    <tr>
        <th>Titel</th>
        <th>Beschrijving</th>
    </tr>
        <?php foreach($result as $row) {
        ?>
    
    <tr>
	<td><?php print($row["title"]); ?></td>
	<td><?php print($row["text"]); ?></td>
    </tr>
<?php } ?>
</table>
