<?php

    session_start();
    ob_start();

    $dados = $_GET['cliente'];

    if(isset($dados)){

        if($dados != ""){

            $_SESSION['dado_cliente'] = $dados;

            if($_SESSION['dado_cliente']){
                header("Location: ../../../../../view/admin/view/Cliente/Dados.php");
            }
        }
    }

?>