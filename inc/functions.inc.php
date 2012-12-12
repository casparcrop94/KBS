<?php

function selectquery($sql, $db) {
	$sth = $db->prepare ( $sql );
	$sth->execute ();
	$result = $sth->fetchAll ( PDO::FETCH_ASSOC );
	return $result;
}

function sortArticles($dbh) {
	if (! $dbh) {
		$dbh = connectToDatabase ();
	}
	
	$sth = $dbh->query ( "SELECT ID,title,date_added FROM article WHERE published='1' ORDER BY date_added" );
	$sth->execute ();
	
	$res = $sth->fetchAll ( PDO::FETCH_ASSOC );
	
	$years = Array ();
	
	foreach ( $res as $row ) {
		$date = new DateTime ( $row ['date_added'] );
		$year = $date->format ( "Y" );
		$month = $date->format ( "F" );
		$smonth = $date->format ( "m" );
		
		if (! isset ( $years [$year] )) {
			$years [$year] = Array ();
			
			if (! isset ( $years [$year] [$month] )) {
				$years [$year] [$month] = Array ();
			}
		}
		
		$years [$year] [$month] [$row ['ID']] = $row ['title'];
	}
	
	foreach ( $years as $key => $val ) {
		echo ("<a rel=\"" . $year . "\" id=\"fold-year\" class=\"no-underline zipper\" href=\"#\"> >" . $year . " </a>");
		echo ("<ul id=" . $year . "><li>");
		
		foreach ( $val as $month => $articles ) {
			echo ("<a rel=\"" . $year . "-" . $smonth . "\" id=\"fold-month\" href=\"#\" class=\"no-underline zipper\"> ></a> ");
			foreach ( $articles as $art => $title ) {
				echo ("<a href=\"/artikel/" . $art . "\">" . $title . "</a>");
			}
		}
	}
	
	// echo("<a rel=\"".$year."-".$smonth."\" id=\"fold-month\" href=\"#\"
	// class=\"no-underline zipper\"> ></a> ");
	// echo("<a href=\"/artikel/".$row2['ID']."\"");
}

function connectToDatabase() {
	$db = new PDO ( "mysql: host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_DATABASE, DB_USER, DB_PASS );
	
	return $db;
}

function isAjax() {
	if (isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) && strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest') {
		return true;
	} else {
		return false;
	}
}

function getNextMonth() {

}

function upload($files) {
	$dbh = connectToDatabase ();
	$file = $files ["file"] ["name"];
	$size = ($files ["file"] ["size"] / 1024);
	// bestanden die upgeload mogen worden.
	$allowedExts = array ("jpg", "jpeg", "gif", "png", "doc", "docx", "pdf", "pjpeg", "xls", "txt", "pptx", "ppt", "xml", "xlsx" );
	$explode = explode ( ".", $files ["file"] ["name"] );
	$extension = end ( $explode );
	// de size van hoe groot het bestand maximaal mag worden in kb.
	if ($files ["file"] ["size"] < 8000000 && in_array ( $extension, $allowedExts )) {
		if ($files ["file"] ["error"] > 0) {
			echo "Return Code: " . $files ["file"] ["error"] . "<br />";
		} else {
			// echo "Upload: " . $files["file"]["name"] . "<br />";
			// echo "Type: " . $files["file"]["type"] . "<br />";
			// echo "Size: " . ($files["file"]["size"] / 1024) . " Kb<br />";
			// echo "Temp file: " . $files["file"]["tmp_name"] . "<br />";
			// upload
			if (file_exists ( DOCROOT . 'uploads/' . $files ["file"] ["name"] )) {
				echo $files ["file"] ["name"] . " bestaat al. ";
			} else {
				if (move_uploaded_file ( $files ["file"] ["tmp_name"], DOCROOT . 'uploads/' . $files ["file"] ["name"] )) {
					// db
					$sth = $dbh->prepare ( "INSERT INTO downloads (file, size) 
                                 VALUES('$file' , '$size')" );
					$sth->execute ();
				}
			}
		}
	} else {
		echo "Invalid file";
	}
}


?>