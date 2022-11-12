<?php

    session_start();
    ob_start();

    $dados = $_GET['report'];

    if(isset($dados)){

        if($dados != ""){

            $_SESSION['dado_resposta'] = $dados;

            if($_SESSION['dado_resposta']){
                header("Location: ../../../../view/admin/view/Reports/Dados.php");
            }
        }
    }

?>