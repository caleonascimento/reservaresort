<?php
 /**
  * @author Auto-Generated 
  * @SGBD mysql 
  * @tabela cota 
  */
 class Cota{
 	/**
	* @campo id
	* @var number
	* @primario true
	* @nulo false
	* @auto-increment true
	*/
	private $nId;
	/**
	* @campo numero
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sNumero;
	/**
	* @campo id_usuario
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdUsuario;
	/**
	* @campo id_unidade
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdUnidade;
	private $oUnidade;
	private $oUsuario;
	
 	
 	public function __construct(){
 		
 	}
 	
 	
	 public function setId($nId) {
		$this->nId = $nId;
	 }
	 public function getId() {
		return $this->nId;
	 }
	 public function setNumero($sNumero) {
		$this->sNumero = $sNumero;
	 }
	 public function getNumero() {
		return $this->sNumero;
	 }
	 public function setIdUsuario($nIdUsuario) {
		$this->nIdUsuario = $nIdUsuario;
	 }
	 public function getIdUsuario() {
		return $this->nIdUsuario;
	 }
	 public function setIdUnidade($nIdUnidade) {
		$this->nIdUnidade = $nIdUnidade;
	 }
	 public function getIdUnidade() {
		return $this->nIdUnidade;
	 }
	public function setUnidade($oUnidade) {
		$this->oUnidade = $oUnidade;
	}
	public function getUnidade() {
		$oController = new Controller();
		if($this->oUnidade = $oController->recuperar('Unidade', array('id_unidade'=>$this->getIdUnidade())))
				return $this->oUnidade[0];
		return false;
	}
	public function setUsuario($oUsuario) {
		$this->oUsuario = $oUsuario;
	}
	public function getUsuario() {
		$oController = new Controller();
		if($this->oUsuario = $oController->recuperar('Usuario', array('id_usuario'=>$this->getIdUsuario())))
				return $this->oUsuario[0];
		return false;
	}
 }
 ?>
