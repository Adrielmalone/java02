<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php include_once "../includes/header.php"; ?>

    <main>

        <a href=""><button class="btn">Nova Tarefa +</button></a>

        <h2>Dashboard</h2>
        
        <div class="board">

            <div class="column" id="fazer">
                <h3>Fazer</h3>


                <?php
                    require_once "../config/banco.php";
                    $tarefas = pegarTarefas();
                    $fazer = [];
                    $fazendo = [];
                    $feito = [];

                    for($i = 0 ; $i < count($tarefas); $i++) {
                        $t = $tarefas[$i];
                        $tarefaStatusCod = $t['cod_status'];
                        $status = pegarStatusPorCodigo($tarefaStatusCod);
                        
                        
                        

                        if($status === "Feito") {
                            $feito[] = $t;
                        } else if ($status === "Fazer") {
                            $fazer[] = $t;
                        } else {
                            $fazendo[] = $t;
                        }
                        
                    }

                    for($i = 0 ; $i < count($fazer); $i++) {
                        $fazerTask = $fazer[$i];
                        $usuario = pegarUsuarioPorCodigo($fazerTask['criado_por']);

                        $usuarioNome = "Usuario Desconhecido";
                        if(!empty($usuario)) {
                            $usuarioNome = $usuario['nome'];
                        }

                        echo '<div class="task">';
                        echo '<a href="">' . $t['nome_tarefa'] . ' [' . $usuarioNome . '] </a>';
                        echo '</div>';
                    }
                  
                    
                ?>
            
                

            </div>


            <div class="column" id="fazendo">
                <h3>Fazendo</h3>

                <?php
                    for($i = 0 ; $i < count($fazendo); $i++) {
                        $fazerTask = $fazer[$i];
                        $usuario = pegarUsuarioPorCodigo($fazerTask['criado_por']);

                        $usuarioNome = "Usuario Desconhecido";
                        if(!empty($usuario)) {
                            $usuarioNome = $usuario['nome'];
                        }

                        echo '<div class="task">';
                        echo '<a href="">' . $t['nome_tarefa'] . ' [' . $usuarioNome . '] </a>';
                        echo '</div>';
                    }
                ?>

            </div>


            <div class="column" id="feito">
                <h3>Feito</h3>
                
                <!-- bloco de tarefa -->
                <div class="task">
                    <a href=""> Nome da tarefa [usuario] </a>
                </div>
                <!-- fim do bloco -->

            </div>
        </div>
        
        
    </main>

    <?php include_once '../includes/footer.php'; ?>

</body>

</html>