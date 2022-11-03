<?php
 /**
  * @author Auto-Generated 
  * @SGBD mysql 
  * @tabela empreendimento 
  */
 class Empreendimento{
 	/**
	* @campo id
	* @var number
	* @primario true
	* @nulo false
	* @auto-increment true
	*/
	private $nId;
	/**
	* @campo nome
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sNome;
	/**
	* @campo endereco
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sEndereco;
	/**
	* @campo cep
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sCep;
	/**
	* @campo tipo
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nTipo;
	/**
	* @campo descricao
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sDescricao;
	
 	
 	public function __construct(){
	
 	}
	 public function setId($nId) {
		$this->nId = $nId;
	 }
	 public function getId() {
		return $this->nId;
	 }
	 public function setNome($sNome) {
		$this->sNome = $sNome;
	 }
	 public function getNome() {
		return $this->sNome;
	 }
	 public function setEndereco($sEndereco) {
		$this->sEndereco = $sEndereco;
	 }
	 public function getEndereco() {
		return $this->sEndereco;
	 }
	 public function setCep($sCep) {
		$this->sCep = $sCep;
	 }
	 public function getCep() {
		return $this->sCep;
	 }
	 public function setTipo($nTipo) {
		$this->nTipo = $nTipo;
	 }
	 public function getTipo() {
		return $this->nTipo;
	 }
	 public function setDescricao($sDescricao) {
		$this->sDescricao = $sDescricao;
	 }
	 public function getDescricao() {
		return $this->sDescricao;
	 }
 }
 ?>
