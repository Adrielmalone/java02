<?php

    $banco = new mysqli("localhost:3306", "root", "fueripe21062006", "trello_simples");  

    
    // STATUS ----------------------------------
    function pegarStatusPorCodigo($codStatus){
        global $banco;
        $busca = $banco->query("SELECT * FROM status WHERE id = '$codStatus'");
        return $busca->fetch_object()->name;
    }
    
    
    // TAREFAS -------------------------------
    function pegarTarefaPorCodigo($codTarefa){
        global $banco;
        $busca = $banco->query("SELECT * FROM tarefas WHERE cod = '$codTarefa'");
        return (array) $busca->fetch_object();
    }

    function pegarTarefas($codUsuario = null){
        global $banco;
        $busca = $banco->query("SELECT * FROM tarefas ORDER BY criado_em DESC");
        $tarefas = [];

        while ($row = $busca->fetch_assoc()) {
            $tarefas[] = $row;
        }

        return $tarefas;
        // SELECT * FROM tarefas ORDER BY criado_em DESC"
    }

    function atualizarTerefa($arrayTarefa){
        // " UPDATE tarefas SET, nome_tarefa = '$nome_tarefa', descricao = '$descricao', cod_status = '$cod_status', terminar_em = '$terminar_em', WHERE cod = '$cod' "
    }


    
    // COMANTARIOS -------------------------------
    function adicionarComentario($codTarefa, $codUsuario, $comentario){
        global $banco;
        $query = "INSERT INTO comentarios (cod_tarefa, cod_usuario, texto, criado_em) VALUES ('$codTarefa', '$codUsuario', '$comentario', NOW())";
        $banco->query($query);
        // INSERT INTO comentarios (cod_tarefa, cod_usuario, texto, criado_em) VALUES ('$codTarefa', '$codUsuario', '$comentario', NOW())
    }

    function apagarComentario($codComentario){
        global $banco;
        $query = "DELETE FROM comentarios WHERE cod = '$codComentario'";
        $banco->query($query);
        // DELETE FROM comentarios WHERE cod = '$codComentario'
    }

    function criarNovaTarefa() {
        
    }

    function pegarComentariosPorCodigo($codTarefa){
        global $banco;
        $busca = $banco->query("SELECT * FROM comentarios WHERE cod_tarefa = '$codTarefa' ORDER BY criado_em ASC");
        $comentarios = [];

        while ($row = $busca->fetch_assoc()) {
            $comentarios[] = $row;
        }

        return $comentarios;
        // SELECT * FROM comentarios WHERE cod_tarefa = '$codTarefa' ORDER BY criado_em ASC
    }



    // HISTORICO -------------------------------
    function adicionarNoHistorico($codTarefa, $codUsuario, $operacao) {
        // INSERT INTO historico_tarefas (cod_tarefa, cod_usuario, acao, criado_em) VALUES ('$codTarefa', '$codUsuario', '$operacao', NOW())
    }

    function pegarHistoricoDeTarefa($codTarefa) {
        // SELECT * FROM historico_tarefas WHERE cod_tarefa = '$codTarefa' ORDER BY criado_em ASC
    }
    

    // USUARIO ----------------------------------
    function criarNovoUsuario($usuario, $nome, $senha, $loginTipo) {
        global $banco;
        $passwordHash = password_hash($senha, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuarios (usuario, nome, senha, tipo) VALUES ('$usuario', '$nome', '$passwordHash', '$loginTipo')";
        $banco->query($query);
    }

    function atualizarUsuario($codUsuario, $usuario, $nome) {
        // "UPDATE usuarios SET usuario='$usuario', nome='$nome' WHERE cod='$codUsuario'"
    }

    function pegarUsuarioPorCodigo($codUsuario){
        global $banco;
        $busca = $banco->query("SELECT * FROM usuarios WHERE cod = '$codUsuario'");
        return (array) $busca->fetch_object();
        // "SELECT * FROM usuarios WHERE cod = '$codUsuario'"
    }

    function fazerLogin($usuario, $senha){
        global $banco;

        $query = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $busca = $banco->query($query);

        if($busca->num_rows > 0){

            $objUsuario = $busca->fetch_object();
            
            //if($senha === $objUsuario->senha){
            if(password_verify($senha, $objUsuario->senha)){
                echo "Login :)";
                salvarUsuarioSessao($objUsuario);
                return true;
            }else{
                echo "Senha Inválida :/";
                return false;
            }

        }

    }

    function salvarUsuarioSessao($usuario) {
        session_start();
        $_SESSION['codUsuario'] = $usuario->cod;
        $_SESSION['usuario'] = $usuario->usuario;
        $_SESSION['nome'] = $usuario->nome;
        $_SESSION['usuarioTipo'] = $usuario->tipo;
    }

?>