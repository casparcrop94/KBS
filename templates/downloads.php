<!-- Erik de Vries -->
<?php
include DOCROOT . 'inc/mysql.inc.php';
// db
$dbh = connectToDatabase();
$sth = $dbh->prepare("SELECT * FROM downloads");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
?>  

<table border="1">
    <tr>    
        <th> Bestanden </th>    
        <th> Grootte </th>
        <th> Download </th>
    </tr>
    <?php foreach ($result as $row) {
        ?>
        <tr>
            <!-- Laat het bestand naam zien. -->
            <td> <?php echo ($row["file"]); ?> </td>
            <!-- Laat de size van het bestand zien in kb. -->
            <td> <?php echo ($row["size"]); ?> kb </td>
            <!-- Met deze functie kan je bestanden downloaden die geupload zijn. -->
            <td> <a href=http://kbs.nl/uploads/<?php echo rawurlencode($row["file"]) ?> >Download</a> </td>
        </tr>    

    <?php } ?>       
</table>

