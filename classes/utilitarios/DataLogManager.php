<?php

/*****************************************************************************************
 * SEPLAD - Secretaria do Estado de Planejamento e Administração
 * Autor: Caléo Reis Nascimento
 * Data: 08/01/2020
 * Descrição:
 *   A classe DataLogManager centraliza todas as operações de Logs, ela é responsável por
 *   gerir e administrar tanto a entrada quanto a consulta dos Logs do sistema.
 ****************************************************************************************/
class DataLogManager {

    private $oInterpretador;
    private $sOperacao;
    private $oPrevObject;
    private $bGerarLog;
    /*
    $this->oInterpretador->getDescritor()->getClasse()
    $this->oInterpretador->getDescritor()->getTabela()
    $this->oInterpretador->getDescritor()->getAtributoClasse()
    $this->oInterpretador->getDescritor()->getCampoTabela()
    $this->oInterpretador->getObjeto() //objeto inicializado
    */
    public function __construct($oInterpretador, $sOperacao, $oPrevObject=null){
          $this->oInterpretador = $oInterpretador;
          $this->bGerarLog = ($sOperacao=="Alterar")?false:true; // Inicia como 'false' para Alterar pois só gera log se algum dado for alterado de fato.
          $this->sOperacao = strtoupper($sOperacao);
          $this->oPrevObject = $oPrevObject;
 	}

    public function setOperacao($sOperacao) {
         $this->sOperacao = strtoupper($sOperacao);
    }
    public function getOperacao(){
        return $this->sOperacao;
    }
    public function setPrevObject($oPrevObject){
        $this->oPrevObject = $oPrevObject;
    }


    //Verifica se a tabela está cadastrada e com o log habilitado
    public static function logHabilitado($sTabela) {
        $oFachadaDbo = new FachadaDboBD();
        if($oDbSistemaTabela = $oFachadaDbo->recuperaDbsistemaTabelaPorNomeTabela($sTabela))
             if($oDbSistemaTabela->getMtbLogAtivo())
                 return $oDbSistemaTabela->getMtbId();

        return false;
    }

    /* **
     * O segundo paramentro deve ser passado principalmente em operações de inserção, em operações
     *  que o objeto antigo pode ser recuperado não há necessidade do ID do objeto ser passado.
     ** */
    public function gerarLog($nMtbId, $nObjectId=null) {

        //Inicializando variáveis:
        $oFachadaDbo = new FachadaDboBD();
        $oFachadaSeg = new FachadaSegBD();
        $sDtlDescricao = "";
        $vLogCampoAux = null;
        $voDataLogCampo = null;

        //Pega os campos que estão cadastrados para gerar sublogs (metadados)
        if($voDbSistemaTabelaLogCampo = $oFachadaDbo->recuperarTodosDbsistemaTabelaLogcampo(array('mtb_ID'=>$nMtbId, 'lgc_ativo'=>1)))
            foreach($voDbSistemaTabelaLogCampo as $i=>$oDbSistemaTabelaLogCampo)
                $vLogCampoAux[$i] = $oDbSistemaTabelaLogCampo->getLgcCampo();

        foreach($this->oInterpretador->getDescritor()->getAtributoClasse() as $i => $oAtributoClasse) {
             $sNomeMetodo = "get".substr($oAtributoClasse->getNome(),1,strlen($oAtributoClasse->getNome())-1);
             $oCampoTabela = $this->oInterpretador->getDescritor()->getCampoTabela()[$i];

             if(!$oCampoTabela->getCampoPrimario()) {
                 if($sDtlDescricaoAux = $this->processaDados($i, $sNomeMetodo)) {
                      $sDtlDescricao .= $oCampoTabela->getNome().':"'.$sDtlDescricaoAux;
                      $t = array_search($oCampoTabela->getNome(), $vLogCampoAux);
                      //Para o valor '0' não ser confundido com 'false' ou nulo e não inserir registro do campo vazio na tabela datalogcampo
                      if(($t !== false && !is_null($t)) && $this->sOperacao != "EXCLUIRFISICAMENTE" && !empty($this->oInterpretador->getObjeto()->$sNomeMetodo()))
                         $voDataLogCampo[] = $oFachadaSeg->inicializarDatalogCampo($nDlcId,$nDtlId,$voDbSistemaTabelaLogCampo[$t]->getLgcId(),$this->oInterpretador->getObjeto()->$sNomeMetodo());

                 }
             } elseif(empty($nObjectId))
                 $nObjectId = $this->oInterpretador->getObjeto()->$sNomeMetodo();
        }

        if($this->bGerarLog) {
            $sNomeCampoID = $this->oInterpretador->getDescritor()->getCampoTabela()[0]->getNome();
            $sDtlDescricao = "USER: ".$_SESSION['nome']." | TABLE: ".$this->oInterpretador->getDescritor()->getTabela().
                                    " | Object ID: ".$nObjectId." (".$sNomeCampoID.") - VALUES {".substr($sDtlDescricao, 0, -1)."}";
            $nUsoId = $oFachadaSeg->recuperarUmUsuarioPorIdProdepa($_SESSION['idUsuario'])->getUsoId();
            $oDataLog = $oFachadaSeg->inicializarDatalog($nDtlId, $nMtbId, $nUsoId, strtoupper($this->sOperacao), $sDtlDescricao, null);
            //Insere o Log na base de dados
            if($nIdDataLog = $oFachadaSeg->inserirDatalog($oDataLog)) {
                if($voDataLogCampo)
                    foreach($voDataLogCampo as $oDataLogCampo) {
                        $oDataLogCampo->setDtlId($nIdDataLog);
                        $oFachadaSeg->inserirDatalogCampo($oDataLogCampo);
                    }

                return $nIdDataLog;
            }
        }

        return false;
    }


    private function processaDados($i, $sNomeMetodo) {
         switch($this->sOperacao) {
            case "INSERIR":
                     return str_replace("'","",$this->oInterpretador->getObjeto()->$sNomeMetodo()).'",';
            break;
            case "ALTERAR":
                    if($this->oInterpretador->getObjeto()->$sNomeMetodo() != $this->oPrevObject->$sNomeMetodo()) {
                        if(!$this->bGerarLog)
                            $this->bGerarLog = true;
                        return str_replace("'","", $this->oPrevObject->$sNomeMetodo()) .
                                        '"=>"'.str_replace("'","",$this->oInterpretador->getObjeto()->$sNomeMetodo()).'",';
                    }
                return false;
            break;
            case "EXCLUIRFISICAMENTE":
                     return str_replace("'","",$this->oPrevObject->$sNomeMetodo()).'",';
            break;
         }
    }


}
?>