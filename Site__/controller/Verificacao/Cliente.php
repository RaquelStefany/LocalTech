<?php

    if((!isset($_SESSION['id_cliente'])) AND (!isset($_SESSION['nome_cliente']))){
        $_SESSION['msg'] = "<p style='color: red;'>Login necessário para acessar a página!</p>";
        header("Location: ../Login/login-cliente.php");
    }

?>