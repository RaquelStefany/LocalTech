<?php

    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $VerificarPostagem = "SELECT id_postagem as ID, cod as Codigo, capa as Capa, titulo as Titulo, autor as Autor, conteudo as Conteudo, DATE_FORMAT(postado, '%d %M %Y') as Postado, DATE_FORMAT(atualizado, '%d %M %Y') as Atualizado from postagem where cod = :cod;";
    $Postagem = $conexao->prepare($VerificarPostagem);
    $Postagem->bindParam(':cod', $_SESSION['post']);
    $Postagem->execute();

    if($Postagem->rowCount()){
        $LinhaPostagem = $Postagem->fetch(PDO::FETCH_ASSOC);

        if($LinhaPostagem['Atualizado'] == null){
            $data = "- Publicado no LocalTech " . strftime('%d %b %Y', strtotime($LinhaPostagem['Postado']));
        }
        else{
            $data = "- Publicado no LocalTech " . strftime('%d %b %Y', strtotime($LinhaPostagem['Postado'])) . " - Atualizado em: " . strftime('%d %b %Y', strtotime($LinhaPostagem['Atualizado']));
        }
    }    

?>