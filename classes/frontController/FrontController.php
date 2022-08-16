<?php
class FrontController extends Controller{
	
	public function __construct() {
        
        $action = (isset($_GET['action'])) ? $_GET['action'] : false;

        if(!isset($_SESSION['oUsuario']) || !isset($_SESSION["voPermissaoGrupo"])){
                 header("Location: login.php");
                 die();
        }

        // NOTA: Essa clausula é uma excessão para quando o usuário acessar a página inicial.
         if(!empty($_SERVER['QUERY_STRING']) )
             $this->verificaPermissaoUrl();

        if($action) {
		     $vAction = explode(".",$action);
             if(count($vAction) == 2) {
                 $sClasse = $vAction[0];
    			 $sMetodo = $vAction[1];
    			 $oFactoryControle = new FactoryControle();
    			 $oControle = $oFactoryControle->getObject($sClasse);
    			 $oControle->$sMetodo();
             } else
                 include_once('modulos/main/index.php');
        } else
			 include_once('modulos/main/index.php');

	}



    /* NOTA: Fazer upgrade do código reorganizando o mapeamento da url em níveis decrecentes
     *      e verificando as permissões através de um laço composto ou método recurssivo. 
     */
    private function verificaPermissaoUrl() {
         try { 
             if(!$voAcessoModuloTransacao = $this->processaUrl())
                 throw new exception("Url Inválida!");

             //Verifica se o controle e a transação foram setados (Variáveis obrigatórias)
             if(!isset($voAcessoModuloTransacao['transacao']) || !isset($voAcessoModuloTransacao['controle']))
                 throw new exception("Controle ou Transação não informados na sessão!");

             //Verifica se as permissões do usuário foram carregadas para sessão
             if(!isset($_SESSION["voPermissaoGrupo"]))
                 if(!$_SESSION['voPermissaoGrupo'] = $this->recuperar("AcessoPermissaoGrupo", array('id_grupo'=>'IS NULL')))
                     throw new exception("Nenhuma permissão foi setada!");

             //Verifica a permissão para Operação, Transação e Controle
             foreach(array_reverse($voAcessoModuloTransacao) as $tipo=>$oAcessoModuloTransacao) {
                 if(($bReturn = FrontController::consultaPermissao($oAcessoModuloTransacao->getIdModuloTransacao()))!==null)
                     if(!$bReturn)
                         throw new exception("Permissão negada!");
                     else
                         return;
              }

             //---------------------------------------------------------------------------
             //Caso nenhuma permissão tenha sido encontrada, verifica permissão do módulo
             if($oModulo = $voAcessoModuloTransacao['controle']->getAcessoModuloTransacao()) {
                     if(($bReturn = FrontController::consultaPermissao($oModulo->getIdModuloTransacao()))!==null)
                         if(!$bReturn)
                             throw new exception("Permissão negada!");
                         else
                             return;
                     //Caso nenhuma permissão tenha sido encontrada, verifica permissão do módulo principal
                     if($oModulo0 = $oModulo->getAcessoModuloTransacao())
                         if(($bReturn = FrontController::consultaPermissao($oModulo0->getIdModuloTransacao()))!==null)
                             if(!$bReturn)
                                 throw new exception("Permissão negada!");
                             else
                                 return;
             }

             //Caso nenhuma permissão tenha sido encontrada
             throw new exception("Permissão negada!");

         } catch(Exception $e) {
             setMessage($e->getMessage(), 1);
             header("Location: ?");
             die();
         }
    }


