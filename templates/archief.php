<?php
$array = array();

for($i=0;$i<= 2100;$i++){
    
    $array[$year] = array();
    
    for($i=0;$i<= 2100;$i++){
	
	$array[$year][$month] = array();
	
	for($i=0;$i<= 2100;$i++){
	    
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
