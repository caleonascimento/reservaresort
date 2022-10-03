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
            <div class="row">

                    <div class="col-xl-3 col-xs-12 mt-5">
                        <section class="card mb-4">
                            <div class="card-body bg-primary">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <div class="info">
                                                <strong class="amount">TESTE PDF</strong>
                                            </div>
                                            <h4 class="title">Geração de PDF</h4>
                                        </div>
                                        <div class="summary-footer">
                                            <a href="geraPDF.php" target="_blank" class="text-uppercase">GERAR</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <a href="?action=Empreendimento.preparaLista">
                    <div class="col-3 mt-5">
                        <section class="card mb-4">
                            <div class="card-body bg-danger">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <div class="info">
                                                <strong class="amount">Resort's</strong>
                                            </div>
                                            <h4 class="title">Gerenciar Empreendimentos, Unidades e Cotas</h4>
                                        </div>
                                        <div class="summary-footer">
                                            <a href="#" class="text-uppercase">Abrir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div></a>

                    <a href="?action=Usuario.preparaLista">
                        <div class="col-3 mt-5">
                            <section class="card mb-4">
                                <div class="card-body bg-warning">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon">
                                                <i class="fas fa-file-alt"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <div class="info">
                                                    <strong class="amount">Usuários</strong>
                                                </div>
                                                <h4 class="title">Gerenciar Usuários</h4>
                                            </div>
                                            <div class="summary-footer">
                                                <a href="#" class="text-uppercase">Abrir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </a>

            </div>
                                

                                
                
    <?php include_once("includes/foot-body.php"); ?>
    
    <script type="text/javascript">
             $(function() {  
                // ------------
             });
    
    </script>
    
</html>
