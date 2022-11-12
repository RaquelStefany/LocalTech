<?php

    $porcentagem = $conexao->prepare("SELECT (select count(id_status) from status where status = 'Online' or status = 'Em Atendimento') as Online, (select count(id_status) from status where status = 'Offline') as Offline;");
    $porcentagem->execute();

    if($porcentagem->rowCount()){
        $LinhaDados = $porcentagem->fetch(PDO::FETCH_ASSOC);

        $total = $LinhaDados['Online'] + $LinhaDados['Offline'];

        $online = ($LinhaDados['Online'] / $total) * 100;
        $offline = ($LinhaDados['Offline'] / $total) * 100;
    }
?>

<script>

const labels5 = [
    'Online',
    'Offline',
];

const data5 = {
    labels: labels5,
    datasets: [{
        data: ['<?=intval($online)?>', '<?=intval($offline)?>'],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
        ],
        borderWidth: 1,
        hoverOffset: 4
    }]
};

const config5 = {
    type: 'doughnut',
    data: data5,
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Porcentagem de Usuários Online',
                font: {
                    size: 20,
                },
            }
        },
    },
};


const Status = new Chart(
    document.getElementById('ChartsStatus'),
    config5
);

</script>