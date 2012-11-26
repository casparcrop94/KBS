<?php
include DOCROOT . 'inc/mysql.inc.php';
$dbh= connectToDatabase();
 if(isset($_GET['action']))
 {
    if($_GET['action']=='delete')
    {
        $id= $_GET['ID'];
        $sth = $dbh->prepare ("SELECT file FROM downloads WHERE ID=:id");
        $sth->bindParam(":id", $id, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        
        if(unlink(DOCROOT . '/uploads/' . $result["file"] ))
        {
            $sth = $dbh->prepare("DELETE FROM downloads Where ID=:id");
            $sth->bindParam(":id", $id, PDO::PARAM_STR);
            $sth->execute();
        }
        
 }
 }
if(isset($_POST['submit']))
{
    $file= $_FILES["file"]["name"];
    $size= ($_FILES["file"]["size"] / 1024); 
  
    $allowedExts = array("jpg", "jpeg", "gif", "png", "doc", "docx", "pdf", "pjpeg", "xls", "txt", "pptx", "ppt", "xml", "xlsx");
    $extension = end(explode(".", $_FILES["file"]["name"]));
        if ($_FILES["file"]["size"] < 8000000
            && in_array($extension, $allowedExts))
            {
                if ($_FILES["file"]["error"] > 0)
                {
                    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                }
            else
            {
            // echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            // echo "Type: " . $_FILES["file"]["type"] . "<br />";
            // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists( DOCROOT . 'uploads/' .$_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " bestaat al. ";
      }
    else
      {
      if(move_uploaded_file($_FILES["file"]["tmp_name"], DOCROOT . 'uploads/' .$_FILES["file"]["name"]))
      {
          //db
          $sth = $dbh->prepare ("INSERT INTO downloads (file, size) 
                                 VALUES('$file' , '$size')");            
            $sth->execute();
      }
         
      }
            }
        }
    else
    {
        echo "Invalid file";
    }
} 


 $sth = $dbh->prepare ("SELECT * FROM downloads");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC); 
 ?>

<html>
<body>
<table border="1">
    <tr>    
        <th> Downloads </th>    
        <th> Grootte </th>
    </tr>
       <?php foreach($result as $row) {
?>
    <tr>
        <td> <?php echo ($row["file"]); ?> </td>
        <td> <?php echo ($row["size"]); ?> kb </td>
        <td> <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&ID=".$row["ID"] . "&file=".$row["file"]?>">Verwijder</a></td>
    </tr>    
        
 <?php } ?>       
     </table>
    
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
enctype="multipart/form-data">
<label for="file">Bestand uploaden:</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Upload" />
</form>
</body>
</html>
