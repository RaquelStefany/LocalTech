<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(isset($dados['Selecionar'])){

        if(isset($_POST['cliente'])){

            $cliente = $dados['cliente'];

            $_SESSION['dado_cliente'] = $cliente;

            if($_SESSION['dado_cliente']){
                header("Location: Dados.php");
            }
        }
    }

?>