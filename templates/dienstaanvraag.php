<!--Auteur: Caspar Crop-->
<?php
$dbh = connectToDatabase();

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
    $service=;
    
    if($name!="" or $email!="" or $address!="" or $zipcode!="" or $residence!="" or $telephone!="" or $mobile!=""){
    //check agenda
    
	
	
	
	
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