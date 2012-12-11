<?php
session_start();
ob_start();

//Set error rporting
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

include DOCROOT . 'inc/functions.inc.php';

$page = isset($_GET['p']) ? str_replace('/', '', $_GET['p']) : 'home';

if (!file_exists(DOCROOT . 'templates/' . $page . '.php')) {
    header('HTTP/1.0 404 Not Found');
    $page = '404';
}

$articles = sortArticles(connectToDatabase());
$months = Array(
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
?>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Juridische hulp</title>
	<link rel="stylesheet" type="text/css" href="/styles/default.css" />

	<script type="text/javascript" src="/scripts/jquery.1.8.3.js"></script>
	<script type="text/javascript" src="/scripts/default.js"></script>
    </head>
    <body>
	<div id="wrapper">
	    <div id="header">
		<div id="header-image">
		    <a href="/">
			<img src="/images/header.png" alt="header"/>
		    </a>
		</div>
		<div id="menu">
		    <ul>
			<li><a href="/home">Home</a></li>
			<li><a href="/bedrijven">Bedrijven</a></li>
			<li><a href="/particulier">Particulier</a></li>
			<li><a href="/diensten">Diensten</a></li>
			<li><a href="/downloads">Downloads</a></li>
			<li><a href="/contact">Contact</a></li>
			<li><a href="/tarieven">Tarieven</a></li>
		    </ul>
		</div>
	    </div>
	    <div id="content">
		<div id="left-content" class="<?php echo $page; ?>">
		    <?php include '/templates/' . $page . '.php'; ?>
		</div>
		<div id="right-content">
		    <form id="search-form" action="zoekresultaten" method="post">
			<input type="text" name="zoekwoord123" placeholder="Zoeken" />
			<input type="image" src="/images/searcher.png" value="" />
		    </form>
		</div>
	    </div>
	    <div id="footer"></div>
	</div>
    </body>
</html>
<?php
ob_end_flush();