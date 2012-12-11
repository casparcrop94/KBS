<?php
function upload($_FILES)
{
    $file = $_FILES["file"]["name"];
    $size = ($_FILES["file"]["size"] / 1024);
    // bestanden die upgeload mogen worden.
    $allowedExts = array("jpg", "jpeg", "gif", "png", "doc", "docx", "pdf", "pjpeg", "xls", "txt", "pptx", "ppt", "xml", "xlsx");
    $explode = explode(".", $_FILES["file"]["name"]);
    $extension = end($explode);
    // de size van hoe groot het bestand maximaal mag worden in kb.
    if ($_FILES["file"]["size"] < 8000000
	    && in_array($extension, $allowedExts)) {
	if ($_FILES["file"]["error"] > 0) {
	    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	} else {
	    // echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	    // echo "Type: " . $_FILES["file"]["type"] . "<br />";
	    // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	    // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
	    // upload
	    if (file_exists(DOCROOT . 'uploads/' . $_FILES["file"]["name"])) {
		echo $_FILES["file"]["name"] . " bestaat al. ";
	    } else {
		if (move_uploaded_file($_FILES["file"]["tmp_name"], DOCROOT . 'uploads/' . $_FILES["file"]["name"])) {
		    //db
		    $sth = $dbh->prepare("INSERT INTO downloads (file, size) 
                                 VALUES('$file' , '$size')");
		    $sth->execute();
		}
	    }
	}
	
    }else {
	echo "Invalid file";
    }
}
?>

