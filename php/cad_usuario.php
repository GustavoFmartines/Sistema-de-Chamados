<?php
//Recendo os dados do formulario
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmarSenha = $_POST['confirmarSenha'];
$celular = $_POST['celular'];
$setor = $_POST['setor'];


//incluir o arquivo de conexão
include 'conexao.php';


//instrução sql para inserir os dados
$insert = "INSERT INTO tb_usuario VALUE (null, '$nome', '$email ', '$senha','$celular','$setor')";

//executar a instrução sql dentro do banco utilizando a função query()

$query = $conexao->query($insert);

if ($query == true) {
    echo "<script> alert('Usiário cadastrado com sucesso'); window.href = '../index.html'</script>"
}



?>