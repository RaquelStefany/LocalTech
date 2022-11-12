<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "localtech";
    $porta = 3306;

    $conexao2 = new PDO("mysql:host=$host;port=$porta;dbname=".$dbname, $user, $password);
    
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    try {
    
        $postagem = $conexao2->prepare("SELECT id_postagem as ID, cod as Codigo, capa as Capa, titulo as Titulo, autor as Autor, conteudo as Conteudo, DATE_FORMAT(postado, '%d %M %Y') as Postado, DATE_FORMAT(atualizado, '%d %M %Y') as Atualizado from postagem ORDER BY id_postagem DESC LIMIT 2;");
        $postagem->execute();
        
        while ($linha = $postagem->fetchObject()) {
            echo "<a href='../../../controller/Postagem/Selecionar.php?post={$linha->Codigo}' class='service-container'>

                    <div class='service-card'>
                        <img src='../../assets/images/Postagens/Capas/{$linha->Capa}'>
                        <h3 style='text-align: center;'>
                            {$linha->Titulo}
                            <br>
                            <span style='text-align: center; font-size: x-small;'>
                                Publicado em:
                                " . 
                                strftime('%d %b %Y', strtotime($linha->Postado))
                                . "
                            </span>
                        </h3>
                        <div class='learn-more-btn postagem'>
                            Acessar Postagem
                            <i class='fas fa-long-arrow-alt-right'></i>
                        </div>
                
                    </div>
                
                </a>";
        }      
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conexao2 = null;

?>