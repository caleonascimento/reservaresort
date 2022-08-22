<?php
 $sOP = $_REQUEST['sOP'];
 $oEmpreendimento = $_REQUEST['oEmpreendimento'];
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
 			 <form id="summary-form" action="?action=Empreendimento.processaFormulario" class="form-horizontal" name="formEmpreendimento" method="post">
 				 <input type="hidden" name="sOP" value="<?php echo $sOP; ?>" />
                                  <input type="hidden" name="fId" value="<?php echo (is_object($oEmpreendimento)) ? $oEmpreendimento->getId() : ""; ?>" />
 				 <section class="card">
 					 <header class="card-header">
 						 <div class="card-actions">
 							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 							<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
 						</div>
 						<h2 class="card-title"><?php echo $sOP; ?> empreendimento </h2>
 						<!--<p class="card-subtitle"> Validation summary will display an error list above the form. </p>-->
 					</header>
 					<div class="card-body">
 						
										<input type='hidden' name='fId' value='<?php echo ($oEmpreendimento) ? $oEmpreendimento->getId() : ""; ?>'/>
										<div class="row form-group">

											<div class="col-lg-7">
												<label class="col-form-label" for="Nome">Nome:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Nome' placeholder='Nome' name='fNome'  required   value='<?php echo ($oEmpreendimento) ? $oEmpreendimento->getNome() : ""; ?>' title="Este campo é obrigatório." />
											</div>


										</div>
										<div class="row form-group">

											<div class="col-lg-3">
												<label class="col-form-label" for="Cep">Cep:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Cep' placeholder='Cep' name='fCep'  required   value='<?php echo ($oEmpreendimento) ? $oEmpreendimento->getCep() : ""; ?>' title="Este campo é obrigatório." />
											</div>

											<div class="col-lg-4">
												<label class="form-label" for="Tipo">Tipo:<span class="required">*</span></label>
												<select class="form-control" type='text' id='Tipo' placeholder='Tipo' name='fTipo'  required  onKeyPress="TodosNumero(event);" value='<?php echo ($oEmpreendimento) ? $oEmpreendimento->getTipo() : ""; ?>' title="Este campo é obrigatório." />
												<option>1</option>
												<option>2</option>
												</select>
											</div>
										</div>
										<div class="row form-group">
											
											<div class="col-lg-7">
												<label class="form-label" for="Endereco">Endereço:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Endereco' placeholder='Endereco' name='fEndereco'  required  onKeyPress="TodosNumero(event);" value='<?php echo ($oEmpreendimento) ? $oEmpreendimento->getEndereco() : ""; ?>' title="Este campo é obrigatório." />
											</div>
											
										</div>
										<div class="row form-group">

											<div class="col-lg-7">
												<label class="col-form-label" for="Descricao">Descricao:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Descricao' placeholder='Descricao' name='fDescricao'  required   value='<?php echo ($oEmpreendimento) ? $oEmpreendimento->getDescricao() : ""; ?>' title="Este campo é obrigatório." />
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