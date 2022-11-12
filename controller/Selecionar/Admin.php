<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($dados['Entrar'])){
        /* var_dump($dados); */

        $query_adm = "SELECT * FROM administrador WHERE email_adm = :emailadm and senha_adm = :senhaadm";

        $login_adm = $conexao->prepare($query_adm);
        $login_adm->bindParam(':emailadm', $dados['email']);
        $login_adm->bindParam(':senhaadm', $dados['senha']);
        $login_adm->execute();

        $login = $login_adm->rowCount();

        $row_adm = $login_adm->fetch(PDO::FETCH_ASSOC);

        if($login != 0){
            $_SESSION['id_admin'] = $row_adm['id_adm'];
            $_SESSION['nome_admin'] = $row_adm['nome_adm'];
            $_SESSION['email_admin'] = $row_adm['email_adm'];
            header("Location: view/PainelAdmin.php");
        }
        else{
            $_SESSION['msg'] = "<p style='color: red';>Erro: Email ou Senha inválida!</p>"; 
        }

    }

?>