<?php

if(isset($_GET['id'])) {    
    $dbh = connectToDatabase();
    $sth = $dbh->prepare("SELECT * FROM article WHERE ID=:id");
    $sth->bindParam(":id", $_GET['id']);
    $sth->execute();
    
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($res as $row) {
?>

<div class="artikel" id="title">
    <h2><?php echo $row['title'] ?></h2>
</div>
<div class="artikel" id="dates">
    <i>Aangemaakt: <?php echo $row['date_added'] ?></i>
    <?php if($row['date_added'] != $row['date_edited']) {?>
    <i><br/>Laatst gewijzigd: <?php echo $row['date_edited'] ?></i>
    <?php } ?>
</div>
<div class="artikel" id="text">
    <?php echo $row['text'] ?>
</div>

<?php
}}
?>