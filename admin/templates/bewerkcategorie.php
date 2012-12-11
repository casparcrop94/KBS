<!-- AUTEUR: RICHARD VAN DEN HOORN -->
<?php

//Check if form is submitted
if(isset($_POST['submit']))
{
    //Get data from form and set data into variable.
    $option = $_POST['option'];
	$id = $_POST['id'];
	
	$name = $_POST['name'];	
	$discription = $_POST['discription'];
	$published = $_POST['published'];
	
	if($option=='new')
	{
		//Insert new article
		$db = connectToDatabase();
		$sth = $db->prepare ("INSERT INTO category (name, discription, published) 
		VALUES (:name,:discription,:published)");
		$sth->bindParam(":name", $name);
		$sth->bindParam(":discription", $discription);
		$sth->bindParam(":published", $published);
		$result=$sth->execute();
	}
	elseif($option=='edit')
	{
		//Edit an article
		$db = connectToDatabase();
		$sth = $db->prepare ("UPDATE category SET name=:name, discription=:discription, published=:published WHERE cat_id=:id");
		$sth->bindParam(":name", $name);
		$sth->bindParam(":discription", $discription);
		$sth->bindParam(":published", $published);
		$sth->bindParam(":id", $id);
		$result=$sth->execute();
	}
	
	//Check if category succesfully saved
	if($result==1)
	{
		$case="succes";
	}
	else
	{
		$case="fail";
	}
	
	//After saving redirect to overview page
	header("Location: /admin/categorie/".$case);
	exit;

}

//Get option
$option= isset($_GET["option"])?$_GET['option']:'new';

//Check which option is to be used.
if($option=='new'){
	$name =''; 
	$discription ='';
	$published =" selected";
	$unpublished ='';
}
elseif($option=='edit'){
	$id= isset($_GET["id"])?$_GET['id']:'';
	//Get data from database where cat_id=$id
	$db = connectToDatabase();
    $sth = $db->prepare ("SELECT * FROM category WHERE cat_id=:id");
	$sth->bindParam(":id", $id);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
	
	//Set data from database into variables
	foreach($result as $row)
	{
		$name =$row["name"]; 
		$discription =$row["discription"];
		$published = $row["published"];
	}
	//Check if category is published
	if($published==1)
	{
		$published=" selected";
		$unpublished='';
	}
	else
	{
		$published='';
		$unpublished=" selected";
	}
}


?>

<form action="" method="post">
<input name="option" type="hidden" value="<?php echo $option; ?>" />
<input name="id" type="hidden" value="<?php echo $id; ?>" />	
<table>
	<tr>
    	<td colspan="2">
        	Naam:
        </td>
    </tr>
    <tr>
        <td colspan="2">
        	<input name="name" type="text" size="80" value="<?php echo $name; ?>"/>
        </td>
    </tr>
    <tr>
    	<td colspan="2">
        	Beschrijving:
        </td>
    </tr>
	<tr>
    	<td colspan="2">
        	<input name="discription" type="text" size="80" value="<?php echo $discription; ?>"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Status:
        </td>
        <td>
        	<select name="published">
    			<option value="1"<?php echo $published; ?>>Gepubliceerd</option>
        		<option value="0"<?php echo $unpublished; ?>>Gedepubliceerd</option>
   			 </select>
        </td>
    </tr>
    <tr>
    	<td colspan="2">
        	<input type="submit" value="Opslaan" name="submit" />
            <input type="button" name="Cancel" value="Annuleren" onclick="window.location = '/admin/categorie' " />
        </td>
    </tr>
</table> 
	
</form>
