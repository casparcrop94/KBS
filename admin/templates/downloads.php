<!-- Erik de Vries -->
<?php
//haalt de page op voor de url
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};
//worden 10 results weergegeven per pagina.
$start_from = ($page - 1) * 20;
//db
$dbh = connectToDatabase();
$sql1 = "SELECT * FROM downloads LIMIT $start_from, 20";
$result1 = selectquery($sql1, $dbh);

if (isset($_GET['action'])) {

    if ($_GET['action'] == 'delete') {
	$id = $_GET['ID'];
	$sth = $dbh->prepare("SELECT file FROM downloads WHERE ID=:id");
	$sth->bindParam(":id", $id, PDO::PARAM_STR);
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	if (unlink(DOCROOT . 'uploads/' . $result["file"])) {
	    $sth = $dbh->prepare("DELETE FROM downloads Where ID=:id");
	    $sth->bindParam(":id", $id, PDO::PARAM_STR);
	    $sth->execute();
	    header("location: /admin/downloads");
	    exit;
	}
    }
}
if (isset($_POST['submit'])) {
    upload($_FILES);
}
// db
$sth = $dbh->prepare("SELECT * FROM downloads");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
<div id="downloads">
<table>
    <tr id="head">    
        <th> Downloads </th>    
        <th> Grootte </th>
        <th> Verwijder </th>
    </tr>
    <?php foreach ($result1 as $row) {
	?>
        <tr id="row">
    	<!-- Laat het bestand naam zien. -->
    	<td> <?php echo ($row["file"]); ?> </td>
    	<!-- Laat de size van het bestand zien in kb. -->
    	<td> <?php echo ($row["size"]); ?> kb </td>
    	<!-- Verwijder functie, verwijdert uit de map en de database. -->
    	<td> <a href="/admin/downloads/delete/<?php echo $row["ID"]; ?>">Verwijder</a></td>
        </tr>    

    <?php } ?>       
</table>
</div>
<!-- Het formulier van documenten uploaden. -->    
<form action="" method="post"
      enctype="multipart/form-data">
    <label for="file">Bestand uploaden:</label>
    <input type="file" name="file" id="file" />
    <br />
    <input type="submit" name="submit" value="Upload" />
</form>

<?php
//db
$sql2 = "SELECT * FROM downloads";
$result2 = selectquery($sql2, $dbh);
//het aantal records, aantal word berekent door $result bij elkaar optetellen
$total_records = count($result2);
//het aantal pages, aantal pages wordt berekend door het aantal records delen door 10
$total_pages = ceil($total_records / 20);
//$1 staat voor de pagina nummer, begint op 1
for ($i = 1; $i <= $total_pages; $i++) {
//$1 (de pagina nummer) komt achter de url de staan en wordt weergegeven als $1 onder de tabel
    echo "<a href='/admin/downloads/" . $i . "'>" . $i . "</a> ";
};
?>