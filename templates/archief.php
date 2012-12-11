<?php
$datetoday=date("Y");
$array = array();

for ($i = $datetoday; $i >= 2012; $i--) {
    $year=$i;
    echo ($year);
    $array[$year] = array();

    for ($i = 12; $i >= 1; $i--) {

	$array[$year][$month] = array();

	for ($i = 0; $i <= 2100; $i++) {

	    $array[$year][$month][] = $rowArtikel;
	}
    }
}
?>

<div id="Archives">

    <div id="Archivetitle">
	<h1>Archief</h1>
    </div>

    <div id="Archive">

    </div>

</div>
