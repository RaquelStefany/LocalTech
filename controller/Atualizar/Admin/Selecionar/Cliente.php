<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(isset($dados['Atualizar'])){

        if(isset($_POST['cliente'])){

            $cliente = $dados['cliente'];

            $_SESSION['update_cliente'] = $cliente;

            if($_SESSION['update_cliente']){
                header("Location: Atualizar.php");
            }
        }
    }

?>