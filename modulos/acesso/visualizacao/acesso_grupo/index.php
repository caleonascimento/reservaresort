<?php 
 $voAcessoGrupo = @$_REQUEST['voAcessoGrupo']; 
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
                    <section class="card mb-4 mt-4 w-2">
                        <div class="card-body">
<?php                           if (isset($_SESSION['oUsuario'])) { 
                                    if ($bPermissaoAcessoModuloTransacao) { ?>
                                        <a href="?action=AcessoModuloTransacao.preparaLista" class="btn btn-app" title="Mapeamento de Módulos, Páginas e Transações">
                                            <i class="fa fa-exchange-alt"></i> Módulos/Transações
                                        </a> 
<?php                               } 
                                    if ($bPermissaoAcessoUsuario) {
?>                                      <a href="?action=AcessoUsuario.preparaLista" class="btn btn-app" title="Cadastrar ou Editar Usuários" >
                                            <i class="fa fa-user"></i> Usuários
                                        </a>
<?php                               } 
                                } 
?>                      </div>
                    </section>


                    <div class="row">
                        <div class="col">
                            <section class="card">
                                <header class="card-header">
                                         <h2 class="card-title">Grupo de Usuários</h2>
                                </header>
                                <div class="card-body">
     								<form method="post" action="" name="formAcessoGrupo" id="formAcessoGrupo" class="formulario">
     									<div class='form-group col-md-3 select-acoes'>
     											<select class="form-control Acoes" name="acoes" id="acoesAcessoGrupo" onChange="JavaScript: submeteForm('AcessoGrupo')">
     													<option value="" selected>Ações...</option>
     													<option value="?action=AcessoGrupo.preparaFormulario&sOP=Cadastrar" lang="0">Cadastrar novo Grupo de Usuários</option>
     													<option value="?action=AcessoGrupo.preparaFormulario&sOP=Alterar" lang="1">Alterar Grupo de Usuários selecionado</option>
     													<option value="?action=AcessoGrupo.preparaFormulario&sOP=Detalhar" lang="1">Detalhar Grupo de Usuários selecionado</option>
     													<option value="?action=AcessoGrupo.processaFormulario&sOP=Excluir" lang="2">Excluir Grupo de Usuários(s) selecionado(s)</option>
     											</select>
     							        </div>
 <?php                                  if(is_array($voAcessoGrupo)){
 ?>                                          <table class="table table-bordered table-striped mb-0 text-4" id="datatable-tabletools" >
                                                 <thead>
                                                     <tr>
                                                         <th width="1%">
                                                             <a href="javascript: marcarTodosCheckBoxFormulario('AcessoGrupo')"><i class="icon fa fa-check"></i></a>
                                                         </th>
														 <th width="1%">Id</th>
														 <th>Nome</th>
														 <th>Grupo herdado</th>
														 <th width="1%">Ativo</th>
														 <th width="1%">Permissões</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
 <?php                                             foreach($voAcessoGrupo as $oAcessoGrupo){
 ?>                                                  <tr>
                                                         <td><input onClick="JavaScript: atualizaAcoes('AcessoGrupo')" type="checkbox" value="<?php echo $oAcessoGrupo->getIdGrupo(); ?>" name="fIdAcessoGrupo[]" /></td>

                    									 <td><?php echo $oAcessoGrupo->getIdGrupo(); ?></td>
                    									 <td><?php echo $oAcessoGrupo->getNome(); ?></td>
                    									 <td><?php echo $oAcessoGrupo->getAcessoGrupo()?$oAcessoGrupo->getAcessoGrupo()->getNome():'-'; ?></td>
                    									 <td class="text-center"><?php echo ($oAcessoGrupo->getAtivo())?Sim:Não; ?></td>
                                                         <td class="text-center"><a href="?action=AcessoPermissaoGrupo.preparaFormulario&sOP=Detalhar&nIdAcessoGrupo=<?php echo $oAcessoGrupo->getIdGrupo(); ?>" title="Gerenciar Permissões"><i class="fas fa-cog"></i></a></td>
                                                     </tr>
 <?php                                              }
 ?>                                              </tbody>
                                            </table>
 <?php                                  }
 ?>                                 </form>
                                </div><!-- card-body -->
                            </section><!-- card -->
                        </div>
                    </div>    
<?php include_once("includes/foot-body.php"); ?>
<!-- js custom -->
 </html>