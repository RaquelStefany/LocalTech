const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

const pswrdField = document.querySelector(".password[type='password']"),
    toggleBtn = document.querySelector(".senha");

toggleBtn.onclick = () => {
    if (pswrdField.type == "password") {
        pswrdField.type = "text";
        toggleBtn.classList.add("active");
    } else {
        pswrdField.type = "password";
        toggleBtn.classList.remove("active");
    }
}

const pswrdField2 = document.querySelector(".password2[type='password']"),
    toggleBtn2 = document.querySelector(".senha2");

toggleBtn2.onclick = () => {
    if (pswrdField2.type == "password") {
        pswrdField2.type = "text";
        toggleBtn2.classList.add("active");
    } else {
        pswrdField2.type = "password";
        toggleBtn2.classList.remove("active");
    }
}

function ValidaEmail(){
    var obj = eval("document.forms[0].email");
    var txt = obj.value;
    if ((txt.length != 0) && ((txt.indexOf("@") < 1) || (txt.indexOf('.') < 7)))
    {
        alert('Email incorreto');
        obj.focus();
    }
}

// Celular
let campo_celular = document.querySelector('#campo_celular');

 campo_celular.addEventListener("blur", function(e) {
     //Remove tudo o que não é dígito
     let celular = this.value.replace( /\D/g , "");
   
     if (celular.length==11){
     celular = celular.replace(/^(\d{2})(\d)/g,"($1) $2"); 
     v = celular.replace(/(\d)(\d{4})$/,"$1-$2");
     document.getElementById('campo_celular').value = v;
    }
    else if (celular.length==10){
        celular = celular.replace(/^(\d{2})(\d)/g,"($1) $2"); 
        v = celular.replace(/(\d)(\d{4})$/,"$1-$2");
        document.getElementById('campo_celular').value = v;
    }
    else {
      alert("Telefone inválido.");
    }
 })

//CNPJ
document.getElementById('cnpj').addEventListener('input', function (e) {
    var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,4})(\d{0,2})/);
    e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + '.' + x[3] + '/' + x[4] + (x[5] ? '-' + x[5] : '');
});

function _cnpj(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, '');
    if (cnpj == '') return false;
    if (cnpj.length != 14)
    return false;
    if (cnpj == "00000000000000" ||
    cnpj == "11111111111111" ||
    cnpj == "22222222222222" ||
    cnpj == "33333333333333" ||
    cnpj == "44444444444444" ||
    cnpj == "55555555555555" ||
    cnpj == "66666666666666" ||
    cnpj == "77777777777777" ||
    cnpj == "88888888888888" ||
    cnpj == "99999999999999")
    return false;
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2)
    pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)) return false;
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2)
    pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
    return false;
    return true;
}
function validarCNPJ(el){
    if( !_cnpj(el.value) ){
    alert("CNPJ inválido! " + el.value);
    // apaga o valor
    el.value = "";
    }
}

$("#cep").focusout(function(){
    //Início do Comando AJAX
    $.ajax({
        //O campo URL diz o caminho de onde virá os dados
        //É importante concatenar o valor digitado no CEP
        url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/',
        //Aqui você deve preencher o tipo de dados que será lido,
        //no caso, estamos lendo JSON.
        dataType: 'json',
        //SUCESS é referente a função que será executada caso
        //ele consiga ler a fonte de dados com sucesso.
        //O parâmetro dentro da função se refere ao nome da variável
        //que você vai dar para ler esse objeto.
        success: function(resposta){
            //Agora basta definir os valores que você deseja preencher
            //automaticamente nos campos acima.
            $("#logradouro").val(resposta.logradouro);
            $("#complemento").val(resposta.complemento);
            $("#bairro").val(resposta.bairro);
            $("#cidade").val(resposta.localidade);
            $("#uf").val(resposta.uf);
            //Vamos incluir para que o Número seja focado automaticamente
            //melhorando a experiência do usuário
            $("#numero").focus();
        }
    });
});

//SENHA
function verificaForcaSenha(){
	var numeros = /([0-9])/;
	var alfabeto = /([a-zA-Z])/;
	var chEspeciais = /([.,~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;

	if($('#password').val().length<8) 
	{
		$('#password-status').html("<span style='color:red'>Fraco, insira no mínimo 8 caracteres</span>");
        $('#cadastrar').prop('disabled', true);
	} else {  	
		if($('#password').val().match(numeros) && $('#password').val().match(alfabeto) && $('#password').val().match(chEspeciais))
		{            
			$('#password-status').html("<span style='color:green'><b>Forte</b></span>");
            $('#cadastrar').prop('disabled', false);
		} else {
			$('#password-status').html("<span style='color:orange'>Médio, insira um caracter especial e um número</span>");
            $('#cadastrar').prop('disabled', true);
		}
	}
}