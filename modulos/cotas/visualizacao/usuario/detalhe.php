<?php
 $sOP = $_REQUEST['sOP'];
 $oUsuario = @$_REQUEST['oUsuario'];
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
  				 <h2 class="card-title">cotas</h2>
  				 <p class="card-subtitle"> usuario  </p>
  			   </header>
                            <div class="card-body">
                                 
			<div class="col-lg-8">
				<label id="Nome" class="control-label"><b>Nome:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oUsuario) ? $oUsuario->getNome() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Cpf" class="control-label"><b>Cpf:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oUsuario) ? $oUsuario->getCpf() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Rg" class="control-label"><b>Rg:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oUsuario) ? $oUsuario->getRg() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Endereco" class="control-label"><b>Endereco:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oUsuario) ? $oUsuario->getEndereco() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Cep" class="control-label"><b>Cep:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oUsuario) ? $oUsuario->getCep() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Fone" class="control-label"><b>Fone:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oUsuario) ? $oUsuario->getFone() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Email" class="control-label"><b>Email:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oUsuario) ? $oUsuario->getEmail() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="DataNasc" class="control-label"><b>Data_nasc:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oUsuario) ? $oUsuario->getDataNasc() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Tipo" class="control-label"><b>Tipo:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oUsuario) ? $oUsuario->getTipo() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="IdAcessoUsuario" class="control-label"><b>Id_acesso_usuario:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oUsuario) ? $oUsuario->getIdAcessoUsuario() : ""; ?></p>
				</blockquote>
			</div>
                                 <br />
                                 <br />
                                 <br />
                                 <a href="?action=Usuario.preparaLista">
 					<button type="button" class="btn btn-sm btn-info "><i class="fa fa-angle-left"></i> Voltar</button>
 				</a>
                            </div>
                      </section>
                </div>
           </div>
 
 <?php include_once("includes/foot-body.php"); ?>
 </html>