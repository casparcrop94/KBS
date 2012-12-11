<!-- AUTEUR: RICHARD VAN DEN HOORN -->
<?php
// Set connection with database into variable
$dbh = connectToDatabase();  

//define $statustext
$statusText = "";
$style='';

//Check if case is defined
if(isset($_GET["case"])) { 
    if($_GET["case"] == "succes") { 
        $statusText = "Categorie succesvol opgeslagen.";
        $style="message_success";
    } else { 
        $statusText = "Categorie niet succesvol opgeslagen.";
        $style="message_error";
    }
}

//Check if option is defined
if(isset($_POST['option'])) {
	$statusText="";
	
	
	if($_POST['option'] == "Nieuw") 
	{
        header("Location: /admin/categorie/nieuw");
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
        	$sth = $dbh->prepare("UPDATE category SET published=1 WHERE cat_id IN($id)");
        	$sth->execute();
        
        	$statusText = "Categorie succesvol gepubliceerd.";
    	}
		if($_POST['option'] == "Depubliceer") {
        	$sth = $dbh->prepare("UPDATE category SET published=0 WHERE cat_id IN($id)");
        	$sth->execute();
        
        	$statusText = "Categorie succesvol gedepubliceerd.";
    	}
		if($_POST['option'] == "Verwijderen") {
        	$sth = $dbh->prepare("DELETE FROM category WHERE cat_id IN($id)");
        	$sth->execute();
        
        	$statusText = "Categorie succesvol verwijderd.";
    	}
	}	
}

// Get all categorys from database
$sth = $dbh->query("SELECT * FROM category ORDER BY cat_id"); 
$sth->execute();
$res = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <body>
    	<div class="<?php echo $style; ?>">
    		<p><?php echo $statusText; ?></p>
    	</div>
		<form action="" method="post">
        <input name="option" type="submit" value="Nieuw">
        <input name="option" type="submit" value="Publiceer">
		<input name="option" type="submit" value="Depubliceer">
		<input name="option" type="submit" value="Verwijderen">
        <table border="1">
            <tr>
				<th width="50" align="center"><input name="checkall" type="checkbox" value="check" id="checkall"></th>
                <th width="300">Naam</th> 
                <th width="500">Beschrijving</th>
				<th width="100">Gepubliceerd</th>
            </tr>
            <?php 
				//Print the categorys
				foreach($res as $row) { 
                    echo("<tr>");
					echo("<td align=center><input name=id[] type=checkbox value=".$row['cat_id']."></td>");
                    echo("<td><a href='/admin/categorie/bewerk/".$row['cat_id']."'>".$row['name']."</a></td>");                                 
                    echo("<td>".$row['discription']."</td>");                          
                    echo("<td>".($row['published'] == 1 ? "Ja" : "Nee")."</td>");      
                    echo("</tr>");
				} 
            ?>
        </table>
        </form>
    </body>
</html>
