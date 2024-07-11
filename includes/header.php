<header>
    <a href="dashboard.php" style="color: #0060B6; text-decoration: none;"><h1>Trello Simples</h1></a>

    <?php
        session_start();
        $isLogado = isset($_SESSION['codUsuario']);
        $tipo = $_SESSION['usuarioTipo'] ?? null;
        $nomeUsuario = $_SESSION['nome'] ?? "faça login!";
        echo '<h4>~ Bem Vindo(a) ' . $nomeUsuario . '~</h4>';
    ?>

    <nav>
        <?php
            if($isLogado && !is_null($tipo) && $tipo == "ADM") {
                echo '<a href="">Gerenciar Contas</a>';
            }

            if($isLogado) {
                echo '<a href="">Dashboard</a>';
                echo '<a href="./../paginas/logout.php">Logout</a>';
            } else {
                echo '<a href="./../paginas/criarUsuario.php">Criar uma Conta</a>';
            }
        ?>
    </nav>
    
</header>

