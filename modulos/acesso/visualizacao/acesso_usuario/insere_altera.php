<?php
 $sOP = $_REQUEST['sOP'];
 $oAcessoUsuario = $_REQUEST['oAcessoUsuario'];
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
    </head>
    
    <?php include_once("includes/head-body.php"); ?>
 
 					<!-- start: page -->
 					<div class="row mt-5">
 						<div class="col-lg-12">
 							<form id="summary-form" action="?action=AcessoUsuario.processaFormulario" class="form-horizontal" name="formAcessoUsuario" method="post">
 							    <input type="hidden" name="sOP" value="<?php echo $sOP; ?>" />
                                <input type="hidden" name="fId" value="<?php echo (is_object($oAcessoUsuario)) ? $oAcessoUsuario->getId() : ""; ?>" />
 								<section class="card">
 									<header class="card-header">
											<h2 class="card-title"><?php echo $sOP; ?> Login </h2>
											<!--<p class="card-subtitle"> Validation summary will display an error list above the form. </p>-->
 									</header>
 
 									<div class="card-body">
 									    
										<input type='hidden' name='fId' value='<?php echo ($oAcessoUsuario) ? $oAcessoUsuario->getId() : ""; ?>'/>

										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="nome">Nome:<span class=""></span></label>
												<input class="form-control" type='text' id='nome' placeholder='Nome do Usuário' name='fNome' value='<?php echo ($oAcessoUsuario) ? $oAcessoUsuario->getNome() : ""; ?>' />
											</div>
										</div>

										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Login">Login:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Login' placeholder='Login' name='fLogin' required value='<?php echo ($oAcessoUsuario) ? $oAcessoUsuario->getLogin() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>

										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Email">Email:</label>
												<input class="form-control" type='email' id='Email' placeholder='Login' name='fEmail' value='<?php echo ($oAcessoUsuario) ? $oAcessoUsuario->getEmail() : ""; ?>' />
											</div>
										</div>

										<div class="row form-group">
											<div class="col-lg-4"> 
												<label class="col-form-label" for="Senha">Senha:<span class="required">*</span></label>
												<input class="form-control" type='password' id='Senha' placeholder='Senha' name='fSenha' required value='<?php echo ($oAcessoUsuario) ? $oAcessoUsuario->getSenha() : ""; ?>' title="Este campo é obrigatório." />
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