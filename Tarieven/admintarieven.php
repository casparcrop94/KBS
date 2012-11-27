<?php
include 'mysql.inc.php';
?>
        <div>
            <?php
                //query and its execution
                    //connection
                
                    //sql statement
                $sql= (" SELECT service_id, servicename, pph, avgcost FROM `services` ");
                    //executing the statement and retrieving results
                $result=selectquery($sql,$db);
            ?>
            <!--Displaying the table-->
            <table border="1">
                <!--Displaying the tablehead-->
                <thead>
                    <tr>
                        <th>Dienst</th>
                        <th>Uurtarief</th>
                        <th>Geschatte prijs</th>
                        <th>Wijzig tarieven</th>
                    </tr>
                </thead>
                <!--Displaying the tablebody-->
                <tbody>
                    <?php
                        //displaying all the values
                        foreach ($result as $row) {
                            echo('<tr>');
                            //displays the service name
                            echo('<td>'.$row["servicename"].'</td>');
                            //displays the price per hour
                            echo('<td>'.$row["pph"].'</td>');
                            //displays the average cost
                            echo('<td>'.$row["avgcost"].'</td>');
                            //displays the link to change the rates
                            echo('<td><a href="wijzigtarief.php?id='.$row['service_id'].'">Wijzig</a></td>');
                            echo('</tr>');
                    } ?>
                </tbody>
            </table>
        </div>