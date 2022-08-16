<?php
 $sOP = $_REQUEST['sOP'];
 $oAcessoGrupoUsuario = $_REQUEST['oAcessoGrupoUsuario'];
 ?>
 <!doctype html>
 <html class="fixed has-top-menu">
 	<head>
 		<!-- Basic -->
 		<meta charset="UTF-8">
 
 		<title><?php echo SYSTEM_NAME. ' - '. SYSTEM_INITIALS; ?></title>
        <meta name="keywords" content="<?php echo KEYWORDS; ?>" />
        <meta name="description" content="<?php echo DESCRIPTION; ?>">
        <meta name="author" content="<?php echo AUTHOR; ?>">
 		<?php include_once("includes/head.php"); ?>
 		<?php include_once('includes/view/css/css_insere_altera.php'); ?>
 	</head>
 
     <body>
 		<section class="body">
             <?php include_once('includes/menu.php'); ?>
             <div class="inner-wrapper">
 				<section role="main" class="content-body">
 					<header class="page-header">
                         <h2>Acesso</h2>
                         <div class="right-wrapper text-right">
     						<ol class="breadcrumbs">
     							<li><a href="?"><i class="fa fa-dashboard"></i>Inicial</a></li>
 							<li><a href="?action=AcessoGrupoUsuario.preparaLista"><i class="fa fa-dashboard"></i>Acesso</a></li>
     							<li class="active">Cadastrar Usuário Grupo</li>
     						</ol>
     						<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
                         </div>
                         <section class="content-header">
             				  <?php include_once('includes/mensagem.php'); ?>
             		    </section>
                     </header>
 
 					<!-- start: page -->
 					<div class="row">
 						<div class="col-lg-12">
 							<form id="summary-form" action="?action=AcessoGrupoUsuario.processaFormulario" class="form-horizontal" name="formAcessoGrupoUsuario" method="post">
 							    <input type="hidden" name="sOP" value="<?php echo $sOP; ?>" />
                                 <input type="hidden" name="fIdGrupoUsuario" value="<?php echo (is_object($oAcessoGrupoUsuario)) ? $oAcessoGrupoUsuario->getIdGrupoUsuario() : ""; ?>" />
 								<section class="card">
 									<header class="card-header">
 										<div class="card-actions">
 											<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 											<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
 										</div>
 
 										<h2 class="card-title"><?php echo $sOP; ?> Usuário à um Grupo </h2>
 										<!--<p class="card-subtitle"> Validation summary will display an error list above the form. </p>-->
 									</header>
 
 									<div class="card-body">
 									    
										<input type='hidden' name='fIdGrupoUsuario' value='<?php echo ($oAcessoGrupoUsuario) ? $oAcessoGrupoUsuario->getIdGrupoUsuario() : ""; ?>'/>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="IdGrupo">Grupo:<span class="required">*</span></label>
												<input class="form-control" type='text' id='IdGrupo' placeholder='Id_grupo' name='fIdGrupo'  required  onKeyPress="TodosNumero(event);" value='<?php echo ($oAcessoGrupoUsuario) ? $oAcessoGrupoUsuario->getIdGrupo() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="IdUsuario">Usuário :<span class="required">*</span></label>
												<input class="form-control" type='text' id='IdUsuario' placeholder='Id_usuario' name='fIdUsuario'  required  onKeyPress="TodosNumero(event);" value='<?php echo ($oAcessoGrupoUsuario) ? $oAcessoGrupoUsuario->getIdUsuario() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="InseridoPor">Inserido_por:<span class="required">*</span></label>
												<input class="form-control" type='text' id='InseridoPor' placeholder='Inserido_por' name='fInseridoPor'  required   value='<?php echo ($oAcessoGrupoUsuario) ? $oAcessoGrupoUsuario->getInseridoPor() : ""; ?>' title="Este campo é obrigatório." />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="col-form-label" for="AlteradoPor">Alterado_por:<span class="required">*</span></label>
												<input class="form-control" type='text' id='AlteradoPor' placeholder='Alterado_por' name='fAlteradoPor'  required   value='<?php echo ($oAcessoGrupoUsuario) ? $oAcessoGrupoUsuario->getAlteradoPor() : ""; ?>' title="Este campo é obrigatório." />
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
 				</section>
 			</div>
         </section>
           <?php include_once("includes/javascript.php"); ?>
          <?php include_once("includes/view/js/js_insere_altera.php"); ?>
 
          <section role="main" class="content-footer">
  			 <?php include_once('includes/footer.php'); ?>
  		</section>
      </body>
  </html>