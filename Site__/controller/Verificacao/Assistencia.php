<?php

    if((!isset($_SESSION['id_assistencia'])) AND (!isset($_SESSION['nome_assistencia']))){
        $_SESSION['msg'] = "<p style='color: red;'>Login necessário para acessar a página!</p>";
        header("Location: ../Login/login-assistencia.php");
    }

?>