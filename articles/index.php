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

function ophalencategorieen()
{
    $db = connectToDatabase();
    $sth = $db->prepare ("SELECT * FROM category");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
?>
<form action="opslaanartikel.php" method="post">
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
    <input name="date_added" type="text" value="<?php echo mysql_query("SELECT CURDATE()"); ?>" />
    
</form>

</body>
</html>