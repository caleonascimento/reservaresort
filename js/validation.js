(function() {

    'use strict';

    //custom Form
    $("#form-custom").validate({
        rules: {
            fMatricula: {
                required: true,
                number: true
            },
            fVinculo: {
               required: true,
               number: true,
               maxlength: 2
            },
            fNome: {
                required: true,
                minlength: 2,
                minWords: 2,
                alphabetic: true
                },
            fCpf: {
                required: true,
                cpfBR: true
                },
            fDataNascimento: "required",
            fCidadeNascimento: {
              required: true,
              minlength: 2,
              alphabetic: true
            },
            fUfNascimento: "required",
            fSexo: "required",

            fNomePai: {
                minlength: 2,
                minWords: 2,
                alphabetic: true
            },
            fNomeMae: {
                required: true,
                minlength: 2,
                minWords: 2,
                alphabetic: true
            },
            fNacionalidade: {
                required: true,
                minlength: 2,
                alphabetic: true
            },
            fGrupoSanguineo: "required",
            fIdRegimeJuridico: "required",
            fIdTipoVinculo: "required",
            fDataExercicio: "required",
            fEstadoCivil: "required",
            fEscolaridade: "required",
            fNumRg: {
                required: true,
                minlength: 3,
                number:true
            },
            fExpRg: "required",
            fEstadoRg: "required",
            /*fNumCnh: {
                required: true,
                cnhBR: true
            },
            fCatCnh: "required",
            fValidadeCnh: "required",
            fUfCnh: "required",*/
            fTipoEndereco: "required",
            fLogradouro: "required",
            fNumero: "required",
            fComplemento: "required",
            fBairro: {
                required: true,
                alphabetic: true
            },
            fCidade: "required",
            fUfEnderecos: "required",
            fCep:{
                required: true,
                postalcodeBR: true
            },
            //fTelefone: "required",
            fCelular: "required",
            fEmailPessoal: "required",
            //fLoginGovernoDigital: "required",
            fEmailInstitucional: "required"
        }
    });

    //$('#fCpf').mask('999.999.999-99');


    // basic
    $("#form").validate({
        rules: {
            fieldTest: {
                required:true
            }
        },
        highlight: function( label ) {
            $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function( label ) {
            $(label).closest('.form-group').removeClass('has-error');
            label.remove();
        },
        errorPlacement: function( error, element ) {
            var placement = element.closest('.input-group');
            if (!placement.get(0)) {
                placement = element;
            }
            if (error.text() !== '') {
                placement.after(error);
            }
        }
    });



    // validation summary
    var $summaryForm = $("#summary-form");
    $summaryForm.validate({
       /*	errorContainer: $summaryForm.find( 'div.validation-message' ),
        errorLabelContainer: $summaryForm.find( 'div.validation-message ul' ),*/
        wrapper: "span"
    });

      

    // checkbox, radio and selects
    $("#chk-radios-form, #selects-form").each(function() {
        $(this).validate({
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorPlacement: function( error, element ) {
                var placement = $(element).parent();

                placement.append(error);
            }
        });
    });

    // Select 2 Fields
    $('select[data-plugin-selectTwo]').on('change', function() {
        $(this).valid();
    });

}).apply(this, [jQuery]);