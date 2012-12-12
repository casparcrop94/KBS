<!--
Auteur: Maarten Engels
	s1058387
	ICTM1E
-->

<?php
//Het woord dat ingevuld wordt in de zoekbalk wordt opgehaald en gebruikt als attribuut.
$zoekwoord = $_POST["zoekwoord123"];

//Zelfafhandelend formulier waarbij er naar resultatenpagina 1 gaat als er nog geen paginanummer is opgegeven
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * 4;

//Het verbinden met de database wordt in dit stuk tekst gedaan, tevens wordt de SQL-querie hier uitgevoerd voor de resultaten.
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

<?php 
echo "U heeft gezocht op $zoekwoord ";
//De functie( foreach() ) om de zoekresultaten te laten zien voor het attribuut $zoekwoord, als het aantal resultaten groter is dan 0 wordt er geen foutmelding weergegeven
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
    //Als er geen overeenkomende zoekresultaten gevonden zijn, komt deze foutmelding er te staan
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
