<?php 

    require_once "../../config/sessao.php";
    require_once '../../config/banco.php';
    
    $codTarefa = $_GET["tar"] ?? null;
    $codComentario = $_GET["cod"] ?? null;

    if(is_null($codComentario)){
        header("Location: dashboard.php");
    }else{
        apagarComentario($codComentario);
        adicionarNoHistorico($codTarefa, $codUsuario, "$nomeUsuario - deletou um comentário");
        header("Location: ../verTarefa.php?cod=$codTarefa");
    }

?>