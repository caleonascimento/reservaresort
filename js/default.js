/* Add here all your JS customizations */

 /* Customização do DataTable */
 // Data Tables - Config
(function($) {

    'use strict';

    // we overwrite initialize of all datatables here
    // because we want to use select2, give search input a bootstrap look
    // keep in mind if you overwrite this fnInitComplete somewhere,
    // you should run the code inside this function to keep functionality.
    //
    // there's no better way to do this at this time :(
    if ( $.isFunction( $.fn[ 'dataTable' ] ) ) {

        $.extend(true, $.fn.dataTable.defaults, {
                oLanguage: {
                sLengthMenu: '_MENU_registros',
                sProcessing: '<i class="fas fa-spinner fa-spin"></i> Carregando',
                sSearch: ''

            },
            fnInitComplete: function( settings, json ) {
                // select 2
                if ( $.isFunction( $.fn[ 'select2' ] ) ) {
                    $('.dataTables_length select', settings.nTableWrapper).select2({
                        theme: 'bootstrap',
                        minimumResultsForSearch: -1
                    });
                }
                //$('.select2-selection').addClass('form-control-sm');
               // $sLengthMenu select2-selection select2-selection--single

                var options = $( 'table', settings.nTableWrapper ).data( 'plugin-options' ) || {};

                // search
                var $search = $('.dataTables_filter input', settings.nTableWrapper);

                $search
                    .attr({
                        placeholder: typeof options.searchPlaceholder !== 'undefined' ? options.searchPlaceholder : 'Procurar...'
                    })
                    .removeClass('form-control-sm').addClass('form-control pull-right');

                if ( $.isFunction( $.fn.placeholder ) ) {
                    $search.placeholder();
                }
            }
        });

    }

}).apply(this, [jQuery]);



(function($) {

    'use strict';

    var datatableInit = function() {
        var $table = $('#datatable-tabletools');

        var table = $table.dataTable({

            sDom: '<"text-right mb-md"T><"row"<"col-lg-8"l><"col-lg-4"f>><"table-responsive"t>p',
            buttons: [ {extends: 'print', text: 'Imprimir'}, 'excel', 'pdf' ],
            "language": {
                "paginate": {
                            "next": "Próxima",
                            "previous": "Anterior"
                            }
            }
        });

        $('<div />').addClass('dt-buttons mb-2 pb-1 text-right').prependTo('#datatable-tabletools_wrapper');

        $table.DataTable().buttons().container().prependTo( '#datatable-tabletools_wrapper .dt-buttons' );

        $('#datatable-tabletools_wrapper').find('.btn-secondary').removeClass('btn-secondary').addClass('btn-default');
        $("#datatable-tabletools_filter").append('<button class="btn btn-default icon-search" type="button"><span class="input-group-addon"><i class="fa fa-search"></i></span></button>');
    };

    $(function() {
        datatableInit();
    });

}).apply(this, [jQuery]);
//---------------------------------------------------------------------------------------



/* **************************************
   **** Funções para ações das view ****
   ***************************************/

function submeteForm(sNome) {
    if (validaAcoes(sNome)) { 
        oSelect = document.getElementById('acoes' + sNome);
        oForm = document.getElementById('form' + sNome);
        oForm.action = oSelect.value;

        if (oSelect.value.indexOf("sOP=Excluir") > 0) {
            var nRegistros = "";
            camposMarcados = new Array();
            $("input[type=checkbox][name='fId" + sNome + "[]']:checked").each(function () {
                camposMarcados.push($(this).val());
            });
            nRegistros = camposMarcados.toString().split(',').join('____');
            sLink = oSelect.value + "&fId" + sNome + "=" + nRegistros;
            $("#confirm-delete").on("shown.bs.modal", function () {
                $(this).find('#ok').attr('href', sLink);
            });
            $('#confirm-delete').modal('show');

            return false;
        } else {
            oForm.submit();
            return true;
        }
    }

}

function validaAcoes(sNome){
    oSelect = document.getElementById('acoes'+sNome);
    nChecados = retornaChecados(sNome);
    switch(oSelect.options[oSelect.selectedIndex].lang){
        case '0':
            if(nChecados > 0){
                alert("Nenhum registro deve estar marcado para realizar esta ação!");
                oSelect.options[0].selected = true;
                return false;
            }
            return true;
            break;
        case '1':
            if(nChecados != 1 ){
                alert("Apenas um registro deve estar marcado para realizar esta ação!");
                oSelect.options[0].selected = true;
                return false;
            }
            return true;
            break;
        case '2':
            if(nChecados < 1 ){
                alert("Pelo menos um registro deve estar marcado para realizar esta ação!");
                oSelect.options[0].selected = true;
                return false;
            }
            return true;
            break;
    }
}

function retornaChecados(sNome){
    var nChecados = 0;
    oForm = document.getElementById('form'+sNome);
    for(var i = 1; i < oForm.length; i++){
        if(oForm.elements[i].type == 'checkbox'){
            if(oForm.elements[i].checked)
                nChecados++;
        }
    }
    return nChecados;
}

function marcarTodosCheckBoxFormulario(sIdForm){
    nChecados = retornaChecados(sIdForm);
    bMarcado = true;
    if(nChecados >= 1)
        bMarcado = false;

    oForm = document.getElementById('form'+sIdForm);
    vElements = oForm.getElementsByTagName('INPUT');
    for(i = 0; i < vElements.length; i++){
        if(vElements[i].type == 'checkbox'){
            vElements[i].checked = bMarcado;
        }
    }
    atualizaAcoes(sIdForm);
}

function atualizaAcoes(sNome){
    oSelect = document.getElementById('acoes'+sNome);
    nChecados = retornaChecados(sNome);
    if(nChecados == 0){
        for(var i = 0; i < oSelect.length; i++){
            if(oSelect.options[i].lang == '1' || oSelect.options[i].lang == '2')
                oSelect.options[i].disabled = true;
            else
                oSelect.options[i].disabled = false;
        }
    }
    if(nChecados == 1){
        for(var i = 0; i < oSelect.length; i++){
            if(oSelect.options[i].lang == '0')
                oSelect.options[i].disabled = true;
            else
                oSelect.options[i].disabled = false;
        }
    }
    if(nChecados > 1){
        for(var i = 0; i < oSelect.length; i++){
            if(oSelect.options[i].lang == '0' || oSelect.options[i].lang == '1')
                oSelect.options[i].disabled = true;
            else
                oSelect.options[i].disabled = false;
        }
    }
    oSelect.options[0].selected = true;
}

//----------------------------------------------------------------------------------------