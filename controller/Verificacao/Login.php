<?php

    if((isset($_SESSION['id_cliente'])) AND (isset($_SESSION['nome_cliente']))){
        echo "<a href='../PerfilCliente/dashboard-cliente.php'>
                Perfil
            </a>";
    }
    else if((isset($_SESSION['id_tecnico'])) AND (isset($_SESSION['nome_tecnico']))){
        echo "<a href='../PerfilTecnico/dashboard-tecnico.php'>
                Perfil
            </a>";
    }
    else if((isset($_SESSION['id_assistencia'])) AND (isset($_SESSION['nome_assistencia']))){
        echo "<a href='../PerfilAssistencia/dashboard-assistencia.php'>
                Perfil
            </a>";
        
    }
    else{
        echo "<a href='../Login/login.php'>
                Iniciar Sessão
            </a>";
    }

?>