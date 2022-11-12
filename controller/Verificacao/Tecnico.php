<?php

    if((!isset($_SESSION['id_tecnico'])) AND (!isset($_SESSION['nome_tecnico']))){
        $_SESSION['msg'] = "<p style='color: red;'>Login necessário para acessar a página!</p>";
        header("Location: ../Login/login-tecnico.php");
    }

?>