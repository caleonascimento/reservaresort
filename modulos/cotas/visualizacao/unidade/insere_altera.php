<?php
 $sOP = $_REQUEST['sOP'];
 $oUnidade = $_REQUEST['oUnidade'];
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
 			 <form id="summary-form" action="?action=Unidade.processaFormulario" class="form-horizontal" name="formUnidade" method="post">
 				 <input type="hidden" name="sOP" value="<?php echo $sOP; ?>" />
				 <input type="hidden" name="fId" value="<?php echo (is_object($oUnidade)) ? $oUnidade->getId() : ""; ?>" />
 				 <section class="card">
 					 <header class="card-header">
 						 <div class="card-actions">
 							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 							<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
 						</div>
 						<h2 class="card-title"><?php echo $sOP; ?> unidade </h2>
                     	<h3><?php echo $oEmpreedimento->getNome();?></h3>
 						<!--<p class="card-subtitle"> Validation summary will display an error list above the form. </p>-->
 					</header>
 					<div class="card-body">
 						
						<input type='hidden' name='fId' value='<?php echo ($oUnidade) ? $oUnidade->getId() : ""; ?>'/>
						<input type='hidden' name='fIdEmpreendimento' 
								value='<?php echo ($oUnidade && $oUnidade->getEmpreendimento()) ? $oUnidade->getEmpreendimento()->getId() : ""; ?>'/>
						<div class="row form-group">
							<div class="col-lg-4">
								<label class="col-form-label" for="Tipo">Tipo:<span class="required">*</span></label>
								<input class="form-control" type='text' id='Tipo' placeholder='Tipo' name='fTipo'  required 
										value='<?php echo ($oUnidade) ? $oUnidade->getTipo() : ""; ?>' title="Este campo é obrigatório." />
							</div>
						</div>
						<div class="row form-group">
							<div class="col-lg-4">
								<label class="col-form-label" for="Descricao">Descricao:<span class="required">*</span></label>
								<input class="form-control" type='text' id='Descricao' placeholder='Descricao' name='fDescricao'  
									required   value='<?php echo ($oUnidade) ? $oUnidade->getDescricao() : ""; ?>' title="Este campo é obrigatório." />
							</div>
						</div>
						<div class="row form-group">
							<div class="col-lg-4">
								<label class="col-form-label" for="Lotacao">Lotacao:<span class="required">*</span></label>
								<input class="form-control" type='text' id='Lotacao' placeholder='Lotacao' name='fLotacao' 
										required  onKeyPress="TodosNumero(event);" value='<?php echo ($oUnidade) ? $oUnidade->getLotacao() : ""; ?>' title="Este campo é obrigatório." />
							</div>
						</div>
						<div class="row form-group">
							<div class="col-lg-4">
								<label class="col-form-label" for="Empreendimento">Id_empreendimento:<span class="required">*</span></label>
								<select name='fIdEmpreendimento' data-plugin-selectTwo class="form-control populate" required title="Este campo é obrigatório.">
									<option value=''>Selecione</option>
<?php							    $sSelected = "";	
									if($voEmpreendimento) 
									foreach($voEmpreendimento as $oEmpreendimento) {
										if($oUnidade) 
											$sSelected = ($oUnidade->getIdEmpreendimento() == $oEmpreendimento->getId()) ? "selected" : "";
?>										    <option  <?php echo $sSelected; ?> value='<?php echo $oEmpreendimento->getId(); ?>'><?php echo $oEmpreendimento->getId(); ?></option>
<?php							    }
?>							   </select>	
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