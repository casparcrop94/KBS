<?php 
session_start();
ob_start();

//Set error rporting
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

$page = isset($_GET['p']) ? str_replace('/', '', $_GET['p']):'home';

if(!file_exists(DOCROOT . 'templates/' . $page . '.php'))
{
	header('HTTP/1.0 404 Not Found');
	$page = '404';
}
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
				<div id="left-content">
					<?php include '/templates/' . $page . '.php';?>
				</div>
				<div id="right-content"></div>
			</div>
			<div id="footer"></div>
		</div>
	</body>
</html>
<?php
ob_end_flush();