<?php

function selectquery($sql, $db) {
    $sth = $db->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function sortArticles($dbh) {
    if (!$dbh) {
	$dbh = connectToDatabase();
    }

    $sth = $dbh->query("SELECT ID,title,date_added FROM article WHERE published='1' ORDER BY date_added");
    $sth->execute();

    $res = $sth->fetchAll(PDO::FETCH_ASSOC);

    $tbl = Array(
	1 => "Januari",
	2 => "Februari",
	3 => "Maart",
	4 => "April",
	5 => "Mei",
	6 => "Juni",
	7 => "Juli",
	8 => "Augustus",
	9 => "September",
	10 => "Oktober",
	11 => "November",
	12 => "December"
    );
    $revTbl = Array();

    for ($i = 1; $i <= count($tbl); $i++) {
	$revTbl[$tbl[$i]] = $i;
    }
    
    $str = "";

    $years = Array();
    
	foreach ($res as $row) {
	$date = new DateTime($row['date_added']);
	$year = $date->format("Y");
	$month = $date->format("L");
	
	
	$months = Array();
	
	if(!isset($years[$year])) {
	    $years[$year] = 1;
	    
	    echo("<a rel=\"".$year."\" id=\"fold-year\" href=\"#\"> >".$year." </a>");
	    
	}
	
    }


    return $str;
}

function connectToDatabase() {
    $db = new PDO("mysql: host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_DATABASE, DB_USER, DB_PASS);

    return $db;
}

function isAjax()
{
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
	{
		return true;
	}
	else {
		return false;
	}
}

function getNextMonth()
{
}