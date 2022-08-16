<?php
 /**
  * @author Auto-Generated 
  * @SGBD mysql 
  * @tabela unidade 
  */
 class Unidade{
 	/**
	* @campo id
	* @var number
	* @primario true
	* @nulo false
	* @auto-increment true
	*/
	private $nId;
	/**
	* @campo tipo
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sTipo;
	/**
	* @campo descricao
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sDescricao;
	/**
	* @campo lotacao
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nLotacao;
	/**
	* @campo id_empreendimento
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdEmpreendimento;
	private $oEmpreendimento;
	
 	
 	public function __construct(){
 		
 	}
 	
 	
	 public function setId($nId) {
		$this->nId = $nId;
	 }
	 public function getId() {
		return $this->nId;
	 }
	 public function setTipo($sTipo) {
		$this->sTipo = $sTipo;
	 }
	 public function getTipo() {
		return $this->sTipo;
	 }
	 public function setDescricao($sDescricao) {
		$this->sDescricao = $sDescricao;
	 }
	 public function getDescricao() {
		return $this->sDescricao;
	 }
	 public function setLotacao($nLotacao) {
		$this->nLotacao = $nLotacao;
	 }
	 public function getLotacao() {
		return $this->nLotacao;
	 }
	 public function setIdEmpreendimento($nIdEmpreendimento) {
		$this->nIdEmpreendimento = $nIdEmpreendimento;
	 }
	 public function getIdEmpreendimento() {
		return $this->nIdEmpreendimento;
	 }
	public function setEmpreendimento($oEmpreendimento) {
		$this->oEmpreendimento = $oEmpreendimento;
	}
	public function getEmpreendimento() {
		$oController = new Controller();
		if($this->oEmpreendimento = $oController->recuperar('Empreendimento', array('id_empreendimento'=>$this->getIdEmpreendimento())))
				return $this->oEmpreendimento[0];
		return false;
	}
 }
 ?>
