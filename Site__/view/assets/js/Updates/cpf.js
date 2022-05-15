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