<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $data = date('Y-m-d');

    if(!empty($dados['Editar'])){
        
        if(!empty($_FILES['imagem']['name'])){

            $img_name = $_FILES['imagem']['name'];
            $tmp_name = $_FILES['imagem']['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $extensions = ['png', 'jpeg', 'jpg'];
            if(in_array($img_ext, $extensions) === true){
                $time = time();
                $new_img_name = $time.$img_name;

                if(move_uploaded_file($tmp_name, "../../../assets/images/Postagens/Capas/".$new_img_name)){

                    $postagem = $conexao->prepare("UPDATE postagem set capa = :capa, titulo = :titulo, autor = :autor, conteudo = :conteudo, atualizado = :data where cod = :cod");
                    $postagem->bindParam(':cod', $_SESSION['post']);
                    $postagem->bindParam(':capa', $new_img_name);
                    $postagem->bindParam(':titulo', $dados['titulo']);
                    $postagem->bindParam(':autor', $dados['autor']);
                    $postagem->bindParam(':conteudo', $dados['conteudo']);
                    $postagem->bindParam(':data', $data);
                    $postagem->execute();

                    if($postagem->rowCount()){
                        header("Location: Noticias.php");
                        
                        echo "<p style='color: green;'>
                                    Postagem Inserida Com Sucesso
                                </p>";
                    }
                    else{            
                        echo "<p style='color: red;'>
                                    Erro ao Inserir Postagem
                                </p>";
                    }
                }
            }
        }
        
        if(empty($_FILES['imagem']['name'])){
            $postagem = $conexao->prepare("UPDATE postagem set titulo = :titulo, autor = :autor, conteudo = :conteudo, atualizado = :data where cod = :cod");
            $postagem->bindParam(':cod', $_SESSION['post']);
            $postagem->bindParam(':titulo', $dados['titulo']);
            $postagem->bindParam(':autor', $dados['autor']);
            $postagem->bindParam(':conteudo', $dados['conteudo']);
            $postagem->bindParam(':data', $data);
            $postagem->execute();

            if($postagem->rowCount()){
                header("Location: Noticias.php");
                
                echo "<p style='color: green;'>
                            Postagem Inserida Com Sucesso
                        </p>";
            }
            else{            
                echo "<p style='color: red;'>
                            Erro ao Inserir Postagem
                        </p>";
            }
        }
    }

?>