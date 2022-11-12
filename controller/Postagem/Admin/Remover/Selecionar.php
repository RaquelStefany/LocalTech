<?php

    session_start();
    ob_start();

    if(isset($_GET['post'])){

        $post = $_GET['post'];

        $_SESSION['post_r'] = $post;

        if($_SESSION['post_r']){
            header("Location: ../../../../view/admin/view/Noticias/Noticias.php#demo-modal");
        }
    }

?>