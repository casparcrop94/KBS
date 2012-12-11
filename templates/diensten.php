<!-- AUTEUR: RICHARD VAN DEN HOORN -->
<?php
$dbh = connectToDatabase();

$sth = $dbh->query("SELECT * FROM services WHERE Published=1"); // Haal alle diensten uit de database
$sth->execute();
$res = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
    <?php
    $i = 0;
    foreach ($res as $row) {  // Loop door SQL-resultaten
	if ($i == 0) {
	    echo("<tr>");
	}
	echo("<td class=diensten onclick=window.location='" . $row['article_id'] . "'; style='cursor: pointer';>");
	echo("<div class=title><h2>" . $row['servicename'] . "</h2></div>");
	echo("<br /><div class=image><img src='/uploads/" . $row['image'] . "' height=100 /></div>");
	echo("<br /><div class=discription>" . $row['servicetext'] . "</div>");
	echo("</td>");
	if ($i == 1) {
	    echo("</tr>");
	}
	$i++;
	if ($i == 2) {
	    $i = 0;
	}
    }
    ?>
</table>
