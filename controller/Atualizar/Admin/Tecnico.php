<?php
    
    $usuarios = $conexao->prepare("SELECT 
                                        t.id_tecnico AS ID,
                                        t.cod AS COD,
                                        t.image AS Imagem,
                                        t.nome AS Nome,
                                        t.sobrenome AS Sobrenome,
                                        t.tipo AS Tipo,
                                        t.cpf AS CPF,
                                        t.cnpj AS CNPJ,
                                        DATE_FORMAT(t.datanascimento, '%Y-%m-%d') AS Nascimento,
                                        cc.email AS Email,
                                        cc.telefone AS Telefone,
                                        s.status AS Status
                                    FROM
                                        tecnico AS t
                                            INNER JOIN
                                        contato AS cc
                                            INNER JOIN
                                        status AS s ON t.id_tecnico = cc.id_tecnico
                                            AND t.id_tecnico = s.id_tecnico
                                    WHERE
                                        t.id_tecnico = :id
                                    LIMIT 1");
    $usuarios->bindParam(':id', $_SESSION['update_tecnico']);
    $usuarios->execute();
    
    $row_tecnico = $usuarios->fetch(PDO::FETCH_ASSOC);

?>