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

    $years = Array();
    
    foreach ($res as $row) {
	$date = new DateTime($row['date_added']);
	$month = $date->format("F");
	$year = $date->format("Y");
	
	if(!isset($years[$year])) {
	    $years[$year] = Array();
	}
	
    }


    return $tbl;
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

function getAgendaMonth($month = false, $year = false)
{
	
	if(!$month)
	{
		$month = date('m');
	}
	if(!$year)
	{
		$year = date('Y');
	}
	
	
	$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	$total_weeks = ceil($total_days / 7);
	
	$first_day = date("N", mktime(0, 0, 0, $month, 1, $year));
	$cal = array();
	$curr_day = 1;
	$continue = false;
	
	for($week = 0; $week <= $total_weeks; $week++)
	{
		$cal[$week] = array();
		for($day = 1; $day <= 7; $day++)
		{
			$cal[$week][$day] = '';
			if($day == $first_day && $week == 0)
			{
				$cal[$week][$day] = 1;
				$continue = true;
				$curr_day++;
			}
			else if($continue && $curr_day <= $total_days)
			{
				$cal[$week][$day] = $curr_day;
				$curr_day++;
			}
		}
	}
	
	$data = '';
	foreach($cal as $week){
		$data .= '<tr>';
			foreach($week as $date => $day)
			{
				$data .= '<td>' . $day . '</td>';
			}
		$data .= '</tr>';
	}
	setlocale(LC_ALL, array('Dutch_Netherlands', 'Dutch', 'nl_NL', 'nl', 'nl_NL.UTF-8'));
	$result = array(
		'data' => $data,
		'month' => $month,
		'month_name' => ucFirst(strftime('%B',mktime(0,0,0, $month, 1, $year))),
		'year' => $year
	);
	
	return $result;
	
}