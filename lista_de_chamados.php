<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Lista de Chamados — SUI</title>

  <!-- Fonte -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/c0f408d1cc.js" crossorigin="anonymous"></script> <!-- fontawesome -->

  <!-- CSS -->
  <link rel="stylesheet" href="css/lista_de_chamados.css">
</head>
<body>
  <div class="app">
    <!-- SIDEBAR -->
    <aside class="sidebar" aria-label="Menu lateral">
      <div class="sidebar-top">
        <div class="logo">SUI</div>
      </div>

      <nav class="menu">

        <a href="home.php" class="nav-item active">
          <span class="nav-ico"><i class="fa-solid fa-house"></i></span>
          <span class="nav-text">Home</span>
        </a>
        <a href="#" class="nav-item">
          <span class="nav-ico"><i class="fa-solid fa-plus"></i></span>
          <span class="nav-text">Novo chamado</span>
        </a>
        <a href="#" class="nav-item">
          <span class="nav-ico"><i class="fa-solid fa-list"></i></span>
          <span class="nav-text">Lista de chamados</span>
        </a>
        <a href="#" class="nav-item">
          <span class="nav-text"><i class="fa-solid fa-circle-question"></i> FAQ</span>
        </a>
      </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">
      <!-- PAGE TITLE -->
      <header class="page-header">
        <h1 class="page-title">Lista de Chamados</h1>
      </header>

      <!-- FILTERS -->
      <section class="filters">
        <form class="filters-form" role="search" aria-label="Filtros de chamados">
          <div class="form-row">
            <label class="field">
              <span class="label-text">Tipo</span>
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
            </label>

            <label class="field">
              <span class="label-text">Categoria</span>
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
            </label>

            <label class="field">
              <span class="label-text">Urgência</span>
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
            </label>

            <label class="search-field">
              <span class="label-text">Buscar</span>
              <input type="search" placeholder="Pesquisar por título ou ID" />
            </label>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Aplicar filtros</button>
            <button type="reset" class="btn btn-ghost">Limpar</button>
          </div>
        </form>
      </section>




      
      <!-- SUMMARY CARDS -->
      <!-- <section class="summary-cards">
        <div class="card small">
          <div class="card-title">Pendentes</div>
          <div class="card-value">12</div>
        </div>
        <div class="card small">
          <div class="card-title">Em andamento</div>
          <div class="card-value">7</div>
        </div>
        <div class="card small">
          <div class="card-title">Concluídos</div>
          <div class="card-value">254</div>
        </div>
      </section> -->



      
      <!-- TABLE -->
      <section class="table-wrap">
        <div class="table-card">
          <table class="calls-table" aria-label="Tabela de chamados">
            <thead>
              <tr>
                <th class="col-id">ID</th>
                <th class="col-title">Tipo</th>
                <th class="col-sector">Categoria</th>
                <th class="col-urgency">Urgência</th>
                <th class="col-status">Título</th>
                <th class="col-created">Descrição</th>
              </tr>
            </thead>

            <tbody>
                <?php
                    include 'php/conexao.php'; //conexao
                    $select = "SELECT *
                      from tb_tipo as t
                      inner join tb_chamado as ch
                      on ch.fk_tipo = t.id_tipo
                      inner join tb_categoria as c
                      on ch.fk_categoria = c.id_categoria
                      inner join tb_urgencia as u
                      on ch.fk_urgencia = u.id_urgencia"; 
                    $query = $conexao->query($select); //todos dados estão aqui
                    while ($resultado = $query->fetch_assoc()){
                        
                     ?>
                    
                <tr>
                    <th scope="row"># <?php echo $resultado['cd_chamado']?></th>
                    <td><?php echo $resultado['nm_tipo'] ?></td>
                    <td><?php echo $resultado['nm_categoria'] ?></td>
                    <td><?php echo $resultado['nm_urgencia'] ?></td>
                    <td><?php echo $resultado['titulo'] ?></td>
                    <td><?php echo $resultado['descricao'] ?></td>
                    <td><i class="fa-solid fa-trash-can"></i></td> 
                    <td><i class="fa-solid fa-user-pen"></i></td> 

                </tr>
                <?php } ?>


            </tbody>

            <tbody>


              <!-- Add more rows as needed -->
            </tbody>
          </table>

          <!-- Pagination -->
          <!-- <div class="pagination">
            <button class="page-btn" aria-label="Página anterior">‹</button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn" aria-label="Próxima página">›</button>
          </div> -->
        </div>
      </section>
    </main>
  </div>
</body>
</html>
