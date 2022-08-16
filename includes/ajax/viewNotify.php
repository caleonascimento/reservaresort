<?php 
require_once("../../env.php");
require_once("../../includes/__autoloader.php");

$oController = new Controller();
$oNotificacao = new Notificacao();

$oNotificacao->setId($_POST['id']);
$oNotificacao->setVisualizada(1);

if($oController->alterar($oNotificacao)){
    echo "1";
    die();
}

echo "0";
die();
?>