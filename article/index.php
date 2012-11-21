<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
//Include files to connect with database
include DOCROOT . 'inc/mysql.inc.php';
//include function.php
include DOCROOT . 'article/function.php';

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
	
	$date_added = date('Y-m-d H:i:s', strtotime($date_added));
    $date_edited = date('Y-m-d H:i:s', strtotime($date_edited));
	
	if($option=='new')
	{
		//Insert new article
		$db = connectToDatabase();
		$sth = $db->prepare ("INSERT INTO article (cat_id, date_added, date_edited, title, text, published) 
		VALUES ('$category','$date_added','$date_edited','$title', '$text','$published')");
		$sth->execute();
	}
	elseif($option=='edit')
	{
		//Edit an article
		$db = connectToDatabase();
		$sth = $db->prepare ("UPDATE article SET 
								cat_id='$category',
								date_added='$date_added',
								date_edited='$date_edited',
								title='$title',
								text='$text',
								published='$published'
								WHERE ID=$id");
		$sth->execute();
	}
//header("Location: /index.php");
$option='new';
}

//Get option
$option= isset($_GET["option"])?$_GET['option']:'new';

//Check which option is to be used.
if($option=='new'){
	$date_added=date('d-m-Y H:i:s');
	$date_edited=date('d-m-Y H:i:s');
	$title =''; 
	$category ='';
	$text = '';
	$published =" selected";
	$unpublished ='';
}
elseif($option=='edit'){
	$id= isset($_GET["id"])?$_GET['id']:'';
	$content = get_content($id);
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
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input name="option" type="hidden" value="<?php echo $option; ?>" />
    <input name="id" type="hidden" value="<?php echo $id; ?>" />
	<input name="title" type="text" size="80" value="<?php echo $title; ?>"/>
    <select name="category">
    	<?php 
		$cat = getcategory();
		foreach($cat as $row)
		{
			$id = $row["cat_id"];
			$name = $row["name"];
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
    <input name="date_added" type="text" value="<?php echo $date_added; ?>"/>
    <input name="date_edited" type="text" value="<?php echo $date_edited; ?>"/>
    <textarea name="text" rows="4" cols="20"><?php echo $text; ?>
    </textarea>
    <select name="published">
    	<option value="1"<?php echo $published; ?>>Gepubliceerd</option>
        <option value="0"<?php echo $unpublished; ?>>Gedepubliceerd</option>
    </select>
    <input type="submit" value="Opslaan" name="submit" /> 
	
</form>


</body>
</html>