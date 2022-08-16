<?php
 $sOP = $_REQUEST['sOP'];
 $oAcessoGrupo = $_REQUEST['oAcessoGrupo'];
 $voAcessoGrupo = $_REQUEST['voAcessoGrupo'];
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
 							<form id="summary-form" action="?action=AcessoGrupo.processaFormulario" class="form-horizontal" name="formAcessoGrupo" method="post">
 							    <input type="hidden" name="sOP" value="<?php echo $sOP; ?>" />
                                 <input type="hidden" name="fIdGrupo" value="<?php echo (is_object($oAcessoGrupo)) ? $oAcessoGrupo->getIdGrupo() : ""; ?>" />
 								<section class="card">
 									<header class="card-header">
 										<div class="card-actions">
 											<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 											<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
 										</div>
 
 										<h2 class="card-title"><?php echo $sOP; ?> Grupo de Usuários </h2>
 										<!--<p class="card-subtitle"> Validation summary will display an error list above the form. </p>-->
 									</header>
 
 									<div class="card-body">
 									    
										<input type='hidden' name='fIdGrupo' value='<?php echo ($oAcessoGrupo) ? $oAcessoGrupo->getIdGrupo() : ""; ?>'/>

										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="Nome">Nome:<span class="required">*</span></label>
												<input class="form-control" type='text' id='Nome' placeholder='Nome' name='fNome'  required   value='<?php echo ($oAcessoGrupo) ? $oAcessoGrupo->getNome() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>

                                        <div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="AcessoGrupo">Grupo Herdado:</label>
												<select name='fIdGrupoPai' data-plugin-selectTwo class="form-control populate"   title="Este campo é obrigatório." >
													<option value=''>Selecione</option>
<?php													 $sSelected = "";
													if($voAcessoGrupo)
														foreach($voAcessoGrupo as $oAcessoGrupo2) {
															if($oAcessoGrupo)
																$sSelected = ($oAcessoGrupo->getIdGrupoPai() == $oAcessoGrupo2->getIdGrupo()) ? "selected" : "";
?>															<option  <?php echo $sSelected?> value='<?php echo $oAcessoGrupo2->getIdGrupo(); ?>'><?php echo $oAcessoGrupo2->getNome(); ?></option>
<?php														}
?>												</select>
											</div>
										</div>
									<input type='hidden' name='fAtivo' value='<?php echo ($oAcessoGrupo) ? $oAcessoGrupo->getAtivo() : "1"; ?>'/>

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