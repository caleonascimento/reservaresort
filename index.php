<?php
require_once("env.php"); // Arquivo de configuração
require_once "includes/__autoloader.php"; // gera os includes da sessao
include_once("includes/sessionMessage.php"); // conf das menssagens
include_once("vendor/autoload.php"); //Inclui o autoload do composer


//INICIANDO A APLICAÇÃO
$oFrontController = new FrontController();
?>