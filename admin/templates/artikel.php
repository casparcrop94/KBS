<?php
include(DOCROOT . "/inc/functions.inc.php");

$dbh = connectToDatabase();  // Maak verbinding met de database
$statusText = "";

if (isset($_POST['option'])) {
    if ($_POST['option'] == "Verwijder") {
	foreach ($_POST['id'] as $row) {
	    $sth = $dbh->prepare("DELETE FROM article WHERE ID=:id");
	    $sth->bindParam(":id", $row);
	    $sth->execute();
	}
	$statusText = "Artikel succesvol verwijderd.";
    }
}

if (isset($_GET["case"])) {
    if ($_GET["case"] == "succes") {
	$statusText = "Artikel succesvol opgeslagen.";
    } else {
	$statusText = "Artikel niet succesvol opgeslagen.";
    }
}

$sth = $dbh->query("SELECT A.ID,title,C.name AS catname,date_added,date_edited,A.published FROM article A JOIN category C ON A.cat_id = C.cat_id ORDER BY ID"); // Haal alle artikelen uit de database
$sth->execute();

$res = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
echo($statusText . "<br/>\n");
?>
<form action="" method="post">
    <input type="submit" name="option" value="Nieuwe categorie"/>
    <input type="submit" name="option" value="Nieuw artikel"/>
    <input type="submit" name="option" value="Verwijder"/>
    <input type="submit" name="option" value="Publiceer"/>
    <input type="submit" name="option" value="Depubliceer"/>
    <br/>
    <table border="1">
	<tr>
	    <th><input type="checkbox" id="checkall" value=""/></th>
	    <th>Titel</th> 
	    <th>Categorie</th>
	    <th>Datum aangemaakt</th>
	    <th>Laatst gewijzigd</th> 
	    <th>Gepubliceerd</th>
	</tr>
	<?php
	foreach ($res as $row) {       // Loop door SQL-resultaten
	    echo("<tr>");
	    echo("<td><input type=\"checkbox\" value=" . $row['ID'] . " name=id[]/></td>");
	    echo("<td><a href='/admin/artikel/bewerk/" . $row['ID'] . "'>" . $row['title'] . "</a></td>");     // Print de titel
	    echo("<td>" . $row['catname'] . "</td>");   // Print de categorie
	    echo("<td>" . $row['date_added'] . "</td>");       // Print de datum
	    echo("<td>" . $row['date_edited'] . "</td>");
	    echo("<td>" . ($row['published'] == 1 ? "Ja" : "Nee") . "</td>"); // Print de publicatiestatus
	    echo("</tr>");
	}
	?>
    </table>
</form>