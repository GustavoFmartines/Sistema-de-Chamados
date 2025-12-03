<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Criar Chamado</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/chamado.css">
  <script src="https://kit.fontawesome.com/c0f408d1cc.js" crossorigin="anonymous"></script> <!-- fontawesome -->
</head>
<body>
  <div class="app-root">
    <aside class="sidebar">
      <button class="btn-back" aria-label="Voltar" title="Voltar" onclick="window.location.href='home.php'">
        <i class="bi bi-arrow-left"></i>
      </button>
      <nav class="menu">
        <ul>
          <li class="menu-item" onclick="window.location.href='home.php'">
            <i class="fa-solid fa-house"></i><span>Home</span>
          </li>
          <li class="menu-item active" onclick="window.location.href='chamado.php'">
            <i class="fa-solid fa-plus"></i><span>Novo chamado</span>
          </li>
          <li class="menu-item" onclick="window.location.href='lista_de_chamados.php'">
            <i class="fa-solid fa-list"></i><span>Lista de chamados</span>
          </li>
        </ul>
      </nav>
    </aside>
    <div class="main-area">
      <div class="form-card" role="form" aria-labelledby="form-title">
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

        <form action="php/cad_chamados.php" method="post" class="chamado-form" novalidate>

        
          <div class="row actions">
            <button type="submit" class="btn-submit">Enviar</button>
          </div>

        <div class="divider" aria-hidden="true"></div>

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
                  <option value="<?php echo $resultado['id_categoria']?>"> <?php echo $resultado['nm_categoria']?></option>
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
                  <option value="<?php echo $resultado['id_urgencia']?>"><?php echo $resultado['nm_urgencia']?></option>
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
          <div class="divider" aria-hidden="true"></div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
