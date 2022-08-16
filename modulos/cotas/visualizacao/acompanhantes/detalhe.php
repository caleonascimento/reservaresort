<?php
 $sOP = $_REQUEST['sOP'];
 $oAcompanhantes = @$_REQUEST['oAcompanhantes'];
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
  				 <p class="card-subtitle"> acompanhantes  </p>
  			   </header>
                            <div class="card-body">
                                 
			<div class="col-lg-8">
				<label id="Nome" class="control-label"><b>Nome:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oAcompanhantes) ? $oAcompanhantes->getNome() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Cpf" class="control-label"><b>Cpf:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oAcompanhantes) ? $oAcompanhantes->getCpf() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="DataNasc" class="control-label"><b>Data_nasc:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oAcompanhantes) ? $oAcompanhantes->getDataNasc() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="IdReservaLocador" class="control-label"><b>Id_reserva_locador:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oAcompanhantes) ? $oAcompanhantes->getIdReservaLocador() : ""; ?></p>
				</blockquote>
			</div>
                                 <br />
                                 <br />
                                 <br />
                                 <a href="?action=Acompanhantes.preparaLista">
 					<button type="button" class="btn btn-sm btn-info "><i class="fa fa-angle-left"></i> Voltar</button>
 				</a>
                            </div>
                      </section>
                </div>
           </div>
 
 <?php include_once("includes/foot-body.php"); ?>
 </html>