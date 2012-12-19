<?php
/*
 * @author Caspar Crop
 * @klas ICT M1 E1
 * @projectGroup SSJ
 */

//databace connection
$dbh = connectToDatabase();
//checking if form is filled in and submitted
if (isset($_POST['Verander!'])) {
    if (isset($_POST['pph']) AND isset($_POST['avgcost'])) {
	//assigning values
	$ident = $_POST['id'];
	$priceph = $_POST['pph'];
	$average = $_POST['avgcost'];
	//updating the database
	//sql statement
	$sql = (" UPDATE services SET pph=$priceph, avgcost=$average WHERE service_id=$ident ");
	//executing the statement
	$sth = $dbh->prepare($sql);
	$sth->execute();
	header('Location:/admin/admintarieven');
    }
} else {

    //retrieving rates from service
    //retrieving ID
    $id = $_GET['id'];
    //sql statement
    $sql = ('SELECT pph, avgcost FROM services WHERE service_id=' . $id . ' LIMIT 1');
    //execution
    $sth = $dbh->prepare($sql);
    $sth->execute();
    //retrieving resulted data
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    ?>
<!--Form for input of price per hour and average price-->
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo($id); ?>">
        <table class="simple-table">
    	<tr>
    	    <td>Prijs per uur:<input type="text" name="pph" value="<?php echo($row['pph']) ?>" /></td>
    	</tr>
    	<tr>
    	    <td>Gemiddelde prijs:<input type="text" name="avgcost" value="<?php echo($row['avgcost']) ?>" /></td>
    	</tr>                    
    	<tr>                        
    	    <td><input type="submit" value="Verander!" name="Verander!" /></td>
    	</tr>
        </table>
    </form>
<?php } ?>