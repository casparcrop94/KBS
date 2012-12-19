<!--Auteur: Caspar Crop-->
<?php
//prepare the database collection
$dbh = connectToDatabase();
$_SESSION['service_id']=$_GET['id'];
//if the user submitted the form, the following is done:
if (isset($_POST['vraagaan'])) {
//put all inputs in variables    
    $name=$_POST['name'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $zipcode=$_POST['zipcode'];
    $residence=$_POST['residence'];
    $telephone=$_POST['telephone'];
    $mobile=$_POST['mobile'];
    
    $selectsql="SELECT servicename, pph, avgcost FROM services where service_id=:id";
    $sth=$dbh->prepare($selectsql);
    $sth->bindParam(":id", $_SESSION['service_id']);
    $sth->execute();
    $result= $sth->fetch(PDO::FETCH_ASSOC);
    
    $servicename=$result['servicename'];
    $pph=$result['pph'];
    $avgcost=$result['avgcost'];
    
    if($name!="" or $email!="" or $address!="" or $zipcode!="" or $residence!="" or $telephone!="" or $mobile!=""){
	    $date = date ( 'd-m-Y' );
	$sql="SELECT  start_datum FROM agenda WHERE start_datum=:date";    
	$sth=$dbh->prepare($sql);
	$sth->bindParam(':date', $date);
	$sth->execute();
	$result1= $sth->fetchAll(PDO::FETCH_ASSOC);
	if(count($result1)==0){
	    $sth=$dbh->prepare("INSERT INTO");
	}
	
    }
    else{
	echo '<p>Niet alle gegevens zijn ingevuld!</p><br/><br/>';
	?>
	<form action="" method="POST">
    <table>
	<tr>
	    <td>Naam:</td>
	    <td><input type="text" name="name" value="<?php echo($name)?>" /></td>
	</tr>
	<tr>
	    <td>E-mail</td>
	    <td><input type="text" name="email" value="<?php echo($email)?>" /></td>
	</tr>
	<tr>
	    <td>Adres</td>
	    <td><input type="text" name="address" value="<?php echo($address)?>" /></td>
	</tr>
	<tr>
	    <td>Postcode</td>
	    <td><input type="text" name="zipcode" value="<?php echo($zipcode)?>" /></td>
	</tr>
	<tr>
	    <td>Woonplaats</td>
	    <td><input type="text" name="residence" value="<?php echo($residence)?>" /></td>
	</tr>
	<tr>
	    <td>Telefoonnummer</td>
	    <td><input type="text" name="telephone" value="<?php echo($telephone)?>" /></td>
	</tr>
	<tr>
	    <td>Mobiel</td>
	    <td><input type="text" name="mobile" value="<?php echo($mobile)?>" /></td>
	</tr>
	<tr>
	<td>Datum</td>
	<td></td>
	</tr>
	<tr>
	<td>Begintijd en eindtijd</td>
	<td></td>
	</tr>
	<tr>
	<td><input type="hidden" name="service" value=""></td>
	<td></td>
	</tr>
	<tr>
	    <td></td>
	    <td><input type="submit" name="vraagaan" value="Vraag aan!" /></td>
	</tr>
    </table>
</form>
    <?php
    }
}
else{
?>
<form action="" method="POST">
    <table>
	<tr>
	    <td>Naam:</td>
	    <td><input type="text" name="name" value="" /></td>
	</tr>
	<tr>
	    <td>E-mail</td>
	    <td><input type="text" name="email" value="" /></td>
	</tr>
	<tr>
	    <td>Adres</td>
	    <td><input type="text" name="address" value="" /></td>
	</tr>
	<tr>
	    <td>Postcode</td>
	    <td><input type="text" name="zipcode" value="" /></td>
	</tr>
	<tr>
	    <td>Woonplaats</td>
	    <td><input type="text" name="residence" value="" /></td>
	</tr>
	<tr>
	    <td>Telefoonnummer</td>
	    <td><input type="text" name="telephone" value="" /></td>
	</tr>
	<tr>
	    <td>Mobiel</td>
	    <td><input type="text" name="mobile" value="" /></td>
	</tr>
	<tr>
	<td>Datum</td>
	<td></td>
	</tr>
	<tr>
	<td>Begintijd en eindtijd</td>
	<td></td>
	</tr>
	<tr>
	<td><input type="hidden" name="service" value=""></td>
	<td></td>
	</tr>
	
	<tr>
	    <td></td>
	    <td><input type="submit" name="vraagaan" value="Vraag aan!" /></td>
	</tr>
    </table>
</form>
<?php } ?>