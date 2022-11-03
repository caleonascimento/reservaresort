<html>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <head>
        <style>
            body{
                margin-top: 20px;
                padding-left: 0px;
            }
        </style>
    </head>
    <body>
        <div style="display: flex; padding-left: 65px;" class="box">
        <div class="col-xl-4">
            <section class="card card-featured-left card-featured-secondary">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary">
                                <i style="margin-top: 25%;" class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Receita</h4>
                                <div class="info">
                                    <strong class="amount">$ 4,890.30</strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase" href="#">Debitar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div> 
        <br>
        <div class="col-xl-4">
            <section class="card card-featured-left card-featured-success">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-success">
                                <i style="margin-top: 25%;" class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Saldo em Conta</h4>
                                <div class="info">
                                    <strong class="amount">$ 14,890.30</strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase" href="#">Sacar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div> 
        <br>
        <div class="col-xl-4">
            <section class="card card-featured-left card-featured-Primary">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-Primary">                                
                                <i style="margin-top: 25%;" class="fas fa-smile"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Parceiros</h4>
                                <div class="info">
                                    <strong class="amount">30</strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase" href="#">Contatar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div> 
    </div>                              
    </body>
</html>
<?php
require_once("env.php"); // Arquivo de configuração
require_once "includes/__autoloader.php"; // gera os includes da sessao
include_once("includes/sessionMessage.php"); // conf das menssagens

//INICIANDO A APLICAÇÃO
$oFrontController = new FrontController();
?>