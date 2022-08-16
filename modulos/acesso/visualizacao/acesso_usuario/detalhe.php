<?php
$sOP = $_REQUEST['sOP'];
$oAcessoUsuario = @$_REQUEST['oAcessoUsuario'];
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

            <!-- start: page -->
            <div class="row mt-5">
                <div class="col-lg-12">
                    <section class="card">
                        <header class="card-header">
                            <div class="card-actions">
                                <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                            </div>
                            <h2 class="card-title">Acesso</h2>
                            <p class="card-subtitle">Usuário</p>
                        </header>
                        <div class="card-body">

                            <div class="col-lg-8">
                                 <label id="Nome" class="control-label"><b>Nome:</b></label>
                                 <blockquote class="b-thin info">
                                     <p><?php echo $oAcessoUsuario->getNome(); ?></p>
                                 </blockquote>
                            </div>
                            <div class="col-lg-8">
                                <label id="Login" class="control-label"><b>Login:</b></label>
                                <blockquote class="b-thin info">
                                    <p><?php echo $oAcessoUsuario->getLogin(); ?></p>
                                </blockquote>
                            </div>

                            <div class="col-lg-8">
                                <label id="Email" class="control-label"><b>Email:</b></label>
                                <blockquote class="b-thin info">
                                    <p><?php echo $oAcessoUsuario->getEmail(); ?></p>
                                </blockquote>
                            </div>
                        
                            <div class="col-lg-8">
                                <label id="Geracao" class="control-label"><b>Gerado em:</b></label>
                                <blockquote class="b-thin info">
                                    <p><?php echo $oAcessoUsuario->getGeracao(); ?></p>
                                </blockquote>
                            </div>
                            <div class="col-lg-8">
                                <label id="UltimoAcesso" class="control-label"><b>Ultimo_acesso:</b></label>
                                <blockquote class="b-thin info">
                                    <p><?php echo $oAcessoUsuario->getUltimoAcessoFormatado(); ?></p>
                                </blockquote>
                            </div>

                            <br><br><br>
                            <a href="?action=AcessoUsuario.preparaLista"><button type="button" class="btn btn-sm btn-info "><i class="fa fa-angle-left"></i> Voltar</button></a>
                        </div>
                    </section>

                    <section class="card">
                        <header class="card-header">
                            <h2 class="card-title">Gerenciar Grupos do Usuário</h2>
                        </header>
                        <div class="card-body">
                            <form action="?action=AcessoGrupoUsuario.processaFormulario&sOP=Cadastrar" method="post">
                                <input type="hidden" name="fIdUsuario" value="<?php echo $nIdAcessoUsuario;?>" />
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="IdGrupo">Grupos:<span class="required">*</span></label>
                                        <select name="fIdGrupo" id="IdGrupo" data-plugin-selectTwo class="form-control" required title="Selecione um grupo">
                                            <option>Selecione..</option>
                                            <?php foreach($voAcessoGrupo as $oAcessoGrupo) { ?>
                                                <option value="<?php echo $oAcessoGrupo->getIdGrupo();?>"><?php echo $oAcessoGrupo->getNome();?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4" style="padding-top:29px;">
                                        <button class="btn btn-primary" type="submit">Inserir</button>
                                    </div>
                                </div>
                            </form>

                            <hr />

                            <div class="col-sm-4">
                                <table class="table table-bordered table-striped mb-0 text-4">
                                    <thead>
                                    <tr>
                                        <th>Grupo</th>
                                        <th width="1%">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($voAcessoGrupoUsuario as $oAcessoGrupoUsuario) { ?>
                                        <tr>
                                            <td><?php echo $oAcessoGrupoUsuario->getGrupo()->getNome();?></td>
                                            <td class="text-center"><a href="?action=AcessoGrupoUsuario.processaFormulario&sOP=Excluir&fIdAcessoGrupoUsuario=<?php echo $oAcessoGrupoUsuario->getIdGrupoUsuario();?>&fIdUsuario=<?php echo $nIdAcessoUsuario;?>"><i class="fas fa-times-circle"></i></a> </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
     <?php include_once("includes/foot-body.php"); ?>
</html>