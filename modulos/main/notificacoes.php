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
                                <h2 class="card-title">Notificações</h2>
                                <p class="card-subtitle">Notificações do tipo <?php echo $_GET['tipo'];?></p>
                    </header>
                    <div class="card-body"> 
                        <ul>
                            <?php foreach ($voNotificacoes as $oNotificacao) {  ?>
                                    <li class="mb-3 pb-2 border-bottom">
                                        [<?php echo $oNotificacao->getGeracaoFormatado();?>] -
                                        <a href="<?php echo ($oNotificacao->getLink())?$oNotificacao->getLink():"#";?>">
                                            <?php echo $oNotificacao->getMensagem();?>
                                        </a>
                                    </li>
                                   
                            <?php } ?>
                            
                        </ul>

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
