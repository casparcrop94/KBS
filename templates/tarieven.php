<?php
$dbh = connectToDatabase();
//query   
$sql = (" SELECT servicename, pph, avgcost FROM `services` WHERE pph IS NOT NULL ");
//execution and result
$result = selectquery($sql, $dbh);
?>
<!-- Explaination of rates -->

    <div id="ratewarning">
        <p>De prijzen die hier staan zijn geschatte prijzen voor gesprekken of diensten.
            <br/>Ook het uurtarief wordt hierbij weergeven</p>
    </div>
        <!--Table-->
        <table>
            <!--Tablehead-->
            <thead>
                <tr>
                    <th class="thrate">Dienst</th>
                    <th class="thrate">Uurtarief</th>
                    <th class="thrate">Geschatte prijs</th>
                </tr>
            </thead>
            <!--Tablebody-->
            <tbody>
		<?php
		//displaying all the values
		foreach ($result as $row) {
		    ?>
    		<tr>
    		    <!--Display servicename -->
    		    <td class="ratetablecollumn"><?php echo($row["servicename"]) ?></td>
    		    <!--Display price per hour -->
    		    <td class="ratetablecollumn"><?php echo($row["pph"]) ?></td>
    		    <!--Display average cost-->
    		    <td class="ratetablecollumn"><?php echo($row["avgcost"]) ?></td>
    		</tr>
		<?php } ?>
            </tbody>
        </table>
