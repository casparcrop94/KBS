<!--
Auteur: Jelle Kapitein
	s1058427
	ICTM1e
-->

<?php

$dbh = connectToDatabase();  // Maak verbinding met de database
$statusText = "";

if (isset($_POST['option']) && isset($_POST['id'])) {
    $id = $_POST['id'];       // Haal de ID array op
    $id = implode(',', $_POST['id']);     // Zet de array om in een string, uit elkaar gehouden door ,
    $id = mysql_real_escape_string($id);    // Maak de string veilig voor de database
    
    if ($_POST['option'] == "Verwijder") { // Als er op de verwijder knop is gedrukt
	$sth = $dbh->prepare("DELETE FROM article WHERE ID IN(" . $id . ")"); // Verwijder het artikel
	$sth->execute();

	$statusText = "Artikel succesvol verwijderd.";
    } elseif ($_POST['option'] == "Publiceer") {
	$sth = $dbh->prepare("UPDATE article SET published=1 WHERE ID IN (".$id.")");
	$sth->execute();
    } elseif ($_POST['option'] == "Depubliceer") {
	$sth = $dbh->prepare("UPDATE article SET published=0 WHERE ID IN (".$id.")");
	$sth->execute();
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
    <input type="button" onclick="window.location = '/admin/categorie/nieuw'" value="Nieuwe categorie"/>
    <input type="button" onclick="window.location = '/admin/artikel/nieuw'" value="Nieuw artikel"/>
    <input type="submit" name="option" value="Verwijder"/>
    <input type="submit" name="option" value="Publiceer"/>
    <input type="submit" name="option" value="Depubliceer"/>
    <br/>
    <table class="hover">
	<tr>
	    <th class="center"><input type="checkbox" id="checkall" value=""/></th>
	    <th>Titel</th> 
	    <th>Categorie</th>
	    <th>Datum aangemaakt</th>
	    <th>Laatst gewijzigd</th> 
	    <th>Gepubliceerd</th>
	</tr>
<?php
foreach ($res as $row) {       // Loop door SQL-resultaten
    echo("<tr>");
    echo("<td class='center'><input type=\"checkbox\" value=" . $row['ID'] . " name=id[]/></td>");
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
