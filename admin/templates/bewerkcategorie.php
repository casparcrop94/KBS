<!-- AUTEUR: RICHARD VAN DEN HOORN -->
<?php
$fouttext = '';
$option2 = '';

// Check if form is submitted
if (isset ( $_POST ['submit'] )) {
	// Get data from form and set data into variable.
	$option = $_POST ['option'];
	$id = $_POST ['id'];
	
	$name = $_POST ['name'];
	$discription = $_POST ['discription'];
	$published = $_POST ['published'];
	
	// Check if all formfields are filled.
	if ($name == '' or $discription == '' or $published == '') {
		$fouttext = 'Niet alle gegevens zijn ingevuld!';
		// set original option into variable originaloption;
		$originaloption = $option;
		// set the option to renew, this means that the form is not filled
		// correctly
		$option = 'renew';
		$option2 = 'renew';
	}
	
	if ($option != 'renew') {
		if ($option == 'new') {
			// Insert new article
			$db = connectToDatabase ();
			$sth = $db->prepare ( "INSERT INTO category (name, discription, published) 
		VALUES (:name,:discription,:published)" );
			$sth->bindParam ( ":name", $name );
			$sth->bindParam ( ":discription", $discription );
			$sth->bindParam ( ":published", $published );
			$result = $sth->execute ();
		} elseif ($option == 'edit') {
			// Edit an article
			$db = connectToDatabase ();
			$sth = $db->prepare ( "UPDATE category SET name=:name, discription=:discription, published=:published WHERE cat_id=:id" );
			$sth->bindParam ( ":name", $name );
			$sth->bindParam ( ":discription", $discription );
			$sth->bindParam ( ":published", $published );
			$sth->bindParam ( ":id", $id );
			$result = $sth->execute ();
		}
		
		// Check if category succesfully saved
		if ($result == 1) {
			$case = "succes";
		} else {
			$case = "fail";
		}
		
		// After saving redirect to overview page
		header ( "Location: /admin/categorie/" . $case );
		exit ();
	}
}

// Get option
if (isset ( $option )) {
	$option = $option;
} else {
	$option = isset ( $_GET ["option"] ) ? $_GET ['option'] : 'new';
}

// Check which option is to be used.
if ($option == 'new') {
	$id = '';
	$name = '';
	$discription = '';
	$published = " selected";
	$unpublished = '';
} elseif ($option == 'edit') {
	$id = isset ( $_GET ["id"] ) ? $_GET ['id'] : '';
	// Get data from database where cat_id=$id
	$db = connectToDatabase ();
	$sth = $db->prepare ( "SELECT * FROM category WHERE cat_id=:id" );
	$sth->bindParam ( ":id", $id );
	$sth->execute ();
	$result = $sth->fetchAll ( PDO::FETCH_ASSOC );
	
	// Set data from database into variables
	foreach ( $result as $row ) {
		$name = $row ["name"];
		$discription = $row ["discription"];
		$published = $row ["published"];
	}
	// Check if category is published
	if ($published == 1) {
		$published = " selected";
		$unpublished = '';
	} else {
		$published = '';
		$unpublished = " selected";
	}
} elseif ($option == 'renew') {
	// Check if article is published
	if ($published == 1) {
		$published = " selected";
		$unpublished = '';
	} else {
		$published = '';
		$unpublished = " selected";
	}
	// set option back to the originaloption
	$option = $originaloption;
}

if($option2=='renew'){
?>
<div class="message_error">
	<p><?php echo $fouttext; ?></p>
</div>
<?php }?>
<form action="" method="post">
	<input name="option" type="hidden" value="<?php echo $option; ?>" /> <input
		name="id" type="hidden" value="<?php echo $id; ?>" />
	<table class="simple-table">
		<tr>
			<td colspan="2">Naam:</td>
		</tr>
		<tr>
			<td colspan="2"><input name="name" type="text" size="80"
				value="<?php echo $name; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2">Beschrijving:</td>
		</tr>
		<tr>
			<td colspan="2"><input name="discription" type="text" size="80"
				value="<?php echo $discription; ?>" /></td>
		</tr>
		<tr>
			<td>Status:</td>
			<td><select name="published">
					<option value="1" <?php echo $published; ?>>Gepubliceerd</option>
					<option value="0" <?php echo $unpublished; ?>>Gedepubliceerd</option>
			</select></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Opslaan" name="submit" />
				<input type="button" name="Cancel" value="Annuleren"
				onclick="window.location = '/admin/categorie' " /></td>
		</tr>
	</table>

</form>
