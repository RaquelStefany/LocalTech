<?php

    include('../../Conexao/Conexao.php');

    $tecnicosult = $conexao->prepare("SELECT image, nome, sobrenome, cpf, cnpj FROM tecnico ORDER BY id_tecnico DESC LIMIT 2;");
    $tecnicosult->execute();

    echo "<table class='dadosdash'>
        <tbody>";
    while ($linha = $tecnicosult->fetchObject()) {
    echo "<tr>
            <td class='imguserdash'><img src='../../assets/images/ImagensPerfil/{$linha->image}'></td>
            <td>{$linha->nome} {$linha->sobrenome}</td>
        </tr>";
    }
    echo "</tbody>
        </table>"; 

?>