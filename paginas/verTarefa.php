<?php

    require_once "../classes/Status.php";
    require_once '../config/banco.php';

    $codTarefa = $_GET['cod'] ?? null;
    

    if (is_null($codTarefa)) {
        die("Nenhuma tarefa selecionada");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    { 
        session_start();
        $codUsuario = $_SESSION['codUsuario'] ?? null;
        echo $codUsuario;
        $novoComentario = $_POST['novoComentario'] ?? null;
        if(!is_null($novoComentario) && !is_null($codUsuario)) {
            adicionarComentario($codTarefa, $codUsuario, $novoComentario);
        }
    }
    
    $tarefa = pegarTarefaPorCodigo($codTarefa);
    $tituloPagina = "Tarefa $codTarefa - " . $tarefa['nome_tarefa'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tituloPagina ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <?php include_once "../includes/header.php"; ?>

    <main>
        <a href="dashboard.php"><button>← Voltar</button></a>
        <a href="editarTarefa.php?cod=<?=$codTarefa?>"><button> Editar Tarefa ✏️ </button></a>

        <!-- bloco tarefa -->
        <h2> <?= $tarefa['nome_tarefa'] ?> </h2>
        <p> <?= $tarefa['descricao'] ?> </p>
        <p>Status: <?= Status::pegarStatus($tarefa['cod_status']) ?> </p>
        <p>Data de Vencimento:  <?php echo $tarefa['terminar_em'] ? $tarefa['terminar_em'] : 'Não defincodo'; ?>  </p>
        <!-- fim bloco tarefa -->

        <hr>

        <!-- bloco comentarios -->
        <h3>Comentários</h3>
        <?php 
            $listaComentarios = pegarComentariosPorCodigo($codTarefa);
            
            for($i = 0 ; $i < count($listaComentarios); $i++) {
                $comentario = $listaComentarios[$i];
                $comentarioText = $comentario["texto"];
                $comentarioUsuCod = $comentario["cod_usuario"];
                $usuarioNovo = pegarUsuarioPorCodigo($comentarioUsuCod);
                $comentarioUsuNome = $usuarioNovo["nome"];
                $horario = $comentario['criado_em'];


                echo '<p>' . $comentarioText . ' - <em> [' . $comentarioUsuNome . ' - ' . $horario . '] </em> </p>';

                session_start();
                if($_SESSION['usuarioTipo'] === "ADM") {
                    echo '<a href="./operacoes/deletarComentario.php?cod=' . $comentario['cod'] . '&' . 'tar=' .$codTarefa .'">Excluir Comentario</a>';
                }
            }
         
        ?>
        <!-- fim bloco comentarios -->

        
        <!-- bloco formulario -->
        <form method="post">
            <label>Adicionar Comentário: <textarea name="novoComentario" required></textarea></label>
            <button type="submit">Comentar</button>
        </form>
        <!-- fim bloco formulario -->

        <br><hr>

        <!-- bloco histórico -->
        <h3>Histórico da Tarefa</h3>
        <p> José da Silva - adicionou um comentário - <em> 2024-07-10 20:00:05</em></p>
        <p> José da Silva -  deletou um comentário  - <em> 2024-07-10 20:00:05</em></p>
        <!-- fim bloco histórico -->

    </main>

</body>

</html>