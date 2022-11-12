<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(isset($dados['Verificar'])){

        if(isset($_POST['assistencia'])){
            
            $_SESSION['assistencia_r'] = $dados['assistencia'];
            header("Location: assistencias.php#demo-modal");
        }
    }

?>