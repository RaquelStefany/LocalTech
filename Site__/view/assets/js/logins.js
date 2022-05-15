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

//CPF 
let value_cpf = document.querySelector('#campo_cpf');

value_cpf.addEventListener("blur", function(e) {
    //Remove tudo o que não é dígito
    let validar_cpf = this.value.replace( /\D/g , "");

    //verificação da quantidade números
    if (validar_cpf.length==11){

    // verificação de CPF valido
        var Soma;
        var Resto;

        Soma = 0;
        for (i=1; i<=9; i++) Soma = Soma + parseInt(validar_cpf.substring(i-1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(validar_cpf.substring(9, 10)) ) return alert("CPF Inválido!");;

        Soma = 0;
        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(validar_cpf.substring(i-1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(validar_cpf.substring(10, 11) ) ) return alert("CPF Inválido!");;

        //formatação final
        cpf_final = validar_cpf.replace( /(\d{3})(\d)/ , "$1.$2");
        cpf_final = cpf_final.replace( /(\d{3})(\d)/ , "$1.$2");
        cpf_final = cpf_final.replace(/(\d{3})(\d{1,2})$/ , "$1-$2");
        document.getElementById('campo_cpf').value = cpf_final;
    }
})

function _cpf(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '') return false;
    if (cpf.length != 11 ||
    cpf == "00000000000" ||
    cpf == "11111111111" ||
    cpf == "22222222222" ||
    cpf == "33333333333" ||
    cpf == "44444444444" ||
    cpf == "55555555555" ||
    cpf == "66666666666" ||
    cpf == "77777777777" ||
    cpf == "88888888888" ||
    cpf == "99999999999")
    return false;
    add = 0;
    for (i = 0; i < 9; i++)
    add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
    rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
    return false;
    add = 0;
    for (i = 0; i < 10; i++)
    add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
    rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
    return false;
    return true;
}
function validarCPF(el){
    if( !_cpf(el.value) ){
    alert("CPF inválido! " + el.value);
    // apaga o valor
    el.value = "";
    }
}

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

$('form input').on('change', function() {
    var pessoa = $('input[name=pessoa]:checked').val();
    if (pessoa == "CPF"){
        $("#cpf").css("display", "grid");
        $("#cnpj").css("display", "none");
    }
    if (pessoa == "CNPJ"){
        $("#cnpj").css("display", "grid");
        $("#cpf").css("display", "none");
    }
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