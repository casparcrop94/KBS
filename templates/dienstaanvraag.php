<?php session_start(); ?>
<!--Auteur: Caspar Crop-->
<?php
$dbh=  connectToDatabase();


if(isset($_POST['vraagaan'])){
    
    if($_POST['name']==""){
	$namemiss=true;
    }
    else{$name=$_POST['name'];}
    
    if($_POST['email']){
	$emailmiss=true;
    }
    else{$email=$_POST['email'];}
    
    
    
    
    
}
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
	    <td></td>
	    <td><input type="submit" name="vraagaan" value="Vraag aan!" /></td>
	</tr>
    </table>
</form>



