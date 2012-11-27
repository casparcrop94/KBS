<?php
include(DOCROOT."/inc/mysql.inc.php");

$dbh = connectToDatabase();  // Maak verbinding met de database
$statusText = "";

if(isset($_GET['option'])) {
    if($_GET['option'] == "delete") {
        $sth = $dbh->prepare("DELETE FROM category WHERE cat_id=:id");
        $sth->bindParam(":id", $_GET['id']);
        $sth->execute();
        
        $statusText = "Categorie succesvol verwijderd.";
    }
}

if(isset($_GET["case"])) { 
    if($_GET["case"] == "succes") { 
        $statusText = "Categorie succesvol opgeslagen.";
    } else { 
        $statusText = "Categorie niet succesvol opgeslagen.";
    }
}

$sth = $dbh->query("SELECT * FROM category ORDER BY cat_id"); // Haal alle categorien uit de database
$sth->execute();

$res = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <body>
        <?php
        echo($statusText."<br/>");
        ?>
<<<<<<< HEAD
		<form action="article.php" method="get">
            <input type="hidden" name="option" value="new"> 
            <input type="submit" name="" value="Nieuwe Categorie">
        </form>
        <br/>
=======
		<a id="button" href="category.php?option=new">Nieuwe categorie</a>
		<br/>
>>>>>>> dca3e76
        <table border="1">
            <tr>
                <td>Naam</td> 
                <td>Beschrijving</td>
				<td>Gepubliceerd</td>
				<td>Bewerk</td>
				<td>Verwijder</td>                
            </tr>
            <?php 
                foreach($res as $row) {                                                // Loop door SQL-resultaten
                    echo("<tr>");
                    echo("<td>".$row['name']."</td>");                                 // Print de titel
                    echo("<td>".$row['discription']."</td>");                          // Print de beschrijving
                    echo("<td>".($row['published'] == 1 ? "Ja" : "Nee")."</td>");      // Print de publicatiestatus
                    echo("<td><a href='category.php?option=edit&id=".$row['cat_id']."'>Bewerk</a></td>");      // Print de bewerk knop
                    echo("<td><a href='".$_SERVER['PHP_SELF']."?option=delete&id=".$row['cat_id']."'>Verwijder</a></td>"); // Print de verwijder knop
                    echo("</tr>");
                } 
            ?>
        </table>
    </body>
</html>
