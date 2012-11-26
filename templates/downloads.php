<?php
include DOCROOT . 'inc/mysql.inc.php';
// db
$dbh= connectToDatabase();
    $sth = $dbh->prepare ("SELECT * FROM downloads");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);   
?>  

<table border="1">
    <tr>    
        <th> Downloads </th>    
        <th> Grootte </th>
        <th> Download </th>
    </tr>
       <?php foreach($result as $row) {
?>
    <tr>
        <?php // Laat het bestand naam zien.?>
        <td> <?php echo ($row["file"]); ?> </td>
        <?php // Laat de size van het bestand zien in kb.?>
        <td> <?php echo ($row["size"]); ?> kb </td>
        <?php // Met deze functie kan je bestanden downloaden die geupload zijn.?>
        <td> <a href=http://kbs.nl/uploads/<?php echo ($row["file"]); ?> >Download</a> </td>
    </tr>    
        
 <?php } ?>       
     </table>
   
    