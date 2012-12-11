<!-- Erik de Vries -->
<?php
// db
$dbh = connectToDatabase();
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

<table border="1">
    <tr>    
        <th> Downloads </th>    
        <th> Grootte </th>
        <th> Verwijder </th>
    </tr>
    <?php foreach ($result as $row) {
	?>
        <tr>
    	<!-- Laat het bestand naam zien. -->
    	<td> <?php echo ($row["file"]); ?> </td>
    	<!-- Laat de size van het bestand zien in kb. -->
    	<td> <?php echo ($row["size"]); ?> kb </td>
    	<!-- Verwijder functie, verwijdert uit de map en de database. -->
    	<td> <a href="/admin/downloads/delete/<?php echo $row["ID"]; ?>">Verwijder</a></td>
        </tr>    

    <?php } ?>       
</table>
<!-- Het formulier van documenten uploaden. -->    
<form action="" method="post"
      enctype="multipart/form-data">
    <label for="file">Bestand uploaden:</label>
    <input type="file" name="file" id="file" />
    <br />
    <input type="submit" name="submit" value="Upload" />
</form>