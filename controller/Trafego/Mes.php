<?php

    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $dataatual = date('m');
    $mesatual = $dataatual;

    $datapassada = date('m', strtotime('-1 month'));
    $mespassado = $datapassada;

    $datarepassado = date('m', strtotime('-2 month'));
    $mesrepassado = $datarepassado;

    $porcentagem = $conexao->prepare("SELECT ((select count(id_cliente) from cliente WHERE Month(cadastro) = :repassado) + (select count(id_tecnico) from tecnico WHERE Month(cadastro) = :repassado) + (select count(id_assistencia) from assistencia WHERE Month(cadastro) = :repassado)) as Mês_Repassado, ((select count(id_cliente) from cliente WHERE Month(cadastro) = :passado) + (select count(id_tecnico) from tecnico WHERE Month(cadastro) = :passado) + (select count(id_assistencia) from assistencia WHERE Month(cadastro) = :passado)) as Mês_Passado, ((select count(id_cliente) from cliente WHERE Month(cadastro) = :atual) + (select count(id_tecnico) from tecnico WHERE Month(cadastro) = :atual) + (select count(id_assistencia) from assistencia WHERE Month(cadastro) = :atual)) as Mês_Atual;");
    $porcentagem->bindParam(':repassado', $mesrepassado);
    $porcentagem->bindParam(':passado', $mespassado);
    $porcentagem->bindParam(':atual', $mesatual);
    $porcentagem->execute();

    if($porcentagem->rowCount()){
        $LinhaDados = $porcentagem->fetch(PDO::FETCH_ASSOC);
        
        $repassado = $LinhaDados['Mês_Repassado'];
        $passado = $LinhaDados['Mês_Passado'];
        $atual = $LinhaDados['Mês_Atual'];
    }
?>

<script>

const labels3 = [
    '<?=strftime('%b', strtotime('-2 month'))?>',
    '<?=strftime('%b', strtotime('-1 month'))?>',
    '<?=strftime('%b', strtotime('today'))?>',
];

const data3 = {
    labels: labels3,
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

const config3 = {
    type: 'line',
    data: data3,
    options: {
        plugins: {
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: 'Cadastros Últimos Mensais',
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


const Mes = new Chart(
    document.getElementById('ChartsMes'),
    config3
);

</script>