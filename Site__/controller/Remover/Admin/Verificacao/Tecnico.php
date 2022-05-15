<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(isset($dados['Verificar'])){

        if(isset($_POST['tecnico'])){
            
            $_SESSION['tecnico_r'] = $dados['tecnico'];
            header("Location: Tecnicos.php#demo-modal");
        }
    }

?>