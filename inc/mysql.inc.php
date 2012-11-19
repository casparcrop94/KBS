<?php



/*$link = mysql_connect(DB_HOST, DB_USER, DB_PASS);

mysql_select_db(DB_DATABASE, $link);

mysql_set_charset('utf-8', $link);*/

function connectToDatabase() {
    $db = new PDO("mysql: host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_DATABASE, DB_USER, DB_PASS);
    
    return $db;
}

?>
