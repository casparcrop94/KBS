<!--Author: Caspar Crop-->
<?php
//connection to database
$dbh = connectToDatabase();
//retreiving current year
$datetoday = date("Y");
?>

<div id="Archives">

    <div id="Archivetitle">
	<h1>Archief</h1>
    </div>

    <div id="Archive">
	<ul>
	    <?php
	    for ($iy = $datetoday; $iy >= 2012; $iy = $iy - 1) {
		$dyear = $iy;
		echo ("<div id='archiveyear'><h2>" . $dyear . "</h2>");

		for ($im = 12; $im >= 1; $im = $im - 1) {
		    $dmonth = $im;
		    $result = retreivearchive($dyear, $dmonth, $dbh);
		    if (count($result) != 0) {
			echo("<div id='archivemonth'><h3>" . archivemonths($dmonth) . "</h3>");

			foreach ($result as $row) {
			    ?>
			    <li> <a href="<?php echo '/admin/actualiteit/'.$row['ID']?>"> <?php echo $row['title']; ?></a> </li>
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
