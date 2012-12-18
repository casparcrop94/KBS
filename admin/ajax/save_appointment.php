<?php
/*
 * @author Robert-John van Doesburg
 * @klas ICT M1 E1
 * @projectGroup SSJ
 */
include DOCROOT . 'inc/functions.inc.php';

if(isAjax())
{
	if($_POST['option'] == 'add_apointment')
	{
		$db = connectToDatabase();
		$sth = $db->prepare("INSERT INTO `agenda` (`naam`, `start_datum`) VALUES (:naam, :start_datum)");
		$parameters = array(
			':naam' => $_POST['name'],
			':start_datum' => $_POST['date'], 
			);
		$result = $sth->execute($parameters);
		if($result)
		{
			echo 'true';
		}
		else {
			echo 'false';
		}
	}
}