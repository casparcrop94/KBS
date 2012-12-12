<?php
$dbh = connectToDatabase();
$datetoday = date("Y");
$archive = array();

function archivemonth($dmonth){
$month= array();
$month[1]='Januari';
$month[2]='Februari';
$month[3]='Maart';
$month[4]='April';
$month[5]='Mei';
$month[6]='Juni';
$month[7]='Juli';
$month[8]='Augustus';
$month[9]='September';
$month[10]='Oktober';
$month[11]='November';
$month[12]='December';

return $month[$dmonth];
}


function retreivearchive($dyear, $dmonth, $dbh) {
    $sql = "SELECT date_edited, title, TEXT, published
	    FROM article
	    WHERE (cat_id =10 AND published =1)
		    AND (date_edited LIKE  '%$dyear-$dmonth-%')
	    ORDER BY date_edited";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
?>



<div id="Archives">

    <div id="Archivetitle">
	<h1>Archief</h1>
    </div>

    <div id="Archive">
	<ul>
	    <?php
	    for ($iy = $datetoday; $iy >= 2010; $iy = $iy - 1) {
		    $dyear = $iy;
		    $archive[$dyear]= array();
		    echo ("<div id='archiveyear'><h2>" . $dyear . "</h2>");
		
		for ($im = 12; $im >= 1; $im = $im - 1) {
		    $dmonth = $im;
		    $archive[$dyear][$dmonth]= array();
		    
		    
		    $result = retreivearchive($dyear, $dmonth, $dbh);
		    if (count($result) != 0) {
			echo("<div id='archivemonth'><h3>" .archivemonth($dmonth). "</h3>");

			foreach ($result as $row) {
			    ?>
			    <li> <a href="/ar"><?php echo $row['title']; ?></a> </li>
			<?php
			}
			echo '</div>';
		    }
		}
		echo '</div>';
	    }
	    ?>
	</ul>
    </div>

</div>
