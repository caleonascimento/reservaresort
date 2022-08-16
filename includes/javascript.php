<!-- Vendor -->
<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="vendor/popper/umd/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.js"></script>
<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="vendor/common/common.js"></script>
<script src="vendor/nanoscroller/nanoscroller.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="vendor/jquery-placeholder/jquery.placeholder.js"></script>


<!-- Specific Page Vendor -->
<script src="vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js"></script>
<script src="vendor/jquery-appear/jquery.appear.js"></script>
<script src="vendor/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script src="vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
<script src="vendor/jquery.easy-pie-chart/jquery.easypiechart.js"></script>
<script src="vendor/flot/jquery.flot.js"></script>
<script src="vendor/flot.tooltip/jquery.flot.tooltip.js"></script>
<script src="vendor/flot/jquery.flot.pie.js"></script>
<script src="vendor/flot/jquery.flot.categories.js"></script>
<script src="vendor/flot/jquery.flot.resize.js"></script>
<script src="vendor/jquery-sparkline/jquery.sparkline.js"></script>
<script src="vendor/raphael/raphael.js"></script>
<script src="vendor/morris/morris.js"></script>
<script src="vendor/gauge/gauge.js"></script>
<script src="vendor/snap.svg/snap.svg.js"></script>
<script src="vendor/liquid-meter/liquid.meter.js"></script>
<script src="vendor/jqvmap/jquery.vmap.js"></script>
<script src="vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
<script src="vendor/jqvmap/maps/jquery.vmap.world.js"></script>
<script src="vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
<script src="vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
<script src="vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
<script src="vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
<script src="vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
<script src="vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>


<!-- Specific Page Vendor INDEX (DATATABLES)-->
<script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"></script>
<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"></script>
<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"></script>
<script src="vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>
<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.21/sorting/formatted-numbers.js"></script>


<!-- Specific Page Vendor INSERE_ALTERA-->
<script src="vendor/jquery-validation/jquery.validate.js"></script>
<script src="vendor/select2/js/select2.js"></script>
<script src="vendor/pnotify/pnotify.custom.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="js/theme.js"></script>

<!-- Default  -->
<script src="js/default.js"></script>

<!-- Theme Custom    -->
<script src="js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="js/theme.init.js"></script>

<!-- Notify Initialization -->
<script src="js/notify.init.js"></script>

<!-- Mask -->
<script src="vendor/mask/jquery.maskedinput.js"></script>
<script src="vendor/mask/jquery.maskMoney.js"></script>
<script src="vendor/inputmask/dist/jquery.inputmask.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("body").tooltip({ selector: '[data-toggle=tooltip]' });
    });

    function recuperaConteudoDinamico(sArquivo,sParametros,sIdDivInsert){

        let oDiv = document.getElementById(sIdDivInsert);
        sArquivo = sArquivo+sParametros;

        $.ajax({
            dataType: "html",
            type: "GET",
            beforeSend: function() {
                oDiv.innerHTML = "<p style='text-align: center'><img src='img/load.gif' alt='' style='width: 80px'></p>";
            },
            url: sArquivo,
            error: function(oXMLRequest,sErrorType){
                console.log(sArquivo);
                console.log(oXMLRequest.responseText);
                console.log(oXMLRequest.status+' , '+sErrorType);
            },
            success: function(data){
                oDiv.innerHTML = data;
            }
        });
    }

    //----------------------------------------------
    $(function(){
           $(".viewNotify").on("click", function(){
               var self = $(this);
               var total = $(".totalMensagens").html();
               
               
                        
               $.post("includes/ajax/viewNotify.php", {id:$(this).data('id')}, function(data) {
                    //Caso a alteração ajax seja feita
                    if(data == '1') {
                        //Atualiza o contador de notificações não lidas
                        $(".total"+self.data('tipo')).html(total - 1);
                        //Apaga o balão de notificação caso o contador seja 0
                        if(total == 1)
                            $(".totalMensagens").hide();
                        //Redireciona caso haja algum link
                        if(self.data('link'))
                            window.location.href = self.data('link');
                        //Remove o envento do item
                        self.removeClass("viewNotify"); //Remove classe do  evento
                        self.off(); //Remove o evento em si
                        //Remove o negrito do item não lido    
                        self.children("span").removeClass("font-weight-bold");
                    } else {
                        customNotify("Não possível acessar o item!", {title:"Erro",type:3,position:"right"});
                        console.log("Erro: O item não pode ser alterado!");
                    }
               });
           });
    });
       
    
</script>