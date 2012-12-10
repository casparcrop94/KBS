<!--
Auteur: Maarten Engels
-->

<?php
$zoekwoord = $_GET["zoekwoord123"];
//geeft "Undefined index: zoekwoord..." aan als pagina niet gestart vanaf zoekresultatentestpagina.php
//Include files to connect with database
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * 4;
//Sla verbinding op in $db
$dbh = connectToDatabase();
$sth = $dbh->prepare(" SELECT * 
                            FROM article 
                            WHERE title LIKE '%$zoekwoord%'
                            OR text LIKE '%$zoekwoord%' 
			    LIMIT $start_from, 4
                            ");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- De foreach() om de zoekresultaten te laten zien voor het $zoekwoord -->
<?php
if (count($result) > 0) {
    foreach ($result as $row) {
	?>

	<div class="zoekresultaat">
	    <h3><?php echo $row["title"]; ?></h3>
	    <p><?php echo strip_tags($row["text"]); ?></p>
	    <a href="/article/<?php echo $row["ID"]; ?>">Lees meer</a>
	</div>

	<?php
    }
} else {
    echo 'Geen zoekresultaten gevonden, probeer iets anders.';
}
?>

<?php
$sth = $dbh->prepare("SELECT * 
                            FROM article 
                            WHERE title LIKE '%$zoekwoord%'
                            OR text LIKE '%$zoekwoord%' ");
$sth->execute();
$result = $sth->fetchall(PDO::FETCH_ASSOC);
$total_records = count($result);
$total_pages = ceil($total_records / 4);

for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='/zoekresultaten/" . $i . "'>" . $i . "</a> ";
};
?>
