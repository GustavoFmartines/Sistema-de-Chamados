<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Criar Chamado</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/chamado.css">
</head>
<body>
  <div class="app-root">
    <aside class="sidebar">
      <button class="btn-back" aria-label="Voltar" title="Voltar" onclick="window.location.href='home.html'">
        <i class="bi bi-arrow-left"></i>
      </button>
      <nav class="menu">
        <ul>
          <li class="menu-item" onclick="window.location.href='home.html'">
            <i class="bi bi-house-fill"></i><span>home</span>
          </li>
          <li class="menu-item active">
            <i class="bi bi-plus-lg"></i><span>Criar um novo chamado</span>
          </li>
          <li class="menu-item">
            <i class="bi bi-card-list"></i><span>Lista de chamados</span>
          </li>
        </ul>
      </nav>
    </aside>
    <main class="main-area">
      <article class="form-card" role="form" aria-labelledby="form-title">
        <?php
          session_start();
          if(isset($_SESSION['id_user'])){
            $nome_usuario = $_SESSION['id_user'];

            echo "Olá, ".$_SESSION['nm_user'];
          }
          else{
            echo "<script>alert('Você não está logado!'); history.back();  </script>";
          }
        ?>
        <h1 id="form-title" class="card-title">Descreva o incidente ou a requisição</h1>

        <div class="divider" aria-hidden="true"></div>

        <form action="php/cad_chamados.php" method="post" class="chamado-form" novalidate>

          <div class="row">
            <label for="tipo">Tipo</label>
            <select class="#" id="tipo" name="tipo">
              <?php
                include 'php/conexao.php';
                $select = "SELECT * FROM tb_tipo";
                $query = $conexao->query($select);
                while ($resultado = $query->fetch_assoc()) { ?>
                  <option value="<?php echo $resultado['id_tipo']?>"><?php echo $resultado['nm_tipo']?></option>
                <?php }
              ?>
            </select>
          </div>


          <div class="row">
            <label for="categoria">Categoria</label>
            <select class="#" id="categoria" name="categoria">
              <?php
                include 'php/conexao.php';
                $select = "SELECT * FROM tb_categoria";
                $query = $conexao->query($select);
                while ($resultado = $query->fetch_assoc()) { ?>
                  <option value="id_categoria"><?php echo $resultado /*continuar*/['nm_categoria']?></option>
                <?php }
              ?>
            </select>
          </div>



          <div class="row">
            <label for="urgencia">Urgência</label>
            <select class="#" id="urgencia" name="urgencia">
              <?php
                include 'php/conexao.php';
                $select = "SELECT * FROM tb_urgencia";
                $query = $conexao->query($select);
                while ($resultado = $query->fetch_assoc()) { ?>
                  <option value="id_urgencia"><?php echo $resultado['nm_urgencia']?></option>
                <?php }
              ?>
            </select>
          </div>



          <div class="row">
            <label for="titulo">Título</label>
            <input id="titulo" name="titulo" type="text" placeholder="----------">
          </div>




          <div class="row">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" placeholder="Descreva aqui..." rows="8"></textarea>
          </div>






          <div class="row actions">
            <button type="submit" class="btn-submit">Enviar</button>
          </div>
        </form>
      </article>
    </main>
  </div>
</body>
</html>
