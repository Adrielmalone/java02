<?php
    
    require_once '../config/banco.php';

    $codTarefa = $_GET['cod'] ?? null;

    if (is_null($codTarefa)) {
        die("Nenhuma tarefa selecionada");
    } 

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !is_null($codTarefa)) {
        // ... add codigo para atualizar tarefa ...
        header("Location: verTarefa.php?cod=$codTarefa");
    }

    $tarefa = pegarTarefaPorCodigo($codTarefa);
    
    // ... add outras variaveis ... 
    $dataSemHorario = date('Y-m-d', strtotime($tarefa['criado_em']));
    
    function selectCheck($status, $value){
        echo ($status == $value) ? "selected" : "";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa - <?= $nomeTarefa ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <?php include '../includes/header.php'; ?>
    
    <main>

        
        <a href="verTarefa.php?cod=<?= $codTarefa ?>"><button class="btn">← Voltar</button></a>
        
        <h2>Editando Tarefa</h2>
        
        <span class="badge badge-brown">Criada por: <?= $criadoPor ?></span>
        <span class="badge badge-brown">Tarefa de: <?= $pertenceAo ?></span>
        <span class="badge badge-green">Status: <?=  $status ?></span>
        
        <form method="post">
            <label>COD: <input type="text" disabled value="<?= $codTarefa ?>"></label>
            <label>Título: <input type="text" name="nome_tarefa" value="<?= $nomeTarefa ?>"> </label>
            <label>Descrição: <textarea name="descricao" required><?= $descricao ?></textarea></label>
            
            <select name="cod_status">
                <option value="1" <?php selectCheck($codStatus, 1); ?>>Fazer</option>
                <option value="2" <?php selectCheck($codStatus, 2); ?>>Fazendo</option>
                <option value="3" <?php selectCheck($codStatus, 3); ?>>Feito</option>
            </select>

            <hr>
            <label>Data de Criacao: <input type="date" value="<?= $dataSemHorario ?>" disabled></label>
            <label>Data de Vencimento: <input type="date" name="terminar_em" value="<?= $dataVencimento ?>"></label>
            <!--<label>Atribuir a mim: <input type="checkbox" name="assign_to_me" <?= $minhaTarefa ?> ></label>-->

            <hr><br>
            <button type="submit">Salvar Alterações</button>
        </form>
        
    </main>
    
    <?php include '../includes/footer.php'; ?>

</body>
</html>