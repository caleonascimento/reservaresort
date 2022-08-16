<?php
 $sOP = $_REQUEST['sOP'];
 $oAcessoPermissaoGrupo = $_REQUEST['oAcessoPermissaoGrupo'];
 $voAcessoGrupo = $_REQUEST['voAcessoGrupo'];
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
 							<li><a href="?action=AcessoPermissaoGrupo.preparaLista"><i class="fa fa-dashboard"></i>Acesso</a></li>
     							<li class="active">Gerenciar Permissão</li>
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
 							<form id="summary-form" action="?action=AcessoPermissaoGrupo.processaFormulario" class="form-horizontal" name="formAcessoPermissaoGrupo" method="post">
 							    <input type="hidden" name="sOP" value="<?php echo $sOP; ?>" />
                                 <input type="hidden" name="fIdPermissaoGrupo" value="<?php echo (is_object($oAcessoPermissaoGrupo)) ? $oAcessoPermissaoGrupo->getIdPermissaoGrupo() : ""; ?>" />
 								<section class="card">
 									<header class="card-header">
 										<div class="card-actions">
 											<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 											<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
 										</div>
 
 										<h2 class="card-title"><?php echo $sOP; ?> Permissão </h2>
 										<!--<p class="card-subtitle"> Validation summary will display an error list above the form. </p>-->
 									</header>
 
 									<div class="card-body">
 									    
										<input type='hidden' name='fIdPermissaoGrupo' value='<?php echo ($oAcessoPermissaoGrupo) ? $oAcessoPermissaoGrupo->getIdPermissaoGrupo() : ""; ?>'/>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="AcessoGrupo">Grupo de Usuário:</label>
												<select name='fIdGrupo' data-plugin-selectTwo class="form-control populate" >
													<option value=''>Selecione</option>
<?php													 $sSelected = "";
													if($voAcessoGrupo) 
														foreach($voAcessoGrupo as $oAcessoGrupo) {
															if($oAcessoPermissaoGrupo) 
																$sSelected = ($oAcessoPermissaoGrupo->getIdGrupo() == $oAcessoGrupo->getIdGrupo()) ? "selected" : "";
?>															<option  <?php echo $sSelected; ?> value='<?php echo $oAcessoGrupo->getIdGrupo(); ?>'><?php echo $oAcessoGrupo->getNome(); ?></option>
<?php														}
?>												</select>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="AcessoModuloTransacao">Modulo/Transação:<span class="required">*</span></label>
												<select name='fIdModuloTransacao' data-plugin-selectTwo class="form-control populate"  required  title="Este campo é obrigatório." >
													<option value=''>Selecione</option>
<?php													 $sSelected = "";
													if($voAcessoModuloTransacao) 
														foreach($voAcessoModuloTransacao as $oAcessoModuloTransacao) {
															if($oAcessoPermissaoGrupo) 
																$sSelected = ($oAcessoPermissaoGrupo->getIdModuloTransacao() == $oAcessoModuloTransacao->getIdModuloTransacao()) ? "selected" : "";
?>															<option  <?php echo $sSelected; ?> value='<?php echo $oAcessoModuloTransacao->getIdModuloTransacao(); ?>'><?php echo $oAcessoModuloTransacao->getTitulo(); ?> (<?php echo $oAcessoModuloTransacao->getNome(); ?>)</option>
<?php														}
?>												</select>
											</div>
										</div>
										<div class="form-group row ">
											<div class="col-lg-4">
												<label class="col-sm-4 control-label" for="Permissao">Permissão: </label>
                                                <div class="col-sm-8" style="margin-left:50px;">
                                                    <div class="radio-custom radio-primary">
                                                         <input class="" type="radio" id='Permissao' placeholder='Permissão' name='fPermissao' value='1' <?php echo ($oAcessoPermissaoGrupo) ? ($oAcessoPermissaoGrupo->getPermissao() ? 'checked': '') : "checked"; ?> />
                                                         <label for="Permissao0">Permitir</label>
                                                     </div>

                                                     <div class="radio-custom radio-danger">
                                                         <input class="" type="radio" id='Permissao0' placeholder='Permissão' name='fPermissao' value='0' <?php echo ($oAcessoPermissaoGrupo) ? ($oAcessoPermissaoGrupo->getPermissao() ? '': 'checked') : ""; ?> />
                                                         <label for="Permissao0">Negar</label>
                                                     </div>

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