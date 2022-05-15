<?php

    //include_once('../../controller/conexao.php');

    try {
  
        $assistencias = $conexao->prepare('SELECT 
                                                a.id_assistencia,
                                                a.cod,
                                                a.image,
                                                a.nome,
                                                a.cnpj,
                                                a.cadastro,
                                                ha.descricao,
                                                ha.horaabrir,
                                                ha.horafechar,
                                                ha.semanainicio,
                                                ha.semanafinal,
                                                cc.email,
                                                cc.telefone,
                                                e.logradouro,
                                                e.numero,
                                                e.complemento,
                                                b.nome AS bairro,
                                                cd.nome AS cidade,
                                                es.sigla AS estado
                                            FROM
                                                assistencia AS a
                                                    INNER JOIN
                                                endereco AS e
                                                    INNER JOIN
                                                contato AS cc
                                                    INNER JOIN
                                                estado AS es
                                                    INNER JOIN
                                                cidade AS cd
                                                    INNER JOIN
                                                bairro AS b
                                                    INNER JOIN
                                                horario_assistencia AS ha ON a.id_assistencia = e.id_assistencia
                                                    AND a.id_assistencia = cc.id_assistencia
                                                    AND a.id_assistencia = ha.id_assistencia
                                                    AND b.id_cidade = cd.id_cidade
                                                    AND cd.id_estado = es.id_estado
                                            GROUP BY a.id_assistencia;');
        $assistencias->execute();
        
        foreach ($assistencias->fetchAll() as $row) {

            echo "<li class='service-container'>

                    <div class='service-card'>
                        <img src='../../assets/images/ImagensPerfil/" . $row['image'] . "'>
                        <h3>
                            " . $row['nome'] . "
                        </h3>

                        <div class='learn-more-btn'>
                            Ver detalhes
                            <i class='fas fa-long-arrow-alt-right'></i>
                        </div>

                    </div>

                    <div class='service-modal flex-center'>

                        <div class='service-modal-body' id='teste'>
                            <i class='fas fa-times modal-close-btn'></i>
                            <div class='imgassis'>
                                <img src='../../assets/images/ImagensPerfil/" . $row['image'] . "'>
                            </div>
                            <h3>
                                " . $row['nome'] . "
                            </h3>

                            <h4>
                                " . $row['descricao'] . "
                            </h4>

                            <p>
                                <i class='fas fa-clock' style='color: #6a59d1;'></i>
                                <b>Horario:</b> Das " . $row['horaabrir'] . " às " . $row['horafechar'] . "
                                <br>
                                <i class='fas fa-calendar' style='color: #6a59d1;'></i>
                                <b>Funcionamento:</b> De " . $row['semanainicio'] . " à " . $row['semanafinal'] . "
                            </p>

                            <h4>
                                Informações
                            </h4>

                            <ul>
                                <li>
                                    <i class='fas fa-phone' style='color: #6a59d1;'></i>
                                    <b>Telefone:</b> " . $row['telefone'] . "
                                </li>
                                <li>
                                    <i class='fas fa-at' style='color: #6a59d1;'></i>
                                    <b>Email:</b> " . $row['email'] . "
                                </li>
                                <li>
                                    <i class='fas fa-building' style='color: #6a59d1;'></i>
                                    <b>Endereço:</b> " . $row['logradouro'] . ", " . $row['numero'] . " - " . $row['bairro'] . " - " . $row['cidade'] . " - " . $row['estado'] . "
                                </li>
                            </ul>

                        </div>

                    </div>

                </li>";
        }
    }
    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

?>