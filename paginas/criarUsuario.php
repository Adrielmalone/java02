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

    <?php
        require_once "../config/banco.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = $_POST["usuario"] ?? "";
            $nome = $_POST["nome"] ?? "";
            $senha = $_POST["senha"] ?? "";
            $loginTipo = $_POST["tipo"] ?? "";
            

            if($usuario !== "" && $nome !== "" && $senha !== "" && $loginTipo !== "") {
                criarNovoUsuario($usuario, $nome, $senha, $loginTipo);
                if(fazerLogin($usuario, $senha)) {
                    header("Location: ./dashboard.php");
                } else {
                    echo "<h1>Um erro inesperado ocorreu.</h1>";
                }
            } else {
                echo "<h1>Todos os campos são obrigatórios.</h1>";
            }
        }
    ?>
    
    <main>

        <a href="./login.php"><button class="btn">← Voltar</button></a>
        
        <h2>Criar Novo Usuario</h2>
        
        
        <form method="post">
            <label>Nome: <input type="text" name="nome"> </label>
            <label>Usuario: <input type="text" name="usuario"> </label>
            <label>Senha: <input type="password" name="senha"> </label>

            <label>
                Tipo:
                <input type="radio" name="tipo" value="ADM"> ADM
                <input type="radio" name="tipo" value="NORMAL"> NORMAL
            </label>

            <button type="submit">Criar</button>
        </form>
        
    </main>
    
    <?php include '../includes/footer.php'; ?>

</body>
</html>