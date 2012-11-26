<?php 
session_start();
ob_start();

//Set error rporting
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

if(!isset($_SESSION['admin']) && $_SESSION['admin'] != true)
{
	header('location:/admin/login');
}

$page = isset($_GET['p']) ? $_GET['p']:'home';

if(!file_exists(DOCROOT . 'admin/templates/' . $page . '.php'))
{
	$page = 'home';
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Juridische hulp - Admin</title>
		<link rel="stylesheet" type="text/css" href="/styles/admin.css" />
		
		<script type="text/javascript" src="/scripts/jquery.1.8.3.js"></script>
		<script type="text/javascript" src="/scripts/admin.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="content">
				<div id="content">
					<?php include DOCROOT . 'admin/templates/' . $page . '.php';?>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</body>
</html>
<?php 
ob_end_flush();
?>