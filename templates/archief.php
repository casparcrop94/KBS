<?php
$dbh=  connectToDatabase();
$datetoday=date("Y");
$array = array();

function retreivearchive($dyear,$dmonth,$dbh){
    $sql="SELECT date_edited, title, text, published FROM article WHERE (cat_id=10 AND published=1)AND (date_edited LIKE '%".$dyear."-".$dmonth."-%') ORDER BY date_edited";
    $sth=$dbh->prepare($sql);
    $sth->execute ();
    $result = $sth->fetchAll ( PDO::FETCH_ASSOC );
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
for ($iy = $datetoday; $iy >= 2012; $iy=$iy-1) {
	$dyear=$iy;
    	echo ("<div id='archiveyear'><h1>".$dyear."</h2></br>");

	for ($im = 12; $im >= 1; $im=$im-1) {
	    $dmonth=$im;
	    $result=  retreivearchive($dyear, $dmonth, $dbh);
	    if(count($result)!=NULL){
	    echo("<div id='archivemonth'><h2>".$dmonth."</h2></br>");

	    $result=retreivearchive($dyear, $dmonth, $dbh);
	    foreach ($result as $row) {?>
	    <li> <a href="/ar"><?php echo $row['title']; ?></a> </li>
	    <?php }
	    echo '</div>';
	    echo '</div>';
	    }
	    
        }
}
?>
	</ul>
    </div>

</div>
