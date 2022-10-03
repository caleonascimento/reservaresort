<?php
 /**
  * @author Auto-Generated 
  * @SGBD mysql 
  * @tabela usuario 
  */
 class Usuario{
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
	* @campo cpf
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sCpf;
	/**
	* @campo rg
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sRg;
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
	* @campo fone
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sFone;
	/**
	* @campo email
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sEmail;
	/**
	* @campo data_nasc
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $dDataNasc;
	/**
	* @campo tipo
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nTipo;
	/**
	* @campo id_acesso_usuario
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdAcessoUsuario;
	private $oAcessoUsuario;
	
 	
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
	 public function setCpf($sCpf) {
		$this->sCpf = $sCpf;
	 }
	 public function getCpf() {
		return $this->sCpf;
	 }
	 public function setRg($sRg) {
		$this->sRg = $sRg;
	 }
	 public function getRg() {
		return $this->sRg;
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
	 public function setFone($sFone) {
		$this->sFone = $sFone;
	 }
	 public function getFone() {
		return $this->sFone;
	 }
	 public function setEmail($sEmail) {
		$this->sEmail = $sEmail;
	 }
	 public function getEmail() {
		return $this->sEmail;
	 }
	 public function setDataNasc($dDataNasc) {
		$this->dDataNasc = $dDataNasc;
	 }
	 public function getDataNasc() {
		return $this->dDataNasc;
	 }
	 public function getDataNascFormatado() {
		if($this->dDataNasc) {
			$oData = new DateTime($this->dDataNasc);
			 return $oData->format("d/m/Y");
		}
	 }
	//  public function setDataNascBanco($dDataNasc=null) {
	// 	 if($dDataNasc) {
	// 		 $oData = DateTime::createFromFormat('d/m/Y', $dDataNasc);
	// 		 $this->dDataNasc = $oData->format('Y-m-d') ;
	// 	 } else 
	// 			$this->dDataNasc = date("Y-m-d H:i:s");
	// 	}
	 public function setTipo($nTipo) {
		$this->nTipo = $nTipo;
	 }
	 public function getTipo() {
		return $this->nTipo;
	 }
	 public function setIdAcessoUsuario($nIdAcessoUsuario) {
		$this->nIdAcessoUsuario = $nIdAcessoUsuario;
	 }
	 public function getIdAcessoUsuario() {
		return $this->nIdAcessoUsuario;
	 }
	public function setAcessoUsuario($oAcessoUsuario) {
		$this->oAcessoUsuario = $oAcessoUsuario;
	}
	public function getAcessoUsuario() {
		$oController = new Controller();
		if($this->oAcessoUsuario = $oController->recuperar('AcessoUsuario', array('id_acesso_usuario'=>$this->getIdAcessoUsuario())))
				return $this->oAcessoUsuario[0];
		return false;
	}
 }
 ?>
