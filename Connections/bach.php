<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_bach = "localhost";
$database_bach = "bachillerato";
$username_bach = "bachillerato";
$password_bach = "123456";
$bach = mysql_pconnect($hostname_bach, $username_bach, $password_bach) or trigger_error(mysql_error(),E_USER_ERROR); 
?>