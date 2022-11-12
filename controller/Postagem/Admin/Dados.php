<?php
    
    $dados_postagem = $conexao->prepare("SELECT id_postagem as ID, cod as Codigo, capa as Capa, titulo as Titulo, autor as Autor, conteudo as Conteudo, DATE_FORMAT(postado, '%d %M %Y') as Postado, DATE_FORMAT(atualizado, '%d %M %Y') as Atualizado from postagem where cod = :cod;");
    $dados_postagem->bindParam(':cod', $_SESSION['post']);
    $dados_postagem->execute();
    
    $row_dados = $dados_postagem->fetch(PDO::FETCH_ASSOC);

?>