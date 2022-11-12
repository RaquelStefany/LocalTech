<?php

    $diretorio_imagem = "http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/";

    $dados_imagem = $_FILES['image'];

    $diretorio = '../../../view/assets/images/Postagens/Imagens/';

    $chave = substr(md5(rand()), 0, 16);
    $extension = pathinfo($dados_imagem['name'], PATHINFO_EXTENSION);
    $nome_arquivo = $chave . "." . $extension;

    move_uploaded_file($dados_imagem['tmp_name'], $diretorio . $nome_arquivo);

    $return['success'] = true;
    $return['file'] = $diretorio_imagem . $nome_arquivo;

    echo json_encode($return);

?>