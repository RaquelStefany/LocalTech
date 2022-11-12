window.onload = updateUserOnly();

function updateUserOnly(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("tt-only").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../controller/Dados/QuantidadeUsuarios/Onlines.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateUserOnly(); }, 500);
}

window.onload = updateCliAdd();

function updateCliAdd(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("ult-cli").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../controller/Dados/UltimosUsuarios/Clientes.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateCliAdd(); }, 500);
}

window.onload = updateTecAdd();

function updateTecAdd(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("ult-tec").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../controller/Dados/UltimosUsuarios/Tecnicos.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateTecAdd(); }, 500);
}

window.onload = updateAssAdd();

function updateAssAdd(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("ult-ass").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../controller/Dados/UltimosUsuarios/Assistencias.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ updateAssAdd(); }, 500);
}

window.onload = TotalCliente();

function TotalCliente(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("tt-cli").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../controller/Dados/QuantidadeUsuarios/Clientes.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ TotalCliente(); }, 500);
}

window.onload = TotalTecnico();

function TotalTecnico(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("tt-tec").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../controller/Dados/QuantidadeUsuarios/Tecnicos.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ TotalTecnico(); }, 500);
}

window.onload = TotalAssistencia();

function TotalAssistencia(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("tt-ass").innerHTML = xhttp.response;
        }
    };
    xhttp.open("GET", "../../../controller/Dados/QuantidadeUsuarios/Assistencias.php", true);
    xhttp.send();
    //Repetir após 5 segundos
    setTimeout(function(){ TotalAssistencia(); }, 500);
}