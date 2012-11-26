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

//Get content of added article
function get_content($id)
{
    $db = connectToDatabase();
    $sth = $db->prepare ("SELECT * FROM article WHERE ID=$id");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
       
    return $result;
}

?>