<?php
 /**
  * @author Auto-Generated 
  * @SGBD mysql 
  * @tabela empreendimento_tipo_unidade 
  */
 class EmpreendimentoTipoUnidade {
 	/**
	* @campo id
	* @var number
	* @primario true
	* @nulo false
	* @auto-increment false
	*/
	private $nId;
	/**
	* @campo id_empreendimento
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdEmpreendimento;
	/**
	* @campo nome
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sNome;
	/**
	* @campo lotacao
	* @var number
	* @primario false
	* @nulo true
	* @auto-increment false
	*/
	private $nLotacao;

	private $oEmpreendimento;
	
 	
 	public function __construct(){
 		
 	}
 	
	 public function setId($nId) {
		$this->nId = $nId;
	 }
	 public function getId() {
		return $this->nId;
	 }
	 public function setIdEmpreendimento($nIdEmpreendimento) {
		$this->nIdEmpreendimento = $nIdEmpreendimento;
	 }
	 public function getIdEmpreendimento() {
		return $this->nIdEmpreendimento;
	 }
	 public function setNome($sNome) {
		$this->sNome = $sNome;
	 }
	 public function getNome() {
		return $this->sNome;
	 }
	 public function setLotacao($nLotacao) {
		$this->nLotacao = $nLotacao;
	 }
	 public function getLotacao() {
		return $this->nLotacao;
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
