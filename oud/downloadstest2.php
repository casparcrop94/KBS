<?php
include DOCROOT . 'inc/mysql.inc.php';
$connection= connectToDatabase();
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * 10;
$sth = $connection->prepare("SELECT * FROM downloads LIMIT $start_from, 10");
$sth->execute($sth,$connection);
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
<?php
$sth = $connection->prepare("SELECT COUNT(*) FROM downloads");
$sth->execute($sth,$connection);
$result = $sth->fetchall(PDO::FETCH_ASSOC);
$row = mysql_fetch_row($result);
$total_records = $row[0];
$total_pages = ceil($total_records / 20);
  
for ($i=1; $i<=$total_pages; $i++) {
            echo "<a href='downloadstest.php?page=".$i."'>".$i."</a> ";
};
?>