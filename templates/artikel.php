<?php

if(isset($_GET['id'])) {    
    $dbh = connectToDatabase();
    $sth = $dbh->prepare("SELECT * FROM article WHERE ID=:id");
    $sth->bindParam(":id", $_GET['id']);
    $sth->execute();
    
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($res as $row) {
	$date = date("d-m-Y H:i:s", strtotime($row['date_added']));
	$datee = date("d-m-Y H:i:s", strtotime($row['date_edited']));
	
?>

<div class="artikel" id="title">
    <h2><?php echo $row['title'] ?></h2>
</div>
<div class="artikel" id="dates">
    <i>Aangemaakt: <?php echo $date ?></i>
    <?php if($date != $datee) {?>
    <i><br/>Laatst gewijzigd: <?php echo $datee ?></i>
    <?php } ?>
</div>
<div class="artikel" id="text">
    <?php echo $row['text'] ?>
</div>

<?php
}}
?>