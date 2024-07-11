<?php

    require_once "../classes/Status.php";
    require_once '../config/banco.php';

    $codTarefa = $_GET['cod'] ?? null;
    $novoComentario = $_POST['novoComentario'] ?? null;

    if (is_null($codTarefa)) {
        die("Nenhuma tarefa selecionada");
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
        <?php // $listaComentarios = pegarComentariosPorCodigo($codTarefa); ?>
        <p> o comentario vai aqui - <em> [nome do usuario - 07/07/2023] </em> </p>
        <p> o comentario vai aqui - <em> [nome do usuario - 07/07/2023] </em> </p>
        <p> o comentario vai aqui - <em> [nome do usuario - 07/07/2023] </em> </p>
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