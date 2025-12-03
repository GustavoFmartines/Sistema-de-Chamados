<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - SUI</title>
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c0f408d1cc.js" crossorigin="anonymous"></script> <!-- fontawesome -->
</head>
<body>

    <nav class="menu-lateral">
        <ul>
            <li><i class="fa-solid fa-house"></i><a href="home.php"> Home</a></li>
            <li><i class="fa-solid fa-plus"></i><a href="chamado.php"> Novo chamado</a></li>
            <li><i class="fa-solid fa-list"></i><a href="lista_de_chamados.php"> Lista de chamados</a></li>
            <li><i class="fa-solid fa-circle-question"></i><a href="faq.html"> FAQ</a></li>
            <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="index.html"> Sair</a></li>
        </ul>
    </nav>

    <main class="conteudo">
        <div class="topo">
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
            Home

        </div>

        <div class="area-central">
            <section class="caixa-chamados">
                <h2>Chamados</h2>
                <hr>
                <ul>
                    <li><a href="chamado.php">Novo</a></li>
                    <li>Em andamento (atribuído)</li>
                    <li>Em atendimento (planejado)</li>
                    <li><span class="status pendente"></span>Pendente</li>
                    <li><span class="status solucionado"></span>Solucionado</li>
                    <li>Fechado</li>
                    <li>Excluído</li>
                </ul>
            </section>

            <section class="caixa-lembretes">
                <h2>Lembretes Públicos</h2>
                <div class="caixa-conteudo"></div>
            </section>
        </div>
    </main>

</body>
</html>
