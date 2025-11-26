<?php

$email = $_POST['email'];//dados
$senha = $_POST['senha'];


include 'conexao.php'; //conexao com o banco mysql

$select = "SELECT * FROM tb_user WHERE email = '$email'"; //verifica se é a pessoa

$query = $conexao->query($select); //todos dados estão aqui

$resultado = $query->fetch_assoc(); //fetch_assoc pega o primeiro registro digitado, coloca tudo na var e transforma em uma array 

print_r($_POST);
print_r($resultado);

$email_banco = $resultado['email'];
$senha_banco = $resultado['senha'];

// if ($email == $email_banco && $senha == $senha_banco){
//     session_start(); //validação p entrar
//     $_SESSION['id_user'] = $resultado['id_user'];
//     header('location: home.html');
// }
// else {
//     echo "<script>alert('Usuarios ou senha inválida'); window.location.href = '../index.html'</script>";
// }

?>