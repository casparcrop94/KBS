<?php

include('/inc/mysql.inc.php');

$dbh = connectToDatabase();

$sth = $dbh->query("SELECT * FROM services"); // Haal alle artikelen uit de database
$sth->execute();
$res = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

        <table width="700">
            <?php 
            	$i=0;
                foreach($res as $row) {  // Loop door SQL-resultaten
                	if($i==0){
                		echo("<tr>");
                	}
                    echo("<td width=50% onclick=window.location='".$row['article_id']."'; style='cursor: pointer';>");
                    echo("<div class=title>".$row['servicename']."</div>");
                    echo("<br /><div class=discription>".$row['servicetext']."</div>");
                    echo("<br /><div class=image><img src=".$row['image']."/></div>");
                    echo("</td>");
                    if($i==1){
                    	echo("</tr>");
                    }
                    $i++;
                    if($i==2){
                    	$i=0;
                    }
                } 
            ?>
        </table>
