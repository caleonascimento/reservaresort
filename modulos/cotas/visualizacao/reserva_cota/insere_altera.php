﻿<?php
 $sOP = $_REQUEST['sOP'];
 $oReservaCota = $_REQUEST['oReservaCota'];
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
 			 <form id="summary-form" action="?action=ReservaCota.processaFormulario" class="form-horizontal" name="formReservaCota" method="post">
 				 <input type="hidden" name="sOP" value="<?php echo $sOP; ?>" />
                                  <input type="hidden" name="fId" value="<?php echo (is_object($oReservaCota)) ? $oReservaCota->getId() : ""; ?>" />
 				 <section class="card">
 					 <header class="card-header">
 						 <div class="card-actions">
 							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 							<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
 						</div>
 						<h2 class="card-title"><?php echo $sOP; ?> reserva_cota </h2>
 						<!--<p class="card-subtitle"> Validation summary will display an error list above the form. </p>-->
 					</header>
 					<div class="card-body">
 						
										<input type='hidden' name='fId' value='<?php echo ($oReservaCota) ? $oReservaCota->getId() : ""; ?>'/>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="PeriodoIni">Periodo_ini:<span class="required">*</span></label>
												<input class="form-control" type='text' id='PeriodoIni' placeholder='Periodo_ini' name='fPeriodoIni'  required   value='<?php echo ($oReservaCota) ? $oReservaCota->getPeriodoIniFormatado() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="PeriodoFim">Periodo_fim:<span class="required">*</span></label>
												<input class="form-control" type='text' id='PeriodoFim' placeholder='Periodo_fim' name='fPeriodoFim'  required   value='<?php echo ($oReservaCota) ? $oReservaCota->getPeriodoFimFormatado() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Cota">Id_cota:<span class="required">*</span></label>
												<select name='fIdCota' data-plugin-selectTwo class="form-control populate"  required  title="Este campo é obrigatório." >
													<option value=''>Selecione</option>
<?php													 $sSelected = "";
													if($voCota) 
														foreach($voCota as $oCota) {
															if($oReservaCota) 
																$sSelected = ($oReservaCota->getIdCota() == $oCota->getId()) ? "selected" : "";
?>															<option  <?php echo $sSelected; ?> value='<?php echo $oCota->getId(); ?>'><?php echo $oCota->getId(); ?></option>
<?php														}
?>												</select>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Locacao">Locacao:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Locacao' placeholder='Locacao' name='fLocacao'  required   value='<?php echo ($oReservaCota) ? $oReservaCota->getLocacao() : ""; ?>' title="Este campo é obrigatório." />
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