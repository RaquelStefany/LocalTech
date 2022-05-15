<?php

    session_start();
    include_once('../../../controller/Conexao/Conexao.php');

    if(isset($_SESSION['id_atendimento'])){
        $chatt = $conexao->prepare("SELECT id_atendimento FROM atendimento WHERE id_atendimento = {$_SESSION['id_atendimento']} AND fim = '0000-00-00 00:00:00'");
        $chatt->execute();

        $verificar = $chatt->rowCount();

        if($verificar == 0){
            echo "<button style='height: 100%' type='submit' name='enviarmensagem' disabled><i class='uil uil-message'></i></button>";
        }
        else{
            echo "<button style='height: 100%' type='submit' name='enviarmensagem'><i class='uil uil-message'></i></button>";
        }
    }

?>