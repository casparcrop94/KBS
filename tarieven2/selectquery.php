<<<<<<< HEAD
<?php
function selectratequery($sql,$dbh){
    $sth=$dbh->prepare($sql);
    $sth->execute();
    $result= $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
?>
=======
<?php
function selectquery($sql,$db){
    $sth=$db->prepare($sql);
    $sth->execute();
    $result= $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
?>
>>>>>>> tarieven aangepast alweer
