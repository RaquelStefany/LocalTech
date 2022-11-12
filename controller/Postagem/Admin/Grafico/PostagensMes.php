<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "localtech";
    $porta = 3306;

    $conexao2 = new PDO("mysql:host=$host;port=$porta;dbname=".$dbname, $user, $password);

    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $dataatual = date('m');
    $mesatual = $dataatual;

    $datapassada = date('m', strtotime('-1 month'));
    $mespassado = $datapassada;

    $datarepassado = date('m', strtotime('-2 month'));
    $mesrepassado = $datarepassado;

    $postagem = $conexao2->prepare("SELECT (select count(id_postagem) from postagem where Month(postado) = :atual) as Mes_Atual, (select count(id_postagem) from postagem where Month(postado) = :passado) as Mes_Passado, (select count(id_postagem) from postagem where Month(postado) = :repassado) as Mes_Repassado;");
    $postagem->bindParam(':repassado', $mesrepassado);
    $postagem->bindParam(':passado', $mespassado);
    $postagem->bindParam(':atual', $mesatual);
    $postagem->execute();

    if($postagem->rowCount()){
        $LinhaDados = $postagem->fetch(PDO::FETCH_ASSOC);

        $repassado = $LinhaDados['Mes_Repassado'];
        $passado = $LinhaDados['Mes_Passado'];
        $atual = $LinhaDados['Mes_Atual'];
    }
?>

<script>

const labels12 = [
    '<?=strftime('%b', strtotime('-2 month'))?>',
    '<?=strftime('%b', strtotime('-1 month'))?>',
    '<?=strftime('%b', strtotime('today'))?>',
];

const data12 = {
    labels: labels12,
    datasets: [{
        data: ['<?=$repassado?>', '<?=$passado?>', '<?=$atual?>'],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
        ],
        borderWidth: 3,
        tension: 0.5
    }]
};

const config12 = {
    type: 'line',
    data: data12,
    options: {
        plugins: {
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: 'Postagens Mensais',
                font: {
                    size: 20,
                },
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        },
    },
};


const PostagemMes = new Chart(
    document.getElementById('ChartsPostagemMes'),
    config12
);

</script>