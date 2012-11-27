<?php
include 'mysql.inc.php';
function selectquery($sql,$db){
    $sth=$db->prepare($sql);
    $sth->execute();
    $result= $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
?>
