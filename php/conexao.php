<?php
//Informações para conectar no SGBD
$server = "localhost";
$user = "root";
$password = "root";
$database = "sistema_chamados";


$conexao = new mysqli($server, $user, $password, $database);


if ($conexao == false) {
   echo "Falha na conexão!";
 
}


?>