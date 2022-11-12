<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(isset($dados['Verificar'])){

        if(isset($_POST['cliente'])){
            
            $_SESSION['cliente_r'] = $dados['cliente'];
            header("Location: Clientes.php#demo-modal");
        }
    }

?>