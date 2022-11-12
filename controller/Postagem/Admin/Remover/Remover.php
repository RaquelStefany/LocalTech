<?php

    session_start();
    include('../../../Conexao/Conexao.php');
    ob_start();

    if(isset($_SESSION['post_r'])){
        $query_postagem = "DELETE FROM postagem WHERE cod = :cod;";
        $Postagem = $conexao->prepare($query_postagem);
        $Postagem->bindParam(':cod', $_SESSION['post_r']);
        $Postagem->execute();

        if($Postagem->rowCount()){
            unset($_SESSION['post_r']);
            header("Location: ../../../../view/admin/view/Noticias/Noticias.php");
        }
    }
    else{
        header("Location: ../../../../view/admin/view/Noticias/Noticias.php");
    }

?>