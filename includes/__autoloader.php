<?php

/* * **************************************************************************************
 * *** Escrito por: Caléo Reis
 * *** Data: 06/02/2020
  Descrição: Funções para carregar classes dinâmicamente quando invocadas.
 * *************************************************************************************** */
 define("_ROOT_DIR", $_SERVER['DOCUMENT_ROOT'].ROOT_PATH);
 define("__CACHE_DIR", _ROOT_DIR  ."docs/session_cache.php");
//Pastas onde o autoloader irá procurar as classes chamadas pela aplicação
$vPastasAutoloader = array(
    "classes",
    "modulos"
);

if (!file_exists(__CACHE_DIR))
       file_put_contents(__CACHE_DIR, "<?php \n");


/* NOTA:  No PHP 7 as instancias das classes gravadas na sessão são processadas pelo autoloader antes das variáveis de sessão serem instanciadas,
      nesse caso não é possível verificar se a variável com path da classe está alocada, pois os objetos das classes gravados nas sessões são
      carregados primeiro. Nesses casos as sessões ficam com o valor NFC - Normalization Form C (NFC) - Canonical Decomposition followed by Canonical Composition.
      Nesses casos o autoloader acaba escrevendo repetidamente as classes no arquivo session_cache, para corrigir isso é verificado se
      $_SESSION['classes'] foi setado e se é um array, ou também pode ser verificado se possui o valor NFC.
*/
//----------------------------------------------------------------------------------------

//Define a extenção dos arquivos do autoloader
spl_autoload_extensions('.php');
//Função chamada automaticamente após um objeto ser instanciado.
spl_autoload_register(function ($sClasse) {

    global $vPastasAutoloader;

    try {

         if (isset($_SESSION['classes']))

              if(!is_array($_SESSION['classes'])) { // ou if($_SESSION['classes'] == 'NFC') {
                   if($sReturn = autoloaderProcess($vPastasAutoloader, $sClasse) !== true)
                         throw new exception($sReturn);
              //Verifica se o caminho da classe já existe na sessão.
              } elseif(isset($_SESSION['classes'][$sClasse])) {
                     //Valida o caminho da classe
                     if (!is_file(_ROOT_DIR.$_SESSION['classes'][$sClasse]))
                          throw new exception("Autoloader ERROR: Arquivo não encontrado. "._ROOT_DIR.$_SESSION['classes'][$sClasse]);
                    require_once _ROOT_DIR.$_SESSION['classes'][$sClasse];
              } else {
                   if($sReturn = autoloaderProcess($vPastasAutoloader, $sClasse, true) !== true)
                         throw new exception($sReturn);
              }
         else
             if($sReturn = autoloaderProcess($vPastasAutoloader, $sClasse) !== true)
                     throw new exception($sReturn);


     } catch(Exception $e) {
         //Tratar o erro aqui
         var_dump($e->getMessage()); die();
    }

});

//Função para processar o autoloader que ordena as buscas pelo arquivo da classe e o inclui no escopo da página.
 //Este método também permite escrever no arquivo de cache caso seja necessário.
function autoloaderProcess($vPastasAutoloader, $sClasse, $bWrite=false) {
       //Procura o arquivo em todas as pastas do array $vPastasAutoloader
       foreach ($vPastasAutoloader as $sPasta)
           //Caso encontre, retorna o caminho do arquivo..
           if ($sPath = findClass($sClasse, $sPasta)) {
               //Verifica se a escrita no arquivo de cache foi habilitada
               if($bWrite) {
                   if(!$cache = fopen(__CACHE_DIR, 'a+'))
                        return "Autoloader ERROR: Erro ao abrir o arquivo para escrita '".__CACHE_DIR."'";
                   //Escreve o path no arquivo e o fecha
                   fwrite($cache, "//Inserido em : " . date('d/m/Y H:i:s') . "\nif(!isset(\$_SESSION['classes']['$sClasse']))\n\t \$_SESSION['classes'][\"" . $sClasse . "\"] = \"" . $sPath . "\";\n");
                   fclose($cache);
               }
               //Grava o Path na sessão e inclui o arquivo no escopo da página.
               $_SESSION['classes'] = array();
               $_SESSION['classes'][$sClasse] = $sPath;
               require_once(_ROOT_DIR.$sPath);
               return true;
           }
       return "Autoloader ERROR: Arquivo não encontrado ou inexistente nas pastas: {'classes', 'modulos'}";
}

//Método recursivo para procurar o arquivo em u diretório.
function findClass($sNomeClasse, $sDiretorio) {

    if ($handle = opendir(_ROOT_DIR.$sDiretorio)) {
        while (false !== ($file = readdir($handle)))
            if (is_file(_ROOT_DIR.$sDiretorio . "/" . $file)) {
                if ($file == $sNomeClasse . spl_autoload_extensions()) {
                    return $sDiretorio . "/" . $sNomeClasse . spl_autoload_extensions();
                    break;
                }
            } elseif (is_dir(_ROOT_DIR.$sDiretorio . "/" . $file))
                if ($file != "." && $file != "..")
                    if ($sPath = findClass($sNomeClasse, $sDiretorio . "/" . $file))
                        return $sPath;
        return false;
    }
}



/*
    NOTA: É importante que o start da sessão e o include do arquivo de cache seja feita abaixo
    do método autoloader, como neste caso no fim da página.
    Caso contrário se algum objeto de alguma classe estiver estanciado na sessão, o mesmo não será
    carregado pelo autoloader, pois ele ainda não terá sido processado pelo compilador.
*/
//----------------------------------------------------------------------------------------------------
//Verifica se a sessão ja foi iniciada para todas as versões do PHP
if ((function_exists('session_status') && session_status() !== PHP_SESSION_ACTIVE) || !session_id()) // só inicia a sessão caso ainda não tenha sido criada.
    @session_start();
//verifica se a lista de classes já foi criada
include_once (__CACHE_DIR);

?>