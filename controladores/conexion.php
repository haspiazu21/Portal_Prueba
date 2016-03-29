<?php

// datos para la coneccion a mysql 
define('DB_SERVER', 'localhost');
define('DB_NAME', 'pedidos_maestro');
define('DB_USER', 'root');
define('DB_PASS', 'root');


$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS)or die("Problemas en la conexion");
mysql_select_db(DB_NAME, $con)or die("Problemas en la selección de la base de datos");
