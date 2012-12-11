php_value auto_prepend_file "inc\config.inc.php"

Options +FollowSymlinks
RewriteEngine on

RewriteBase /

RewriteCond %{SCRIPT_FILENAME} !-f
RewriteCond %{SCRIPT_FILENAME} !-d

RewriteRule ^zoekresultaten/([0-9]+)$ index.php?p=zoekresultaten&page=$1 [NC]
RewriteRule ^artikel/([0-9]+)$ index.php?p=artikel&id=$1 [NC]
RewriteRule ^([a-zA-Z]+)$ index.php?p=$1 [NC]