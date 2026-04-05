<?php
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="evento_db";
$db_table_name="clientes";
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if (!$conn) {
    die("error de conexion: ".mysqli_connect_error());
}
?>