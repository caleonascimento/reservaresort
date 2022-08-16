<?php
 $voAcessoGrupoUsuario = @$_REQUEST['voAcessoGrupoUsuario'];
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
         <?php include_once('includes/head.php'); ?>
         <?php include_once('includes/view/css/css_index.php'); ?>
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
     							<li class="active">Gerenciar acesso_grupo_usuario</li>
     						</ol>
     						<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
                         </div>
                         <section class="content-header">
             				  <?php include_once('includes/mensagem.php'); ?>
             		    </section>
                     </header>
 
                     <!-- start: page (main content) -->
                         <div class="row">
                             <div class="col">
                                 <section class="card">
                                     <header class="card-header">
                                         <h2 class="card-title">acesso_grupo_usuario</h2>
                                     </header>
                                     <div class="card-body">
     									<form method="post" action="" name="formAcessoGrupoUsuario" id="formAcessoGrupoUsuario" class="formulario">
     										<div class='form-group col-md-3 select-acoes'>
     											<select class="form-control Acoes" name="acoes" id="acoesAcessoGrupoUsuario" onChange="JavaScript: submeteForm('AcessoGrupoUsuario')">
     													<option value="" selected>Ações...</option>
     													<option value="?action=AcessoGrupoUsuario.preparaFormulario&sOP=Cadastrar" lang="0">Cadastrar novo acesso_grupo_usuario</option>
     													<option value="?action=AcessoGrupoUsuario.preparaFormulario&sOP=Alterar" lang="1">Alterar acesso_grupo_usuario selecionado</option>
     													<option value="?action=AcessoGrupoUsuario.preparaFormulario&sOP=Detalhar" lang="1">Detalhar acesso_grupo_usuario selecionado</option>
     													<option value="?action=AcessoGrupoUsuario.processaFormulario&sOP=Excluir" lang="2">Excluir acesso_grupo_usuario(s) selecionado(s)</option>
     											</select>
     										</div>
 
 <?php                                      if(is_array($voAcessoGrupoUsuario)){
 ?>                                          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                                 <thead>
                                                     <tr>
                                                         <th width="1%">
                                                             <a href="javascript: marcarTodosCheckBoxFormulario('AcessoGrupoUsuario')"><i class="icon fa fa-check"></i></a>
                                                         </th>
                                                         
														 <th>IdGrupoUsuario</th>
														 <th>IdGrupo</th>
														 <th>IdUsuario</th>
														 <th>InseridoPor</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
 <?php                                             foreach($voAcessoGrupoUsuario as $oAcessoGrupoUsuario){
 ?>                                                  <tr>
                                                         <td><input onClick="JavaScript: atualizaAcoes('AcessoGrupoUsuario')" type="checkbox" value="<?php echo $oAcessoGrupoUsuario->getIdGrupoUsuario(); ?>" name="fIdAcessoGrupoUsuario[]" /></td>
                                                         
									 <td><?php echo $oAcessoGrupoUsuario->getIdGrupoUsuario(); ?></td>					
									 <td><?php echo $oAcessoGrupoUsuario->getIdGrupo(); ?></td>					
									 <td><?php echo $oAcessoGrupoUsuario->getIdUsuario(); ?></td>					
									 <td><?php echo $oAcessoGrupoUsuario->getInseridoPor(); ?></td>					
									 <td><?php echo $oAcessoGrupoUsuario->getAlteradoPor(); ?></td>
                                                     </tr>
 <?php                                              }
 ?>                                              </tbody>
                                                 <tfoot>
                                                     <tr>
                                                         <th>#</th>
                                                         
														 <th>IdGrupoUsuario</th>
														 <th>IdGrupo</th>
														 <th>IdUsuario</th>
														 <th>InseridoPor</th>
                                                     </tr>
                                                 </tfoot>
                                             </table>
 <?php                                      }
 ?>                                      </form>
                                     </div><!-- card-body -->
                                 </section><!-- card -->
                             </div> <!-- col -->
                         </div><!-- row -->
 
                 </section> <!-- content-body -->
              </div> <!-- inner-wrapper -->
 
         </section><!--section body-->
 
        <!-- Java Script includes -->
         <?php include_once("includes/javascript.php"); ?>
         <?php include_once("includes/view/js/js_index.php"); ?>
 
         <section role="main" class="content-footer">
              <?php include_once('includes/footer.php'); ?>
         </section>
     </body>
 </html>