<?php
 $sOP = $_REQUEST['sOP'];
 $oAcessoPermissaoGrupo = @$_REQUEST['oAcessoPermissaoGrupo'];
 $oAcessoGrupo = @$_REQUEST['oAcessoGrupo'];
 ?>
    
<!doctype html>
<html class="fixed sidebar-left-collapsed" lang="pt-br">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">
        <title><?php echo SYSTEM_NAME. ' - '. SYSTEM_INITIALS; ?></title>
        <meta name="keywords" content="<?php echo KEYWORDS; ?>" />
        <meta name="description" content="<?php echo DESCRIPTION; ?>">
        <meta name="author" content="<?php echo AUTHOR; ?>">
        <?php include_once("includes/head.php"); ?>
        <style type="text/css">
            .ul-list {
                list-style: none;
            }
            .ul-list li {
                margin: 5px;
            }
            .ul-list li a {
            padding-bottom: 5px;
            }
            .collapse-sinal {
                color: #555;
            }
            div#accordion {
                border: 1px solid #ccc;
                padding: 5px;
                margin: 15px;
                padding-top:25px;
            }
            .label-check {
                font-weight: bold;
            }
            .modulo {
                font-weight: bold;
            }
        </style>
    </head>
    
    <?php include_once("includes/head-body.php"); ?>    

  					    <div class="col-lg-12 text-1">
                            <section class="card">
                                 <header class="card-header">
  									<h2 class="card-title">Configurar Perfíl</h2>
  								    <p class="card-subtitle"> Editar Permissões do Perfíl  </p>
  							    </header>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="" style="width: 400px">
                                            <section class="card mb-4">
                                                <div class="card-body bg-primary">
                                                    <div class="widget-summary">
                                                        <div class="widget-summary-col widget-summary-col-icon">
                                                            <div class="summary-icon">
                                                                <i class="fas fa-life-ring" style="margin-top: 20px;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="widget-summary-col">
                                                            <div class="summary">
                                                                <h4 class="title"><strong class="amount"><?php echo $oAcessoGrupo->getNome();?></strong> </h4>
                                                                <div class="info">
                                                                    Perfil Herdado: <?php echo $oAcessoGrupo->getIdGrupoPai()?$oAcessoGrupo->getAcessoGrupo()->getNome():' Nenhum';?>
                                                                </div>
                                                            </div>
                                                            <div class="summary-footer">
                                                                <?php echo $oAcessoGrupo->getAtivo()?'Ativo':'Inativo';?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                        
                                    </div>

                                    <form action="?action=AcessoPermissaoGrupo.processaFormulario" method="post">
                                        <input type="hidden" name="sOP" value="Cadastrar" />
                                        <input type="hidden" name="fIdGrupo" value="<?php echo $oAcessoGrupo->getIdGrupo();?>" />
                                        <input type="hidden" name="" value="" />
                                        <div class="accordion" id="accordion">
                                            <ul  class="ul-list">
                                                <?php echo $sListInputs;?>
                                            </ul>
                                        </div>

                                        <button class="btn btn-primary" type="submit">Cadastrar</button>
                                    </form>

                                    <br />
                                    <br />
                                    <br />

                                    <a href="?action=AcessoPermissaoGrupo.preparaLista"><button type="button" class="btn btn-sm btn-info "><i class="fa fa-angle-left"></i> Voltar</button></a>
                                 </div>
                            </section>
                        </div>
           
           
    <?php include_once("includes/foot-body.php"); ?>

    <!-- Scripts Complementares -->
    <script type="text/javascript">
            $(function(){


                //Evento de clique dos checkboxes de permissão
                $(".check").on('change', function(){
                    //------------------------------------------------------------------------
                    //Verifica se o item foi marcado
                    if($(this).prop("checked")) {

                        //Verifica se o item marcado foi Allow
                        if($(this).hasClass('Allow')) {
                            $('#d_' + $(this).val()).prop('checked', false);
                            unCheckElements($('#d_' + $(this).val()));
                        } else {  //Se Deny
                            $('#a_' + $(this).val()).prop('checked', false);
                            unCheckElements($('#a_' + $(this).val()));
                        }

                    //Marca todos os elementos da hierarquia abaixo
                    checkElements($(this));


                    //------------------------------------------------------------------------
                    //Verifica se o item foi desmarcado
                    } else {
                        //Verifica se o item marcado foi Allow
                        if($(this).hasClass('Allow')) {
                            var elemDeny = $('#d_' + $(this).val());
                            //Verifica se o checkbox oposto está desabilitado caso sim remarca-o
                            if(elemDeny.prop('disabled')) {
                                elemDeny.prop('checked', true);
                                checkElements(elemDeny);
                            }
                        } else {  //Se Deny
                            var elemAllow = $('#a_' + $(this).val());
                            if(elemAllow.prop('disabled')) {
                                elemAllow.prop('checked', true);
                                checkElements(elemAllow);
                            }
                        }
                    //Desmarca todos os elementos da hierarquia
                        unCheckElements($(this));
                    }
                });


                //Função para marcar os checkboxes recursivamente na estrutura hierárquica
                var checkElements = function(elemParent) {
                    //Pega um array de elementos filhos
                    var elemChilds = $(".checkPai-" + elemParent.prop('id'));
                    //Verifica se o elemento possui elementos filhos
                    if(elemChilds.length) {
                        //Seleciona todos os filhos e os desabilita
                        elemChilds.prop('checked', true);
                        elemChilds.prop("disabled", true);
                        //Aplica recurssividade para cada um dos filhos no próprio método
                        elemChilds.each(function(){
                            checkElements($(this));
                        });
                    }
                }


                //Função para desmarcar os checkboxes recursivamente na estrutura hierárquica
                var unCheckElements = function(elemParent) {
                    //Pega um array de elementos filhos
                    var elemChilds = $(".checkPai-" + elemParent.prop('id'));
                    //Verifica se o elemento possui elementos filhos
                    if(elemChilds.length) {
                        //Deseleciona todos os filhos e os habilita
                        elemChilds.prop('checked', false);
                        elemChilds.prop("disabled", false);
                        //Aplica recurssividade para cada um dos filhos no próprio método
                        elemChilds.each(function(){
                            unCheckElements($(this));
                        });
                    }
                }


                //Collapse accordion, troca o sinal
                $('.accordion-toggle').on("click", function() {
                    if($("#collapse-sinal-"+$(this).data('id')).text() == '+')
                        $("#collapse-sinal-"+$(this).data('id')).text('-');
                    else if($("#collapse-sinal-"+$(this).data('id')).text() == '-')
                        $("#collapse-sinal-"+$(this).data('id')).text('+');
                });

    <?php     //Para o caso de edição os itens do pérfil são recuperados e marcados
            if($voAcessoPermissaoGrupo)
                foreach($voAcessoPermissaoGrupo as $oAcessoPermissaoGrupo)
                    if($oAcessoPermissaoGrupo->getPermissao()) {
    ?>                   $("#a_"+<?php echo $oAcessoPermissaoGrupo->getIdModuloTransacao();?>).trigger('click');
    <?php            } else {
    ?>                   $("#d_"+<?php echo $oAcessoPermissaoGrupo->getIdModuloTransacao();?>).trigger('click');
    <?php            }


    ?>

            });

        </script>
     
     


     
 </html>