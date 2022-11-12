<?php

    try {
    
        $postagem = $conexao->prepare("SELECT id_postagem as ID, cod as Codigo, capa as Capa, titulo as Titulo, autor as Autor, conteudo as Conteudo, DATE_FORMAT(postado, '%d %M %Y') as Postado, DATE_FORMAT(atualizado, '%d %M %Y') as Atualizado from postagem ORDER BY id_postagem DESC;");
        $postagem->execute();
        
        while ($linha = $postagem->fetchObject()) {
            echo "<div class='courses-container infodados'>
                    <div class='course'>
                        <div class='course-preview'>
                            <img src='../../../assets/images/Postagens/Capas/{$linha->Capa}'>
                        </div>
                        <div class='course-info'>
                            <h6>
                                <b>
                                    Publicado em:
                                </b>
                                {$linha->Postado}
                            </h6>
                            <h2>
                                {$linha->Titulo}
                            </h2>
                            <h3>
                                <b>
                                    Autor:
                                </b>
                                {$linha->Autor}
                            </h3>
                            <br>
                            <div class='buttons'>
                                <a href='../../../../controller/Postagem/Selecionar.php?post={$linha->Codigo}' target='_blank'>
                                    <button class='btn' id='a'>Acessar</button>
                                </a>
                                <a href='../../../../controller/Postagem/Admin/Selecionar.php?post={$linha->Codigo}'>
                                    <button class='btn' id='e''>Editar</button>
                                </a>
                                <a href='../../../../controller/Postagem/Admin/Remover/Selecionar.php?post={$linha->Codigo}'>
                                    <button class='btn' id='r''>Remover</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>";
        }      
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conexao = null;

?>