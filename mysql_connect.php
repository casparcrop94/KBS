<?php

function connectToDatabase($user, $pass, $server, $port, $database) {
    $db = new mysqli($server, $user, $pass, $database, $port);

    return $db;
}

?>
