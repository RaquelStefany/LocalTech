<?php

    include('../../Conexao/Conexao.php');

    $empresasult = $conexao->prepare("SELECT image, nome, cnpj FROM assistencia ORDER BY id_assistencia DESC LIMIT 2;");
    $empresasult->execute();

    echo "<table class='dadosdash'>
        <tbody>";
    while ($linha = $empresasult->fetchObject()) {
    echo "<tr>
            <td class='imguserdash'><img src='../../assets/images/ImagensPerfil/{$linha->image}'></td>
            <td>{$linha->nome}</td>
        </tr>";
    }
    echo "</tbody>
        </table>"; 

?>