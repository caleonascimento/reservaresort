<?php
 $voAcessoModuloTransacao = @$_REQUEST['voAcessoModuloTransacao'];
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
                    <?php if (isset($_SESSION['oUsuario'])) { ?>
                        <a href="?action=AcessoGrupo.preparaLista" class="btn btn-app" title="Cadastrar ou Editar Grupo de Usuários">
                            <i class="fa fa-users"></i> Grupos de Usuários
                        </a> 
                        <?php if ($bPermissaoAcessoUsuario) { ?>
                        <a href="?action=AcessoUsuario.preparaLista" class="btn btn-app" title="Cadastrar ou Editar Usuários" >
                            <i class="fa fa-user"></i> Usuários
                        </a>
                        <?php } 
                    } ?>
                </div>
            </section>    
            
            <div class="row">
                <div class="col">
                    <section class="card">
                        <header class="card-header">
                            <h2 class="card-title">Mapeamento de Módulos, Páginas e Transações</h2>
                        </header>
                        <div class="card-body">
                        <form method="post" action="" name="formAcessoModuloTransacao" id="formAcessoModuloTransacao" class="formulario">
<?php                          if(is_array($voAcessoModuloTransacao)){
?>                                <table class="table table-bordered table-striped mb-0 text-4" id="datatable-tabletools">
                                    <thead>
                                        <tr>
                                            <th width="1%">Id</th>
                                            <th>Título</th>
                                            <th>Nome</th>
                                            <th>Tipo</th>
                                            <th width="1%">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php                              foreach($voAcessoModuloTransacao as $oAcessoModuloTransacao){
                                        switch($oAcessoModuloTransacao->getTipo()) {
                                            case 0:
                                                $sTipo = "Módulo";
                                            break;
                                            case 1:
                                                $sTipo = "Controle";
                                            break;
                                            case 2:
                                                $sTipo = "Transação";
                                            break;
                                            case 3:
                                                $sTipo = "Operação";
                                            break;
                                        }
?>                                                  <tr>
                                            <td><?php echo $oAcessoModuloTransacao->getIdModuloTransacao(); ?></td>
                                            <td><?php echo $oAcessoModuloTransacao->getTitulo(); ?></td>
                                            <td><?php echo $oAcessoModuloTransacao->getNome(); ?></td>
                                            <td><?php echo $sTipo ?></td>
                                            <td class="text-center"><a href="?action=AcessoModuloTransacao.preparaFormulario&sOP=Detalhar&nIdAcessoModuloTransacao=<?php echo $oAcessoModuloTransacao->getIdModuloTransacao(); ?>" title="Gerenciar Permissões"><i class="fas fa-cog"></i></a></td>
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
 
     <?php include_once("includes/foot-body.php"); ?>
 </html>