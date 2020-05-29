<?php

$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "minhalista";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
mysqli_set_charset($conn, "utf8");

if(!$conn) {
    die("A conexão com o banco de dados falhou: ".mysqli_connect_error());
}

?>
