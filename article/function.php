<?php
//Function to load the categorys from database
function getcategory()
{
    $db = connectToDatabase();
    $sth = $db->prepare ("SELECT * FROM category");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
//Get date of today
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
//Get date of today
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