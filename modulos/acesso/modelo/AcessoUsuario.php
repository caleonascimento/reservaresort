<?php
 /**
  * @author Auto-Generated 
  * @package fachada 
  * @SGBD mysql 
  * @tabela acesso_usuario 
  */
 class AcessoUsuario{
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
	* @campo login
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sLogin;
	/**
	* @campo senha
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sSenha;
	/**
	* @campo email
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sEmail;
	/**
	* @campo Geracao
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $dGeracao;
	/**
	* @campo ultimo_acesso
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $dUltimoAcesso;

 	
 	public function __construct(){
 	}
 	//---------------------------------
	 public function setId($nId) {
		$this->nId = $nId;
	 }
	 public function getId() {
		return $this->nId;
	 }
	 //---------------------------------
	 public function setNome($sNome) {
		$this->sNome = $sNome;
	 }
	 public function getNome() {
		return $this->sNome;
	 }
	 //----------------------------------
     public function setMatricula($sMatricula) {
		$this->sMatricula = $sMatricula;
	 }
	 public function getMatricula() {
		return $this->sMatricula;
	 }
	 //-----------------------------------
	 public function setLogin($sLogin) {
		$this->sLogin = $sLogin;
	 }
	 public function getLogin() {
		return $this->sLogin;
	 }
	 //-----------------------------------
	 public function setSenha($sSenha) {
		$this->sSenha = $sSenha;
	 }
	 public function getSenha() {
		return $this->sSenha;
	 }
	 //-----------------------------------
	 public function setEmail($sEmail) {
		$this->sEmail = $sEmail;
	 }
	 public function getEmail() {
		return $this->sEmail;
	 }
	 //------------------------------------
	 public function setGeracao($dGeracao) {
		$this->dGeracao = $dGeracao;
	 }
	 public function getGeracao() {
		return $this->dGeracao;
	 }
	 public function getGeracaoFormatado() {
		if($this->dGeracao) {
			$oData = new DateTime($this->dGeracao);
			 return $oData->format("d/m/Y");
		}
	 }
	 public function setGeracaoBanco($dGeracao=null) {
		 if($dGeracao) {
			 $oData = DateTime::createFromFormat('d/m/Y', $dGeracao);
			 $this->dGeracao = $oData->format('Y-m-d') ;
		} else
				$this->dGeracao = date("Y-m-d H:i:s");
	 }
	 //------------------------------------------
	 public function setUltimoAcesso($dUltimoAcesso) {
		 $this->dUltimoAcesso = $dUltimoAcesso;
	 }
	 public function getUltimoAcesso() {
		return $this->dUltimoAcesso;
	 }
	 public function getUltimoAcessoFormatado() {
		if($this->dUltimoAcesso) {
			 $oData = new DateTime($this->dUltimoAcesso);
			 return $oData->format("d/m/Y H:i:s");
		}
	 }
	 public function setUltimoAcessoBanco($dUltimoAcesso=null) {
		 if($dUltimoAcesso) {//var_dump($dUltimoAcesso); die();
			 $oData = DateTime::createFromFormat('d/m/Y H:i:s', $dUltimoAcesso);
			 $this->dUltimoAcesso = $oData->format('Y-m-d H:i:s') ;
		} 
	 }
	 //-------------------------------------------------------

 }
 ?>
