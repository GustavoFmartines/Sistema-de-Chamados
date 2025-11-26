<?php
$nome = $_POST['usuario']; //dados
$email = $_POST['email'];
$senha = $_POST['senha'];
$conf_senha = $_POST['conf_senha'];
$celular = $_POST['celular'];
$setor = $_POST['setor'];


include 'conexao.php'; //conexao

$insert = "INSERT INTO tb_user VALUE (null, '$nome', '$email', '$senha', '$celular', '$setor', default)"; //insere

$query = $conexao->query($insert);

if ($query == true){
    echo "<script>alert('Usuarios cadastrados com sucesso'); window.location.href = '../index.html'</script>";
}

?>