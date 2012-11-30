<?php
include 'mysql.inc.php';
$dbh=  connectToDatabase();
function selectratequery($sql,$dbh){
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result= $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
?>
