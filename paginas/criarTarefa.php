<?php
    require_once "../config/sessao.php";
    verificarLogin();
    
    require_once '../config/banco.php';
    include '../classes/Tarefas.php';

    $dataSemHorario = date("Y-m-d");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome_tarefa'] ?? "-";
        $descricao = $_POST['descricao'] ?? "-";
        $cod_status = $_POST['cod_status'] ?? NULL;
        $data_terminar = $_POST['terminar_em'] ?? NULL;
        
        $criadoPor = $codUsuario;
        // $pertenceAo = isset($_POST['assign_to_me']) ? $created_by : null;
    
        criarNovaTarefa($nome, $descricao, $cod_status, $criadoPor, 1, $data_terminar);
        header('Location: dashboard.php');
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

        
        <a href="dashboard.php"><button class="btn">← Voltar</button></a>
        
        <h2>Criar Nova Tarefa</h2>
        
        <span class="badge badge-brown">Criadando tarefa como: <?= $nomeUsuario ?></span>
        
        <form method="post">
            <label>Título: <input type="text" name="nome_tarefa"> </label>
            <label>Descrição: <textarea name="descricao" required></textarea></label>
            
            <select name="cod_status">
                <option value="1" >Fazer</option>
                <option value="2" >Fazendo</option>
                <option value="3" >Feito</option>
            </select>

            <hr>
            <label>Data de Criacao: <input type="date" value="<?= $dataSemHorario ?>" disabled></label>
            <label>Data de Vencimento: <input type="date" name="terminar_em"></label>
            <!--<label>Atribuir a mim: <input type="checkbox" name="assign_to_me" <?= $minhaTarefa ?> ></label>-->

            <hr><br>
            <button type="submit">Salvar Alterações</button>
        </form>
        
    </main>
    
    <?php include '../includes/footer.php'; ?>

</body>
</html>