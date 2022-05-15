<?php

    session_start();
    include('../Conexao/Conexao.php');
    ob_start();

    $id_mail = $_GET['4bb9ff48e657b4864c82c53e5529077080860b95'];
    $_SESSION['verificado'] = $id_mail;

    if(isset($_SESSION['verificado'])){
        $cliente = $conexao->prepare("UPDATE contato 
                                        SET 
                                        verificacao = 'Sim' 
                                        WHERE codificacao = '" . $_SESSION['verificado'] . "';");
        $cliente->execute();

        header("Location: ../../view/pages/Login/login.php");
    }
    else{
        $_SESSION['everificado'] = "error";
        header("Location: ../../view/pages/Verificar/error-verificacao.php");
    }

?>