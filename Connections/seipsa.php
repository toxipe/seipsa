<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_seipsa = "localhost";
$database_seipsa = "seipsa_data";
$username_seipsa = "seipsa_data";
$password_seipsa = "W8pQdlMxSM";
$seipsa = mysql_pconnect($hostname_seipsa, $username_seipsa, $password_seipsa) or trigger_error(mysql_error(),E_USER_ERROR); 
?>