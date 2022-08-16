<?php
 $sOP = $_REQUEST['sOP'];
 $oAcessoModuloTransacao = $_REQUEST['oAcessoModuloTransacao'];
 $voAcessoModuloTransacao = $_REQUEST['voAcessoModuloTransacao'];
?>
 <!doctype html>
 <html class="fixed has-top-menu">
 	<head>
 		<!-- Basic -->
 		<meta charset="UTF-8">
 
 		<title><?php echo SYSTEM_NAME. ' - '. SYSTEM_INITIALS; ?></title>
        <meta name="keywords" content="<?php echo KEYWORDS; ?>" />
        <meta name="description" content="<?php echo DESCRIPTION; ?>">
        <meta name="author" content="<?php echo AUTHOR; ?>">
 		<?php include_once("includes/head.php"); ?>
 		<?php include_once('includes/view/css/css_insere_altera.php'); ?>
 	</head>

     <body>
 		<section class="body">
             <?php include_once('includes/menu.php'); ?>
             <div class="inner-wrapper">
 				<section role="main" class="content-body">
 					<header class="page-header">
                         <h2>Acesso</h2>
                         <div class="right-wrapper text-right">
     						<ol class="breadcrumbs">
     							<li><a href="?"><i class="fa fa-dashboard"></i>Inicial</a></li>
 							<li><a href="?action=AcessoModuloTransacao.preparaLista"><i class="fa fa-dashboard"></i>Acesso</a></li>
     							<li class="active">Cadastrar Módulos, Páginas e Transações</li>
     						</ol>
     						<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
                         </div>
                         <section class="content-header">
             				  <?php include_once('includes/mensagem.php'); ?>
             		    </section>
                     </header>
 
 					<!-- start: page -->
 					<div class="row">
 						<div class="col-lg-12">
 											<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 											<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
 										</div>
 
 										<h2 class="card-title"><?php echo $sOP; ?>  Módulo/Transação </h2>
 										<!--<p class="card-subtitle"> Validation summary will display an error list above the form. </p>-->
 									</header>

 									<div class="card-body">
 									    
										<input type='hidden' name='fIdModuloTransacao' value='<?php echo ($oAcessoModuloTransacao) ? $oAcessoModuloTransacao->getIdModuloTransacao() : ""; ?>'/>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="AcessoModuloTransacao">Pai:</label>
												<select name='fIdModuloTransacaoPai' data-plugin-selectTwo class="form-control populate" >
													<option value=''>Selecione</option>
<?php													 $sSelected = "";
													if($voAcessoModuloTransacao)
														foreach($voAcessoModuloTransacao as $oAcessoModuloTransacao2) {
															if($oAcessoModuloTransacao)
																$sSelected = ($oAcessoModuloTransacao->getIdModuloTransacaoPai() == $oAcessoModuloTransacao2->getIdModuloTransacao()) ? "selected" : "";
?>															<option  <?php echo $sSelected; ?> value='<?php echo $oAcessoModuloTransacao2->getIdModuloTransacao(); ?>'><?php echo $oAcessoModuloTransacao2->getTitulo(); ?> (<?php echo $oAcessoModuloTransacao2->getNome(); ?>)</option>
<?php														}
?>												</select>
											</div>
										</div>

                                        <div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Tipo">Tipo(Módulo/Controle/Transação/Operação):<span class="required">*</span></label>
                                                <select name='fTipo' data-plugin-selectTwo class="form-control populate" title="Este campo é obrigatório."  id='Tipo' >
                                                    <option value=''>Selecione</option>
                                                    <option <?php echo $oAcessoModuloTransacao?($oAcessoModuloTransacao->getTipo() == 0 ? "selected":''):'';?> value='0'>Módulo</option>
                                                    <option <?php echo $oAcessoModuloTransacao?($oAcessoModuloTransacao->getTipo() == 1 ? "selected":''):'';?> value='1'>Controle</option>
                                                    <option <?php echo $oAcessoModuloTransacao?($oAcessoModuloTransacao->getTipo() == 2 ? "selected":''):'';?> value='2'>Transação</option>
                                                    <option <?php echo $oAcessoModuloTransacao?($oAcessoModuloTransacao->getTipo() == 3 ? "selected":''):'';?> value='3'>Operação</option>
                                                </select>
										    </div>
										</div>

										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Nome">Nome:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Nome' placeholder='Nome' name='fNome'  required   value='<?php echo ($oAcessoModuloTransacao) ? $oAcessoModuloTransacao->getNome() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Titulo">Título:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Titulo' placeholder='Título' name='fTitulo'  required   value='<?php echo ($oAcessoModuloTransacao) ? $oAcessoModuloTransacao->getTitulo() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>



										<div class="row form-group">
											<div class="col-lg-4">
											    <div class="custom-control custom-checkbox">

                                                    <input class="custom-control-input" type="checkbox" id="Menu" name='fMenu' value='1' <?php echo ($oAcessoModuloTransacao && $oAcessoModuloTransacao->getMenu()) ? "checked" : ""; ?> />
                                                    <label class="custom-control-label" for="Menu">Visualizar item no menu</label>
                                                </div>
										    </div>
										</div>

 									</div>
                                     <footer class="card-footer">
 										<div class="row justify-content-end">
 											<div class="col-sm-9">
 												<button type="button" class="btn btn-default" onclick="history.back(-1)"><i class="fa fa-reply fa-sm" aria-hidden="true"></i> Voltar</button>
 												<button class="btn btn-primary" type="submit"><?php echo $sOP; ?></button>
 											</div>
 										</div>
 									</footer>
 								</section>
 							</form>
 						</div>
 
 					</div>
 					<!-- end: page -->
 				</section>
 			</div>
         </section>
           <?php include_once("includes/javascript.php"); ?>
          <?php include_once("includes/view/js/js_insere_altera.php"); ?>
 
          <section role="main" class="content-footer">
  			 <?php include_once('includes/footer.php'); ?>
  		</section>
      </body>
  </html>