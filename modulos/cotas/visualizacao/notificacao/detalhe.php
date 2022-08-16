<?php
 $sOP = $_REQUEST['sOP'];
 $oNotificacao = @$_REQUEST['oNotificacao'];
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
  				 <p class="card-subtitle"> notificacao  </p>
  			   </header>
                            <div class="card-body">
                                 
			<div class="col-lg-8">
				<label id="IdUsuario" class="control-label"><b>Usuário:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oNotificacao) ? $oNotificacao->getIdUsuario() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Tipo" class="control-label"><b>Tipo:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oNotificacao) ? $oNotificacao->getTipo() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Mensagem" class="control-label"><b>Mensagem:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oNotificacao) ? $oNotificacao->getMensagem() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Visualizada" class="control-label"><b>Visualizada?:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oNotificacao) ? $oNotificacao->getVisualizada() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Link" class="control-label"><b>Link:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oNotificacao) ? $oNotificacao->getLink() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Ativo" class="control-label"><b>Ativa?:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oNotificacao) ? $oNotificacao->getAtivo() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Geracao" class="control-label"><b>Criação:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oNotificacao) ? $oNotificacao->getGeracao() : ""; ?></p>
				</blockquote>
			</div>
                                 <br />
                                 <br />
                                 <br />
                                 <a href="?action=Notificacao.preparaLista">
 					<button type="button" class="btn btn-sm btn-info "><i class="fa fa-angle-left"></i> Voltar</button>
 				</a>
                            </div>
                      </section>
                </div>
           </div>
 
 <?php include_once("includes/foot-body.php"); ?>
 </html>