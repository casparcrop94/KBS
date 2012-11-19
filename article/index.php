<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
//Include files to connect with database
include dirname(__FILE__) . '/../inc/config.inc.php';
include DOCROOT . 'inc/mysql.inc.php';
//include function.php
include DOCROOT . 'article/function.php';

//Check if form is submitted
if(isset($_POST['submit']))
{
    //Get data from form and set data into variable.
	$title = $_POST['title'];
    $category = $_POST['category'];
    $date_added = $_POST['date_added'];
    $date_edited = $_POST['date_edited'];
    $text = $_POST['text'];
	$published = '1';
    
	if($option=='new')
	{
		//Insert data into database.
		mysql_query("INSERT INTO article (cat_id, date added, date_edited, titel, text, published) VALUES ('$category','$date_added','$date_edited','$title', '$text', '$published')");
	}
	elseif($option
}

//Get option and id
$option=$_GET['option'];
$id=$_GET['id'];

//Check which option is to be used.
if($option=='new'){
	$date_added=date;
	$date_edited=datetoday();
}
elseif($option=='edit'){
	$date_added=date_added($id);
	$date_edited=datetoday();
}


?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input name="title" type="text" size="80" />
    <select name="category">
    	<?php 
		$cat = getcategory();
		foreach($cat as $row)
		{
			print("<option value=".$row["cat_id"].">"); 
			print($row["naam"]."</option>"); 
		}
        ?>
	</select>
    <input name="date_added" type="text" value="<?php echo $date_added; ?>" />
    <input name="date_edited" type="text" value="<?php echo $date_edited; ?>" />
    <textarea name="text" rows="4" cols="20">
    </textarea>
    <input type="submit" value="Opslaan" name="submit" /> 
	
</form>


</body>
</html>