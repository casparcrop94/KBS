
<?php
include(DOCROOT."/inc/mysql.inc.php");

$dbh = connectToDatabase();  // Maak verbinding met de database
$statusText = "";

if(isset($_GET['option'])) {
    if($_GET['option'] == "delete") {
        $sth = $dbh->prepare("DELETE FROM article WHERE ID=:id");
        $sth->bindParam(":id", $_GET['id']);
        $sth->execute();
        
        $statusText = "Artikel succesvol verwijderd.";
    }
}

if(isset($_GET["case"])) { 
    if($_GET["case"] == "succes") { 
        $statusText = "Artikel succesvol opgeslagen.";
    } else { 
        $statusText = "Artikel niet succesvol opgeslagen.";
    }
}

$sth = $dbh->query("SELECT A.ID,title,C.name AS catname,date_added,date_edited,A.published FROM article A JOIN category C ON A.cat_id = C.cat_id ORDER BY ID"); // Haal alle artikelen uit de database
$sth->execute();

$res = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
	<link rel="stylesheet" href="/styles/admin.css" type="text/css">
    </head>
    <body>
        <?php
        echo($statusText."<br/>\n");
        ?>
        <input type="button" onclick="window.location = '/admin/bewerkcategorie?option=new'" value="Nieuwe categorie"/>
	<input type="button" onclick="window.location = '/admin/bewerkartikel'" value="Nieuw artikel"/>
        <br/>
        <table border="1">
            <tr>
		<th>	</th>
                <th>Titel</th> 
                <th>Categorie</th>
                <th>Datum aangemaakt</th>
                <th>Laatst gewijzigd</th> 
                <th>Gepubliceerd</th>
                <th>Bewerk</th>
                <th>Verwijder</th>
            </tr>
            <?php 
                foreach($res as $row) {                                                 // Loop door SQL-resultaten
                    echo("<tr>");
		    echo("<td><input type=\"checkbox\" value=".$row['ID']."/></td>");
                    echo("<td>".$row['title']."</td>");                                 // Print de titel
                    echo("<td>".$row['catname']."</td>");                               // Print de categorie
                    echo("<td>".$row['date_added']."</td>");                            // Print de datum
                    echo("<td>".$row['date_edited']."</td>");                   
                    echo("<td>".($row['published'] == 1 ? "Ja" : "Nee")."</td>");        // Print de publicatiestatus
                    echo("<td><a href='/admin/artikel/bewerk/".$row['ID']."'>Bewerk</a></td>");      // Print de bewerk knop
                    echo("<td><a href='/admin/artikel/verwijder/".$row['ID']."'>Verwijder</a></td>"); // Print de verwijder knop
                    echo("</tr>");
                } 
            ?>
        </table>
    </body>
</html>

