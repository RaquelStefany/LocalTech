<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "localtech";
    $porta = 3306;

    $conexao2 = new PDO("mysql:host=$host;port=$porta;dbname=".$dbname, $user, $password);

    try {
    
        $respostas = $conexao->prepare("SELECT cod as Codigo, id_cliente as Cliente, id_tecnico as Tecnico, assunto as Assunto, usuario as Sobre, relatorio as Relatorio, DATE_FORMAT(data, '%d-%M-%Y %H:%i') as Data, resposta as Resposta from report order by id_report desc;");
        $respostas->execute();
        
        while ($linha = $respostas->fetchObject()) {
            if($linha->Cliente != 0){
                $user = $conexao->prepare("SELECT concat(c.nome, ' ', c.sobrenome) as Nome from cliente as c where id_cliente = {$linha->Cliente};");
                $user->execute();

                if($user->rowCount()){
                    $row_user = $user->fetch(PDO::FETCH_ASSOC);
                    $usuario = $row_user['Nome'];
                }
            }
            else{
                $user = $conexao->prepare("SELECT concat(t.nome, ' ', t.sobrenome) as Nome from tecnico as t where id_tecnico = {$linha->Tecnico};");
                $user->execute();

                if($user->rowCount()){
                    $row_user = $user->fetch(PDO::FETCH_ASSOC);
                    $usuario = $row_user['Nome'];
                }
            }
            if($linha->Resposta == ""){
                $resposta = "Aguardando Resposta
                            <a class='btntable' href='../../../../controller/Reportar/Admin/Respostas/Selecionar.php?report={$linha->Codigo}' style='width: 50%; padding: 1%; font-size: medium; float: right;'>Responder</a>";
                $cor = "style='background: antiquewhite;'";
            }
            else{
                $resposta = $linha->Resposta;
                $cor = "style='background: aliceblue;'";
            }
            echo "<div class='reports' {$cor}>
                    <h1 style='text-align: center;'>
                        Report - #{$linha->Codigo}
                    </h1>
                    <br>
                    <h3 style='text-align: right; color: grey;'>
                        {$linha->Data}
                    </h3>
                    <h3 style='font-size: medium;'>
                        <span style='color: dimgray;'>Usuário:</span> {$usuario}
                    </h3>
                    <h3 style='font-size: medium;'>
                        <span style='color: dimgray;'>Assunto:</span> {$linha->Assunto}
                    </h3>
                    <h3 style='font-size: medium;'>
                        <span style='color: dimgray;'>Sobre:</span> {$linha->Sobre}
                    </h3>
                    <h3 style='font-size: medium;'>
                        <span style='color: dimgray;'>Relatório:</span> {$linha->Relatorio}
                    </h3>
                    <br>
                    <h2>
                        <span style='color: dimgray;'>Resposta:</span> {$resposta}
                        <br>
                        <br>
                    </h2>
                </div>
                <br>";
        }
        echo '<br>';
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conexao = null;
    echo "<br>";

?>