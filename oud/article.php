<?php
//Include files to connect with database
include DOCROOT . 'inc/mysql.inc.php';
//Sla verbinding op in $db
$db = connectToDatabase();

//Check if form is submitted
if(isset($_POST['submit']))
{
    //Get data from form and set data into variable.
    $option = $_POST['option'];
	$id = $_POST['id'];
	$title = $_POST['title'];	
	$category = $_POST['category'];
    $date_added = $_POST['date_added'];
    $date_edited = $_POST['date_edited'];
    $text = $_POST['text'];
	$published = $_POST['published'];
	
	//Format date to databaseformat
	$date_added = date('Y-m-d H:i:s', strtotime($date_added));
    $date_edited = date('Y-m-d H:i:s', strtotime($date_edited));
	
	if($option=='new')
	{
		//Insert new article
		$db = connectToDatabase();
		$sth = $db->prepare ("INSERT INTO article (cat_id, date_added, date_edited, title, text, published) 
		VALUES (:category,:date_added,:date_edited,:title, :text,:published)");
		$sth->bindParam(":category", $category);
		$sth->bindParam(":date_added", $date_added);
		$sth->bindParam(":date_added", $date_added);
		$sth->bindParam(":date_edited", $date_edited);
		$sth->bindParam(":title", $title);
		$sth->bindParam(":text", $text);
		$sth->bindParam(":published", $published);
		$result=$sth->execute();
	}
	elseif($option=='edit')
	{
		//Edit an article
		$db = connectToDatabase();
		$sth = $db->prepare ("UPDATE article SET cat_id=:category,date_added=:date_added,date_edited=:date_edited:,
		title=:title,text=:text,published=:published WHERE ID=:id");
		$sth->bindParam(":category", $category);
		$sth->bindParam(":date_added", $date_added);
		$sth->bindParam(":date_added", $date_added);
		$sth->bindParam(":date_edited", $date_edited);
		$sth->bindParam(":title", $title);
		$sth->bindParam(":text", $text);
		$sth->bindParam(":published", $published);
		$sth->bindParam(":id", $id);
		$result=$sth->execute();
	}
	
	//If article is saved succesfully, user get a message
	if($result==1){
		$case="succes";
	}
	else{
		$case="fail";
	}
	
	//After saving redirect to overview page
	header("Location: index.php?case=".$case);
}

//Get option
$option= isset($_GET["option"])?$_GET['option']:'new';

//Check which option is to be used.
if($option=='new'){
	$id='';
	$date_added=date('d-m-Y H:i:s');
	$date_edited=date('d-m-Y H:i:s');
	$title =''; 
	$category ='';
	$text = '';
	$published =" selected";
	$unpublished ='';
}
elseif($option=='edit'){
	//Get the ID from the URL
	$id= isset($_GET["id"])?$_GET['id']:'';
	
	//Get content from database where ID=$id
	$sth = $db->prepare ("SELECT * FROM article WHERE ID=$id");
    $sth->execute();
    $content = $sth->fetchAll(PDO::FETCH_ASSOC);
	
	//Set the data into variables
	foreach($content as $row)
	{
		$title =$row["title"]; 
		$category =$row["cat_id"];
		$date_added =$row["date_added"];
		$date_added = date('d-m-Y H:i:s', strtotime($date_added));
		$date_edited =date('d-m-Y H:i:s');
		$text = $row["text"];
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
//Get the different categorys
$sth = $db->prepare ("SELECT * FROM category");
$sth->execute();
$categorys = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script type="text/javascript" src="<?php echo DOCROOT . 'scripts/tiny_mce/tiny_mce.js';?>"></script>
	<script type="text/javascript" src="<?php echo DOCROOT . 'scripts/tiny_mce/tiny_mce.init.js';?>"></script>
</head>

<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input name="option" type="hidden" value="<?php echo $option; ?>" />
<input name="id" type="hidden" value="<?php echo $id; ?>" />	
<table>
	<tr>
    	<td colspan="2">
        	Titel:
        </td>
    </tr>
    <tr>
        <td colspan="2">
        	<input name="title" type="text" size="80" value="<?php echo $title; ?>"/>
        </td>
    </tr>
    <tr>
    	<td width="150">
        	Categorie:
        </td>
        <td>
        	<select name="category">
    		<?php 
						//Print the categorys
			foreach($categorys as $row)
			{
				$id = $row["cat_id"];
				$name = $row["name"];
				//Check which category is to be selected
				if($id==$category)
				{
					$selected=" selected";
				}
				else
				{
					$selected='';
				}
				print("<option value=$id".$selected.">"); 
				print($name."</option>"); 
			}
        	?>
            </select>
        </td>
    </tr>
    <tr>
    	<td>
        	Aanmaakdatum:
        </td>
        <td>
        	<input name="date_added" type="text" value="<?php echo $date_added; ?>"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Laatst bijgewerkt op:
        </td>
        <td>
        	<input name="date_edited" type="text" value="<?php echo $date_edited; ?>"/>
        </td>
    </tr>
    <tr>
    	<td colspan="2">
        	Text:
       	</td>
    </tr>
    <tr>
        <td colspan="2">
        	<textarea name="text" rows="20" cols="70"><?php echo $text; ?></textarea>
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
            <input type="button" name="Cancel" value="Annuleren" onclick="window.location = 'index.php' " />
        </td>
    </tr>
</table> 
	
</form>


</body>
</html>