<?php
/*
 * @author Richard van den Hoorn & Caspar Crop
 * @klas ICT M1 E1
 * @projectGroup SSJ
 */
$dbh = connectToDatabase();

if (isset($_GET['id'])) {
    $sth1 = $dbh->prepare("SELECT service_id, servicename, servicetext, article_id FROM services WHERE service_id=:id");
    //execution
    $sth1->bindParam(":id", $_GET['id']);
    $sth1->execute();
    //retrieving resulted data
    $result = $sth1->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
	$service_id = $row['service_id'];
	$servicename = $row['servicename'];
	$article_id = $row['article_id'];

	$sth = $dbh->prepare("SELECT * FROM article WHERE ID=:id");
	$sth->bindParam(":id", $article_id);
	$sth->execute();
	$res = $sth->fetchAll(PDO::FETCH_ASSOC);

	foreach ($res as $row) {
	    $date = date("d-m-Y H:i:s", strtotime($row ['date_added']));
	    $datee = date("d-m-Y H:i:s", strtotime($row ['date_edited']));
	    ?>
	    <div class="artikel" id="title">
	        <h2><?php echo $row['title'] ?></h2>
	    </div>
	    <div class="artikel" id="dates">
	        <i>Aangemaakt: <?php echo $date ?></i>
		<?php if ($date != $datee) { ?>
		    <i><br />Laatst gewijzigd: <?php echo $datee ?></i>
		<?php } ?>
	    </div>
	    <div class="artikel" id="text">
		<?php
		echo $row['text'];
		?>
	    </div>

	<?php } ?>
	<div id="dalink">
	    <?php
	    //echo '<br/><br/>';
	    echo '<a href="/dienstaanvraag/' . $service_id . '">Vraag de dienst ' . $servicename . ' aan</a>';
	    ?> 
	</div>
	<?php
	}
	?>
	
    <?php
} else {

    $sql = "SELECT * FROM services WHERE Published=1"; // Haal alle diensten uit de database

    $result = selectquery($sql, $dbh)
    ?>

    <table class="diensten">
	<?php
	$i = 0;
	foreach ($result as $row) {  // Loop door SQL-resultaten
	    if ($i == 0) {
		echo("<tr>");
	    }
	    echo("<td class=cell style='cursor: pointer' onclick=window.location='diensten/" . $row['service_id'] . "' >");
	    echo("<div class=title><h2>" . $row['servicename'] . "</h2></div>");
	    echo("<br /><div class=discription>" . $row['servicetext'] . "</div>");
	    echo("</td>");
	    if ($i == 1) {
		echo("</tr>");
	    }
	    $i++;
	    if ($i == 2) {
		$i = 0;
	    }
	}
	?>
    </table>
<?php } ?>