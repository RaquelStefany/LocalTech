//Imagem
function readImage() {
    if (this.files && this.files[0]) {
        var file = new FileReader();
        file.onload = function(e) {
            document.getElementById("preview").src = e.target.result;
        };       
        file.readAsDataURL(this.files[0]);
    }
}
document.getElementById("imagem").addEventListener("change", readImage, false);

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
