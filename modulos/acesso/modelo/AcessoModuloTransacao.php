<?php
 /**
  * @author Auto-Generated 
  * @package fachada 
  * @SGBD mysql 
  * @tabela acesso_modulo_transacao 
  */
 class AcessoModuloTransacao{
 	/**
	* @campo id_modulo_transacao
	* @var number
	* @primario true
	* @nulo false
	* @auto-increment true
	*/
	private $nIdModuloTransacao;
    /**
	* @campo id_modulo_transacao_0
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdModuloTransacao0;
	/**
	* @campo id_modulo_transacao_pai
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdModuloTransacaoPai;
	/**
	* @campo nome
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sNome;
	/**
	* @campo titulo
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sTitulo;
	/**
	* @campo tipo
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nTipo;
	/**
	* @campo menu
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sMenu;
	/**
	* @campo inserido_por
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sInseridoPor;
	/**
	* @campo alterado_por
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sAlteradoPor;
	private $oAcessoModuloTransacao;
	private $oAcessoModuloTransacao0;

 	
 	public function __construct(){
 		
 	}
 	
 	
	 public function setIdModuloTransacao($nIdModuloTransacao) {
		$this->nIdModuloTransacao = $nIdModuloTransacao;
	 }
	 public function getIdModuloTransacao() {
		return $this->nIdModuloTransacao;
	 }
     public function setIdModuloTransacao0($nIdModuloTransacao0) {
		$this->nIdModuloTransacao0 = $nIdModuloTransacao0;
	 }
	 public function getIdModuloTransacao0() {
		return $this->nIdModuloTransacao0;
	 }
	 public function setIdModuloTransacaoPai($nIdModuloTransacaoPai) {
		$this->nIdModuloTransacaoPai = $nIdModuloTransacaoPai;
	 }
	 public function getIdModuloTransacaoPai() {
		return $this->nIdModuloTransacaoPai;
	 }
	 public function setNome($sNome) {
		$this->sNome = $sNome;
	 }
	 public function getNome() {
		return $this->sNome;
	 }
	 public function setTitulo($sTitulo) {
		$this->sTitulo = $sTitulo;
	 }
	 public function getTitulo() {
		return $this->sTitulo;
	 }
	 public function setTipo($nTipo) {
		$this->nTipo = $nTipo;
	 }
	 public function getTipo() {
		return $this->nTipo;
	 }
	 public function setMenu($sMenu) {
		$this->sMenu = $sMenu;
	 }
	 public function getMenu() {
		return $this->sMenu;
	 }
	 public function setInseridoPor($sInseridoPor) {
		$this->sInseridoPor = $sInseridoPor;
	 }
	 public function getInseridoPor() {
		return $this->sInseridoPor;
	 }
	 public function setAlteradoPor($sAlteradoPor) {
		$this->sAlteradoPor = $sAlteradoPor;
	 }
	 public function getAlteradoPor() {
		return $this->sAlteradoPor;
	 }

	public function setAcessoModuloTransacao($oAcessoModuloTransacao) {
		$this->oAcessoModuloTransacao = $oAcessoModuloTransacao;
	}
	public function getAcessoModuloTransacao() {
		$oController = new Controller();
		$this->oAcessoModuloTransacao = $oController->recuperar('AcessoModuloTransacao', array('id_modulo_transacao'=>$this->getIdModuloTransacaoPai()));
		return $this->oAcessoModuloTransacao[0];
	}

    public function setAcessoModuloTransacao0($oAcessoModuloTransacao0) {
		$this->oAcessoModuloTransacao0 = $oAcessoModuloTransacao0;
	}
	public function getAcessoModuloTransacao0() {
		$oController = new Controller();
		$this->oAcessoModuloTransacao0 = $oController->recuperar('AcessoModuloTransacao', array('id_modulo_transacao'=>$this->getIdModuloTransacao0()));
		return $this->oAcessoModuloTransacao0[0];
	}

    //Recupera um vetor com todos os filhos da geração seguinte
	public function getAcessoModuloTransacaoChild() {
		$oController = new Controller();
		return  $oController->recuperar('AcessoModuloTransacao', array('id_modulo_transacao_pai'=>$this->getIdModuloTransacao()));  
	}
 }
 ?>
