<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include dirname(__FILE__) . '/../inc/config.inc.php';
include DOCROOT . 'inc/mysql.inc.php';
if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $category = $_POST['category'];
    $date_added = $_POST['date_added'];
    $date_edited = $_POST['date_edited'];
    $text = $_POST['text'];
    

    mysql_query("INSERT INTO article (cat_id, date added, date_edited, titel, text, published) VALUES ('$category','$date_added','$date_edited','$title', '$text', '$published')");
}

function ophalencategorieen()
{
    $db = connectToDatabase();
    $sth = $db->prepare ("SELECT * FROM category");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function datumvandaag()
{
    $db = connectToDatabase();
    $sth = $db->prepare ("SELECT NOW()");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
       
    foreach($result as $row)
        {
            $datum=$row["NOW()"]; 
	}
    return $datum;
}

?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input name="title" type="text" size="80" />
    <select name="category">
    	<?php 
		$cat = ophalencategorieen();
		foreach($cat as $row)
		{
			print("<option value=".$row["cat_id"].">"); 
			print($row["naam"]."</option>"); 
		}
        ?>
	</select>
    <input name="date_added" type="text" value="<?php echo datumvandaag(); ?>" />
    <input name="date_edited" type="text" value="<?php echo datumvandaag(); ?>" />
    <textarea name="text" rows="4" cols="20">
    </textarea>
    <input type="submit" value="Opslaan" name="submit" />    
</form>


</body>
</html>