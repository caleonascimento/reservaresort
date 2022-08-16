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

                    <section class="card">
                            <header class="card-header">
                                <h2 class="card-title">Meus Dados</h2>
                                <p class="card-subtitle">Minhas Informações de Acesso</p>
                            </header>
                            <div class="card-body">
                            <div class="row">
                                    <div class="col-2"><label for=""><b>Id do Usuário:</b> </label> <span><?php echo $oAcessoUsuario->getId();?></span></div>
                                </div>
                                <div class="row">
                                    <div class="col-2"><label for=""><b>Nome:</b></label> <span><?php echo $oAcessoUsuario->getNome();?></span></div>
                                </div>
                                <div class="row">
                                    <div class="col-2"><label for=""><b>Login:</b></label> <span><?php echo $oAcessoUsuario->getLogin();?></span></div>
                                </div>
                                <div class="row">
                                    <div class="col-2"><label for=""><b>Email:</b></label> <span><?php echo $oAcessoUsuario->getEmail();?></span></div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-2"><label for=""><b>Cadastrado em:</b></label> <span><?php echo $oAcessoUsuario->getGeracao();?></span></div>
                                </div>
                            </div>
                    </section>
                
                </div>
        </div>

                            
                
    <?php include_once("includes/foot-body.php"); ?>
    
    <script type="text/javascript">
             $(function() {  
                // ------------
             });
    
    </script>
    
</html>
