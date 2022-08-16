<?php
 $sOP = $_REQUEST['sOP'];
 $oNotificacao = $_REQUEST['oNotificacao'];
 #GET_VETOR_OBJETOS#
 
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
     </head>
 
     <?php include_once("includes/head-body.php"); ?>
 
 	       <!-- start: page -->
 		<div class="row mt-5">
 		   <div class="col-lg-12">
 			 <form id="summary-form" action="?action=Notificacao.processaFormulario" class="form-horizontal" name="formNotificacao" method="post">
 				 <input type="hidden" name="sOP" value="<?php echo $sOP; ?>" />
                                  <input type="hidden" name="fId" value="<?php echo (is_object($oNotificacao)) ? $oNotificacao->getId() : ""; ?>" />
 				 <section class="card">
 					 <header class="card-header">
 						 <div class="card-actions">
 							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 							<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
 						</div>
 						<h2 class="card-title"><?php echo $sOP; ?> notificacao </h2>
 						<!--<p class="card-subtitle"> Validation summary will display an error list above the form. </p>-->
 					</header>
 					<div class="card-body">
 						
										<input type='hidden' name='fId' value='<?php echo ($oNotificacao) ? $oNotificacao->getId() : ""; ?>'/>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="AcessoUsuario">Usuário:<span class="required">*</span></label>
												<select name='fIdUsuario' data-plugin-selectTwo class="form-control populate"  required  title="Este campo é obrigatório." >
													<option value=''>Selecione</option>
<?php													 $sSelected = "";
													if($voAcessoUsuario) 
														foreach($voAcessoUsuario as $oAcessoUsuario) {
															if($oNotificacao) 
																$sSelected = ($oNotificacao->getIdUsuario() == $oAcessoUsuario->getId()) ? "selected" : "";
?>															<option  <?php echo $sSelected; ?> value='<?php echo $oAcessoUsuario->getId(); ?>'><?php echo $oAcessoUsuario->getId(); ?></option>
<?php														}
?>												</select>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Tipo">Tipo:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Tipo' placeholder='Tipo' name='fTipo'  required   value='<?php echo ($oNotificacao) ? $oNotificacao->getTipo() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Mensagem">Mensagem:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Mensagem' placeholder='Mensagem' name='fMensagem'  required   value='<?php echo ($oNotificacao) ? $oNotificacao->getMensagem() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Visualizada">Visualizada?:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Visualizada' placeholder='Visualizada?' name='fVisualizada'  required  onKeyPress="TodosNumero(event);" value='<?php echo ($oNotificacao) ? $oNotificacao->getVisualizada() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Link">Link:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Link' placeholder='Link' name='fLink'  required   value='<?php echo ($oNotificacao) ? $oNotificacao->getLink() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
									<input type='hidden' name='fAtivo' value='<?php echo ($oNotificacao) ? $oNotificacao->getAtivo() : "1"; ?>'/>

										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Geracao">Criação:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Geracao' placeholder='Criação' name='fGeracao'  required   value='<?php echo ($oNotificacao) ? $oNotificacao->getGeracaoFormatado() : ""; ?>' title="Este campo é obrigatório." />
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
 
   <?php include_once("includes/foot-body.php"); ?>
  </html>