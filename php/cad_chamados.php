<?php
//Recendo os dados do formulario
$tipo = $_POST['tipo'];
$categoria = $_POST['categoria'];
$urgencia = $_POST['urgencia'];
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];


//incluir o arquivo de conexão
include 'conexao.php';


//instrução sql para inserir os dados
$insert = "INSERT INTO tb_chamado VALUE (null, $tipo, $categoria, $urgencia, $titulo, $descricao)";

//executar a instrução sql dentro do banco utilizando a função query()

$query = $conexao->query($insert);

if ($query == true) {
    echo "<script> alert('Usiário cadastrado com sucesso'); history.back() </script>";
}


?>