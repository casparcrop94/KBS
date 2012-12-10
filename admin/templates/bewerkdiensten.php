<?php
//Sla verbinding op in $db
$db = connectToDatabase();

//Check if form is submitted
if(isset($_POST['submit']))
{
	//Get data from form and set data into variable.
    $option = $_POST['option'];
	$service_id = $_POST['service_id'];
	$servicename = $_POST['service_name'];	
	$servicetext = $_POST['servicetext'];
    $pph = $_POST['pph'];
    $avgcost = $_POST['avgcost'];
    $image = $_POST['image'];
    $article_id = $_POST['article_id'];
	$published = $_POST['published'];
	
	if($option=='new')
	{
		//Insert new service
		$sth = $db->prepare ("INSERT INTO services (servicename, servicetext, pph, avgcost, image, article_id,published) 
		VALUES (:servicename, :servicetext, :pph, :avgcost, :image, :article_id, :published)");
		$sth->bindParam(":servicename", $servicename);
		$sth->bindParam(":servicetext", $servicetext);
		$sth->bindParam(":pph", $pph);
		$sth->bindParam(":avgcost", $avgcost);
		$sth->bindParam(":image", $image);
		$sth->bindParam(":article_id", $article_id);
		$sth->bindParam(":published", $published);
		$result=$sth->execute();
	}
	elseif($option=='edit')
	{
		//Edit a service
		$sth = $db->prepare ("UPDATE services SET service_id=:service_id, servicetext=:servicetext, pph=:pph, avgcost=:avgcost, image=:image, article_id=:article_id, published=:published WHERE service_id=:service_id");
		$sth->bindParam(":service_id", $service_id);
		$sth->bindParam(":servicename", $servicename);
		$sth->bindParam(":servicetext", $servicetext);
		$sth->bindParam(":pph", $pph);
		$sth->bindParam(":avgcost", $avgcost);
		$sth->bindParam(":image", $image);
		$sth->bindParam(":article_id", $article_id);
		$sth->bindParam(":published", $published);
		$result=$sth->execute();
	}
	
	//If service is saved succesfully, user get a message
	if($result==1){
		$case="succes";
	}
	else{
		$case="fail";
	}
	
	//After saving redirect to overview page
	header("Location: /admin/diensten/".$case);
	exit;
}

//Get option
$option= isset($_GET["option"])?$_GET['option']:'new';

//Check which option is to be used.
if($option=='new'){
	$title='';
	$servicetext='';
	$pph='';
	$avgcost='';
	$image='';
	$published =" selected";
	$unpublished ='';
}
elseif($option=='edit'){
	//Get the ID from the URL
	$service_id= isset($_GET["id"])?$_GET['id']:'';
	
	//Get content from database where ID=$id
	$sth = $db->prepare ("SELECT * FROM services WHERE service_id=$service_id");
    $sth->execute();
    $content = $sth->fetchAll(PDO::FETCH_ASSOC);
	
	//Set the data into variables
	foreach($content as $row)
	{
		$title =$row["servicename"]; 
		$pph = $row["pph"];
		$avgcost = $row["avgcost"];
		$image = $row["image"];
		$article_id = $row["article_id"];
		$servicetext = $row["servicetext"];		
		$published = $row["published"];
	}
	//Check if article is published
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

function haalartikelenop(){
	$db = connectToDatabase();
	$sth = $db->prepare ("SELECT * FROM article WHERE cat_id=(SELECT cat_id FROM category WHERE name='Diensten')");
	$sth->execute();
	$articles = $sth->fetchAll(PDO::FETCH_ASSOC);
	
	return $articles;
}
?>

<form action="" method="post">
<input name="option" type="hidden" value="<?php echo $option; ?>" />
<input name="service_id" type="hidden" value="<?php echo $service_id; ?>" />	
<table>
	<tr>
    	<td colspan="2">
        	Titel:
        </td>
    </tr>
    <tr>
        <td colspan="2">
        	<input name="service_name" type="text" size="80" value="<?php echo $title; ?>"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Prijs per uur:
        </td>
        <td>
        	<input name="pph" type="text" value="<?php echo $pph; ?>"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Gemiddelde prijs:
        </td>
        <td>
        	<input name="avgcost" type="text" value="<?php echo $avgcost; ?>"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Afbeelding:
        </td>
        <td>
        	<!--  HIER MOET UPLOAD FUNCTIE KOMEN, SCHIET EENS OP ERIK -->
        	<input name="image" type="text" value="<?php echo $image; ?>"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Gelinkt artikel
        </td>
        <td>
        	<select name="article_id">
        	<?php 
        	$articles= haalartikelenop();
        	foreach($articles as $row){
        		
        		if($row['ID']==$article_id){
        			$selected='selected';
          		}
          		else{
          			$selected='';
          		}
        		print("<option value='".$row['ID']."'".$selected.">".$row['title']."</option>");
        	}
        	?>
   			 </select>
        </td>
    </tr>
    <tr>
    	<td colspan="2">
        	Text:
       	</td>
    </tr>
    <tr>
        <td colspan="2">
        	<textarea name="servicetext" rows="20" cols="70"><?php echo $servicetext; ?></textarea>
        </td>
    <tr />
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
            <input type="button" name="Cancel" value="Annuleren" onclick="window.location = '/admin/artikel' " />
        </td>
    </tr>
</table> 
	
</form>

<script type="text/javascript" src="<?php echo DOCROOT . 'scripts/tiny_mce/tiny_mce.js';?>"></script>
<script type="text/javascript" src="<?php echo DOCROOT . 'scripts/tiny_mce/tiny_mce.init.js';?>"></script>