<!--
Auteur: Maarten Engels
-->

<?php
$zoekwoord = $_GET["zoekwoord"]; //geeft "Undefined index: zoekwoord..." aan als pagina niet gestart vanaf zoekresultatentestpagina.php
//Include files to connect with database
include DOCROOT . 'inc/mysql.inc.php';
//Sla verbinding op in $db
$dbh = connectToDatabase();
$sth = $dbh->prepare(" SELECT * 
                            FROM article 
                            WHERE title LIKE '%$zoekwoord%'
                            OR text LIKE '%$zoekwoord%' 
                            ");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
?>


    <!-- De foreach() om de zoekresultaten te laten zien voor het $zoekwoord -->
    <?php foreach ($result as $row) { ?>
        
    <div class="zoekresultaat">
	<h3><?php echo $row["title"]; ?></h3>
	<p><?php echo strip_tags($row["text"]); ?></p>
	<a href="/article/<?php echo $row["ID"]; ?>">Lees meer</a>
    </div>
        
    <?php } ?>
</table



