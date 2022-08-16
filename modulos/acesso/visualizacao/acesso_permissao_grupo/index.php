<?php
 $voAcessoPermissaoGrupo = @$_REQUEST['voAcessoPermissaoGrupo'];
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
 							<li><a href="?action=AcessoPermissaoGrupo.preparaLista"><i class="fa fa-dashboard"></i>Acesso</a></li>
     							<li class="active">Gerenciar Permissões</li>
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
                                         <h2 class="card-title"> Listar Permissões</h2>
                                     </header>
                                     <div class="card-body">
     									<form method="post" action="" name="formAcessoPermissaoGrupo" id="formAcessoPermissaoGrupo" class="formulario">
     										<div class='form-group col-md-3 select-acoes'>
     											<select class="form-control Acoes" name="acoes" id="acoesAcessoPermissaoGrupo" onChange="JavaScript: submeteForm('AcessoPermissaoGrupo')">
     													<option value="" selected>Ações...</option>
     													<option value="?action=AcessoPermissaoGrupo.preparaFormulario&sOP=Cadastrar" lang="0">Cadastrar novo Permissão</option>
     													<option value="?action=AcessoPermissaoGrupo.preparaFormulario&sOP=Alterar" lang="1">Alterar Permissão selecionado</option>
     													<option value="?action=AcessoPermissaoGrupo.preparaFormulario&sOP=Detalhar" lang="1">Detalhar Permissão selecionado</option>
     													<option value="?action=AcessoPermissaoGrupo.processaFormulario&sOP=Excluir" lang="2">Excluir Permissão(s) selecionado(s)</option>
     											</select>
     										</div>
 
 <?php                                      if(is_array($voAcessoPermissaoGrupo)){
 ?>                                          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                                 <thead>
                                                     <tr>
                                                         <th width="1%">
                                                             <a href="javascript: marcarTodosCheckBoxFormulario('AcessoPermissaoGrupo')"><i class="icon fa fa-check"></i></a>
                                                         </th>
                                                         
														 <th width="1%">Id</th>
														 <th>Grupo de usuário</th>
														 <th>Modulo/transação</th>
														 <th width="1%">Permissão</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
 <?php                                             foreach($voAcessoPermissaoGrupo as $oAcessoPermissaoGrupo){
 ?>                                                  <tr>
                                                         <td><input onClick="JavaScript: atualizaAcoes('AcessoPermissaoGrupo')" type="checkbox" value="<?php echo $oAcessoPermissaoGrupo->getIdPermissaoGrupo(); ?>" name="fIdAcessoPermissaoGrupo[]" /></td>

                    									 <td><?php echo $oAcessoPermissaoGrupo->getIdPermissaoGrupo(); ?></td>
                    									 <td><?php echo ($oAcessoPermissaoGrupo->getAcessoGrupo())?$oAcessoPermissaoGrupo->getAcessoGrupo()->getNome():"-"; ?></td>
                    									 <td><?php echo $oAcessoPermissaoGrupo->getAcessoModuloTransacao()->getTitulo(); ?></td>
                    									 <td class="text-center"><?php echo $oAcessoPermissaoGrupo->getPermissao()?"Sim":"Não"; ?></td>
                                                     </tr>
 <?php                                              }
 ?>                                              </tbody>
                                                
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