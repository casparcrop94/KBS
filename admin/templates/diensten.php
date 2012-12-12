<!-- AUTEUR: RICHARD VAN DEN HOORN -->
<?php
//connecting to the database
$dbh = connectToDatabase();

//define $statustext
$statusText = "";

//Check if case is defined
if(isset($_GET["case"])) {
	if($_GET["case"] == "succes") {
		$statusText = "Dienst succesvol opgeslagen.";
	} else {
		$statusText = "Dienst niet succesvol opgeslagen.";
	}
}

//Check if option is defined
if(isset($_POST['option'])) {
	$statusText="";


	if($_POST['option'] == "Nieuw")
	{
		header("Location: /admin/diensten/nieuw");
		exit;
	}

	if(isset($_POST['id']))
	{
		//Get id from form in array
		$id=$_POST['id'];
		//convert array to comma sepparated string
		$id = implode(", ", $id);
		//escape characters which are not allowed.
		//normally PDO does this, but it is not possible to get an array into BindParam.
		$id=mysql_real_escape_string($id);

		if($_POST['option'] == "Publiceer") {
			$sth = $dbh->prepare("UPDATE services SET published=1 WHERE service_id IN($id)");
			$sth->execute();

			$statusText = "Dienst succesvol gepubliceerd.";
		}
		if($_POST['option'] == "Depubliceer") {
			$sth = $dbh->prepare("UPDATE services SET published=0 WHERE service_id IN($id)");
			$sth->execute();

			$statusText = "Dienst succesvol gedepubliceerd.";
		}
		if($_POST['option'] == "Verwijderen") {
			$sth = $dbh->prepare("DELETE FROM services WHERE service_id IN($id)");
			$sth->execute();

			$statusText = "Dienst succesvol verwijderd.";
		}
	}
}


$sth = $dbh->query("SELECT * FROM services"); // Haal alle diensten uit de database
$sth->execute();
$res = $sth->fetchAll(PDO::FETCH_ASSOC);

function haalartikelop($id){
	$dbh = connectToDatabase();
	$sth = $dbh->query("SELECT * FROM article WHERE ID=$id"); // Haal alle diensten uit de database
	//$sth->bindparam(':id',4);
	$sth->execute();
	$res = $sth->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($res as $row){
		$title=$row['title'];
	}
	
	return $title;
}

?>
<div>
<?php
        echo($statusText."<br/>");
        ?>
<form action="" method="post">
	<input name="option" type="submit" value="Nieuw">
	<input name="option" type="submit" value="Publiceer">
	<input name="option" type="submit" value="Depubliceer">
	<input name="option" type="submit" value="Verwijderen">
	
    <!--Displaying the table-->
    <table class="hover">

	<!--Displaying the tablehead-->
        <thead>
        
            <tr>
            	<th width="50" class="center"><input name="checkall" type="checkbox" value="check" id="checkall"></th>
                <th>Dienst</th>
                <th>Omschrijving</th>
                <th>Gepubliceerd</th>
                <th>Gelinkt artikel</th>
            </tr>
        </thead>

        <!--Displaying the tablebody-->
        <tbody>
	    <?php
	    //displaying all the values
	    foreach ($res as $row) {
		?>
    	    <tr>
    	    	<?php
    	    	echo("<td class='center'><input name=id[] type=checkbox value=".$row['service_id']."></td>");
    	    	?>
    			<!--displays the service name-->
    			<td><a href="/admin/diensten/bewerk/<?php echo($row["service_id"]) ?>"><?php echo($row["servicename"]) ?></a> </td>
    			<!--displays the discription-->
    			<td><?php echo($row["servicetext"]) ?></td>
    			<td><?php echo($row['published'] == 1 ? "Ja" : "Nee")?></td>
    			<td><a href="/admin/artikel/bewerk/<?php echo $row["article_id"] ?>"><?php echo haalartikelop($row["article_id"]) ?></a> </td>
    		</tr>
<?php } ?>
        </tbody>

    </table>
  </form>
</div>