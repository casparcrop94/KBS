<?php
$dbh=  connectToDatabase();
$sql=





$datetoday=date("Y");
$array = array();

for ($iy = $datetoday; $iy >= 2012; $iy--) {
    
    $year=$iy;
    
    echo ($year);
    
    $array[$year] = array();

    for ($im = 12; $im >= 1; $im--) {
	$month=$im;
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
