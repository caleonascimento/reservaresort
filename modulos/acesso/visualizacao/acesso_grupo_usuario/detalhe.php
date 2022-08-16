<?php
 $sOP = $_REQUEST['sOP'];
 $oAcessoGrupoUsuario = @$_REQUEST['oAcessoGrupoUsuario'];
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
 		<?php include_once('includes/view/css/css_detalhe.php'); ?>
  	</head>
 
     <body class="sidebar-mini wysihtml5-supported skin-green-light">
         <section class="body">
             <?php include_once('includes/menu.php'); ?>
             <div class="inner-wrapper">
                 <section role="main" class="content-body">
                     <header class="page-header">
                          <h2>INTRANET</h2>
                          <div class="right-wrapper text-right">
      						<ol class="breadcrumbs">
      							<li><a href="?"><i class="fa fa-dashboard"></i>Inicial</a></li>
 							<li><a href="?action=AcessoGrupoUsuario.preparaLista"><i class="fa fa-dashboard"></i>Acesso</a></li>
                                 <li class="active">Detalhar Usuário Grupo</li>
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
                             <section class="card">
                                 <header class="card-header">
  								    <div class="card-actions">
  									   <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
  								    </div>
  									<h2 class="card-title">Acesso</h2>
  								    <p class="card-subtitle"> Usuário Grupo </p>
  							    </header>
                                 <div class="card-body">
                                       
			<div class="col-lg-8">
				<label id="IdGrupo" class="control-label"><b>Id:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oAcessoGrupoUsuario) ? $oAcessoGrupoUsuario->getIdGrupo() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="IdUsuario" class="control-label"><b>Usuário:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oAcessoGrupoUsuario) ? $oAcessoGrupoUsuario->getIdUsuario() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="InseridoPor" class="control-label"><b>Inserido_por:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oAcessoGrupoUsuario) ? $oAcessoGrupoUsuario->getInseridoPor() : ""; ?></p>
				</blockquote>
			</div>
			<div class="col-lg-8">
				<label id="AlteradoPor" class="control-label"><b>Alterado_por:</b></label>
				<blockquote class="b-thin info">
					<p><?php echo ($oAcessoGrupoUsuario) ? $oAcessoGrupoUsuario->getAlteradoPor() : ""; ?></p>
				</blockquote>
			</div>
                                       <br />
                                         <br />
                                         <br />
                                         <a href="?action=AcessoGrupoUsuario.preparaLista"><button type="button" class="btn btn-sm btn-info "><i class="fa fa-angle-left"></i> Voltar</button></a>
                                 </div>
                             </section>
                         </div>
                     </div>
                 </section>
             </div>
 
         </section>
 
         <?php include_once("includes/javascript.php"); ?>
         <?php include_once("includes/view/js/js_detalhe.php"); ?>
 
         <section role="main" class="content-footer">
             <?php include_once('includes/footer.php'); ?>
         </section>
 
     </body>
 </html>