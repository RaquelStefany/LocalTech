<?php

    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $dataatual = date('m');
    $mesatual = $dataatual;

    $datapassada = date('m', strtotime('-1 month'));
    $mespassado = $datapassada;

    $datarepassado = date('m', strtotime('-2 month'));
    $mesrepassado = $datarepassado;

    $porcentagem = $conexao->prepare("SELECT (select count(id_atendimento) from atendimento where Month(fim) = :atual) as Mes_Atual, (select count(id_atendimento) from atendimento where Month(fim) = :passado) as Mes_Passado, (select count(id_atendimento) from atendimento where Month(fim) = :repassado) as Mes_Repassado;");
    $porcentagem->bindParam(':repassado', $mesrepassado);
    $porcentagem->bindParam(':passado', $mespassado);
    $porcentagem->bindParam(':atual', $mesatual);
    $porcentagem->execute();

    if($porcentagem->rowCount()){
        $LinhaDados = $porcentagem->fetch(PDO::FETCH_ASSOC);

        $repassado = $LinhaDados['Mes_Repassado'];
        $passado = $LinhaDados['Mes_Passado'];
        $atual = $LinhaDados['Mes_Atual'];
    }
?>

<script>

const labels6 = [
    '<?=strftime('%b', strtotime('-2 month'))?>',
    '<?=strftime('%b', strtotime('-1 month'))?>',
    '<?=strftime('%b', strtotime('today'))?>',
];

const data6 = {
    labels: labels6,
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

const config6 = {
    type: 'line',
    data: data6,
    options: {
        plugins: {
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: 'Atendimentos Mensais Finalizados',
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


const AtendimentosMes = new Chart(
    document.getElementById('ChartsAtendimentosMes'),
    config6
);

</script>