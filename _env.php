<?php
//Definições gerais do sistema
define("HTTP_SERVER",             "http://localhost:8080/");
define('ROOT_PATH',               "/reservaresort/");
define("SYSTEM_NAME",             "Sistema de Atualização Cadastral do Servidor do Estado do Pará");
define("SYSTEM_INITIALS",         "SACS");
define("KEYWORDS",                "Sistema, SEPLAD, Governo");
define("DESCRIPTION",             "Diretoria de Tecnologia da Informação (DTI) - SEPLAD/PA");
define("AUTHOR",                  "");
define("COPYRIGHT",               "<a href=\"http://seplad.pa.gov.br\">DTI SEPLAD</a>.");

//Definições de banco de dados
define("BANCO",                   "reservasresort");
define("SERVIDORBD",              "localhost");
define("USUARIOBD",               "root");
define("SENHABD",                 '');


//Definições para envio de Email
define("EMAIL_TPL",               $_SERVER['DOCUMENT_ROOT'].ROOT_PATH."emails");
define("EMAIL_TPL_CACHE",         $_SERVER['DOCUMENT_ROOT'].ROOT_PATH."emails");
define("MAIL_USERNAME",           "");
define("MAIL_PASS",               "");
define("MAIL__FROM",              "");
define("MAIL__REPLY",             "");


?>
