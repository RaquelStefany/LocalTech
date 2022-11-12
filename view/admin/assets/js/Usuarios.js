window.onload = updateUserOnly();

function updateUserOnly(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("tt-only").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../../controller/Dados/QuantidadeUsuarios/Onlines.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateUserOnly(); }, 500);
}

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