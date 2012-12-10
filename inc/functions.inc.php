<?php

include(DOCROOT.'/inc/mysql.inc.php');

function selectratequery($sql, $db) {
	$sth = $db->prepare($sql);
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

date_default_timezone_set('Europe/Amsterdam');

function sortArticles($dbh) {
    if(!$dbh) {
	$dbh = connectToDatabase();
    }
    
    $sth = $dbh->query("SELECT ID,title,date_added FROM article WHERE published='1' ORDER BY date_added LIMIT 0,10");
    $sth->execute();

    $res = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    $tbl = Array(
	1=>"Januari",
	2=>"Februari",
	3=>"Maart",
	4=>"April",
	5=>"Mei",
	6=>"Juni",
	7=>"Juli",
	8=>"Augustus",
	9=>"September",
	10=>"Oktober",
	11=>"November",
	12=>"December"
    );
    $revTbl = Array();
    
    for($i=0;$i<=count($tbl);$i++) {
	$revTbl[$tbl[$i]] = $i;
    }
    
    foreach($res as $row) {
	$date = $row['date_added'];
	
    }
    
    
    return $tbl;
}