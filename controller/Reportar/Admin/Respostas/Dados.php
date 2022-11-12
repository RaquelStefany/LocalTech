<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "localtech";
    $porta = 3306;

    $conexao2 = new PDO("mysql:host=$host;port=$porta;dbname=".$dbname, $user, $password);


    try {
    
        $usuarios = $conexao->prepare("SELECT id_report as ID, cod as Codigo, id_cliente as Cliente, id_tecnico as Tecnico, tipo as Tipo, assunto as Assunto, usuario as Sobre, relatorio as Relatorio, DATE_FORMAT(data, '%d-%M-%Y %H:%i') as Data from report where cod = :cod order by id_report desc;");
        $usuarios->bindParam(':cod', $_SESSION['dado_resposta']);
        $usuarios->execute();
        
        while ($linha = $usuarios->fetchObject()) {
            if($linha->Cliente != 0){
                $user = $conexao->prepare("SELECT concat(c.nome, ' ', c.sobrenome) as Nome from cliente as c where id_cliente = {$linha->Cliente};");
                $user->execute();

                if($user->rowCount()){
                    $row_user = $user->fetch(PDO::FETCH_ASSOC);
                    $usuario = "Cliente " . $row_user['Nome'];
                    $_SESSION['user'] = $linha->ID;
                }
            }
            else{
                $user = $conexao->prepare("SELECT concat(t.nome, ' ', t.sobrenome) as Nome from tecnico as t where id_tecnico = {$linha->Tecnico};");
                $user->execute();

                if($user->rowCount()){
                    $row_user = $user->fetch(PDO::FETCH_ASSOC);
                    $usuario = "Técnico " . $row_user['Nome'];
                    $_SESSION['user'] = $linha->ID;
                }
            }
            echo "<div class='hidden' id='div-dados'>
                <div id='dados'>
                    <div class='wrapper'>
                        <div class='leftd'>
                            <img src='../../../assets/img/images/chat-svgrepo-com.png' width='100' style='object-fit: contain;'>
                            <h4>
                                <b>
                                    ID:
                                </b>
                                <br>
                                    {$linha->ID}
                            </h4>
                        </div>
                        <div class='rightd'>
                            <div class='info'>
                                <h3>
                                    Report - OS{$linha->Codigo}
                                </h3>
                                <br>
                                <div class='info_data'>
                                    <div class='data'>
                                        <h4>
                                            Código
                                        </h4>
                                        <p>
                                            OS {$linha->Codigo}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Criado em
                                        </h4>
                                        <p>
                                            {$linha->Data}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class='info_data'>
                                    <div class='data'>
                                        <h4>
                                            Por
                                        </h4>
                                        <p>
                                            {$usuario}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Sobre
                                        </h4>
                                        <p style='text-transform: capitalize;'>
                                            {$linha->Tipo} {$linha->Sobre}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class='info_data' style='justify-content: center;'>
                                    <div class='data' style='width: 100%'>
                                        <h4>
                                            Relatório
                                        </h4>
                                        <p>
                                            {$linha->Relatorio}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class='info_data' style='justify-content: center;'>
                                    <div class='data' style='width: 100%'>
                                        <h4>
                                            Resposta
                                        </h4>";
        }
    
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conexao = null;
    echo "</table>";

?>