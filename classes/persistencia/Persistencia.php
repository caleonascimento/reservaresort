<?php
error_reporting(E_PARSE | E_ERROR);

class Persistencia {

    private $oInterpretador;
    private $oBancoDeDados;
    private $sTabela;

    //Constantes
    const _ALTERAR = "ALTERAR";
    const _RECUPERAR = "RECUPERAR";
    const _INSERIR = "INSERIR";
    const _EXCLUIR = "EXCLUIRFISICAMENTE";
    const _INSERIR_ARQUIVO = "INSERIR_ARQUIVO";
    const _ALL = "*";

    public function __construct($oObjeto){
        $this->oInterpretador = new Interpretador($oObjeto);
        $this->oBancoDeDados = new BancoDeDados();
        $this->sTabela = $this->oInterpretador->recuperarTabela();
    }
    
    public static function executar($sQuery) {
        $oBancoDeDados = new BancoDeDados();
        return $oBancoDeDados->executarSQL($sQuery);
    }
    
    public static function executarProcedure($sQuery) {
        $oBancoDeDados = new BancoDeDados();
        return $oBancoDeDados->executarProcedure($sQuery);
    }

    public function consultar($sCampos, $sComplemento) {
        $sCampos = (empty($sCampos)) ?self:: _ALL:$sCampos;
        if($voResult = $this->oBancoDeDados->processarOperacao(self::_RECUPERAR, $this->sTabela,$sCampos,$sComplemento))
            $voResult = $this->oInterpretador->recuperarVetorObjetos($voResult);
        return $voResult;
    }

    public function inserir() {
        $sCampos = $this->oInterpretador->recuperarCamposInserir();
        $sValores = $this->oInterpretador->recuperarCamposInserirValores();
        if($voResult = $this->oBancoDeDados->processarOperacao(self::_INSERIR, $this->sTabela, $sCampos, $sValores))
            $this->gerarLogOperacoes(self::_INSERIR, null, $voResult);
        return $voResult;
    }

    public function alterar() {
        $sCampos = $this->oInterpretador->recuperarCamposAlterar();
        $sComplemento = $this->oInterpretador->recuperarWhereCamposPrimario();
        if($bResult = $this->oBancoDeDados->processarOperacao(self::_ALTERAR, $this->sTabela, $sCampos, $sComplemento))
            $this->gerarLogOperacoes(self::_ALTERAR, $this->recuperaObjeto());
        return $bResult;
    }

    //NOTA: O id de exclusão pode ser passado como argumento para o método ou ser setado na classe modelo.
    public function excluir($nId=null) {
       if(!$sComplemento = ($nId)?$this->oInterpretador->montaWhereIdCampo($nId):$this->oInterpretador->recuperarWhereCamposPrimario())
            return false;
       if($bResult = $this->oBancoDeDados->processarOperacao(self::_EXCLUIR, $this->sTabela, null, $sComplemento))
            $this->gerarLogOperacoes(self::_EXCLUIR, $this->recuperaObjeto());

       return $bResult;
    }

    //Método ainda não testado...
    /*public function upload() {
        $oBancoDeDados = new BancoDeDados();

       $sTabela = $this->oInterpretador->recuperarTabela();
       $sCampos = $this->oInterpretador->recuperarCamposInserir();
       $sValores = $this->oInterpretador->recuperarCamposInserirValores();
       $bResult = $oBancoDeDados->processarOperacao(self::_INSERIR_ARQUIVO);
       if($bResult)
            $this->gerarLogOperacoes(self::_INSERIR_ARQUIVO, $this->recuperaObjeto());
       return $bResult;
    }*/

    //NOTA: Método para recuperar os dados do objeto antes da alteração ou exclusão.
    private function recuperaObjeto() {
        $sComplemento = $this->oInterpretador->recuperarWhereCamposPrimario();
        if($voObjetoAnterior = $this->consultar(null,$sComplemento))
            return $voObjetoAnterior[0];
        return false;
    }

    //Este método desativa a tabela caso ela possua algum campo com o sufixo '_ativo' ou '_inativo'
    public function excluirDesativar($nId) {    
         if(!$nIndiceCampo = $this->oInterpretador->recuperarIndiceCampoAtivoInativo())
               return $this->excluir($nId);
         else { 
             $this->oInterpretador->setId($nId);
             $oAtributoClasse = $this->oInterpretador->getDescritor()->getAtributoClasse()[$nIndiceCampo]; //Pega o atributo da classe
             $sNomeMetodo = "set".substr($oAtributoClasse->getNome(),1,strlen($oAtributoClasse->getNome())-1); //Monta o método set para o atributo
             if(stristr($oAtributoClasse->getNome(), '_inat'))  //Para o caso do campo ser _inativo(a)
                 $this->oInterpretador->getObjeto()->$sNomeMetodo(1); //seta o valor para 1 usando o método set
             else
                 $this->oInterpretador->getObjeto()->$sNomeMetodo(0);

             return $this->alterar();
         }
    }

    /* **
      Este método invoca os logs de operações e backup do sistema.
      NOTA: os argumentos: $oObjetoAntigo e $nObjectId, são equivalentes, não há necessidade
            de ambos serem informados ao mesmo tempo, ou um ou outro.
    */
    public function gerarLogOperacoes($sOP,$oObjetoAntigo=null,$nObjectId=null) {
        return true; //ATENÇÂO: Remover essa linha caso o LOG esteja configurado no sistema corretamente...
        //--------------------------------------------------------------------------------------------------
        if($nMtbId = DataLogManager::logHabilitado($this->sTabela)) {
             $oDataLogManager = new DataLogManager($this->oInterpretador, $sOP, $oObjetoAntigo);
             $oDataLogManager->gerarLog($nMtbId, $nObjectId);
        }

    }


}
?>