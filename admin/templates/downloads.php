<?php
/*
 * @author Erik de Vries
 * @klas ICT M1 E1
 * @projectGroup SSJ
 */
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
$sql1 = "SELECT * FROM downloads ORDER BY ID DESC LIMIT $start_from, 20";
$result1 = selectquery($sql1, $dbh);

if (isset($_POST['option'])) {

    if ($_POST['option'] == 'Verwijder') {
	$id = $_POST['id'];
	$id = implode(',', $_POST['id']);     // Zet de array om in een string, uit elkaar gehouden door ,
	$id = mysql_real_escape_string($id);    // Maak de string veilig voor de database
	$sth = $dbh->prepare("SELECT file, ID FROM downloads WHERE ID IN(" . $id . ")");
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);

//Delete functie, hier wordt de bestanden uit de map uploads, uit de database en van de site verwijdert.
	foreach ($result as $file) {

	    if (unlink(DOCROOT . 'uploads/' . $file["file"])) {
		$sth = $dbh->prepare("DELETE FROM downloads WHERE ID=:id");
		$sth->bindParam(":id", $file['ID'], PDO::PARAM_STR);
		$sth->execute();
	    }
	}
	header("location: /admin/downloads");
	exit;
    }
}

//Upload functie
if (isset($_POST['submit'])) {
    $upload = upload($_FILES);
    if ($upload === true) {
	header("location: /admin/downloads");
	exit;
    } else {
	//echo $upload;
    }
}

// db
$sth = $dbh->prepare("SELECT * FROM downloads");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Het formulier van documenten uploaden. -->  
<p><strong>Nieuw bestand uploaden</strong></p>
<form action="" method="post"
      enctype="multipart/form-data">
    <label for="file">Bestand uploaden:</label>
    <input type="file" name="file" id="file" />
    <br />
    <input type="submit" name="submit" value="Upload" />
</form>
<p><strong>Bestaande bestanden overzicht en verwijderen</strong></p>
<div id="downloads">
    <?php if (isset($upload)): ?>
        <div class="message_error"> 
    	<p><?php echo $upload; ?></p>
        </div>
    <?php endif; ?>

    <form action="" method="post">
	<input type="submit" name="option" value="Verwijder"/>
	<table class="hover">
	    <tr id="head"> 
		<th class="center"><input type="checkbox" id="checkall" value=""/></th>
	    <div class="page">
		<div class="pagination">   
		    <?php
//db
		    $sql2 = "SELECT * FROM downloads";
		    $result2 = selectquery($sql2, $dbh);
//het aantal records, aantal word berekent door $result bij elkaar optetellen
		    $total_records = count($result2);
//het aantal pages, aantal pages wordt berekend door het aantal records delen door 10
		    $total_pages = ceil($total_records / 20);
//$1 als er niet genoeg bestanden zijn voor 2 pagina's, is de pagination niet zichtbaar
		    if ($total_pages > 1) {
//$1 staat voor de pagina nummer, begint op 1
			for ($i = 1; $i <= $total_pages; $i++) {
// zorgt ervoor dat de paginanummer van de pagina waar hij nu op zit niet wordt weergegeven
			    if ($i != $page) {
//$1 (de pagina nummer) komt achter de url de staan en wordt weergegeven als $1 boven de tabel
				echo "<a href='/admin/downloads/" . $i . "'>" . $i . "</a> ";
			    }
			}
		    }
		    ?>
		</div>

		<!-- geeft weer op welke pagina je zit -->
		<p> <strong> Pagina: <?php echo $i = $page ?> </strong> </p>
	    </div>

	    <th> Downloads </th>    
	    <th> Grootte </th>

	    </tr>
	    <?php foreach ($result1 as $row) {
		?>
    	    <tr id="row">
		    <?php echo("<td class=\"center\"><input type=\"checkbox\" value=" . $row['ID'] . " name=id[]/></td>"); ?>
    		<!-- Laat het bestand naam zien. -->
    		<td> <a href=http://kbs.nl/uploads/<?php echo rawurlencode($row["file"]) ?> > <?php echo $row["file"] ?> </a></td>
    		<!-- Laat de size van het bestand zien in kb. -->
    		<td> <?php echo ($row["size"]); ?> kb </td>

    	    </tr>    
	    <?php } ?>       
	</table>
    </form>
</div>

