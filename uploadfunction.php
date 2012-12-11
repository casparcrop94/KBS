<?php

function upload($files) {
    $file = $files["file"]["name"];
    $size = ($files["file"]["size"] / 1024);
    // bestanden die upgeload mogen worden.
    $allowedExts = array("jpg", "jpeg", "gif", "png", "doc", "docx", "pdf", "pjpeg", "xls", "txt", "pptx", "ppt", "xml", "xlsx");
    $explode = explode(".", $files["file"]["name"]);
    $extension = end($explode);
    // de size van hoe groot het bestand maximaal mag worden in kb.
    if ($files["file"]["size"] < 8000000
	    && in_array($extension, $allowedExts)) {
	if ($files["file"]["error"] > 0) {
	    echo "Return Code: " . $files["file"]["error"] . "<br />";
	} else {
	    // echo "Upload: " . $files["file"]["name"] . "<br />";
	    // echo "Type: " . $files["file"]["type"] . "<br />";
	    // echo "Size: " . ($files["file"]["size"] / 1024) . " Kb<br />";
	    // echo "Temp file: " . $files["file"]["tmp_name"] . "<br />";
	    // upload
	    if (file_exists(DOCROOT . 'uploads/' . $files["file"]["name"])) {
		echo $files["file"]["name"] . " bestaat al. ";
	    } else {
		if (move_uploaded_file($files["file"]["tmp_name"], DOCROOT . 'uploads/' . $files["file"]["name"])) {
		    //db
		    $sth = $dbh->prepare("INSERT INTO downloads (file, size) 
                                 VALUES('$file' , '$size')");
		    $sth->execute();
		}
	    }
	}
    } else {
	echo "Invalid file";
    }
}
?>

