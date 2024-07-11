<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Usuario </title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <?php include '../includes/header.php'; ?>
    
    <main>

        <a href="../login.php"><button class="btn">← Voltar</button></a>
        
        <h2>Editar Conta</h2>
        
        <form method="post">
            <label>Cod: <input type="text" value="<?= $codUsuario ?>" disabled> </label>
            <label>Nome: <input type="text" name="nome" value="<?= $nomeUsuario ?>"> </label>
            <label>Usuario: <input type="text" name="usuario" value="<?= $usuario ?>"> </label>
            <!-- ADM / NORMAL -->

            <button type="submit">Alterar</button>
        </form>
        
    </main>
    
    <?php include '../includes/footer.php'; ?>

</body>
</html>