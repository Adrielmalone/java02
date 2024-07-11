<?php
    
    include_once "../config/sessao.php";
    verificarLogin();
    logout();

    session_unset();
    session_destroy();
    header("Location: ./login.php");
    exit();
?>
