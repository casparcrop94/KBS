<?php

require_once('config.inc.php');

/*$link = mysql_connect(DB_HOST, DB_USER, DB_PASS);

mysql_select_db(DB_DATABASE, $link);

mysql_set_charset('utf-8', $link);*/

function connectToDatabase() {
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE, $port);

    return $db;
}

?>
