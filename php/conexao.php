<?php
//Informações para conectar no SGBD
$server = "localhost";
$user = "root";
$password = "admin";
$database = "sui_db";


$conexao = new mysqli($server, $user, $password, $database);


if ($conexao == false) {
   echo "Falha na conexão!";
 
}


?>