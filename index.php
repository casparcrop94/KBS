<?php 
session_start();
ob_start();

//Set error rporting
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

//include '/inc/config.inc.php';

$page = isset($_GET['page']) ? $_GET['page']:'home';
var_dump($_GET['page']  );
if(!file_exists(DOCROOT . '/templates/' . $page . '.php'))
{
	$page = 'home';
}
?>
<html>
	<head>
		<title>Juridische hulp</title>
		<link rel="stylesheet" type="text/css" href="/styles/default.css" />
		
		<script type="text/javascript" src="/scripts/jquery.1.8.3.js"></script>
		<script type="text/javascript" src="/scripts/default.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="header-image"></div>
				<div id="menu"></div>
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
?>