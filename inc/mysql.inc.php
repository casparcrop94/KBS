<?php

function connectToDatabase() {
    $db = new PDO("mysql: host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_DATABASE, DB_USER, DB_PASS);
    
    return $db;
}