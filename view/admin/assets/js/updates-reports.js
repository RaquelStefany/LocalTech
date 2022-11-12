window.onload = updateReports();

function updateReports(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("at-reports").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../../controller/Reportar/Admin/Reports.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateReports(); }, 500);
}

window.onload = updateRespondidos();

function updateRespondidos(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("at-respondidos").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../../controller/Reportar/Admin/Respondidos.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateRespondidos(); }, 500);
}

window.onload = updateClientes();

function updateClientes(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("at-clientes").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../../controller/Reportar/Admin/Clientes.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateClientes(); }, 500);
}

window.onload = updateTecnicos();

function updateTecnicos(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("at-tecnicos").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../../controller/Reportar/Admin/Tecnicos.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateTecnicos(); }, 500);
}

window.onload = updateAssistencias();

function updateAssistencias(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("at-assistencias").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../../controller/Reportar/Admin/Assistencias.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateAssistencias(); }, 500);
}