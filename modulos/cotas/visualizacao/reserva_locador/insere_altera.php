<?php
 $sOP = $_REQUEST['sOP'];
 $oReservaLocador = $_REQUEST['oReservaLocador'];
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
 			 <form id="summary-form" action="?action=ReservaLocador.processaFormulario" class="form-horizontal" name="formReservaLocador" method="post">
 				 <input type="hidden" name="sOP" value="<?php echo $sOP; ?>" />
                                  <input type="hidden" name="fId" value="<?php echo (is_object($oReservaLocador)) ? $oReservaLocador->getId() : ""; ?>" />
 				 <section class="card">
 					 <header class="card-header">
 						 <div class="card-actions">
 							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 							<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
 						</div>
 						<h2 class="card-title"><?php echo $sOP; ?> reserva_locador </h2>
 						<!--<p class="card-subtitle"> Validation summary will display an error list above the form. </p>-->
 					</header>
 					<div class="card-body">
 						
										<input type='hidden' name='fId' value='<?php echo ($oReservaLocador) ? $oReservaLocador->getId() : ""; ?>'/>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="ReservaCota">Id_reserva_cota:<span class="required">*</span></label>
												<select name='fIdReservaCota' data-plugin-selectTwo class="form-control populate"  required  title="Este campo é obrigatório." >
													<option value=''>Selecione</option>
<?php													 $sSelected = "";
													if($voReservaCota) 
														foreach($voReservaCota as $oReservaCota) {
															if($oReservaLocador) 
																$sSelected = ($oReservaLocador->getIdReservaCota() == $oReservaCota->getId()) ? "selected" : "";
?>															<option  <?php echo $sSelected; ?> value='<?php echo $oReservaCota->getId(); ?>'><?php echo $oReservaCota->getId(); ?></option>
<?php														}
?>												</select>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Usuario">Id_usuario:<span class="required">*</span></label>
												<select name='fIdUsuario' data-plugin-selectTwo class="form-control populate"  required  title="Este campo é obrigatório." >
													<option value=''>Selecione</option>
<?php													 $sSelected = "";
													if($voUsuario) 
														foreach($voUsuario as $oUsuario) {
															if($oReservaLocador) 
																$sSelected = ($oReservaLocador->getIdUsuario() == $oUsuario->getId()) ? "selected" : "";
?>															<option  <?php echo $sSelected; ?> value='<?php echo $oUsuario->getId(); ?>'><?php echo $oUsuario->getId(); ?></option>
<?php														}
?>												</select>
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