<?php

    session_start();
    ob_start();

    if(isset($_GET['post'])){

        $post = $_GET['post'];

        $_SESSION['post'] = $post;

        if($_SESSION['post']){
            header("Location: ../../view/pages/Postagens/postagem.php");
        }
    }

?>