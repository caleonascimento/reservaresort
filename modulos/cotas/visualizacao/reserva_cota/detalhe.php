<?php
 $sOP = $_REQUEST['sOP'];
 $oReservaCota = @$_REQUEST['oReservaCota'];
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
  				 <p class="card-subtitle"> reserva_cota  </p>
  			   </header>
                            <div class="card-body">
                                 
			<div class="col-lg-8">
				<label id="PeriodoIni" class="control-label"><b>Periodo_ini:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oReservaCota) ? $oReservaCota->getPeriodoIni() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="PeriodoFim" class="control-label"><b>Periodo_fim:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oReservaCota) ? $oReservaCota->getPeriodoFim() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="IdCota" class="control-label"><b>Id_cota:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oReservaCota) ? $oReservaCota->getIdCota() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="Locacao" class="control-label"><b>Locacao:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oReservaCota) ? $oReservaCota->getLocacao() : ""; ?></p>
				</blockquote>
			</div>
                                 <br />
                                 <br />
                                 <br />
                                 <a href="?action=ReservaCota.preparaLista">
 					<button type="button" class="btn btn-sm btn-info "><i class="fa fa-angle-left"></i> Voltar</button>
 				</a>
                            </div>
                      </section>
                </div>
           </div>
 
 <?php include_once("includes/foot-body.php"); ?>
 </html>