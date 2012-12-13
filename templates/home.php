<!--Author: caspar crop-->
<?php
$dbh=  connectToDatabase();
?>
<div>
    <div id="home-upper">
	<div id="home-about">
	    Duis neque nisi, dapibus sed mattis quis, rutrum et accumsan. 
	    Suspendisse nibh. Suspendisse vitae magna eget odio amet mollis 
	    justo facilisis quis. Sed sagittis mauris amet tellus gravida 
	    lorem ipsum dolor sit amet consequat blandit lorem ipsum dolor 
	    sit amet consequat sed dolore
	</div>
	<div id="home-links">
	    <ul>
		<li>facebook</li>
		<li>twitter</li>
		<li>linkedin</li>
		<li>nogiets</li>
		<li>nog eens nog iets</li>
	    </ul>
	</div>
    </div>
    
    <div id="home-news">
	<?php 
	$result=  retreivenewsarticle($dbh);
	foreach($result as $row){
	    echo'<div id="home-article">';
	    echo('<h3>'.$row["title"].'</h3>');
	    echo($row["TEXT"]);
	    echo'</div>';
	}
	?>
    </div>
    
    
    
</div>