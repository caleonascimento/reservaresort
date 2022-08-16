<?php
 /**
  * @author Auto-Generated 
  * @SGBD mysql 
  * @tabela notificacao 
  */
 class Notificacao{
 	/**
	* @campo id
	* @var number
	* @primario true
	* @nulo false
	* @auto-increment true
	*/
	private $nId;
	/**
	* @campo id_usuario
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdUsuario;
	/**
	* @campo tipo
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sTipo;
	/**
	* @campo mensagem
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sMensagem;
	/**
	* @campo visualizada
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nVisualizada;
	/**
	* @campo link
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sLink;
	/**
	* @campo ativo
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nAtivo;
	/**
	* @campo Geracao
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $dGeracao;
	private $oAcessoUsuario;
	
 	
 	public function __construct(){
 		
 	}
 	
 	
	 public function setId($nId) {
		$this->nId = $nId;
	 }
	 public function getId() {
		return $this->nId;
	 }
	 public function setIdUsuario($nIdUsuario) {
		$this->nIdUsuario = $nIdUsuario;
	 }
	 public function getIdUsuario() {
		return $this->nIdUsuario;
	 }
	 public function setTipo($sTipo) {
		$this->sTipo = $sTipo;
	 }
	 public function getTipo() {
		return $this->sTipo;
	 }
	 public function setMensagem($sMensagem) {
		$this->sMensagem = $sMensagem;
	 }
	 public function getMensagem() {
		return $this->sMensagem;
	 }
	 public function setVisualizada($nVisualizada) {
		$this->nVisualizada = $nVisualizada;
	 }
	 public function getVisualizada() {
		return $this->nVisualizada;
	 }
	 public function setLink($sLink) {
		$this->sLink = $sLink;
	 }
	 public function getLink() {
		return $this->sLink;
	 }
	 public function setAtivo($nAtivo) {
		$this->nAtivo = $nAtivo;
	 }
	 public function getAtivo() {
		return $this->nAtivo;
	 }
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
	public function setAcessoUsuario($oAcessoUsuario) {
		$this->oAcessoUsuario = $oAcessoUsuario;
	}
	public function getAcessoUsuario() {
		$oController = new Controller();
		if($this->oAcessoUsuario = $oController->recuperar('AcessoUsuario', array('id_usuario'=>$this->getIdUsuario())))
				return $this->oAcessoUsuario[0];
		return false;
	}
 }
 ?>
