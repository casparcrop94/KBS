<?php
include DOCROOT . 'inc/mysql.inc.php';
include DOCROOT . 'tarieven2/selectquery.php';
$dbh=  connectToDatabase();
?>
<link rel="stylesheet" type="text/css" href=<?php echo(DOCROOT . "/styles/rates.css")?>/>
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
                <table border="1">
                    <!--Tablehead-->
                    <thead>
                        <tr>
                            <th>Dienst</th>
                            <th>Uurtarief</th>
                            <th>Geschatte prijs</th>
                        </tr>
                    </thead>
                    <!--Tablebody-->
                    <tbody>
                        <?php
                            //displaying all the values
                            foreach ($result as $row) {
                                echo('<tr>');
                                echo('<td>'.$row["servicename"].'</td>');
                                echo('<td>'.$row["pph"].'</td>');
                                echo('<td>'.$row["avgcost"].'</td>');
                                echo('</tr>');
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>