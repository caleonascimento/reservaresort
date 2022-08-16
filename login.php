<?php

require_once("env.php");
require_once "includes/__autoloader.php";
//Inicia a sessão
@session_start();
//Exclui as variáveis da sessão

//Configura mensagens
//Zera variaveis
$sMsgClass = $sMessage = null;
if(isset($_SESSION['oMsg']) && isset($_SESSION['oMsg']->sMsg) ) {
    if(isset($_SESSION['oMsg']->nType))
        if($_SESSION['oMsg']->nType == 1)
            $sMsgClass = "alert-danger";
        else
            $sMsgClass = "alert-success";

    $sMessage = $_SESSION['oMsg']->sMsg;
}
unset($_SESSION['oMsg']);

@session_unset();
$sAction = (isset($_GET['action'])?$_GET['action']:"");

switch ($sAction) {
    case 'alterarSenha':
        include_once("login/alteraSenha.php");
        die();
    break;
    case 'resetSenha':
        include_once("login/reset_senha.php");
        die();
    break;
    case 'processaLogin':
        include_once("login/processaLogin.php");
        die();
    break;
    default:
        include_once("login/login.php");
        die();
    break;
}