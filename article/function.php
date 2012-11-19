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
//Get date of added article
function date_added($id)
{
    $db = connectToDatabase();
    $sth = $db->prepare ("SELECT date_added FROM article WHERE ID=$id");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
       
    foreach($result as $row)
        {
            $date=$row["date_added"]; 
	}
    return $date;
}

?>