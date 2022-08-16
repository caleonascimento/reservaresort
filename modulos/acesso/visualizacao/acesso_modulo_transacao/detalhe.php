<?php       
 $sOP = $_REQUEST['sOP'];
 $oAcessoModuloTransacao = @$_REQUEST['oAcessoModuloTransacao'];
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
	 <!-- css custon -->
	 <link rel="stylesheet" href="vendor/jstree/themes/default/style.css" />
 </head>
 
 <?php include_once("includes/head-body.php"); ?>       

                      <!-- start: page -->
  					<div class="row">
  					    <div class="col-lg-12">
                            <section class="card">
                                 <header class="card-header">
  								    <div class="card-actions">
  									   <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
  								    </div>
  									<h2 class="card-title">Gerênciamento de Módulos e Transações</h2>
  								    <p class="card-subtitle"> Mapeamento e Configuração das Páginas, Módulos e Transações  </p>
  							    </header>

                                <div class="card-body">
                                    <h3 class="card-title"><?php echo ($oAcessoModuloTransacao) ? $oAcessoModuloTransacao->getTitulo() : ""; ?> </h3>
  								    <p class="card-subtitle"><?php echo ($oAcessoModuloTransacao) ? $oAcessoModuloTransacao->getNome() : ""; ?> </p>
									<?php if(isset($oAcessoModuloTransacao) && !empty($oAcessoModuloTransacao)) { ?> <!-- start treeView-->
											<div id="treeBasic"> </div>
									<?php } ?>
									<br />
									<br />
									<br />
                     				<a href="?action=AcessoModuloTransacao.preparaLista">
									 	<button type="button" class="btn btn-sm btn-info "><i class="fa fa-angle-left"></i> Voltar</button>
									</a>
                                </div>
                            </section>
                         </div>
                     </div>

			<!-- Link invisivel - necessário para abrir o form -->
			<a class="modal-with-form btn btn-default d-none" href="#modalForm"></a>

        	<!-- Modal Form -->
        	<div id="modalForm" class="modal-block modal-block-primary mfp-hide text-xs">
        		<section class="card">
        		    	<form action="?action=AcessoModuloTransacao.processaFormulario" method="post">
        			<header class="card-header">
                        <button type="button" class="close modal-dismiss" data-dismiss="" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
    					</button>
                        <h2 class="card-title">Cadastrar Módulos/Transações</h2>
        			</header>
        			<div class="card-body">

        				    <input id="sOP" type="hidden" name='sOP' value="Cadastrar" />
        				    <input id="IdModuloTransacao" type="hidden" name='fIdModuloTransacao' value="" />
        				    <input id="IdModuloTransacao0" type="hidden" name='fIdModuloTransacao0' value="<?php echo $oAcessoModuloTransacao->getIdModuloTransacao();?>" />
        				    <input id="IdModuloTransacaoPai" type="hidden" name='fIdModuloTransacaoPai' value="" />    <!--Dinamic-->


    						<div class="form-group col-md-8">
    							<label for="inputTitulo">Titulo</label>
    							<input name="fTitulo" type="text" class="form-control" id="inputTitulo" placeholder="Titulo">
    						</div>

    						<div class="form-group col-md-6">
    							<label for="inputNome">Nome</label>
    							<input name="fNome" type="text" class="form-control" id="inputNome" placeholder="Nome">
    						</div>

        					<div class="form-group col-md-6">
        						<label for="inputAddress">Tipo</label>
        						<select name='fTipo' data-plugin-selectTwo class="form-control populate" >
								    <option value=''>Selecione</option>
								    <option value='0'>Módulo</option>
								    <option value='1'>Controle</option>
								    <option value='2'>Transação</option>
								    <option value='3'>Operação</option>
        						</select>
        					</div>
        					<div class="form-group">
        					   <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="Menu" name='fMenu' value='1' />
                                    <label class="custom-control-label" for="Menu">Visualizar item no menu</label>
                                </div>
        					</div>

        			</div>
        			<footer class="card-footer">
        				<div class="row">
        					<div class="col-md-12 text-right ">
        						<button type="submit" class="btn btn-primary modal-confirm text-3">Cadastrar</button>
        						<button class="btn btn-default modal-dismiss text-3">Cancelar</button>
        					</div>
        				</div>
        			</footer>
                    </form>
        		</section>
        	</div>

	    <?php include_once("includes/foot-body.php"); ?>
         <!-- Specific Page Vendor -->
		<script src="vendor/jstree/jstree.js"></script>

        <script type="text/javascript">

        $(function(){
            	/* Form */
            	$('.modal-with-form').magnificPopup({
            		type: 'inline',
            		preloader: false,
            		focus: '#name',
            		modal: true,

            		// When elemened is focused, some mobile browsers in some cases zoom in
            		// It looks not nice, so we disable it:
            		callbacks: {
            			beforeOpen: function() {
            				if($(window).width() < 700) {
            					this.st.focus = false;
            				} else {
            					this.st.focus = '#name';
            				}
            			}
            		}
            	});
				
            	/* Modal Dismiss */
            	$(document).on('click', '.modal-dismiss', function (e) {
            		e.preventDefault();
            		$.magnificPopup.close();
            	});

            	/* Modal Confirm */
            	/*$(document).on('click', '.modal-confirm', function (e) {
            		e.preventDefault();
            		$.magnificPopup.close();

            		new PNotify({
            			title: 'Success!',
            			text: 'Modal Confirm Message.',
            			type: 'success'
            		});
            	});*/


                //Monta o json com os dados hierárquicos da tabela
                //NOTA de ATUALIZAÇÃO: Inserir esses dados previamente em um arquivo .json para otimizar a construção dessa árvore e o acesso à dados
                 var jsondata = <?php echo json_encode($this->gerarTreeNodesJson($oAcessoModuloTransacao, array())); ?>;

            	$('#treeBasic').jstree({
            	    'core': {
            	        'data': jsondata
            	    },

            		'plugins': ['contextmenu'],

                     "contextmenu": {
                           "items": function ($node) {
                                var tree = $("#treeBasic").jstree(true);
                                return {
                                    "Create": {
                                        "separator_before": false,
                                        "separator_after": false,
                                        "label": "Adicionar",
                                        "icon": "fas fa-plus-square",
                                        action: function (obj) {

                                           //alert($node.id);
                                           $("#IdModuloTransacaoPai").val($node.id);
                                           $('.modal-with-form').magnificPopup('open');

                                        }
                                    },

                                    "Rename": {
                                        "separator_before": false,
                                        "separator_after": false,
                                        "label": "Alterar",
                                        "icon": "fas fa-edit",
                                        "action": function (obj) {

                                         }
                                    },

                                     "Remove": {
                                        "separator_before": true,
                                        "separator_after": false,
                                        "label": "Excluir",
                                        "icon": "far fa-minus-square",
                                        "action": function (obj) {

                                        }
                                    }

                                }
                            }
                     }
            	});
        });
         </script>
  
 </html>
