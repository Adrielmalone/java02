<?php 

    session_start();
    $codUsuario = $_SESSION['codUsuario'] ?? null;
    $usuario = $_SESSION['usuario'] ?? null;
    $nomeUsuario = $_SESSION['nomeUsuario'] ?? null;
    $fotoUsuario = $_SESSION['fotoUsuario'] ?? null;


    function verificarLogin() {
        if (!isset($_SESSION['usuario']) || is_null($_SESSION['usuario'])) {
            header("Location: ./login.php");
        }
    }

    function logout(){
        unset($_SESSION['codUsuario']);
        unset($_SESSION['usuario']);
        unset($_SESSION['nomeUsuario']);
        unset($_SESSION['fotoUsuario']);
    }

?>