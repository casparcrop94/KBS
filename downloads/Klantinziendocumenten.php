<?php
include DOCROOT . 'inc/mysql.inc.php';
$dbh= connectToDatabase();
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
        <td> <a href=http://kbs.nl/uploads/<?php echo ($row["file"]); ?> >Download</a> </td>
    </tr>    
        
 <?php } ?>       
     </table>
   
    

</body>
</html>
