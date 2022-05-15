<?php

    //error_reporting(0);
    session_start();
    include_once('../../../controller/Conexao/Conexao.php');
    require_once('../../../controller/Dados/Tecnico.php');
    require_once('../../../controller/Chat/Tecnico/ClienteChat.php');

    if(isset($_SESSION['id_atendimento'])){

        $remetente = $LinhaDados['ID'];
        $destinatario = $cli_chat['ID'];

        $output = "";

        $mensagem = $conexao->prepare("SELECT * FROM chat WHERE id_atendimento = {$_SESSION['id_atendimento']} ORDER BY id_chat;");
        $mensagem->execute();

        $chat = $mensagem->rowCount();

        $chatt = $conexao->prepare("SELECT id_atendimento FROM atendimento WHERE id_atendimento = {$_SESSION['id_atendimento']} AND fim = '0000-00-00 00:00:00.000000'");
        $chatt->execute();

        $verificar = $chatt->rowCount();

        if($verificar == 0){
            echo "<div style='text-align: center; margin-top: 20%;'><h4>Chat encerrado.</h4></div>";
        }
        else{

            if($chat > 0){
                foreach ($mensagem->fetchAll() as $row) {
                    if($row['remetente'] == 'Tecnico'){
                        $output .= "<div class='chat outgoing'>
                                            <div class='details'>
                                                <p>" . $row['mensagem'] . "</p>
                                            </div>
                                            <img src='../../../../view/assets/images/ImagensPerfil/" . $LinhaDados['Imagem'] . "' alt=''>
                                        </div>";
                    }
                    else{
                        if($row['remetente'] == 'Cliente'){
                            $output .= "<div class='chat incoming'>
                                            <img src='../../../../view/assets/images/ImagensPerfil/" . $cli_chat['Imagem'] . "' alt=''>
                                            <div class='details'>
                                                <p>" . $row['mensagem'] . "</p>
                                            </div>
                                        </div>";
                        }
                    }
                }
                echo $output;
            }
        }
    }

?>