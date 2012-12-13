php_value auto_prepend_file "inc\config.inc.php"

Options +FollowSymlinks
RewriteEngine on

RewriteBase /

RewriteCond %{SCRIPT_FILENAME} !-f
RewriteCond %{SCRIPT_FILENAME} !-d

RewriteRule ^login$ /admin/login.php [NC]
RewriteRule ^logout$ /admin/login.php?action=logout [NC]
RewriteRule ^downloads/delete/([0-9]+)$ /admin/index.php?p=downloads&action=delete&ID=$1 [NC]
RewriteRule ^downloads/([0-9]+)$ admin/index.php?p=downloads&page=$1 [NC]
RewriteRule ^([a-zA-Z]+)$ /admin/index.php?p=$1 [NC]
