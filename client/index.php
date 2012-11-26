<?php 
session_start();
ob_start();

//Set error rporting
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

if(!isset($_SESSION['client']) && $_SESSION['client'] != true)
{
	header('location:/client/login');
}

$page = isset($_GET['p']) ? $_GET['p']:'home';

if(!file_exists(DOCROOT . 'client/templates/' . $page . '.php'))
{
	$page = 'home';
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Juridische hulp - Cli&euml;nt gedeelte</title>
		<link rel="stylesheet" type="text/css" href="/styles/client.css" />
		
		<script type="text/javascript" src="/scripts/jquery.1.8.3.js"></script>
		<!-- <script type="text/javascript" src="/scripts/client.js"></script> -->
	</head>
	<body>
		<div id="wrapper">
			<div id="content">
				<div id="content">
					<?php include DOCROOT . 'client/templates/' . $page . '.php';?>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</body>
</html>
<?php 
ob_end_flush();
?>