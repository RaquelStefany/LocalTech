window.onload = updateAtendimentos();

function updateAtendimentos(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("at-chat").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../../controller/Dados/Atendimentos/Total-Atendimentos.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateAtendimentos(); }, 500);
}

window.onload = updateReabertos();

function updateReabertos(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("at-rea").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../../controller/Dados/Atendimentos/Total-Reabertos.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateReabertos(); }, 500);
}

window.onload = updateClientesAt();

function updateClientesAt(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("at-cli").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../../controller/Dados/Atendimentos/Ultimo-Cliente.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateClientesAt(); }, 500);
}

window.onload = updateTecnicoAt();

function updateTecnicoAt(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("at-tec").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../../controller/Dados/Atendimentos/Ultimo-Tecnico.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateTecnicoAt(); }, 500);
}