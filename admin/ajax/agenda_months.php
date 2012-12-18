<?php
/*
 * @author Robert-John van Doesburg
 * @klas ICT M1 E1
 * @projectGroup SSJ
 */
include DOCROOT . 'inc/functions.inc.php';

if(isAjax())
{
	$result = getAgendaMonth($_GET['month'], $_GET['year']);
	echo json_encode($result);
	
}