<!-- AUTEUR: RICHARD VAN DEN HOORN -->
<?php
$dbh = connectToDatabase();

$sql="SELECT * FROM services WHERE Published=1"; // Haal alle diensten uit de database

$res = selectquery($sql, $dbh)
?>

        <table class="diensten">
            <?php 
            	$i=0;
                foreach($res as $row) {  // Loop door SQL-resultaten
                	if($i==0){
                		echo("<tr>");
                	}
                    echo("<td class=cell style='cursor: pointer' onclick=window.location='artikel/".$row['article_id']."' >");
                    echo("<div class=title><h2>".$row['servicename']."</h2></div>");
                    echo("<br /><div class=discription>".$row['servicetext']."</div>");
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
