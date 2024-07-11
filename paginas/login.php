<?php 

    require_once "../config/banco.php";
    require_once "../config/sessao.php";

    // Usuario Já Logado?
    if(!is_null($usuario)){
        header("Location: ./dashboard.php");
    }else{
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['usuario'] ?? null;
            $senha = $_POST['senha'] ?? null;

            if(!is_null($usuario) && !is_null($senha)){
                if(fazerLogin($usuario, $senha)){
                    header("Location: dashboard.php");
                }else{
                    echo "<p>Usuário ou senha inválidos</p>";
                }
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php include '../includes/header.php'; ?>
    
    <main>
        <form method="post">
            <label>Usuario: <input type="text" name="usuario" required></label>
            <label>Senha: <input type="password" name="senha" required></label>
            <button type="submit">Login</button>
        </form>
    </main>

    <?php include '../includes/footer.php'; ?>

</body>
</html>