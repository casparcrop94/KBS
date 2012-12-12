<?php
include DOCROOT . 'inc/functions.inc.php';

if(isAjax())
{
	$result = getAgendaMonth($_GET['month'], $_GET['year']);
	echo json_encode($result);
	
}