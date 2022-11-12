<?php

    if((isset($_SESSION['id_admin'])) AND (isset($_SESSION['nome_admin']))){
        $_SESSION['msg'] = "<p style='color: red;'>Login necessário para acessar a página!</p>";
        header("Location: view/PainelAdmin.php");
    }

?>