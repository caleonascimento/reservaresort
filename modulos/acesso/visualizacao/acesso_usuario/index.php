<?php
 $voAcessoUsuario = @$_REQUEST['voAcessoUsuario'];
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
    </head>
    
    <?php include_once("includes/head-body.php"); ?>
 
                     <!-- start: page (main content) -->
                         <section class="card mb-4 mt-4 w-3">
                            <div class="card-body">
                                <?php if (isset($_SESSION['oUsuario'])) {
                                ?>
                                    <a href="?action=AcessoGrupo.preparaLista" class="btn btn-app" title="Cadastrar ou Editar Grupo de Usuários">
                                        <i class="fa fa-users"></i> Grupos de Usuários
                                    </a> 

                                    <?php if ($bPermissaoAcessoModuloTransacao) {
                                    ?>
                                    <a href="?action=AcessoModuloTransacao.preparaLista" class="btn btn-app ml-4" title="Mapeamento de Módulos, Páginas e Transações">
                                        <i class="fa fa-exchange-alt"></i> Módulos/Transações
                                    </a> 
                                    <?php }
                                } ?>
                            </div>
                         </section>
					 
                         <div class="row ">
                             <div class="col">
                                 <section class="card">
                                     <header class="card-header">
                                         <h2 class="card-title">Logins de Usuários</h2>
                                     </header>
                                     <div class="card-body ">
     									<form method="post" action="" name="formAcessoUsuario" id="formAcessoUsuario" class="formulario">
     										<div class='form-group col-md-3 select-acoes'>
     											<select class="form-control Acoes" name="acoes" id="acoesAcessoUsuario" onChange="JavaScript: submeteForm('AcessoUsuario')">
     													<option value="" selected>Ações...</option>
     													<option value="?action=AcessoUsuario.preparaFormulario&sOP=Cadastrar" lang="0">Cadastrar novo Usuário</option>
     													<option value="?action=AcessoUsuario.preparaFormulario&sOP=Alterar" lang="1">Alterar Usuário selecionado</option>
     													<option value="?action=AcessoUsuario.preparaFormulario&sOP=Detalhar" lang="1">Detalhar Usuário selecionado</option>
     													<option value="?action=AcessoUsuario.processaFormulario&sOP=Excluir" lang="1">Excluir Usuário(s) selecionado(s)</option>
     											</select>
     										</div>
 
 <?php                                      if(is_array($voAcessoUsuario)){
 ?>                                          <table class="table table-bordered table-striped mb-0 text-4" id="datatable-tabletools">
                                                 <thead>
                                                     <tr>
                                                         <th width="1%">
                                                             <a href="javascript: marcarTodosCheckBoxFormulario('AcessoUsuario')"><i class="icon fa fa-check"></i></a>
                                                         </th>
														 <th width="1%">Id</th>
														 <th>Nome</th>      
														 <th>Login</th>      
														 <th>Email</th>      
														 <th>UltimoAcesso</th>
														 <th width="1%">Ações</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
 <?php                                             foreach($voAcessoUsuario as $oAcessoUsuario){
 ?>                                                  <tr>
                                                         <td><input onClick="JavaScript: atualizaAcoes('AcessoUsuario')" type="checkbox" value="<?php echo $oAcessoUsuario->getId(); ?>" name="fIdAcessoUsuario[]" /></td>
                    									 <td><?php echo $oAcessoUsuario->getId(); ?></td>
                    									 <td><?php echo $oAcessoUsuario->getNome(); ?></td>
                    									 <td><?php echo $oAcessoUsuario->getLogin(); ?></td>
                    									 <td><?php echo $oAcessoUsuario->getEmail(); ?></td>
                    									 <td><?php echo $oAcessoUsuario->getUltimoAcessoFormatado(); ?></td>
                                                         <td class="text-center">
                                                                <a href="?action=AcessoUsuario.preparaFormulario&sOP=Detalhar&nIdAcessoUsuario=<?php echo $oAcessoUsuario->getId(); ?>" title="Gerenciar Usuário"><i class='fas fa-cog'></i></a>                                                               
                                                         </td>
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

    <?php include_once("includes/view/js_index.php")?>
    <?php include_once("includes/foot-body.php"); ?>
            
</html>