<?php
/*
 * @author Robert-John van Doesburg
 * @klas ICT M1 E1
 * @projectGroup SSJ
 */
include DOCROOT . 'inc/functions.inc.php';

if(isAjax())
{
	if($_POST['option'] == 'delete_apointment')
	{
		$db = connectToDatabase();
		$sth = $db->prepare("DELETE FROM `agenda` WHERE `id` = :id ");
		$parameters = array(
			':id' => $_POST['id'],
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