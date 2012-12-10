<?php
include DOCROOT . 'inc/mysql.inc.php';
include DOCROOT . 'tarieven2/selectquery.php';
$dbh=  connectToDatabase();
?>
        <!-- Explaination of rates -->
        <div id="rates">
            <div id="ratewarning">
                <p>De prijzen die hier staan zijn geschatte prijzen voor gesprekken of diensten.
                <br/>Ook het uurtarief wordt hierbij weergeven</p>
            </div>
            <div id="ratetable">
                <?php
                    //query   
                    $sql= (" SELECT servicename, pph, avgcost FROM `services` WHERE pph IS NOT NULL ");
                    //execution and result
                    $result=selectratequery($sql,$dbh);
                ?>
                <!--Tabel-->
                <table>
                    <!--Tablehead-->
                    <thead  id="ratethead">
                        <tr>
                            <th id="rateth">Dienst</th>
                            <th id="rateth">Uurtarief</th>
                            <th id="rateth">Geschatte prijs</th>
                        </tr>
                    </thead>
                    <!--Tablebody-->
                    <tbody>
                        <?php
                            //displaying all the values
                            foreach ($result as $row) {
                                echo('<tr>');
                                echo('<td id="ratetablecollumn">'.$row["servicename"].'</td>');
                                echo('<td id="ratetablecollumn">'.$row["pph"].'</td>');
                                echo('<td id="ratetablecollumn">'.$row["avgcost"].'</td>');
                                echo('</tr>');
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
