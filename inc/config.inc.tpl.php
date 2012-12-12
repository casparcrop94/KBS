<?php
define('DOCROOT', dirname(__FILE__) . '/../');
define('SERVERPATH', 'http://kbs.nl');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_PORT', '');
define('DB_DATABASE', 'kbs');

define('EMAIL_KLANT', 'maartendeboy@hotmail.com');
date_default_timezone_set('Europe/Amsterdam');
setlocale(LC_ALL, array('Dutch_Netherlands', 'Dutch', 'nl_NL', 'nl', 'nl_NL.UTF-8'));