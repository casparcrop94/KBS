<!DOCTYPE html>
<?php
include("inc/mysql.inc.php");

$dbh = connectToDatabase();  // Maak verbinding met de database

$sth = $dbh->query("SELECT A.ID,title,C.name AS catname,date_added,date_edited,published FROM artikelen A JOIN categories C ON A.cat_id = C.cat_id ORDER BY ID"); // Haal alle artikelen uit de database
$sth->execute();

$res = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <body>
        <table border="1">
            <tr>
                <td>Titel</td> 
                <td>Categorie</td>
                <td>Datum aangemaakt</td>
                <td>Laatst gewijzigd</td> 
                <td>Gepubliceerd</td>
                <td>Bewerk</td>
            </tr>
            <?php 
                foreach($res as $row) {                                                 // Loop door SQL-resultaten
                    echo("<tr>");
                    echo("<td>".$row['title']."</td>");                                 // Print de titel
                    echo("<td>".$row['catname']."</td>");                               // Print de categorie
                    echo("<td>".$row['date_added']."</td>");                            // Print de datum
                    echo("<td>".$row['date_edited']."</td>");                   
                    echo("<td>".($row['published'] == 1? "Ja" : "Nee")."</td>");        // Print de publicatiestatus
                    echo("<td><a href='nee.php?id=".$row['ID']."'>klik</a></td>");      // Print de bewerk knop
                    echo("</tr>");
                } 
            ?>
            </tr>
        </table>
    </body>
</html>
