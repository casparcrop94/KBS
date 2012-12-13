<!--Author: caspar crop-->
<?php
$dbh=  connectToDatabase();
?>
<div>
    <div id="home-upper">
	<div id="home-about">
	    Dit stukje is voor uitleg van het bedrijf
	</div>
	<div id="home-links">
	    Hier staan links naar andere sites / social media
	</div>
    </div>
    
    <div id="home-news">
	<?php 
	$result=  retreivenewsarticle($dbh);
	foreach($result as $row){
	    echo'<div id="home-article">';
	    echo($row['title']);
	    echo($row['TEXT']);
	    echo'</div>';
	}
	?>
    </div>
    
    
    
</div>