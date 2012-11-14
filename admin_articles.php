<!DOCTYPE html>
<?php
include("mysql_connect.php");

$dbh = connectToDatabase("root", "usbw", "127.0.0.1", "3307", "mydb");  // Maak verbinding met de database

$sth = $dbh->query("SELECT A.ID,C.name,title,date_added,date_edited,published FROM artikelen A ORDER BY ID JOIN categoriën C ON cat_id = C.id"); // Haal alle artikelen uit de database
$sth->execute();

$res = $sth->fetchAll(PDO::FETCH_ASSOC);

print("<pre>");
print_r($res);
?>

<html>
    <body>
        <table border="1">
            <tr>
                <td>Title</td> 
                <td>Categorie</td>
                <td>Datum aangemaakt</td>
                <td>Laatst gewijzigd</td> 
                <td>Gepubliceerd</td>
                <td>Bewerk</td>
            </tr>
            <tr>
            <?php 
                foreach($res as $key=>$val) {                                           // Loop door SQL-resultaten
                    echo("<td>".$val['title']."</td>");                                 // Print de titel
                    echo("<td>".$val['cat_id']."</td>");                                // Print de categorie
                    echo("<td>".$val['date_added']."</td>");                            // Print de datum
                    echo("<td>".$val['date_edited']."</td>");                   
                    echo("<td>".($val['published'] == 1? "Ja" : "Nee")."</td>");        // Print de publicatiestatus
                    echo("<td><a href='nee.php?id=".$val['ID']."'>klik</a></td>");      // Print de bewerk knop
                } 
            ?>
            </tr>
        </table>
    </body>
</html>
