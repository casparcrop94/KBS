<?php

function selectratequery($sql, $db) {
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

    $years = Array();
    
    foreach($res as $row) { 
	$date = new DateTime($row['date_added']);
	$year = $date->format("Y");
	$month = $date->format("F");
	$smonth = $date->format("m");
	
	if(!isset($years[$year])) {
	    $years[$year] = Array();
	    
	    if(!isset($years[$year][$month])) {
		$years[$year][$month] = Array();
	    }
	}
	
	$years[$year][$month][$row['ID']] = $row['title']; 
    }
    
    foreach($years as $key=>$val) { 
	echo("<a rel=\"".$year."\" id=\"fold-year\" class=\"no-underline zipper\" href=\"#\"> >".$year." </a>");
	echo("<ul id=".$year."><li>");
	
	foreach($val as $month=>$articles) {
	    echo("<a rel=\"".$year."-".$smonth."\" id=\"fold-month\" href=\"#\" class=\"no-underline zipper\"> ></a> ");
	    foreach($articles as $art=>$title) {
		echo("<a href=\"/artikel/".$art."\">".$title."</a>");
	    }
	}
    }
	    
	   // echo("<a rel=\"".$year."-".$smonth."\" id=\"fold-month\" href=\"#\" class=\"no-underline zipper\"> ></a> ");
	   // echo("<a href=\"/artikel/".$row2['ID']."\"");
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