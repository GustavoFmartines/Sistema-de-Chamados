<?php

$email = $_POST['email'];//dados
$senha = $_POST['senha'];


include 'conexao.php'; //conexao com o banco mysql

$select = "SELECT * FROM tb_user WHERE email = '$email'"; //verifica se é a pessoa

$query = $conexao->query($select); //todos dados do bd estão aqui

$resultado = $query->fetch_assoc(); //fetch_assoc pega o primeiro registro digitado, coloca tudo na var e transforma em uma array 

$email_banco = $resultado['email'];
$senha_banco = $resultado['senha'];

if ($email == $email_banco && $senha == $senha_banco){
    session_start(); //validação p entrar
    $_SESSION['id_user'] = $resultado['id_user'];
    $_SESSION['nm_user'] = $resultado['nm_user'];

    header('location: ../home.php');
}

else {
    echo "<script>alert('Usuarios ou senha inválida'); history.back(); </script>";
}



?>