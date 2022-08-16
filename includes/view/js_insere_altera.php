<!-- Specific Page Vendor -->
<script src="vendor/autosize/autosize.js"></script>
<script src="js/view/insere_altera.js"></script>
<script src="vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="vendor/jquery-mask-plugin/src/jquery.mask.js"></script>



<!-- INSERE_ALTERA   -->
<script src="js/validation.js"></script>


<script>

    $(document).ready(function(){
        $('.date').mask('00/00/0000');
        $('.time').mask('00:00:00');
        $('.date_time').mask('00/00/0000 00:00:00');
        $('.cep').mask('00000-000');
        $('.phone').mask('0000-0000');
        $('.phone_with_ddd').mask('(00) 0000-0000');
        $('.phone_us').mask('(000) 000-0000');
        $('.mixed').mask('AAA 000-S0S');
        $('.cpf').mask('000.000.000-00', {reverse: true});
        $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
        $('.money2').mask("#.##0,00", {reverse: true});
        $('.ip_address').mask('099.099.099.099');
        $('.percent').mask('##0,00%', {reverse: true});
        $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
        $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
        $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
    });

    function FormataMoney(i) {
        var v = i.value.replace(/\D/g,'');
        v = (v/100).toFixed(2) + '';
        v = v.replace(".", ",");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
        v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
        i.value = v;
    }

    function formataData(campo, teclapres){
        var tecla = teclapres.keyCode;
        var vr = new String(campo.value);
        vr = vr.replace("/", "");
        tam = vr.length + 1;
        if (tecla != 8)
        {
            if (tam == 3)
                campo.value = vr.substr(0, 2) + '/';
            if (tam == 5)
                campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/';
            if (tam == 11)
                campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/' + vr.substr(6, 4);
        }
    }

    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#EndRua").val("");
            $("#EndBairro").val("");
            $("#EndCidade").val("");
            $("#EndEstado").val("");
        }

        //Quando o campo cep perde o foco.
        $("#EndCep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                // if(validacep.test(cep)) {

                //Apaga os campos enquanto consulta webservice.
                $("#EndRua").val("");
                $("#EndBairro").val("");
                $("#EndCidade").val("");
                $("#EndEstado").val("");

                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#EndRua").val(dados.logradouro);
                        $("#EndBairro").val(dados.bairro);
                        $("#EndCidade").val(dados.localidade);
                        $("#EndEstado").val(dados.uf);

                        $("#EndRua").attr("disabled",false);
                        $("#EndNumero").attr("disabled",false);
                        $("#EndComplemento").attr("disabled",false);
                        $("#EndBairro").attr("disabled",false);
                        $("#EndCidade").attr("disabled",false);
                        $("#EndEstado").attr("disabled",false);

                        $('#EndNumero').focus();
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
                //end if.

            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });

    /**
     * @return {boolean}
     */
    function ValidarCpf() {
        let sCpf = $("#PfiCpf").val();
        sCpf = sCpf.replace(/[^\d]+/g, '');

        if (sCpf === ''){
            $("#formButton").hide();
            $("#PfiCpf").css("borderColor","#E04B4A");
            return false;
        }
        // Elimina CPFs invalidos conhecidos
        if (sCpf.length !== 11 ||
            sCpf === "00000000000" ||
            sCpf === "11111111111" ||
            sCpf === "22222222222" ||
            sCpf === "33333333333" ||
            sCpf === "44444444444" ||
            sCpf === "55555555555" ||
            sCpf === "66666666666" ||
            sCpf === "77777777777" ||
            sCpf === "88888888888" ||
            sCpf === "99999999999"){
            $("#formButton").hide();
            $("#PfiCpf").css("borderColor","#E04B4A");
            return false;
        }

        // Valida 1o digito
        add = 0;
        for (i = 0; i < 9; i++)
            add += parseInt(sCpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev === 10 || rev === 11)
            rev = 0;
        if (rev !== parseInt(sCpf.charAt(9))){
            $("#formButton").hide();
            $("#PfiCpf").css("borderColor","#E04B4A");
            return false;
        }
        // Valida 2o digito
        add = 0;
        for (i = 0; i < 10; i++)
            add += parseInt(sCpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev === 10 || rev === 11)
            rev = 0;
        if (rev !== parseInt(sCpf.charAt(10))){
            $("#formButton").hide();
            $("#PfiCpf").css("borderColor","#E04B4A");
            return false;
        }

        $("#PfiCpf").css("borderColor","blue");
        $("#formButton").show();
    }

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
</script>