    /* *****
     Método que processa a url no formato '?action=Controle.Transacao&sOP=Operacao',
     validando o formato e o mapeamento junto a base de dados. Após validar insere o
     mapeamento em um array na sessão.
    */
    /*
    NOTA DE ATUALIZAÇÂO: Atualizar este método para um modelo de auto-verificação de hierarquia tanto de permissões quanto na própria URL,
    desse modo a verificação ficaria mais sistematica e inteligente.
    Da forma que está abaixo, a verificação está um pouco engessada para um modelo hierarquico de permissão não permitindo um modelo mais autonomo.
    O que deve ser feito é uma adaptação do modelo de URL usado com um modelo de hierarquia, devendo auto-verificar qualquer nível de
    hirarquia e agrupamento existente na tabela, em outras palavras esse modelo deve ser recursivo seguindo o padrão da URL usado.
    */
    private function processaUrl() {
        try{
            $voAcessoModuloTransacao = array();
               //Algoritmo de processamento da URL corrente
               //1- Valida a URL acessada com os padrões esperados e pré-definidos
               if(!preg_match("/action={1}[a-zA-Z]+\.{1}[a-zA-Z]+/", $_SERVER['QUERY_STRING']))
                     throw new exception("Url Inválida!");

               /*
                * NOTA DE UPDATE: há uma situação que pode gerar erro na clausula abaixo, para casos onde o Controle tenha o mesmo
                *    nome do módulo, isso faz com que a variavel $oControle pegue também o módulo além do controle, e ao
                *    buscar a transação o id não bate e cai na exception abaixo.
                */

               //2- Divide a URL e monta o array
               $vAction  = explode('.', $_GET['action']);
               
               if(!$oControle = $this->recuperar("AcessoModuloTransacao", array('nome'=>$vAction[0]))) {
                     throw new exception("Controle inválido ou não cadastrado!");
                }
                $voAcessoModuloTransacao['controle'] = $oControle[0];

               if(!$oTransacao = $this->recuperar("AcessoModuloTransacao", array('nome'=>$vAction[1], 'id_modulo_transacao_pai'=>$oControle[0]->getIdModuloTransacao())))
                     throw new exception("Transação inválida ou não cadastrada!");

                $voAcessoModuloTransacao['transacao'] = $oTransacao[0];

               if(isset($_REQUEST['sOP']) && !empty($_REQUEST['sOP'])) {
                   if(!$oOperacao = $this->recuperar("AcessoModuloTransacao", array('nome'=>$_REQUEST['sOP'], 'id_modulo_transacao_pai'=>$oTransacao[0]->getIdModuloTransacao())))
                        throw new exception("Operação inválida ou não cadastrada!");

                    $voAcessoModuloTransacao['operacao'] = $oOperacao[0];
                }

                return $voAcessoModuloTransacao;

            } catch (Exception $e) {
                 setMessage($e->getMessage(), 1);
                 header("Location: ?");
                 die();
            }

    }

