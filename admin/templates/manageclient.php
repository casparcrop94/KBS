<?php

if(isset($_GET['action'])) {
    if($_GET['action'] == "remove") { 
	$IDs = $_POST['id[]'];
	
    } elseif($_GET['action'] == "pwreset") {
	$IDs = $_POST['id[]'];
    }
} elseif($_GET['action'] == "edit") { 
    $id = $_GET['id'];
} else {
?>

peop

<?php
}
?>