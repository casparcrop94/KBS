<?php
//include file to connect with databse
include(DOCROOT."/inc/mysql.inc.php");
// Set connection with database into variable
$dbh = connectToDatabase();  

//define $statustext
$statusText = "";

//Check if option is defined
if(isset($_GET['option'])) {
	//If option is deleted then delete category where id=$id
    if($_GET['option'] == "delete") {
        $sth = $dbh->prepare("DELETE FROM category WHERE cat_id=:id");
        $sth->bindParam(":id", $_GET['id']);
        $sth->execute();
        
        $statusText = "Categorie succesvol verwijderd.";
    }
}
//Check if case is defined
if(isset($_GET["case"])) { 
    if($_GET["case"] == "succes") { 
        $statusText = "Categorie succesvol opgeslagen.";
    } else { 
        $statusText = "Categorie niet succesvol opgeslagen.";
    }
}
// Get all categorys from database
$sth = $dbh->query("SELECT * FROM category ORDER BY cat_id"); 
$sth->execute();
$res = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <body>
        <?php
        echo($statusText."<br/>");
        ?>
		<a id="button" href="/admin/categorie/nieuw">Nieuwe categorie</a>
		<br/>
        <table border="1">
            <tr>
                <td>Naam</td> 
                <td>Beschrijving</td>
				<td>Gepubliceerd</td>
				<td>Bewerk</td>
				<td>Verwijder</td>                
            </tr>
            <?php 
				//Print the categorys
                foreach($res as $row) {                                                
                    echo("<tr>");
                    echo("<td>".$row['name']."</td>");                                 
                    echo("<td>".$row['discription']."</td>");                          
                    echo("<td>".($row['published'] == 1 ? "Ja" : "Nee")."</td>");      
                    echo("<td><a href='/admin/categorie/bewerk/".$row['cat_id']."'>Bewerk</a></td>");      
                    echo("<td><a href='/admin/categorie/verwijder/".$row['cat_id']."'>Verwijder</a></td>");
                    echo("</tr>");
                } 
            ?>
        </table>
    </body>
</html>