    /*
      Método estático para verificar a permissão de acesso do usuário através da passagem de parametros.

        Este método, diferente do método 'verificaPermissaoUrl()' deve ser chamado dentro das páginas
        para verificar a permissão de acesso do usuário.
        Além de verificar o acesso a determinadas URLs previamente através da passagem de parâmetro,
        é possivel verificar permissões de nomes, basta informar o 2º parametro como true.

        Parâmetros:
        O Parâmetro passado para o método em sua funcionalidade default, deve ser apenas
        a url da página do link, ex.: "action=GdgAvaliacao.preparaMonitoramentoAvaliacao&sOP=Cadastrar",
        o segunda parâmetro para esse caso deve ser true (valor default) por padrão;
        Em sua segunda funcionalidade é habilitada setando o segundo parâmetro como 'false', esta
        funcionalidade verifica as permissões por nomes, onde o primeiro parâmetro deve ser uma string no formato livre.
    */
    public static function verificaPermissao($sLabel, $bUrl=true) {

            $oControle = new Controller();
             //Verifica se a label é para verificar uma url ou um nome
             if($bUrl) {
                 //Valida a Url informada
                 if(!preg_match("/action={1}[a-zA-Z]+\.{1}[a-zA-Z]+/", $sLabel))
                     return false;
                 //Processa a Url
                 if(!count($vUrl = explode("action=", $sLabel))>1)
                     return false;

                  $sOP = '';
                 //Separa as variáveis da url, caso haja alguma e verifica se a operação foi setada na Url
                 if(count($vUrl = explode('&', $vUrl[1]))>1)
                     foreach($vUrl as $sUrlParte)
                         if(strpos($sUrlParte, 'sOP=')!==false)
                               $sOP = substr($sUrlParte, 4);

                 //Separa Controle e Transação
                 $vUrl = explode('.', $vUrl[0]);
                 $vUrl[] = $sOP;
                 $voAcessoModuloTransacao = array();

                 //Monta e Recupera os dados da url na base de dados para validação
                 foreach($vUrl as $i=>$sUrl)
                    if(!empty($sUrl)) {
                         $vWhere = array('nome'=>$sUrl);

                         if(!empty($voAcessoModuloTransacao))
                             $vWhere['id_modulo_transacao_pai'] = $voAcessoModuloTransacao[$i-1]->getIdModuloTransacao();

                         if(!$vResult = $oControle->recuperar("AcessoModuloTransacao",$vWhere))
                             return false;

                         $voAcessoModuloTransacao[] = $vResult[0];           
                    }

                 //Verifica a permissão do usuário
                 foreach(array_reverse($voAcessoModuloTransacao) as $oAcessoModuloTransacao)
                     if(($bReturn = FrontController::consultaPermissao($oAcessoModuloTransacao->getIdModuloTransacao()))!==null)
                         return $bReturn;

                 //---------------------------------------------------------------------------
                 //Caso nenhuma permissão tenha sido encontrada, verifica permissão do módulo
                 if($oModulo = $voAcessoModuloTransacao[0]->getAcessoModuloTransacao()) {
                     if(($bReturn = FrontController::consultaPermissao($oModulo->getIdModuloTransacao()))!==null)
                         return $bReturn;
                         //Caso nenhuma permissão tenha sido encontrada, verifica permissão do módulo principal
                     if($oModulo0 = $oModulo->getAcessoModuloTransacao())
                         if(($bReturn = FrontController::consultaPermissao($oModulo0->getIdModuloTransacao()))!==null)
                             return $bReturn;
                 }

                 //Caso não ache nada retorna falso
                 return false;
             } /* else {
                  NOTA DE UPDATE: Implementar aqui a segunda funcionalidade do método,
                                 verificar permissões de nomes livre de formatos, para
                                 permissões de funcionalidades, ex.: 'visualizarGraficoAdmin'.
                }*/

    }

    /*
     * Função estatica auxiliar, verifica se o id do acesso da página está setada na sessão
     */
    private static function consultaPermissao($nIdAcesso) {
        foreach($_SESSION["voPermissaoGrupo"] as $oPermissaoGrupo)
           if($nIdAcesso == $oPermissaoGrupo->getIdModuloTransacao())
               return $oPermissaoGrupo->getPermissao();
    }

    /**
     * Verifica se o usuário tem permissão de acesso baseado no perfil
     * @param $nPerfil
     * @param null $sUrl
     * @param bool $sMsg
     * @return boolean
     */
    public static function verificaPerfil($nPerfil, $sUrl = null, $sMsg = false){

        // verifica se já existe uma sessão
        // caso false, inicia a sessão
        if (!isset($_SESSION['voPermissaoGrupo'])) {
            session_start();
        }

        // recupera o array de perfis
        $voPerfil = isset($_SESSION['voPermissaoGrupo']) ? $_SESSION['voPermissaoGrupo'] : null;

        $bPermissao = false;

        // verifica se $voPerfil ? um array
        if (is_array($voPerfil)) {
            foreach ($voPerfil as $oPerfil) {
                // procura pela operação setada dentro do array
                if ($nPerfil == $oPerfil->getIdGrupo()) {
                    $bPermissao = true;
                    break;
                }
                else
                    $bPermissao = false;
            }
        } else{
            // procura pela operação setada dentro do array
            if ($nPerfil == $voPerfil->getIdGrupo())
                $bPermissao = true;
            else
                $bPermissao = false;
        }

        return $bPermissao;

    }
}
