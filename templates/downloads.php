<?php
include DOCROOT . 'inc/mysql.inc.php';
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * 10;
$dbh = connectToDatabase();
$sth = $dbh->prepare("SELECT * FROM downloads LIMIT $start_from, 10");
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
<?php
$sth = $dbh->prepare("SELECT * FROM downloads");
$sth->execute();
$result = $sth->fetchall(PDO::FETCH_ASSOC);
$total_records = count($result);
$total_pages = ceil($total_records / 10);

for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='/downloads/" . $i . "'>" . $i . "</a> ";
};
?>