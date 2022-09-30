<?php
 $sOP = $_REQUEST['sOP'];
 $oUsuario = $_REQUEST['oUsuario'];
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
 			 <form id="summary-form" action="?action=Usuario.processaFormulario" class="form-horizontal" name="formUsuario" method="post">
 				 <input type="hidden" name="sOP" value="<?php echo $sOP; ?>" />
                                  <input type="hidden" name="fId" value="<?php echo (is_object($oUsuario)) ? $oUsuario->getId() : ""; ?>" />
 				<section class="card">
						<header class="card-header">
							<div class="card-actions">
								<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
								<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
							</div>
							<h2 class="card-title"><?php echo $sOP; ?> Usuario </h2>
							<!--<p class="card-subtitle"> Validation summary will display an error list above the form. </p>-->
						</header>
 						<div class="card-body">
 						
										<input type='hidden' name='fId' value='<?php echo ($oUsuario) ? $oUsuario->getId() : ""; ?>'/>
										<div class="row form-group">
											<div class="col-lg-6">
												<label class="col-form-label" for="Nome">Nome:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Nome' placeholder='Nome' name='fNome'  required value='<?php echo ($oUsuario) ? $oUsuario->getNome() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Cpf">CPF:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Cpf' placeholder='CPF' name='fCpf'  required value='<?php echo ($oUsuario) ? $oUsuario->getCpf() : ""; ?>' title="Este campo é obrigatório." />
											</div>
									
											<div class="col-lg-3">
												<label class="col-form-label" for="Rg">RG:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Rg' placeholder='RG' name='fRg' required value='<?php echo ($oUsuario) ? $oUsuario->getRg() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-8">
												<label class="col-form-label" for="Endereco">Endereco:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Endereco' placeholder='Endereco' name='fEndereco'  required   value='<?php echo ($oUsuario) ? $oUsuario->getEndereco() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										
											<div class="col-lg-2">
												<label class="col-form-label" for="Cep">CEP:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Cep' placeholder='Cep' name='fCep' required value='<?php echo ($oUsuario) ? $oUsuario->getCep() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-3">
												<label class="col-form-label" for="Fone">Fone:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Fone' placeholder='Fone' name='fFone' required value='<?php echo ($oUsuario) ? $oUsuario->getFone() : ""; ?>' title="Este campo é obrigatório." />
											</div>
											<div class="col-lg-4">
												<label class="col-form-label" for="Email">E-mail:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Email' placeholder='Email' name='fEmail' required value='<?php echo ($oUsuario) ? $oUsuario->getEmail() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-2">
												<label class="col-form-label" for="DataNasc">Data de Nascimento:<span class="required">*</span></label>
												<input class="form-control" type='text' id='DataNasc' placeholder='Data de Nascimento' name='fDataNasc' required value='<?php echo ($oUsuario) ? $oUsuario->getDataNascFormatado() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										
											<div class="col-lg-4">
												<label class="col-form-label" for="Tipo">Tipo:<span class="required">*</span></label>
												<select name="fTipo" id="Tipo"data-plugin-selectTwo class="form-control populate" required title="Este campo é obrigatório." >
													<option value="">Selecione..</option>
													<option value="1">Cotista</option>
													<option value="2">Locatário</option>
												</select>
											</div>
										</div>
										<!-- <div class="row form-group">
											<div class="col-lg-4">
												<input type="checkbox" value="1" id="loginUsuario" name="fLoginUsuario" />  
												<label class="col-form-label" for="AcessoUsuario">Cadastrar login de acesso para usuário</label>
											</div>
										</div> -->
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