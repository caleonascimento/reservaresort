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

//Produção
// define("BANCO",                "");
// define("SERVIDORBD",           "177.74.2.213");
// define("USUARIOBD",            "root");
// define("SENHABD",              '$GBd53Pl@N19');

//Definições para envio de Email
define("EMAIL_TPL",               $_SERVER['DOCUMENT_ROOT'].ROOT_PATH."emails");
define("EMAIL_TPL_CACHE",         $_SERVER['DOCUMENT_ROOT'].ROOT_PATH."emails");
define("MAIL_USERNAME",           "sigconv@sistemas.pa.gov.br");
define("MAIL_PASS",               "Prodepa0025");
define("MAIL__FROM",              "SEPLAD");
define("MAIL__REPLY",             "sigconv@seplan.pa.gov.br");


?>