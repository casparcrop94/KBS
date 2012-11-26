php_value auto_prepend_file "inc/config.inc.php"

Options +FollowSymlinks
RewriteEngine on

RewriteBase /

RewriteCond %{SCRIPT_FILENAME} !-f
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteRule (.*) index.php?p=$1 [QSA,L]