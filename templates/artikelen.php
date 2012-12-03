<?php

include('/inc/mysql.inc.php');

$dbh = connectToDatabase();

$sth = $dbh->query("SELECT A.ID,title,C.name AS catname,date_added,date_edited FROM article A JOIN category C ON A.cat_id = C.cat_id WHERE A.published = '1' ORDER BY ID"); // Haal alle artikelen uit de database
$sth->execute();

$res = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <body>
        <table border="1">
            <tr>
                <td>Titel</td> 
                <td>Categorie</td>
                <td>Datum aangemaakt</td>
                <td>Laatst gewijzigd</td> 
            </tr>
            <?php 
                foreach($res as $row) {                                                 // Loop door SQL-resultaten
                    echo("<tr>");
                    echo("<td>".$row['title']."</td>");                                 // Print de titel
                    echo("<td>".$row['catname']."</td>");                               // Print de categorie
                    echo("<td>".$row['date_added']."</td>");                            // Print de datum
                    echo("<td>".$row['date_edited']."</td>");                   
                    echo("</tr>");
                } 
            ?>
        </table>
    </body>
</html>