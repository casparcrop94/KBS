<?php
//include the database locations
include DOCROOT . 'inc/mysql.inc.php';
//connecting to the database
$dbh = connectToDatabase();
//include the SQL query execution
include DOCROOT . 'inc/functions.inc.php';
//the sql statement
$sql = (" SELECT service_id, servicename, pph, avgcost FROM `services` ");
//retrieving the query results
$result = selectratequery($sql, $dbh);
?>
<div id="rates">
    <!--Displaying the table-->
    <table id="ratetable">

	<!--Displaying the tablehead-->
        <thead>
            <tr>
                <th class="thrate">Dienst</th>
                <th class="thrate">Uurtarief</th>
                <th class="thrate">Geschatte prijs</th>
                <th class="thrate">Wijzig tarieven</th>
            </tr>
        </thead>

        <!--Displaying the tablebody-->
        <tbody>
	    <?php
	    //displaying all the values
	    foreach ($result as $row) {
		?>
    	    <tr>
    		<!--displays the service name-->
    		<td class="ratetablecollumn"><?php echo($row["servicename"]) ?></td>
    		<!--displays the price per hour-->
    		<td class="ratetablecollumn"><?php echo($row["pph"]) ?></td>
    		<!--displays the average cost-->
    		<td class="ratetablecollumn"><?php echo($row["avgcost"]) ?></td>
    		<!--displays the link to change the rates-->
    		<td class="ratetablecollumn"><a href="<?php echo '/admin/wijzigtarief/'.$row['service_id'] ?>">Wijzig</a></td>
    	    </tr>
<?php } ?>
        </tbody>

    </table>
</div>